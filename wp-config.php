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
define( 'DB_NAME', 'nabil-web' );

/** Database username */
define( 'DB_USER', 'admin' );

/** Database password */
define( 'DB_PASSWORD', '13zo!D5B3z!4h2ha' );

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
define( 'AUTH_KEY',         'OO^Gbl/KEK2cPaJOJE~e%,d]Xq/EL%l!Q0R. _Xd@f*~(ln+z=9(Qvuop`2LH@!a' );
define( 'SECURE_AUTH_KEY',  'tU0$+]$Uu%j+%Rg!<$AQ[&njZs&~ARM,]tn4G6/5~#:x9b;iQ=Zo0S}Q)jwo|&&6' );
define( 'LOGGED_IN_KEY',    '8r/Jk1lR`hW15.<wCG*)rx{b#Tih.CjR<?6M2s[-+2 RRZ1M}v49XzZusc wsM{N' );
define( 'NONCE_KEY',        'u@OroMj[#TnA+`(3-Fqj;R,aey?f9`LJ7`2D%<Cn+P5?i4ewcPt*dqBx{m*KQ%k,' );
define( 'AUTH_SALT',        '#-%FyHae,-jhHz/8KAlMJJvjYLL~Dn~+EI-&MGB#L8BM_5I0FPolRh44pNr nd|>' );
define( 'SECURE_AUTH_SALT', '0}TL|Q^8oIvR]t={(#Y<]XVf{jxp(2=GXjw6>EPYrHk~?V+IC<%o!I6E~sC;~]~|' );
define( 'LOGGED_IN_SALT',   'S0Jq*H?)SRd>u|BO|Hi <qSC>kOZ[A+$B${yvIJpxsFFFH4|7V)M.h.wHY=ja[pO' );
define( 'NONCE_SALT',       '9AcItP[s!(]!,2t:,IU3mN^_BiWb @on>{] oh!EsHVgB7h2:%GZUNRVnP`aN:JV' );

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
