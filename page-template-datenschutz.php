<?php
/**
 * Template Name: Datenschutz
 * 
 * @package Urban_Estates
 */
?>

<?php get_header(); ?>

<!-- <div class="below-header-spacer burger-toggle"></div> -->
<div class="body-container">
    <div class="body_content_container datenschutz-styling">
        <?php the_content();?>
    </div>
</div>

<div class="body-container" style="padding-top: 0px;">
    <div class="body_content_container">
        <div class="button-container-left button-container-entry-bottom">
            <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>"><button class="button button-teal-hollow" id="<?php echo $args['id']?>-btn"><div class="arrow arrow-left"></div><p>Zurück</p></button></a>
        </div>
    </div>
</div>

<?php get_footer(); ?>