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

require_once WP_EVENT_CRUD_DIR . 'includes/class-event-post-type.php';
require_once WP_EVENT_CRUD_DIR . 'includes/class-event-meta-box.php';
require_once WP_EVENT_CRUD_DIR . 'includes/class-event-settings.php';
require_once WP_EVENT_CRUD_DIR . 'includes/class-event-shortcode.php';

// Initialize plugin components.
add_action('plugins_loaded', function () {
    new Event_Post_Type();
    new Event_Meta_Box();
    new Event_Settings();
    new Event_Shortcode();
});

