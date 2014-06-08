<?php


/**
* Create a sub-page for our theme license key
*
* @uses add_submenu_page()
*
* @return void
*
* @since 0.1
*/
function upthemes_sl_license_menu() {
		add_menu_page('Cupertino Theme Info', 'Cupertino Theme Info', 'manage_options', 'cupertino_theme', 'cupertino_theme_page');
}
add_action('admin_menu', 'upthemes_sl_license_menu');

/**
* Display a license key management page
*
* @uses get_option()
* @uses settings_fields()
* @uses _e()
* @uses wp_nonce_field()
* @uses submit_button()
*
* @return void
*
* @since 0.1
*/
function cupertino_theme_page() {
	?>
	<div class="wrap">
		<h2>Cupertino Theme</h2>

	<?php
}

/**
* Register our license key options
*
* @uses register_setting()
*
* @return void
*
* @since 0.1
*/
function upthemes_sl_register_option() {
	// creates our settings in the options table
	register_setting('upthemes_sl_license', UPTHEMES_LICENSE_KEY, 'upthemes_sl_sanitize_license' );
}
add_action('admin_init', 'upthemes_sl_register_option');

/**
* Sanitize the license key
*
* @uses get_option()
* @uses delete_option()
*
* @return string $new license key
*
* @since 0.1
*/
function upthemes_sl_sanitize_license( $new ) {
	$old = get_option( UPTHEMES_LICENSE_KEY );
	if( $old && $old != $new ) {
		delete_option( UPTHEMES_LICENSE_KEY . '_status' ); // new license has been entered, so must reactivate
	}
	return $new;
}

/**
* Activate license key on remote server
*
* We send a remote request to activate the license key
* being used on the current domain.
*
* @uses check_admin_referer()
* @uses get_option()
* @uses delete_option()
* @uses urlencode()
* @uses wp_remote_get()
* @uses add_query_arg()
* @uses is_wp_error()
* @uses json_decode()
* @uses wp_remote_retrieve_body()
* @uses update_option()
*
* @return void
*
* @since 0.1
*/
function upthemes_sl_activate_license() {

	// listen for our activate button to be clicked
	if( isset( $_POST['upthemes_sl_license_activate'] ) ) {

		// run a quick security check
		if( ! check_admin_referer( 'upthemes_sl_nonce', 'upthemes_sl_nonce' ) )
			return; // get out if we didn't click the Activate button

		// retrieve the license from the database
		$license = trim( get_option( UPTHEMES_LICENSE_KEY ) );

		if( !$license || $license == '' ){
			delete_option( UPTHEMES_LICENSE_KEY . '_status' );
			return;
		}

		// data to send in our API request
		$api_params = array(
			'edd_action'=> 'activate_license',
			'license'   => $license,
			'item_name' => urlencode( UPTHEMES_ITEM_NAME ) // the name of our product in EDD
		);

		// Call the custom API.
		$response = wp_remote_get( add_query_arg( $api_params, UPTHEMES_STORE_URL ), array( 'timeout' => 15, 'sslverify' => false ) );

		// make sure the response came back okay
		if ( is_wp_error( $response ) )
			return;

		// decode the license data
		$license_data = json_decode( wp_remote_retrieve_body( $response ) );

		// $license_data->license will be either "active" or "inactive"

		//echo $license_data->license;

		update_option( UPTHEMES_LICENSE_KEY . '_status', $license_data->license );

	}
}
add_action('admin_init', 'upthemes_sl_activate_license');


