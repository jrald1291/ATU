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

define('DB_NAME', 'atu');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'x?:#X?6DD>x)&o{GBhaML]{Y`A2`}8iU{[7ki=oP$ $fj@d?Q(:FZ9O|:Qe,i4DW');
define('SECURE_AUTH_KEY',  'qksl{g|i9B*OA?g8mcxS;z^K9PmI0dO+&(p$>KTvNpx`|NNL3G5`6-*juZHBE Xe');
define('LOGGED_IN_KEY',    'D.InTP2)9I&^wg}:0ogrPSip3mIE6E%(fU:m5Ct7YP ,a9KJF&9#1:mp-2MIY$v;');
define('NONCE_KEY',        '$8k>`g<1Q[%XGy:~mg&=x% c@kJiq.;cnB#kzf9mm8[ei$5xk#;_M~Z$Lru5rv-a');
define('AUTH_SALT',        'Y;3bAq W%(K:mL<S:e3wqj*Lez%G),=MYV)Xu8.pv[k pMb*{z&j!1$B$y>$NhPJ');
define('SECURE_AUTH_SALT', '2+{-%e(/^[gdnZV<M.V)t0niadP^dic[CExbOY6+<f}t,mU<zRQF}>3?S1e55plq');
define('LOGGED_IN_SALT',   'LycnF+<9.tO[O]D5 RO!,(hAjM*%)S/Ej-i3U#@X&amo,]_H<QtV4Na-xPvxo@ri');
define('NONCE_SALT',       '@|6|SC1!yu|54R&yoItjvurW;wBI-Pp9fb!&+0A[gd&;mTj/?^4XMK(ETyp[Sd,U');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
