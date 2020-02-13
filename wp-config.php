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
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '>;EC-@#t^]slRMD:%}a162!CjL-q</O::H-|/9be=slTGw$zH_;RW<s!{c:{fa#O' );
define( 'SECURE_AUTH_KEY',  'wp)nKx8rD-XTH^IiueBB#(pe_wp@?$?=5:gzw!&|^MJjpS3}WBEet~S%)/09g8/g' );
define( 'LOGGED_IN_KEY',    ']q7{YWmALpe/)a0xoPq|{=x(ul7fEO-;wj_:g$8/F#sGnCV.?a~{8W.@y%H*k,cC' );
define( 'NONCE_KEY',        'tf1D3]T:7<q-|HYDs22kSXlIm,@YS7r1-27k.Q9Z!V_ibUysS_t6p7Jv](!.THpG' );
define( 'AUTH_SALT',        'kBSk[PE?ZRF)J; ]`lh@Aa 3H@y+;5ZrM+)o7jJ-/7RNiq8DS-P?+j{p9<!?Q4]~' );
define( 'SECURE_AUTH_SALT', '8%e{wZapf7@U[MTOj S? t)a{kAvOvf2yy(o>>JG6#yLZ5_DP-Od).h[ON3smZv,' );
define( 'LOGGED_IN_SALT',   '~c@VT96AbfH^FILIg+g,(>B6tg/32A@WL73s7YZ`J{l({qI7tH/HEC7cf.in%{Nk' );
define( 'NONCE_SALT',       'Dm)b92.t3t}be#qnH.]l4~q9D=^u<0w`uJ]}N8Vy5&l#{,< 4ca8oo&N+|TMBF=^' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
