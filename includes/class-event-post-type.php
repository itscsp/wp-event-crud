<?php

class Event_Post_Type {
    public function __construct() {
        add_action('init', [$this, 'register_event_post_type']);
    }

    public function register_event_post_type() {
        register_post_type('event', [
            'labels' => [
                'name' => 'Events',
                'singular_name' => 'Event',
                'add_new' => 'Add New Event',
                'edit_item' => 'Edit Event',
                'new_item' => 'New Event',
                'view_item' => 'View Event',
                'search_items' => 'Search Events',
                'not_found' => 'No Events Found',
            ],
            'public' => true,
            'has_archive' => true,
            'rewrite' => ['slug' => 'events'],
            'supports' => ['title', 'editor'],
            'menu_icon' => 'dashicons-calendar'
        ]);
    }
}
