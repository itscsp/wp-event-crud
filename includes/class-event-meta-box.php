<?php
// This code will add custom fields to Events Post type.
class Event_Meta_Box
{
    public function __construct()
    {
        add_action('add_meta_boxes', [$this, 'add_event_meta_boxes']);
        add_action('save_post_event', [$this, 'save_event_meta']);
    }

    public function add_event_meta_boxes()
    {
        add_meta_box(
            'event_details',
            'Event Details',
            [$this, 'render_event_meta_boxes'],
            'event',
            'normal',
            'default'
        );
    }

    public function render_event_meta_boxes($post)
    {
        $date = get_post_meta($post->ID, '_event_date', true);
        $time = get_post_meta($post->ID, '_event_time', true);

        $location = get_post_meta($post->ID, '_event_location', true);
        $organizer = get_post_meta($post->ID, '_event_organizer', true);
        wp_nonce_field('save_event_meta', 'event_meta_nonce');
?>
        <p>
            <label for="event_date">Date:</label>
            <input type="date" id="event_date" name="event_date" value="<?php echo esc_attr($date); ?>" />
        </p>
        <p>
            <label for="event_time">Time:</label>
            <input type="time" id="event_time" name="event_time" value="<?php echo esc_attr($time); ?>" required />
        </p>
        <p>
            <label for="event_location">Location:</label>
            <input type="text" id="event_location" name="event_location" value="<?php echo esc_attr($location); ?>" />
        </p>
        <p>
            <label for="event_organizer">Organizer:</label>
            <input type="text" id="event_organizer" name="event_organizer" value="<?php echo esc_attr($organizer); ?>" />
        </p>
<?php
    }

    public function save_event_meta($post_id)
    {
        if (!isset($_POST['event_meta_nonce']) || !wp_verify_nonce($_POST['event_meta_nonce'], 'save_event_meta')) {
            return;
        }

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        if (isset($_POST['event_date'])) {
            update_post_meta($post_id, '_event_date', sanitize_text_field($_POST['event_date']));
        }

        if (isset($_POST['event_time'])) {
            update_post_meta($post_id, '_event_time', sanitize_text_field($_POST['event_time']));
        }

        if (isset($_POST['event_location'])) {
            update_post_meta($post_id, '_event_location', sanitize_text_field($_POST['event_location']));
        }
        if (isset($_POST['event_organizer'])) {
            update_post_meta($post_id, '_event_organizer', sanitize_text_field($_POST['event_organizer']));
        }
    }
}
