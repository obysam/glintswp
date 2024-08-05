<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'glintswp' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         '>=7X9>$l)t(vXr*QBR~# 2#jfsQauac6&Fh[*,JP.&+@/>P[ WbQ$Vo(nMP428ZL' );
define( 'SECURE_AUTH_KEY',  'sbA<^Vm:$};<R1J!8`0PUw$K`%eDmUp#0:`6W*LD@|QHqtk;t9qb}wb,@jT+?8/ ' );
define( 'LOGGED_IN_KEY',    ',+ey4ip5zx{C)qbE[}2(D0n*uO7`*D!7*+SQ^d_-.-7hr:<5%-^$IMl/6K<PH3WR' );
define( 'NONCE_KEY',        'D45}nN3VH.H^+vP}YPMxKq<}oY:q!pB6mmHFC*lor-;B:qh,/M/F#)fDm[SFisn/' );
define( 'AUTH_SALT',        '~H5t{|@q`{d>.bP4 zmMu.y>zIG6YW|aejIfemiY%}Yw[*soo54U*/.oN2s.<r/-' );
define( 'SECURE_AUTH_SALT', '`YH|XM%SFC&H>Hj~S^2}tYTuTralKdnbJJ1`1Qj`r!zs-[>p3^YS-74n[]@U~@R,' );
define( 'LOGGED_IN_SALT',   'K?3FYEcoq.#rJj.Ipd8M.G[wR+)ms:__+/K_ZTH)6q1[,)tM*eCy~tA>CwfPA>`^' );
define( 'NONCE_SALT',       'f$.hx%)GUvP6^XW~.7fU[M9~P_)-`Fjj:4QuSP==}069:Nk36;K7cjItIDtnk!Hu' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
