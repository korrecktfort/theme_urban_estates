<?php 
function register_urban_estates_post_type(){
    $labels = array(
        'name' => 'Urban Estates',
        'singular_name' => 'Urban Estate',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Urban Estate',
        'edit_item' => 'Edit Urban Estate',
        'new_item' => 'New Urban Estate',
        'view_item' => 'View Urban Estate',
        'search_items' => 'Search Urban Estates',
        'not_found' => 'No Urban Estates found',
        'not_found_in_trash' => 'No Urban Estates found in Trash',
        'parent_item_colon' => '',
        'menu_name' => 'Urban Estates'
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'immobilien'),
        'capability_type' => 'post',
        'has_archive' => false,
        'hierarchical' => false,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-admin-multisite',
        'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt')
    );
    register_post_type('urban_estates', $args);
}
add_action('init', 'register_urban_estates_post_type');

function enqueue_custom_admin_script($hook) {
        // // Enqueue script only on the edit.php screen for your custom post type
     if ($hook == 'edit.php' && isset($_GET['post_type']) && $_GET['post_type'] == 'urban_estates') {
         wp_enqueue_script('admin-create-urban-posts-button', get_template_directory_uri() . '/js/theme/create-urban-posts-button.js', array('jquery'), '1.0', true);         
         wp_localize_script('admin-create-urban-posts-button', 'urban_estates_vars', array(
             'ajaxurl' => admin_url('admin-ajax.php'),
             'nonce' => wp_create_nonce('create_urban_estates_posts'),
             'action' => 'create_urban_estates_posts',
         ));
    }
}
add_action('admin_enqueue_scripts', 'enqueue_custom_admin_script');

function create_urban_estates_posts()
{
    // Rate limiting parameters
    $limit = 10; // Maximum number of requests allowed
    $interval = 60; // Time interval in seconds (e.g., 60 seconds)

    // Get the IP address of the client
    $ip = $_SERVER['REMOTE_ADDR'];

    // Get the current count of requests for this IP address
    $request_count = get_transient('ajax_request_count_' . $ip);

    // If the request count exceeds the limit, return an error
    if ($request_count && $request_count >= $limit) {
        wp_send_json_error('Rate limit exceeded');
    }

    // Increment the request count for this IP address
    $request_count = $request_count ? $request_count + 1 : 1;
    set_transient('ajax_request_count_' . $ip, $request_count, $interval);

    // Verify nonce
    if (! isset( $_POST['nonce'] ) ||  !wp_verify_nonce( $_POST['nonce'], 'create_urban_estates_posts' ) ) {
        // Nonce verification failed
        wp_send_json_error( 'Nonce verification failed' );
    }

    clear_all_posts_of_post_type('urban_estates');
    create_ue_posts();

    flush_rewrite_rules();
    wp_die();
}


function clear_all_posts_of_post_type($post_type){
    $posts = get_posts(array(
        'post_type' => $post_type,
        'numberposts' => -1,
    ));
    
    foreach ($posts as $post) {
        wp_delete_post($post->ID, true);
    }
}

function create_ue_posts()
{
    $immomakler_posts = array(
        'post_type' => 'immomakler_object',
        'post_status' => 'publish',
        'posts_per_page' => -1,
    );
    
    $immomakler_query = new WP_Query($immomakler_posts);
    
    if ($immomakler_query->have_posts()) 
    {
        while ($immomakler_query->have_posts()) 
        {            
            $immomakler_query->the_post();
            $id = get_the_ID();
            
            $new_post_id = wp_insert_post(array(                
                'post_title' => get_post_meta($id, 'objekttitel', true),
                'post_excerpt' => get_the_excerpt($id),
                'post_status' => get_post_status($id),
                'post_type' => 'urban_estates',
                'page_template' => 'single-urban_estates.php',
            ));
            
            update_field('related_immomakler_id', $id, $new_post_id);
            
            // set acf styling settings
            update_field('labels-color', 'Teal', $new_post_id);
            update_field('display-background-image', false, $new_post_id);
            update_field('top-background-color', '#FFFFF', $new_post_id);
            
            update_field('display_bottom_area', true, $new_post_id);
            update_field('bottom_area_left_column_type', 'ExposeRequest', $new_post_id);
            update_field('bottom_area_right_column_type', 'ExposeRequestForm', $new_post_id);
        }
        wp_reset_postdata();
    }
}

// Called when clicking the create ue posts button in the admin panel
add_action('wp_ajax_create_urban_estates_posts', 'create_urban_estates_posts');

// Called when clicking the immomakler import button in the admin panel
add_action('immomakler_after_import_filelist', 'create_urban_estates_posts', 10, 1);

function schedule_cron_job_urban_estates() {
    if( !wp_next_scheduled( 'cron_job_hook_urban_estates' ) ) {  
        wp_schedule_event( time(), 'every_two_minutes', 'cron_job_hook_urban_estates' );  
        $log_file = get_template_directory() . '/logs/cronjobs.log';
        $log_message = 'Cron job scheduled at ' . date('Y-m-d H:i:s') . PHP_EOL;
        file_put_contents($log_file, $log_message, FILE_APPEND);
    }
    else
    {
        $log_file = get_template_directory() . '/logs/cronjobs.log';
        $log_message = 'Cron job already scheduled at ' . date('Y-m-d H:i:s') . PHP_EOL;
        file_put_contents($log_file, $log_message, FILE_APPEND);    
    }
}
add_action('wp', 'schedule_cron_job_urban_estates');

function cron_interval_two_minutes( $schedules ) {
    $schedules['every_two_minutes'] = array(
        'interval' => 150, // in seconds
        'display' => __( 'Every 2.5 Minutes' )
    );
    return $schedules;
}
add_filter( 'cron_schedules', 'cron_interval_two_minutes' );

function cron_job_urban_estates_create_posts()
{
    clear_all_posts_of_post_type('urban_estates');
    create_ue_posts();
    flush_rewrite_rules();

    $log_file = get_template_directory() . '/logs/cronjobs.log';
    $log_message = 'Cron job executed at ' . date('Y-m-d H:i:s') . PHP_EOL;
    file_put_contents($log_file, $log_message, FILE_APPEND);
}
// remove_action('cron_job_hook_urban_estates', 'cron_job_urban_estates_create_posts');
add_action('cron_job_hook_urban_estates', 'cron_job_urban_estates_create_posts');
?>