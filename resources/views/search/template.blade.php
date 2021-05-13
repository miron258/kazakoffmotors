<html lang="{{ str_replace('_', '-', app() -> getLocale())}}">
@include('layouts.preheader')
<body>
<div id="app">
    @includeIf('layouts.header', ['headerMini' => true, 'headerShop' => true, 'viewHeader'=> false, 'classHeader'=> 'header-catalog'])
    <div class="wrapper-inner-search">
        @includeIf('layouts.breadcrumbs', ['name'=> 'search', 'object'=> $search])
        @yield('content')
    </div>
    @include('layouts.footer')
</div>
</body>

</html>
