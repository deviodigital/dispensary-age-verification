<?php
/**
 * The plugin bootstrap file
 *
 * @link              https://www.deviodigital.com
 * @since             1.0.0
 * @package           Dispensary_Age_Verification
 *
 * @wordpress-plugin
 * Plugin Name:       Age Verification
 * Plugin URI:        https://www.deviodigital.com
 * Description:       Check a visitors age before allowing them to view your website. Brought to you by <a href="https://www.deviodigital.com/" target="_blank">Devio Digital</a>
 * Version:           2.2
 * Author:            Devio Digital
 * Author URI:        https://www.deviodigital.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       dispensary-age-verification
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-dispensary-age-verification-activator.php
 */
function activate_dispensary_age_verification() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-dispensary-age-verification-activator.php';
	Dispensary_Age_Verification_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-dispensary-age-verification-deactivator.php
 */
function deactivate_dispensary_age_verification() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-dispensary-age-verification-deactivator.php';
	Dispensary_Age_Verification_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_dispensary_age_verification' );
register_deactivation_hook( __FILE__, 'deactivate_dispensary_age_verification' );

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
 * @since    1.0.0
 */
function run_dispensary_age_verification() {

	$plugin = new Dispensary_Age_Verification();
	$plugin->run();

}
run_dispensary_age_verification();

/**
 * Add Go Pro link on plugin page
 *
 * @since 2.2
 * @param array $links an array of links related to the plugin.
 * @return array updatead array of links related to the plugin.
 */
function avwp_go_pro_link( $links ) {
	// Pro link.
	$pro_link = '<a href="https://deviodigital.com/product/age-verification-pro" target="_blank" style="font-weight:700;">' . __( 'Go Pro', 'dispensary-age-verification' ) . '</a>';

	if ( ! function_exists( 'run_avwp_pro' ) ) {
		array_unshift( $links, $pro_link );
	}
	return $links;
}

$pluginname = plugin_basename( __FILE__ );

add_filter( "plugin_action_links_$pluginname", 'avwp_go_pro_link' );
