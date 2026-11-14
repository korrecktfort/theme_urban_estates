<?php
/**
 * Template Name: Services
 *
 * @package Urban_Estates
 */
?>

<?php get_header();?>

<?php the_content(); ?>

<div class="body-container">
    <?php get_template_part('template-parts/services-logo-text-pair', null, array(
        "image_url" => get_field('service_image_buy'),
        "title" => get_field('service_title_buy'),
        "subtitle" => get_field('service_subtitle_buy'),
        "text" => get_field('service_text_buy'),
        "display_line" => true,
    ));
    ?>

    <?php get_template_part('template-parts/services-logo-text-pair', null, array(
        "image_url" => get_field('service_image_sell'),
        "title" => get_field('service_title_sell'),
        "subtitle" => get_field('service_subtitle_sell'),
        "text" => get_field('service_text_sell'),
        "display_line" => true,
    ));
    ?>

    <?php get_template_part('template-parts/services-logo-text-pair', null, array(
        "image_url" => get_field('service_image_rent'),
        "title" => get_field('service_title_rent'),
        "subtitle" => get_field('service_subtitle_rent'),
        "text" => get_field('service_text_rent'),
        "display_line" => true,
    ));
    ?>

    <?php get_template_part('template-parts/services-logo-text-pair', null, array(
        "image_url" => get_field('service_image_rate'),
        "title" => get_field('service_title_rate'),
        "subtitle" => get_field('service_subtitle_rate'),
        "text" => get_field('service_text_rate'),
        "display_line" => false,
    ));
    ?>
</div>

<?php get_footer();?>

<script>
        window.addEventListener('scroll', function() {
            // Get the y-value on the screen where you want to trigger the class toggle

            var offset = 90;
            var triggerY = window.innerHeight / 2;     
            var triggerYTop = triggerY + offset;
            var triggerYBottom = triggerY - offset;     

            // Get elements to toggle class
            var elements = document.querySelectorAll('.services-center-color-change');

            // Loop through each element
            elements.forEach(function(element) {
                // Get the bounding rectangle of the element
                var rect = element.getBoundingClientRect();

                var isTouchingTrigger = rect.top <= triggerYTop && rect.bottom >= triggerYBottom;
                

                console.log(rect.top);

                // Check if the element's top is at or below the triggerY
                if (isTouchingTrigger) {
                    // Add the class to toggle
                    element.classList.add('services-changed-color');
                } else {
                    // Remove the class
                    element.classList.remove('services-changed-color');
                }
            });
        });
    </script>