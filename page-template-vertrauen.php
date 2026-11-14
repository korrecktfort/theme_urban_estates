<?php
/**
 * Template Name: Vertrauen
 *
 * @package Urban_Estates
 */
?>

<?php get_header();?>

<div class="below-header-spacer burger-toggle"></div>

<?php the_content(); ?>

<div class="body-container">
    <div class="body_content_container">
        <?php get_template_part('template-parts/horizontal-image-text', null, array(
            "image_url" => get_field('jw_image'),
            "name" => get_field('jw_name'),
            "title" => get_field('jw_title'),
            "text" => get_field('jw_text')
            ));
            ?>
    </div>
</div>

<?php get_template_part('template-parts/comment', null, array(
    "comment" => get_field('comment_text'),
    "commentator" => get_field('comment_author'),
    "commentator_title" => get_field('comment_author_title'),
    )); 
?>

<!-- <div class="body-container">
    <div class="body_content_container">
        <div style="margin-top: 132px;">
            <?php 
            // get_template_part('template-parts/horizontal-image-text', null, array(
            //     "image_url" => get_field('kw_image'),
            //     "name" => get_field('kw_name'),
            //     "title" => get_field('kw_title'),
            //     "text" => get_field('kw_text')
            //     ));
                ?>
        </div>
    </div>
</div> -->

<?php get_footer();?>