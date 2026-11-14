<?php 
extract($args);
$img = get_image_data($image_url);
$display_line_style = ($display_line) ? '' : 'style="display: none;"';
$style = 'style="background-image: url(' . $img['url'] . ');"';
?>

<div class="services-info-container">
    <div class="services-info-container-left services-center-color-change">
        <div class="services-info-container__logo" alt="<?php echo $img['alt'];?>" <?php echo $style;?>></div>        
    </div>
    <div class="services-info-container-right">
        <div class="services-connection-line services-center-color-change" <?php echo $display_line_style;?>></div>
        <div class="services-info-container__text">
            <h2><?php echo $title;?></h2>
            <h3><?php echo $subtitle;?></h3>
            <p><?php echo $text;?></p>
        </div>
    </div>
</div>