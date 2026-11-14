<?php
/*
* Template Name: Urban Estates Post Template
* Template Post Type: urban_estates
*/

get_header();

get_template_part('template-parts/entry-gallery');

get_template_part('template-parts/entry-heading');

$id = get_post_meta(get_the_ID(), 'related_immomakler_id', true);

get_template_part('template-parts/entry-bottom-text-block', null, array(
    'title' => 'Besonderheiten',
    'text' => get_post_meta($id, 'objektbeschreibung', true),
));

get_template_part('template-parts/image-comment');

get_template_part('template-parts/entry-bottom-text-block', null, array(
    'title' => 'Lage',
    'text' => get_post_meta($id, 'lage', true),
));

get_footer();
?>