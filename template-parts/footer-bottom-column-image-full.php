<?php
$image = get_image_data(get_field('bottom_area_full_image'));
if($image):?>
<div class="bottom-area-full-image" style="background-image: url('<?php echo $image['url'];?>');" alt="<?php echo $image['alt'];?>">
</div>
<?php endif; ?>