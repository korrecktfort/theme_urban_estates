<div class="burger-toggle top-bar-menu">
    <div class="top-bar-menu-container">
        
        <nav class ="top-bar-menu-items">
        <?php        
        $menu_items = wp_get_nav_menu_items('main-menu');
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
        
        <div class="top-bar-menu-address address-line">    
            <?php echo do_shortcode('[address]'); ?>
        </div>

    </div>    
</div>