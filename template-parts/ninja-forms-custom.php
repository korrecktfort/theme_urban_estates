
<div id ="visible-fields">
    
    <div class="form-row">
        <div class="form-container">
            <input 
            id="nf-field-13-visible" 
            class="" 
            type="text" 
            name="nf-field-13-visible"
            autocomplete="name">
            
            Vorname
        </div>
        
        <div class="form-container">
            <input
            id="nf-field-14-visible"
            class=""
            type="text"
            name="nf-field-14-visible"
            autocomplete="name">
            
            Nachname
        </div>
    </div>
    
    <div class="form-container">
        <input
        id="nf-field-7-visible"
        class=""
        type="email"
        name="nf-field-7-visible"
        autocomplete="email">
        
        E-Mail
    </div>
    
    <div class="form-container">
        <input
        id="nf-field-8-visible"
        class=""
        type="tel"
        name="nf-field-8-visible"
        autocomplete="tel">
        
        Telefon
    </div>
    
    <div class="form-container">
        <input
        id="nf-field-9-visible"
        class=""
        type="checkbox"
        name="nf-field-9-visible">
        
        Besichtigungstermin vereinbaren
    </div>
    
    <div class="form-container">
        <input
        id="nf-field-10-visible"
        class=""
        type="checkbox"
        name="nf-field-10-visible">
        
        Ich akzeptiere den Umgang mit meinen Daten
    </div>
    
    <div id="nf-field-11-container">
        <div id="nf-field-11-wrap" class="form-container" data-field-id="11">
            <input
            id="nf-field-11-visible"
            class=""
            type="submit"
            name="nf-field-11-visible"
            value="Exposé anfordern">
        </div>
    </div>
</div>
    
    
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {    
        var submitButton = document.getElementById('nf-field-11-visible');        
        
        // Custom logic before submitting
        submitButton.addEventListener('click', function(event) {
            // Prevent default submission if needed
            event.preventDefault();
            
            // Custom logic before form submission
            console.log('Form is being submitted');
            
            // Optionally trigger the form submission programmatically
            var form = document.querySelector('#hidden-ninja-form form');

            console.log('Form:', form);
            console.log('Form elements:', form.elements);
            
            document.getElementById('nf-field-13').value = document.getElementById('nf-field-13-visible').value;
            document.getElementById('nf-field-14').value = document.getElementById('nf-field-14-visible').value;
            document.getElementById('nf-field-7').value = document.getElementById('nf-field-7-visible').value;
            document.getElementById('nf-field-8').value = document.getElementById('nf-field-8-visible').value;

            var checkboxHidden9 = document.getElementById('nf-field-9');
            var checkboxVisible9 = document.getElementById('nf-field-9-visible');

            if(checkboxHidden9.checked != checkboxVisible9.checked) {
                checkboxHidden9.click();
            }

            var checkboxHidden10 = document.getElementById('nf-field-10');
            var checkboxVisible10 = document.getElementById('nf-field-10-visible');
            if(checkboxHidden10.checked != checkboxVisible10.checked) {
                checkboxHidden10.click();
            }
           
            document.getElementById('nf-field-11').click();
            // form.submitButton.click();
        });
    });
</script>