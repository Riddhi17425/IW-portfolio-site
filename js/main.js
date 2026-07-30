
// document.addEventListener('DOMContentLoaded', function () {
//     const hoverImages = document.querySelectorAll('.hover-loop-img');

//     hoverImages.forEach(img => {
//         let interval;
//         let originalSrc = img.src;
//         let altImages;

//         img.addEventListener('mouseenter', () => {
//             try {
//                 altImages = JSON.parse(img.getAttribute('data-alt'));
//             } catch (e) {
//                 console.error("Invalid data-alt for image:", img);
//                 return;
//             }

//             if (!altImages || altImages.length === 0) return;

//             let index = 0;
//             interval = setInterval(() => {
//                 img.src = altImages[index];
//                 index = (index + 1) % altImages.length;
//             }, 400);
//         });

//         img.addEventListener('mouseleave', () => {
//             clearInterval(interval);
//             img.src = originalSrc;
//         });
//     });
// });
document.addEventListener('DOMContentLoaded', function () {
    const hoverImages = document.querySelectorAll('.hover-loop-img');

    hoverImages.forEach(img => {
        let interval;
        let originalSrc = img.src;
        let altImages;

        // Preload images
        try {
            altImages = JSON.parse(img.getAttribute('data-alt'));
            if (altImages && altImages.length > 0) {
                altImages.forEach(src => {
                    const preloadImg = new Image();
                    preloadImg.src = src;
                });
            }
        } catch (e) {
            console.error("Invalid data-alt for image:", img);
            return;
        }

        img.addEventListener('mouseenter', () => {
            if (!altImages || altImages.length === 0) return;

            let index = 0;
            interval = setInterval(() => {
                img.src = altImages[index];
                index = (index + 1) % altImages.length;
            }, 400);
        });

        img.addEventListener('mouseleave', () => {
            clearInterval(interval);
            img.src = originalSrc;
        });
    });
});


function initSliders() {
    $('.product_card_slider').each(function () {
        if (!$(this).hasClass('slick-initialized')) {
            $(this).slick({
                slidesToShow: 1,
                arrows: true,
                centerPadding: '0px',
                dots: false,
                responsive: [
                    {
                        breakpoint: 992, 
                        settings: {
                            slidesToShow: 1,
                        }
                    },
                    {
                        breakpoint: 768, 
                        settings: {
                            slidesToShow: 1,
                           
                        }
                    }
                ]
            });

        } else {
            $(this).slick('setPosition');
        }
    });
}

// Initialize on page load
$(document).ready(function () {
    initSliders();

    // On tab shown, re-initialize or reposition
    $('a[data-bs-toggle="tab"], button[data-bs-toggle="tab"]').on('shown.bs.tab', function () {
        initSliders();
    });
});

document.querySelectorAll('.card-wrapper').forEach(wrapper => {
    const circle = wrapper.querySelector('.enquire-circle');

    wrapper.addEventListener('mouseenter', () => {
        circle.style.opacity = 1;
    });

    wrapper.addEventListener('mousemove', (e) => {
        const rect = wrapper.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;

        circle.style.left = `${x}px`;
        circle.style.top = `${y}px`;
    });

    wrapper.addEventListener('mouseleave', () => {
        circle.style.opacity = 0;
    });
});

// mobile view 
 $('.mobile_slider').slick({
    slidesToShow: 1,
    centerMode: true,
    centerPadding: '0px',
    arrows: false,
    dots: true,
    infinite: true,
    autoplay: true,
    autoplaySpeed: 3000,
    speed: 800,
    responsive: [
      {
        breakpoint: 992,
        settings: {
          slidesToShow: 1
        }
      }
    ]
  });

let outerSwiper;

function initOuterSwiper() {
    if (outerSwiper) outerSwiper.destroy(true, true);

    if (window.innerWidth < 992) {
        outerSwiper = new Swiper('.mobile_slider_product', {
            slidesPerView: 1,
            loop: true,
            centeredSlides: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true
            },
            autoplay: {
                delay: 3000
            },
            speed: 800
        });
    }
}

function initInnerSlick() {
    $('.product_card_slider').each(function () {
        if (!$(this).hasClass('slick-initialized')) {
            $(this).slick({
                slidesToShow: 1,
                arrows: true,
                dots: false,
                adaptiveHeight: true
            });
        }
    });
}

$(document).ready(function () {
    initOuterSwiper();
    initInnerSlick();

    // On tab change
    $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function () {
        setTimeout(() => {
            initOuterSwiper();
            initInnerSlick();
            $('.product_card_slider').slick('setPosition');
        }, 400);
    });

    // On resize
    let resizeTimer;
    $(window).on('resize', function () {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
            initOuterSwiper();
            initInnerSlick();
            $('.product_card_slider').slick('setPosition');
        }, 300);
    });
});

