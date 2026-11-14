jQuery(document).ready(function($) {
    $('.ue_options_select_image').on('click', function(e) {
        e.preventDefault();
        var $this = $(this);
        var $wrapper = $this.siblings('.ue_options_image_preview_wrapper');
        var $inputField = $this.siblings('.ue_options_image_field');

        var images = wp.media({
            title: 'Select Image',
            multiple: true
        }).open()
        .on('select', function() {
            var imageUrls = [];
            var selection = images.state().get('selection');

            selection.each(function(attachment) {
                var imageUrl = attachment.attributes.url;
                imageUrls.push(imageUrl);
                $wrapper.append('<img src="' + imageUrl + '" class="ue_options_image_preview" />');
            });

            $inputField.val(imageUrls.join(','));
        });
    });
});