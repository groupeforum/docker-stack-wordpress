<?php

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', getenv( 'DB_NAME' ) ? getenv( 'DB_NAME' ) : 'wordpress' );

/** MySQL database username */
define( 'DB_USER', getenv( 'DB_USER' ) ? getenv( 'DB_USER' ) : 'user' );

/** MySQL database password */
define( 'DB_PASSWORD', getenv( 'DB_PASSWORD' ) ? getenv( 'DB_PASSWORD' ) : 'password' );

/** MySQL hostname */
define( 'DB_HOST', getenv( 'DB_HOST' ) ? getenv( 'DB_HOST' ) : 'mysql' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
if ( ! isset( $table_prefix ) ) {
	$table_prefix = getenv( 'TABLE_PREFIX' ) ? getenv( 'TABLE_PREFIX' ) : 'wp_';
}

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */

/** Active WP_DEBUG anyway */
define( 'WP_DEBUG', true );

/** Disable Plugin and Theme files edit */
define( 'DISALLOW_FILE_EDIT', true );

/** WordPress Address */
define( 'WP_SITEURL', ( $_SERVER['HTTPS'] == 'on' ? 'https://' : 'http://' ) . $_SERVER['SERVER_NAME'] );

/** Blog Address */
define( 'WP_HOME', ( $_SERVER['HTTPS'] == 'on' ? 'https://' : 'http://' ) . $_SERVER['SERVER_NAME'] );

/** Path to the wp-content directory */
define( 'WP_CONTENT_DIR', dirname( __FILE__ ) . '/wp-content' );

/** Url to the wp-content directory */
define( 'WP_CONTENT_URL', ( $_SERVER['HTTPS'] == 'on' ? 'https://' : 'http://' ) . $_SERVER['SERVER_NAME'] . '/wp-content' );

/** Allow multisite */
define( 'WP_ALLOW_MULTISITE', true );

/** Increase PHP Memory Limit */
define( 'WP_MEMORY_LIMIT', '128M' );

/** Increase PHP Max Memory Limit */
define( 'WP_MAX_MEMORY_LIMIT', '256M' );

/** Disable WordPress built-in cron request */
define( 'DISABLE_WP_CRON', true );

/** Make sure a cron process cannot run more than once every 60 seconds. */
define( 'WP_CRON_LOCK_TIMEOUT', 60 );

if ( in_array( getenv( 'PHP_ENV' ), array( 'test', 'development' ) ) ) {
	/** Do log PHP errors */
	define( 'WP_DEBUG_LOG', true );

	/** Display PHP errors */
	define( 'WP_DEBUG_DISPLAY', true );

	/** Save database queries */
	define( 'SAVEQUERIES', true );
} else {
	/** Log PHP errors */
	define( 'WP_DEBUG_LOG', true );

	/** Don't display PHP errors */
	define( 'WP_DEBUG_DISPLAY', false );

	/** Don't save database queries */
	define( 'SAVEQUERIES', false );
}

if ( in_array( getenv( 'PHP_ENV' ), array( 'development' ) ) ) {
	/** Local development activated */
	define( 'WP_LOCAL_DEV', true );

	/** Reset the opcache on each request */
	opcache_reset();
}