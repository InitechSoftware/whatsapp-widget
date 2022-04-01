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
 * @subpackage Free_Click_To_Chat_Button_By_TimelinesAI/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Free_Click_To_Chat_Button_By_TimelinesAI
 * @subpackage Free_Click_To_Chat_Button_By_TimelinesAI/includes
 * @author     TimelinesAI <hello@timelines.ai>
 */
class Free_Click_To_Chat_Button_By_TimelinesAI_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'free-click-to-chat-button-by-timelinesai',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);
	}
}
