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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'adventureblog_wp' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'toor123' );

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
define( 'AUTH_KEY',         '`a7T&tj*gsgFr2Zz {73C/y|c)?rLYzT%Cp;WWdcaEpB5Qw+hl{a5AX.j^~y#__%' );
define( 'SECURE_AUTH_KEY',  'h+w9oA/5k(Ejmfc:){I:k%>W9dze%</-w[_dMFK pwDuMc2D<Wk^=~EvS<@x~/ 8' );
define( 'LOGGED_IN_KEY',    't0BqHZbA2%,4S2oE[3[vwb9H0<oY?$bO$R-K`U%eN% N3)31<2Fi0xQb4cz} ia;' );
define( 'NONCE_KEY',        '=O)bFmVDbt%(^6rR&Qlam$D8Mp(csi}1?#*06)<mVg&.2WRkB`+9_2Su[.j1oMV%' );
define( 'AUTH_SALT',        '3M53l{fL0y?#q<C8q-UgW=UM~8b%hw1cd+Wej#jC6+/.k*Yl]~swEMaS[:)`l ^t' );
define( 'SECURE_AUTH_SALT', '4[t,utLl&IsPD2s|#JFTzVIqV!ggdC;KI)%e>{hhG45f0-iaPDveh<r`VlAn}NP6' );
define( 'LOGGED_IN_SALT',   'XETNj`/e0tf)X7<[Pi=wr8,NR2Z@&!_bj4{-:EbDGjbCras]KZL}v9]+MF{52d,+' );
define( 'NONCE_SALT',       '@BbZ|0#s(Q&;?h5=rp]YwDL_Ls5H<H=,8N_]<9BT93nlO)ybd1HTIYe2zW5$!?P1' );

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
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
