@extends('auth.layouts.app')


@isset($product)
    @section('title', 'Редактировать продукт '. $product->name)
@else
    @section('title', 'Создать продукт')
@endisset

@section('content')
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script type="module" src="{{ mix('js/admin/vue/appComponents.js') }}" defer></script>
    <div id="app-vue" class="container-fluid">

        <div class="row-fluid justify-content-center">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        @yield('title')
                        @isset($product)
                            <a target="_blank" class="btn btn-success btn-sm mr-5"
                               href="{{route('product_site.index', $product->url)}}"><i class="fas fa-eye mr-2"></i>Просмотреть
                                продукт</a>
                            <a class="btn btn-primary btn-sm float-right" href="{{route('product.create')}}"><i
                                    class="far fa-plus-square mr-2"></i>Создать продукт</a>
                        @endisset
                    </div>


                    <div class="card-body">


                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="content-tab" data-toggle="tab" href="#content" role="tab"
                                   aria-controls="content-tab" aria-selected="true">Контент</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="images-tab" data-toggle="tab" href="#images" role="tab"
                                   aria-controls="images-tab" aria-selected="false">Изображения</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="video-tab" data-toggle="tab" href="#video" role="tab"
                                   aria-controls="video-tab" aria-selected="false">Видео</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="fields-tab" data-toggle="tab" href="#fields" role="tab"
                                   aria-controls="fields-tab" aria-selected="false">Дополнительные поля</a>
                            </li>
                        </ul>


                        @if(session()->has('message'))
                            <div class="alert alert-success mt-3">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                {{ session()->get('message') }}

                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger mt-3">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>

                            </div>
                        @endif

                        <form
                            @isset($product)
                            action="{{ route('product.update', $product) }}"
                            @else
                            action="{{ route('product.store') }}"
                            @endisset

                            method="POST" enctype='multipart/form-data'>
                            @csrf

                            <div class="tab-content mt-4" id="myTabContent">


                                <div class="tab-pane fade" id="images" role="tabpanel" aria-labelledby="images-tab">
                                    @if(!empty($productImages))
                                        <div class="row">
                                            @foreach ($productImages as $k=>$image)
                                                <div class="col">
                                                    <img style="width:250px;" class="img-rounded img-fluid"
                                                         alt="{{$product->name}}"
                                                         src="{{Storage::url("products/thumbs/".$image->name)}}">
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                    <div class="w-100">
                                        <label>Выберите изображение</label>
                                        <input type="file" name="images[]" id="images" multiple class="form-control">
                                    </div>
                                </div>


                                <!------------------------- TAB FIELDS ----------------------------->
                                <div class="tab-pane fade" id="fields" role="tabpanel" aria-labelledby="fields-tab">
                                    <div class="row">
                                        <div class='col-xl-12'>
                                            <div class='form-group'>
                                                <label>Свойства</label>
                                                <textarea
                                                    value="{{old('properties', isset($product)? $product->properties: '')}}"
                                                    is="tiny-mce" rows='10'
                                                    name="properties"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class='col-xl-12'>
                                            <div class='form-group'>
                                                <label>Совместимость</label>
                                                <textarea
                                                    value="{{old('compatibility', isset($product)? $product->compatibility: '')}}"
                                                    is="tiny-mce" rows='10'
                                                    name="compatibility"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class='col-xl-12'>
                                            <div class='form-group'>
                                                <label>Особенности</label>
                                                <textarea
                                                    value="{{old('equipment', isset($product)? $product->equipment: '')}}"
                                                    is="tiny-mce" rows='10'
                                                    name="equipment"></textarea>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <!------------------------- END TAB FIELDS ----------------------------->


                                <!------------------------- TAB VIDEO ----------------------------->
                                <div class="tab-pane fade" id="video" role="tabpanel" aria-labelledby="video-tab">
                                    <div class="row">
                                        <div class='col-xl-12'>
                                            <div class='form-group'>
                                                <label>Видео</label>
                                                <textarea
                                                    value="{{old('video', isset($product)? $product->video: '')}}"
                                                    is="tiny-mce" rows='20'
                                                    name="video"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!------------------------- END TAB VIDEO ----------------------------->


                                <!------------- TAB CONTENT ----------------->
                                <div class="tab-pane fade show active" id="content" role="tabpanel"
                                     aria-labelledby="content-tab">

                                    <div class="row">
                                        @isset($product)
                                            @method('PUT')
                                            <input type='hidden' name='productId' value='{{$product->id}}'>
                                        @endisset
                                        <div class="col-xl-4">
                                            <div class="form-group">
                                                <label for="">Meta title <span class="required">*</span></label>
                                                <input
                                                    class="form-control @error('meta_tag_title') is-invalid @enderror"
                                                    type="text"
                                                    value='{{old('meta_tag_title', isset($product)? $product->meta_tag_title: null)}}'
                                                    name="meta_tag_title">
                                            </div>
                                        </div>


                                        <div class="col-xl-4">
                                            <div class="form-group">
                                                <label for="">Meta description</label>
                                                <input class="form-control" type="text"
                                                       value='{{old('meta_tag_description', isset($product)? $product->meta_tag_description: null)}}'
                                                       name="meta_tag_description">
                                            </div>
                                        </div>

                                        <div class="col-xl-4">
                                            <div class="form-group">
                                                <label for="">Meta Keywords</label>
                                                <input class="form-control" type="text"
                                                       value='{{old('meta_tag_keywords', isset($product)? $product->meta_tag_keywords: null)}}'
                                                       name="meta_tag_keywords">
                                            </div>
                                        </div>

                                    </div>


                                    <div class="row">
                                        <div class="col-xl-3">
                                            <div class="form-group">
                                                <label for="">Название <span class="required">*</span></label>
                                                <input ref="productName" id="name" name="name" :type="text"
                                                       class="form-control @error('name') is-invalid @enderror"
                                                       value='{{old('name', isset($product)? $product->name: null)}}'
                                                       placeholder="Название">
                                            </div>
                                        </div>



                                        @isset($product)
                                            <div class="col-xl-2">
                                                <div class="form-group">
                                                    <label for="">URL адрес <span class="required">*</span></label>
                                                    <input value='{{old('url', isset($product)? $product->url: '')}}'
                                                           placeholder="Url адрес" is="transliterate" name="url"
                                                           class-error="@error('url') is-invalid @enderror">
                                                </div>
                                            </div>
                                        @endisset

                                        <div class="col-xl-2">
                                            <div class="form-group">
                                                <label for="">Количество</label>
                                                <input name="count_stock" type="text"
                                                       class="form-control @error('count_stock') is-invalid @enderror"
                                                       value='{{old('count_stock', isset($product)? $product->count_stock: null)}}'
                                                       placeholder="Количество">
                                            </div>
                                        </div>


                                        <div class="col-xl-2">
                                            <div class="form-group">
                                                <label for="">Позиция</label>
                                                <input name="position" type="number"
                                                       class="form-control @error('position') is-invalid @enderror"
                                                       value='{{old('position', isset($product)? $product->position: 0)}}'
                                                       placeholder="Позиция">
                                            </div>
                                        </div>


                                        <div class='@if(isset($product)) col-xl-3 @else col-xl-5 @endif'>

                                            <div class='form-group'>
                                                <label>Выберите каталог</label>
                                                <select class='form-control' name='id_catalog'>
                                                    @if (isset($product))
                                                        @php
                                                            buildTreeSelectOptions($catalogs,$product,'update');
                                                        @endphp
                                                    @else
                                                        @php
                                                            buildTreeSelectOptions($catalogs);
                                                        @endphp
                                                    @endif
                                                </select>
                                            </div>

                                        </div>

                                    </div>


                                    <div class="row">
                                        <div class="col-xl-3">
                                            <div class="form-group">
                                                <label for="">Цена <span class="required">*</span></label>
                                                <input id="price" name="price" type="number" step="any"
                                                       class="form-control @error('price') is-invalid @enderror"
                                                       value='{{old('price', isset($product)? $product->price: null)}}'
                                                       placeholder="Цена">
                                            </div>
                                        </div>
                                        <div class="col-xl-3">

                                            <currency-converter
                                                :price-usd="{{old('price_usd', isset($product)? $product->price_usd: 0)}}">
                                            </currency-converter>

                                        </div>


                                        <div class="col-xl-2">
                                            <div class="form-group">
                                                <label for="">Проценты</label>
                                                <input id="wrapping"
                                                    class="form-control"
                                                    type="text"
                                                    value="{{old('wrapping', (isset($product->wrapping)))?
