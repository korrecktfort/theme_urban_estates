<?php
/**
 * Template Name: Vertrauen
 *
 * @package Urban_Estates
 */
?>

<?php get_header();?>

<?php the_content(); ?>

<?php echo do_shortcode('[body_container_start]'); ?>

<?php get_template_part('template-parts/horizontal-image-text', null, array(
    "image_url" => get_field('jw_image'),
    "name" => get_field('jw_name'),
    "title" => get_field('jw_title'),
    "text" => get_field('jw_text')
    ));
    ?>

<?php echo do_shortcode('[body_container_end]'); ?>

<?php get_template_part('template-parts/comment', null, array(
    "comment" => get_field('comment_text'),
    "commentator" => get_field('comment_author'),
    "commentator_title" => get_field('comment_author_title'),
    )); 
?>

<?php echo do_shortcode('[body_container_start]'); ?>

<div style="margin-top: 132px;">
    <?php get_template_part('template-parts/horizontal-image-text', null, array(
        "image_url" => get_field('kw_image'),
        "name" => get_field('kw_name'),
        "title" => get_field('kw_title'),
        "text" => get_field('kw_text')
        ));
        ?>
</div>

<?php echo do_shortcode('[body_container_end]'); ?>

<?php get_footer();?>