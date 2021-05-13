<template>

    <div id="address">

        <Slick @afterChange="onAfterChange" ref="slickContacts" :options="settings" v-bind:class="classSlickCarousel">
            <!---- BOX CONTACTS 1---->
            <div @mouseover="setBlock(1)"
                 class="col-xl-4 col-lg-4 com-md-6 col-sm-12 col-12">
                <div class="row-contacts__box-contact box-contact box-contact-left">

                    <div class="box-contact__header-box-contact header-box-contact">мотосервис</div>

                    <!------ Block Line Address ------->
                    <div class="box-contact__block-line-address block-line-address">
                        <div class="block-line-address__header-line-address header-line-address">
                            Адрес
                        </div>
                        <div class="block-line-address__text-line-address text-line-address">
                            Москва, пр-д Березовой Рощи д.10
                        </div>
                    </div>
                    <!------ End Block Line Address ------->


                    <!------ Block Line Phone ------->
                    <div class="box-contact__block-line-phone block-line-phone">
                        <div class="block-line-address__header-line-phone header-line-phone">
                            Телефон
                        </div>
                        <div class="block-line-address__text-line-phone text-line-phone">
                            <a class="text-line-phone__link-phone link-phone" href="tel:+74957664703">+7
                                (495) 766-47-03</a>
                        </div>
                    </div>
                    <!------ End Block Line Phone ------->


                    <!------ Block Line Email ------->
                    <div class="box-contact__block-line-email block-line-email">
                        <div class="block-line-address__header-line-email header-line-email">
                            Email
                        </div>
                        <div class="block-line-address__text-line-email text-line-email">
                            <a class="text-line-email__link-email link-email"
                               href="mailto:kazakoffmotors@gmail.com">
                                kazakoffmotors@gmail.com
                            </a>
                        </div>
                    </div>
                    <!------ End Block Line Email ------->


                    <!------ Block Line TimeWork ------->
                    <div class="box-contact__block-line-time-work block-line-time-work">
                        <div class="block-line-address__header-line-time-work header-line-time-work">
                            Время работы
                        </div>
                        <div class="block-line-address__text-line-time-work text-line-time-work">
                            с 11-00 до 19-00
                        </div>
                        <div class="block-line-address__text-help-time-work text-help-time-work">
                            Записаться и уточнить стоимость<br>
                            работ Вы можете у Администратора
                        </div>
                    </div>
                    <!------ End Block Line TimeWork ------->


                    <!------ Link in Maps Address ------->
                    <a target="_blank" class="box-contact__link-in-map-address link-in-map-address"
                       href="https://yandex.ru/maps/org/kazakoff_motors/1484362205/?ll=37.519171%2C55.788940&source=wizbiz_new_map_single&z=18">Показать
                        на карте</a>
                    <!------ End Link in Maps Address ------->

                </div>
            </div>
            <!---- END BOX CONTACTS 1 ---->

            <!---- BOX CONTACTS 2---->
            <div @mouseover="setBlock(2)"
                 class="col-xl-4 col-lg-4 com-md-6 col-sm-12 col-12">
                <div class="row-contacts__box-contact box-contact box-contact-center">

                    <div class="box-contact__header-box-contact header-box-contact">мотошкола</div>

                    <!------ Block Line Address ------->
                    <div class="box-contact__block-line-address block-line-address">
                        <div class="block-line-address__header-line-address header-line-address">
                            Адрес
                        </div>
                        <div class="block-line-address__text-line-address text-line-address">
                            Москва, ул. Крылатская д.5
                        </div>
                    </div>
                    <!------ End Block Line Address ------->


                    <!------ Block Line Phone ------->
                    <div class="box-contact__block-line-phone block-line-phone">
                        <div class="block-line-address__header-line-phone header-line-phone">
                            Телефон
                        </div>
                        <div class="block-line-address__text-line-phone text-line-phone">
                            <a class="text-line-phone__link-phone link-phone" href="tel:+74957662325">+7
                                (495)
                                766-23-25</a>
                        </div>
                    </div>
                    <!------ End Block Line Phone ------->


                    <!------ Block Line Email ------->
                    <div class="box-contact__block-line-email block-line-email">
                        <div class="block-line-address__header-line-email header-line-email">
                            Email
                        </div>
                        <div class="block-line-address__text-line-email text-line-email">
                            <a class="text-line-email__link-email link-email"
                               href="mailto:kazakoffmotors@gmail.com">
                                kazakoffmotors@gmail.com
                            </a>
                        </div>
                    </div>
                    <!------ End Block Line Email ------->


                    <!------ Block Line TimeWork ------->
                    <div class="box-contact__block-line-time-work block-line-time-work">
                        <div class="block-line-address__header-line-time-work header-line-time-work">
                            Время работы
                        </div>
                        <div class="block-line-address__text-line-time-work text-line-time-work">
                            с 08-00 до 22-00
                        </div>
                        <div class="block-line-address__text-help-time-work text-help-time-work">

                        </div>
                    </div>
                    <!------ End Block Line TimeWork ------->


                    <!------ Link in Maps Address ------->
                    <a target="_blank" class="box-contact__link-in-map-address link-in-map-address"
                       href="https://yandex.ru/maps/213/moscow/?l=sat%2Cskl&ll=37.432205%2C55.754400&mode=search&oid=224259165876&ol=biz&z=18">Показать
                        на карте</a>
                    <!------ End Link in Maps Address ------->

                </div>
            </div>
            <!---- END BOX CONTACTS 2 ---->

            <!---- BOX CONTACTS  3 ---->
            <div @mouseover="setBlock(3)"
                 class="col-xl-4 col-lg-4 com-md-6 col-sm-12 col-12">
                <div class="row-contacts__box-contact box-contact box-contact-right">

                    <div class="box-contact__header-box-contact header-box-contact">автомойка и
                        шиномонтаж
                    </div>

                    <!------ Block Line Address ------->
                    <div class="box-contact__block-line-address block-line-address">
                        <div class="block-line-address__header-line-address header-line-address">
                            Адрес
                        </div>
                        <div class="block-line-address__text-line-address text-line-address">
                            Москва, ул. Гризодубовой д. 4, к.1
                        </div>
                    </div>
                    <!------ End Block Line Address ------->


                    <!------ Block Line Phone ------->
                    <div class="box-contact__block-line-phone block-line-phone">
                        <div class="block-line-address__header-line-phone header-line-phone">
                            Телефон
                        </div>
                        <div class="block-line-address__text-line-phone text-line-phone">
                            <a class="text-line-phone__link-phone link-phone" href="tel:+79037470763">+7
                                (903)
                                747-07-63</a>
                        </div>
                    </div>
                    <!------ End Block Line Phone ------->


                    <!------ Block Line Email ------->
                    <div class="box-contact__block-line-email block-line-email">
                        <div class="block-line-address__header-line-email header-line-email">
                            Email
                        </div>
                        <div class="block-line-address__text-line-email text-line-email">
                            <a class="text-line-email__link-email link-email"
                               href="mailto:kazakoffmotors@gmail.com">
                                kazakoffmotors@gmail.com
                            </a>
                        </div>
                    </div>
                    <!------ End Block Line Email ------->


                    <!------ Block Line TimeWork ------->
                    <div class="box-contact__block-line-time-work block-line-time-work">
                        <div class="block-line-address__header-line-time-work header-line-time-work">
                            Время работы
                        </div>
                        <div class="block-line-address__text-line-time-work text-line-time-work">
                            с 08-00 до 22-00
                        </div>
                        <div class="block-line-address__text-help-time-work text-help-time-work">
                            Записаться и уточнить стоимость<br>
                            работ Вы можете у Администратора
                        </div>
                    </div>
                    <!------ End Block Line TimeWork ------->


                    <!------ Link in Maps Address ------->
                    <a target="_blank" class="box-contact__link-in-map-address link-in-map-address"
                       href="https://yandex.ru/maps/org/kazakoff/199478231812/?ll=37.529761%2C55.782592&source=wizbiz_new_map_single&z=18">Показать
                        на карте</a>
                    <!------ End Link in Maps Address ------->

                </div>
            </div>
            <!---- END BOX CONTACTS 3 ---->

        </Slick>


