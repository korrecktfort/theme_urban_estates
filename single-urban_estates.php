<?php
/*
* Template Name: Urban Estates Post Template
* Template Post Type: urban_estates
*/

get_header();

$id = get_post_meta(get_the_ID(), 'related_immomakler_id', true);
?>
<div class="below-header-spacer immo-single burger-toggle"></div>
<?php
get_template_part('template-parts/entry-gallery');

get_template_part('template-parts/entry-heading');

get_template_part('template-parts/entry-bottom-text-block', null, array(
    'title' => 'Objektbeschreibung',
    'text' => get_post_meta($id, 'objektbeschreibung', true),
    'id' => '1',
));

get_template_part('template-parts/image-comment');

get_template_part('template-parts/entry-bottom-text-block', null, array(
    'title' => 'Lage',
    'text' => get_post_meta($id, 'lage', true),
    'id' => '2',
));
?>

<div class="body-container" style="padding-top: 0px;">
    <div class="body_content_container">
        <div class="button-container-left button-container-entry-bottom">
            <a href="<?php echo esc_url(home_url('/')); ?>immobilien"><button class="button button-teal-hollow" id="<?php echo $args['id']?>-btn"><div class="arrow arrow-left"></div><p>Zurück zur Übersicht</p></button></a>
        </div>
    </div>
</div>

<?php
get_footer();
?>