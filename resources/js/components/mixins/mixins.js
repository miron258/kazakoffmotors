import $ from 'jquery';  // подключаем jQuery


export default {

    created: function () {

    },
    mounted() {

    },
    methods: {
// our multi slide adaptive height function passing slider object
        multiSlideAdaptiveHeight(slider) {

            // set our vars
            let activeSlides = [];
            let tallestSlide = 0;

            // very short delay in order for us get the correct active slides
            setTimeout(function () {

                // loop through each active slide for our current slider
                $('.slick-track .slick-active', $(slider)).each(function (item) {


                    console.log(activeSlides[item]);
                    console.log($(this).outerHeight());

                    // add current active slide height to our active slides array
                    activeSlides[item] = $(this).outerHeight();

                });

                // for each of the active slides heights
                activeSlides.forEach(function (item) {

                    // if current active slide height is greater than tallest slide height
                    if (item > tallestSlide) {

                        // override tallest slide height to current active slide height
                        tallestSlide = item;

                    }

                });

                // set the current slider slick list height to current active tallest slide height
                $('.slick-list', slider).height(tallestSlide);

            }, 10);

        },
        flyToElement2() {

            let dupNode = node.cloneNode();

        },

        flyToElement(flyer, flyingTo) {
            let $func = $(this);
            let divider = 20;
            let flyerClone = $(flyer).clone();


            if ($(flyingTo).length) {

                $(flyerClone).css({
                    position: 'absolute',
                    top: $(flyer).offset().top + "px",
                    left: $(flyer).offset().left + "px",
                    opacity: 1,
                    'z-index': 9999999
                });
                $('body').append($(flyerClone));
                let gotoX = $(flyingTo).offset().left + ($(flyingTo).width() / 6) - ($(flyer).width() / divider) / 6;
                let gotoY = $(flyingTo).offset().top + ($(flyingTo).height() / 6) - ($(flyer).height() / divider) / 6;

                $(flyerClone).animate({
                        opacity: 0.4,
                        left: gotoX,
                        top: gotoY,
                        width: $(flyer).width() / divider,
                        height: $(flyer).height() / divider
                    }, 700,
                    function () {
                        $(flyingTo).fadeOut('fast', function () {
                            $(flyingTo).fadeIn('fast', function () {
                                $(flyerClone).fadeOut('fast', function () {
                                    $(flyerClone).remove();
                                });
                            });
                        });
                    });
            }

        },


    }
}


