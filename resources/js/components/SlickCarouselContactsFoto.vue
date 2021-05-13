<template>

    <Slick v-if="images.length>0" ref="slick" :options="settings" v-bind:class="classSlickCarousel">
        <div v-for="(image,key) in images" class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="block-images-contacts__box-img-contact box-img-contact">
                <div class="box-img-contact__img-contact img-contact">
                    <img :alt="image.text" class="img-fluid"
                         :src="image.img">
                </div>
                <div v-text="image.text" class="box-img-contact__text-contact text-contact">
                </div>
            </div>
        </div>


    </Slick>


</template>

<script>
import Slick from 'vue-slick'


export default {
    name: 'SlickCarouselContactsFoto',
    props: ['images'],
    //Данные которые мы выводим и применяем в шаблоне
    data() {
        return {
            classSlickCarousel: 'slider slick-carousel-contacts-foto row',
            settings: {
                method: {},
                dots: true,
                arrows: true,
                appendArrows: '.nav-arrows',
                infinite: false,
                speed: 300,
                nextArrow: '<button type="button" class="slick-arrow slick-carousel-control-next"></button>',
                prevArrow: '<button type="button" class="slick-arrow slick-carousel-control-prev"></button>',
                // asNavFor: 'slick-carousel-control', //Enables syncing of multiple sliders
                slidesToShow: 2,
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
                            adaptiveHeight: true,
                            dots: false,
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            adaptiveHeight: true,
                            dots: false,
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]


            },


        }
    },
mounted() {


    console.log("this.images");
        console.log(this.images);
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
