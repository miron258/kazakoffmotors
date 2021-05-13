<template>
        <Slick v-if="images" ref="slick" :options="settings" v-bind:class="classSlickCarousel">
                <div v-for="(image,index) in images" class="slick-carousel-our-work__box-slick-item box-slick-item">
                    <img :alt="image.alt" class="box-slick-item__box-slick-item-img img-fluid box-slick-item-img"
                         :src="image.pathImg">
                </div>
        </Slick>
</template>

<script>
import Slick from 'vue-slick'


export default {
    name: 'SlickCarouselOurWork',
    props: ['images'],
    //Данные которые мы выводим и применяем в шаблоне
    data() {
        return {
            classSlickCarousel: 'box-slider-carousel__slick-carousel-our-work slick-carousel-our-work',

            settings: {
                enabled: true,
                autoplay: false,
                adaptiveHeight: true,
                arrows: true,
                dots: true,
                rows: 0,
                slidesToShow: 1,
                slidesToScroll: 1,
                appendArrows: '.nav-our-work',
                appendDots: '.dots-our-work',
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
                            adaptiveHeight: true,
                            slidesToShow: 2,
                            slidesToScroll: 1,
                            dots: false
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            adaptiveHeight: true,
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            dots: false
                        }
                    }
                ],


            },


        }
    },

    // All slick methods can be used too, example here
    methods:
        {
            next() {
                this.$refs.slick.next()
            },
            prev() {
                this.$refs.slick.prev()
            },
            reInit() {
                // Helpful if you have to deal with v-for to update dynamic lists
                this.$refs.slick.reSlick()
            }

        },
    components: {
        Slick
    }
}
</script>
