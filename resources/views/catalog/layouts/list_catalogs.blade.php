<!------------ List Catalogs ---------------->
<div
    class="block-view-catalog__list-catalogs list-catalogs @if(!empty($class_catalog))list-catalogs-{{$class_catalog}}@endif">


@if(!empty($catalogs))


    @switch($catalog->id)


        @case(6)



        <!------------- LEFT BLOCK CATALOG --------------->
            @php
                $catalogHd = $catalogs->find(1);
                $catalogMotul = $catalogs->find(4);
                $catalogBySpare = $catalogs->find(3);
                $catalogOemSpare = $catalogs->find(2);
            @endphp
            <div class="row">
                <div
                    class="list-catalogs__left-block-catalog col-xl-7 col-lg-auto col-md-auto col-sm-12 col-12 left-block-catalog">

                    <!------------ BOX CATALOG -------------->
                    <div class="left-block-catalog__box-catalog box-catalog d-flex box-catalog-hd">
                        <img class="box-catalog__cover-catalog cover-catalog" alt="{{$catalogHd->name}}"
                             src="{{Storage::url($catalogHd->img)}}">
                        <div class="box-catalog__name-catalog align-self-center block-name-catalog">

                            <div class="block-name-catalog__name-catalog name-catalog">
                                {!! $catalogHd->name !!}
                            </div>

                            <a href="{{route('catalog_site.index', $catalogHd->url)}}"
                               class="box-catalog__link-catalog align-self-center link-catalog">
                                <span class="link-catalog__text-link-catalog text-link-catalog">смотреть</span>
                            </a>
                        </div>

                    </div>
                    <!------------ END BOX CATALOG -------------->

                </div>
                <!------------- END  LEFT BLOCK CATALOG --------------->


                <!------------- RIGHT BLOCK CATALOG --------------->

                <div
                    class="list-catalogs__right-block-catalog col-xl-5 col-lg-auto col-md-auto col-sm-12 col-12 right-block-catalog">


                    <!------------ BOX CATALOG -------------->
                    <div class="left-block-catalog__box-catalog box-catalog d-flex box-catalog-by-spare">
                        <img class="box-catalog__cover-catalog cover-catalog" alt="{{$catalogBySpare->name}}"
                             src="{{Storage::url($catalogBySpare->img)}}">
                        <div class="box-catalog__name-catalog align-self-center block-name-catalog">

                            <div class="block-name-catalog__name-catalog name-catalog">
                                {!! $catalogBySpare->name !!}
                            </div>

                            <a href="{{route('catalog_site.index', $catalogBySpare->url)}}"
                               class="box-catalog__link-catalog align-self-center link-catalog">
                                <span class="link-catalog__text-link-catalog text-link-catalog">смотреть</span>
                            </a>
                        </div>
                    </div>
                    <!------------ END BOX CATALOG -------------->


                    <!------------ BOX CATALOG -------------->
                    <div class="left-block-catalog__box-catalog box-catalog d-flex box-catalog-oem-spare">
                        <img class="box-catalog__cover-catalog cover-catalog" alt="{{$catalogOemSpare->name}}"
                             src="{{Storage::url($catalogOemSpare->img)}}">
                        <div class="box-catalog__name-catalog align-self-center block-name-catalog">

                            <div class="block-name-catalog__name-catalog name-catalog">
                                {!! $catalogOemSpare->name !!}
                            </div>

                            <a href="{{route('catalog_site.index', $catalogOemSpare->url)}}"
                               class="box-catalog__link-catalog align-self-center link-catalog">
                                <span class="link-catalog__text-link-catalog text-link-catalog">смотреть</span>
                            </a>
                        </div>
                    </div>
                    <!------------ END BOX CATALOG -------------->


                    <!------------ BOX CATALOG -------------->
                    <div class="left-block-catalog__box-catalog box-catalog d-flex box-catalog-motul-spare">
                        <img class="box-catalog__cover-catalog cover-catalog" alt="{{$catalogMotul->name}}"
                             src="{{Storage::url($catalogMotul->img)}}">
                        <div class="box-catalog__name-catalog align-self-center block-name-catalog">

                            <div class="block-name-catalog__name-catalog name-catalog">
                                {!! $catalogMotul->name !!}
                            </div>

                            <a href="{{route('catalog_site.index',$catalogMotul->url)}}"
                               class="box-catalog__link-catalog align-self-center link-catalog">
                                <span class="link-catalog__text-link-catalog text-link-catalog">смотреть</span>
                            </a>
                        </div>
                    </div>
                    <!------------ END BOX CATALOG -------------->


                </div>

                <!------------- END RIGHT BLOCK CATALOG --------------->
            </div>
            @break


        <!--------------------- КАТАЛОГ HARLEY DAVIDSON ------------------->
            @case(1)
        <!------------- LEFT BLOCK CATALOG --------------->
            @php
                $catalogOrigSpartsHd = $catalogs->find(7);
                $catalogByHd = $catalogs->find(8);
                $catalogInteriorItemsHd = $catalogs->find(9);
                $catalogGarageProductsHd = $catalogs->find(10);
            @endphp
            <div class="row">
                <div
                    class="list-catalogs__left-block-catalog col-xl-7 col-lg-auto col-md-auto col-sm-12 col-12 left-block-catalog">

                    <!------------ BOX CATALOG -------------->
                    <div class="left-block-catalog__box-catalog box-catalog d-flex box-catalog-orig-sparts">
                        <img class="box-catalog__cover-catalog cover-catalog" alt="{{$catalogOrigSpartsHd->name}}"
                             src="{{Storage::url($catalogOrigSpartsHd->img)}}">
                        <div class="box-catalog__name-catalog align-self-center block-name-catalog">

                            <div class="block-name-catalog__name-catalog name-catalog">
                                {!! $catalogOrigSpartsHd->name !!}
                            </div>

                            <a href="{{route('catalog_site.index', $catalogOrigSpartsHd->url)}}"
                               class="box-catalog__link-catalog align-self-center link-catalog">
                                <span class="link-catalog__text-link-catalog text-link-catalog">смотреть</span>
                            </a>
                        </div>

                    </div>
                    <!------------ END BOX CATALOG -------------->

                </div>
                <!------------- END  LEFT BLOCK CATALOG --------------->


                <!------------- RIGHT BLOCK CATALOG --------------->

                <div
                    class="list-catalogs__right-block-catalog col-xl-5 col-lg-auto col-md-auto col-sm-12 col-12 right-block-catalog">


                    <!------------ BOX CATALOG -------------->
                    <div class="left-block-catalog__box-catalog box-catalog d-flex box-catalog-by-hd">
                        <img class="box-catalog__cover-catalog cover-catalog" alt="{{$catalogByHd->name}}"
                             src="{{Storage::url($catalogByHd->img)}}">
                        <div class="box-catalog__name-catalog align-self-center block-name-catalog">

                            <div class="block-name-catalog__name-catalog name-catalog">
                                {!! $catalogByHd->name !!}
                            </div>

                            <a href="{{route('catalog_site.index', $catalogByHd->url)}}"
                               class="box-catalog__link-catalog align-self-center link-catalog">
                                <span class="link-catalog__text-link-catalog text-link-catalog">смотреть</span>
                            </a>
                        </div>
                    </div>
                    <!------------ END BOX CATALOG -------------->


                    <!------------ BOX CATALOG -------------->
                    <div class="left-block-catalog__box-catalog box-catalog d-flex box-catalog-interior-items">
                        <img class="box-catalog__cover-catalog cover-catalog" alt="{{$catalogInteriorItemsHd->name}}"
                             src="{{Storage::url($catalogInteriorItemsHd->img)}}">
                        <div class="box-catalog__name-catalog align-self-center block-name-catalog">

                            <div class="block-name-catalog__name-catalog name-catalog">
                                {!! $catalogInteriorItemsHd->name !!}
                            </div>

                            <a href="{{route('catalog_site.index', $catalogInteriorItemsHd->url)}}"
                               class="box-catalog__link-catalog align-self-center link-catalog">
                                <span class="link-catalog__text-link-catalog text-link-catalog">смотреть</span>
                            </a>
                        </div>
                    </div>
                    <!------------ END BOX CATALOG -------------->


                    <!------------ BOX CATALOG -------------->
                    <div class="left-block-catalog__box-catalog box-catalog d-flex box-catalog-garage-products">
                        <img class="box-catalog__cover-catalog cover-catalog" alt="{{$catalogGarageProductsHd->name}}"
                             src="{{Storage::url($catalogGarageProductsHd->img)}}">
                        <div class="box-catalog__name-catalog align-self-center block-name-catalog">

                            <div class="block-name-catalog__name-catalog name-catalog">
                                {!! $catalogGarageProductsHd->name !!}
                            </div>

                            <a href="{{route('catalog_site.index',$catalogGarageProductsHd->url)}}"
                               class="box-catalog__link-catalog align-self-center link-catalog">
                                <span class="link-catalog__text-link-catalog text-link-catalog">смотреть</span>
                            </a>
                        </div>
                    </div>
                    <!------------ END BOX CATALOG -------------->


                </div>

                <!------------- END RIGHT BLOCK CATALOG --------------->
            </div>
            @break
        <!--------------------- КОНЕЦ КАТАЛОГ HARLEY DAVIDSON ------------------->



            <!--------------------- КАТАЛОГ ЗАПЧАСТИ ОЕМ ------------------->
            @case(2)
            @php
                $catalogYamaha = $catalogs->find(11);
                $catalogHonda = $catalogs->find(12);
                $catalogSuzuki = $catalogs->find(13);
                $catalogKawasaki = $catalogs->find(14);
                $catalogMhd = $catalogs->find(15);
            @endphp
            <div class="d-flex flex-row row-list-catalogs row-list-catalogs-top">


                <!--------------- BOX CATALOG ------------------>
                <div
                    class="row-list-catalogs__wrapper-box-catalog wrapper-box-catalog @if(!empty($catalogYamaha->class_catalog))wrapper-box-catalog-{{$catalogYamaha->class_catalog}}@endif">
                    <div
                        class="wrapper-box-catalog__box-catalog box-catalog @if(!empty($catalogYamaha->class_catalog))box-catalog-{{$catalogYamaha->class_catalog}} @endif">
                        <a class="box-catalog__link-box-catalog link-box-catalog"
                           href="{{route('catalog_site.index',$catalogYamaha->url)}}">
                            <img alt="{{$catalogYamaha->name}}"
                                 class="link-box-catalog__img-cover-catalog img-cover-catalog"
                                 src="{{Storage::url($catalogYamaha->img)}}">
                            <div
                                class="link-box-catalog__brand-catalog brand-catalog @if(!empty($catalogYamaha->class_catalog))brand-catalog-{{$catalogYamaha->class_catalog}} @endif"></div>
                        </a>
                    </div>
                </div>
                <!--------------- END BOX CATALOG ------------------>


                <!--------------- BOX CATALOG ------------------>
                <div
                    class="row-list-catalogs__wrapper-box-catalog wrapper-box-catalog @if(!empty($catalogHonda->class_catalog))wrapper-box-catalog-{{$catalogHonda->class_catalog}}@endif">
                    <div
                        class="wrapper-box-catalog__box-catalog box-catalog @if(!empty($catalogHonda->class_catalog))box-catalog-{{$catalogHonda->class_catalog}} @endif">
                        <a class="box-catalog__link-box-catalog link-box-catalog"
                           href="{{route('catalog_site.index',$catalogHonda->url)}}">
                            <img alt="{{$catalogHonda->name}}"
                                 class="link-box-catalog__img-cover-catalog img-cover-catalog"
                                 src="{{Storage::url($catalogHonda->img)}}">
                            <div
                                class="link-box-catalog__brand-catalog brand-catalog @if(!empty($catalogHonda->class_catalog))brand-catalog-{{$catalogHonda->class_catalog}} @endif"></div>
                        </a>
                    </div>
                </div>
                <!--------------- END BOX CATALOG ------------------>

                <!--------------- BOX CATALOG ------------------>
                <div
                    class="row-list-catalogs__wrapper-box-catalog wrapper-box-catalog @if(!empty($catalogSuzuki->class_catalog))wrapper-box-catalog-{{$catalogSuzuki->class_catalog}}@endif">
                    <div
                        class="wrapper-box-catalog__box-catalog box-catalog @if(!empty($catalogSuzuki->class_catalog))box-catalog-{{$catalogSuzuki->class_catalog}} @endif">
                        <a class="box-catalog__link-box-catalog link-box-catalog"
                           href="{{route('catalog_site.index',$catalogSuzuki->url)}}">
                            <img alt="{{$catalogSuzuki->name}}"
                                 class="link-box-catalog__img-cover-catalog img-cover-catalog"
                                 src="{{Storage::url($catalogSuzuki->img)}}">
                            <div
                                class="link-box-catalog__brand-catalog brand-catalog @if(!empty($catalogSuzuki->class_catalog))brand-catalog-{{$catalogSuzuki->class_catalog}} @endif"></div>
                        </a>
                    </div>
                </div>
                <!--------------- END BOX CATALOG ------------------>
            </div>
            <div class="d-flex flex-row row-list-catalogs row-list-catalogs-bottom">


                <!--------------- BOX CATALOG ------------------>
                <div
                    class="row-list-catalogs__wrapper-box-catalog wrapper-box-catalog @if(!empty($catalogKawasaki->class_catalog))wrapper-box-catalog-{{$catalogKawasaki->class_catalog}}@endif">
                    <div
                        class="wrapper-box-catalog__box-catalog box-catalog @if(!empty($catalogKawasaki->class_catalog))box-catalog-{{$catalogKawasaki->class_catalog}} @endif">
                        <a class="box-catalog__link-box-catalog link-box-catalog"
                           href="{{route('catalog_site.index',$catalogKawasaki->url)}}">
                            <img alt="{{$catalogKawasaki->name}}"
                                 class="link-box-catalog__img-cover-catalog img-cover-catalog"
                                 src="{{Storage::url($catalogKawasaki->img)}}">
                            <div
                                class="link-box-catalog__brand-catalog brand-catalog @if(!empty($catalogKawasaki->class_catalog))brand-catalog-{{$catalogKawasaki->class_catalog}} @endif"></div>
                        </a>
                    </div>
                </div>
                <!--------------- END BOX CATALOG ------------------>


                <!--------------- BOX CATALOG ------------------>
                <div
                    class="row-list-catalogs__wrapper-box-catalog wrapper-box-catalog @if(!empty($catalogMhd->class_catalog))wrapper-box-catalog-{{$catalogMhd->class_catalog}}@endif">
                    <div
                        class="wrapper-box-catalog__box-catalog box-catalog @if(!empty($catalogMhd->class_catalog))box-catalog-{{$catalogMhd->class_catalog}} @endif">
                        <a class="box-catalog__link-box-catalog link-box-catalog"
                           href="{{route('catalog_site.index',$catalogMhd->url)}}">
                            <img alt="{{$catalogMhd->name}}"
                                 class="link-box-catalog__img-cover-catalog img-cover-catalog"
                                 src="{{Storage::url($catalogMhd->img)}}">
                            <div
                                class="link-box-catalog__brand-catalog brand-catalog @if(!empty($catalogMhd->class_catalog))brand-catalog-{{$catalogMhd->class_catalog}} @endif"></div>
                        </a>
                    </div>
                </div>
                <!--------------- END BOX CATALOG ------------------>


            </div>
            @break
        <!--------------------- КОНЕЦ КАТАЛОГ ЗАПЧАСТИ ОЕМ ------------------->



            <!--------------------- КАТАЛОГ ЗАПЧАСТИ Б/У ------------------->
            @case(3)
            @php
                $catalogYamaha = $catalogs->find(16);
                $catalogMhd = $catalogs->find(17);
                $catalogKawasaki = $catalogs->find(18);
                $catalogHonda = $catalogs->find(19);
                $catalogSuzuki = $catalogs->find(20);
                $catalogTriumph = $catalogs->find(21);
                $catalogDucati = $catalogs->find(22);
            @endphp
            <div class="d-flex flex-row row-list-catalogs row-list-catalogs-top">


                <!--------------- BOX CATALOG ------------------>
                <div
                    class="row-list-catalogs__wrapper-box-catalog wrapper-box-catalog @if(!empty($catalogYamaha->class_catalog))wrapper-box-catalog-{{$catalogYamaha->class_catalog}}@endif">
                    <div
                        class="wrapper-box-catalog__box-catalog box-catalog @if(!empty($catalogYamaha->class_catalog))box-catalog-{{$catalogYamaha->class_catalog}} @endif">
                        <a class="box-catalog__link-box-catalog link-box-catalog"
                           href="{{route('catalog_site.index',$catalogYamaha->url)}}">
                            <img alt="{{$catalogYamaha->name}}"
                                 class="link-box-catalog__img-cover-catalog img-cover-catalog"
                                 src="{{Storage::url($catalogYamaha->img)}}">
                            <div
                                class="link-box-catalog__brand-catalog brand-catalog @if(!empty($catalogYamaha->class_catalog))brand-catalog-{{$catalogYamaha->class_catalog}} @endif"></div>
                        </a>
                    </div>
                </div>
                <!--------------- END BOX CATALOG ------------------>


                <!--------------- BOX CATALOG ------------------>
                <div
                    class="row-list-catalogs__wrapper-box-catalog wrapper-box-catalog @if(!empty($catalogMhd->class_catalog))wrapper-box-catalog-{{$catalogMhd->class_catalog}}@endif">
                    <div
                        class="wrapper-box-catalog__box-catalog box-catalog @if(!empty($catalogMhd->class_catalog))box-catalog-{{$catalogMhd->class_catalog}} @endif">
                        <a class="box-catalog__link-box-catalog link-box-catalog"
                           href="{{route('catalog_site.index',$catalogMhd->url)}}">
                            <img alt="{{$catalogMhd->name}}"
                                 class="link-box-catalog__img-cover-catalog img-cover-catalog"
                                 src="{{Storage::url($catalogMhd->img)}}">
                            <div
                                class="link-box-catalog__brand-catalog brand-catalog @if(!empty($catalogMhd->class_catalog))brand-catalog-{{$catalogMhd->class_catalog}} @endif"></div>
                        </a>
                    </div>
                </div>
                <!--------------- END BOX CATALOG ------------------>
            </div>


            <div class="d-flex flex-row row-list-catalogs row-list-catalogs-middle">

                <!--------------- BOX CATALOG ------------------>
                <div
                    class="row-list-catalogs__wrapper-box-catalog wrapper-box-catalog @if(!empty($catalogKawasaki->class_catalog))wrapper-box-catalog-{{$catalogKawasaki->class_catalog}}@endif">
                    <div
                        class="wrapper-box-catalog__box-catalog box-catalog @if(!empty($catalogKawasaki->class_catalog))box-catalog-{{$catalogKawasaki->class_catalog}} @endif">
                        <a class="box-catalog__link-box-catalog link-box-catalog"
                           href="{{route('catalog_site.index',$catalogKawasaki->url)}}">
                            <img alt="{{$catalogKawasaki->name}}"
                                 class="link-box-catalog__img-cover-catalog img-cover-catalog"
                                 src="{{Storage::url($catalogKawasaki->img)}}">
                            <div
                                class="link-box-catalog__brand-catalog brand-catalog @if(!empty($catalogKawasaki->class_catalog))brand-catalog-{{$catalogKawasaki->class_catalog}} @endif"></div>
                        </a>
                    </div>
                </div>
                <!--------------- END BOX CATALOG ------------------>


                <!--------------- BOX CATALOG ------------------>
                <div
                    class="row-list-catalogs__wrapper-box-catalog wrapper-box-catalog @if(!empty($catalogHonda->class_catalog))wrapper-box-catalog-{{$catalogHonda->class_catalog}}@endif">
                    <div
                        class="wrapper-box-catalog__box-catalog box-catalog @if(!empty($catalogHonda->class_catalog))box-catalog-{{$catalogHonda->class_catalog}} @endif">
                        <a class="box-catalog__link-box-catalog link-box-catalog"
                           href="{{route('catalog_site.index',$catalogHonda->url)}}">
                            <img alt="{{$catalogHonda->name}}"
                                 class="link-box-catalog__img-cover-catalog img-cover-catalog"
                                 src="{{Storage::url($catalogHonda->img)}}">
                            <div
                                class="link-box-catalog__brand-catalog brand-catalog @if(!empty($catalogHonda->class_catalog))brand-catalog-{{$catalogHonda->class_catalog}} @endif"></div>
                        </a>
                    </div>
                </div>
                <!--------------- END BOX CATALOG ------------------>

                <!--------------- BOX CATALOG ------------------>
                <div
                    class="row-list-catalogs__wrapper-box-catalog wrapper-box-catalog @if(!empty($catalogSuzuki->class_catalog))wrapper-box-catalog-{{$catalogSuzuki->class_catalog}}@endif">
                    <div
                        class="wrapper-box-catalog__box-catalog box-catalog @if(!empty($catalogSuzuki->class_catalog))box-catalog-{{$catalogSuzuki->class_catalog}} @endif">
                        <a class="box-catalog__link-box-catalog link-box-catalog"
                           href="{{route('catalog_site.index',$catalogSuzuki->url)}}">
                            <img alt="{{$catalogSuzuki->name}}"
                                 class="link-box-catalog__img-cover-catalog img-cover-catalog"
                                 src="{{Storage::url($catalogSuzuki->img)}}">
                            <div
                                class="link-box-catalog__brand-catalog brand-catalog @if(!empty($catalogSuzuki->class_catalog))brand-catalog-{{$catalogSuzuki->class_catalog}} @endif"></div>
                        </a>
                    </div>
                </div>
                <!--------------- END BOX CATALOG ------------------>
            </div>

            <div class="d-flex flex-row row-list-catalogs row-list-catalogs-bottom">


                <!--------------- BOX CATALOG ------------------>
                <div
                    class="row-list-catalogs__wrapper-box-catalog wrapper-box-catalog @if(!empty($catalogTriumph->class_catalog))wrapper-box-catalog-{{$catalogTriumph->class_catalog}}@endif">
                    <div
                        class="wrapper-box-catalog__box-catalog box-catalog @if(!empty($catalogTriumph->class_catalog))box-catalog-{{$catalogTriumph->class_catalog}} @endif">
                        <a class="box-catalog__link-box-catalog link-box-catalog"
                           href="{{route('catalog_site.index',$catalogTriumph->url)}}">
                            <img alt="{{$catalogTriumph->name}}"
                                 class="link-box-catalog__img-cover-catalog img-cover-catalog"
                                 src="{{Storage::url($catalogTriumph->img)}}">
                            <div
                                class="link-box-catalog__brand-catalog brand-catalog @if(!empty($catalogTriumph->class_catalog))brand-catalog-{{$catalogTriumph->class_catalog}} @endif"></div>
                        </a>
                    </div>
                </div>
                <!--------------- END BOX CATALOG ------------------>


                <!--------------- BOX CATALOG ------------------>
                <div
                    class="row-list-catalogs__wrapper-box-catalog wrapper-box-catalog @if(!empty($catalogDucati->class_catalog))wrapper-box-catalog-{{$catalogDucati->class_catalog}}@endif">
                    <div
                        class="wrapper-box-catalog__box-catalog box-catalog @if(!empty($catalogDucati->class_catalog))box-catalog-{{$catalogDucati->class_catalog}} @endif">
                        <a class="box-catalog__link-box-catalog link-box-catalog"
                           href="{{route('catalog_site.index',$catalogDucati->url)}}">
                            <img alt="{{$catalogDucati->name}}"
                                 class="link-box-catalog__img-cover-catalog img-cover-catalog"
                                 src="{{Storage::url($catalogDucati->img)}}">
                            <div
                                class="link-box-catalog__brand-catalog brand-catalog @if(!empty($catalogDucati->class_catalog))brand-catalog-{{$catalogDucati->class_catalog}} @endif"></div>
                        </a>
                    </div>
                </div>
                <!--------------- END BOX CATALOG ------------------>


            </div>

            @break
        <!--------------------- КОНЕЦ КАТАЛОГ ЗАПЧАСТИ Б/У ------------------->




            <!--------------------- КАТАЛОГ МОТОХИМИЯ MOTUL ------------------->
            @case(4)


            @php
                $catalogMotul = $catalogs->find(23);
                $catalogMhd = $catalogs->find(24);
            @endphp




            <div class="d-flex flex-row row-list-catalogs row-list-catalogs-top">

                <!--------------- BOX CATALOG ------------------>
                <div
                    class="row-list-catalogs__wrapper-box-catalog wrapper-box-catalog @if(!empty($catalogMotul->class_catalog))wrapper-box-catalog-{{$catalogMotul->class_catalog}}@endif">
                    <div
                        class="wrapper-box-catalog__box-catalog box-catalog @if(!empty($catalogMotul->class_catalog))box-catalog-{{$catalogMotul->class_catalog}} @endif">
                        <a class="box-catalog__link-box-catalog link-box-catalog"
                           href="{{route('catalog_site.index',$catalogMotul->url)}}">
                            <img alt="{{$catalogMotul->name}}"
                                 class="link-box-catalog__img-cover-catalog img-cover-catalog"
                                 src="{{Storage::url($catalogMotul->img)}}">
                            <div
                                class="link-box-catalog__brand-catalog brand-catalog @if(!empty($catalogMotul->class_catalog))brand-catalog-{{$catalogMotul->class_catalog}} @endif"></div>
                        </a>
                    </div>
                </div>
                <!--------------- END BOX CATALOG ------------------>


                <!--------------- BOX CATALOG ------------------>
                <div
                    class="row-list-catalogs__wrapper-box-catalog wrapper-box-catalog @if(!empty($catalogMhd->class_catalog))wrapper-box-catalog-{{$catalogMhd->class_catalog}}@endif">
                    <div
                        class="wrapper-box-catalog__box-catalog box-catalog @if(!empty($catalogMhd->class_catalog))box-catalog-{{$catalogMhd->class_catalog}} @endif">
                        <a class="box-catalog__link-box-catalog link-box-catalog"
                           href="{{route('catalog_site.index',$catalogMhd->url)}}">
                            <img alt="{{$catalogMhd->name}}"
                                 class="link-box-catalog__img-cover-catalog img-cover-catalog"
                                 src="{{Storage::url($catalogMhd->img)}}">
                            <div
                                class="link-box-catalog__brand-catalog brand-catalog @if(!empty($catalogMhd->class_catalog))brand-catalog-{{$catalogMhd->class_catalog}} @endif"></div>
                        </a>
                    </div>
                </div>
                <!--------------- END BOX CATALOG ------------------>


            </div>
        @break
        <!--------------------- КОНЕЦ КАТАЛОГ МОТОХИМИЯ MOTUL ------------------->


            @default


        @endswitch




    @else
        <p class="block-view-catalog__empty-catalog empty-catalog">Ничего не найдено</p>
    @endif


</div>
<!------------ End List Catalogs ---------------->
