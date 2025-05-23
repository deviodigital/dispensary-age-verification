<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @package    Age_Verification
 * @subpackage Age_Verification/public
 * @author     Devio Digital <contact@deviodigital.com>
 * @license    GPL-2.0+ http://www.gnu.org/licenses/gpl-2.0.txt
 * @link       https://www.deviodigital.com
 * @since      1.0.0
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Age_Verification
 * @subpackage Age_Verification/public
 * @author     Devio Digital <contact@deviodigital.com>
 * @license    GPL-2.0+ http://www.gnu.org/licenses/gpl-2.0.txt
 * @link       https://www.deviodigital.com
 * @since      1.0.0
 */
class Age_Verification_Public {

    /**
     * The ID of this plugin.
     *
     * @since  1.0.0
     * @access private
     * @var    string  $_plugin_name The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since  1.0.0
     * @access private
     * @var    string  $_version The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     * 
     * @param string $_plugin_name The name of the plugin.
     * @param string $_version     The version of this plugin.
     * 
     * @since 1.0.0
     */
    public function __construct( $_plugin_name, $_version ) {

        $this->plugin_name = $_plugin_name;
        $this->version     = $_version;

    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since  1.0.0
     * @return void
     */
    public function enqueue_styles() {
        // Public CSS.
        wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/dispensary-age-verification-public.min.css', [], $this->version, 'all' );
    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since  1.0.0
     * @return void
     */
    public function enqueue_scripts() {
        // Empty redirect.
        $redirect_fail = '';
        // Set the redirect URL.
        $redirectOnFail = esc_url( apply_filters( 'avwp_redirect_on_fail_link', $redirect_fail ) );
        // Add content before popup contents.
        $beforeContent = apply_filters( 'avwp_before_popup_content', '' );
        // Add content after popup contents.
        $afterContent = apply_filters( 'avwp_after_popup_content', '' );

        // Enqueue the cookie script.
        wp_enqueue_script( 'age-verification-cookie', plugin_dir_url( __FILE__ ) . 'js/js.cookie.js', [ 'jquery' ], $this->version, false );

        // Add age verification codes based on setting in the Customizer.    
        if ( '1' === get_theme_mod( 'dav_adminHide' ) && current_user_can( 'administrator' ) ) {
            // Do nothing.
        } else {
            wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/dispensary-age-verification-public.js', [ 'jquery' ], $this->version, false );
        }

        // Default logo image dimensions.
        $img_dimensions = [
            'width'  => '',
            'height' => '',
        ];

        // Get image dimensions for logo (if available).
        if ( get_theme_mod( 'dav_logo' ) ) {
            $logo_media_id  = avwp_get_media_id_from_url( get_theme_mod( 'dav_logo' ) );
            if ( $logo_media_id ) {
                $img_dimensions = avwp_get_image_sizes_by_id( $logo_media_id );
            } else { 
                $img_dimensions = [
                    'width'  => '',
                    'height' => ''
                ];
            }
        }

        // Check if the theme is an FSE (Full Site Editing) theme.
        if ( wp_is_block_theme() ) {
            // Use settings from the options table (FSE themes).
            $translation_array = [
                'bgImage'        => get_option( 'dav_bgImage', '' ),
                'minAge'         => get_option( 'dav_minAge', '18' ),
                'imgLogo'        => get_option( 'dav_logo', '' ),
                'logoWidth'      => $img_dimensions['width'],
                'logoHeight'     => $img_dimensions['height'],
                'title'          => get_option( 'dav_title', esc_attr__( 'Age Verification', 'dispensary-age-verification' ) ),
                'copy'           => get_option( 'dav_copy', esc_attr__( 'You must be [age] years old to enter.', 'dispensary-age-verification' ) ),
                'btnYes'         => get_option( 'dav_button_yes', esc_attr__( 'YES', 'dispensary-age-verification' ) ),
                'btnNo'          => get_option( 'dav_button_no', esc_attr__( 'NO', 'dispensary-age-verification' ) ),
                'successTitle'   => esc_attr__( 'Success!', 'dispensary-age-verification' ),
                'successText'    => esc_attr__( 'You are now being redirected back to the site ...', 'dispensary-age-verification' ),
                'successMessage' => get_option( 'dav_success_message', '' ),
                'failTitle'      => esc_attr__( 'Sorry!', 'dispensary-age-verification' ),
                'failText'       => esc_attr__( 'You are not old enough to view the site ...', 'dispensary-age-verification' ),
                'messageTime'    => get_option( 'dav_message_display_time', '2000' ),
                'redirectOnFail' => $redirectOnFail,
                'beforeContent'  => $beforeContent,
                'afterContent'   => $afterContent,
            ];
        } else {
            // Use Customizer settings (Classic themes)
            $translation_array = [
                'bgImage'        => get_theme_mod( 'dav_bgImage' ),
                'minAge'         => get_theme_mod( 'dav_minAge', '18' ),
                'imgLogo'        => get_theme_mod( 'dav_logo' ),
                'logoWidth'      => $img_dimensions['width'],
                'logoHeight'     => $img_dimensions['height'],
                'title'          => get_theme_mod( 'dav_title', esc_attr__( 'Age Verification', 'dispensary-age-verification' ) ),
                'copy'           => get_theme_mod( 'dav_copy', esc_attr__( 'You must be [age] years old to enter.', 'dispensary-age-verification' ) ),
                'btnYes'         => get_theme_mod( 'dav_button_yes', esc_attr__( 'YES', 'dispensary-age-verification' ) ),
                'btnNo'          => get_theme_mod( 'dav_button_no', esc_attr__( 'NO', 'dispensary-age-verification' ) ),
                'successTitle'   => esc_attr__( 'Success!', 'dispensary-age-verification' ),
                'successText'    => esc_attr__( 'You are now being redirected back to the site ...', 'dispensary-age-verification' ),
                'successMessage' => get_theme_mod( 'dav_success_message' ),
                'failTitle'      => esc_attr__( 'Sorry!', 'dispensary-age-verification' ),
                'failText'       => esc_attr__( 'You are not old enough to view the site ...', 'dispensary-age-verification' ),
                'messageTime'    => get_theme_mod( 'dav_message_display_time' ),
                'redirectOnFail' => $redirectOnFail,
                'beforeContent'  => $beforeContent,
                'afterContent'   => $afterContent,
            ];
        }

        // Translation array filter.
        $translation_array = apply_filters( 'avwp_localize_script_translation_array', $translation_array );

        // Localize script.
        wp_localize_script( $this->plugin_name, 'object_name', $translation_array );
    }
}
