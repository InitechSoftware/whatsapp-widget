<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://timelines.ai
 * @since             1.0.0
 * @package           Wa_Click_To_Chat
 *
 * @wordpress-plugin
 * Plugin Name:       Free WA Click To Chat Button by TimelinesAI
 * Plugin URI:        https://timelines.ai/whatsapp-click-to-chat-button-widget/
 * Description:       Add a Whatsapp Live chat widget/click-to-chat buton for your WordPress website for free. Place the Whatsapp button on your website and keep the conversation with your customers even if they leave your website. Enter your Whatsapp number, choose widget position and publish the widget easily.

 * Version:           1.0.0
 * Author:            TimelinesAI
 * Author URI:        http://timelines.ai/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wa-click-to-chat-button
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WA_CLICK_TO_CHAT_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wa-click-to-chat-button-activator.php
 */
function activate_wa_click_to_chat() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wa-click-to-chat-button-activator.php';
	Wa_Click_To_Chat_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wa-click-to-chat-button-deactivator.php
 */
function deactivate_wa_click_to_chat() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wa-click-to-chat-button-deactivator.php';
	Wa_Click_To_Chat_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wa_click_to_chat' );
register_deactivation_hook( __FILE__, 'deactivate_wa_click_to_chatt' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wa-click-to-chat-button.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_plugin_name() {

	$plugin = new Wa_Click_To_Chat();
	$plugin->run();

}
run_plugin_name();
