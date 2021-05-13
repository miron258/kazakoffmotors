<!--noindex-->
<mmenu-mobile v-bind:m-menu='@json($menu['mainmenujson']) '></mmenu-mobile>
<div class="d-xl-none d-lg-none d-md-none d-sm-none d-block">
    <div class="bt-mmenu row">
        <div style="height: 50px; position: absolute;"></div>
        <a class="bt-menu__link-bt-menu link-bt link-bt-menu mburger col-3" href="#menu"><span class="text-bt">меню</span></a>
        <a class="bt-menu__link-bt-phone link-bt link-bt-phone col-3" href="tel:+74957662325"><span class="text-bt">позвонить</span></a>
        <a class="bt-menu__link-bt-address link-bt link-bt-address col-3" href="/page/kontakti#address"><span
                class="text-bt">адреса</span></a>
        <a class="bt-menu__link-bt-menu link-bt link-bt-cart col-3" href="/cart"><span
                class="text-bt">корзина</span>
        <span v-if="$store.getters.total" class="total-product">@{{$store.getters.total}}</span>
        </a>
    </div>

</div>
<!--/noindex-->

<!---------------------------------- HEADER -------------------------------------------------->
<div class="header @if($headerMini) header-mini @endif @isset($classHeader) {{$classHeader}} @endisset">
    <div class="container">

        <div class='row'>
            <!------------------ Header LeftBlock --------------------->
            <div class='col-xl-5 col-lg-5 d-xl-block d-lg-block d-md-block d-sm-none d-none'>

                <div class='header__header-leftblock header-leftblock'>

                    <!------------------ List Social Icons ------------------>
                    <div class="header-leftblock__block-list-social-icon block-list-social-icon">
                        <ul class="block-list-social-icon__list-social-icon list-social-icon">

                            <li class="list-social-icon__item-social-icon item-social-icon item-social-icon-instagram">
                                <a target="_blank" class="item-social-icon__link-social-icon link-social-icon"
                                   href="https://www.instagram.com/moto_school.ru">
                                    <img class="link-social-icon__img-social-icon img-social-icon" alt="Мы в Instagram"
                                         src="{{asset('img/tpl_img/social_icons/instagram.png')}}">
                                </a>
                            </li>

                            <li class="list-social-icon__item-social-icon item-social-icon item-social-icon-fb">
                                <a target="_blank" class="item-social-icon__link-social-icon link-social-icon"
                                   href="https://www.facebook.com/groups/371914162843244">
                                    <img class="link-social-icon__img-social-icon img-social-icon" alt="Мы на Facebook"
                                         src="{{asset('img/tpl_img/social_icons/fb.png')}}">
                                </a>
                            </li>

                            <li class="list-social-icon__item-social-icon item-social-icon item-social-icon-vk">
                                <a target="_blank" class="item-social-icon__link-social-icon link-social-icon"
                                   href="https://vk.com/public36588859">
                                    <img class="link-social-icon__img-social-icon img-social-icon" alt="Мы в Контакте"
                                         src="{{asset('img/tpl_img/social_icons/vk.png')}}">
                                </a>
                            </li>


                            <li class="list-social-icon__item-social-icon item-social-icon item-social-icon-yb">
                                <a target="_blank" class="item-social-icon__link-social-icon link-social-icon"
                                   href="https://www.youtube.com/channel/UCGH42q0LFfl12N2qWUb2v3g">
                                    <img class="link-social-icon__img-social-icon img-social-icon" alt="Мы на YOUTUBE"
                                         src="{{asset('img/tpl_img/social_icons/youtube.png')}}">
                                </a>
                            </li>

                        </ul>
                    </div>
                    <!------------------ End List Social Icons ------------------>


                    <!-------------- Left Menu Navigation ---------------->
                    @if(!$headerShop)
                        <div class="header-leftblock__block-left-menu-navigation block-left-menu-navigation">
                            {{$menu['leftMenu']}}
                        </div>
                @endif
                <!-------------- End Left Menu Navigation ---------------->


                </div>

            </div>
            <!------------------ End Header LeftBlock --------------------->


            <!--------------- Header Block Logo --------------------->
            <div class='col-xl-2 col-lg-2 col-md-2 col-sm-6 col-12'>
                <div class='header__header-block-logo header-block-logo'>
                    <a class="header-block-logo__link-logo link-logo" href='/'>
                        @if(!$headerShop)
                            <img class="link-logo__img-logo img-logo d-xl-block d-lg-block d-md-block d-sm-none d-none"
                                 src="{{asset('img/tpl_img/logo.png')}}" alt="Мотосервис Казакофф Моторс">
                        @else
                            <img class="link-logo__img-logo img-logo d-xl-block d-lg-block d-md-block d-sm-none d-none"
                                 src="{{asset('img/tpl_img/logo_catalog.png')}}" alt="Мотосервис Казакофф Моторс">
                        @endif


                        @if(!$headerMini)
                        <!--noindex-->
                            <img
                                class="link-logo__img-logo img-logo img-logo-mobile d-xl-none d-lg-none d-md-none d-sm-none d-block"
                                src="{{asset('img/tpl_img/mobile/logo_mobile_home.png')}}"
                                alt="Мотосервис Казакофф Моторс">
                            <!--/noindex-->
                        @else
                        <!--noindex-->
                            <img
                                class="link-logo__img-logo img-logo img-logo-mobile-inner-page d-xl-none d-lg-none d-md-none d-sm-none d-block"
                                src="{{asset('img/tpl_img/mobile/logo_mobile_inner_page.png')}}"
                                alt="Мотосервис Казакофф Моторс">
                            <!--/noindex-->
                            <img class="link-logo__img-logo img-logo img-logo-mobile-catalog d-none"
                                 src="{{asset('img/tpl_img/mobile/shop/logo_mobile_shop.png')}}"
                                 alt="Мотосервис Казакофф Моторс">
                            <!--/noindex-->
                        @endif
                    </a>
                </div>
            </div>
            <!--------------- End Header Block Logo --------------------->


            <!------------------ Header RightBlock --------------------->
            <div class='col-xl-5 col-lg-5 d-xl-block d-lg-block d-md-block d-sm-none d-none'>

                <div class="header__header-rightblock header-rightblock">

                    <!------------ Header Block Contacts ------------>
                    <div class="header-rightblock__block-header-contacts row block-header-contacts">

                        <div class="col-xl-8 col-lg-8">
                            <a class="block-header-contacts__link-phone link-phone" href="tel:+74957664703">
                                +7 (495) 766-47-03
                            </a>
                        </div>

                        <div class="col-xl-4 col-lg-4">
                            <header-cart></header-cart>
                        </div>


                    </div>
                    <!------------ End Header Block Contacts ------------>

                @if(!$headerShop)
                    <!------------------- Header Block RightMenu --------------->
                        <div class="header-rightblock__block-right-menu-navigation block-right-menu-navigation">
                            {{$menu['rightMenu']}}
                        </div>
                        <!------------------- End Header Block RightMenu --------------->
                    @endif
                </div>


            </div>
            <!------------------ End Header RightBlock --------------------->
        </div>


        @if ($headerShop)
            <div class="row header__row-shop-menu row-shop-menu">


                <div
                    class="col-xl-7 col-lg-7 col-md-7 col-sm-12 col-12 row-shop-menu__wrapper-box-shop-menu d-xl-block d-lg-block d-md-block d-sm-none d-none wrapper-box-shop-menu">

                    <div class="wrapper-box-shop-menu__box-shop-menu box-shop-menu">
                        {{$menu['shopMenu']}}
                    </div>

                </div>


                <div
                    class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12 row-shop-menu__wrapper-box-search-catalog wrapper-box-search-catalog">
                    <search ref="search"></search>
                </div>


            </div>
        @endif


        @if ($viewHeader)
        <!-------------- Header Block H1 ------------->
            <div class="row">
                <div class="header__header-block-h1 header-block-h1">
                    <h1 class="header-block-h1__h1-head h1-head">Мотосервис
                        <span class="h1-head__text-inner-h1 text-inner-h1">в москве</span>
                    </h1>
                </div>
            </div>
            <!-------------- End Header Block H1 ------------->
        @endif

        <div class="row header__header-block-bcontacts header-block-bcontacts">

            @if ($viewHeader)
                <div class="col-xl-6 col-lg-6">
                    <div data-block="#block-services"
                         class="header-block-bcontacts__block-link-scrolling block-link-scrolling">
                        <a data-block="#block-services" class="block-link-scrolling__arrow-chevron arrow-chevron">
                            <span></span>
                            <span></span>
                            <span></span>
                        </a>
                    </div>
                </div>
            @endif


            @if(!$headerShop)
                <div
                    class="@if($headerMini) col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 @else col-xl-6 col-lg-6 @endif">
                    <div class="header-block-bcontacts__block-address block-address">
                        <a target="_blank" class="block-address__link-address link-address"
                           href="https://yandex.ru/maps/org/kazakoff_motors/1484362205/?ll=37.519171%2C55.788940&source=wizbiz_new_map_single&z=18">Москва,
                            проезд Березовой Рощи д.10</a>
                    </div>


                    <div
                        class="header-block-bcontacts__block-mobile-phone block-mobile-phone d-xl-none d-lg-none d-md-none d-sm-block d-block">
                        <a class="block-mobile-phone__link-mobile-phone link-mobile-phone" href="tel:+74957664703">
                            +7 (495) 766-47-03
                        </a>
                    </div>

                </div>
            @endif


        </div>


    </div>


    @if($headerShop)
        <fixed-header-custom>

            <template slot="menuShopCatalog">
                {{$menu['shopMenuCatalog']}}
            </template>

        </fixed-header-custom>
    @endif


</div>
<!-------------------------------------- END HEADER ----------------------------------------------->
