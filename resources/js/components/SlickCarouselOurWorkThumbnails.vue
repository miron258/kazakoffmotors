<template>
        <Slick ref="slickThumbnails" :options="settings" v-bind:class="classSlickCarousel">
            <div v-if="images" v-for="(image, index) in images" class="slick-carousel-our-work__box-slick-item box-slick-item">
                <a @click.prevent class="box-slick-item__box-slick-item-link box-slick-item-link">
                    <img :alt="image.alt"
                         class="box-slick-item-link__box-slick-item-img img-fluid box-slick-item-img"
                         :src="image.pathImgThumbnail">
                </a>
            </div>
        </Slick>
</template>

<script>
import Slick from 'vue-slick'

export default {
    name: 'SlickCarouselOurWorkThumbnails',
    props: ['images'],
    //Данные которые мы выводим и применяем в шаблоне
    data() {
        return {
            classSlickCarousel: 'block-slick-carousel-our-work__slick-carousel-our-work-thumbnails slick-carousel-our-work-thumbnails',

            settings: {
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


            },


        }
    },

    // All slick methods can be used too, example here
    methods:
        {
            next() {
                this.$refs.slickThumbnails.next()
            },
            prev() {
                this.$refs.slickThumbnails.prev()
            },
            reInit() {
                // Helpful if you have to deal with v-for to update dynamic lists
                this.$refs.slickThumbnails.reSlick()
            }

        },
    components: {
        Slick
    }
}
</script>
