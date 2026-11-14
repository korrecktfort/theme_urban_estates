<?php
extract($args); // extract 'collection'
?>

<!-- Display Active Entries Filtered -->
<div class="entry-preview-collection-container-references">    
    <?php
        foreach ($collection as $index => $entry)
        {            
            get_template_part('template-parts/entry-preview-reference', null, $entry);            
        }
    ?> 
</div>
