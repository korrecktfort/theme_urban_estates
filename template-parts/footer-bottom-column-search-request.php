<div class="bottom-column-container bottom-search-request-container">    

<div id="contact-desc">
    <h6><?php echo get_field('search_area_title');?></h6>    
    <p><?php echo get_field('search_area_text');?></p>    
    
    <div class ="button-container-left">
        <button class="button" onclick="display_forms()"><div class="magnify"></div><p>Suchauftrag</p></button>        
    </div>   
</div>

    <div class="bottom-contact-form-container" id="contact-nf" style="display: none;">
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