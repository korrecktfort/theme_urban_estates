<div class="bottom-column-container bottom-column-container-contact-us">     
    <?php 
    $title = get_field('contact_us_title'); 
    if(isset($args['contact_us_title'])):
        $title = $args['contact_us_title'];
    endif;
    ?>

    <div id="contact-desc">
        <h6><?php echo $title;?></h6>
        <p><?php echo get_ue_option('cp_name');?></p>
        <p><?php echo get_ue_option('cp_address_street');?></p>
        <p><?php echo get_ue_option('cp_address_zip_city');?></p>
            
        <div class ="button-container-left">        
            <?php echo do_shortcode('[button_phone_full]');?>
            <?php echo do_shortcode('[button_mail_full]');?>
            <button class="button" onclick="display_forms()"><div class="magnify"></div><p>Suchauftrag</p></button>        
        </div>  
    </div>

    <div class="bottom-contact-form-container" id="contact-nf" style="display: none; flex-direction: column;">
        <?php echo do_shortcode('[ninja_form id=3]') ?>        
    </div>
</div>

<script>
    function display_forms()
    {
        var nf = document.getElementById('contact-nf');
        var desc = document.getElementById('contact-desc');

        nf.style.display = 'flex';
        desc.style.display = 'none';
    }   
</script>