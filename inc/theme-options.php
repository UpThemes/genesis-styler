<?php

$header = array(
	"name" => "header",
	"title" => __("Header",'easystyle'),
	'sections' => array(
		'header' => array(
			'name' => 'header',
			'title' => __( 'Header', 'easystyle' ),
			'description' => __( 'Header design options.','easystyle' )
		),
	)
);

register_theme_option_tab($header);

$colors = array(
	"name" => "colors",
	"title" => __("Colors",'easystyle'),
	'sections' => array(
		'colors' => array(
			'name' => 'colors',
			'title' => __( 'Colors', 'easystyle' ),
			'description' => __( 'Custom colors for this theme.','easystyle' )
		),
	)
);

register_theme_option_tab($colors);

$fonts = array(
	"name" => "fonts",
	"title" => __("Fonts",'easystyle'),
	'sections' => array(
		'fonts' => array(
			'name' => 'fonts',
			'title' => __( 'Fonts', 'easystyle' ),
			'description' => __( 'Custom fonts served from <a target="_blank" href="http://google.com/fonts">Google Web Fonts</a>. Keep in mind, the more fonts you use, the heavier load you are putting on your website visitors. Try to limit your selection to 2 font families, if possible. If you need more advanced custom font selection, check out <a href="http://wordpress.org/plugins/typecase/">Typecase</a>','easystyle' )
		),
	)
);

register_theme_option_tab($fonts);

$header_padding_options = array(
	"10px" => array(
		"name" => "10px",
		"title" => __( "10px", "easystyle" )
	),
	"20px" => array(
		"name" => "20px",
		"title" => __( "20px", "easystyle" )
	),
	"30px" => array(
		"name" => "30px",
		"title" => __( "30px", "easystyle" )
	),
	"40px" => array(
		"name" => "40px",
		"title" => __( "40px", "easystyle" )
	),
	"50px" => array(
		"name" => "50px",
		"title" => __( "50px", "easystyle" )
	),
	"60px" => array(
		"name" => "60px",
		"title" => __( "60px", "easystyle" )
	),
	"70px" => array(
		"name" => "70px",
		"title" => __( "70px", "easystyle" )
	),
	"80px" => array(
		"name" => "80px",
		"title" => __( "80px", "easystyle" )
	),
	"90px" => array(
		"name" => "90px",
		"title" => __( "90px", "easystyle" )
	),
	"100px" => array(
		"name" => "100px",
		"title" => __( "100px", "easystyle" )
	),
	"110px" => array(
		"name" => "110px",
		"title" => __( "110px", "easystyle" )
	),
	"120px" => array(
		"name" => "120px",
		"title" => __( "120px", "easystyle" )
	),
	"130px" => array(
		"name" => "130px",
		"title" => __( "130px", "easystyle" )
	),
	"140px" => array(
		"name" => "140px",
		"title" => __( "140px", "easystyle" )
	),
);

$custom_header_options = array(
	"site_header_padding_top" => array(
		"tab" => "header",
		"name" => "site_header_padding_top",
		"title" => "Header Top Padding",
		"description" => __( "Padding for the top of your header area.", 'easystyle' ),
		"section" => "header",
		"since" => "1.0",
		"id" => "header",
		"type" => "select",
		"default" => "20px",
		"valid_options" => $header_padding_options,
	),
	"site_header_padding_bottom" => array(
		"tab" => "header",
		"name" => "site_header_padding_bottom",
		"title" => "Header Bottom Padding",
		"description" => __( "Padding for the bottom of your header area.", 'easystyle' ),
		"section" => "header",
		"since" => "1.0",
		"id" => "header",
		"type" => "select",
		"default" => "20px",
		"valid_options" => $header_padding_options,
	),
	"site_header_background_image" => array(
		"tab" => "header",
		"name" => "site_header_background_image",
		"title" => "Background Image",
		"description" => __( "Header area background image.", 'easystyle' ),
		"section" => "header",
		"since" => "1.0",
		"id" => "header",
		"type" => "upload",
		"default" => includes_url( '/images/blank.gif' )
	),
);
register_theme_options($custom_header_options);

/**
 * Custom color options.
 */
