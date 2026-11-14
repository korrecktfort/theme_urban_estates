<?php
function get_adress_string()
{
    $address = get_ue_option('cp_name') . ' | ' . get_ue_option('cp_address_street') . ' | ' . get_ue_option('cp_address_zip_city');
    return '<p>' . $address . '</p>';
}
add_shortcode('address', 'get_adress_string');

#region Buttons
function button($attr)
{    
    $symbol = '';

    if(!empty($attr['symbol']))
    {
        $symbol = $attr['symbol'];
    }

    echo '<a  href="' . $attr['link'] . '"><div class="button">'. $symbol . '<p>' . $attr['text'] . '</p></div></a>';  
}
add_shortcode('button', 'button');

function button_mail_full()
{
    return button(['text' => get_ue_option('cp_email'), 'link' => 'mailto:' . get_ue_option('cp_email')]);    
}
add_shortcode('button_mail_full', 'button_mail_full');

function button_mail($args)
{
    $text = 'E-Mail';

    if(isset($args['text']))
    {
        $text = $args['text'];
    }

    return button(['text' => $text, 'link' => 'mailto:' . get_ue_option('cp_email')]);    
}
add_shortcode('button_mail', 'button_mail');

function button_phone()
{
    return button(['text' => 'Telefon', 'link' => 'tel:' . get_ue_option('cp_phone')]);    
}
add_shortcode('button_phone', 'button_phone');

function button_phone_full()
{
    return button(['text' => get_ue_option('cp_phone'), 'link' => 'tel:' . get_ue_option('cp_phone')]);    
}
add_shortcode('button_phone_full', 'button_phone_full');

function button_search()
{
    return button(['symbol' => '<div class="magnify"></div>', 'text' => 'Suchauftrag', 'link' => 'mailto:' . get_ue_option('cp_email')]);    
}
add_shortcode('button_search', 'button_search');

function button_expose()
{
    return button(['symbol' => '<div class="arrow"></div>','text' => 'Expose anfordern', 'link' => 'mailto:' . get_ue_option('cp_email')]);    
}
add_shortcode('button_expose', 'button_expose');

function button_location($attr)
{
    $home_url = get_home_url();
    return button(['text' => $attr['text'], 'link' => $home_url . "/" . $attr['slug']]);    
}
add_shortcode('button_location', 'button_location');

#endregion

#region Styling
function body_container_start($attr)
{
    $class = isset($attr['class']) ? ' ' . $attr['class'] : '';

    return '<div class="body-container' . $class . '">';
}
add_shortcode('body_container_start', 'body_container_start');

function body_container_start_cream(){
    return body_container_start(['class' => 'bg-cream']);
}
add_shortcode('body_container_start_cream', 'body_container_start_cream');

function body_container_end()
{
    return '</div>';
}
add_shortcode('body_container_end', 'body_container_end');

#endregion

#region Entry Data Pair
function entry_data_pair($attr)
{
    if (!empty($attr['symbol'])) {
        $symbol = '<div class="data-pair-symbol ' . $attr['symbol'] . '"></div>';
    } else {
        $symbol = '';
    }

    return '<div class="entry-data-pair">
                ' . $symbol . '
                <p>' . $attr['label'] . '</p>
                <b>' . $attr['value'] . '</b>
            </div>';
}

function data_living_space($attr)
{
    return entry_data_pair(['label' => 'Wohnfläche', 'value' => $attr['value'] . ' m²']);
}
add_shortcode('data_living_space', 'data_living_space');

function data_living_space_symbol($attr)
{
    return entry_data_pair(['label' => 'Wohnfläche', 'value' => $attr['value'] . ' m²', 'symbol' => 'symbol-living-space']);
}
add_shortcode('data_living_space_symbol', 'data_living_space_symbol');

function data_rooms($attr)
{
    return entry_data_pair(['label' => 'Zimmer', 'value' => $attr['value']]);
}
add_shortcode('data_rooms', 'data_rooms');

function data_rooms_symbol($attr)
{
    return entry_data_pair(['label' => 'Zimmer', 'value' => $attr['value'], 'symbol' => 'symbol-rooms']);
}
add_shortcode('data_rooms_symbol', 'data_rooms_symbol');

function data_location($attr)
{
    return entry_data_pair(['label' => 'Standort', 'value' => $attr['value']]);
}
add_shortcode('data_location', 'data_location');

function data_price($attr)
{
    $formattedPrice = number_format($attr['value'], 0, ',', '.');
    return entry_data_pair(['label' => 'Kaufpreis', 'value' => $formattedPrice . ' €']);
}
add_shortcode('data_price', 'data_price');

