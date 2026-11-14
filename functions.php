<?php
require_once 'urban-estates-cookies.php';
require_once 'urban-estates-options.php';
require_once 'urban-estates-shortcodes.php';
require_once 'urban-estates-functions.php';
require_once 'urban-estates-create-posts.php';

function enqueue_style_async() {
    wp_dequeue_style( 'theme-urban-estates-style' );
    wp_enqueue_style( 'theme-urban-estates-style', get_stylesheet_uri(), array(), '1.0', 'all' );    
}
add_action( 'wp_enqueue_scripts', 'enqueue_style_async', 9999 );

/* Allow .webp uploads */
function enable_webp_upload( $mime_types ) {
    $mime_types['webp'] = 'image/webp';
    return $mime_types;
}
add_filter( 'upload_mimes', 'enable_webp_upload' );

/* Return breadcrumbs*/
function get_breadcrumbs() {
    global $post;
    $homeLink = get_home_url();
    $breadcrumb = array();
    $pageUrl = get_permalink();

    // Remove home URL
    $pageUrl = str_replace($homeLink, '', $pageUrl);

    // Split URL into parts
    $urlParts = explode('/', trim($pageUrl, '/'));

    // Add home breadcrumb
    $breadcrumb[] = '<a href="' . esc_url($homeLink) . '">Start</a>';

    // Add other breadcrumbs
    $breadcrumbUrl = $homeLink;    
    foreach ($urlParts as $part) 
    {                       
        if(empty($part)){
            continue;
        }
        
        $breadcrumbUrl .= '/' . $part;
        $breadcrumb[] = '<a href="' . esc_url($breadcrumbUrl) . '">' . esc_html(ucfirst($part)) . '</a>';        
    }

    // Strip breadcrumb array to length of 2
    if (count($breadcrumb) > 2) {
        $breadcrumb = array_slice($breadcrumb, 0, 2);
    }    

    $spacer = '<p class="font-spacer">|</p>';
    
    if(count($breadcrumb) == 1){
        $spacer = '';
    }


    // Convert breadcrumb array to string with the specified separator
    $breadcrumb_string = implode($spacer, $breadcrumb);

    return $breadcrumb_string;
}

/*Register Menus*/
function register_menus() {
    register_nav_menus(
        array(
            'main-menu' => __('Main Menu', 'text-domain'),
            'footer-menu' => __('Footer Menu', 'text-domain')
        )
    );
}
add_action('init', 'register_menus');

/* Remove WordPress emojis */
function remove_emojis() {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    add_filter('emoji_svg_url', '__return_false');
    add_filter('tiny_mce_plugins', 'disable_emojis_tinymce');
}
add_action('init', 'remove_emojis');

function disable_emojis_tinymce($plugins) {
    if (is_array($plugins)) {
        return array_diff($plugins, array('wpemoji'));
    } else {
        return array();
    }
}

// replace ninja forms classes
// function replace_ninja_forms_scripts() {
//     wp_enqueue_script('replace-ninja-forms-classes', get_template_directory_uri() . '/js/theme/ninja-forms-class-replacer.js', array('jquery'), '1.0', true);
// }
// add_action('wp_enqueue_scripts', 'replace_ninja_forms_scripts');

// // Remove WP version from scripts, unloading gutenberg styles
// remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
// remove_action( 'wp_footer', 'wp_enqueue_global_styles', 1 );
// remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );

// add_action( 'wp_enqueue_scripts', function() {
//   wp_dequeue_style( 'wp-block-library' );
//   wp_dequeue_style( 'wp-block-library-theme' );
//   wp_dequeue_style( 'classic-theme-styles' );
// } );

// add_filter( 'should_load_separate_core_block_assets', '__return_true' );
?>