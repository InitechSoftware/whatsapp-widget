<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://timelines.ai
 * @since      1.0.0
 *
 * @package    Whatsapp_Widget
 * @subpackage Whatsapp_Widget/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Whatsapp_Widget
 * @subpackage Whatsapp_Widget/admin
 * @author     Your Name <email@example.com>
 */
class Whatsapp_Widget_Admin
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
    /**
     * Create a submenu page under Plugins.
     * Framework also add "Settings" to your plugin in plugins list.
     * @link https://github.com/JoeSz/Exopite-Simple-Options-Framework
     */
    $config_submenu = array(

      'type'              => 'menu',                          // Required, menu or metabox
      'id'                => $this->plugin_name,              // Required, meta box id, unique per page, to save: get_option( id )
      'parent'            => 'plugins.php',                   // Parent page of plugin menu (default Settings [options-general.php])
      'submenu'           => true,                            // Required for submenu
      'title'             => 'Whatsapp Widget Settings',               // The title of the options page and the name in admin menu
      'capability'        => 'edit_posts',                // The capability needed to view the page
      'plugin_basename'   =>  plugin_basename(plugin_dir_path(__DIR__) . $this->plugin_name . '.php'),
      // 'tabbed'            => false,
      // 'multilang'         => false,                        // To turn of multilang, default on.

    );
    $config_metabox = array(

      /*
       * METABOX
       */
      'type'              => 'metabox',                       // Required, menu or metabox
      'id'                => $this->plugin_name,              // Required, meta box id, unique, for saving meta: id[field-id]
      'post_types'        => array( 'test' ),                 // Post types to display meta box
      // 'post_types'        => array( 'post', 'page' ),         // Could be multiple
      'context'           => 'advanced',                      // 	The context within the screen where the boxes should display: 'normal', 'side', and 'advanced'.
      'priority'          => 'default',                       // 	The priority within the context where the boxes should show ('high', 'low').
      'title'             => 'Demo Metabox',                  // The title of the metabox
      'capability'        => 'edit_posts',                    // The capability needed to view the page
      'tabbed'            => true,
      // 'multilang'         => false,                        // To turn of multilang, default off except if you have qTransalte-X.
      'options'           => 'simple',                        // Only for metabox, options is stored az induvidual meta key, value pair.

  );
    $fields[] = array(
      'name'   => 'appearance',
      'title'  => 'Appearance',
      'icon'   => 'dashicons-admin-generic',
      'fields' => array(

          array(
              'id'          => 'phone_number',
              'type'        => 'text',
              'title'       => 'Phone Number',
              'before'      => 'Text Before',
              'after'       => 'Text After',
              'class'       => 'text-class',
              'description' => 'Insert your phone number',
              'default'     => 'Default Text',
              'attributes'    => array(
                 'placeholder' => 'do stuff',
                 'data-test'   => 'test',

              ),
              'help'        => 'Help text',
              'sanitize'    => array( $this, 'test_sanitize_callback' ),
          ),

          array(
              'id'          => 'call_to_action',
              'type'        => 'text',
              'title'       => 'Call to action',
              'before'      => 'Text Before',
              'after'       => 'Text After',
              'class'       => 'text-class',
              'description' => 'Insert your call to action',
              'default'     => 'Message Us',
              'attributes'    => array(
                 'placeholder' => 'do stuff',
                 'data-test'   => 'test',

              ),
              'help'        => 'Help text',
              'sanitize'    => array( $this, 'test_sanitize_callback' ),
          ),
          array(
            'id'          => 'message',
            'type'        => 'text',
            'title'       => 'Whatsapp pre-filled message',
            'before'      => 'Text Before',
            'after'       => 'Pre-filled message helps your customer to start a conversation with you with a request template',
            'class'       => 'text-class',
            'description' => ' (optional)',
            'default'     => '',
            'attributes'    => array(
               'placeholder' => 'do stuff',
               'data-test'   => 'test',

            ),
            'help'        => 'Help text',
            'sanitize'    => array( $this, 'test_sanitize_callback' ),
        ),

          array(
              'id'      => 'hidden_1',
              'type'    => 'hidden',
              'default' => 'hidden',
          ),

          array(
            'id'      => 'size',
            'type'    => 'radio',
            'title'   => 'Button Size',
            'options' => array(
              'normal'   => 'Normal',
              'medium'    => 'Medium',
              'big'    => 'Big'
            ),
            'default' => 'normal',
          ),

          array(
            'id'      => 'position',
            'type'    => 'radio',
            'title'   => 'Position',
            'options' => array(
              'left'   => 'Left',
              'right'    => 'Right',
            ),
            'default' => 'right',
          ),
          /*array(
            'id'    => 'backlink',
            'type'  => 'checkbox',
            'title' => 'TimelinesAI Branding',
            'label' => 'Do you want to set TimelinesAI branding',
            'after' => '<i>If you check this and the other checkbox, a text field will appier.</i>'
        ),*/

      )
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

    wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/plugin-name-admin.css', array(), $this->version, 'all');
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

    wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/plugin-name-admin.js', array('jquery'), $this->version, false);
  }
}
