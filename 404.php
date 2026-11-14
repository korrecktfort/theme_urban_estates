<?php get_header(null, ['top-bar-color' => '#003D38', 'labels-color' => 'Cream']); ?>

<div class="body-container">
    <div class="body_content_container">
        <div class="fzf-content">
            <h1>404 - Seite nicht gefunden</h1>
            <p>Die angeforderte Seite konnte nicht gefunden werden.</p>
            <p>Bitte überprüfen Sie die URL oder verwenden Sie die Navigation, um zur gewünschten Seite zu gelangen.</p>
            <button class="button button-teal-hollow" onclick="window.history.back()"><div class="arrow arrow-left"></div><p>Zurück</p></button>            
        </div>
    </div>
</div>

<?php get_footer(null, ['display_bottom_area' => true, 'left_column_type' => 'ContactUs', 'contact_us_title' => 'Wir freuen uns Sie kennenzulernen.']); ?>