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

<div class="body-container gallery-body burger-toggle">
    <div class="body_content_container gallery">
        <!-- <div class="gallery-buttons">
            <button id="prev-btn"></button>
            <button id="next-btn"></button>
        </div> -->

        <div class="image-gallery">

            <div class="scrollable-wrapper">
                <div class="scrollable-content">                    
                    <?php foreach ($image_attachments as $image_attachment) :
                    $img = get_image_data($image_attachment->guid); ?>
                    <img class="gallery-item" src="<?php echo $img['url']; ?>" alt="<?php echo $img['alt']; ?>">
                    <?php endforeach; ?>
                </div>
            </div>
            
            <div class="hover-areas-container">
                <div class="hover-area__left"></div>
                <div class="hover-area__center"></div>
                <div class="hover-area__right"></div>
            </div>
        </div>
    </div>
    
    <div class="gallery-button gallery-button--left" id="prev-btn"></div>
    <div class="gallery-button" id="next-btn"></div>
    <div class="gallery-button gallery-magnifier" id="magnifier"></div>    

    <div id="popup" class="popup">        
        <span class="close">&times;</span>        
        <div class="gallery-buttons-mobile">
            <div class="gallery-button gallery-button--left flex" id="lb-prev"></div>
            <div class="gallery-button flex" id="lb-next"></div>
        </div>
        <img class="popup-content" id="popup-img">        
    </div>        
</div>

<script>    
document.querySelectorAll('.hover-area__right').forEach((hoverArea) => {
    var cursorDivRight = document.getElementById('next-btn');

    hoverArea.addEventListener('mouseenter', () => {
        document.addEventListener('mousemove', updateCursorPositionRight);
        cursorDivRight.style.display = 'flex';
    });
    
    hoverArea.addEventListener('mouseleave', () => {
        document.removeEventListener('mousemove', updateCursorPositionRight);
        cursorDivRight.style.display = 'none';
    });
    
    hoverArea.addEventListener('click', () => {
        scrollToNext();
    });
});

document.querySelectorAll('.hover-area__left').forEach((hoverArea) => {
    var cursorDivLeft = document.getElementById('prev-btn');

    hoverArea.addEventListener('mouseenter', () => {
        document.addEventListener('mousemove', updateCursorPositionLeft);
        cursorDivLeft.style.display = 'flex';
    });
    
    hoverArea.addEventListener('mouseleave', () => {
        document.removeEventListener('mousemove', updateCursorPositionLeft);
        cursorDivLeft.style.display = 'none';
    });
    
    hoverArea.addEventListener('click', () => {
        scrollToPrev();
    });
});

function updateCursorPositionRight(e) {
    let iconWidth = 24;
    var cursorDivRight = document.getElementById('next-btn');
    cursorDivRight.style.left = (e.clientX - iconWidth) + 'px';
    cursorDivRight.style.top = (e.clientY - iconWidth) + 'px';
}

function updateCursorPositionLeft(e) {
    let iconWidth = 24;
    var cursorDivLeft = document.getElementById('prev-btn');
    cursorDivLeft.style.left = (e.clientX - iconWidth) + 'px';
    cursorDivLeft.style.top = (e.clientY - iconWidth) + 'px';
}

function updateMagnifierPosition(e) {
    let iconWidth = 24;
    var cursorDivLeft = document.getElementById('magnifier');
    cursorDivLeft.style.left = (e.clientX - iconWidth) + 'px';
    cursorDivLeft.style.top = (e.clientY - iconWidth) + 'px';
}

function enable_scroll(event){
    document.removeEventListener('wheel', mute_event, {passive: false});
}

function disable_scroll(event){
    document.addEventListener('wheel', mute_event, {passive: false});    
}

function mute_event(event) {
    event.preventDefault();
}

// lightbox
document.addEventListener('DOMContentLoaded', () => {
    const galleryItems = document.querySelectorAll('.gallery-item');
    const popup = document.getElementById('popup');
    const popupImg = document.getElementById('popup-img');
    const closeBtn = document.querySelector('.close');
    const magnifier = document.getElementById('magnifier');
    const lightboxPrev = document.getElementById('lb-prev');
    const lightboxNext = document.getElementById('lb-next');

    let currentIndex = -1;

    galleryItems.forEach((item, index) => {
        item.addEventListener('click', () => {
            popup.style.display = 'flex';
            popupImg.src = item.src;
            currentIndex = index;
            disable_scroll();
        });

        item.addEventListener('mouseenter', () => {
            document.addEventListener('mousemove', updateMagnifierPosition);
            magnifier.style.display = 'flex';            
        });

        item.addEventListener('mouseleave', () => {
            document.removeEventListener('mousemove', updateMagnifierPosition);
            magnifier.style.display = 'none';
        });
    });

    closeBtn.addEventListener('click', () => {
        popup.style.display = 'none';
        enable_scroll();
    });

    popupImg.addEventListener('click', () => {
        focusNext();
    });

    popup.addEventListener('click', (e) => {
        if (e.target !== popupImg 
        && e.target !== lightboxPrev 
        && e.target !== lightboxNext 
        && e.target !== closeBtn) {
            popup.style.display = 'none';
            enable_scroll();
        }
    });

    lightboxPrev.addEventListener('click', focusPrev);

    lightboxNext.addEventListener('click', focusNext);

    function focusNext() {
        currentIndex = (currentIndex + 1) % galleryItems.length;
        popupImg.src = galleryItems[currentIndex].src;
    }

    function focusPrev() {
        currentIndex = (currentIndex - 1 + galleryItems.length) % galleryItems.length;
        popupImg.src = galleryItems[currentIndex].src;
    }

    document.addEventListener('keydown', function(event) {
    if(popup.style.display === 'flex') {
        if(event.key === 'ArrowRight') {
            focusNext();
        } else if(event.key === 'ArrowLeft') {
            focusPrev();
        } else if(event.key === 'Escape') {
            popup.style.display = 'none';
            enable_scroll();
        }
    } else {
        document.body.style.overflow = 'auto';
    }
    });
});

    const scrollableWrapper = document.querySelector('.scrollable-wrapper');
    const scrollableContent = document.querySelector('.scrollable-content');
    
    // const prevButton = document.getElementById('prev-btn');
    // const nextButton = document.getElementById('next-btn');
    
    scrollableWrapper.addEventListener('scroll', () => {
        const scrollPercentage = (scrollableWrapper.scrollLeft / (scrollableContent.scrollWidth - scrollableWrapper.clientWidth)) * 100;
    });
    // prevButton.addEventListener('click', scrollToPrev);
    // nextButton.addEventListener('click', scrollToNext);
    
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
                console.log('continue', i, imageLeft, scrollLeft);
                continue;
            }
    
            if(imageLeft < scrollLeft) {
                currentIndex = i;
                console.log('break', i, imageLeft, scrollLeft);
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

// gallery scroll funcitonalities
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