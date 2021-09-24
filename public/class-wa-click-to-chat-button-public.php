<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://timelines.ai
 * @since      1.0.0
 *
 * @package    Wa_Click_To_Chat
 * @subpackage Wa_Click_To_Chat/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Wa_Click_To_Chat
 * @subpackage Wa_Click_To_Chat/public
 * @author     TimelinesAI <hello@timelines.ai>
 */
class Wa_Click_To_Chat_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}
  /**
   * Insert widget in footer
   *
   * @since 1.0.0
   */
  public function insert_widget(){
    $widget_meta_options = get_option('wa-click-to-chat-button');
    print_r($widget_meta_options);
    $whatsapp_link = 'https://wa.me/' . $widget_meta_options['en']['phone_number'] . '/' . '?text=' . $widget_meta_options['en']['message'];

    $backlink = '<div><a class="ww-link" type="link" href="https://timelines.ai">TimelinesAI</a></div>';

    echo '<div id="whatsapp-widget" class="ww-' . $widget_meta_options['en']['position'] . ' ww-' . $widget_meta_options['en']['size'] . ' ww-'.$widget_meta_options['en']['widget_display'].'">
    <a target="_blank" href="'.$whatsapp_link.'" class="ww-text">' . $widget_meta_options['en']['call_to_action'] . '</a>
    <div class="ww-icon">
    <div>
      <a target="_blank" href="'.$whatsapp_link.'">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32">
          <path d=" M19.11 17.205c-.372 0-1.088 1.39-1.518 1.39a.63.63 0 0 1-.315-.1c-.802-.402-1.504-.817-2.163-1.447-.545-.516-1.146-1.29-1.46-1.963a.426.426 0 0 1-.073-.215c0-.33.99-.945.99-1.49 0-.143-.73-2.09-.832-2.335-.143-.372-.214-.487-.6-.487-.187 0-.36-.043-.53-.043-.302 0-.53.115-.746.315-.688.645-1.032 1.318-1.06 2.264v.114c-.015.99.472 1.977 1.017 2.78 1.23 1.82 2.506 3.41 4.554 4.34.616.287 2.035.888 2.722.888.817 0 2.15-.515 2.478-1.318.13-.33.244-.73.244-1.088 0-.058 0-.144-.03-.215-.1-.172-2.434-1.39-2.678-1.39zm-2.908 7.593c-1.747 0-3.48-.53-4.942-1.49L7.793 24.41l1.132-3.337a8.955 8.955 0 0 1-1.72-5.272c0-4.955 4.04-8.995 8.997-8.995S25.2 10.845 25.2 15.8c0 4.958-4.04 8.998-8.998 8.998zm0-19.798c-5.96 0-10.8 4.842-10.8 10.8 0 1.964.53 3.898 1.546 5.574L5 27.176l5.974-1.92a10.807 10.807 0 0 0 16.03-9.455c0-5.958-4.842-10.8-10.802-10.8z" fill-rule="evenodd"></path>
        </svg>
      </a></div>
      '.$backlink.'
    </div>
  </div>';
  }


	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wa-click-to-chat-button-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wa-click-to-chat-button-public.js', array( 'jquery' ), $this->version, false );

	}

}
