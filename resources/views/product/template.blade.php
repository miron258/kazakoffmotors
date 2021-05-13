<html lang="{{ str_replace('_', '-', app() -> getLocale())}}">
@include('layouts.preheader')
<body>
<div id="app">
    @includeIf('layouts.header', ['headerMini' => true, 'headerShop' => true, 'viewHeader'=> false, 'classHeader'=> 'header-catalog'])
    <div class="wrapper-inner-product">
        @includeIf('layouts.breadcrumbs', ['name'=> 'product', 'object'=> $product])
        @yield('content')
    </div>
    @include('layouts.footer')
</div>
</body>

</html>
