@foreach($items as $item)
    <!--Добавляем класс active для активного пункта меню-->
    @php
        $classItem = (!empty($classMenu))? "item-".$classMenu: 'item';
        $isActive = ($item->isActive)? ' active ':'';
        $active = ($item->active)? ' active ':'';
        $index = 1;
    @endphp


    <li class="{{$classItem}}{{ $isActive }}{{ $active }} @if($item->hasChildren()) dropdown @endif">
        <!-- метод url() получает ссылку на пункт меню (указана вторым параметром
        при создании объекта LavMenu)-->

    @php $classLink = (!empty($classMenu))? "link-item-".$classMenu: 'link-item';  @endphp
    @php $classLink2 = (!empty($item->class))? "link-class-".$item->class():''; @endphp

    <!---Если есть потомки показываем span если нет просто ссылку  --->
        @if($item->hasChildren())
            <div class="wrapper-link">
                <a href="{{ $item->url() }}" v-if="$root.isMobile()" class="{{$classLink}}">{{ $item->title }}

                </a>
                <button v-if="$root.isMobile()" class="arrow-menu-catalog collapsed"
                      aria-controls="catalog-dropdown{{$loop->index+1}}" aria-expanded="false"
                      aria-label="Toggle navigation" data-target="#catalog-dropdown{{$loop->index+1}}"
                      data-display="static" data-toggle="collapse"></button>
            </div>
            <a v-if="!$root.isMobile()" href="{{ $item->url() }}"
               class="{{$classLink}} dropdown-toggle">{{ $item->title }}</a>
        @else
            <a class="{{$classLink}}" href="{{ $item->url() }}">{{ $item->title }}</a>
        @endif


    <!--Формируем дочерние пункты меню
        метод haschildren() проверяет наличие дочерних пунктов меню-->


        @if($item->hasChildren())



        <!--метод children() возвращает дочерние пункты меню для текущего пункта-->

            @if ($megaMenu)
                <ul id="catalog-dropdown{{$loop->index+1}}" class="sub-menu dropdown-menu mega-menu">
                    <li class="mega-menu-column">
                        <ul class="list-items-column-menu">
                            @include('custom-menu.custom-menu-items', ['items'=>$item->children()])
                        </ul>
                    </li>
                </ul>
            @else

                <ul class="sub-menu">
                    @include('custom-menu.custom-menu-items', ['items'=>$item->children()])
                </ul>
            @endif

        @endif
    </li>
@endforeach
