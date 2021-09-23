<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://timelines.ai
 * @since      1.0.0
 *
 * @package    Wa_Click_To_Chat
 * @subpackage Wa_Click_To_Chat/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Wa_Click_To_Chat
 * @subpackage Wa_Click_To_Chat/includes
 * @author     TimelinesAI <hello@timelines.ai>
 */
class Wa_Click_To_Chat_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'wa-click-to-chat-button',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);
	}
}
