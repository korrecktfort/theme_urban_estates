<?php
    $id = get_post_meta(get_the_ID(), 'related_immomakler_id', true);

    $district = get_post_meta($id, 'ort', true);
    $title = get_post_meta($id, 'objekttitel', true);
    $summary = get_post_meta($id, 'dreizeiler', true);
    $type = get_post_meta($id, 'objektart', true);

    $propertySize = get_post_meta($id, 'grundstuecksflaeche', true);
    $livingSpace = get_post_meta($id, 'wohnflaeche', true);
    $rooms = get_post_meta($id, 'anzahl_zimmer', true);
    $bathrooms = get_post_meta($id, 'anzahl_badezimmer', true);
    
    // Additional Data - shuffle as needed later on
    $balcony = get_post_meta($id, 'anzahl_balkone', true);
    $terrace = get_post_meta($id, 'anzahl_terrassen', true);
    $carSpots = get_post_meta($id, 'anzahl_stellplaetze', true);
    $sleepingRooms = get_post_meta($id, 'anzahl_schlafzimmer', true);
    //

    $year = get_post_meta($id, 'baujahr', true);
    $purchasePrice = get_post_meta($id, 'kaufpreis', true);

    $bulletPoints = ausstatt_to_array(get_post_meta($id, 'ausstatt_beschr', true));
?>

<div class="body-container">
    <div class="body_content_container">
        <div class="entry-header">
            <h2><?php echo $district;?></h2>
            <h1><?php echo $title; ?></h1>
            <p><?php echo $summary; ?></p>
        </div>
    </div>
</div>

<div class="body-container bg-cream">
    <div class="body_content_container">

        <div class="mobile mobile-button-expose-container">
            <button class="button button-teal mobile-button-expose" onClick = "scrollToBottom()"><div class="arrow"></div><p>Exposé anfordern</p></button>
        </div>

        <div class="mobile-s mobile-button-expose-container">
            <button class="button button-teal mobile-button-expose" onClick = "scrollToBottom()"><div class="arrow"></div><p>Exposé anfordern</p></button>
        </div>

        <div class="entry-summary__data-pairs teal" style="margin-bottom: 47.5px;">
            
            <?php 
            if($type=="Wohnung")
            {
                echo do_shortcode('[data_living_space_symbol value="' . $livingSpace . '"]');
            
                echo do_shortcode('[data_bathrooms_symbol value="' . $bathrooms . '"]');

                if(has_value($balcony))
                {
                    echo do_shortcode('[data_balcony_symbol value="' . $balcony . '"]');
                }
                else if(has_value($terrace))
                {
                    echo do_shortcode('[data_terrace_symbol value="' . $terrace . '"]');
                }
                else if(has_value($carSpots))
                {
                    echo do_shortcode('[data_car_spot_symbol value="' . $carSpots . '"]');
                }
                else if(has_value($sleepingRooms))
                {
                    echo do_shortcode('[data_sleeping_room_symbol value="' . $sleepingRooms . '"]');
                }

                echo do_shortcode('[data_year_symbol value="' . $year . '"]');

                echo do_shortcode('[data_price_symbol value="' . $purchasePrice . '"]');
            }

            if($type=="Haus")
            {
                echo do_shortcode('[data_living_space_symbol value="' . $livingSpace . '"]');
            
                echo do_shortcode('[data_property_size_symbol value="' . $propertySize . '"]');

                echo do_shortcode('[data_rooms_symbol value="' . $rooms . '"]');

                echo do_shortcode('[data_bathrooms_symbol value="' . $bathrooms . '"]');
               
                echo do_shortcode('[data_year_symbol value="' . $year . '"]');

                echo do_shortcode('[data_price_symbol value="' . $purchasePrice . '"]');
            }
            ?>           
        </div>
    
        <div class="separator-beige"></div>

        <div class="blockdesktop"> 
            
                <div class="entry-bullets-title">
                    <h2>Daten und Fakten</h2>
                </div>

                <div class="entry-bullets-container">
                    <?php         
                    foreach($bulletPoints as $bulletPoint)
                    {
                    ?>
                        <div class="entry-bullets__item">
                            <p><?php echo $bulletPoint; ?></p>
                        </div>  
                    <?php            
                    }
                    ?>
                </div>
            </div>
        </div>

        <?php                    
        $bulletPointsHtml = '';
        foreach($bulletPoints as $bulletPoint) {
            $bulletPointsHtml .= '<div class="entry-bullets__item"><p>' . $bulletPoint . '</p></div>';
            }
            ?>

        <div class="mobile">            
            <?php
            get_template_part('template-parts/entry-bottom-text-block', null, array(
                'title' => 'Daten und Fakten',
                'text' => $bulletPointsHtml,
                'id' => '3',
                'ellipsis_class' => 'cream',
                ));
                ?>
        </div>

         <div class="mobile-s">           
                <?php
            get_template_part('template-parts/entry-bottom-text-block', null, array(
                'title' => 'Daten und Fakten',
                'text' => $bulletPointsHtml,
                'id' => '4',
                'ellipsis_class' => 'cream',
                ));
                ?>
        </div>
        
    </div>
</div>

<!-- Bottom Banderole -->
 <div class="desktop">
    <div class="bg-teal entry-banderole font-cream">
        <div class="entry-banderole__container__wrapper">

            <div class="entry-banderole__container">
                <div class="entry-banderole__container__item">
                    <?php echo do_shortcode('[data_living_space value="' . $livingSpace . '"]'); ?>
                </div>
                
                <div class="entry-banderole__container__item">
                    <?php echo do_shortcode('[data_rooms value="' . $rooms . '"]'); ?>
                </div>
                
                <div class="entry-banderole__container__item">
                    <?php echo do_shortcode('[data_price value="' . $purchasePrice . '"]'); ?>
                </div>
            </div>

            <div class="entry-banderole__container">
                <div class="entry-banderole__container__item">            
                <?php echo do_shortcode('[button_expose]');?>
                </div>
            </div>

        </div>
    </div>
</div>



<script>
function scrollToBottom() {
    document.getElementById('expose-form').scrollIntoView({ behavior: 'smooth' });
}

function styleLastRow() {
  const container = document.querySelector('.entry-bullets-container');
  const items = container.querySelectorAll('.entry-bullets__item');
  const containerWidth = container.offsetWidth;
  const itemWidth = items[0].offsetWidth;
  const itemsPerRow = Math.floor(containerWidth / itemWidth);

  // Clear previous last row styling
  items.forEach(item => item.classList.remove('last-row'));

  // Find the starting index of the last row
  const lastRowIndex = items.length - (items.length % itemsPerRow || itemsPerRow);

  // Apply the last-row class to each item in the last row
  for (let i = lastRowIndex; i < items.length; i++) {
    items[i].classList.add('last-row');
  }
}

// function styleLastItemsInRow() {
//   const container = document.querySelector('.entry-bullets-container');
//   const items = container.querySelectorAll('.entry-bullets__item');
//   const containerWidth = container.offsetWidth;
//   const itemWidth = items[0].offsetWidth;
//   const itemsPerRow = Math.round(containerWidth / itemWidth);

//   // Remove previous last-item styling
//   items.forEach(item => item.classList.remove('last-item-in-row'));

//   // Style the last item in each row
//   for (let i = itemsPerRow - 1; i < items.length; i += itemsPerRow) {
//     items[i].classList.add('last-item-in-row');
//   }
// }

// Initial calls
styleLastRow();
// styleLastItemsInRow();

// Reapply styles on window resize
window.addEventListener('resize', styleLastRow);
// window.addEventListener('resize', styleLastItemsInRow);
</script>