<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.deviodigital.com
 * @since      1.0.0
 *
 * @package    Dispensary_Age_Verification
 * @subpackage Dispensary_Age_Verification/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Dispensary_Age_Verification
 * @subpackage Dispensary_Age_Verification/includes
 * @author     Devio Digital <deviodigital@gmail.com>
 */
class Dispensary_Age_Verification_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'dispensary-age-verification',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
