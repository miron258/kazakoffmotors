<template>

    <div class="wrapper-slick-carousel">
        <div class="nav-arrows"></div>
        <Slick v-if="slider.images.length>0" ref="slick" :options="settings" v-bind:class="classSlickCarousel">
            <div v-for="(image,key) in slider.images" class="">

                <div class="box-list-img__item-img item-img">
                    <img :alt="image.title" class="img-fluid item-img__img-motosrv img-motosrv" :src="image.path">
                </div>

            </div>

        </Slick>
    </div>

</template>

<script>
import Slick from 'vue-slick'


export default {
    name: 'SlickCarouselContactsEvacuation',
    props: ['images'],
    //Данные которые мы выводим и применяем в шаблоне
    data() {
        return {
            slider: {
                images: [
                    {
                        "path": "/img/tpl_img/page_evakuatsiya/img_evakuatsiya1.jpg",
                        "title": "Эвакуация Мотосервис Казакофф Моторс"
                    },
                    {
                        "path": "/img/tpl_img/page_evakuatsiya/img_evakuatsiya2.jpeg",
                        "title": "Эвакуация Мотосервис Казакофф Моторс"
                    },
                    {
                        "path": "/img/tpl_img/page_evakuatsiya/img_evakuatsiya3.jpg",
                        "title": "Эвакуация Мотосервис Казакофф Моторс"
                    }
                ],

            },
            classSlickCarousel: 'slider slick-carousel-evacuation row',
            settings: {
                method: {},
                adaptiveHeight: true,
                dots: true,
                arrows: true,
                appendArrows: '.nav-arrows',
                infinite: false,
                speed: 300,
                nextArrow: '<button type="button" class="slick-arrow slick-carousel-control-next"></button>',
                prevArrow: '<button type="button" class="slick-arrow slick-carousel-control-prev"></button>',
                // asNavFor: 'slick-carousel-control', //Enables syncing of multiple sliders
                slidesToShow: 1,
                slidesToScroll: 1,
                rows: 0,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            infinite: true,
                            dots: false
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 1,
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
