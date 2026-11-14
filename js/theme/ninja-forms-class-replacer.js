jQuery(document).ready(function($) {
// Define the mappings of old classes to new classes
var classMappings = {
    'nf-form-cont': 'ue-form-cont',
    'nf-form-title': 'ue-form-title',
    'nf-form-wrap': 'ue-form-wrap',
    'nf-response-msg': 'ue-response-msg',
    'nf-debug-msg': 'ue-debug-msg',
    'nf-before-form': 'ue-before-form',
    'nf-form-layout': 'ue-form-layout',
    'nf-before-form-content': 'ue-before-form-content',
    'nf-form-fields-required': 'ue-form-fields-required',
    'nf-form-content': 'ue-form-content',
    'nf-fields-wrap': 'ue-fields-wrap',
    'nf-field-container': 'ue-field-container',
    'nf-before-field': 'ue-before-field',
    'nf-field': 'ue-field',
    'nf-field-element': 'ue-field-element',
    'nf-after-field': 'ue-after-field',
    'nf-input-limit': 'ue-input-limit',
    'nf-error-wrap': 'ue-error-wrap',
    'nf-error': 'ue-error',
    'nf-form-errors': 'ue-form-errors',
    // 'nf-form-hp': 'ue-form-hp',
    'nf-field-hp': 'ue-field-hp',
    'nf-field-label': 'ue-field-label',
    'ninja-forms-req-symbol': 'ue-req-symbol',
    'nf-after-form': 'ue-after-form',
    'ninja-forms-field': 'ue-forms-field',
    // 'nf-element': 'ue-element',
    'nf-field' : 'ue-field',
};

    // Define a function to replace classes
    function replaceClasses() {
        // Check if any of the old classes exist
        var allModified = true;
        for (var oldClass in classMappings) {
            if (classMappings.hasOwnProperty(oldClass)) {
                var $elements = jQuery('.' + oldClass);
                if ($elements.length > 0) {
                    // Replace the old class with the corresponding new class for each element
                    $elements.addClass(classMappings[oldClass]).removeClass(oldClass);
                } else {
                    // If any old class is not found, set allModified to false
                    allModified = false;
                }
            }
        }
        
        // If all old classes have been modified, stop the interval
        if (allModified) {
            clearInterval(intervalId);
        }
    }

    // Call the function initially
    replaceClasses();

    // Set an interval to continuously check for elements with old classes
    var intervalId = setInterval(replaceClasses, 100); // Adjust the interval as needed
});