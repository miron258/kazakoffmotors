<!doctype html>
<html lang="{{ str_replace('_', '-', app()-> getLocale()) }}">
@include('layouts.preheader')
<body>
<div id="app">
    @include('layouts.header', ['headerMini' => false,  'headerShop' => false,  'classHeader'=> 'header-main', 'viewHeader'=> true])
    @include('layouts.block-services')
    @yield('content')
    @include('layouts.block-harley-davidson')
    @include('layouts.block-our-work')
    @include('layouts.block-catalogs')
    @include('layouts.block-motoschool')
    @include('layouts.footer')
</div>
</body>
</html>
