<?php
/**
 * Plugin Name:       The Contacts List Plugin
 * Plugin URI:        http://mildfun.com/
 * Description:       Programming Excerise
 * Version:           1.0.0
 * Author:            Sean Warren
 * Author URI:        http://github.com/smwarren
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       constactList
 *
 * @link              http://mildfun.com/
 * @package           constactList
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

/**
 * Define global constants.
 *
 * @since 1.0.0
 */
// Plugin version.
if (!defined('constactList_version')) {
    define('constactList_version', '1.0.0');
}

if (!defined('constactList_name')) {
    define('constactList_name', trim(dirname(plugin_basename(__FILE__)), '/'));
}

if (!defined('constactList_dir')) {
    define('constactList_dir', WP_PLUGIN_DIR . '/' . constactList_name);
}

/**
 * Define constactList Plugin Class
 *
 * @since 1.0.0
 */

class constactList
{
    public $post_type = "contacts";

    public function __construct()
    {
        $this->init();
    }

    /**
     * Start Hooking and Initatiing with WordPress
     * Add  Hooks + Plugin Filters, and Styles
     *
     * @since 1.0.0
     */
    public function init()
    {
        add_filter('single_template', array(
        $this,
        'add_custom_templates'
      ));

        add_filter('archive_template', array(
        $this,
        'add_custom_templates'
      ), 10, 2);

        add_action('init', array(
            $this,
            'constactList_post_type'
        ));

        add_action('add_meta_boxes', array(
            $this,
            'add'
        ));

        add_action('save_post', array(
            $this,
            'save'
        ));

        wp_enqueue_style('contact_styles',
          plugin_dir_url(__FILE__) . 'contacts.css',
           array());
    }

    /**
     * Add Custom Templates, Adds the Custom Post Tyles Themes
     *
     * @param $template {String}  - template url
     * @param $type {String} - template type
     * @return {String} - location
     * @since 1.0.0
     */
    public function add_custom_templates($template, $type = null)
    {
        global $wp_query, $post;

        if ($post->post_type == $this->post_type) {

            if (is_null($type)) {

                if (file_exists(constactList_dir . '/themes/single-contacts.php')) {
                    return   constactList_dir . '/themes/single-contacts.php';
                }
            }

            if (file_exists(constactList_dir . '/themes/archive-contacts.php')) {
                return   constactList_dir . '/themes/archive-contacts.php';
            }
        }

        return $template;
    }

    /**
     * Add Meta Box to Custom Post Type
     *
     * @since 1.0.0
     */
    public function add()
    {
        $screens = ['contacts'];
        foreach ($screens as $screen) {
            add_meta_box(
                    'contacts_metabox_id',
                    'The Contacts List',
                    [self::class, 'html'],
                    $screen,
                    'normal',
                    'default'
                );
        }
    }

    /**
     * Save THe Meta Box's Data
     *
     * @param $post_id {String}  - the post id
     * @since 1.0.0
     */
    public function save($post_id)
    {
        if (array_key_exists('contacts_meta_box', $_POST)) {
            update_post_meta(
                    $post_id,
                    '_contactsList_key',
                    $_POST['contacts_meta_box']
                );
        }
    }

    /**
     * Rendering the ContactList MetaBox
     *
     * @param $post {String}  - the current post
     * @param $type {String} - template type
     * @return {String} - location
     * @since 1.0.0
     */
    public function html($post)
    {
        $default = array(
                  'full_name' => '',
                  'phone_number' => '',
                  'email' => '',
              );
        $value = get_post_meta($post->ID, '_contactsList_key', true);
        $details = wp_parse_args($value, $default);  ?>
        <table class="contactListTable">
        <tr>
          <th>Full Name</th>
          <th>Phone Number</th>
          <th>Email</th>
        </tr>
        <tr>
          <td>
            <input
      						type="text"
      						name='contacts_meta_box[full_name]'
                  autocomplete='name'
      						id="contacts_meta_box"
      						value="<?php echo esc_attr($details['full_name']); ?>"
                  placeholder="Enter Full Name Here">
                </td>
          <td>
            <input
      						type="text"
      						name="contacts_meta_box[phone_number]"
                  autocomplete='tel'
      						id="contacts_meta_box"
      						value="<?php echo esc_attr($details['phone_number']); ?>"
                  placeholder="Enter Phone Number Here">
              </td>
          <td><input
      						type="text"
      						name="contacts_meta_box[email]"
                  autocomplete='email'
      						id="contacts_meta_box"
      						value="<?php echo esc_attr($details['email']); ?>"
                  placeholder="Enter Email Here"></td>
              </tr>
      </table>
            <?php
    }
    /**
     * Registers the Custom Contacts Post Type
     *
     * @since    1.0.0
     *
     * @return a custom post type called Contact
     **/

    public function constactList_post_type()
    {
        $labels = array(
            'name' => 'Contacts',
            'singular_name' => 'Contact',
            'menu_name' => 'Contacts',
            'name_admin_bar' => 'Contact Post Type',
            'archives' => 'Contact Archives',
            'attributes' => 'Contact Attributes',
            'parent_item_colon' => 'Parent Contact:',
            'all_items' => 'All Contacts',
            'add_new_item' => 'Add New Contact',
            'add_new' => 'Add New Contact',
            'new_item' => 'New Contact',
            'edit_item' => 'Edit Contact',
            'update_item' => 'Update Contact',
            'view_item' => 'View Contact',
            'view_items' => 'View Contacts',
            'search_items' => 'Search Contact',
            'not_found' => 'Contact Not found',
            'not_found_in_trash' => 'Contact Not found in Trash',
            'featured_image' => 'Contact Featured Image',
            'set_featured_image' => 'Set Contact featured image',
            'remove_featured_image' => 'Remove Contact featured image',
            'use_featured_image' => 'Use as Contact featured image',
            'insert_into_item' => 'Insert into Contact',
            'uploaded_to_this_item' => 'Uploaded to this Contact',
            'items_list' => 'Contacts list',
            'items_list_navigation' => 'Contacts list navigation',
            'filter_items_list' => 'Filter Contacts list'
        );
        $args   = array(
            'label' => 'Contact',
            'description' => 'Contact Post Type',
            'labels' => $labels,
            'supports' => array(
                'title',
                'author',
                'thumbnail',
              ),
            'hierarchical' => true,
            'public' => true,
            'has_archive' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_position' => 5,
            'can_export' => true,
            'exclude_from_search' => false,
            'publicly_queryable' => true,
            'capability_type' => 'page',
            'menu_icon' => null,
        );
        register_post_type('contacts', $args);
    }
}

$initPlugin = new constactList();
