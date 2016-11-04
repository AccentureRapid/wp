<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wp_git');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         '>Lr$m9-LvqdAP/a$G:[,,6twH_u:L#(9(8RbgOj3mz]F;FRNv_/<}YNREkqpuW^9');
define('SECURE_AUTH_KEY',  '3 j*=Un-shG]}5x[vp^UF~zMrRLY,:S+B/0;9E+<JHqL=[CsB6Z[Aj*o(itlghS=');
define('LOGGED_IN_KEY',    'b:zh1=Pz.]@[BlF`#u>2P@;3|@dNm@Qk :}iMD^(5AkKv&,:DJa9*?mGgbq76x4y');
define('NONCE_KEY',        ':U+wJ&p-^N||uhX/|G0w}o#t|hb8`z@6r|j>:;4ltQJ9tP2<Ve+[|^I.0RjQaQid');
define('AUTH_SALT',        '7/Ew2)*]LC@. W1tuH=sxg8Z/MP2j$k#fiF4:LH^=U)wNXCU>~=>O7Kh]F8 lgEi');
define('SECURE_AUTH_SALT', 'd@y6;A&1NJd,RTD5In.)`.wJrm6^xxzN)|&r*t@mw=yExwp>,![<*!-UfY?%x|rh');
define('LOGGED_IN_SALT',   '`x}9:s}O}/<{V>AFU?J0H0X^m[9fN<)LyaF0ssh<*qiaX00(|FZT>-dGyq,G>,|/');
define('NONCE_SALT',       '/I&~eXrl5S_9BkBEI@h4f`2]Z-1@j1gCEO{7Qhq(+i<H^Op^0hGzVwi@i`]M,3ir');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