function data_price_symbol($attr)
{
    $formattedPrice = number_format($attr['value'], 0, ',', '.');
    return entry_data_pair(['label' => 'Kaufpreis', 'value' => $formattedPrice . ' €', 'symbol' => 'symbol-price']);
}
add_shortcode('data_price_symbol', 'data_price_symbol');

function data_bathrooms($attr)
{
    return entry_data_pair(['label' => 'Badezimmer', 'value' => $attr['value']]);
}
add_shortcode('data_bathrooms', 'data_bathrooms');

function data_bathrooms_symbol($attr)
{
    return entry_data_pair(['label' => 'Badezimmer', 'value' => $attr['value'], 'symbol' => 'symbol-bathrooms']);
}
add_shortcode('data_bathrooms_symbol', 'data_bathrooms_symbol');

function data_balcony($attr)
{
    return entry_data_pair(['label' => 'Balkon', 'value' => $attr['value']]);
}
add_shortcode('data_balcony', 'data_balcony');

function data_balcony_symbol($attr)
{
    return entry_data_pair(['label' => 'Balkon', 'value' => $attr['value'], 'symbol' => 'symbol-balcony']);
}
add_shortcode('data_balcony_symbol', 'data_balcony_symbol');

function data_year($attr)
{
    return entry_data_pair(['label' => 'Baujahr', 'value' => $attr['value']]);
}
add_shortcode('data_year', 'data_year');

function data_year_symbol($attr)
{
    return entry_data_pair(['label' => 'Baujahr', 'value' => $attr['value'], 'symbol' => 'symbol-year']);
}
add_shortcode('data_year_symbol', 'data_year_symbol');

function data_terrace($attr)
{
    return entry_data_pair(['label' => 'Terrasse', 'value' => $attr['value']]);
}
add_shortcode('data_terrace', 'data_terrace');

function data_terrace_symbol($attr)
{
    return entry_data_pair(['label' => 'Terrasse', 'value' => $attr['value'], 'symbol' => 'symbol-terrace']);
}
add_shortcode('data_terrace_symbol', 'data_terrace_symbol');

function data_car_spot($attr)
{
    return entry_data_pair(['label' => 'Stellplatz', 'value' => $attr['value']]);
}
add_shortcode('data_car_spot', 'data_car_spot');

function data_car_spot_symbol($attr)
{
    return entry_data_pair(['label' => 'Stellplatz', 'value' => $attr['value'], 'symbol' => 'symbol-car-spot']);
}
add_shortcode('data_car_spot_symbol', 'data_car_spot_symbol');

function data_sleeping_room($attr)
{
    return entry_data_pair(['label' => 'Schlafzimmer', 'value' => $attr['value']]);
}
add_shortcode('data_sleeping_room', 'data_sleeping_room');

function data_sleeping_room_symbol($attr)
{
    return entry_data_pair(['label' => 'Schlafzimmer', 'value' => $attr['value'], 'symbol' => 'symbol-sleeping-room']);
}
add_shortcode('data_sleeping_room_symbol', 'data_sleeping_room_symbol');

function data_property_size($attr)
{
    return entry_data_pair(['label' => 'Grundstücksfläche', 'value' => $attr['value'] . ' m²']);
}
add_shortcode('data_property_size', 'data_property_size');

function data_property_size_symbol($attr)
{
    return entry_data_pair(['label' => 'Grundstücksfläche', 'value' => $attr['value'] . ' m²', 'symbol' => 'symbol-property-size']);
}
add_shortcode('data_property_size_symbol', 'data_property_size_symbol');
#endregion

/*#region Display Entries*/
function display_entries($attr)
{
    ob_start();
    get_template_part('template-parts/entry-query-collection', null, $attr); 
    return ob_get_clean();
}
add_shortcode('display_entries', 'display_entries');

function display_entries_berlin()
{
    return display_entries(['category_name' => 'berlin', 'selection_bar' => true]);
}
add_shortcode('display_entries_berlin', 'display_entries_berlin');

function display_entries_references()
{
    return display_entries(['category_name' => 'referenzen', 'selection_bar' => false]);
}
add_shortcode('display_entries_references', 'display_entries_references');
/*#endregion*/

/*#region Horizontal Hover*/
function horizontal_hover($attr)
{
    ob_start();
    get_template_part('template-parts/horizontal-hover', null, $attr); 
    return ob_get_clean();
}
add_shortcode('horizontal_hover', 'horizontal_hover');
/*#endregion*/
?>