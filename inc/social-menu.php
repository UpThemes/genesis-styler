<?php

/**
 * Register our social icon menu
 *
 */
function easystyle_social_nav_menus() {
	register_nav_menu( 'social', __( 'Social', 'easystyle' ) );
}

add_action( 'init', 'easystyle_social_nav_menus' );