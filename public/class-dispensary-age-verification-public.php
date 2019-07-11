<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.deviodigital.com
 * @since      1.0.0
 *
 * @package    Dispensary_Age_Verification
 * @subpackage Dispensary_Age_Verification/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Dispensary_Age_Verification
 * @subpackage Dispensary_Age_Verification/public
 * @author     Devio Digital <deviodigital@gmail.com>
 */
class Dispensary_Age_Verification_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param string $plugin_name The name of the plugin.
	 * @param string $version     The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/dispensary-age-verification-public.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		// Empty redirect.
		$redirect_fail = '';

		// Set the redirect URL.
		$redirectOnFail = esc_url( apply_filters( 'avwp_redirect_on_fail_link', $redirect_fail ) );

		wp_enqueue_script( 'age-verification-cookie', plugin_dir_url( __FILE__ ) . 'js/js.cookie.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/dispensary-age-verification-public.js', array( 'jquery' ), $this->version, false );

		// Translation array data.
		$translation_array = array(
			'bgImage'        => get_theme_mod( 'dav_bgImage' ),
			'minAge'         => get_theme_mod( 'dav_minAge', '18' ),
			'imgLogo'        => get_theme_mod( 'dav_logo' ),
			'title'          => get_theme_mod( 'dav_title', 'Age Verification' ),
			'copy'           => get_theme_mod( 'dav_copy', 'You must be [age] years old to enter.' ),
			'btnYes'         => get_theme_mod( 'dav_button_yes', 'YES' ),
			'btnNo'          => get_theme_mod( 'dav_button_no', 'NO' ),
			'redirectOnFail' => $redirectOnFail,
		);

		// Translation array filter.
		$translation_array = apply_filters( 'avwp_localize_script_translation_array', $translation_array );

		// Localize script.
		wp_localize_script( $this->plugin_name, 'object_name', $translation_array );
	}
}

/**
 * Register the JavaScript through wp_footer().
 *
 * @since    1.0.0
 */
function wpd_av_public_js() {

	// Add JavaScript codes to footer based on setting in the Customizer.	
	if ( '1' === get_theme_mod( 'dav_adminHide' ) && current_user_can( 'administrator' ) ) {
		// Do nothing.
	} else { ?>
		<script type="text/javascript">
			(function( $ ) {
				$.ageCheck({
					"bgImage" : object_name.bgImage,
					"minAge" : object_name.minAge,
					"imgLogo" : object_name.imgLogo,
					"title" : object_name.title,
					"copy" : object_name.copy,
					"btnYes" : object_name.btnYes,
					"btnNo" : object_name.btnNo,
					"redirectOnFail" : object_name.redirectOnFail,
					"successTitle" : object_name.successTitle,
					"successText" : object_name.successText,
					"failTitle" : object_name.failTitle,
					"failText" : object_name.failText,
					"cookieDays" : object_name.cookieDays,
					"adminDebug" : object_name.adminDebug
				});
			})( jQuery );
		</script>
	<?php
	} // end adminHide check.
}
add_action( 'wp_footer', 'wpd_av_public_js' );

/**
 * Register the CSS through wp_header().
 *
 * @since    1.0.0
 */
function wpd_av_public_css() {
	if ( '' !== get_theme_mod( 'dav_bgImage' ) ) { ?>
		<style type="text/css">
		.wpd-av-overlay {
			background-image: url(<?php echo get_theme_mod('dav_bgImage'); ?>) no-repeat center center;
			box-sizing: border-box;
			background-size: cover;
			background-attachment: fixed;
		}
		.wpd-av {
			box-shadow: none;
		}
		</style>
	<?php }
}
add_action( 'wp_head', 'wpd_av_public_css' );
