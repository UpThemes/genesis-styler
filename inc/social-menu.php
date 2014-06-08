<?php

/**
 * Register our social icon menu
 *
 */
function cupertino_social_nav_menus() {
	register_nav_menu( 'social', __( 'Social', 'cupertino' ) );
}

add_action( 'init', 'cupertino_social_nav_menus' );