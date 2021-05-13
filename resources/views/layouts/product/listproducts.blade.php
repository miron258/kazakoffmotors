@if(isset($products) && !empty($products))
<div class="block-list-products @isset($classWrapper) {{$classWrapper}} @endisset">
    <div class="container">
        <div class="row">


            <div class="block-list-product__header-block-list-products header-block-list-products">
                @if($h1)
                <h1>{{$header}}</h1>
                @else
                <h3>{{$header}}</h3>
                @endif
            </div>

            <div class="block-list-products__list-products list-products">

                <div class="row list-products__list-products-row list-products-row">


                    @foreach($products as $key=>$product)     
                    <!----------- COL PRODUCT -------------->
                    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-3 col-6">
                        <!--------------- BOX PRODUCT ------------------->
                        <div class="list-products__box-product box-product box-product-{{$key+1}}">

                            <!----- Img Product ------>
                            <div class="box-product__block-img-product block-img-product">
                                <a class="block-img-product__link-product link-product" href="{{route('product_site.index', $product->url)}}">
                                    @if (!empty($product->img))
                                    @foreach(json_decode($product->img) as $k=>$image)
                                    @if($k<1)
                                    <img class="link-product__img-link-product d-block img-link-product img-fluid" alt="{{$product->name}}" src="{{Storage::url($image)}}">
                                    @endif
                                    @endforeach
                                    @endif
                                </a>
                            </div>
                            <!----- End Img Product ------>

                            <!----- Name Product ------>
                            <div class="box-product__name-product name-product">
                                {{$product->name}}
                            </div>
                            <!----- End Name Product ------>
                        </div>
                        <!--------------- END BOX PRODUCT ------------------->
                    </div>
                    <!----------- END COL PRODUCT -------------->
                    @endforeach     


                </div>





                @if(isset($pagination) && $pagination)

                <div class='list-products__pagination-list-products pagination-list-products'>
                    {{$products->links()}}
                </div>

                @endif


            </div>



        </div>
    </div>
</div>
@endif