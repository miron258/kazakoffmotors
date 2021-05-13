<template>

    <div class="block-our-work__box-work row box-work">


        <!---------------- BLOCK DESCRIPTION GALLERY ----------------->
        <div class="col-xl-4 col-lg-4 col-md-4 wrapper-slider-description col-sm-12 col-12 order-2">
            <div class="box-work__our-work-description-gallery our-work-description-gallery">
                <h3 v-text="gallery.header" class="our-work-description__header-our-work-gallery header-our-work-gallery"></h3>
                <div v-html="gallery.description" class="our-work-description-gallery__text-gallery text-gallery">
                </div>
            </div>

            <!--------------------------------------- BLOCK NAVIGATION SLICK CAROUSEL ------------------------------------------->
            <div class="box-work__block-navigation-slider block-navigation-slider">


                <!----------- Navigation Arrows Our Work ------------->
                <div class="block-navigation-slider___nav-our-work nav-our-work" id="nav-our-work">
                </div>
                <!----------- End Navigation Arrows Our Work ------------->

                <!---------- Dots Our Work -------------->
                <div
                    class="block-navigation-slider__dots-our-work dots-our-work d-xl-block d-lg-block d-md-block d-sm-none d-none"
                    id="dots-our-work">
                </div>
                <!---------- End Dots Our Work -------------->

            </div>
            <!--------------------------------------- END BLOCK NAVIGATION SLICK CAROUSEL ------------------------------------------->


        </div>
        <!---------------- END BLOCK DESCRIPTION GALLERY ----------------->


        <div class="w-100 d-xl-none d-lg-none d-md-none d-sm-block d-block"></div>


        <!---------------- BLOCK LIST IMG GALLERY ----------------->
        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12 wrapper-slider-images order-1 order-md-12">
            <div class="box-work__our-work-gallery-img our-work-gallery-img">

                <div
                    class="our-work-gallery-img__block-slick-carousel-our-work row block-slick-carousel-our-work">
                    <div
                        class="block-slick-carousel-our-work__box-slider-thumbnails col-xl-3 col-lg-3 col-md-3 box-slider-thumbnails d-xl-block d-lg-block d-md-block d-sm-none d-none">
                        <slick-carousel-our-work-thumbnails :images="gallery.images"></slick-carousel-our-work-thumbnails>
                    </div>
                    <div
                        class="block-slick-carousel-our-work__box-slider-carousel col-xl-9 col-lg-9 col-md-9 col-sm-12 col-12 box-slider-carousel">
                        <slick-carousel-our-work :images="gallery.images"></slick-carousel-our-work>
                    </div>
                </div>
            </div>
        </div>
        <!---------------- END BLOCK LIST IMG GALLERY ----------------->

    </div>





</template>

<script>
import Slick from 'vue-slick'
import SlickCarouselOurWorkThumbnails from "../SlickCarouselOurWorkThumbnails";
import SlickCarouselOurWork from "../SlickCarouselOurWork";


export default {
    name: 'SlickCarouselMainPage',
    props: ['gallery'],
    //Данные которые мы выводим и применяем в шаблоне
    data() {
        return {





        }
    },
mounted() {

        console.log(this.gallery);

},
    // All slick methods can be used too, example here
    methods:
        {


        },
    components: {
        Slick,
        SlickCarouselOurWorkThumbnails,
        SlickCarouselOurWork
    }
}
</script>
