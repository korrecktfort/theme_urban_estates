<?php
// Urban estates options page
// Define sections and fields
$options_sections = array(
    array(
        'id' => 'section_general',
        'title' => 'General Settings',
        'fields' => array(
            array(
                'id' => 'cp_name',
                'label' => 'Company Name',
                'type' => 'text'
            ),
            array(
                'id' => 'cp_managing_director',
                'label' => 'Managing Director',
                'type' => 'text'
            ),
            array(
                'id' => 'cp_address_street',
                'label' => 'Company Street',
                'type' => 'text'
            ),
            array(
                'id' => 'cp_address_zip_city',
                'label' => 'Company ZIP Code And City',
                'type' => 'text'
            ),            
            array(
                'id' => 'cp_phone',
                'label' => 'Company Phone',
                'type' => 'text'
            ),
            array(
                'id' => 'cp_email',
                'label' => 'Company Email',
                'type' => 'email'
            ),
            array(
                'id' => 'j_email',
                'label' => 'Julien Email',
                'type' => 'email'
            ),
            array(
                'id' => 'main-logo-cream',
                'label' => 'Main Logo Cream',
                'type' => 'image'
            ),
            array(
                'id' => 'main-logo-monogram',
                'label' => 'Main Logo Monogram',
                'type' => 'image'
            ),
            array(
                'id' => 'main-logo-teal',
                'label' => 'Main Logo Teal',
                'type' => 'image'
            ),
            array(
                'id' => 'request-expose-image',
                'label' => 'Request Exposé Image',
                'type' => 'image'
            ),           
        )
    ),
    // Add more sections and fields as needed
);

// Register settings and add options page
function ue_options_settings() {
    global $options_sections;
    foreach ($options_sections as $section) {
        add_settings_section(
            $section['id'],
            $section['title'],
            'ue_options_section_callback',
            'ue_options_options'
        );

        foreach ($section['fields'] as $field) {
            add_settings_field(
                $field['id'],
                $field['label'],
                'ue_options_field_callback',
                'ue_options_options',
                $section['id'],
                array('field' => $field)
            );
        }
    }

    register_setting('ue_options_options', 'ue_options_name');
}

// Callback functions for sections and fields
function ue_options_section_callback($section) {
    echo '<p>' . esc_html($section['title']) . '</p>';
}

