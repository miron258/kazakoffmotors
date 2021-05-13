@extends('search.template')
@isset($search)
    @section('meta_tag_title',  'Результаты поиска')
@section('meta_tag_description', 'Результаты поиска')
@section('meta_tag_keywords', 'Результаты поиска')
@endisset

@section('content')
    <div class='block-view-search'>
        <div class='container'>


            <h1 class='block-view-search__title-view-search title-view-search'>
                Результаты поиска: @isset($query)<span class="word-search">{{$query}}</span>@endisset
            </h1>


            <div class='block-view-search__searching-results searching-results'>
                @if(isset($products) && !empty($products))


                    @if(!empty($products))
                        <products :is-container=false :columns=4 class-wrapper="block-list-products-search"  :products='@json($products->items())'>
                            <template slot="paginate">
                                {{ $products->links('vendor.pagination.bootstrap-4') }}
                            </template>
                        </products>
                    @endif


                @else
                    <p class="searching-results__searching-results-empty searching-results-empty">Ничего не найдено</p>
                @endif
            </div>

        </div>
    </div>
@endsection
@push('styles')
    <link href="{{ asset('css/search.css') }}" rel="stylesheet">
@endpush
