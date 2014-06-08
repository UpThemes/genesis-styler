<?php

/**
* Cupertino functions and definitions
*
* Sets up the theme and provides some helper functions. Some helper functions
* are used in the theme as custom template tags. Others are attached to action and
* filter hooks in WordPress to change core functionality.
*
* The first function, cupertino_setup(), sets up the theme by registering support
* for various features in WordPress, such as a custom background and a navigation menu.
*
* When using a child theme (see http://codex.wordpress.org/Theme_Development and
* http://codex.wordpress.org/Child_Themes), you can override certain functions
* (those wrapped in a function_exists() call) by defining them first in your child theme's
* functions.php file. The child theme's functions.php file is included before the parent
* theme's file, so the child theme functions would be used.
*
* Functions that are not pluggable (not wrapped in function_exists()) are instead attached
* to a filter or action hook.
*
* For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
*
* @package Cupertino
*/

//* Start the engine
//include_once( get_template_directory() . '/lib/init.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Cupertino' );
define( 'CHILD_THEME_URL', 'http://upthemes.com/' );
define( 'CHILD_THEME_VERSION', '2.0.1' );

//* Remove our default theme options page and just use the Theme Customizer instead
define('UPFW_NO_THEME_OPTIONS_PAGE',true);

//* Add HTML5 markup structure
add_theme_support( 'html5' );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for custom background
add_theme_support( 'custom-background' );

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

if( file_exists( get_stylesheet_directory() . '/options/options.php' ) && file_exists( get_stylesheet_directory() . '/inc/theme-options.php' ) ) {

	/**
	 * automatic updater init
	 */

	require_once( get_stylesheet_directory() . '/inc/UpThemes_Theme_Updater.php' );

	// Define variables for our theme updates
	define('UPTHEMES_LICENSE_KEY','cupertino_theme');
	define('UPTHEMES_ITEM_NAME', 'Cupertino Theme');
	define('UPTHEMES_STORE_URL', 'https://upthemes.com');

	/**
	 * Check for available theme updates
	 *
	 */
	function cupertino_theme_update_check(){

		$upthemes_license = trim( get_option( UPTHEMES_LICENSE_KEY ) );

		$edd_updater = new UpThemes_Theme_Updater(
			array(
				'remote_api_url'  => UPTHEMES_STORE_URL,  // Our store URL that is running EDD
				'license'         => $upthemes_license, // The license key (used get_option above to retrieve from DB)
				'item_name'       => UPTHEMES_ITEM_NAME,  // The name of this theme
				'author'          => 'UpThemes'
			)
		);
	}
	add_action('admin_init','cupertino_theme_update_check',1);

	/* end automatic updater init script */

	require_once( get_stylesheet_directory() . '/options/options.php' );
	require_once( get_stylesheet_directory() . '/inc/theme-options.php' );
	require_once( get_stylesheet_directory() . '/inc/style-generator.php' );

}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function cupertino_setup() {

}

add_action('after_setup_theme','cupertino_setup');

/**
 * Enqueue the scripts and styles for Cupertino
 *
 * Sets up all the assets required for the theme to function properly.
 */
function cupertino_enqueue_scripts(){

	// Adds Google webfonts fonts to theme.
	wp_enqueue_style( 'cupertino-fonts', cupertino_fonts_url() );

	// Add Genericons font, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/assets/fonts/genericons.css', array(), '2.09' );

	// Load the Genesis CSS file.
	wp_enqueue_style( 'genesis-style', get_template_directory_uri() .'/style.css' );

	// Load the custom theme CSS file.
	wp_enqueue_style( 'cupertino-style', get_stylesheet_uri(), array('genesis-style') );

}

add_action('wp_enqueue_scripts','cupertino_enqueue_scripts');