function ue_options_field_callback($args) {
    $field = $args['field'];
    $value = get_option('ue_options_name');
    $field_value = isset($value[$field['id']]) ? $value[$field['id']] : '';
    
    switch ($field['type']) {
        case 'text':
            echo '<input type="text" name="ue_options_name[' . esc_attr($field['id']) . ']" value="' . esc_attr($field_value) . '" />' ;
            break;
        case 'textarea':
                echo '<textarea name="ue_options_name[' . esc_attr($field['id']) . ']">' . esc_textarea($field_value) . '</textarea>';
            break;
                case 'checkbox':
                echo '<input type="checkbox" name="ue_options_name[' . esc_attr($field['id']) . ']" value="1" ' . checked(1, $field_value, false) . ' />';
            break;
            case 'select':
                echo '<select name="ue_options_name[' . esc_attr($field['id']) . ']">';
                foreach ($field['options'] as $option) {
                    echo '<option value="' . esc_attr($option) . '" ' . selected($field_value, $option, false) . '>' . esc_html($option) . '</option>';
                }
                echo '</select>';
            break;
            case 'radio':
                foreach ($field['options'] as $option) {
                    echo '<label><input type="radio" name="ue_options_name[' . esc_attr($field['id']) . ']" value="' . esc_attr($option) . '" ' . checked($field_value, $option, false) . ' />' . esc_html($option) . '</label><br />';
                }
            break;
            case 'image':
                echo '<input type="hidden" name="ue_options_name[' . esc_attr($field['id']) . ']" class="ue_options_image_field" value="' . esc_attr($field_value) . '" />';
                echo '<input type="button" value="Select Image" class="button ue_options_select_image" />';
                echo '<div class="ue_options_image_preview_wrapper">';
                if (!empty($field_value)) {
                    $images = explode(',', $field_value);
                    foreach ($images as $image) {
                        echo '<img src="' . esc_attr($image) . '" class="ue_options_image_preview" style="max-width: 300px; margin-top: 5px;" />';
                    }
                }
                echo '</div>';
                break;
            case 'color':
                echo '<input type="text" name="ue_options_name[' . esc_attr($field['id']) . ']" value="' . esc_attr($field_value) . '" class="ue_options_color_field" />';
                break;
                case 'file':
                echo '<input type="text" name="ue_options_name[' . esc_attr($field['id']) . ']" value="' . esc_attr($field_value) . '" />';
                echo '<input type="button" value="Upload File" class="button" id="ue_options_upload_file" />';
                break;
                case 'number':
                echo '<input type="number" name="ue_options_name[' . esc_attr($field['id']) . ']" value="' . esc_attr($field_value) . '" />';
                break;
                case 'email':
                echo '<input type="email" name="ue_options_name[' . esc_attr($field['id']) . ']" value="' . esc_attr($field_value) . '" />';
                break;
                case 'password':
                    echo '<input type="password" name="ue_options_name[' . esc_attr($field['id']) . ']" value="' . esc_attr($field_value) . '" />';
                    break;
                case 'url':
                    echo '<input type="url" name="ue_options_name[' . esc_attr($field['id']) . ']" value="' . esc_attr($field_value) . '" />';
                    break;
                case 'date':
                    echo '<input type="date" name="ue_options_name[' . esc_attr($field['id']) . ']" value="' . esc_attr($field_value) . '" />';
                    break;
                case 'time':
                    echo '<input type="time" name="ue_options_name[' . esc_attr($field['id']) . ']" value="' . esc_attr($field_value) . '" />';
                    break;
                case 'week':
                    echo '<input type="week" name="ue_options_name[' . esc_attr($field['id']) . ']" value="' . esc_attr($field_value) . '" />';
                    break;
                case 'month':
                    echo '<input type="month" name="ue_options_name[' . esc_attr($field['id']) . ']" value="' . esc_attr($field_value) . '" />';
                    break;
                case 'range':
                    echo '<input type="range" name="ue_options_name[' . esc_attr($field['id']) . ']" value="' . esc_attr($field_value) . '" />';
                    break;
                case 'hidden':
                    echo '<input type="hidden" name="ue_options_name[' . esc_attr($field['id']) . ']" value="' . esc_attr($field_value) . '" />';
                    break;
                case 'reset':
                    echo '<input type="reset" name="ue_options_name[' . esc_attr($field['id']) . ']" value="' . esc_attr($field_value) . '" />';
                    break;
                case 'submit':
                    echo '<input type="submit" name="ue_options_name[' . esc_attr($field['id']) . ']" value="' . esc_attr($field_value) . '" />';
                    break;
                default:
                    echo 'Invalid field type';
                    break;
                }
    echo '<p class="description">' . esc_attr($field['id']) . '</p>';
}

function ue_enqueue_scripts() {
    wp_enqueue_media(); // This will enqueue the necessary media scripts
    wp_enqueue_script('ue-custom-script', get_template_directory_uri() . '/js/theme/options-open-image-button.js', array('jquery'), '1.0', true);
}
add_action('admin_enqueue_scripts', 'ue_enqueue_scripts');


// Add options page
function ue_options_add_options_page() {
    add_options_page('Urban Estates Options', 'Urban Estates Options', 'manage_options', 'ue_options_options', 'ue_options_options_page');
}

// Options page content
function ue_options_options_page() {
    ?>
    <div class="wrap">
        <h2>Urban Estates Options</h2>
        <form method="post" action="options.php">
            <?php settings_fields('ue_options_options'); ?>
            <?php do_settings_sections('ue_options_options'); ?>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

// Hook functions into WordPress
add_action('admin_init', 'ue_options_settings');
add_action('admin_menu', 'ue_options_add_options_page');

function get_ue_option($field_name){
    $options = get_option('ue_options_name');
    return $options[$field_name];
}

function get_image_data($image_url) {
    $image_data = array();

    if (empty($image_url)) {
        return $image_data;
    }

    $attachment_id = attachment_url_to_postid($image_url);

    // Fallback for content imported from a different domain: attachment_url_to_postid()
    // only matches if $image_url still starts with the current site's upload base URL,
    // so rebuild the URL using the current baseurl and retry via the relative path.
    if (!$attachment_id) {
        $url_path = wp_parse_url($image_url, PHP_URL_PATH);
        $upload_dir = wp_get_upload_dir();
        $base_path = wp_parse_url($upload_dir['baseurl'], PHP_URL_PATH);

        if ($url_path && $base_path && strpos($url_path, $base_path) === 0) {
            $rebuilt_url = $upload_dir['baseurl'] . substr($url_path, strlen($base_path));
            $attachment_id = attachment_url_to_postid($rebuilt_url);
        }
    }

    if ($attachment_id) {
        $image_data['url'] = wp_get_attachment_url($attachment_id);
        $image_data['alt'] = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);
    }

    return $image_data;
}
?>