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
define('DB_NAME', 'kipepeo');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         '[huJAS.|Ye&|HjAy@1n0C@c(GQwgeb.%BIJ[IU1&YF l)|}OJ^xOW 6o&=IOld9e');
define('SECURE_AUTH_KEY',  '{Hru[1j{=_E,%/%h63V<!-fa=~Jp!eo-zd#*l!vlEQ_MRH?!g/.5V$`/@w/_0&TU');
define('LOGGED_IN_KEY',    '<F]mjchs>0g4[uX,-?!U@0@}}Gm#a_s]tgm+DRV~}h-2[1$d.0UBqn`M{MkM99(>');
define('NONCE_KEY',        '@M/:-x&b%*W]0QLD>NR8MP}rp$4N%r! %fIiseMHl5UyKKN~.#+V<?H-W(^Xko&=');
define('AUTH_SALT',        ' Ru%A_`BV,*QCC)V!NZ5;HmhVx7)f`Ec[{0M.XBg}iS.a]/ naV7p7E`dIWMFz8m');
define('SECURE_AUTH_SALT', '%7Oaq<7=`kz=}@0=d5O2)hOhgBSykt+s2Jc];(46+UNrJZ6&Pt :vXs/d^-ta^Dk');
define('LOGGED_IN_SALT',   '=fz97Z:. !yq3txYvY:-@5bIVENu*H)KZutZhmnyweCE7 E(6U!@;zQ0ursDILA>');
define('NONCE_SALT',       '?aO/my}pKkiGKV,1^Y,<qD JI%36-v},@*hu<bKghSni1ENZEf{akSun (I(zBNw');

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

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
