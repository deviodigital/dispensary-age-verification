<?php
/**
 * The plugin bootstrap file
 *
 * @package Age_Verification
 * @author  Devio Digital <contact@deviodigital.com>
 * @license GPL-2.0+ http://www.gnu.org/licenses/gpl-2.0.txt
 * @link    https://www.deviodigital.com
 * @since   1.0.0
 *
 * @wordpress-plugin
 * Plugin Name:       Age Verification
 * Plugin URI:        https://www.deviodigital.com
 * Description:       Check a visitors age before allowing them to view your website. Brought to you by <a href="https://www.deviodigital.com/" target="_blank">Devio Digital</a>
 * Version:           2.9.6
 * Author:            Devio Digital
 * Author URI:        https://www.deviodigital.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       dispensary-age-verification
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    wp_die();
}

require 'vendor/plugin-update-checker/plugin-update-checker.php';
use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

$myUpdateChecker = PucFactory::buildUpdateChecker(
	'https://github.com/deviodigital/dispensary-age-verification/',
	__FILE__,
	'dispensary-age-verification'
);

//Set the branch that contains the stable release.
$myUpdateChecker->setBranch( 'main' );

// Current plugin version.
define( 'AVWP_VERSION', '2.9.6' );

// Plugin folder name.
$pluginname = plugin_basename( __FILE__ );

// Check if Composer's autoloader is already registered globally.
if ( ! class_exists( 'RobertDevore\WPComCheck\WPComPluginHandler' ) ) {
    require_once __DIR__ . '/vendor/autoload.php';
}

use RobertDevore\WPComCheck\WPComPluginHandler;

new WPComPluginHandler( plugin_basename( __FILE__ ), 'https://robertdevore.com/why-this-plugin-doesnt-support-wordpress-com-hosting/' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-dispensary-age-verification-activator.php
 * 
 * @since  1.0.0
 * @return void
 */
function avwp_activate() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-dispensary-age-verification-activator.php';
    Age_Verification_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-dispensary-age-verification-deactivator.php
 * 
 * @since  1.0.0
 * @return void
 */
function avwp_deactivate() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-dispensary-age-verification-deactivator.php';
    Age_Verification_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'avwp_activate' );
register_deactivation_hook( __FILE__, 'avwp_deactivate' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-dispensary-age-verification.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since  1.0.0
 * @return void
 */
function run_avwp() {

    $plugin = new Age_Verification();
    $plugin->run();

}
run_avwp();

/**
 * Add Go Pro link on plugin page
 *
 * @param array $links an array of links related to the plugin.
 * 
 * @since  2.2
 * @return array updatead array of links related to the plugin.
 */
function avwp_go_pro_link( $links ) {
    // Pro link.
    $pro_link = '<a href="https://deviodigital.com/product/age-verification-pro" target="_blank" style="font-weight:700;">' . esc_attr__( 'Go Pro', 'dispensary-age-verification' ) . '</a>';

    if ( ! function_exists( 'run_avwp_pro' ) ) {
        array_unshift( $links, $pro_link );
    }
    return $links;
}
add_filter( "plugin_action_links_$pluginname", 'avwp_go_pro_link' );

/**
 * Check AVWP Pro version number.
 *
 * If the AVWP Pro version number is less than what's defined below, there will
 * be a notice added to the admin screen letting the user know there's a new
 * version of the AVWP Pro plugin available.
 *
 * @since  2.4
 * @return void
 */
function avwp_check_pro_version() {
    // Only run if AVWP Pro is active.
    if ( function_exists( 'run_avwp_pro' ) ) {
        // Check if AVWP Pro version is defined.
        if ( ! defined( 'AVWP_PRO_VERSION' ) ) {
            define( 'AVWP_PRO_VERSION', 0 ); // default to zero.
        }
        // Set pro version number.
        $pro_version = AVWP_PRO_VERSION;
        if ( '0' == $pro_version || $pro_version < '1.4' ) {
            add_action( 'admin_notices', 'avwp_update_avwp_pro_notice' );
        }
    }
}
add_action( 'admin_init', 'avwp_check_pro_version' );

/**
 * Error notice - Runs if AVWP Pro is out of date.
 *
 * @see    avwp_check_pro_version()
 * @since  2.9
 * @return void
 */
function avwp_update_avwp_pro_notice() {
    $avwp_orders = '<a href="https://www.deviodigital.com/my-account/orders/" target="_blank">' . esc_attr__( 'Orders', 'dispensary-age-verification' ) . '</a>';
    $error       = sprintf( esc_html__( 'There is a new version of AVWP Pro available. Download your copy from the %1$s page on Devio Digital.', 'dispensary-age-verification' ), $avwp_orders );
    echo '<div class="notice notice-info"><p>' . $error . '</p></div>';
}

/**
 * Display a custom admin notice to inform users about plugin update issues.
 *
 * This function displays a dismissible admin notice warning users about 
 * restrictions imposed by WordPress® leadership that may impact automatic 
 * plugin updates. It provides a link to a resource where users can learn how 
 * to continue receiving updates.
 *
 * @since  2.9.5
 * @return void
 */
function avwp_custom_update_notice() {
    // Check if the notice has been dismissed.
    if ( get_option( 'avwp_custom_update_notice_dismissed' ) ) {
        return;
    }

    // Translating the notice text using WordPress® translation functions.
    $notice_text = sprintf(
        __( 'Important Notice: Due to recent changes initiated by WordPress® leadership, access to the plugin repository is being restricted for certain hosting providers and developers. This may impact automatic updates for your plugins. To ensure you continue receiving updates and to learn about the next steps, please visit %s.', 'dispensary-age-verification' ),
        '<a href="https://www.robertdevore.com" target="_blank">this page</a>'
    );
    
    // Display the admin notice.
    echo '<div class="notice notice-warning is-dismissible" id="custom-update-notice">
        <p>' . $notice_text . '</p>
    </div>';
}
add_action( 'admin_notices', 'avwp_custom_update_notice' );

/**
 * Enqueue the JavaScript to handle the dismissal of the notice.
 * 
 * @since  2.9.5
 * @return void
 */
function avwp_custom_update_notice_scripts() {
    wp_enqueue_script( 'avwp-custom-notice-dismiss', plugin_dir_url( __FILE__ ) . 'public/js/custom-notice-dismiss.js', [ 'jquery' ], false, true );
    wp_localize_script( 'avwp-custom-notice-dismiss', 'custom_notice', [
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'nonce'    => wp_create_nonce( 'avwp_custom_notice_dismiss_nonce' ),
    ] );
}
add_action( 'admin_enqueue_scripts', 'avwp_custom_update_notice_scripts' );

/**
 * AJAX handler to mark the notice as dismissed.
 * 
 * @since  2.9.5
 * @return void
 */
function avwp_custom_dismiss_update_notice() {
    check_ajax_referer( 'avwp_custom_notice_dismiss_nonce', 'nonce' );
    update_option( 'avwp_custom_update_notice_dismissed', 1 );
    wp_send_json_success();
}
add_action( 'wp_ajax_avwp_custom_dismiss_update_notice', 'avwp_custom_dismiss_update_notice' );
