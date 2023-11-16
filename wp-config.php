<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'tanzdb' );

/** Database username */
define( 'DB_USER', 'user' );

/** Database password */
define( 'DB_PASSWORD', '123' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '@DxnXChhU*.cvqXxL:>)[4nBe. :mER{z4zC;xkB~ =!ab<jxjG MOJpc&}uuK$|' );
define( 'SECURE_AUTH_KEY',  '[d2mhvm>G68FC|5TzB)^1=ADB.O>+rDd5_~+sU3UfZo<=Tcqc8}8]+}3!VjA@?,F' );
define( 'LOGGED_IN_KEY',    '*s,; x=>Ua;*tEJxOUal~0h9*^zQriUA%M=.j1ryY6*m,T?(1w.aOPI/-q7A |vp' );
define( 'NONCE_KEY',        '61ZI;OwV%/R*+t-%Z(?FNc}[v`?MpO[iuR91MH.6aB<w?<iWOr%UvHMta1bwFlX0' );
define( 'AUTH_SALT',        'x1nQM_nV-@uk:FHrYX:=,baQ:~1_Q~dceku(i!PQxUP,L^!J8I0_[|p`]m=JB@8r' );
define( 'SECURE_AUTH_SALT', 'Ri .49JcwPpQJdJoyQRw]uw}JM~#UaHia5jI#214i3gGg&d<qxnDh|:i~^!R6=Tt' );
define( 'LOGGED_IN_SALT',   'O|/v!8%gCPqPw:*dg;DeCX7y%~YRTBK`kF#LZt9pN.>2M|op2^&9t~F k1:9$Me-' );
define( 'NONCE_SALT',       'P~iS,i(zg9~*[nPyG+e#1gI>OoYc2TT6><7d(Ht]=cTj?,{-tk.[&}2FG/&=VC85' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wnTpXq_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



define( 'DUPLICATOR_AUTH_KEY', 'oJj^YWGb4gRf=kV4SW|2Wr-EU,)8UFMf>ZaMeEJ>N_Is>`MLSh3{j7wB 1}j| 1q' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
