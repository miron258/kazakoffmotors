<div id="block-shop-catalogs" class="block-shop-catalogs">

    <div class="container">

        <div class="block-shop-catalogs__header-block-shop-catalogs header-block-shop-catalogs">
            <h2 data-aos="zoom-out-right">Магазин</h2>
            <p data-aos="zoom-out-left" class="header-block-shop-catalogs__text-block-shop-catalogs text-block-shop-catalogs">
                Выберите интересующий вас раздел для просмотра товаров
            </p>
        </div>


        <div class="row block-shop-catalogs__list-catalogs list-catalogs">

        @foreach($catalogs as $k=>$catalog)
            <!------------ Box Catalog ---------------->
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-6">
                    <div data-aos="flip-left"
                         data-aos-easing="ease-out-cubic"
                         data-aos-duration="{{$k+1}}000" class="list-catalogs__box-catalog box-catalog box-catalog-{{$k+1}}">
                        <a href="{{route('catalog_site.index', $catalog->url)}}"
                           class="box-catalog__block-img-catalog block-img-catalog">
                            <figure>

                                @switch($catalog->id)

                                    @case(1)
                                    <img class="block-img-catalog__img-catalog img-catalog img-fluid"
                                         alt="{{$catalog->name}}" src="{{asset('img/usr_img/cover_catalog_shop/cover_hd.png')}}">
                                    @break

                                    @case(2)
                                    <img class="block-img-catalog__img-catalog img-catalog img-fluid"
                                         alt="{{$catalog->name}}" src="{{asset('img/usr_img/cover_catalog_shop/cover_sparts_oem.png')}}">
                                    @break

                                    @case(3)
                                    <img class="block-img-catalog__img-catalog img-catalog img-fluid"
                                         alt="{{$catalog->name}}" src="{{asset('img/usr_img/cover_catalog_shop/cover_sparts_by.png')}}">
                                    @break

                                    @case(4)
                                    <img class="block-img-catalog__img-catalog img-catalog img-fluid"
                                         alt="{{$catalog->name}}" src="{{asset('img/usr_img/cover_catalog_shop/cover_motyl.png')}}">
                                    @break

                                    @default


                                @endswitch



                            </figure>
                            <div class="block-img-catalog__name-catalog name-catalog">{{$catalog->name}}</div>

                        </a>
                    </div>
                </div>
                <!------------ End Box Catalog ---------------->
            @endforeach


        </div>


        <a class="block-shop-catalogs__link-view-shop link-view-shop" href="/catalog/shop"><span
                class="text-link">перейти в магазин</span></a>

    </div>

</div>
