@if($menu)
    <ul id="nav-{{$classMenu}}" class="{{$classMenu}}">
        <!--$menu->roots() - получаем только родительские элементы меню-->
        @php $megaMenu = (isset($megaMenu))? $megaMenu: ""; @endphp
        @include('custom-menu.custom-menu-items', ['items'=>$menu->roots(), 'classMenu'=> $classMenu, 'megaMenu' => $megaMenu])
    </ul>
@endif
