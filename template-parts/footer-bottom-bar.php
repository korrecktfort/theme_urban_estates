<div class="footer-bottom-bar">
    <div class="footer-bottom-bar-container">
        <div class="footer-bottom-bar-item footer-bottom-bar-address address-line">
            <?php echo do_shortcode('[address]');?>
        </div>
        
        <div class="footer-bottom-bar-item footer-bottom-bar-monogram">
            <?php 
            $footer_monogram = get_image_data(get_ue_option('main-logo-monogram')); 
            ?>
        
            <img src="<?php echo $footer_monogram['url']; ?>" alt="<?php echo $footer_monogram['alt'];?>">
        </div>
        
        <nav class="footer-bottom-bar-item footer-menu">
            <?php        
            $menu_items = wp_get_nav_menu_items('footer-menu');
            if($menu_items)
            {
                foreach($menu_items as $menu_item)
                {
                    $title = $menu_item->title;
                    $url = $menu_item->url;
                    $is_current = (get_permalink() == $url) ? 'current' : '';
                    $str = '<a class="' . $is_current . '" href="' . $url . '">' . $title . '</a>';
                    echo $str;
                }
            }
            ?>    
        </nav>
    </div>
</div>