<?php 
$color_class = '';
$color_label = get_field('labels-color');
$main_logo_cream = get_image_data(get_ue_option('main-logo-cream'));
$main_logo_teal = get_image_data(get_ue_option('main-logo-teal'));
$main_logo;

if(isset($args['labels-color'])):
    $color_label = $args['labels-color'];
endif;

switch($color_label)
{
    case 'Cream':               
        $main_logo = $main_logo_cream;
        $color_class = "cream";
        break;
    case 'Teal':        
        $main_logo = $main_logo_teal;
        $color_class = "teal";
        break;
        }        
?>

<div class="top-bar-main <?php echo $color_class;?> burger-toggle">
    <div class="top-bar-main-container">

        <!-- Location Buttons or Breadcrumbs-->
        <?php 
        if(is_front_page()){
        ?>
        <div class="top-bar-item location-buttons">
            <div class="button-container-top-bar burger-toggle">
                <?php echo do_shortcode('[button_location text="Berlin" slug="berlin"]'); ?>
                <?php echo do_shortcode('[button_location text="Potsdam" slug="potsdam"]'); ?>
                <?php echo do_shortcode('[button_location text="Hamburg" slug="hamburg"]'); ?>
            </div>
        </div>
        <?php 
        }else{
        ?>
        <div class="top-bar-item top-bar-breadcrumbs <?php echo $color_class;?> burger-toggle">            
            <?php echo get_breadcrumbs($args); ?>
        </div>
        <?php
        };
        ?>
        
        <!-- Main Logo -->
        <a href="<?php echo get_home_url(); ?>">            
            <div class="top-bar-item top-bar-page-title">
                <div class="burger-toggle hide-on-burger-active">
                <a href="<?php echo get_home_url(); ?>"> <img src="<?php echo $main_logo['url']; ?>" alt="<?php echo $main_logo['alt']; ?>" /></a>
                </div>
                
                <div class="burger-toggle display-on-burger-active">
                <a href="<?php echo get_home_url(); ?>"><img src="<?php echo $main_logo_cream['url']; ?>" alt="<?php echo $main_logo_cream['alt']; ?>" /></a>
                </div>
            </div>
        </a>

        <!-- Burger -->
        <div id="burger-menu-btn" class="top-bar-item burger-menu">
            <div class="burger-menu-container">
                <div class="burger-toggle burger-menu-cross cream"></div>
                <div class="burger-toggle burger-menu-line <?php echo $color_class; ?>"></div>
                <div class="burger-toggle burger-menu-line <?php echo $color_class; ?>"></div>
                <div class="burger-toggle burger-menu-line <?php echo $color_class; ?>"></div>
            </div>
        </div>
    </div>
</div>


<script>
  document.addEventListener('DOMContentLoaded', function () {
    const burgerMenuBtn = document.getElementById('burger-menu-btn');
    const elementsToToggle = document.querySelectorAll('.burger-toggle');    

    burgerMenuBtn.addEventListener('click', function () 
    {
        elementsToToggle.forEach(function(element)
        {
            element.classList.toggle('burger-active');
            console.log('Burger Clicked');
        });        
    });
  });
</script>
