<?php
/**
 * Simple Tags widget class
 *
 */
add_action( 'widgets_init', create_function('', 'return register_widget("SimpleTags_Widget");') );
class SimpleTags_Widget extends WP_Widget {
	/**
	 * Constructor widget
	 *
	 * @return void
	 * @author Amaury Balmer
	 */
	function SimpleTags_Widget() {
		$this->WP_Widget( 'simpletags', __( 'Tag Cloud (Simple Tags)', 'simpletags' ),
			array( 'classname' => 'widget-simpletags', 'description' => __( 'Your most used tags in cloud format with dynamic color and many options', 'simpletags' ) )
		);
	}
	
	/**
	 * Check if taxonomy exist and return it, otherwise return default post tags.
	 *
	 * @param array $instance 
	 * @return string
	 * @author Amaury Balmer
	 */
	function _get_current_taxonomy($instance) {
		if ( !empty($instance['taxonomy']) && taxonomy_exists($instance['taxonomy']) )
			return $instance['taxonomy'];

		return 'post_tag';
	}
	
	/**
	 * Default settings for widget
	 *
	 * @return void
	 * @author Amaury Balmer
	 */
	function getFields() {
		return array(
			'taxonomy'		=> 'post_tag',
			'title' 		=> __('Tag cloud', 'simpletags'),
			'max'			=> 45,
			'selectionby' 	=> 'count',
			'selection' 	=> 'desc',
			'orderby'		=> 'random',
			'order'			=> 'asc',
			'smini'			=> 8,
			'smax'			=> 22,
			'unit' 			=> 'pt',
			'format'		=> 'flat',
			'color' 		=> 1,
			'cmini' 		=> '#CCCCCC',
			'cmax'			=> '#000000',
			'xformat'		=> ''
		);
	}
	
	/**
	 * Method for theme render
	 *
	 * @param array $args
	 * @param array $instance
	 * @return void
	 * @author Amaury Balmer
	 */
	function widget( $args, $instance ) {
		extract( $args );
		
		$current_taxonomy = $this->_get_current_taxonomy($instance);
		
		// Build or not the name of the widget
		if ( !empty($instance['title']) ) {
			$title = $instance['title'];
		} else {
			if ( 'post_tag' == $current_taxonomy ) {
				$title = __('Tags', 'simpletags');
			} else {
				$tax = get_taxonomy($current_taxonomy);
				if (isset($tax->labels))
					$title = $tax->labels->name;
				else
					$title = $tax->name;
			}
		}
		$title = apply_filters('widget_title', $title, $instance, $this->id_base);
		
		// Set values and clean it
		foreach ( (array) $this->getFields() as $field => $field_value ) {
			${$field} = trim( $instance[$field] );
		}
		
		$param = '';
		
		// Selection
		$param .= ( !empty($selectionby) ) ? '&selectionby='.$selectionby : '&selectionby=count';
		$param .= ( !empty($selection) )   ? '&selection='.$selection	  : '&selection=desc';
		
		// Order
		$param .= ( !empty($orderby) ) ? '&orderby='.$orderby : '&orderby=random';
		$param .= ( !empty($order) )   ? '&order='.$order	 : '&order=asc';
		
		// Max tags
		if ( (int) $max != 0 ) $param .= '&number='.$max;
		
		// Size Mini
		if ( (int) $smini != 0 ) $param .= '&smallest='.$smini;
		
		// Size Maxi
		if ( (int) $smax != 0 ) $param .= '&largest='.$smax;
		
		// Unit
		if ( !empty($unit) ) $param .= '&unit='.$unit;
		
		// Format
		if ( !empty($format) ) $param .= '&format='.$format;
		
		// Use color ?
		if ( (int) $color == 0 ) $param .= '&color=false';
		
		// Color mini
		if ( !empty($cmini) ) $param .= '&mincolor='.$cmini;
		
		// Color Max
		if ( !empty($cmax) ) $param .= '&maxcolor='.$cmax;
		
		// Xformat
		if ( !empty($xformat) ) $param .= '&xformat='.$xformat;
		
		// Taxonomy
		$param .= '&taxonomy='.$current_taxonomy;
		
		echo $before_widget;
			if ( !empty($title) ) echo $before_title . $title . $after_title;
			st_tag_cloud( apply_filters( 'simple-tags-widget', 'title='.$param, $instance ) ); // Use Widgets title and no ST title !!
		echo $after_widget;
	}
	
