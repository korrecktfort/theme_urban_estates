<?php 
if(get_field('display_bottom_area') 
|| (isset($args['display_bottom_area']) && $args['display_bottom_area'])):
?>


<div class="bottom-area" id="bottom">

<div class="bottom-area-left-column">
    <?php 
    $left_column_type = get_field('bottom_area_left_column_type');

    if(isset($args['left_column_type'])):
        $left_column_type = $args['left_column_type'];
    endif;

    switch($left_column_type)
    {
        case 'SearchRequest':
            get_template_part('template-parts/footer-bottom-column-search-request', null, $args);
            break;
        case 'ExposeRequest':
            get_template_part('template-parts/footer-bottom-column-expose-request', null, $args);
            break;
        case 'ContactUs':
            get_template_part('template-parts/footer-bottom-column-contact-us', null, $args);
            break;
    }

    ?>
</div>

<?php 
$bg_color = '';

switch($left_column_type)
{    
    case 'ExposeRequest':
        $bg_color = 'bg-green';
        break;    
}

?>

<div class="bottom-area-right-column <?php echo $bg_color ?>">
    <?php 
    $right_column_type = get_field('bottom_area_right_column_type');

    if(isset($args['right_column_type'])):
        $right_column_type = $args['right_column_type'];
    endif;

    switch($right_column_type)
    {
        case 'FullImage':
            get_template_part('template-parts/footer-bottom-column-image-full');
            break;

        case 'ExposeRequestForm':
            get_template_part('template-parts/footer-bottom-column-expose-form');
            break;
    }
    ?>
</div>

</div>

<?php 
endif;
?>