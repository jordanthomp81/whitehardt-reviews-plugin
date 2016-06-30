<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache



//Begin Really Simple SSL Load balancing fix
if (isset($_SERVER["HTTP_X_FORWARDED_PROTO"] ) && "https" == $_SERVER["HTTP_X_FORWARDED_PROTO"] ) {
$_SERVER["HTTPS"] = "on";
}
//END Really Simple SSL
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

if ( file_exists( dirname( __FILE__) . '/dev-config.php' ) ) {

	include( dirname( __FILE__) . '/dev-config.php' );

} else {

	// ** MySQL settings - You can get this info from your web host ** //
	/** The name of the database for WordPress */
	define('DB_NAME', 'rg_wp_goldwater_law_firm_2016');

	/** MySQL database username */
	define('DB_USER', 'client_rg');

	/** MySQL database password */
	define('DB_PASSWORD', 'ud6Baj9eb1Uc7foB1Ef1cAj5eEj5lo');

	/** MySQL hostname */
	define('DB_HOST', '10.209.163.4');

	/** Database Charset to use in creating database tables. */
	define('DB_CHARSET', 'utf8mb4');

	/** The Database Collate type. Don't change this if in doubt. */
	define('DB_COLLATE', '');

	/**
	*
	* Defines the FTP connection info to stop the annoying localhost FTP Issue
	*
	*/
	define('FTP_HOST', 'localhost');
	define('FTP_USER', 'whitehardt');
	define('FTP_PASS', 'tJJscc2n9D9RJDTo');
}

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '#pDv|%xtcBj%o e;OD.mV0G.0.{L`/M5HOw}Q>U./Q]Im.T!Yv+Q!wEWMRD0(BS)');
define('SECURE_AUTH_KEY',  'cL*_gQ4Tb)v3?|y=y:>_)L|@lz-&JCY12rm`cj!O>[w[qF[|q+b=oL,r#fnu^gu-');
define('LOGGED_IN_KEY',    'BW6r5AaQf!br+a<!lK:CC^@N4N@5Htw_[!#/lzBWCQe:<$=AXW Z|WH~B:+rEvL5');
define('NONCE_KEY',        '%v(fP8FaaSHu.pGH#`{hlu;FV|qy`TdIxly7!Tw[|Af~Dmsnh#|.pT?wVng>3m }');
define('AUTH_SALT',        '[kh<XAV.-|VR5)flBz:F4D})z5J4;UE^epm+?!+_=ig+a(r`} ;;2BLov|jgb%&j');
define('SECURE_AUTH_SALT', '-uk.Ik7gU|VrIs65{R(kWP/L&e+R+%cE6.D7w6s|j(11]D8,=WS,[~v}:.M%--Hx');
define('LOGGED_IN_SALT',   '9JTjE[$u*OLqW_n!cMJLX?JoD3pX!n9{-tT^3<Xe*:OmR*yy96:FrCw8L#R@7OG/');
define('NONCE_SALT',       '}?:/pY=J^1,+by8uT7)ByOLi)lA:w6HIRA`9U#m0Af$norboP85YdZK+NjkBG6a`');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'rg_';

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
define('WP_DEBUG_DISPLAY', false);
define('WP_DEBUG_LOG', true);

// Increase memory limit for Avada theme
define( 'WP_MEMORY_LIMIT', '256M' );

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
