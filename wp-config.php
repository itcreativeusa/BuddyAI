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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          '55]t[{4COQ|]0, $DbM@.n^1K+<[btvL(YUPX?ck]s3eAB,F_Yj/o{,O^PAgm0:[' );
define( 'SECURE_AUTH_KEY',   'S:a:-obnKZ8u.,/<cftzc);V@5E0K|O7BU{,<]re?0=&Z@G2|vq$Rt7aA8:;]QB5' );
define( 'LOGGED_IN_KEY',     'bswkbbC;d`3u<:p}csF;|z!U`CB@.DSCNG!QFbwr:Nf%YG8G[=0uP9JN!`G(pvy+' );
define( 'NONCE_KEY',         '8_j+|x54lr]>xh|HtH$IU{#1V,qCYz|2Qi(;H3RI-I&Hyfmp0zt/zM]mK5d>n%mA' );
define( 'AUTH_SALT',         '32/9=]VYtzm~q^]04gewT~Vk(-smxjJ06#b9KUTv&zutq3-FcC&KVZ3-KM#:fg?W' );
define( 'SECURE_AUTH_SALT',  '@(S5jz4d?<X9= p;dIfa&Fc6wz J@[hkg_<RyDCFB4yh~q;ZE^W=^H[(4iO/QTkQ' );
define( 'LOGGED_IN_SALT',    'Ss| +o|+I=Ft!{hYJVPU!Qoen}%8$Fi`LySCl*HiX(9rkw3}v}2q5)UhKfHFpv12' );
define( 'NONCE_SALT',        'A-jo4bGOcQ5~;C6JBMnLYB5Fp^}]oj&eW<`[NTD?(&[&^2!8Hq}5/cx4vr7N5D6h' );
define( 'WP_CACHE_KEY_SALT', ' 7ZmAy ]dbbdP$%LlBS::&st>VEP!-bn8N(L{foT0`;/O9**?,tjU4I&B2/f,NB6' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
