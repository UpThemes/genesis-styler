<?php

$appearance = array(
	"name" => "appearance",
	"title" => __("Appearance",'cupertino'),
	'sections' => array(
		'general' => array(
			'name' => 'general',
			'title' => __( 'General', 'cupertino' ),
			'description' => __( 'General settings for this theme\'s color settings.','cupertino' )
		),
		'colors' => array(
			'name' => 'colors',
			'title' => __( 'Colors', 'cupertino' ),
			'description' => __( 'Custom colors for this theme.','cupertino' )
		),
		'fonts' => array(
			'name' => 'fonts',
			'title' => __( 'Fonts', 'cupertino' ),
			'description' => __( 'Custom fonts served from <a target="_blank" href="http://google.com/fonts">Google Web Fonts</a>. Keep in mind, the more fonts you use, the heavier load you are putting on your website visitors. Try to limit your selection to 2 font families, if possible.','cupertino' )
		),
	)
);

register_theme_option_tab($appearance);

/**
 * Custom color options.
 */
$custom_hex_colors = array(
	"site_header_background_color" => array(
		"tab" => "appearance",
		"name" => "site_header_background_color",
		"title" => "Site Header Background Color",
		"description" => __( "Select a color for the site header background.", 'cupertino' ),
		"section" => "colors",
		"since" => "1.0",
		"id" => "colors",
		"type" => "color",
		"default" => "#ffffff",
	),
	"site_footer_background_color" => array(
		"tab" => "appearance",
		"name" => "site_footer_background_color",
		"title" => "Site Footer Background Color",
		"description" => __( "Select a color for the site footer background.", 'cupertino' ),
		"section" => "colors",
		"since" => "1.0",
		"id" => "colors",
		"type" => "color",
		"default" => "#ffffff",
	),
	"primary_menu_background_color" => array(
		"tab" => "appearance",
		"name" => "primary_menu_background_color",
		"title" => "Primary Menu Background Color",
		"description" => __( "Select your background color for the primary menu.", 'cupertino' ),
		"section" => "colors",
		"since" => "1.0",
		"id" => "colors",
		"type" => "color",
		"default" => "#333333",
	),
	"entry_background_color" => array(
		"tab" => "appearance",
		"name" => "entry_background_color",
		"title" => "Entry Background Color",
		"description" => __( "Select a background color for post entries.", 'cupertino' ),
		"section" => "colors",
		"since" => "1.0",
		"id" => "colors",
		"type" => "color",
		"default" => "#ffffff",
	),
	"primary_link_color" => array(
		"tab" => "appearance",
		"name" => "primary_link_color",
		"title" => "Primary Link Color",
		"description" => __( "Select a color for primary links.", 'cupertino' ),
		"section" => "colors",
		"since" => "1.0",
		"id" => "colors",
		"type" => "color",
		"default" => "#f15123",
	),
);

register_theme_options($custom_hex_colors);