$custom_hex_colors = array(
	"site_header_background_color" => array(
		"tab" => "colors",
		"name" => "site_header_background_color",
		"title" => "Site Header Background Color",
		"description" => __( "Select a color for the site header background.", 'easystyle' ),
		"section" => "colors",
		"since" => "1.0",
		"id" => "colors",
		"type" => "color",
		"default" => "#ffffff",
	),
	"site_footer_background_color" => array(
		"tab" => "colors",
		"name" => "site_footer_background_color",
		"title" => "Site Footer Background Color",
		"description" => __( "Select a color for the site footer background.", 'easystyle' ),
		"section" => "colors",
		"since" => "1.0",
		"id" => "colors",
		"type" => "color",
		"default" => "#ffffff",
	),
	"site_footer_widget_area_background_color" => array(
		"tab" => "colors",
		"name" => "site_footer_widget_area_background_color",
		"title" => "Site Footer Widget Area Background Color",
		"description" => __( "Select a color for the site footer background widget area.", 'easystyle' ),
		"section" => "colors",
		"since" => "1.0",
		"id" => "colors",
		"type" => "color",
		"default" => "#333333",
	),
	"primary_menu_background_color" => array(
		"tab" => "colors",
		"name" => "primary_menu_background_color",
		"title" => "Primary Menu Background Color",
		"description" => __( "Select your background color for the primary menu.", 'easystyle' ),
		"section" => "colors",
		"since" => "1.0",
		"id" => "colors",
		"type" => "color",
		"default" => "#333333",
	),
	"entry_background_color" => array(
		"tab" => "colors",
		"name" => "entry_background_color",
		"title" => "Entry Background Color",
		"description" => __( "Select a background color for post entries.", 'easystyle' ),
		"section" => "colors",
		"since" => "1.0",
		"id" => "colors",
		"type" => "color",
		"default" => "#ffffff",
	),
	"primary_link_color" => array(
		"tab" => "colors",
		"name" => "primary_link_color",
		"title" => "Primary Link Color",
		"description" => __( "Select a color for primary links.", 'easystyle' ),
		"section" => "colors",
		"since" => "1.0",
		"id" => "colors",
		"type" => "color",
		"default" => "#f15123",
	),
);

register_theme_options($custom_hex_colors);

$font_families = array(
	"Asap" => array(
		"name" => "Asap",
		"title" => __( "Asap", "easystyle" )
	),
	"Lato" => array(
		"name" => "Lato",
		"title" => __( "Lato", "easystyle" )
	),
	"Merriweather" => array(
		"name" => "Merriweather",
		"title" => __( "Merriweather", "easystyle" )
	),
	"Oswald" => array(
		"name" => "Oswald",
		"title" => __( "Oswald", "easystyle" )
	),
	"Open Sans" => array(
		"name" => "Open Sans",
		"title" => __( "Open Sans", "easystyle" )
	),
	"Roboto" => array(
		"name" => "Roboto",
		"title" => __( "Roboto", "easystyle" )
	),
	"Droid Sans" => array(
		"name" => "Droid Sans",
		"title" => __( "Droid Sans", "easystyle" )
	),
	"PT Sans" => array(
		"name" => "PT Sans",
		"title" => __( "PT Sans", "easystyle" )
	),
	"Source Sans Pro" => array(
		"name" => "Source Sans Pro",
		"title" => __( "Source Sans Pro", "easystyle" )
	),
	"Droid Serif" => array(
		"name" => "Droid Serif",
		"title" => __( "Droid Serif", "easystyle" )
	),
	"Lora" => array(
		"name" => "Lora",
		"title" => __( "Lora", "easystyle" )
	),
	"Arvo" => array(
		"name" => "Arvo",
		"title" => __( "Arvo", "easystyle" )
	),
	"Bitter" => array(
		"name" => "Bitter",
		"title" => __( "Bitter", "easystyle" )
	),
	"Playfair Display" => array(
		"name" => "Playfair Display",
		"title" => __( "Playfair Display", "easystyle" )
	),
	"Vollkorn" => array(
		"name" => "Vollkorn",
		"title" => __( "Vollkorn", "easystyle" )
	),
	"Libre Baskerville" => array(
		"name" => "Libre Baskerville",
		"title" => __( "Libre Baskerville", "easystyle" )
	),
	"Alegreya" => array(
		"name" => "Alegreya",
		"title" => __( "Alegreya", "easystyle" )
	),
	"Kreon" => array(
		"name" => "Kreon",
		"title" => __( "Kreon", "easystyle" )
	),
	"Crimson Text" => array(
		"name" => "Crimson Text",
		"title" => __( "Crimson Text", "easystyle" )
	),
	"Josefin Slab" => array(
		"name" => "Josefin Slab",
		"title" => __( "Josefin Slab", "easystyle" )
	),
	"EB Garamond" => array(
		"name" => "EB Garamond",
		"title" => __( "EB Garamond", "easystyle" )
	),
	"Domine" => array(
		"name" => "Domine",
		"title" => __( "Domine", "easystyle" )
	),
	"Copse" => array(
		"name" => "Copse",
		"title" => __( "Copse", "easystyle" )
	),
	"Neuton" => array(
		"name" => "Neuton",
		"title" => __( "Neuton", "easystyle" )
	),
);

/**
 * Custom color options.
 */