<!--        <div class="block-map-contacts">-->
<!--            <div id="map-moto-service" v-show="isMotoServiceMap"-->
<!--                 class="block-map-contacts__map-moto-service map-moto-service"></div>-->
<!--            <div id="map-moto-school" v-show="isMotoSchoolMap"-->
<!--                 class="block-map-contacts__map-moto-school map-moto-school"></div>-->
<!--            <div id="map-wash-tire-service" v-show="isWashServiceMap"-->
<!--                 class="block-map-contacts__map-wash-tire-service map-wash-tire-service"></div>-->
<!--        </div>-->

        <div class="block-images-contacts">
            <div class="nav-arrows"></div>
            <slick-carousel-contacts-foto :images="images"></slick-carousel-contacts-foto>
        </div>


    </div>
</template>


<script>
import Slick from 'vue-slick'
import SlickCarouselContactsFoto from "./SlickCarouselContactsFoto";
import { yandexMap, ymapMarker } from 'vue-yandex-maps'



export default {
    name: 'SlickCarouselContacts',


    //Данные которые мы выводим и применяем в шаблоне
    data() {
        return {
            classSlickCarousel: 'slider slick-carousel-contacts row',
            isMotoServiceMap: true,
            isMotoSchoolMap: false,
            isWashServiceMap: false,
            images:{},
            contactsImages: {
                motoService: [
                    {
                        "img": "/img/tpl_img/page_contacts/motoservice/1.jpg",
                        "text": "",
                    },
                    {
                        "img": "/img/tpl_img/page_contacts/motoservice/2.jpg",
                        "text": "",
                    },
                ],
                motoSchool: [
                    {
                        "img": "/img/tpl_img/page_contacts/motoschool/2.jpg",
                        "text": "",
                    },
                    {
                        "img": "/img/tpl_img/page_contacts/motoschool/1.jpg",
                        "text": "",
                    },


                ],
                motoFitting: [
                    {
                        "img": "/img/tpl_img/page_contacts/fitting/1.jpg",
                        "text": "",
                    },
                    {
                        "img": "/img/tpl_img/page_contacts/fitting/2.png",
                        "text": "",
                    },
                ]
            },


            settings: {
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
                ]


            },


        }
    },

    // All slick methods can be used too, example here
    mounted() {
        console.log("sdddddddthis.images");
console.log(this.images);

this.setBlock(1);
    },
    methods:

        {

            onAfterChange: function () {
                let currentSlide = this.$refs.slickContacts.currentSlide() + 1
                this.setBlock(currentSlide);

            },

            setBlock: function (numBlock) {

                switch (numBlock) {
                    case 1:
                        this.images = this.contactsImages.motoService;
                        break;

                    case 2:
                        this.images = this.contactsImages.motoSchool;
                        break;

                    case 3:
                        this.images = this.contactsImages.motoFitting;
                        break;

                    default:
                        this.images = this.contactsImages.motoService;
                        break;
                }
                console.log(numBlock);


            },
            next() {

                console.log("вперед");

                this.$refs.slickContacts.next()
            },
            prev() {
                console.log("назад");
                this.$refs.slickContacts.prev()
            },
            reInit() {
                // Helpful if you have to deal with v-for to update dynamic lists
                this.$refs.slickContacts.reSlick()
            }

        },
    components: {
        Slick,
        SlickCarouselContactsFoto,
        yandexMap, ymapMarker
    }
}
</script>
