<?php
extract($args);

$image_data = get_image_data($image_url);
$image_style = "background-image: url('" . $image_data['url'] . "');";
?>

<div class="horizontal-image-text-clean <?php if($reverse) echo 'row-reverse'?>">
    <div class="horizontal-image-text-clean__image" style="<?php echo $image_style;?>" alt="<?php echo $image_data['alt']; ?>">        
    </div>

    <div class="horizontal-image-text-clean__content">        
        <h3><?php echo $title; ?></h3>
        <p><?php echo $text; ?></p>
    </div>
</div>