$custom_fonts = array(
	"body_text_font_family" => array(
		"tab" => "fonts",
		"name" => "body_text_font_family",
		"title" => "Body Font Family",
		"description" => __( "Select a font family for your body text.", 'easystyle' ),
		"section" => "fonts",
		"since" => "1.0",
		"id" => "fonts",
		"type" => "select",
		"default" => "Lato",
		"valid_options" => $font_families,
	),
	"body_font_size" => array(
		"tab" => "fonts",
		"name" => "body_font_size",
		"title" => "Body Font Size",
		"description" => __( "Select a base font size.", 'easystyle' ),
		"section" => "fonts",
		"since" => "1.0",
		"id" => "fonts",
		"type" => "select",
		"default" => "1.6rem",
		"valid_options" => array(
			"1rem" => array(
				"name" => "1rem",
				"title" => __( "1rem", "easystyle" )
			),
			"1.1rem" => array(
				"name" => "1.1rem",
				"title" => __( "1.1rem", "easystyle" )
			),
			"1.2rem" => array(
				"name" => "1.2rem",
				"title" => __( "1.2rem", "easystyle" )
			),
			"1.3rem" => array(
				"name" => "1.3rem",
				"title" => __( "1.3rem", "easystyle" )
			),
			"1.4rem" => array(
				"name" => "1.4rem",
				"title" => __( "1.4rem", "easystyle" )
			),
			"1.5rem" => array(
				"name" => "1.5rem",
				"title" => __( "1.5rem", "easystyle" )
			),
			"1.6rem" => array(
				"name" => "1.6rem",
				"title" => __( "1.6rem", "easystyle" )
			),
			"1.7rem" => array(
				"name" => "1.7rem",
				"title" => __( "1.7rem", "easystyle" )
			),
			"1.8rem" => array(
				"name" => "1.8rem",
				"title" => __( "1.8rem", "easystyle" )
			),
			"1.9rem" => array(
				"name" => "1.9rem",
				"title" => __( "1.9rem", "easystyle" )
			),
			"2rem" => array(
				"name" => "2rem",
				"title" => __( "2rem", "easystyle" )
			),
		),
	),
	"heading_text_font_family" => array(
		"tab" => "fonts",
		"name" => "heading_text_font_family",
		"title" => "Heading Font Family",
		"description" => __( "Select a font family for your body text.", 'easystyle' ),
		"section" => "fonts",
		"since" => "1.0",
		"id" => "fonts",
		"type" => "select",
		"default" => "Lato",
		"valid_options" => $font_families,
	),
	"primary_menu_font_family" => array(
		"tab" => "fonts",
		"name" => "primary_menu_font_family",
		"title" => "Primary Menu Font Family",
		"description" => __( "Select a font family for your menu text.", 'easystyle' ),
		"section" => "fonts",
		"since" => "1.0",
		"id" => "fonts",
		"type" => "select",
		"default" => "Lato",
		"valid_options" => $font_families,
	),
	"primary_menu_font_size" => array(
		"tab" => "fonts",
		"name" => "primary_menu_font_size",
		"title" => "Primary Menu Font Size",
		"description" => __( "Select a base font size for your primary menu.", 'easystyle' ),
		"section" => "fonts",
		"since" => "1.0",
		"id" => "fonts",
		"type" => "select",
		"default" => "1rem",
		"valid_options" => array(
			".6rem" => array(
				"name" => ".6rem",
				"title" => __( ".6rem", "easystyle" )
			),
			".7rem" => array(
				"name" => ".7rem",
				"title" => __( ".7rem", "easystyle" )
			),
			".8rem" => array(
				"name" => ".8rem",
				"title" => __( ".8rem", "easystyle" )
			),
			".9rem" => array(
				"name" => ".9rem",
				"title" => __( ".9rem", "easystyle" )
			),
			"1rem" => array(
				"name" => "1rem",
				"title" => __( "1rem", "easystyle" )
			),
			"1.1rem" => array(
				"name" => "1.1rem",
				"title" => __( "1.1rem", "easystyle" )
			),
			"1.2rem" => array(
				"name" => "1.2rem",
				"title" => __( "1.2rem", "easystyle" )
			),
			"1.3rem" => array(
				"name" => "1.3rem",
				"title" => __( "1.3rem", "easystyle" )
			),
			"1.4rem" => array(
				"name" => "1.4rem",
				"title" => __( "1.4rem", "easystyle" )
			),
			"1.5rem" => array(
				"name" => "1.5rem",
				"title" => __( "1.5rem", "easystyle" )
			),
			"1.6rem" => array(
				"name" => "1.6rem",
				"title" => __( "1.6rem", "easystyle" )
			),
			"1.7rem" => array(
				"name" => "1.7rem",
				"title" => __( "1.7rem", "easystyle" )
			),
			"1.8rem" => array(
				"name" => "1.8rem",
				"title" => __( "1.8rem", "easystyle" )
			),
			"1.9rem" => array(
				"name" => "1.9rem",
				"title" => __( "1.9rem", "easystyle" )
			),
			"2rem" => array(
				"name" => "2rem",
				"title" => __( "2rem", "easystyle" )
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
function easystyle_fonts_url() {

	$up_options = upfw_get_options();

	$body_font = $up_options->body_text_font_family;
	$heading_font = $up_options->heading_text_font_family;
	$primary_menu_font = $up_options->primary_menu_font_family;

	if ( $body_font || $heading_font ) {
		$font_families = array();

		if ( $body_font )
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
function easystyle_enqueue_fonts(){
	if ( ! is_admin() ){
		wp_enqueue_style('easystyle-fonts', easystyle_fonts_url(), false );
	}
}

add_action('wp_enqueue_scripts','easystyle_enqueue_fonts',9999);