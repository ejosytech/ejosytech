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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'ejosytech' );

/** Database username */
define( 'DB_USER', 'eronumaj_majiero' );

/** Database password */
define( 'DB_PASSWORD', 'Majiyebo73@' );

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
define( 'AUTH_KEY',         'KWilixbED5{PecBW0sPRW]g^}<_9|5&O970gIp&|vMvL6D.h)S|rQf#a@W^^hn$6' );
define( 'SECURE_AUTH_KEY',  'Vcm%#jn|k!)0^L_vrY0|T[XT`YuPNa9f7!d^hMG=3)/DWY_cg75D {1D[H}vM)@a' );
define( 'LOGGED_IN_KEY',    '3C2~R}6GGk0ZSCWE2[#JV-Z7G=ZTx7^J?$fqQ*Ux2=KUo`PoZ(B 8X7G yVe6d^L' );
define( 'NONCE_KEY',        'P.l8bdpy>k.j?A3oTZ%|}nM0s#]h$gD}.o^~rg)<GJXR0{l;iKTa7`vMwtbs bXf' );
define( 'AUTH_SALT',        '#,}Zn@088;ej9GG**QK#Z[C34t:~+2)4zRgAv@nkBKt>z(DrAsXg0TXoD[}|}!/i' );
define( 'SECURE_AUTH_SALT', 'nQX1+B..,@E!ki>.li*^|&I,kb,? z^o!?AUgkWr14:*QBw]:5GV:4Z;({/f6%4U' );
define( 'LOGGED_IN_SALT',   'Vg[x`}[Wlg!c9=:6*mnACTS+Sx=1j%CeOdiO0s]|.?!9yreDE&N$XPMP_IOR0e88' );
define( 'NONCE_SALT',       'KaY2KRP$yV,dL70=!CIo}0l({>7,h`PWeU q~-;D-xUB(li uS)ho?*(oM#Qo7s5' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'ejosy_';

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
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
