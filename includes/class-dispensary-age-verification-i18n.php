<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @package    Age_Verification
 * @subpackage Age_Verification/includes
 * @author     Devio Digital <contact@deviodigital.com>
 * @link       https://www.deviodigital.com
 * @since      1.0.0
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @package    Age_Verification
 * @subpackage Age_Verification/includes
 * @author     Devio Digital <contact@deviodigital.com>
 * @since      1.0.0
 */
class Age_Verification_i18n {

    /**
     * Load the plugin text domain for translation.
     *
     * @since  1.0.0
     * @return void
     */
    public function load_plugin_textdomain() {

        load_plugin_textdomain(
            'dispensary-age-verification',
            false,
            dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
        );

    }

}
