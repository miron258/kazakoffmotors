<!doctype html>
<html lang="{{ str_replace('_', '-', app() -> getLocale())}}">
@include('layouts.preheader')
<body>
<div id="app">
    @includeIf('layouts.header', ['headerMini' => true, 'headerShop' => true, 'viewHeader'=> false, 'classHeader'=> 'header-catalog'])
    <div class="wrapper-inner-catalog">
        @includeIf('layouts.breadcrumbs', ['name'=> 'catalog', 'object'=> $catalog])
        @yield('content')
    </div>
    @include('layouts.footer')
</div>
</body>

</html>
