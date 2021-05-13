<div id="block-company" class="block-company">

    <div class="container">

        <div class="block-company__header-block-company header-block-company">
            <h2>
                О нас
            </h2>
        </div>


        <div class="row block-company__block-description-company block-description-company">


            <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 col-12">
                <div class="block-description-company__leftblock-video leftblock-video">

                    <iframe width="645" height="403" src="https://www.youtube.com/embed/YSroTpdLO_I?feature=oembed"
                            frameborder="0"
                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen=""></iframe>

                </div>
            </div>


            <!--------------------- TEXT COMPANY ----------------->
            <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12">
                <div class="block-description-company__rightblock-text-company rightblock-text-company">

                    <div class="rightblock-text-company__header-text-company header-text-company">
                        <h3>
                            @isset($page)
                                {!!$page->name!!}
                            @endisset
                        </h3>
                    </div>

                    <div class="rightblock-text-company__text-company text-company">
                        @isset($page)
                            {!!$page->description!!}
                        @endisset
                    </div>
                </div>
            </div>
            <!--------------------- END TEXT COMPANY ----------------->


        </div>


    </div>


</div>
