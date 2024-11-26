<div class="event">
    <div class="event__heading">
        <h2 class="event__title">Events</h2>
    </div>



    <?php if (empty($events)) : ?>
        <p class="event__empty">No upcoming events.</p>
    <?php else : ?>
        <div class="event__list">
            <?php foreach ($events as $event) :
                setup_postdata($event);
                $date = get_post_meta($event->ID, '_event_date', true);
                $time = get_post_meta($event->ID, '_event_time', true);
                $location = get_post_meta($event->ID, '_event_location', true);
                $organizer = get_post_meta($event->ID, '_event_organizer', true); ?>

                <div class="event__item">
                    <div class="event__header">
                        <h3 class="event__item-title"><?php echo get_the_title($event); ?></h3>
                        <div class="event__details">
                            <div class="event__location">
                                <div class="event__datetime">
                                    <div class="event__date">
                                        <!-- svg start-->
                                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024" height="16px" width="16px" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M960 95.888l-256.224.001V32.113c0-17.68-14.32-32-32-32s-32 14.32-32 32v63.76h-256v-63.76c0-17.68-14.32-32-32-32s-32 14.32-32 32v63.76H64c-35.344 0-64 28.656-64 64v800c0 35.343 28.656 64 64 64h896c35.344 0 64-28.657 64-64v-800c0-35.329-28.656-63.985-64-63.985zm0 863.985H64v-800h255.776v32.24c0 17.679 14.32 32 32 32s32-14.321 32-32v-32.224h256v32.24c0 17.68 14.32 32 32 32s32-14.32 32-32v-32.24H960v799.984zM736 511.888h64c17.664 0 32-14.336 32-32v-64c0-17.664-14.336-32-32-32h-64c-17.664 0-32 14.336-32 32v64c0 17.664 14.336 32 32 32zm0 255.984h64c17.664 0 32-14.32 32-32v-64c0-17.664-14.336-32-32-32h-64c-17.664 0-32 14.336-32 32v64c0 17.696 14.336 32 32 32zm-192-128h-64c-17.664 0-32 14.336-32 32v64c0 17.68 14.336 32 32 32h64c17.664 0 32-14.32 32-32v-64c0-17.648-14.336-32-32-32zm0-255.984h-64c-17.664 0-32 14.336-32 32v64c0 17.664 14.336 32 32 32h64c17.664 0 32-14.336 32-32v-64c0-17.68-14.336-32-32-32zm-256 0h-64c-17.664 0-32 14.336-32 32v64c0 17.664 14.336 32 32 32h64c17.664 0 32-14.336 32-32v-64c0-17.68-14.336-32-32-32zm0 255.984h-64c-17.664 0-32 14.336-32 32v64c0 17.68 14.336 32 32 32h64c17.664 0 32-14.32 32-32v-64c0-17.648-14.336-32-32-32z"></path>
                                        </svg>
                                        <!-- svg ends-->

                                        <?php echo esc_html($date); ?>
                                    </div>
                                    <div class="event__time">
                                        <!-- svg start-->

                                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 16 16" height="16px" width="16px" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"></path>
                                        </svg>
                                        <!-- svg ends-->

                                        <?php echo esc_html($time); ?>
                                    </div>
                                </div>
                                <div class="event__venue">
                                    <!-- svg start-->

                                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" height="16px" width="16px" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="256" cy="192" r="32"></circle>
                                        <path d="M256 32c-88.22 0-160 68.65-160 153 0 40.17 18.31 93.59 54.42 158.78 29 52.34 62.55 99.67 80 123.22a31.75 31.75 0 0 0 51.22 0c17.42-23.55 51-70.88 80-123.22C397.69 278.61 416 225.19 416 185c0-84.35-71.78-153-160-153zm0 224a64 64 0 1 1 64-64 64.07 64.07 0 0 1-64 64z"></path>
                                    </svg>
                                    <!-- svg endsF-->

                                    <?php echo esc_html($location); ?>
                                </div>
                            </div>
                            <p class="event__organizer"><strong>Organized by:</strong> <?php echo esc_html($organizer); ?></p>
                        </div>
                    </div>
                   
                    <div class="event__content">
                        <div class="event__details-content" style="display: none;">
                            <?php echo apply_filters('the_content', $event->post_content); ?>
                        </div>
                        <button class="event__toggle">View Details</button>
                    </div>

                </div>
            <?php endforeach;
            wp_reset_postdata(); ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($events) && $default_message || $code_of_conduct) : ?>
        <div class="event__info">

            <?php if ($code_of_conduct) : ?>
                <p class="event__conduct"><strong>Code of Conduct:</strong> <?php echo nl2br(esc_html($code_of_conduct)); ?></p>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>