<?php

class Event_Settings {
    public function __construct() {
        add_action('admin_menu', [$this, 'add_plugin_settings_page']);
        add_action('admin_init', [$this, 'register_settings']);
    }

    public function add_plugin_settings_page() {
        add_options_page(
            'Events Manager Settings',
            'Events Manager',
            'manage_options',
            'events-manager-settings',
            [$this, 'render_settings_page']
        );
    }

    public function render_settings_page() {
        ?>
        <div class="wrap">
            <h1>Events Manager Settings</h1>
            <form method="post" action="options.php">
                <?php
                settings_fields('events_manager_settings');
                do_settings_sections('events-manager-settings');
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }

    public function register_settings() {
        register_setting('events_manager_settings', 'events_manager_code_of_conduct');

        add_settings_section('general_settings', 'General Settings', null, 'events-manager-settings');


        add_settings_field(
            'code_of_conduct',
            'Event Code of Conduct',
            function () {
                $value = get_option('events_manager_code_of_conduct', '');
                echo '<textarea name="events_manager_code_of_conduct" rows="5" style="width: 100%;">' . esc_textarea($value) . '</textarea>';
            },
            'events-manager-settings',
            'general_settings'
        );
    }
}
