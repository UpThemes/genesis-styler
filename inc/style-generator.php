<?php

/**
 * Add CSS mime type to allowed upload mime types.
 *
 * @since 1.0.0
 */
function cupertino_custom_upload_mimes( $existing_mimes ) {
	// add webm to the list of mime types
	$existing_mimes['css'] = 'text/css';

	// return the array back to the function with our added mime type
	return $existing_mimes;
}
add_filter( 'upload_mimes', 'cupertino_custom_upload_mimes' );

/**
 * Generates Scss variables for custom colors.
 *
 * @since 1.0.0
 */
function cupertino_update_custom_color_vars( $variables ) {

	$up_options = upfw_get_options();

	foreach( $up_options as $key => $variable ) {
		$variables .= '$' . $key . ':' . $variable . ";";
	}

	return $variables;

}

add_filter( 'cupertino_style_variables','cupertino_update_custom_color_vars' );

function cupertino_customize_register($wp_customize) {
	$up_options = upfw_get_options();

	if ( $wp_customize->is_preview() && ! is_admin() ) {
	    add_action( 'wp_footer', 'cupertino_customize_preview', 21);
	}

}
add_action( 'customize_register', 'cupertino_customize_register' );

function cupertino_customize_preview() {
	$up_options = upfw_get_options();

	$styles = cupertino_css_regenerate( 'inline' );
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
function cupertino_customizations_saved_notice() {
    ?>
    <div class="updated">
        <p><?php _e( 'Your custom theme styles were saved and a new CSS file was generated successfully.', 'cupertino' ); ?></p>
    </div>
    <?php
}

/**
 * Error message when CSS file cannot be saved.
 *
 * @since 1.0.0
 */
function cupertino_customizations_not_saved_notice() {
	global $cupertino_error;
    ?>
    <div class="error">
    	<?php if ( $cupertino_error ) : ?>
    		<p><?php echo $cupertino_error; ?>
    	<?php else: ?>
        	<p><?php _e( 'Your custom theme styles were not saved. Please check your settings and try again.', 'cupertino' ); ?></p>
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
function cupertino_css_regenerate( $format = 'file' ) {

	try {

		require get_stylesheet_directory() . "/inc/scssphp/scss.inc.php";
		require get_stylesheet_directory() . "/inc/scssphp-compass/compass.inc.php";

		$base_import_path = apply_filters( 'cupertino_base_import_path', get_stylesheet_directory() . '/assets/scss/' );

		$scss = new scssc();
		$scss->setImportPaths($base_import_path);

		new scss_compass($scss);

		$scss->setFormatter("scss_formatter");

		$style_overrides = apply_filters( 'cupertino_style_variables','' );
		$style_scss_imports = apply_filters( 'cupertino_style_scss_imports',"@import 'style.scss';" );

		$style_content = $scss->compile("
			$style_overrides
			$style_scss_imports
		");

		$old_file = get_option( 'cupertino-style-override' );

		if ( $format === 'file' ) {

			if ( $old_file['file'] && file_exists( $old_file['file'] ) ) {

				unlink( $old_file['file'] );

			}

			if ( $style_scss = wp_upload_bits( 'style.css',null,$style_content) ) {

				$style_scss['date'] = date( 'Y-m-d' );

				$updated = update_option( 'cupertino-style-override',$style_scss);

				if ( isset( $updated ) ) {
					add_action( 'admin_notices', 'cupertino_customizations_saved_notice' );
				} else {
					global $cupertino_error;
					$cupertino_error = __( 'The option could not be saved.','cupertino' );
					add_action( 'admin_notices', 'cupertino_customizations_not_saved_notice' );
				}

			} else {
				add_action( 'admin_notices', 'cupertino_customizations_not_saved_notice' );
			}

		} elseif ( $format === 'inline' ) {
			return $style_content;
		}

	} catch ( Exception $e ) {
		global $cupertino_error;
		$cupertino_error = $e->getMessage();
		add_action( 'admin_notices', 'cupertino_customizations_not_saved_notice' );
	}
}

/**
 * Save new stylesheet when Theme Options page is saved.
 *
 * @since 1.0.0
 */
function cupertino_options_save_regenerate_css() {
	$up_options = upfw_get_options();

	if ( isset($_GET['settings-updated']) && $_GET['settings-updated'] == 'true' ) {
		cupertino_css_regenerate();
	}
}

add_action( 'load-appearance_page_upfw-settings','cupertino_options_save_regenerate_css',1);

/**
 * Import background color for Compass config
 */
function cupertino_inject_bg_color($variables) {
	$bg_color = get_theme_mod( 'background_color' );

	if ( $bg_color ) {
		$variables .= '$site_background_color:#' . $bg_color . ';';
	}

	return $variables;
}
add_filter( 'cupertino_style_variables','cupertino_inject_bg_color' );

/**
 * Save new stylesheet when Theme Customizer is saved.
 *
 * @since 1.0.0
 */
function cupertino_customizer_save_regenerate_css() {
	cupertino_css_regenerate();
}

add_action( 'customize_save_after','cupertino_customizer_save_regenerate_css',1);

/**
 * Remove default stylesheet and enqueue new one.
 *
 * @since 1.0.0
 */
function cupertino_override_default_styles() {
	$up_options = upfw_get_options();
	$custom_style = get_option( 'cupertino-style-override' );

	if ( $custom_style ) {
		wp_dequeue_style( 'cupertino-style' );
		wp_enqueue_style( 'cupertino-style-override', $custom_style['url'], false, $custom_style['date'] );
	}
}

add_action( 'wp_enqueue_scripts', 'cupertino_override_default_styles',9999 );

/**
 * Initialize our custom theme option for color schemes.
 *
 * @since 1.0.0
 */
function cupertino_add_custom_theme_options() {
	global $pagenow;

	if ( $pagenow == 'themes.php' && !empty($_GET['page']) && $_GET['page'] == 'upfw-settings' ) {
		wp_enqueue_style( 'cupertino-color-schemes', get_template_directory_uri() . '/assets/css/color-schemes.css' );
		upfw_add_custom_field( 'colors','cupertino_colors' );
	}
}

add_action( 'admin_init','cupertino_add_custom_theme_options',1);

/**
 * Sanitize our color scheme input.
 *
 * @todo check against valid options.
 *
 * @since 1.0.0
 */
function cupertino_sanitize_color_scheme( $input ) {
	return $input;
}

add_filter( 'upfw_sanitize_colors', 'cupertino_sanitize_color_scheme' );

/**
 * Custom color scheme option for UpThemes Framework.
 *
 * @since 1.0.0
 */
function cupertino_colors( $value, $attr ) {
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
		'cupertino-color-schemes',
		get_stylesheet_directory_uri() . '/assets/css/color-schemes.css'
	);

	wp_enqueue_script(
		'cupertino-customize-theme',
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
			'cupertino-color-schemes',
			get_stylesheet_directory_uri() . '/assets/css/color-schemes.css'
		);
	}

}

endif; // End class_exists check
