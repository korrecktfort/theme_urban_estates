<div class="body-container">
    <div class="body_content_container">
        <div class="entry_bottom_text_block" id="<?php echo $args['id']?>-textblock">
            <h2><?php echo $args['title'];?></h2>
            <div class="entry_bottom_text__content" id="<?php echo $args['id']?>-text">
                <p><?php echo $args['text']?></p>
                <div class="ellipsis <?php echo $args['ellipsis_class']; ?>" id="<?php echo $args['id']?>-ellipsis"></div>
            </div>
            <div class="button-container-left button-container--align-right">
                <button class="button button-teal-hollow" id="<?php echo $args['id']?>-btn"><div class="arrow arrow-down"></div><p>Weiterlesen</p></button>                             
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var btn = document.getElementById('<?php echo $args['id']?>-btn');
        var text = document.getElementById('<?php echo $args['id']?>-text');
        var ellipsis = document.getElementById('<?php echo $args['id']?>-ellipsis');
        var textblock = document.getElementById('<?php echo $args['id']?>-textblock');
        var isClicked = false;
        
        btn.addEventListener('click', function() {
            text.classList.toggle('entry_bottom_text__content--expanded');
            if(text.classList.contains('entry_bottom_text__content--expanded')) {
                btn.innerHTML = '<div class="arrow arrow-up"></div><p>Weniger anzeigen</p>';
                ellipsis.style.display = 'none';
            } else {
                btn.innerHTML = '<div class="arrow arrow-down"></div><p>Weiterlesen</p>';
                ellipsis.style.display = 'block';
                textblock.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });
</script>