$font_families = array(
	"Lato" => array(
		"name" => "Lato",
		"title" => __( "Lato", "cupertino" )
	),
	"Merriweather" => array(
		"name" => "Merriweather",
		"title" => __( "Merriweather", "cupertino" )
	),
	"Oswald" => array(
		"name" => "Oswald",
		"title" => __( "Oswald", "cupertino" )
	),
	"Open Sans" => array(
		"name" => "Open Sans",
		"title" => __( "Open Sans", "cupertino" )
	),
	"Roboto" => array(
		"name" => "Roboto",
		"title" => __( "Roboto", "cupertino" )
	),
	"Droid Sans" => array(
		"name" => "Droid Sans",
		"title" => __( "Droid Sans", "cupertino" )
	),
	"PT Sans" => array(
		"name" => "PT Sans",
		"title" => __( "PT Sans", "cupertino" )
	),
	"Source Sans Pro" => array(
		"name" => "Source Sans Pro",
		"title" => __( "Source Sans Pro", "cupertino" )
	),
	"Droid Serif" => array(
		"name" => "Droid Serif",
		"title" => __( "Droid Serif", "cupertino" )
	),
	"Lora" => array(
		"name" => "Lora",
		"title" => __( "Lora", "cupertino" )
	),
	"Arvo" => array(
		"name" => "Arvo",
		"title" => __( "Arvo", "cupertino" )
	),
	"Bitter" => array(
		"name" => "Bitter",
		"title" => __( "Bitter", "cupertino" )
	),
	"Playfair Display" => array(
		"name" => "Playfair Display",
		"title" => __( "Playfair Display", "cupertino" )
	),
	"Vollkorn" => array(
		"name" => "Vollkorn",
		"title" => __( "Vollkorn", "cupertino" )
	),
	"Libre Baskerville" => array(
		"name" => "Libre Baskerville",
		"title" => __( "Libre Baskerville", "cupertino" )
	),
	"Alegreya" => array(
		"name" => "Alegreya",
		"title" => __( "Alegreya", "cupertino" )
	),
	"Kreon" => array(
		"name" => "Kreon",
		"title" => __( "Kreon", "cupertino" )
	),
	"Crimson Text" => array(
		"name" => "Crimson Text",
		"title" => __( "Crimson Text", "cupertino" )
	),
	"Josefin Slab" => array(
		"name" => "Josefin Slab",
		"title" => __( "Josefin Slab", "cupertino" )
	),
	"EB Garamond" => array(
		"name" => "EB Garamond",
		"title" => __( "EB Garamond", "cupertino" )
	),
	"Domine" => array(
		"name" => "Domine",
		"title" => __( "Domine", "cupertino" )
	),
	"Copse" => array(
		"name" => "Copse",
		"title" => __( "Copse", "cupertino" )
	),
	"Neuton" => array(
		"name" => "Neuton",
		"title" => __( "Neuton", "cupertino" )
	),
);

/**
 * Custom color options.
 */
