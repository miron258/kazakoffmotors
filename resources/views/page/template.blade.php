<!doctype html>
<html lang="{{ str_replace('_', '-', app() -> getLocale())}}">
@include('layouts.preheader')
<body>
<div id="app">
    @include('layouts.header', ['headerMini' => true, 'headerShop' => false, 'viewHeader'=> false,  'classHeader'=> 'header-page'])
    <div class="wrapper-inner-page">
        @include('layouts.breadcrumbs', ['name'=> 'page', 'object'=> $page])
        @yield('content')
    </div>
    @include('layouts.footer')
</div>
</body>

</html>
