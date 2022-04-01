<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://timelines.ai
 * @since      1.0.0
 *
 * @package    Free_Click_To_Chat_Button_By_TimelinesAI
 * @subpackage Free_Click_To_Chat_Button_By_TimelinesAI/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Free_Click_To_Chat_Button_By_TimelinesAI
 * @subpackage Free_Click_To_Chat_Button_By_TimelinesAI/admin
 * @author     TimelinesAI <hello@timelines.ai>
 */
class Free_Click_To_Chat_Button_By_TimelinesAI_Admin
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
     * @param      string    $plugin_name       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }
    /**
     * Register plugin page for the admin area
     *
     * @since 1.0.0
     */
    public function create_menu()
    {
        $count_pages = wp_count_posts('page');
        $total_pages = $count_pages->publish;
        $blog_tags = get_tags();
        $blog_tags_string = "";
        foreach ($blog_tags as $tag) {
            $blog_tags_string .= $tag->name . ", ";
        }
        /**
         * Create a submenu page under Plugins.
         * Framework also add "Settings" to your plugin in plugins list.
         * @link https://github.com/JoeSz/Exopite-Simple-Options-Framework
         */
        $config_submenu = array(

            'type' => 'menu', // Required, menu or metabox
            'id' => $this->plugin_name, // Required, meta box id, unique per page, to save: get_option( id )
            'parent' => 'plugins.php', // Parent page of plugin menu (default Settings [options-general.php])
            'submenu' => true, // Required for submenu
            'title' => 'Free Click To Chat Button By TimelinesAI Settings', // The title of the options page and the name in admin menu
            'capability' => 'edit_posts', // The capability needed to view the page
            'plugin_basename' => plugin_basename(plugin_dir_path(__DIR__) . $this->plugin_name . '.php'),
            // 'tabbed'            => false,
            // 'multilang'         => false,                        // To turn of multilang, default on.

        );
        $config_metabox = array(

            /*
             * METABOX
             */
            'type' => 'metabox', // Required, menu or metabox
            'id' => $this->plugin_name, // Required, meta box id, unique, for saving meta: id[field-id]
            'post_types' => array('test'), // Post types to display meta box
            // 'post_types'        => array( 'post', 'page' ),         // Could be multiple
            'context' => 'advanced', //     The context within the screen where the boxes should display: 'normal', 'side', and 'advanced'.
            'priority' => 'default', //     The priority within the context where the boxes should show ('high', 'low').
            'title' => 'Demo Metabox', // The title of the metabox
            'capability' => 'edit_posts', // The capability needed to view the page
            'tabbed' => true,
            // 'multilang'         => false,                        // To turn of multilang, default off except if you have qTransalte-X.
            'options' => 'simple', // Only for metabox, options is stored az induvidual meta key, value pair.

        );
        $fields[] = array(
            'name' => 'appearance',
            'title' => 'Appearance',
            'icon' => 'dashicons-admin-generic',
            'fields' => array(
                array(
                    'id' => 'widget_display',
                    'type' => 'switcher',
                    'title' => 'Widget Display',
                    'label' => 'Do you want to display the widget?',
                    'default' => 'no',
                ),
                array(
                    'id' => 'email',
                    'type' => 'text',
                    'title' => 'Company Email',
                    'before' => '',
                    'after' => 'Example: ' . get_bloginfo('admin_email'),
                    'class' => 'text-class',
                    'wrap_class' => 'widget-email',
                    'description' => 'Insert your company email address',
                    'default' => get_bloginfo('admin_email'),
                    'attributes' => array(
                        'id' => 'company-email',
                    ),
                    'help' => 'Help text',
                    'sanitize' => array($this, 'test_sanitize_callback'),
                ),
                array(
                    'id' => 'phone_number',
                    'type' => 'text',
                    'title' => 'Phone Number',
                    'before' => '',
                    'after' => 'Example: +1(800) 123-45-67',
                    'wrap_class' => 'widget-phone',
                    'class' => 'text-class phone-number',
                    'description' => 'Insert your phone number',
                    'default' => '',
                    'attributes' => array(
                        'id' => "phone_number",
                    ),
                    'help' => 'Help text',
                    'sanitize' => array($this, 'test_sanitize_callback'),
                ),
                array(
                    'id' => 'widget_type',
                    'type' => 'radio',
                    'title' => 'Widget Type',
                    'class' => 'ww-type',
                    'wrap_class' => 'widget-type',
                    'options' => array(
                        'ww-extended' => 'Extended',
                        'ww-standard' => 'Standard',
                    ),
                    'attributes' => array(
                        'id' => 'widget-type',
                    ),
                    'default' => 'ww-extended',
                ),
                array(
                    'id' => 'call_to_action',
                    'type' => 'text',
                    'title' => 'Call to action',
                    'before' => '',
                    'after' => 'Will be displayed as a welcome message to your website visitors',
                    'class' => 'text-class ww-standard',
                    'wrap_class' => 'ww-standard',
                    'description' => 'Insert your call to action',
                    'default' => 'Message Us',
                    'sanitize' => array($this, 'test_sanitize_callback'),
                ),
                array(
                    'id' => 'brand_title',
                    'type' => 'text',
                    'title' => 'Brand Name',
                    'before' => '',
                    'after' => 'Will be displayed as a brand title in the chat box',
                    'class' => 'text-class ww-extended',
                    'wrap_class' => 'ww-extended',
                    'description' => 'Insert your brand name',
                    'default' => get_bloginfo('name'),
                    'sanitize' => array($this, 'test_sanitize_callback'),
                ),
                array(
                    'id' => 'brand_subtitle',
                    'type' => 'text',
                    'title' => 'Brand Subtitle',
                    'before' => '',
                    'after' => 'Will be displayed as a brand subtitle in the chat box',
                    'class' => 'text-class ww-extended',
                    'wrap_class' => 'ww-extended',
                    'description' => 'Insert your brand subtitle',
                    'default' => 'Typically replies within 10 minutes',
                    'sanitize' => array($this, 'test_sanitize_callback'),
                ),
                array(
                    'id' => 'welcome_message',
                    'type' => 'text',
                    'title' => 'Welcome Message',
                    'before' => '',
                    'after' => 'Will be displayed as the welcome (first) message from your brand in the chat box',
                    'class' => 'text-class ww-extended',
                    'wrap_class' => 'ww-extended',
                    'description' => 'Insert your brand subtitle',
                    'default' => 'Hi, there!',
                    'sanitize' => array($this, 'test_sanitize_callback'),
                ),
                array(
                    'id' => 'message',
                    'type' => 'text',
                    'title' => 'Whatsapp pre-filled message',
                    'before' => '',
                    'after' => 'Pre-filled message helps your customer to start a conversation with you with a request template',
                    'class' => 'text-class',
                    'description' => ' (optional)',
                    'default' => "Hi! I'm interested in your service",
                    'attributes' => array(
                        'placeholder' => 'do stuff',
                        'data-test' => 'test',
                    ),
                    'help' => 'Help text',
                    'sanitize' => array($this, 'test_sanitize_callback'),
                ),
                array(
                    'id' => 'size',
                    'type' => 'radio',
                    'title' => 'Button Size',
                    'wrap_class' => 'ww-standard',
                    'options' => array(
                        'normal' => 'Normal',
                        'medium' => 'Medium',
                        'big' => 'Big',
                    ),
                    'attributes' => array(
                        'id' => 'button-size',
                    ),
                    'default' => 'normal',
                ),

                array(
                    'id' => 'position',
                    'type' => 'radio',
                    'title' => 'Position',
                    'options' => array(
                        'left' => 'Left',
                        'right' => 'Right',
                    ),
                    'default' => 'right',
                ),
                array(
                    'id' => 'total_pages',
                    'type' => 'text',
                    'wrap_class' => 'hidden widget-total',
                    'title' => $total_pages,
                    'default' => $total_pages,
                    'attributes' => array(
                        'id' => 'total-pages',
                    ),
                ),
                array(
                    'id' => 'blog_tags',
                    'type' => 'text',
                    'wrap_class' => 'hidden widget-tags',
                    'title' => $blog_tags_string,
                    'default' => $blog_tags_string,
                    'attributes' => array(
                        'id' => 'blog-tags',
                    ),
                ),
            ),
        );
        $options_panel = new Exopite_Simple_Options_Framework($config_submenu, $fields);
        $metabox_panel = new Exopite_Simple_Options_Framework($config_metabox, $fields);
    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Plugin_Name_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Plugin_Name_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/free-click-to-chat-button-by-timelinesai-admin.css', array(), $this->version, 'all');
    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Plugin_Name_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Plugin_Name_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/free-click-to-chat-button-by-timelinesai-admin.js', array('jquery'), $this->version, false);
    }
}
