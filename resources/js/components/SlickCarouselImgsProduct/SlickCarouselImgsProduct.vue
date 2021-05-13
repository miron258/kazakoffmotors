<template>
    <div class="row block-slick-carousel-product">

        <!--------------- BLOCK LIST IMAGES PRODUCT ----------------->
        <div
            class="col-xl-10 col-lg-10 col-12 block-slick-carousel-product__column-list-images-product column-list-images-product">
            <Slick  v-if="productImages"  ref="slick" :options="settings" v-bind:class="classSlickCarousel">
                <div v-for="(image,index) in productImages" class="box-slick-item">
                    <img :src="image.path" :alt="image.alt" class="img-fluid box-slick-item-img">
                </div>
            </Slick>
        </div>
        <!--------------- END BLOCK LIST IMAGES PRODUCT ----------------->


        <!------------ BLOCK LIST THUMBNAILS PRODUCT --------------->
        <div v-if="isThumbnails"
            class="col-xl-2 col-lg-2 block-slick-carousel-product__column-list-thumbnails-product column-list-thumbnails-product">
            <Slick v-if="productImages" ref="slickThumbnails" :options="settingProductThumbnails" v-bind:class="classSlickCarouselThumbnails">
                <div v-for="(image,index) in productImages" class="box-slick-item">
                    <a class="box-slick-item-link">
                        <img :src="image.pathThumbnail" :alt="image.alt" class="img-fluid box-slick-item-img">
                    </a>
                </div>
            </Slick>
        </div>
        <!------------ END BLOCK LIST THUMBNAILS PRODUCT --------------->


    </div>


</template>

<script>
import Slick from 'vue-slick'


//Если метод render() определен в нашем компоненте Vue проигнорирует определение нашего шаблона

export default {
    name: 'SlickCarouselImgsProduct',
    components: {Slick},
    // All slick methods can be used too, example here
    methods: {
        next() {
            this.$refs.slick.next()
        },
        prev() {
            this.$refs.slick.prev()
        },
        onInitCarousel() {

            console.log('our carousel is ready')
        },
        reInit() {
            // Helpful if you have to deal with v-for to update dynamic lists
            this.$refs.slick.reSlick()
        },
    },
    props: ['images', 'arrows', 'isThumbnails'],
    computed: {
        productImages() {
            if (this.images) {
                return this.images.map(function (image) {
                    image.path = "/storage/products/" + image.name;
                    image.pathThumbnail = "/storage/products/thumbs/" + image.name;
                    return image;
                });
            }
        }
    },


    //Данные которые мы выводим и применяем в шаблоне
    data() {
        return {
            'classSlickCarousel': 'slick-carousel-product',
            'classSlickCarouselThumbnails': 'slick-carousel-product-thumbnails',

            //Настройки карусели для слайдера на главной странице
            settings: {
                enabled: true,
                autoplay: false,
                lazyLoad: false,
                // adaptiveHeight: true,
                arrows: this.arrows,
                dots: false,
                rows: 0,
                slidesToShow: 1,
                slidesToScroll: 1,
                // appendArrows: '.nav-arrows-',
                // appendDots: '.dots-our-work',
                // nextArrow: '<button type="button" class="slick-carousel-control-next"></button>',
                // prevArrow: '<button type="button" class="slick-carousel-control-prev"></button>',
                asNavFor: '.slick-carousel-product-thumbnails',
                draggable: true,
                autoplaySpeed: 3000,
                method: {},
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            arrows: this.arrows,
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
                            arrows: this.arrows,
                            slidesToShow: 2,
                            slidesToScroll: 1,
                            dots: false
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            adaptiveHeight: false,
                            arrows: this.arrows,
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            dots: false
                        }
                    }
                ],


            },



            //Настройки карусели для слайдера на главной странице
            settingProductThumbnails: {
                enabled: true,
                autoplay: false,
                lazyLoad: false,
                dots: false,
                arrows: false,
                rows: 0,
                focusOnSelect: true,
                verticalSwiping: true,
                vertical: true,
                slidesToShow: 4,
                slidesToScroll: 1,
                asNavFor: '.slick-carousel-product',
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


            }
        }

    },
    /// 1 Событие доздания
    beforeCreate: function() {

    },
    ///2 Событие после создания
    created: function() {


    },

    /// 3 Вызаывается после монтирования полной загрузки копмоненрта
    mounted() {

        console.log(this.images);




    }

}
</script>
