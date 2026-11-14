<div class="bottom-column-container"> 
    <h6><?php echo get_field('contact_us_title');?></h6>
    <p><?php echo get_ue_option('cp_name');?></p>
    <p><?php echo get_ue_option('cp_address_street');?></p>
    <p><?php echo get_ue_option('cp_address_zip_city');?></p>
        
    <div class ="button-container-left">        
        <?php echo do_shortcode('[button_phone_full]');?>
        <?php echo do_shortcode('[button_mail]');?>
    </div>  
</div>