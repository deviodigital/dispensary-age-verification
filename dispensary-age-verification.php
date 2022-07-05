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
 * Version:           2.9.0
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

// Current plugin version.
define( 'AVWP_VERSION', '2.9.0' );

// Plugin folder name.
$pluginname = plugin_basename( __FILE__ );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-dispensary-age-verification-activator.php
 * 
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
 * @return string
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
        if ( '0' == $pro_version || $pro_version < '1.3' ) {
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
 * @return string
 */
function avwp_update_avwp_pro_notice() {
    $avwp_orders = '<a href="https://www.deviodigital.com/my-account/orders/" target="_blank">' . esc_attr__( 'Orders', 'dispensary-age-verification' ) . '</a>';
    $error       = sprintf( esc_html__( 'There is a new version of AVWP Pro available. Download your copy from the %1$s page on Devio Digital.', 'dispensary-age-verification' ), $avwp_orders );
    echo '<div class="notice notice-info"><p>' . $error . '</p></div>';
}
