<?php
/**
 * Template Name: City Location
 * 
 * @package Urban_Estates
 */
?>

<?php get_header(null, 
    ['breadcrumbs' => array(
        array(
          'url' => get_home_url(),
          'text' => 'Start'
        ),
        array(
          'url' => get_home_url() . '/immobilien',
          'text' => 'Immobilien'
        ),
        array(
          'url' => get_permalink(),
          'text' => get_field('city-name'),
        )
      )
    ]
  ); 
?>

<?php
$location = get_field('city-name');
$location = strtolower($location);

$collection = get_urban_estate_posts(['location' => $location, 'references' => false]);
$references = get_urban_estate_posts(['location' => $location, 'references' => true]);
?>

<div class="below-header-spacer burger-toggle"></div>
<div class="body-container">
    <div class="body_content_container">
        <div class="body-standard-header-text-block">
            <h2><?php echo get_field('top_textblock_title') ?></h2>
            <p><?php echo get_field('top_textblock_text') ?></p>
        </div>
    </div>
</div>

<?php if(count($collection) > 0): ?>
<div class="body-container">
    <div class="body_content_container">
        <?php get_template_part('template-parts/immobilien-display-active', null, ['collection' => $collection]); ?>
    </div>
</div>
<?php endif; ?>

<?php if(count($references) > 0): ?>
  <div class="body-container bg-cream">
    <div class="body_content_container">
        <div class="body-standard-header-text-block">
            <h2><?php echo get_field('references_textblock_title') ?></h2>
            <p><?php echo get_field('references_textblock_text') ?></p>
        </div>
        
        <?php get_template_part('template-parts/immobilien-display-references', null, ['collection' => $references]); ?>
    </div>
</div>
<?php endif; ?>

<div class="body-container">
    <div class="body_content_container">
      <?php get_template_part('template-parts/horizontal-image-text-clean', null, [
        "image_url" => get_field('textblock_01_image'),
        "title" => get_field('textblock_01_title'),
        "text" => get_field('textblock_01_text'),
        "reverse" => get_field('textblock_01_reverse'),
      ]); ?>
    </div>
</div>

<div class="body-container">
    <div class="body_content_container">
      <?php get_template_part('template-parts/horizontal-image-text-clean', null, [
        "image_url" => get_field('textblock_02_image'),
        "title" => get_field('textblock_02_title'),
        "text" => get_field('textblock_02_text'),
        "reverse" => get_field('textblock_02_reverse'),
      ]); ?>
    </div>
</div>

<?php get_footer(); ?>


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

    function sort_masonries() {        
        var windowWidth = window.innerWidth; 
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