$product->wrapping: $settings->wrapping}}"
                                                    name="wrapping">
                                            </div>
                                        </div>


                                        {{--                                    <div class="col-xl-4">--}}
                                        {{--                                        <div class="form-group">--}}
                                        {{--                                            <label for="">Старая цена</label>--}}
                                        {{--                                            <input name="old_price" type="number" step="any"--}}
                                        {{--                                                   class="form-control @error('old_price') is-invalid @enderror"--}}
                                        {{--                                                   value='{{old('old_price', isset($product)? $product->old_price: null)}}'--}}
                                        {{--                                                   placeholder="Старая цена">--}}
                                        {{--                                        </div>--}}
                                        {{--                                    </div>--}}

                                        <div class="col-xl-4">
                                            <div class="form-group">
                                                <label for="">Артикул <span class="required">*</span></label>
                                                <input name="art" type="text"
                                                       class="form-control @error('art') is-invalid @enderror"
                                                       value='{{old('art', isset($product)? $product->art: null)}}'
                                                       placeholder="Артикул">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        {{--                                    <div class="col-xl-12">--}}
                                        {{--                                        <div class="form-group">--}}
                                        {{--                                            <label for="">Анонс</label>--}}
                                        {{--                                            <textarea class="form-control editor"--}}
                                        {{--                                                      name="anons">{{old('anons', isset($product)? $product->anons: null)}}</textarea>--}}
                                        {{--                                        </div>--}}

                                        {{--                                    </div>--}}


                                        <div class="col-xl-12">
                                            <div class="form-group">
                                                <label for="">Описание <span class="required">*</span></label>
                                                <textarea
                                                    value="{{old('description', isset($product)? $product->description: null)}}"
                                                    is="tiny-mce" rows='12'
                                                    name="description"></textarea>
                                            </div>
                                        </div>


                                    </div>


                                    <div class="row">
                                        @foreach(
                                        $arrayCheckbox as $field=>$title)
                                            <div class="col-xl-2">
                                                <div class="form-check">
                                                    <input
                                                        @if(isset($product) && $product->$field == 1 || old($field) == 'on')
                                                        checked=checked
                                                        @endif
                                                        type="checkbox" name="{{$field}}" id="{{$field}}"
                                                        class="form-check-input">
                                                    <label class="form-check-label">{{$title}}</label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
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

    <script src="{{ mix("js/admin/bundle.js") }}"></script>
    {{--    <script type='text/javascript'>--}}

    {{--        //Cyrillic To translite--}}
    {{--        var inputTitle = $('input[name=name]');--}}
    {{--        var inputUrl = $('input[name=url]');--}}

    {{--        inputTitle.on('blur focus keyup keypress', function (event) {--}}
    {{--            inputUrl.val(cyrillicToTranslit().transform(inputTitle.val().toLowerCase(), "_"));--}}
    {{--        });--}}


    {{--        var editor_config = {--}}
    {{--            path_absolute: "/",--}}
    {{--            selector: "textarea.editor",--}}
    {{--            plugins: [--}}
    {{--                "advlist autolink lists link image charmap print preview hr anchor pagebreak",--}}
    {{--                "searchreplace wordcount visualblocks visualchars code fullscreen",--}}
    {{--                "insertdatetime media nonbreaking save table contextmenu directionality",--}}
    {{--                "emoticons template paste textcolor colorpicker textpattern"--}}
    {{--            ],--}}
    {{--            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",--}}
    {{--            relative_urls: false,--}}
    {{--            file_browser_callback: function (field_name, url, type, win) {--}}
    {{--                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;--}}
    {{--                var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;--}}

    {{--                var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;--}}
    {{--                if (type == 'image') {--}}
    {{--                    cmsURL = cmsURL + "&type=Images";--}}
    {{--                } else {--}}
    {{--                    cmsURL = cmsURL + "&type=Files";--}}
    {{--                }--}}

    {{--                tinyMCE.activeEditor.windowManager.open({--}}
    {{--                    file: cmsURL,--}}
    {{--                    title: 'Filemanager',--}}
    {{--                    width: x * 0.8,--}}
    {{--                    height: y * 0.8,--}}
    {{--                    resizable: "yes",--}}
    {{--                    close_previous: "no"--}}
    {{--                });--}}
    {{--            }--}}
    {{--        };--}}

    {{--        tinymce.init(editor_config);--}}
    {{--    </script>--}}
@endsection

