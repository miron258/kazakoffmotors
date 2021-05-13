@component('mail::layout')
{{-- Header --}}
@slot('header')
@component('mail::header', ['url' => config('app.url')])
@endcomponent
@endslot

{{-- Body --}}
{{ $slot }}

{{-- Orders --}}
@slot('orders')
@component('mail::orders', ['title' => 'Вы заказывали'])
@endcomponent
@endslot

{{-- Subcopy --}}
@isset($subcopy)
@slot('subcopy')
@component('mail::subcopy')
{{ $subcopy }}
@endcomponent
@endslot
@endisset

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
© {{ date('Y') }} {{ config('app.name') }}. @lang('Все права защищены.')
@endcomponent
@endslot
@endcomponent
