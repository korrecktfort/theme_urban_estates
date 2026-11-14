jQuery(document).ready(function($) {
    // Append the custom button next to the "Add New" button
    $('.wrap a:first').html('<a href="#">Update Urban Estates</a>');
    
    // Handle button click event
    $('#wpbody-content .wrap').on('click', '.page-title-action', function(e) {        
        // Add your button click functionality here
        console.log('Button clicked');             

        console.log(urban_estates_vars.ajaxurl);

        $.ajax({
            type: "POST",
            url: urban_estates_vars.ajaxurl,
            data: {
                action: urban_estates_vars.action,
                nonce: urban_estates_vars.nonce,                
            },
            success: function (output) {
                console.log(output);
                location.reload();
            },
            error: function (error) {
                console.log(error);
            }
        });
        
    });
});