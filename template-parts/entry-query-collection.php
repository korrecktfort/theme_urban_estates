<?php
extract($args);

$attr = array(
    'category_name' => $category_name,
    'references' => $references,
);

$collection = get_urban_estate_posts($attr);
?>

<?php if($selection_bar): ?>
<div class="entry-preview-selection-bar">
    <div class="separator-cream"></div>        
</div>
<?php endif; ?>

<div class="entry-preview-collection-container">
    <div class="entry-preview-column left">
            <?php
        foreach ($collection as $index => $entry) {
            if ($index % 2 === 0) {
                if($references)
                {
                    get_template_part('template-parts/entry-preview-reference', null, $entry);
                } 
                else
                {
                    get_template_part('template-parts/entry-preview', null, $entry);
                }
            }
        }
        ?>
    </div>

    <div class="entry-preview-column right">
        <?php
        foreach ($collection as $index => $entry) {
            if ($index % 2 !== 0) {
                if($references)
                {
                    get_template_part('template-parts/entry-preview-reference', null, $entry);
                } 
                else
                {
                    get_template_part('template-parts/entry-preview', null, $entry);
                }
            }
        }
        ?>
    </div>
</div>