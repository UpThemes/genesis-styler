<?php

/**
 * Add CSS mime type to allowed upload mime types.
 *
 * @since 1.0.0
 */
function easystyle_custom_upload_mimes( $existing_mimes ) {
	// add webm to the list of mime types
	$existing_mimes['css'] = 'text/css';

	// return the array back to the function with our added mime type
	return $existing_mimes;
}
add_filter( 'upload_mimes', 'easystyle_custom_upload_mimes' );

/**
 * Checks to see if the image is valid.
 *
 *
 * @since 1.0.0
 *
 * @uses 	getimagesize() 	Quick way to check for existence of image.
 *
 * @return 	boolean			existence of image
 */
function easystyle_is_valid_image( $img ){
	if( preg_match("/\.(jpeg|jpg|png|gif)$/",$img) )
    if( ! isset( $img ) || ! getimagesize( $img ) ){
        return false;
    }else{
        return true;
    }
}

/**
 * Adds body class if header image exists
 *
 * @since 1.0.0
 */
function easystyle_add_header_image_body_class(){
	$up_options = upfw_get_options();

	if( strpos( $up_options->site_header_background_image, 'blank.gif' ) === false && easystyle_is_valid_image( $up_options->site_header_background_image ) ){
		add_filter('body_class',
			function( $body_classes ){
				$body_classes[] = 'has-header-bg-image';
				return $body_classes;
			});
	}
}

add_action('init','easystyle_add_header_image_body_class');

/**
 * Generates SCSS variables for custom colors.
 *
 * @since 1.0.0
 */
function easystyle_update_custom_color_vars( $variables ) {

	$up_options = upfw_get_options();

	foreach( $up_options as $key => $variable ) {

		if( easystyle_is_valid_image( $variable ) ){
			$variable = "'" . $variable . "'";
		}

		if( ! empty( $variable ) ){
			$scss_variable = '$' . $key . ':' . $variable . ';';
			$variables .= $scss_variable;
		}
	}

	return $variables;

}

add_filter( 'easystyle_style_variables','easystyle_update_custom_color_vars' );

/**
 * Register our custom preview CSS function in the customizer preview footer.
 *
 * @since 1.0.0
 */
function easystyle_customize_register($wp_customize) {
	$up_options = upfw_get_options();

	if ( $wp_customize->is_preview() && ! is_admin() ) {
	    add_action( 'wp_footer', 'easystyle_customize_preview', 21);
	}

}
add_action( 'customize_register', 'easystyle_customize_register' );

/**
 * Output customizer preview CSS.
 *
 * @since 1.0.0
 */
function easystyle_customize_preview() {
	$up_options = upfw_get_options();

	$styles = easystyle_css_regenerate( 'inline' );
	echo '<style type="text/css" id="custom-styles">';
	echo $styles;
	echo '</style>';

	echo '<script type="text/javascript">';
	echo 'parent.preview_loaded();';
	echo '</script>';
}

/**
 * Success message when CSS file is saved.
 *
 * @since 1.0.0
 */
function easystyle_customizations_saved_notice() {
    ?>
    <div class="updated">
        <p><?php _e( 'Your custom theme styles were saved and a new CSS file was generated successfully.', 'easystyle' ); ?></p>
    </div>
    <?php
}

/**
 * Error message when CSS file cannot be saved.
 *
 * @since 1.0.0
 */
function easystyle_customizations_not_saved_notice() {
	global $easystyle_error;
    ?>
    <div class="error">
    	<?php if ( $easystyle_error ) : ?>
    		<p><?php echo $easystyle_error; ?>
    	<?php else: ?>
        	<p><?php _e( 'Your custom theme styles were not saved. Please check your settings and try again.', 'easystyle' ); ?></p>
        <?php endif; ?>
    </div>
    <?php
}

/**
 * Regenerate CSS stylesheet.
 *
 * @since 1.0.0
 *
 * @param string $format file|inline 	Either creates a new file in the uploads folder
 * 										or outputs CSS inline.
 */
