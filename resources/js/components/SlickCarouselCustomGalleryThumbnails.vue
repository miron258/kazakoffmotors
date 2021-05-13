<template>
        <Slick v-if="images" ref="slick" :options="settings" v-bind:class="classSlickCarousel">
            <!-------------- BOX SLICK ITEM ----------------->
            <div v-for="(image, index) in images" class="slick-carousel-our-work__box-slick-item box-slick-item">
                <a @click.prevent class="box-slick-item__box-slick-item-link box-slick-item-link">
                    <img :alt="image.alt"
                         class="box-slick-item-link__box-slick-item-img img-fluid box-slick-item-img"
                         :src="image.pathImgThumbnail">
                </a>
            </div>
            <!-------------- END BOX SLICK ITEM ----------------->
        </Slick>
</template>

<script>
import Slick from 'vue-slick'
export default {
    name: 'SlickCarouselCustomGalleryThumbnails',
    props: [ 'classSlick', 'images'],
    //Данные которые мы выводим и применяем в шаблоне
    data() {
        return {
            classSlickCarousel: "slick-carousel-thumbnails "+this.classSlick+"thumbnails",

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
                asNavFor: "."+this.classSlick,
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
