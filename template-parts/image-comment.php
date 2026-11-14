<?php 

$img_url = '';
if(!empty(get_field('comment-image')))
{
    $img_url = get_field('comment-image');    
} else{
    $related_immomakler_id = get_post_meta(get_the_ID(), 'related_immomakler_id', true);
    $images_args = array(
        'post_parent' => $related_immomakler_id,
        'numberposts' => -1,
        'post_type'   => 'attachment',
        'post_mime_type' => 'image',
        'orderby'     => 'menu_order ID',
        'order'       => 'ASC'
        );
    $image_attachments = get_posts( $images_args );
    $img_url = $image_attachments[0]->guid;
}

$image_data = get_image_data($img_url);
$style = "background-image: url('" . $image_data['url'] . "');";

$comment = get_post_meta($id, 'objekttitel_original', true);
$commentator = get_post_meta($id, 'kontaktperson_vorname', true) . ' ' . get_post_meta($id, 'kontaktperson_name', true);
$commentator_title = '';

$personal_number = get_post_meta($id, 'kontaktperson_personennummer', true);
if(!empty($personal_number))
{
    switch($personal_number)
    {
        case '001':            
            $commentator_title = 'Geschäftsführer';
            break;
        case '002':            
            $commentator_title = 'Strategie';
            break;
        default:
            break;        
    }
}

?>

<div class="body-container">
    <div class="entry-comment">
        <div class="entry-comment-area image" alt="<?php echo $image_data['alt']; ?>" style="<?php echo $style;?>">
        </div>       
        <div class ="entry-comment-area-container-text">
            <?php get_template_part('template-parts/comment', null, array('comment' => $comment, 'commentator' => $commentator, 'commentator_title' => $commentator_title)); ?>
        </div>
    </div>
</div>