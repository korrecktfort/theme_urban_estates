<?php 
#region Entry Gallery
function get_urban_estate_posts($attr)
{
    $args = array(
        'post_type' => 'urban_estates',
        'post_status' => 'publish',
        'posts_per_page' => -1,        
    );

    $location = array_key_exists('location', $attr) ? $attr['location'] : '';
    $location = strtolower($location);
    
    $query = new WP_Query($args);
    $template_args_array = array();

    if ($query->have_posts()) 
    {
        while ($query->have_posts()) 
        {    
            $query->the_post();
            $id = get_the_ID();
            $related_immomakler_id = get_post_meta(get_the_ID(), 'related_immomakler_id', true);
            
            $displayReferences = array_key_exists('references', $attr) && $attr['references'];
            // 'verkaufstatus' postmeta doesn't exist; status is the 'immomakler_object_status'
            // taxonomy, so sold and rented properties go to the references section together.
            $isReference = \ImmoMakler\Data\Property_Status::is_sold_or_rented($related_immomakler_id);

            if($displayReferences && !$isReference || !$displayReferences && $isReference)
            {
                continue;
            }

            $id_location = get_post_meta($related_immomakler_id, 'ort', true); 
            $id_location = strtolower($id_location);           
            $id_location = trim($id_location);

            // if we are looking for a location but the post is not categorized for that
            // location, continue. e.g. if we are looking for 'Berlin' but the post is
            // categorized as 'Munich', continue.
            if (!empty($location) && strpos($id_location, $location) === false) {                
                continue;
            }
            
            $images_args = array(
                'post_parent' => $related_immomakler_id,
                'numberposts' => -1,
                'post_type'   => 'attachment',
                'post_mime_type' => 'image',
                'orderby'     => 'menu_order ID',
                'order'       => 'ASC'
                );
            $image_attachements = get_posts( $images_args );            
            
            if(empty($image_attachements) || count($image_attachements) == 0){
                continue;
            }

            $img_url = '';
            if(!empty($image_attachements)){                
                $img_url = $image_attachements[0]->guid;
            }    

            $templateArgs = array(            
                'link' => get_permalink($id),    
                'image_url' => $img_url,
                'title' =>  get_post_meta($related_immomakler_id, 'objekttitel', true),
                'summary' => get_the_excerpt($related_immomakler_id),
                'livingSpace' => get_post_meta($related_immomakler_id, 'wohnflaeche', true),
                'rooms' => get_post_meta($related_immomakler_id, 'anzahl_zimmer', true),
                'district' => get_post_meta($related_immomakler_id, 'ort', true),
            );
            $template_args_array[] = $templateArgs;
        }
        wp_reset_postdata();
    }    

    return $template_args_array;
}

function ausstatt_to_array($string)
{
    $normalizedText = str_replace(["\r\n", "\r", "- ", "• "], '\n', $string);
    $array = explode('\n', $normalizedText);

    $array = array_filter($array, function($item) {
        return !empty(trim($item));
    });

    $array = array_map((function($item) {        
        return trim($item, "• ");
    }), $array);

    return $array;
}

function custom_immomakler_searchable_postmeta_keys( $immomakler_metakeys ) {
    $immomakler_metakeys[] ='sonstige_angaben';
    $immomakler_metakeys[] ='objektbeschreibungExpose';
    return $immomakler_metakeys;
}
add_filter( 'immomakler_searchable_postmeta_keys', 'custom_immomakler_searchable_postmeta_keys' );

function has_value($value)
{
    return !empty($value) && $value != '0';
}

function collection_contains_location($collection, $location)
{   
    $location = strtolower($location);

    foreach ($collection as $entry) 
    {
        $entry_location = strtolower($entry['district']);

        if (!empty($entry_location) && strpos($entry_location, $location) !== false) {
            return true;
        }        
    }
    return false;
}
?>