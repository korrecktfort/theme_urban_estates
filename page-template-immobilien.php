<?php
/**
 * Template Name: Immobilien
 *
 * @package Urban_Estates
 */
?>

<?php get_header();?>

<?php
$collection = get_urban_estate_posts([]);
$references = get_urban_estate_posts(['references' => true]);

$containsBerlin = collection_contains_location($collection, 'berlin');
$containsPotsdam = collection_contains_location($collection, 'potsdam');
$containsHamburg = collection_contains_location($collection, 'hamburg');
$collectionCount = 0;
if($containsBerlin) $collectionCount++;
if($containsPotsdam) $collectionCount++;
if($containsHamburg) $collectionCount++;

$moreThanTwoLocations = $collectionCount > 1;
?>

<div class="below-header-spacer burger-toggle"></div>
<div class="body-container">
    <div class="body_content_container">
        <div class="body-standard-header-text-block">
            <h2><?php echo get_field('top_textblock_title') ?></h2>
            <p><?php echo get_field('top_textblock_text') ?></p>
        </div>


        <!-- Display Selection Bar (Toggle Buttons Locations)-->
        <div class="entry-preview-selection-bar">
            <div class="separator-cream <?php if($moreThanTwoLocations) echo 'displaying-location-buttons'?>"></div>   
            
            <?php if($moreThanTwoLocations):?>
                <!-- Display Location Buttons -->
                <?php if($containsBerlin || $containsPotsdam || $containsHamburg):?>
                <button onclick="unfilterEntries()" class="button button-teal-hollow"><p>Alle</p></button>
                <?php endif;?>

                <?php if($containsBerlin):?>
                <button onclick="filterEntries('berlin')" class="button button-teal-hollow"><p>Berlin</p></button>
                <?php endif;?>

                <?php if($containsPotsdam):?>
                <button onclick="filterEntries('potsdam')" class="button button-teal-hollow"><p>Potsdam</p></button> 
                <?php endif;?>

                <?php if($containsHamburg):?>
                <button onclick="filterEntries('hamburg')" class="button button-teal-hollow"><p>Hamburg</p></button>         
                <?php endif;?>
            <?php endif;?>
        </div>

        <!-- Display Active Entries Filtered -->
        <?php get_template_part('template-parts/immobilien-display-active', null, ['collection' => $collection]); ?>
    </div>
</div>

<div class="body-container bg-cream">
    <div class="body_content_container">
        <div class="body-standard-header-text-block">
            <h2><?php echo get_field('references_textblock_title') ?></h2>
            <p><?php echo get_field('references_textblock_text') ?></p>
        </div>
        
        <!-- Display Refrence Entries -->
        <?php get_template_part('template-parts/immobilien-display-references', null, ['collection' => $references]); ?>
    </div>
</div>
<?php get_footer();?>


<script>

    var elem;
    var msnry;

    var refElem;
    var refMsnry;

    document.addEventListener('DOMContentLoaded', function() {  
        elem = document.querySelector('.entry-preview-collection-container');
        
        if(elem !== null)
        {
            
            msnry = new Masonry(elem, {
                itemSelector: '.entry-preview',
                columnWidth: 500,
                gutter: 200,
                fitWidth: true,
                originLeft: true,
            });
        }

        refElem = document.querySelector('.entry-preview-collection-container-references');

        if(refElem !== null)
        {         
            refMsnry = new Masonry(refElem, {
                itemSelector: '.entry-preview-reference',
                columnWidth: 500,
                gutter: 200,
                fitWidth: true,
                originLeft: true,
            });
        }
        
        unfilterEntries();
        
        window.addEventListener('resize', sort_masonries);
    });       

    function filterEntries(location) {
        const entries = document.querySelectorAll('.entry-preview, .entry-preview-reference');  
        location = location.toLowerCase().trim();
               
        entries.forEach(element => 
        {            
            var className = element.className.toLowerCase().trim();   
            element.style.display = className.includes(location) ? 'flex' : 'none';            
        });
      
        sort_masonries();
    }

    function unfilterEntries() {
        const entries = document.querySelectorAll('.entry-preview, .entry-preview-reference'); 
        entries.forEach(entry => 
        {
            entry.style.display = 'flex';            

            if(entry.classList.contains('second-entry'))
            {
                entry.classList.remove('second-entry');
            }
        });

        if(entries.length > 1)
        {
            entries[1].classList.add('second-entry');
        }

        sort_masonries();
    }    

    function sort_masonries() 
    {        
        var windowWidth = window.innerWidth; 

        if(windowWidth < 786)
        {
            return;
        }

        var lerpValue = Math.max(0, Math.min(1, (windowWidth - 1400) / (1400 - 1260)));
        var gutterValue = lerpValue * 200;

        if(elem !== null)
        {            
            var entryPreviews = document.querySelectorAll('.entry-preview');
            var maxWidth = entryPreviews.length === 1 ? 1200 : 500;
            elem.style.maxWidth = maxWidth + 'px';
            define_second_entry(entryPreviews);
            msnry.gutter = gutterValue;
            msnry.layout();
        }

        if(refElem !== null)
        {            
            var refEntryPreviews = document.querySelectorAll('.entry-preview-reference');
            var refMaxWidth = refEntryPreviews.length === 1 ? 1200 : 500;
            refElem.style.maxWidth = refMaxWidth + 'px';
            define_second_entry(refEntryPreviews);
            refMsnry.gutter = gutterValue;
            refMsnry.layout();
        }
    }       

    function define_second_entry(entries){
        visibleEntries = [];
        entries.forEach(entry => {
            if(entry.classList.contains('second-entry'))
            {
                entry.classList.remove('second-entry');
            }

            if(entry.style.display !== 'none')
            {
                visibleEntries.push(entry);
            }
        });

        if(visibleEntries.length > 1)
        {
            visibleEntries[1].classList.add('second-entry');
        }
    }

</script>