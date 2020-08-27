//  Close Modal
setTimeout(function() {
    $('.esa-pop_up').addClass("esa-modal");
}, 10000);


$(".close-btn").click(function() {
    $(".modal-container").css("visibility", "hidden");
});


// Search Bar & Toggle
$('#toggle-search').on('click', function() {
    $('#searchBar').toggle('display: block');
});

$(document).ready(function() {

    // Header navigation Js
    $('.navbar-toggler').click(function() {
        $(this).siblings('.main-navigation').toggleClass('show');
        $('body').toggleClass('noscroll');
        $('.top-header').toggle();
    });
    // wow js integrated
    new WOW().init();


    if ($(window).width() >= 768) {
        // When the user scrolls the page, execute myFunction 
        window.onscroll = function() { myFunction() };

        // Get the navbar
        var navbar = document.getElementById("bottom-header");

        // Get the offset position of the navbar
        var sticky = navbar.offsetTop;

        // Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
        function myFunction() {
            if (window.pageYOffset >= sticky) {
                navbar.classList.add("sticky")
            } else {
                navbar.classList.remove("sticky");
            }
        }
    };

    //
    $(".collapse.show").each(function() {
        $(this).prev(".card-header").find(".fa").addClass("fa-minus").removeClass("fa-plus");
    });

    // Toggle plus minus icon on show hide of collapse element
    $(".collapse").on('show.bs.collapse', function() {
        $(this).prev(".card-header").find(".fa").removeClass("fa-plus").addClass("fa-minus");
    }).on('hide.bs.collapse', function() {
        $(this).prev(".card-header").find(".fa").removeClass("fa-minus").addClass("fa-plus");
    });


    //add span tag on menu items 
    if ($(window).width() < 1199) {
        $('.navbar-collapse li.menu-item-has-children').append('<span><i class="far fa-chevron-right"></i></span>');
    };
    //sub menu toggle js
    $(".navbar-collapse li span").siblings('.sub-menu').css('display', 'none');
    $(".navbar-collapse li span").click(function() {
        $(this).parent().siblings().find(".sub-menu").slideUp();
        $(this).parent().siblings().find("span").removeClass('rotate-angle');

        $(this).siblings('.sub-menu').slideToggle();
        $(this).toggleClass('rotate-angle');
    });

});

jQuery(window).scroll(function() {
    if (jQuery(this).scrollTop() > 200) {
        jQuery('.scroll-top').fadeIn();

    } else {
        jQuery('.scroll-top').fadeOut();
    }
});
jQuery('.scroll-top').click(function() {
    jQuery("html, body").animate({ scrollTop: 0 }, 600);
    return false;
});
$('.slider').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    dots: true,
    autoplay: true,
    autoplaySpeed: 2500,
    arrows: true,
    infinite: true,
    cssEase: 'linear',
    responsive: [{
        breakpoint: 480,
        settings: {
            infinite: true,
            dots: false
        }
    }]
});

$('.banner').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    fade: true,
    arrows: false,
    autoplaySpeed: 8000,
    infinite: true,
    cssEase: 'linear',
    responsive: [{
        breakpoint: 480,
        settings: {
            infinite: true,
            dots: false
        }
    }]
});


$('.testimonial').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    fade: true,
    dots: true,
    arrows: true,
    autoplaySpeed: 4500,
    infinite: true,
    cssEase: 'linear',
    responsive: [{
        breakpoint: 480,
        settings: {
            infinite: true,
            dots: false
        }
    }]
});

$('.carousel').slick({
    slidesToShow: 5,
    slidesToScroll: 1,
    autoplay: true,
    arrows: true,
    autoplaySpeed: 3500,
    infinite: true,
    cssEase: 'linear',
    responsive: [{
            breakpoint: 1024,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
                infinite: true,
                dots: false
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
    ]
});

$('.image-carousel').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    autoplay: true,
    arrows: true,
    autoplaySpeed: 3500,
    infinite: true,
    cssEase: 'linear',
    responsive: [{
            breakpoint: 1024,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
                infinite: true,
                dots: false
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
    ]
});
$('.image-slider').slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    autoplay: true,
    arrows: true,
    dots: true,
    autoplaySpeed: 3500,
    infinite: true,
    cssEase: 'linear',
    focusOnSelect: true,
    responsive: [{
            breakpoint: 1024,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
                infinite: true,
                dots: false
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                dots: false
            }
        }
    ]
});
// tabs script //



// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();

function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}


$(document).ready(function() {
    // Add minus icon for collapse element which is open by default
    $(".collapse.show").each(function() {
        $(this).prev(".card-header").find(".fa").addClass("fa-minus").removeClass("fa-plus");
    });

    // Toggle plus minus icon on show hide of collapse element
    $(".collapse").on('show.bs.collapse', function() {
        $(this).prev(".card-header").find(".fa").removeClass("fa-plus").addClass("fa-minus");
    }).on('hide.bs.collapse', function() {
        $(this).prev(".card-header").find(".fa").removeClass("fa-minus").addClass("fa-plus");
    });
});