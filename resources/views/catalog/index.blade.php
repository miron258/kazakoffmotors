@extends('catalog.template')
@isset($catalog)
    @section('meta_tag_title',  $catalog->meta_tag_title)
@section('meta_tag_description', $catalog->meta_tag_description)
@section('meta_tag_keywords', $catalog->meta_tag_keywords)
@endisset

@section('content')
    <div class="block-view-catalog @if(!empty($catalog->class_catalog))block-view-catalog-{{$catalog -> class_catalog}}@endif">
        <div class='container'>

            <div class="block-view-catalog__header-block-view-catalog header-block-view-catalog">
                <h1>
                    {!! $catalog -> name !!}
                </h1>
            </div>

            @isset($catalogs)
                @includeIf('catalog.layouts.list_catalogs',
[
        'class_catalog'=> $catalog->class_catalog,
        'catalogs'=> $catalogs, 'catalog'=> $catalog])
            @endisset

            @isset($products)
                @includeIf('catalog.layouts.list_products',
    [
        'class_catalog'=> $catalog->class_catalog,
        'products'=>$products, 'catalog'=> $catalog])
            @endisset


            @if($catalog->id == 6)
                @includeIf('catalog.layouts.block_spare_parts_order')
                @includeIf('catalog.layouts.block_delivery')
            @endif


            <div
                class="block-view-catalog__description-catalog description-catalog @if(!empty($catalog->class_catalog))description-catalog-{{$catalog -> class_catalog}}@endif">
                {!!$catalog -> description!!}
            </div>


        </div>


        @isset($products)
            <products class-wrapper="block-list-products-in-catalog @if(!empty($catalog->class_catalog))block-list-products-in-catalog-{{$catalog -> class_catalog}}@endif" :rows=true :columns=4 :products='@json($products->items())'>
                <template slot="paginate">
                    {{ $products->links('vendor.pagination.bootstrap-4') }}
                </template>
            </products>
        @endisset


        @if(!empty($catalog->html))
            <div class="block-view-catalog__html-catalog html-catalog html-catalog-{{$catalog -> class_catalog}}">
                {!!$catalogHtml!!}
            </div>
        @endif


    </div>
@endsection
@push('styles')
    <link href="{{ asset('css/catalog.css') }}" rel="stylesheet">
@endpush
