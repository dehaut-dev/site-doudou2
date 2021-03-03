<?php
/*
Plugin Name: WP RSS Images
Plugin URI: http://web-argument.com/wp-rss-images-wordpress-plugin/
Description: Include the first attached images of your post in your rss. 
Version: 1.0
Author: Alain Gonzalez
Author URI: http://web-argument.com/
*/

$rss_img_ch = get_option('rss_img_ch_op');
$rss2_img_ch = get_option('rss2_img_ch_op');

if ($rss_img_ch == 1)   add_action('rss_item', 'wp_rss_include');
if ($rss2_img_ch == 1)  add_action('rss2_item', 'wp_rss_include');

add_action('admin_menu', 'wp_rss_img_menu');


function wp_rss_include (){

$image_size = get_option('rss_image_size_op');
if (isset($image_size)) $image_url = rss_image_url($image_size);

else  $image_url = rss_image_url('medium');

if ($image_url != '') :

$filename = $image_url;
$ary_header = get_headers($filename, 1);   
           
$filesize = $ary_header['Content-Length'];

echo "<enclosure url='".$image_url."' length ='".$filesize."'  type='image/jpg' />";
endif;
}



function rss_image_url($default_size = 'medium') {	
global $post;
	$attachments = get_children( array('post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'numberposts' => 1) );
	if($attachments == true) :
		foreach($attachments as $id => $attachment) :
			$img = wp_get_attachment_image_src($id, $default_size);			
		endforeach;		
	endif;
	return $img[0];
}



function wp_rss_img_menu() {
    add_options_page('WP RSS Images', 'WP RSS Images', 10, 'wp-rss-image', 'wp_rss_image_setting');	 
}



function wp_rss_image_setting() {
     $image_size = get_option('rss_image_size_op');
	 
	 $rss_img_ch = get_option('rss_img_ch_op');
	 $rss2_img_ch = get_option('rss2_img_ch_op');	 
	     
    if(isset($_POST['Submit'])):
	
		$image_size = $_POST["image_size"];
		$rss_img_ch = $_POST["rss_img_ch"];
		$rss2_img_ch = $_POST["rss2_img_ch"];
		
        update_option( 'rss_image_size_op', $_POST["image_size"] );	
		update_option( 'rss_img_ch_op', $_POST["rss_img_ch"] );	
		update_option( 'rss2_img_ch_op', $_POST["rss2_img_ch"] );		
?>
         <div class="updated"><p><strong><?php _e('Options saved.', 'mt_trans_domain' ); ?></strong></p></div>
         
         
<?php  endif;  ?>

<div class="wrap">   

<form method="post" name="options" target="_self">

<h2>WP RSS Images Setting</h2>
<h3>Select the size of the images</h3>
<p>You can change the dimension of this sizes under Miscellaneous Settings.</p>
<table width="100%" cellpadding="10" class="form-table">

  <tr valign="top">
  	<td width="200" align="right">
  	  <input type="radio" name="image_size" id="radio" value="thumbnail" <?php if ($image_size == 'thumbnail') echo "checked=\"checked\"";?>/>
  	</td>
  	<td align="left" scope="row">Thumbnail</td>
  </tr>
  <tr valign="top">
  	<td width="200" align="right">
	 <input name="image_size" type="radio" id="radio" value="medium" <?php if (($image_size == 'medium')||($image_size == '')) echo "checked=\"checked\"";?> />
     </td> 
  	<td align="left" scope="row">Medium Size</td>
  </tr>
  <tr valign="top">
  	<td width="200" align="right">
	 <input type="radio" name="image_size" id="radio" value="full" <?php if ($image_size == 'full') echo "checked=\"checked\"";?>/>
     </td> 
  	<td align="left" scope="row">Full Size</td>
  </tr>
</table>

<h3> Apply to: </h3>
<table width="100%" cellpadding="10" class="form-table">  
  <tr valign="top">
  	<td width="200" align="right"><input name="rss_img_ch" type="checkbox" value="1" 
	<?php if ($rss_img_ch == 1) echo "checked" ?> /></td>
  	<td align="left" scope="row">RSS   <a href="<?php echo get_bloginfo('rss_url'); ?> " title="<?php bloginfo('name'); ?> - rss" target="_blank"><?php echo get_bloginfo('rss_url'); ?> </a> </td>
  </tr>
  <tr valign="top">
  	<td width="200" align="right"><input name="rss2_img_ch" type="checkbox" value="1" 
	<?php if ($rss2_img_ch == 1)  echo "checked" ?> /></td>
  	<td align="left" scope="row">RSS 2    <a href="<?php echo get_bloginfo('rss2_url'); ?> " title="<?php bloginfo('name'); ?> - rss2" target="_blank"><?php echo get_bloginfo('rss2_url'); ?> </a> </td>
  </tr>    
</table>
<p class="submit">
<input type="submit" name="Submit" value="Update" />
</p>

</form>
</div>

<?php }  ?>