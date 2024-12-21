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
define( 'DB_NAME', 'Boutique_Sport' );

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
define( 'AUTH_KEY',         '^:Wy6dl+tj)E!ETB*cxY}[dRFM*5sd~)eu:`qQ;mjt+GySj#7;_I3/RqX&=Is`fD' );
define( 'SECURE_AUTH_KEY',  '~3]EG}5#3GH`gcDZYkWf/Xe>(nGVb7sdr[8},){P1EyT(|kQ&~LphWE>~$XD5zpk' );
define( 'LOGGED_IN_KEY',    'd/JSidT.e~YzRBeZ5$UeJ*v0(pix?RX w1De!W{oZ-^174SZoass+[L]g[Vc15uU' );
define( 'NONCE_KEY',        '/K2k:5jDQtvNKzMbb%W@RcbUVu+xjB?P|,v7RQ8GZI t4{n+gCS6 r3_]R04cQ|;' );
define( 'AUTH_SALT',        ':2/}h ;1+Ns97a~wZ${sI`L4B1dko,Ad6bIzS#Eq]U}=21ym)8mITiV:F_5qeAGH' );
define( 'SECURE_AUTH_SALT', '5rG=KeK9=,?%vC_=$cG@HF!s?Sm4yo0R)I.5&S*Zi/N)n/qPs{9[ riMnV,0`r[b' );
define( 'LOGGED_IN_SALT',   'G;d}yaob.LyEvjUknf<Ae_cq*vtqf#uFx:>#kcHhJ7}~7}^KQrMmJT]WI.>e=vD ' );
define( 'NONCE_SALT',       'w/(xZ0wPs;SW2d|qnh4xQcG]%}1+s,w1X0lT?Ypt]ZM=ODKY:`A>A_GC-^x|[edY' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
