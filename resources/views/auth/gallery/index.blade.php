@extends('auth.layouts.app')
@section('title', 'Список галерей')
@section('content')
<div class="container-fluid">
    <div class="row-fluid justify-content-center">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">@yield('title')</div>


                <div class="col-12 ml-1 mt-2">
                    <a class="btn btn-primary btn-sm" href="{{route('gallery.create')}}"><i class="far fa-plus-square mr-2"></i>Создать галерею</a>
                </div>




                <div class="card-body">

                    @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                    @endif

                    <table class="table table-bordered table-responsive table-striped">
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>Имя</td>
                                <td>Заголовок</td>
{{--                                <td>Ссылка</td>--}}
                                <td>CSS класс</td>
                                <td>Выводить на главной</td>
                                <td>Фото</td>
                                <td>Видимость</td>
                                <td>Дата создания</td>
                                <td></td>
                                <td></td>
                            </tr>
                        </thead>


                        <tbody>
                        @php
                            buildTreeGalleries($galleries);
                        @endphp
                        </tbody>

                    </table>





                </div>
            </div>
        </div>
    </div>
</div>
@endsection
