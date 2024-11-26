jQuery(document).ready(function ($) {
    $('.event__toggle').on('click', function () {
        const $content = $(this).closest('.event__content').find('.event__details-content');

        $content.slideToggle(300, () => {
            // Update button text after the animation completes
            const isVisible = $content.is(':visible');
            $(this).text(isVisible ? 'Hide Details' : 'View Details');
        });
    });
});
