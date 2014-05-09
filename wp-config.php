<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'fidelis');

/** MySQL database username */
define('DB_USER', 'mastersa');

/** MySQL database password */
define('DB_PASSWORD', 'Kerrang!');

/** MySQL hostname */
define('DB_HOST', 'aws-rds-apeb.cff0v2jjph3v.eu-west-1.rds.amazonaws.com');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         ' 4+|4>bYTng{VAwH(NVQS|b%J7p5aN{*vE:o3FBYHLSW1J@|+8p- `qI&PA(J8mc');
define('SECURE_AUTH_KEY',  'mZkpx@T ay1>9Z#hl9sx`yiY8lr3SVzQ#|3?<-M2!r-Bnd)A,t{]2PHFKbk@RK$(');
define('LOGGED_IN_KEY',    '_sb/t,!0V+..G~558LIH]Rz1LP/!> B49cF+KQg_3ft:.1g(t?G ]cO0;G(3wq;>');
define('NONCE_KEY',        '-Nl--S VC$d.yt{FSl;!/BiZQXHdA;B+bwfzP:sXC<}9|hCzjNUi.!P&W)?%SWs:');
define('AUTH_SALT',        '+3K>oK+2?>-%7~G:XC{-:Z|Hv~*FxpR|RR:?r.)@-KwA 8ac*WqJ5%Ky9IpXn:Vd');
define('SECURE_AUTH_SALT', '7)]*dRCJV,cRJVC8Ml8F}SyvLU8@lY`znIN-:Z6Oc0x-wE%y;>y=- Z_g0fM-}gN');
define('LOGGED_IN_SALT',   'FYcDk&]+Z{mC}aKAE?aZdr,?)ihi9||f0]9R%bd$A.aW3F3>roJcxpYo.|3:t@uB');
define('NONCE_SALT',       '*S$AH!u3FBgx/p?Y^JtZP`i -=DFw GueoLgGT{QchcQQFlVlI34C)$!R`g*J-J8');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'FiD142_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
	
	define('FS_METHOD','direct');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
