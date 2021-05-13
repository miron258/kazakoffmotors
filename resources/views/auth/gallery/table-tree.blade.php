<tr>
    <td>{{$item->id}}</td>
    <td>
        {{ PHP_EOL . $prefix . ' ' . $item->name }}
    </td>
    <td>{{$item->header}}</td>
{{--    <td><a target="_blank" href="{{ route('gallery_site.index', $item->url) }}">Перейти на страницу галереи</a></td>--}}
    <td>
        {{$item->class}}
    </td>
    <td>
        @if($item->is_main_page)
            <i class="far fa-eye"></i>
        @else
            <i class="far fa-eye-slash"></i>
        @endif
    </td>
    <td>
        @if(!$item->parent_id)
            Родительская нельзя загружать фото
        @else

            @if(isset($item->images) && count($item->images)>0)
                @php $path = Storage::url($item->path."/thumbs/".$item->images[0]['name']); @endphp
                <div>Ecть  фото</div> <img style="width: 100px;" class="img-fluid" alt="{{$item->images[0]['alt']}}"
                              src="{{$path}}">
            @else
                Фото еще не добавлено
            @endif
        @endif
    </td>

    <td>
        @if($item->hidden)
            <i class="far fa-eye"></i>
        @else
            <i class="far fa-eye-slash"></i>
        @endif
    </td>
    <td>{{ $item->created_at }}</td>
    <td>
        <a class="btn btn-primary btn-sm" href="{{route('gallery.edit', $item->id)}}"> <i class="far fa-edit mr-2"></i>Редактировать</a>
    </td>
    <td>
        <form action='{{route('gallery.destroy', $item->id)}}' method='POST'>
            @csrf
            @method('DELETE')
            <button type='submit' class="btn btn-danger btn-sm"><i class="fas fa-trash mr-2"></i>Удалить</button>
        </form>
    </td>
</tr>