$custom_fonts = array(
	"body_text_font_family" => array(
		"tab" => "appearance",
		"name" => "body_text_font_family",
		"title" => "Body Font Family",
		"description" => __( "Select a font family for your body text.", 'cupertino' ),
		"section" => "fonts",
		"since" => "1.0",
		"id" => "fonts",
		"type" => "select",
		"default" => "Lato",
		"valid_options" => $font_families,
	),
	"body_font_size" => array(
		"tab" => "appearance",
		"name" => "body_font_size",
		"title" => "Body Font Size",
		"description" => __( "Select a base font size.", 'cupertino' ),
		"section" => "fonts",
		"since" => "1.0",
		"id" => "fonts",
		"type" => "select",
		"default" => "1.6rem",
		"valid_options" => array(
			"1.3rem" => array(
				"name" => "1.3rem",
				"title" => __( "1.3rem", "cupertino" )
			),
			"1.4rem" => array(
				"name" => "1.4rem",
				"title" => __( "1.4rem", "cupertino" )
			),
			"1.5rem" => array(
				"name" => "1.5rem",
				"title" => __( "1.5rem", "cupertino" )
			),
			"1.6rem" => array(
				"name" => "1.6rem",
				"title" => __( "1.6rem", "cupertino" )
			),
			"1.7rem" => array(
				"name" => "1.7rem",
				"title" => __( "1.7rem", "cupertino" )
			),
			"1.8rem" => array(
				"name" => "1.8rem",
				"title" => __( "1.8rem", "cupertino" )
			),
			"1.9rem" => array(
				"name" => "1.9rem",
				"title" => __( "1.9rem", "cupertino" )
			),
			"2rem" => array(
				"name" => "2rem",
				"title" => __( "2rem", "cupertino" )
			),
		),
	),
	"heading_text_font_family" => array(
		"tab" => "appearance",
		"name" => "heading_text_font_family",
		"title" => "Heading Font Family",
		"description" => __( "Select a font family for your body text.", 'cupertino' ),
		"section" => "fonts",
		"since" => "1.0",
		"id" => "fonts",
		"type" => "select",
		"default" => "Lato",
		"valid_options" => $font_families,
	),
	"primary_menu_font_family" => array(
		"tab" => "appearance",
		"name" => "primary_menu_font_family",
		"title" => "Primary Menu Font Family",
		"description" => __( "Select a font family for your menu text.", 'cupertino' ),
		"section" => "fonts",
		"since" => "1.0",
		"id" => "fonts",
		"type" => "select",
		"default" => "Lato",
		"valid_options" => $font_families,
	),
	"primary_menu_font_size" => array(
		"tab" => "appearance",
		"name" => "primary_menu_font_size",
		"title" => "Primary Menu Font Size",
		"description" => __( "Select a base font size for your primary menu.", 'cupertino' ),
		"section" => "fonts",
		"since" => "1.0",
		"id" => "fonts",
		"type" => "select",
		"default" => "1rem",
		"valid_options" => array(
			".6rem" => array(
				"name" => ".6rem",
				"title" => __( ".6rem", "cupertino" )
			),
			".7rem" => array(
				"name" => ".7rem",
				"title" => __( ".7rem", "cupertino" )
			),
			".8rem" => array(
				"name" => ".8rem",
				"title" => __( ".8rem", "cupertino" )
			),
			".9rem" => array(
				"name" => ".9rem",
				"title" => __( ".9rem", "cupertino" )
			),
			"1rem" => array(
				"name" => "1rem",
				"title" => __( "1rem", "cupertino" )
			),
			"1.1rem" => array(
				"name" => "1.1rem",
				"title" => __( "1.1rem", "cupertino" )
			),
			"1.2rem" => array(
				"name" => "1.2rem",
				"title" => __( "1.2rem", "cupertino" )
			),
			"1.3rem" => array(
				"name" => "1.3rem",
				"title" => __( "1.3rem", "cupertino" )
			),
			"1.4rem" => array(
				"name" => "1.4rem",
				"title" => __( "1.4rem", "cupertino" )
			),
			"1.5rem" => array(
				"name" => "1.5rem",
				"title" => __( "1.5rem", "cupertino" )
			),
			"1.6rem" => array(
				"name" => "1.6rem",
				"title" => __( "1.6rem", "cupertino" )
			),
			"1.7rem" => array(
				"name" => "1.7rem",
				"title" => __( "1.7rem", "cupertino" )
			),
			"1.8rem" => array(
				"name" => "1.8rem",
				"title" => __( "1.8rem", "cupertino" )
			),
			"1.9rem" => array(
				"name" => "1.9rem",
				"title" => __( "1.9rem", "cupertino" )
			),
			"2rem" => array(
				"name" => "2rem",
				"title" => __( "2rem", "cupertino" )
			),
		),
	),
);

register_theme_options($custom_fonts);

/**
 * Returns the Google font stylesheet URL, if available.
 *
 * The use of Source Sans Pro and Bitter by default is localized. For languages
 * that use characters not supported by the font, the font can be disabled.
 *
 * @return string Font stylesheet or empty string if disabled.
 */
function cupertino_fonts_url() {

	$up_options = upfw_get_options();

	$body_font = $up_options->body_text_font_family;
	$heading_font = $up_options->heading_text_font_family;
	$primary_menu_font = $up_options->primary_menu_font_family;

	if ( $body_font || $heading_font ) {
		$font_families = array();

		if ( $body_font !== 'lato' )
			$font_families[] = $body_font;

		if ( $heading_font )
			$font_families[] = $heading_font . ":700";

		if( $primary_menu_font )
			$font_families[] = $primary_menu_font;

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);
		$fonts_url = add_query_arg( $query_args, "//fonts.googleapis.com/css" );
	}

	return $fonts_url;
}

/**
 * Enqueue custom fonts
 *
 * @uses wp_enqueue_style()
 */
function cupertino_enqueue_fonts(){
	if ( ! is_admin() ){
		wp_enqueue_style('cupertino-fonts', cupertino_fonts_url(), false );
	}
}

add_action('wp_enqueue_scripts','cupertino_enqueue_fonts',9999);