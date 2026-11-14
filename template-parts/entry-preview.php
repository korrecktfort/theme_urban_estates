<?php 
extract($args);
$image_data = get_image_data($image_url);
$image_style = "background-image: url('" . $image_data['url'] . "');";
?>

<a class="entry-preview" href="<?php echo $link; ?>">
    <div class="entry-preview__image" style="<?php echo $image_style;?>" alt="<?php echo $image_data['alt']; ?>"> <!-- needs to be backgorund image -->
        <div class="entry-preview__image__overlay"></div>        
    </div>
    <div class="entry-preview__content">
        <h2><?php echo $title; ?></h2>
        <p><?php echo $summary; ?></p>
        <div class="entry-preview__details">
            <p><?php echo $livingSpace; ?> m²</p>
            <p>|</p>
            <p><?php echo $rooms; ?> Zimmer</p>
            <p>|</p>
            <p><?php echo $district; ?></p>
        </div>
    </div>
</a>

