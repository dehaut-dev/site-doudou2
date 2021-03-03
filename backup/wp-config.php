<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clefs secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur 
 * {@link http://codex.wordpress.org/Editing_wp-config.php Modifier
 * wp-config.php} (en anglais). C'est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d'installation. Vous n'avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'sh190165_w1');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'sh190165_w1');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', 'GPQA5gz2q');

/** Adresse de l'hébergement MySQL. */
define('DB_HOST', 'mysql.sh190165.website.pl');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8');

/** Type de collation de la base de données. 
  * N'y touchez que si vous savez ce que vous faites. 
  */
define('DB_COLLATE', '');

/**#@+
 * Clefs uniques d'authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant 
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n'importe quel moment, afin d'invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '^Hzq^t&-HB[N8H~,+= .;3Jgv;h-|+e3RV<q$,GxVED%0sHhZ1|=V~N;7a6zx&;s'); 
define('SECURE_AUTH_KEY',  'QzLV,0n+($*}H1|R4/pwKe4mE.ac 1&m+ fR&FW$`?7bfi3jq&`U{:Z&M.h6O%!6'); 
define('LOGGED_IN_KEY',    '3/@0Qq@^HaIRK]o`zc(cM+C:[HMsr!hhlK(-gdL.uAl*kEfc_mX>~wVVCx7A4G9$'); 
define('NONCE_KEY',        '^)4C8E4D4gFx--5Ea#Y^rU,-z!a-m}JL:LO1$rM-6/opt}xMQG>LMZ31R,6RUEUf'); 
define('AUTH_SALT',        'M^e9wpC1ng0~*li^hT>!]LEg>r4/M2xpH`UWAe_Ju2@N+gk<SMW3?|!P6M^-@R>s'); 
define('SECURE_AUTH_SALT', '%=VOsV*w_ZaAUGNA;Nl|7[FPRoj FV%P|g>`io2Y}+qfHD7v(JAa=|Oy$~[y8#LD'); 
define('LOGGED_IN_SALT',   'S$F6Kay|>f,+l#sXSN7W_l4FE]?`4QU@v!uNVg.jSClUjz-eyx407A`w4 ?z7aeG'); 
define('NONCE_SALT',       '[|H3[)e9{y!pZ|/!JjuH-tuwe<`(cBUiN*/%nEjTuH_~fmYdUem ,T;<)/w^>|kN'); 
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique. 
 * N'utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés!
 */
$table_prefix  = 'wp39802_';

/**
 * Langue de localisation de WordPress, par défaut en Anglais.
 *
 * Modifiez cette valeur pour localiser WordPress. Un fichier MO correspondant
 * au langage choisi doit être installé dans le dossier wp-content/languages.
 * Par exemple, pour mettre en place une traduction française, mettez le fichier
 * fr_FR.mo dans wp-content/languages, et réglez l'option ci-dessous à "fr_FR".
 */
define('WPLANG', 'fr_FR');

/** 
 * Pour les développeurs : le mode deboguage de WordPress.
 * 
 * En passant la valeur suivante à "true", vous activez l'affichage des
 * notifications d'erreurs pendant votre essais.
 * Il est fortemment recommandé que les développeurs d'extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de 
 * développement.
 */ 
define('WP_DEBUG', false); 

/* C'est tout, ne touchez pas à ce qui suit ! Bon blogging ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');