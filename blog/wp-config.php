<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'liveout');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define( 'FS_METHOD', 'direct' );
define( 'FS_CHMOD_DIR', 0777 );
define( 'FS_CHMOD_FILE', 0777 );
/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'EDiEb[[dyWl-tC*}H_58sE7q*t+t*w-Nw+Ait;9?$fwO,38dK3@/5D0+FAY*`Y#z');
define('SECURE_AUTH_KEY',  'jpzgxpkd~6xy@nGu@bD>eA }J61cdsT%/Y2TDSO$<bQ<[#+gbx>:l|+xtk#,Z.vu');
define('LOGGED_IN_KEY',    'XY |);ehq4x/WU;7<-W~]w4ANZ1KEF_-Q9$gKg/<ry(&f@fJ.kzq>2^N]3@H%63/');
define('NONCE_KEY',        'u8~~xZ/GY}2Xz4P <q@UE8l@F}:)F~%ztJf j1g@D|Q<KI-e77{R&FYx?lK,G>Db');
define('AUTH_SALT',        '`YW{p5-7)}D]vZZv|7eW9`7#Tli$_K:^0#n$Nv!#W$dgR^zJnjGY%4Zz_qB=_}Gp');
define('SECURE_AUTH_SALT', 'J;m.y# ud}e^~g1|XUly5j[?a2Cj.XM[AF:h9Z/~S>8IvHy~6Qh]zA~e|a3u@=fn');
define('LOGGED_IN_SALT',   '1g0tN-PI?Bm-2XA3/XE!P.= I#|9J97F3=%V@dKUPRUwDOMU=aG3P%^abe*=&#P]');
define('NONCE_SALT',       'TL{J%P{,4u0Y-,I(yYnizQS90G8kp)N1*O-EObW;15`O`:|8ZsU&Dq8]J=4MUC^P');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'mm_';

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

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
