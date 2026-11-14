<?php
$displayImage = get_field('display-background-image');
$image = get_field('top-background-image');
$displayImage = $displayImage && !empty($image);

$image_style = '';

// Image Styling
if($displayImage):      
    $image_style = 'style="background-image: url('.$image['url'].'); background-attachment:'.(get_field('top-background-fixed') ? 'fixed' : 'scroll').';"';
else:
endif;
?>

<?php if($displayImage && !empty($image)):?>
    <div class="top-container-image-container">
        
        <div class="top-container-image" <?php echo($image_style)?>>

        </div>

        <div class="top-container-image-overlay">
            <div class="body-container">
                <div class="top-container-page-title">  
                    <?php echo the_title();?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>