	/**
	 * Update widget settings
	 *
	 * @param string $new_instance
	 * @param string $old_instance
	 * @return void
	 * @author Amaury Balmer
	 */
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		
		foreach ( (array) $this->getFields() as $field => $field_value ) {
			$instance[$field] = strip_tags($new_instance[$field]);
		}
		
		return $instance;
	}
	
	/**
	 * Admin form for widgets
	 *
	 * @param string $instance
	 * @return void
	 * @author Amaury Balmer
	 */
	function form( $instance ) {
		//Defaults
		$instance = wp_parse_args( (array) $instance, $this->getFields() );
		foreach ( (array) $this->getFields() as $field => $field_value ) {
			${$field} = esc_attr( $instance[$field] );
		}
		?>
		<p><?php _e('Empty field will use default value.', 'simpletags'); ?></p>
		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">
				<?php _e('Title:', 'simpletags'); ?>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
			</label>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('max'); ?>">
				<?php _e('Max tags to display: (default: 45)', 'simpletags'); ?>
				<input class="widefat" size="20" type="text" id="<?php echo $this->get_field_id('max'); ?>" name="<?php echo $this->get_field_name('max'); ?>" value="<?php echo $max; ?>" />
			</label>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('selectionby'); ?>">
				<?php _e('Order by for DB selection tags:', 'simpletags'); ?>
				<select id="<?php echo $this->get_field_id('selectionby'); ?>" name="<?php echo $this->get_field_name('selectionby'); ?>">
					<option <?php selected( $selectionby, 'name' ); ?> value="name"><?php _e('Name', 'simpletags'); ?></option>
					<option <?php selected( $selectionby, 'slug' ); ?> value="slug"><?php _e('Slug', 'simpletags'); ?></option>
					<option <?php selected( $selectionby, 'term_group' ); ?> value="term_group"><?php _e('Term group', 'simpletags'); ?></option>
					<option <?php selected( $selectionby, 'count' ); ?> value="count"><?php _e('Counter', 'simpletags'); ?></option>
					<option <?php selected( $selectionby, 'random' ); ?> value="random"><?php _e('Random (default)', 'simpletags'); ?></option>
				</select>
			</label>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('selection'); ?>">
				<?php _e('Order for DB selection tags:', 'simpletags'); ?>
				<select id="<?php echo $this->get_field_id('selection'); ?>" name="<?php echo $this->get_field_name('selection'); ?>">
					<option <?php selected( $selection, 'asc' ); ?> value="asc"><?php _e('ASC', 'simpletags'); ?></option>
					<option <?php selected( $selection, 'desc' ); ?> value="desc"><?php _e('DESC (default)', 'simpletags'); ?></option>
				</select>
			</label>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('orderby'); ?>">
				<?php _e('Order by for display tags:', 'simpletags'); ?>
				<select id="<?php echo $this->get_field_id('orderby'); ?>" name="<?php echo $this->get_field_name('orderby'); ?>">
					<option <?php selected( $orderby, 'name' ); ?> value="name"><?php _e('Name', 'simpletags'); ?></option>
					<option <?php selected( $orderby, 'count' ); ?> value="count"><?php _e('Counter', 'simpletags'); ?></option>
					<option <?php selected( $orderby, 'random' ); ?> value="random"><?php _e('Random (default)', 'simpletags'); ?></option>
				</select>
			</label>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('order'); ?>">
				<?php _e('Order for display tags:', 'simpletags'); ?>
				<select id="<?php echo $this->get_field_id('order'); ?>" name="<?php echo $this->get_field_name('order'); ?>">
					<option <?php selected( $order, 'asc' ); ?> value="asc"><?php _e('ASC', 'simpletags'); ?></option>
					<option <?php selected( $order, 'desc' ); ?> value="desc"><?php _e('DESC (default)', 'simpletags'); ?></option>
				</select>
			</label>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('smini'); ?>">
				<?php _e('Font size mini: (default: 8)', 'simpletags'); ?>
				<input class="widefat" size="20"  type="text" id="<?php echo $this->get_field_id('smini'); ?>" name="<?php echo $this->get_field_name('smini'); ?>" value="<?php echo $smini; ?>" />
			</label>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('smax'); ?>">
				<?php _e('Font size max: (default: 22)', 'simpletags'); ?>
				<input class="widefat" size="20" type="text" id="<?php echo $this->get_field_id('smax'); ?>" name="<?php echo $this->get_field_name('smax'); ?>" value="<?php echo $smax; ?>" />
			</label>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('unit'); ?>">
				<?php _e('Unit font size:', 'simpletags'); ?>
				<select id="<?php echo $this->get_field_id('unit'); ?>" name="<?php echo $this->get_field_name('unit'); ?>">
					<option <?php selected( $unit, 'pt' ); ?> value="pt"><?php _e('Point (default)', 'simpletags'); ?></option>
					<option <?php selected( $unit, 'px' ); ?> value="px"><?php _e('Pixel', 'simpletags'); ?></option>
					<option <?php selected( $unit, 'em' ); ?> value="em"><?php _e('Em', 'simpletags'); ?></option>
					<option <?php selected( $unit, '%'  ); ?> value="%"><?php _e('Pourcent', 'simpletags'); ?></option>
				</select>
			</label>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('format'); ?>">
				<?php _e('Format:', 'simpletags'); ?>
				<select id="<?php echo $this->get_field_id('format'); ?>" name="<?php echo $this->get_field_name('format'); ?>">
					<option <?php selected( $format, 'flat' ); ?> value="flat"><?php _e('Flat (default)', 'simpletags'); ?></option>
					<option <?php selected( $format, 'list' ); ?> value="list"><?php _e('List (UL/LI)', 'simpletags'); ?></option>
				</select>
			</label>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('color'); ?>">
				<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id('color'); ?>" name="<?php echo $this->get_field_name('color'); ?>" <?php checked( (int) $color, 1 ); ?> value="1" />
				<?php _e('Use auto color cloud:', 'simpletags'); ?>
			</label>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('cmini'); ?>">
				<?php _e('Font color mini: (default: #CCCCCC)', 'simpletags'); ?>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id('cmini'); ?>" name="<?php echo $this->get_field_name('cmini'); ?>" value="<?php echo $cmini; ?>" />
			</label>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('cmax'); ?>">
				<?php _e('Font color max: (default: #000000)', 'simpletags'); ?>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id('cmax'); ?>" name="<?php echo $this->get_field_name('cmax'); ?>" value="<?php echo $cmax; ?>" />
			</label>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('xformat'); ?>">
				<?php _e('Extended format: (advanced usage)', 'simpletags'); ?><br />
				<input class="widefat" style="width: 100% !important;" type="text" id="<?php echo $this->get_field_id('xformat'); ?>" name="<?php echo $this->get_field_name('xformat'); ?>" value="<?php echo $xformat; ?>" />
			</label>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'taxonomy' ); ?>">
				<?php _e("What to show", 'simpletags'); ?><br />
				<select id="<?php echo $this->get_field_id( 'taxonomy' ); ?>" name="<?php echo $this->get_field_name( 'taxonomy' ); ?>" style="width:100%;">
					<?php
					foreach ( get_object_taxonomies('post') as $taxonomy ) {
						$tax = get_taxonomy($taxonomy);
						
						if ( !$tax->show_tagcloud || empty($tax->labels->name) )
							continue;

						echo '<option '.selected( $current_taxonomy, $taxonomy, false ).' value="'.esc_attr($taxonomy).'">'.esc_html($tax->labels->name).'</option>';
					}
					?>
				</select>
			</label>
		</p>
		<?php
	}
}
?>