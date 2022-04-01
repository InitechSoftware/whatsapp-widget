<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://timelines.ai
 * @since      1.0.0
 *
 * @package    Free_Click_To_Chat_Button_By_TimelinesAI
 * @subpackage Free_Click_To_Chat_Button_By_TimelinesAI/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Free_Click_To_Chat_Button_By_TimelinesAI
 * @subpackage Free_Click_To_Chat_Button_By_TimelinesAI/public
 * @author     TimelinesAI <hello@timelines.ai>
 */
class Free_Click_To_Chat_Button_By_TimelinesAI_Public
{

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
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }
    /**
     * Insert widget in footer
     *
     * @since 1.0.0
     */
    public function insert_widget()
    {
        $widget_meta_options = get_option('free-click-to-chat-button-by-timelinesai');
        $whatsapp_link = 'https://wa.me/' . $widget_meta_options['en']['phone_number'] . '/' . '?text=' . $widget_meta_options['en']['message'];
        if ($widget_meta_options['en']['widget_display'] == "yes") {
            echo '<script  type="text/javascript">
                    var config = {
                    phone :"' . esc_attr($widget_meta_options['en']['phone_number']) . '",
                    call :"' . esc_attr($widget_meta_options['en']['call_to_action']) . '",
                    position :"ww-' . esc_attr($widget_meta_options['en']['position']) . '",
                    size : "ww-' . esc_attr($widget_meta_options['en']['size']) . '",
                    text : "' . esc_attr($widget_meta_options['en']['message']) . '",
                    type : "' . esc_attr($widget_meta_options['en']['widget_type']) . '",
                    brand : "' . esc_attr($widget_meta_options['en']['brand_title']) . '",
                    subtitle : "' . esc_attr($widget_meta_options['en']['brand_subtitle']) . '",
                    message : "' . esc_attr($widget_meta_options['en']['welcome_message']) . '",
                    };
                    var proto = document.location.protocol, host = "cloudfront.net", url = proto + "//d3kzab8jj16n2f." + host;
                    var s = document.createElement("script"); s.type = "text/javascript"; s.async = true; s.src = url + "/v2/main.js";
                    s.onload = function () { tmWidgetInit(config) };
                    var x = document.getElementsByTagName("script")[0]; x.parentNode.insertBefore(s, x);
                  </script>';
        }
    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {

    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/free-click-to-chat-button-by-timelinesai-public.js', array('jquery'), $this->version, false);

    }

}
