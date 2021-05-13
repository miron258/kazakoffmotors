<!doctype html>
<html lang="{{ str_replace('_', '-', app()-> getLocale()) }}">
@include('layouts.preheader')

<body>
<div class="wrapper-error-page">

    <div class="container">

        <a class="link-main-page" href="/">
            <img class="img-fluid img-logo" alt="Казакофф Моторс" src="{{asset('img/tpl_img/logo_404.png')}}">
        </a>
        <div class="wrapper-img-404">
            <img class="img-fluid img-404" alt="Казакофф Моторс" src="{{asset('img/tpl_img/404.png')}}">
        </div>
        <div class="title-page">
            Ой! Такой страницы не существует
        </div>
        <a class="link-return-main-page" href="/">
            Перейдите на главную страницу
        </a>

    </div>


</div>

<link href="{{ asset('css/error.css') }}" rel="stylesheet">

</body>
</html>
