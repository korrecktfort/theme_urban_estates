<?php
    $related_immomakler_id = get_post_meta(get_the_ID(), 'related_immomakler_id', true);
    $images_args = array(
        'post_parent' => $related_immomakler_id,
        'numberposts' => -1,
        'post_type'   => 'attachment',
        'post_mime_type' => 'image',
        'orderby'     => 'menu_order ID',
        'order'       => 'ASC'
        );
    $image_attachments = get_posts( $images_args );
?>

<div class="body-container">
    <div class="body_content_container">
        <div class="gallery-buttons">
            <button id="prev-btn"></button>
            <button id="next-btn"></button>
        </div>

        <div class="image-gallery">
            <div class="scrollable-wrapper">
                <div class="scrollable-content">
                    <?php foreach ($image_attachments as $image_attachment) :
                    $img = get_image_data($image_attachment->guid); ?>
                    <img class="gallery-item" src="<?php echo $img['url']; ?>" alt="<?php echo $img['alt']; ?>">
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <div id="popup" class="popup">        
        <span class="close">&times;</span>        
        <img class="popup-content" id="popup-img">
    </div>        
</div>

<script>
// lightbox
document.addEventListener('DOMContentLoaded', () => {
    const galleryItems = document.querySelectorAll('.gallery-item');
    const popup = document.getElementById('popup');
    const popupImg = document.getElementById('popup-img');
    const closeBtn = document.querySelector('.close');

    galleryItems.forEach(item => {
        item.addEventListener('click', () => {
            popup.style.display = 'flex';
            popupImg.src = item.src;
        });
    });

    closeBtn.addEventListener('click', () => {
        popup.style.display = 'none';
    });

    popup.addEventListener('click', (e) => {
        if (e.target !== popupImg) {
            popup.style.display = 'none';
        }
    });
});

    const scrollableWrapper = document.querySelector('.scrollable-wrapper');
    const scrollableContent = document.querySelector('.scrollable-content');
    
    const prevButton = document.getElementById('prev-btn');
    const nextButton = document.getElementById('next-btn');
    
    scrollableWrapper.addEventListener('scroll', () => {
        const scrollPercentage = (scrollableWrapper.scrollLeft / (scrollableContent.scrollWidth - scrollableWrapper.clientWidth)) * 100;
    });
    prevButton.addEventListener('click', scrollToPrev);
    nextButton.addEventListener('click', scrollToNext);
    
    let scrolling = false;
    let currentIndex = 0;
    let images = document.querySelectorAll('.scrollable-content img');

function scrollToPrev() {
    let scrollLeft = scrollableWrapper.scrollLeft;

    if(currentIndex === 0) {
        currentIndex = images.length - 1;
    } 
    else
    {
        for (let i = images.length - 1; i >= 0; i--) {
            let image = images[i];
            let imageLeft = image.offsetLeft;  // This already includes margins            
            
            if(imageLeft >= scrollLeft) {
                // console.log('continue', i, imageLeft, scrollLeft);
                continue;
            }
    
            if(imageLeft < scrollLeft) {
                currentIndex = i;
                // console.log('break', i, imageLeft, scrollLeft);
                break;
            }
        }    
    }

    if(currentIndex < 0) {
        currentIndex = images.length - 1;
    }
   
    let targetImage = images[currentIndex];   
    scrollableWrapper.scrollLeft = targetImage.offsetLeft - scrollableWrapper.offsetLeft;
}

function scrollToNext() {
    let scrollLeft = scrollableWrapper.scrollLeft;

    if(currentIndex === images.length - 1) {
        currentIndex = 0;
    } 
    else
    {
        for (let i = 0; i < images.length; i++) {
            const image = images[i];
            const imageLeft = image.offsetLeft;  // This already includes margins
            const imageRight = imageLeft + image.offsetWidth;
            
            if(imageRight < scrollLeft) {
                continue;
            }
    
            if(imageLeft >= scrollLeft) {
                currentIndex = i;
                break;
            }
        }    
 
        currentIndex++;
    }

    if(currentIndex >= images.length) {
        currentIndex = 0;
    }
    
    let targetImage = images[currentIndex];   
    scrollableWrapper.scrollLeft = targetImage.offsetLeft - scrollableWrapper.offsetLeft;
}



</script>