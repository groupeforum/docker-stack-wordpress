<?php
/*
Plugin Name: Ophelie
Description: Ophelie is a superwoman who will keep an eye on your WordPress.
Version: 1.7.0
Author: Florian Girardey
Author URI: https://twitter.com/GIRARDEYFlorian
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


if ( ! function_exists( 'ophelie_add_webmaster_role' ) ) {

	/**
	 * Create a 'Webmaster' role with Editor and WooCommerce Shop Manager capabilities
	 *
	 * @since 0.4.0
	 *
	 * @return void
	 */
	function ophelie_add_webmaster_role() {
		if ( ( ! get_role( 'webmaster' ) ) AND $editor = get_role( 'editor' ) ) {
			$webmaster_capabilities = $editor->capabilities;

			if ( $shop_manager = get_role( 'shop_manager' ) ) {
				$webmaster_capabilities = array_merge( $editor->capabilities, $shop_manager->capabilities );
			}

			add_role( 'webmaster', 'Webmaster', $webmaster_capabilities );
		}
	}
}

add_action( 'init', 'ophelie_add_webmaster_role' );


/**
 * Bugfix for MULTISTE
 *
 * @see   https://core.trac.wordpress.org/ticket/21573
 *
 * @since 0.7.0
 */
if ( defined( 'MULTISITE' ) AND MULTISITE ) {
	if ( defined( 'SUBDOMAIN_INSTALL' ) AND SUBDOMAIN_INSTALL ) {
		if ( defined( 'NOBLOGREDIRECT' ) AND NOBLOGREDIRECT ) {
			remove_action( 'template_redirect', 'maybe_redirect_404' );
		}
	}
}


/**
 * Remove accents for media file name.
 *
 * @since 1.0.0
 */
add_filter( 'sanitize_file_name', 'remove_accents' );


/**
 * Remove the generator meta in the header and in the RSS Feed
 *
 * @since 1.0.0
 */
add_filter( 'the_generator', '__return_null' );
remove_action( 'wp_head', 'wlwmanifest_link' );


/**
 * Disable XML-RPC
 *
 * @since 1.2.0
 */
add_filter( 'xmlrpc_enabled', '__return_false' );


/**
 * Remove WP Rocket cache when deactivated
 *
 * @since 1.3.0
 */
add_action( 'deactivate_wp-rocket/wp-rocket.php', 'rocket_clean_domain' );


/**
 * Enable auto updates even if WordPress is under VCS (ie: Git or SVN)
 *
 * @since 1.4.0
 */
add_filter( 'automatic_updates_is_vcs_checkout', '__return_false', 1 );