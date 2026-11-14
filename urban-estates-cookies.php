<?php

function enqueue_adobe_style_async() {
    wp_dequeue_style( 'adobe-fonts-stylesheet' );

    $CookieConsent = array_column(array_map(function ($pair) {
        return explode(':', $pair);
    }, explode(',', $_COOKIE['cookieyes-consent'])), 1, 0);

    if (filter_var($CookieConsent['functional'], FILTER_VALIDATE_BOOLEAN)) 
    {
        wp_enqueue_style( 'adobe-fonts-stylesheet', "https://use.typekit.net/ukq8mny.css", array(), '1.0', 'all' );
    }
}
add_action( 'wp_enqueue_scripts', 'enqueue_adobe_style_async', 9999 );

function unload_adobe_style_async()
{
    $CookieConsent = array_column(array_map(function ($pair) {
        return explode(':', $pair);
    }, explode(',', $_COOKIE['cookieyes-consent'])), 1, 0);

    if (filter_var($CookieConsent['functional'], FILTER_VALIDATE_BOOLEAN)) 
    {
        return;
    }

    wp_dequeue_style( 'adobe-fonts-stylesheet' );

    echo '<script>
    var adobeFontsStylesheet = document.getElementById("adobe-fonts-stylesheet");
    if (adobeFontsStylesheet) {
        adobeFontsStylesheet.remove();
    }
    </script>';
}
add_action('wp_footer', 'unload_adobe_style_async');
?>