<?php
/*
* Template Name: Immo Post Template
* Template Post Type: post
*/

get_header();

get_template_part('template-parts/entry-gallery');

get_template_part('template-parts/entry-heading');

get_template_part('template-parts/entry-bottom-text-block', null, array(
    'title' => 'Besonderheiten',
    'text' => 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.'
));

get_template_part('template-parts/image-comment');

get_template_part('template-parts/entry-bottom-text-block', null, array(
    'title' => 'Lage',
    'text' => 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.'
));

get_footer();
?>