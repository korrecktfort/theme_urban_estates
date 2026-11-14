<?php 
$displayImage = get_field('display-background-image');
$image = get_field('top-background-image');
$displayImage = $displayImage && !empty($image);

$top_container_height_class = 'top-container-height'; // default height class
$top_container_color = 'style=';

// if image is displayed, set height class to image height
if($displayImage):    
    $top_container_height_class = 'top-container-height-image';
else:    
    // if no image, check if color is set
    if(get_field('top-background-color')):
        $top_container_color .= '"background-color: '.get_field('top-background-color').';"';
    endif;    
endif;
?>      

<?php
    if(isset($args['top-bar-color'])):
        $top_container_color = 'style="background-color: '.$args['top-bar-color'].';"';
    endif;        
?>

<div class="burger-toggle top-container <?php echo $top_container_height_class?>" <?php echo($top_container_color)?>>     
    <div class="top-container-relative-parent">
        <!-- Image - First-->
        <?php get_template_part('template-parts/top-bar-image', null, $args); ?>

        <!-- Menu - Second -->
        <?php get_template_part('template-parts/top-bar-menu', null, $args); ?>

        <!-- Main - Third -->
        <?php get_template_part('template-parts/top-bar-main', null, $args); ?>
    </div>
</div>