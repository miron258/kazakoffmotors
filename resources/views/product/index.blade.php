@extends('product.template')
@isset($product)
    @section('meta_tag_title',  $product->meta_tag_title)
@section('meta_tag_description', $product->meta_tag_description)
@section('meta_tag_keywords', $product->meta_tag_keywords)
@endisset

@section('content')
    <div class="block-product">


        <div
            class="container d-xl-block d-lg-block d-md-block d-sm-block d-none  block-product__container-view-product container-view-product">
            <div class="row">
                @includeIf('product.layouts.product_slider')
                @includeIf('product.layouts.product_properties')
            </div>

            <div class="block-product__product-description product-description">

                <div class="product-description__block-description block-description">
                    <div class="block-description__wrapper-title-block-description wrapper-title-block-description">
                        <h2 class="wrapper-title-block-description__title-block-description title-block-description">
                            описание</h2>
                        <a class="wrapper-title-block-description__link-toggle-description link-toggle-description"
                           href=""></a>
                    </div>
                    <div class="block-description__text-product text-product">
                        {!! $product->description !!}
                    </div>
                </div>


                @if(!empty($product->compatibility))
                    <div class="product-description__block-compatibility block-compatibility">
                        <div
                            class="block-description__wrapper-title-block-compatibility wrapper-title-block-compatibility">
                            <h2 class="block-compatibility__title-block-compatibility title-block-compatibility">
                                совместимость</h2>
                            <a class="wrapper-title-block-description__link-toggle-compatibility link-toggle-compatibility"
                               href=""></a>
                        </div>
                        <div class="block-compatibility__text-compatibility text-compatibility">
                            {!! $product->compatibility !!}
                        </div>
                    </div>
                @endif

                @if(!empty($product->equipment))
                    <div class="product-description__block-features block-features">
                        <div class="block-description__wrapper-title-block-features wrapper-title-block-features">
                            <h2 class="block-features__title-block-features title-block-features">особенности</h2>
                            <a class="wrapper-title-block-description__link-toggle-features link-toggle-features"
                               href=""></a>
                        </div>
                        <div class="block-features__text-features text-features">
                            {!! $product->equipment !!}
                        </div>
                    </div>
                @endif

            </div>

        </div>


        <div
            class="container d-xl-none d-lg-none d-md-none d-sm-none d-block block-product__container-view-product-mobile container-view-product-mobile">
            <product-mobile v-if="$root.isMobile()" :arrows=true :product-data='@json($product)' :is-cart='{{json_encode($product->is_cart)}}'
                            ref="product"
                            ></product-mobile>

        </div>

    </div>


@endsection
@push('styles')
    <link href="{{ asset('css/product.css') }}" rel="stylesheet">
@endpush

