<?php

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

require_once( ABSPATH . 'wp-config-global.php' );

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
