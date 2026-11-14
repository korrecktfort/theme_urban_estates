<div class="bottom-column-container">
    
    <h6>Exposé anfordern</h6>
    <?php 
        $image_data = get_image_data(get_ue_option('request-expose-image'));    
        $style = 'style="background-image: url(' . $image_data['url'] . ');" alt="' . $image_data['alt'] . '";';
    ?>

    <div class="row">
        <div class="expose-image" <?php echo $style ?>>
        </div>    
    
        <div class="expose-info">
            <div class ="expose-info-item" style="margin-bottom: -8px">
                <p><b><?php echo get_ue_option('cp_managing_director'); ?></b></p>
            </div>
            <div class ="expose-info-item">
                <p>Geschäftsführer</p>                            
            </div>

            <div class="expose-info-buttons">
                <div class ="expose-info-item">
                    <?php echo do_shortcode('[button_phone_full]'); ?>
                </div>
                    
                <div class ="expose-info-item">
                    <?php echo do_shortcode('[button_mail_full]'); ?>            
                </div>
            </div>
        </div>
    </div>
</div>