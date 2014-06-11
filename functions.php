<?php
/**
* Easy Style functions and definitions
*
* Sets up the theme and provides some helper functions. Some helper functions
* are used in the theme as custom template tags. Others are attached to action and
* filter hooks in WordPress to change core functionality.
*
* The first function, easystyle_setup(), sets up the theme by registering support
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
* @package Easy Style
*/

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function easystyle_setup() {
	$easystyle = wp_get_theme();

	//* Child theme (do not remove)
	define( 'CHILD_THEME_NAME', 'Easy Style' );
	define( 'CHILD_THEME_URL', 'https://upthemes.com/themes/easystyle/' );
	define( 'CHILD_THEME_VERSION', $easystyle->get( 'Version' ) );

	//* Remove our default theme options page and just use the Theme Customizer instead
	//define( 'UPFW_NO_THEME_OPTIONS_PAGE', true );

	//* Add HTML5 markup structure
	add_theme_support( 'html5' );

	//* Add viewport meta tag for mobile browsers
	add_theme_support( 'genesis-responsive-viewport' );

	//* Add support for custom background
	add_theme_support( 'custom-background' );

	//* Add support for 3-column footer widgets
	add_theme_support( 'genesis-footer-widgets', 3 );

	//* Enqueue the scripts and styles for Easy Style.
	add_action( 'wp_enqueue_scripts', 'easystyle_enqueue_scripts' );

	//* Include required files for Easy Style.
	easystyle_includes();
}
add_action( 'genesis_setup', 'easystyle_setup', 15 );

/**
 * Include required files for Easy Style
 */
function easystyle_includes() {
	$options_dir  = trailingslashit( get_stylesheet_directory() . '/options' );
	$includes_dir = trailingslashit( get_stylesheet_directory() . '/inc' );

	if ( ! file_exists( $options_dir . 'options.php' ) || ! file_exists( $includes_dir . 'theme-options.php' ) ) {
		return;
	}

	/* end automatic updater init script */
	require_once( $options_dir  . 'options.php' );
	require_once( $includes_dir . 'theme-options.php' );
	require_once( $includes_dir . 'theme-info.php' );
	require_once( $includes_dir . 'style-generator.php' );
}

/**
 * Enqueue the scripts and styles for Easy Style
 *
 * Sets up all the assets required for the theme to function properly.
 */
function easystyle_enqueue_scripts() {
	// Adds Google webfonts fonts to theme.
	wp_enqueue_style( 'easystyle-fonts', easystyle_fonts_url() );

	// Add Genericons font, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/assets/fonts/genericons.css', array(), '2.09' );

	// Load the Genesis CSS file.
	wp_enqueue_style( 'genesis-style', get_template_directory_uri() .'/style.css' );

	// Load the custom theme CSS file.
	wp_enqueue_style( 'easystyle-style', get_stylesheet_uri(), array('genesis-style') );
}
