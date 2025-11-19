$(".slider-lover").slick({
  dots: false,
  infinite: true,
  arrows:true,
  speed: 300,
  slidesToShow: 1,
  slidesToScroll: 1,
});

// $(document).ready(function ($) {
//   // menu

//   let menuBtn = $(".menu-trigger");
//   let mobMenu = $(".navbar");
//   let fixedmenu = $("body");

//   function toggleMobileMenu() {
//     menuBtn.toggleClass("_js-active");
//     mobMenu.toggleClass("_js-open");
//     fixedmenu.toggleClass("_fixedmenu");


//   }

//   menuBtn.on("click", () => {
//     toggleMobileMenu();
//   });


//   $(window).on("scroll", function () {
//     if ($(this).scrollTop() > 0) {
//       $("#header").addClass("_js-top0");
//     } else {
//       $("#header").removeClass("_js-top0");
//     }
//   });

//   $('.microsite-option-close').on("click", function(){
//     $('.btn-close').click();
//   })


// });


// ---------- Institute Slider

$(document).ready(function () {
  $(".exam-card-slider")
  .slick({
    infinite: false,
    slidesToShow: 3,
    slidesToScroll: 1,
    arrows: false,
    autoplay: false,
    responsive: [
      {
        breakpoint: 992,
        settings: {
          slidesToShow: 3.5,
          slidesToScroll: 1,
        },
      },
      {
        breakpoint:475,
        settings: {
          slidesToShow: 2.5,
          slidesToScroll: 1,
        },
      },
    ],
    prevArrow:
      '<button class="slide-arrow prev-arrow"><i class="bi bi-arrow-left"></i></button>',
    nextArrow:
      '<button class="slide-arrow next-arrow"><i class="bi bi-arrow-right"></i></button>',
  });
});

$('button[data-bs-toggle="pill"]').on('shown.bs.tab', function (e) {
        $('.exam-card-slider').slick('setPosition');
    });
$('#engineer-btn-more').click(function(){
        $('.exam-card-slider').slick('setPosition');
})


// ------ Blog---

$(".blog-slider")
    .slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        autoplay: false,
        dots: true,
        prevArrow:
            '<button class="slide-arrow prev-arrow"><i class="bi bi-arrow-left"></i></button>',
        nextArrow:
            '<button class="slide-arrow next-arrow"><i class="bi bi-arrow-right"></i></button>',
    });



  
// // Show the first four images
// $(".gallery .gallery-col:lt(4)").show();

// // When the gallery button is clicked
// $("#gallery-btn").on('click', function(event) {
//   // Prevent default behavior
//   event.preventDefault();
//   // All of the hidden images
//   var $hidden = $(".gallery-col:hidden");
//   // Show the next four images
//   $($hidden).slice(0, 2).fadeIn(800);
//   // If the length of $hidden is 4 then hide the button
//   if ($hidden.length == 2) {
//     $(this).fadeOut();
//   }
// });