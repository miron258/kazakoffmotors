@extends('auth.layouts.app')
@isset($gallery)
    @section('title', 'Редактировать галерею '. $gallery->name)
@else
    @section('title', 'Создать галерею')
@endisset

@section('content')
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script type="module" src="{{ mix('js/admin/vue/appComponents.js') }}" defer></script>
    <div id="app-vue" @isset($gallery) @endisset class="container-fluid">

        <div class="row-fluid justify-content-center">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        @yield('title')
                        @isset($gallery)
                            <a class="btn btn-primary btn-sm float-right" href="{{route('gallery.create')}}"><i
                                    class="far fa-plus-square mr-2"></i>Создать галерею</a>
                        @endisset
                    </div>


                    <div class="card-body">
                        @isset($gallery)
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="content-tab" data-toggle="tab" href="#content"
                                       role="tab" aria-controls="content-tab" aria-selected="true">Контент</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="images-tab" data-toggle="tab" href="#images" role="tab"
                                       aria-controls="images-tab" aria-selected="false">Изображения</a>
                                </li>
                            </ul>
                        @endisset


                        @if(session()->has('message'))
                            <div class="alert alert-success mt-3">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                {{ session() -> get('message')}}

                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger mt-3">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error}}</li>
                                    @endforeach
                                </ul>

                            </div>
                        @endif

                        <form
                            @isset($gallery)
                            action="{{ route('gallery.update', $gallery)}}"
                            @else
                            action="{{ route('gallery.store')}}"
                            @endisset


                            method="POST" enctype='multipart/form-data'>
                            @csrf


                            <div class="tab-content mt-4" id="myTabContent">


                            @isset($gallery)
                                <!--------------------- TAB IMAGES ------------------------->
                                    <div class="tab-pane fade" id="images" role="tabpanel" aria-labelledby="images-tab">

                                        @if($gallery->parent_id)
                                        <gallery name-gallery="{{$gallery->name}}"
                                                 :id-gallery="{{$gallery->id}}"></gallery>
                                            @else
                                            <p>Нельзя загружать фото в <b>Родительскую категория</b>, используйте дочернию</p>
                                        @endif
                                    </div>
                                    <!--------------------- END TAB IMAGES ------------------------->
                            @endisset


                            <!------------- TAB CONTENT ----------------->
                                <div class="tab-pane fade show active" id="content" role="tabpanel"
                                     aria-labelledby="content-tab">

                                    @isset($gallery)
                                        @method('PUT')
                                        <input id="galleryId" type='hidden' name='galleryId' value='{{$gallery -> id}}'>
                                    @endisset


                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">Название <span class="required">*</span></label>
                                                <input name="name" type="text"
                                                       class="form-control @error('name') is-invalid @enderror"
                                                       value='{{old('name', isset($gallery)? $gallery -> name: null)}}'
                                                       placeholder="Название">
                                            </div>
                                        </div>


                                        <div class='col'>

                                            <div class='form-group'>
                                                <label>Родительская галерея</label>
                                                <select class='form-control' name='parent_id'>
                                                    <option value=''>Корневая галерея</option>
                                                    @if (isset($gallery))
                                                        @php
                                                            buildTreeSelectOptions($galleries,$gallery);
                                                        @endphp
                                                    @else
                                                        @php
                                                            buildTreeSelectOptions($galleries);
                                                        @endphp
                                                    @endif
                                                </select>
                                            </div>

                                        </div>


                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">Заголовок в описании <span
                                                        class="required">*</span></label>
                                                <input name="header" type="text"
                                                       class="form-control @error('header') is-invalid @enderror"
                                                       value='{{old('header', isset($gallery)? $gallery -> header: null)}}'
                                                       placeholder="Заголовок">
                                            </div>
                                        </div>


                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">Класс Галереи </label>
                                                <input name="class" type="text"
                                                       class="form-control @error('class') is-invalid @enderror"
                                                       value='{{old('class', isset($gallery)? $gallery -> class: null)}}'
                                                       placeholder="Класс галереи">
                                            </div>
                                        </div>

                                    </div>


                                    <div class="row">


                                        <div class="col-xl-12">
                                            <div class="form-group">
                                                <label for="">Описание</label>
                                                <textarea
                                                    value="{{old('description', isset($gallery)? $gallery -> description: null)}}"
                                                    is="tiny-mce" rows='12'
                                                    name="description"></textarea>
                                            </div>
                                        </div>


                                    </div>


                                    @isset($gallery)
                                        <div class="row">
                                            @foreach(
                                            [
                                            'hidden' => 'Показать/Скрыть галерею',
                                            'is_main_page' => 'Выводить на главной' ] as $field=>$title
                                            )
                                                <div class="col-xl-3">

                                                    <div class="form-check">
                                                        <input
                                                            @if(isset($gallery) && $gallery->$field == 1 || old($field) == 'on')
                                                            checked=checked
                                                            @endif
                                                            @if($field == 'is_main_page')
                                                                @if($gallery->is_main && !$gallery->is_main_page)
                                                                disabled
                                                                @endif
                                                              @endif
                                                            type="checkbox" name="{{$field}}" id="{{$field}}"
                                                            class="form-check-input">
                                                        <label class="form-check-label">{{$title}}</label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endisset


                                </div>
                                <!------------- END TAB CONTENT ----------------->


                            </div>


                            <div class="row mt-3">
                                <div class="col-xl-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-2"></i>Сохранить
                                        </button>
                                        <button type="reset" class="btn btn-primary">Сбросить</button>
                                    </div>
                                </div>
                            </div>


                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>

    @isset($gallery)

    @endisset




@endsection

