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

if( file_exists(dirname(__FILE__) . '/local.php')) {
	// local database
	define('DB_NAME', 'wordpress');

	define('DB_USER', 'root');

	define('DB_PASSWORD', '');

	define('DB_HOST', 'localhost');
} else {
	//live database
	define('DB_NAME', 'muhamm74_wp556');

	define('DB_USER', 'muhamm74_wp556');

	define('DB_PASSWORD', '205080');

	define('DB_HOST', 'localhost');
}

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
define('AUTH_KEY',         'G>.(EXsK[ *^eS-8|qZIeL<+]s)!VIdJ?[{:#+:+0AO@o}3zGudo}:(}S|!0/pSX');
define('SECURE_AUTH_KEY',  'P+<:qtgX{k3]-ZJvpOMtP|y;3aYd-Rt;D|Nnks,`Iq=|`%h}*i^ztA;iyloZ|A!2');
define('LOGGED_IN_KEY',    '`5TYT(RRNs~sV~BOP#wW^-?82uDx/u|3(My}G|;+WmXsJEJJcJP(/ )JHB]eu?PN');
define('NONCE_KEY',        'S49/za3+v^^~>^MC{ZRb{ 83t+KNCK3jQezM)FBXzfGUp9r3;-;c=|waEa|?pPP3');
define('AUTH_SALT',        '`s:4e^UvSFQKiEz62ZZhy-Mz~*;~,|mj+.*|9H=MNzC:SyX-=>FR`:brxLQVYpHC');
define('SECURE_AUTH_SALT', 'gN]$)ukZ{WL--wt#]`Hcj_4 ax@$H)vXb}U/_.M1|{-2o`pQ6]{G9sJDs6eVky6V');
define('LOGGED_IN_SALT',   'PCJZt[LuBU7Q^H-U-T:+P`u>C~X4c6L++Lxp#+{pZjBbF63lO2O}:UAOdQcyKIUr');
define('NONCE_SALT',       ',KwaDhQFO}5Y?nb9Y_-7TVQEn=l&530Bf|k8*f>up>}AIY(C<K@v-H>D:iyW>*rw');

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
;

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
