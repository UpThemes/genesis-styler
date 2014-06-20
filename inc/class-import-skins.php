<?php
/**
* Import Skins
*
* This file creates an import tab that allows users to import custom skin JSON files.
*/

class Import_Export {

	/**
	 * Initializes the Import_Export() class
	 *
	 * Checks for an existing Import_Export() instance
	 * and if it doesn't find one, creates it.
	 *
	 * @uses Import_Export()
	 *
	 */
	public function init() {
		static $instance = false;

		if ( !$instance ) {
			$instance = new Import_Export();
		}

		return $instance;
	}

	/**
	* Constructor for the import export class. Loads options and hooks in the init method.
	*
	* @access public
	* @return void
	*/
	public function __construct() {

		add_action( 'init', array( $this, 'create_import_export_tab' ), 1 );
		add_action( 'init', array( $this, 'create_import_option' ), 4 );
		add_action( 'init', array( $this, 'attach_export_control' ), 20 );
		add_filter( 'upfw_sanitize_import', array( $this, 'sanitize_import' ) );
		add_filter( 'upfw_sanitize_export', array( $this, 'sanitize_export' ) );

	}

	/**
	* Creates import tab in theme options panel.
	*
	* @access public
	* @return void
	*/
	public function create_import_export_tab(){

		$import_export = array(
			'name' 			=> 'import_export',
			'title' 		=> __('Import/Export Skins','gstyler'),
			'sections' 		=> array(
				'import_export' 	=> array(
					'name' 			=> 'import_export',
					'title' 		=> __( 'Import/Export Skins', 'gstyler' ),
					'description' 	=> __( 'Import or export custom skins for the Genesis Styler theme.','gstyler' )
				),

			),
		);

		register_theme_option_tab($header);

	}

	/**
	* Creates option for importer.
	*
	* @access public
	* @return void
	*/
	public function create_import_option(){

		$custom_header_options = array(
			'import_file' 		=> array(
				'tab' 			=> 'import_export',
				'name' 			=> 'import_skin',
				'title' 		=> 'Import File',
				'description' 	=> __( 'Select a JSON file to import.', 'gstyler' ),
				'section' 		=> 'import_export',
				'since' 		=> '1.0',
				'id' 			=> 'import_export',
				'type' 			=> 'import',
			),
		);

		register_theme_options($custom_header_options);

	}

	/**
	* Creates option for exporter.
	*
	* @access public
	* @return void
	*/
	public function create_export_option(){

		$custom_header_options = array(
			"export_file" 		=> array(
				"tab" 			=> "import_export",
				"name" 			=> "export_skin",
				"title" 		=> "Export File",
				"description" 	=> __( "Download a skin export file based on your current design settings.", 'gstyler' ),
				"section" 		=> "import_export",
				"since" 		=> "1.0",
				"id" 			=> "import_export",
				"type" 			=> "export",
			),
		);

		register_theme_options($custom_header_options);

	}

	/**
	* This does nothing.
	*
	* @access public
	* @return void
	*/
	public function sanitize_export($input){

		return $input;

	}

	/**
	* This does nothing.
	*
	* @access public
	* @return void
	*/
	public function sanitize_import($input){

		return $input;

	}

	/**
	* Attach export control.
	*
	* @access public
	* @return void
	*/
	public function attach_export_control(){

		upfw_add_custom_field( 'export', array( $this, 'create_export_control') );

	}

	/**
	* Attach import control.
	*
	* @access public
	* @return void
	*/
	public function attach_import_control(){

		upfw_add_custom_field( 'import', array( $this, 'create_import_control') );

	}

	/**
	* Create export control.
	*
	* @access public
	* @return void
	*/
	public function create_export_control(){

		?> <button id="export-skin" class="export">Export Current Skin</button> <?php

	}

	/**
	* Create import control.
	*
	* @access public
	* @return void
	*/
	public function create_import_control(){

		?> <button id="import-skin" class="import">Import Current Skin</button> <?php

	}
}

$import_export = Import_Export::init();