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
    private $_plugin_name;

    /**
     * The version of this plugin.
     *
     * @since  1.0.0
     * @access private
     * @var    string  $_version The current version of this plugin.
     */
    private $_version;

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
        wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/dispensary-age-verification-public.min.css', array(), $this->version, 'all' );
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

        wp_enqueue_script( 'age-verification-cookie', plugin_dir_url( __FILE__ ) . 'js/js.cookie.js', array( 'jquery' ), $this->version, false );
        wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/dispensary-age-verification-public.js', array( 'jquery' ), $this->version, false );

        // Translation array data.
        $translation_array = array(
            'bgImage'        => get_theme_mod( 'dav_bgImage' ),
            'minAge'         => get_theme_mod( 'dav_minAge', '18' ),
            'imgLogo'        => get_theme_mod( 'dav_logo' ),
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
 * @since  1.0.0
 * @return string
 */
function avwp_public_js() {

    // Add JavaScript codes to footer based on setting in the Customizer.    
    if ( '1' === get_theme_mod( 'dav_adminHide' ) && current_user_can( 'administrator' ) ) {
        // Do nothing.
    } else { ?>
        <script type="text/javascript">
            jQuery(document).ready(function($) {
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
                    "successMessage" : object_name.successMessage,
                    "failTitle" : object_name.failTitle,
                    "failText" : object_name.failText,
                    "messageTime" : object_name.messageTime,
                    "cookieDays" : object_name.cookieDays,
                    "adminDebug" : object_name.adminDebug,
                    "beforeContent" : object_name.beforeContent,
                    "afterContent" : object_name.afterContent
                });
            });
        </script>
        <?php
    } // end adminHide check.
}
add_action( 'wp_footer', 'avwp_public_js' );

/**
 * Register the CSS through wp_header().
 *
 * @since  1.0.0
 * @return void
 */
function avwp_public_css() {
    if ( '' !== get_theme_mod( 'dav_bgImage' ) ) { ?>
        <style type="text/css">
        .avwp-av-overlay {
            background-image: url(<?php echo esc_url( get_theme_mod( 'dav_bgImage' ) ); ?>);
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            background-attachment: fixed;
            box-sizing: border-box;
        }
        .avwp-av {
            box-shadow: none;
        }
        </style>
    <?php }
}
add_action( 'wp_head', 'avwp_public_css' );
