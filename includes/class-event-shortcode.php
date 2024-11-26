<?php

class Event_Shortcode
{
    public function __construct()
    {
        add_shortcode('events_list', [$this, 'render_events_list']);
        add_action('wp_enqueue_scripts', [$this, 'add_assets_to_plugin']);
    }

    public function add_assets_to_plugin()
    {
        // Enqueue Styles
        wp_enqueue_style(
            'event-crud-css',
            plugin_dir_url(__FILE__) . '../assets/event-list-styles.css'
        );

        // Enqueue Scripts
        wp_enqueue_script(
            'event-crud-js',
            plugin_dir_url(__FILE__) . '../assets/event-script.js',
            ['jquery'],
            '1.0',
            true
        );

        // Log for debugging
        error_log("Styles and scripts loaded for Event Shortcode.");
    }

    public function render_events_list()
    {
        $default_message = get_option('events_manager_default_message', '');
        $code_of_conduct = get_option('events_manager_code_of_conduct', '');

        $query = new WP_Query([
            'post_type' => 'event',
            'posts_per_page' => -1,
            'meta_key' => '_event_date',
            'orderby' => 'meta_value',
            'order' => 'ASC',
        ]);

        $events = $query->posts;

        ob_start();
        include plugin_dir_path(__FILE__) . '../templates/events-list.php';
        return ob_get_clean();
    }

}
