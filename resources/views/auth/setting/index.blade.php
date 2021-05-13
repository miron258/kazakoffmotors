@extends('auth.layouts.app')
@section('title', 'Настройки сайта')
@section('content')

    <div class="container-fluid">

        <div class="row justify-content-center">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        @yield('title')


                    </div>

                    <div class="card-body">

                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="content-tab" data-toggle="tab" href="#content" role="tab"
                                   aria-controls="content-tab" aria-selected="true">Настройки</a>
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
                            action="{{ route('settings_site.index') }}"
                            method="POST" enctype='multipart/form-data'>
                            @csrf
                            @method('PUT')
                            <div class="tab-content mt-4" id="myTabContent">


                                <!------------- TAB CONTENT ----------------->
                                <div class="tab-pane fade show active" id="content" role="tabpanel"
                                     aria-labelledby="content-tab">

                                    <div class="row">


                                        <div class="col-xl-4">
                                            <div class="form-group">
                                                <label for="">Размер накрутки в процентах (по умолчанию) <span
                                                        class="required">*</span></label>
                                                <input
                                                    class="form-control @error('wrapping') is-invalid @enderror"
                                                    type="text" name="wrapping"
                                                    value='{{old('wrapping', (isset($settings) && isset($settings->wrapping))?
$settings->wrapping: null)}}'
                                                    name="wrapping">
                                            </div>
                                        </div>

                                    </div>


                                    <div class="row">

                                        <div class="col-xl-4">
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <input
                                                        @if(isset($settings)
&& isset($settings->is_wrapping)
&& $settings->is_wrapping == 1 || old('is_wrapping') == 'on')
                                                        checked=checked
                                                        @endif
                                                        type="checkbox" name="is_wrapping" id="is_wrapping"
                                                        class="form-check-input">
                                                    <label class="form-check-label">Вклчить/отключить накрутку</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <!------------- END TAB CONTENT ----------------->


                            </div>


                            <div class="row mt-3">
                                <div class="col-xl-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Сохранить</button>
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



@endsection

