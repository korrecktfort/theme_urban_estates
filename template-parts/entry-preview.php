<?php 
extract($args);
$image_data = get_image_data($image_url);
$image_style = "background-image: url('" . $image_data['url'] . "');";
?>

<a class="entry-preview <?php echo $district ?>" href="<?php echo $link; ?>">
    <div class="entry-preview__image" style="<?php echo $image_style;?>" alt="<?php echo $image_data['alt']; ?>"> <!-- needs to be backgorund image -->
        <div class="entry-preview__image__overlay"></div>        
    </div>
    <div class="entry-preview__content">
        <h2><?php echo $title; ?></h2>
        <p><?php echo $summary; ?></p>
        <div class="entry-preview__details">
            <?php if(!empty($livingSpace)): ?>
            <p><?php echo $livingSpace; ?> m²</p>
            <p>|</p>
            <?php endif; ?>
            <?php if(!empty($rooms)): ?>
            <p><?php echo $rooms; ?> Zimmer</p>
            <p>|</p>
            <?php endif; ?>
            <?php if(!empty($district)): ?>
            <p><?php echo $district; ?></p>
            <?php endif; ?>
        </div>
    </div>
</a>

