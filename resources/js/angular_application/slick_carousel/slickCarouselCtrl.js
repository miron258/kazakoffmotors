ngApp.controller('SlickCarouselCtrl', ['$scope', function ($scope) {
    'use strict';

    //====================================
    // Slick Carousel OUR WORK Page
    //====================================
    /////// SLICK CAROUSEL CONFIG THUMBNAILS


    $scope.slickConfigOurWorkThumbnails = {
        enabled: true,
        autoplay: false,
        dots: false,
        arrows: false,
        rows: 0,
        focusOnSelect: true,
        verticalSwiping: true,
        vertical: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        asNavFor: '.slick-carousel-our-work',
        draggable: false,
        autoplaySpeed: 3000,
        method: {},
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: false
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    dots: false
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    dots: false
                }
            }
        ],
        event: {
            beforeChange: function (event, slick, currentSlide, nextSlide) {
            },
            afterChange: function (event, slick, currentSlide, nextSlide) {
            }
        }
    };
    /////// END SLICK CAROUSEL CONFIG THUMBNAILS

    $scope.slickConfigOurWork = {
        enabled: true,
        autoplay: false,
        arrows: true,
        dots: false,
        rows: 0,
        slidesToShow: 1,
        slidesToScroll: 1,
        appendArrows: '.nav-arrows',
        // appendDots: '.dots-our-work',
        nextArrow: '<button type="button" class="slick-carousel-control-next"></button>',
        prevArrow: '<button type="button" class="slick-carousel-control-prev"></button>',
        asNavFor: '.slick-carousel-our-work-thumbnails',
        draggable: true,
        autoplaySpeed: 3000,
        method: {},
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: false
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
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
        ],
        event: {
            beforeChange: function (event, slick, currentSlide, nextSlide) {
            },
            afterChange: function (event, slick, currentSlide, nextSlide) {
            }
        }
    };


    //====================================
    // END Slick Carousel OUR WORK Page
    //====================================

    //====================================
    // Slick Carousel Main Page
    //====================================


    // var dotsMainPage = angular.element('#dots-our-work');


    /////// SLICK CAROUSEL CONFIG THUMBNAILS
    $scope.slickConfigMainThumbnails = {
        enabled: true,
        autoplay: false,
        dots: false,
        rows: 0,
        focusOnSelect: true,
        verticalSwiping: true,
        vertical: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        asNavFor: '.slick-carousel-our-work',
        draggable: false,
        autoplaySpeed: 3000,
        method: {},
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: false
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    dots: false
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    dots: false
                }
            }
        ],
        event: {
            beforeChange: function (event, slick, currentSlide, nextSlide) {
            },
            afterChange: function (event, slick, currentSlide, nextSlide) {
            }
        }
    };
    /////// END SLICK CAROUSEL CONFIG THUMBNAILS

    $scope.slickConfigMain = {
        enabled: true,
        autoplay: false,
        arrows: false,
        dots: true,
        rows: 0,
        slidesToShow: 1,
        slidesToScroll: 1,
        appendDots: '.dots-our-work',
        // nextArrow: '<button type="button" class="slick-carousel-control-next"></button>',
        // prevArrow: '<button type="button" class="slick-carousel-control-prev"></button>',
        asNavFor: '.slick-carousel-our-work-thumbnails',
        draggable: true,
        autoplaySpeed: 3000,
        method: {},
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: false
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
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
        ],
        event: {
            beforeChange: function (event, slick, currentSlide, nextSlide) {
            },
            afterChange: function (event, slick, currentSlide, nextSlide) {
            }
        }
    };


    //====================================
    // END Slick Carousel Main Page
    //====================================


    //====================================
    // Slick Carousel Contacts
    //====================================


    ///////////////////////////////// SLICK CONFIG
    $scope.slickConfigContacts1 = {
        method: {},
        dots: false,
        infinite: false,
        speed: 300,
        nextArrow: '<button type="button" class="slick-arrow slick-carousel-control-next"></button>',
        prevArrow: '<button type="button" class="slick-arrow slick-carousel-control-prev"></button>',
        slidesToShow: 3,
        slidesToScroll: 1,
        rows: 0,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: false
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
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
    };
    ///////////////////////////////// END SLICK CONFIG
    //====================================
    // End Slick Carousel Contacts
    //====================================


    //====================================
    // Slick Carousel Contacts FOTO
    //====================================
    // $scope.slidesContacts = [1, 2, 3];
    $scope.slickConfigLoaded2 = true;
    // $scope.slickCurrentIndex = 0;


    ///////////////////////////////// SLICK CONFIG
    $scope.slickConfigContacts2 = {
        method: {},
        dots: true,
        arrows: true,
        appendArrows: '.nav-arrows',
        infinite: false,
        speed: 300,
        nextArrow: '<button type="button" class="slick-arrow slick-carousel-control-next"></button>',
        prevArrow: '<button type="button" class="slick-arrow slick-carousel-control-prev"></button>',
        // asNavFor: 'slick-carousel-control', //Enables syncing of multiple sliders
        slidesToShow:2,
        slidesToScroll: 1,
        rows: 0,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: false
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
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
    };
    ///////////////////////////////// END SLICK CONFIG
    //====================================
    // End Slick Carousel Contacts FOTO
    //====================================


}]);

