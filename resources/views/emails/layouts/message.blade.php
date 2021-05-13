@component('emails.layouts.template')

    {{-- Header --}}
    @slot('header')
        @component('emails.layouts.header', ['url' => config('app.url')])
        @endcomponent
    @endslot


    {{-- Message --}}
    @slot('message')
        {{$slot}}
    @endslot


    {{-- Orders --}}
    @isset($orders)
        @slot('orders')
            {{$orders}}
        @endslot
    @endisset

    {{-- Footer --}}
    @slot('footer')
        @component('emails.layouts.footer', ['url' => config('app.url')])
        @endcomponent
    @endslot
@endcomponent
















