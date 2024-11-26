<?php

/**
 * Plugin Name: WP Events CRUD
 * Description: A Events CRUD Plugin, Admin can create, read, update and delete events.
 * Version: 0.1
 * Author: Chethan
 * Author URL: https://chethanspoojary.com/
 */

 defined('ABSPATH') || exit;

 // // Define plugin paths and URLs
define('WP_EVENT_CRUD_VERSION', '0.1');
define('WP_EVENT_CRUD_DIR', plugin_dir_path(__FILE__));
define('WP_EVENT_CRUD_URL', plugin_dir_url(__FILE__));

// Include Files

require_once WP_EVENT_CRUD_DIR . 'includes/class-event-post-type.php'; // custom post type
require_once WP_EVENT_CRUD_DIR . 'includes/class-event-meta-box.php'; // Addig meta field to CPT
require_once WP_EVENT_CRUD_DIR . 'includes/class-event-settings.php'; // Settings
require_once WP_EVENT_CRUD_DIR . 'includes/class-event-shortcode.php'; // Shortcode

// Initialize plugin components
add_action('plugins_loaded', function () {
    new Event_Post_Type();
    new Event_Meta_Box();
    new Event_Settings();
    new Event_Shortcode();
});


// Register uninstall hook: This will delete all post of events when user delete the plugin from site.
register_uninstall_hook(__FILE__, 'event_crud_plugin_uninstall');

// Function to clean up data
function event_crud_plugin_uninstall() {
    global $wpdb;

    // Delete all events
    $post_ids = $wpdb->get_col("SELECT ID FROM {$wpdb->posts} WHERE post_type = 'event'");
    foreach ($post_ids as $post_id) {
        wp_delete_post($post_id, true); // Force delete on deleting plugin
    }

    // Remove all event 
    $wpdb->query("DELETE FROM {$wpdb->postmeta} WHERE post_id NOT IN (SELECT ID FROM {$wpdb->posts})");

    // Delete plugin options
    delete_option('events_manager_default_message');
    delete_option('events_manager_code_of_conduct');
}