/**
* Deactivate license key on remote server
*
* We send a remote request to deactivate the license key
* being used on the current domain.
*
* @uses check_admin_referer()
* @uses get_option()
* @uses delete_option()
* @uses urlencode()
* @uses wp_remote_get()
* @uses add_query_arg()
* @uses is_wp_error()
* @uses json_decode()
* @uses wp_remote_retrieve_body()
* @uses update_option()
*
* @return void
*
* @since 0.1
*/
function upthemes_sl_deactivate_license() {

	// listen for our activate button to be clicked
	if( isset( $_POST['upthemes_sl_license_deactivate'] ) ) {

		// run a quick security check
		if( ! check_admin_referer( 'upthemes_sl_nonce', 'upthemes_sl_nonce' ) )
			return; // get out if we didn't click the Activate button

		// retrieve the license from the database
		$license = trim( get_option( UPTHEMES_LICENSE_KEY ) );

		if( !$license || $license == '' ){
			delete_option( UPTHEMES_LICENSE_KEY . '_status' );
			return;
		}

		// data to send in our API request
		$api_params = array(
			'edd_action'=> 'deactivate_license',
			'license'   => $license,
			'item_name' => urlencode( UPTHEMES_ITEM_NAME ) // the name of our product in EDD
		);

		// Call the custom API.
		$response = wp_remote_get( add_query_arg( $api_params, UPTHEMES_STORE_URL ), array( 'timeout' => 15, 'sslverify' => false ) );

		// make sure the response came back okay
		if ( is_wp_error( $response ) )
			return;

		// decode the license data
		$license_data = json_decode( wp_remote_retrieve_body( $response ) );

		// $license_data->license will be either "deactivated" or "failed"
		if( $license_data->license == 'deactivated' )
			delete_option( UPTHEMES_LICENSE_KEY . '_status' );

	}
}
add_action('admin_init', 'upthemes_sl_deactivate_license');


/**
* Check license on server
*
* We send a remote request to check the validity of the
* license and update the status based on the response.
*
* @global $wp_version
*
* @uses get_option()
* @uses wp_remote_get()
* @uses add_query_arg()
* @uses is_wp_error()
* @uses json_decode()
* @uses wp_remote_retrieve_body()
*
* @return string valid or invalid
*
* @since 0.1
*/
function upthemes_sl_check_license() {

	global $wp_version;

	$license = trim( get_option( UPTHEMES_LICENSE_KEY ) );

	$api_params = array(
		'edd_action' => 'check_license',
		'license' => $license,
		'item_name' => urlencode( UPTHEMES_ITEM_NAME )
	);

	// Call the custom API.
	$response = wp_remote_get( add_query_arg( $api_params, UPTHEMES_STORE_URL ), array( 'timeout' => 15, 'sslverify' => false ) );

	if ( is_wp_error( $response ) )
		return false;

	$license_data = json_decode( wp_remote_retrieve_body( $response ) );

	if( $license_data->license == 'valid' ) {
		return 'valid';
		// this license is still valid
	} else {
		return 'invalid';
		// this license is no longer valid
	}
}

function upthemes_sl_enforce_license(){
	$license_status = upthemes_sl_check_license();

	if( $license_status !== 'valid' )
		delete_option( UPTHEMES_LICENSE_KEY . '_status' );
}

function upthemes_sl_license_expired( $plugin_data, $r ) {
		echo 'Your license key has expired. Please <a href="http://upthemes.com">purchase a new license key</a> to enable theme support and automatic updates.';
}

class UpThemes_Theme_Updater {
	private $remote_api_url;
	private $request_data;
	private $response_key;
	private $theme_slug;
	private $license_key;
	private $version;
	private $author;