function easystyle_css_regenerate( $format = 'file' ) {

	try {

		require get_stylesheet_directory() . "/inc/scssphp/scss.inc.php";
		require get_stylesheet_directory() . "/inc/scssphp-compass/compass.inc.php";

		$base_import_path = apply_filters( 'easystyle_base_import_path', get_stylesheet_directory() . '/assets/scss/' );

		$scss = new scssc();
		$scss->setImportPaths($base_import_path);

		new scss_compass($scss);

		$scss->setFormatter("scss_formatter");

		$style_overrides = apply_filters( 'easystyle_style_variables','' );
		$style_scss_imports = apply_filters( 'easystyle_style_scss_imports',"@import 'style.scss';" );

		$style_content = $scss->compile("
			$style_overrides
			$style_scss_imports
		");

		$old_file = get_option( 'easystyle-style-override' );

		if ( $format === 'file' ) {

			if ( $old_file['file'] && file_exists( $old_file['file'] ) ) {

				unlink( $old_file['file'] );

			}

			if ( $style_scss = wp_upload_bits( 'style.css',null,$style_content) ) {

				$style_scss['date'] = date( 'Y-m-d' );

				$updated = update_option( 'easystyle-style-override',$style_scss);

				if ( isset( $updated ) ) {
					add_action( 'admin_notices', 'easystyle_customizations_saved_notice' );
				} else {
					global $easystyle_error;
					$easystyle_error = __( 'The option could not be saved.','easystyle' );
					add_action( 'admin_notices', 'easystyle_customizations_not_saved_notice' );
				}

			} else {
				add_action( 'admin_notices', 'easystyle_customizations_not_saved_notice' );
			}

		} elseif ( $format === 'inline' ) {
			return $style_content;
		}

	} catch ( Exception $e ) {
		global $easystyle_error;
		$easystyle_error = $e->getMessage();
		add_action( 'admin_notices', 'easystyle_customizations_not_saved_notice' );
	}
}

/**
 * Save new stylesheet when Theme Options page is saved.
 *
 * @since 1.0.0
 */
function easystyle_options_save_regenerate_css() {
	$up_options = upfw_get_options();

	if ( isset($_GET['settings-updated']) && $_GET['settings-updated'] == 'true' ) {
		easystyle_css_regenerate();
	}
}

add_action( 'load-appearance_page_upfw-settings','easystyle_options_save_regenerate_css',1);

/**
 * Import background color for Compass config
 */
function easystyle_inject_bg_color($variables) {
	$bg_color = get_theme_mod( 'background_color' );

	if ( $bg_color ) {
		$variables .= '$site_background_color:#' . $bg_color . ';';
	}

	return $variables;
}
add_filter( 'easystyle_style_variables','easystyle_inject_bg_color' );

/**
 * Save new stylesheet when Theme Customizer is saved.
 *
 * @since 1.0.0
 */
function easystyle_customizer_save_regenerate_css() {
	easystyle_css_regenerate();
}

add_action( 'customize_save_after','easystyle_customizer_save_regenerate_css',1);

/**
 * Remove default stylesheet and enqueue new one.
 *
 * @since 1.0.0
 */
function easystyle_override_default_styles() {
	$up_options = upfw_get_options();
	$custom_style = get_option( 'easystyle-style-override' );

	if ( $custom_style ) {
		wp_dequeue_style( 'easystyle-style' );
		wp_enqueue_style( 'easystyle-style-override', $custom_style['url'], false, $custom_style['date'] );
	}
}

add_action( 'wp_enqueue_scripts', 'easystyle_override_default_styles',9999 );

/**
 * Initialize our custom theme option for color schemes.
 *
 * @since 1.0.0
 */
function easystyle_add_custom_theme_options() {
	global $pagenow;

	if ( $pagenow == 'themes.php' && !empty($_GET['page']) && $_GET['page'] == 'upfw-settings' ) {
		wp_enqueue_style( 'easystyle-color-schemes', get_template_directory_uri() . '/assets/css/color-schemes.css' );
		upfw_add_custom_field( 'colors','easystyle_colors' );
	}
}

add_action( 'admin_init','easystyle_add_custom_theme_options',1);

/**
 * Sanitize our color scheme input.
 *
 * @todo check against valid options.
 *
 * @since 1.0.0
 */
function easystyle_sanitize_color_scheme( $input ) {
	return $input;
}

add_filter( 'upfw_sanitize_colors', 'easystyle_sanitize_color_scheme' );

/**
 * Custom color scheme option for UpThemes Framework.
 *
 * @since 1.0.0
 */
function easystyle_colors( $value, $attr ) {
    global $wpdb;

    $selected = $value;

	echo '<div class="color-schemes">';

		if ( ! isset( $attr['valid_options'] ) ) {
			_e( 'This option has no valid options. Please create valid options as an array inside the UpThemes Framework.', 'upfw' );
			return;
		}
		$options = $attr['valid_options'];
		foreach( $options as $option ) {
		?>
			<label class="radio_image">
				<input type="radio" name="theme_<?php echo esc_attr( upfw_get_current_theme_id() ); ?>_options[<?php echo esc_attr( $attr['name'] ); ?>]" value="<?php echo esc_attr( $option['name'] ); ?>" <?php checked( $option['name'], $selected ); ?>>
				<div class="color-scheme-box table">
					<div class="row">
						<?php
						foreach( $option['colors'] as $colors => $value ) {
							echo "<div class='cell' style='background-color: $value;'></div>";
						}
						?>
					</div>
				</div>
			</label>
		<?php
		}

	echo '</div>';
}

/**
 * Register custom colors in the Theme Customizer.
 *
 * @since 1.0.0
 */
function upfw_customize_color_register($wp_customize) {

	/**
	 * Globalize the variable that holds
	 * the Settings Page tab definitions
	 *
	 * @global	array	Settings Page Tab definitions
	 */
	global $up_tabs;

	$upfw_options = upfw_get_options();

	$upfw_option_parameters = upfw_get_option_parameters();

	foreach( $upfw_option_parameters as $option ) {

		if ( $option['type'] != 'colors' ) {
			continue;
		}

		$optionname = $option['name'];
		$theme_id = upfw_get_current_theme_id();
		$optiondb = "theme_{$theme_id}_options[{$optionname}]";
		$option_section_name =  $option['section'];

		$wp_customize->add_setting( $optiondb, array(
			'default'		=> $option['default'],
			'type'			=> 'option',
			'capabilities'	=> 'edit_theme_options'
		) );

		$wp_customize->add_control(
			new UpThemes_Color_Scheme_Radio_Control (
				$wp_customize,
				$option['name'],
				array(
					'label'    => $option['title'],
					'section'  => $option_section_name,
					'settings' => $optiondb,
					'choices'  => upfw_extract_valid_options_radio_colors($option['valid_options'])
				)
			)
		);
	}
}

add_action( 'customize_register', 'upfw_customize_color_register' );

function enqueue_customizer_scripts() {
	wp_enqueue_style(
		'easystyle-color-schemes',
		get_stylesheet_directory_uri() . '/assets/css/color-schemes.css'
	);

	wp_enqueue_script(
		'easystyle-customize-theme',
		get_stylesheet_directory_uri() . '/assets/js/customize-theme.js'
	);
}
add_action( 'customize_controls_enqueue_scripts', 'enqueue_customizer_scripts' );

/**
 * Utility function to add color array to customizer option for preview.
 *
 * @since 1.0.0
 */
function upfw_extract_valid_options_radio_colors( $options ) {
	$new_options = array();
	foreach( $options as $option ) {
		$new_options[$option['name']] = array( 'title' => $option['title'], 'colors' => $option['colors'] );
	}
	return $new_options;
}

if ( class_exists( 'WP_Customize_Image_Control' ) && ! class_exists( 'UpThemes_Color_Scheme_Radio_Control' ) ) :

/**
 * Creates Customizer control for radio replacement images fields
 *
 * @since 1.0.0
 */
class UpThemes_Color_Scheme_Radio_Control extends WP_Customize_Control {

	public $type = 'colors_radio';

	public function render_content() {
		if ( empty( $this->choices ) ) {
			return;
		}

		?>

		<div class="color-schemes">

			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>

			<?php
			foreach ( $this->choices as $value => $choice ) {
				?>
				<label class="radio_image" for="<?php echo esc_html( $this->id ); ?>_<?php echo esc_html( $value ); ?>">
					<input id="<?php echo esc_html( $this->id ); ?>_<?php echo esc_html( $value ); ?>" class="image-radio" type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_html( $this->id ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?> />
					<div class="color-scheme-box table">
						<div class="row"><?php
						foreach( $choice['colors'] as $colors => $value ) {
							echo "<div class='cell' style='background-color: $value;'></div>";
						}
						?></div>
					</div>
				</label>
				<?php
			} // end foreach ?>

		</div>
		<?php

    }

	public function enqueue() {
		wp_enqueue_style(
			'easystyle-color-schemes',
			get_stylesheet_directory_uri() . '/assets/css/color-schemes.css'
		);
	}

}

endif; // End class_exists check
