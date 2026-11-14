<?php 
if(get_field('display_bottom_area')):
?>


<div class="bottom-area">

<div class="bottom-area-left-column">
    <?php 
    $left_column_type = get_field('bottom_area_left_column_type');

    switch($left_column_type)
    {
        case 'SearchRequest':
            get_template_part('template-parts/footer-bottom-column-search-request');
            break;
        case 'ExposeRequest':
            get_template_part('template-parts/footer-bottom-column-expose-request');
            break;
        case 'ContactUs':
            get_template_part('template-parts/footer-bottom-column-contact-us');
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