	function __construct( $args = array() ) {
		$args = wp_parse_args( $args, array(
			'remote_api_url' => 'http://upthemes.com',
			'request_data'   => array(),
			'theme_slug'     => get_template(),
			'item_name'      => '',
			'license'        => '',
			'version'        => '',
			'author'         => ''
		) );
		extract( $args );

		$theme                = wp_get_theme( sanitize_key( $theme_slug ) );
		$this->license        = $license;
		$this->item_name      = $item_name;
		$this->version        = ! empty( $version ) ? $version : $theme->get( 'Version' );
		$this->theme_slug     = sanitize_key( $theme_slug );
		$this->author         = $author;
		$this->remote_api_url = $remote_api_url;
		$this->response_key   = $this->theme_slug . '-update-response';


		add_filter( 'site_transient_update_themes', array( &$this, 'theme_update_transient' ) );
		add_filter( 'delete_site_transient_update_themes', array( &$this, 'delete_theme_update_transient' ) );
		add_action( 'load-update-core.php', array( &$this, 'delete_theme_update_transient' ) );
		add_action( 'load-themes.php', array( &$this, 'delete_theme_update_transient' ) );
		add_action( 'load-themes.php', array( &$this, 'load_themes_screen' ) );
	}

	function load_themes_screen() {
		add_thickbox();
		add_action( 'admin_notices', array( &$this, 'update_nag' ) );
	}

	function update_nag() {
		$theme = wp_get_theme( $this->theme_slug );

		$api_response = get_transient( $this->response_key );

		if( false === $api_response )
			return;

		$update_url = wp_nonce_url( 'update.php?action=upgrade-theme&amp;theme=' . urlencode( $this->theme_slug ), 'upgrade-theme_' . $this->theme_slug );
		$update_onclick = ' onclick="if ( confirm(\'' . esc_js( __( "Updating this theme will lose any customizations you have made. 'Cancel' to stop, 'OK' to update." ) ) . '\') ) {return true;}return false;"';

		if ( version_compare( $this->version, $api_response->new_version, '<' ) ) {

			echo '<div id="update-nag">';
				printf( '<strong>%1$s %2$s</strong> is available. <a href="%3$s" class="thickbox" title="%4s">Check out what\'s new</a> or <a href="%5$s"%6$s>update now</a>.',
					$theme->get( 'Name' ),
					$api_response->new_version,
					'#TB_inline?width=640&amp;inlineId=' . $this->theme_slug . '_changelog',
					$theme->get( 'Name' ),
					$update_url,
					$update_onclick
				);
			echo '</div>';
			echo '<div id="' . $this->theme_slug . '_' . 'changelog" style="display:none;">';
				echo wpautop( $api_response->sections['changelog'] );
			echo '</div>';
		}
	}

	function theme_update_transient( $value ) {
		$update_data = $this->check_for_update();
		if ( $update_data ) {
			$value->response[ $this->theme_slug ] = $update_data;
		}
		return $value;
	}

	function delete_theme_update_transient() {
		delete_transient( $this->response_key );
	}

	function check_for_update() {

		$theme = wp_get_theme( $this->theme_slug );

		$update_data = get_transient( $this->response_key );
		if ( false === $update_data ) {
			$failed = false;

			if( empty( $this->license ) )
				return false;

			$api_params = array(
				'edd_action'  => 'get_version',
				'license'     => $this->license,
				'name'      => $this->item_name,
				'slug'      => $this->theme_slug,
				'author'    => $this->author
			);

			$response = wp_remote_post( $this->remote_api_url, array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params ) );

			// make sure the response was successful
			if ( is_wp_error( $response ) || 200 != wp_remote_retrieve_response_code( $response ) ) {
				$failed = true;
			}

			$update_data = json_decode( wp_remote_retrieve_body( $response ) );

			if ( ! is_object( $update_data ) ) {
				$failed = true;
			}

			// if the response failed, try again in 30 minutes
			if ( $failed ) {
				$data = new stdClass;
				$data->new_version = $this->version;
				set_transient( $this->response_key, $data, strtotime( '+30 minutes' ) );
				return false;
			}

			// if the status is 'ok', return the update arguments
			if ( ! $failed ) {
				$update_data->sections = maybe_unserialize( $update_data->sections );
				set_transient( $this->response_key, $update_data, strtotime( '+12 hours' ) );
			}
		}

		if ( version_compare( $this->version, $update_data->new_version, '>=' ) ) {
			return false;
		}

		return (array) $update_data;
	}
}