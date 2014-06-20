<?php

/**
* Create a sub-page to explain this theme.
*
* @uses add_submenu_page()
*
* @return void
*
* @since 0.1
*/
function gstyler_info_menu() {
		add_menu_page('Genesis Styler Theme Info', 'Genesis Styler Info', 'manage_options', 'gstyler_theme', 'gstyler_theme_page','dashicons-welcome-widgets-menus');
}
add_action('admin_menu', 'gstyler_info_menu');

/**
* Display a page with info on this theme.
*
*
* @return void
*
* @since 0.1
*/
function gstyler_theme_page() {
	?>
	<div class="wrap">
	<?php

	$readme = wp_remote_get( trailingslashit( get_stylesheet_directory_uri() ) . 'README.html' );

	echo $readme['body'];

	?>
	</div>
	<?php
}