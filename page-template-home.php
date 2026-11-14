<?php
/**
 * Template Name: Home Page
 *
 * @package Urban_Estates
 */
?>

<?php get_header(); ?>
<div class="body-container bg-teal" style="padding-top: 200px;">

    <?php
        $img = get_image_data(get_field('home_top_image'));
        $style = 'style="background-image: url(' . $img['url'] . ');"';
    ?>

    <div class="home-top">
        <h2>Finest Real Estates Meets Urban Life</h2>
        <div class="home-top-title-image-container">
            <div class="home-top-image" alt="<?php echo $img['alt']; ?>" <?php echo $style;?>>
                <div class="home-top-title">
                    <h3>Forever</h1>
                    <h4>Home</h1>
                </div>          
            </div>
        </div>
    </div>
</div>

<div class="body-container bg-teal">
    <div class="body_content_container">    
        <?php 
            $image_left = get_image_data(get_field('home_bottom_left_image'));
            $style_left = 'style="background-image: url(' . $image_left['url'] . ');"';

            $image_right = get_image_data(get_field('home_bottom_right_image'));
            $style_right = 'style="background-image: url(' . $image_right['url'] . ');"';
        ?>

        <div class="home-bottom-columns">
            <div class="home-bottom-column-left">
                <div class="home-bottom-columns__left__image" <?php echo $style_left;?>></div>
                <div class="home-bottom-columns__left__text">
                    <h2><?php echo get_field('home_bottom_text_title');?></h2>
                    <p><?php echo get_field('home_bottom_text_text');?></p>
                </div>
            </div>
            
            <div class="home-bottom-column right">
                <div class="home-bottom-columns__right__image" <?php echo $style_right;?>>
                    <div class="home-bottom-title">
                        <h3>Discover</h3>
                        <h4>Residencies</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="body-container bg-teal home-bottom-main-menu top-border" style="padding-top: 0px;">    
    <div class="button-container-left" style="margin-bottom: 47px;">
        <nav class="row">
            <?php        
                $menu_items = wp_get_nav_menu_items('home-bottom-main-menu');
                if($menu_items)
                {
                    foreach($menu_items as $menu_item)
                    {
                        $title = $menu_item->title;
                        $url = $menu_item->url;     
                        echo button(['text' => $title, 'link' => $url]);
                    }
                }

                // echo do_shortcode('[button_mail text="Kontakt"]');
            ?> 
            
        </nav>
    </div>        
   
</div>

<?php get_footer(); ?>