<?php
extract($args);

$image_data = get_image_data($image_url);
$image_style = "background-image: url('" . $image_data['url'] . "');";
?>

<div class="horizontal-image-text">
    <div class="horizontal-image-text__image" style="<?php echo $image_style;?>" alt="<?php echo $image_data['alt']; ?>"> <!-- needs to be backgorund image -->
        <div class="horizontal-image-text__image__overlay"></div>
    </div>
    <div class="horizontal-image-text__content">
        <h2><?php echo $name; ?></h2>
        <h3><?php echo $title; ?></h3>
        <p><?php echo $text; ?></p>
    </div>
</div>

