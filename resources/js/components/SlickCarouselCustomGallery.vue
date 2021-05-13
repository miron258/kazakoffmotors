<template>
        <Slick @init="onInitCarousel" v-if="images" :ref="refGallery" :options="settings" v-bind:class="classSlickCarousel">
            <!-------------- BOX SLICK ITEM ----------------->
            <div v-for="(image, index) in images" class="slick-carousel-our-work__box-slick-item box-slick-item">
                <a @click.prevent class="box-slick-item__box-slick-item-link box-slick-item-link">
                    <img :alt="image.alt"
                         class="box-slick-item-link__box-slick-item-img img-fluid box-slick-item-img"
                         :src="image.pathImg">
                </a>
            </div>
            <!-------------- END BOX SLICK ITEM ----------------->
        </Slick>
</template>

<script>
import Slick from 'vue-slick'
import mixins from './mixins/mixins'; //Vue Mixins
Vue.mixin(mixins);

export default {
    name: 'SlickCarouselCustomGallery',
    props: ['isNav', 'isDots', 'classNav', 'classDots', 'refGallery', 'classSlick', 'images'],
    mounted() {



    },
    //Данные которые мы выводим и применяем в шаблоне
    data() {
        return {
            classSlickCarousel: "slick-carousel "+this.classSlick,

            settings: {
                autoplay: false,
                adaptiveHeight: true,
                // variableWidth: true,
                lazyLoad: 'progressive',
                arrows: this.isNav,
                dots: this.isDots,
                rows: 0,
                slidesToShow: 1,
                slidesToScroll: 1,
                appendArrows: "."+this.classNav,
                appendDots: "."+this.classDots,
                nextArrow: '<button type="button" class="slick-carousel-control-next"></button>',
                prevArrow: '<button type="button" class="slick-carousel-control-prev"></button>',
                asNavFor: "."+this.classSlick+"thumbnails",
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


            },


        }
    },

    // All slick methods can be used too, example here
    methods:
        {
            onInitCarousel(event){


                // let slider = event.target;


                // this.multiSlideAdaptiveHeight(slider);

                // console.log(slider);
                // console.log('our carousel is ready')
            },
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
