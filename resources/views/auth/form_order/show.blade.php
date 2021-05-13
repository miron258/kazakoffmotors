@extends('auth.layouts.app')
@isset($formOrder)
    @section('title', 'Просмотр заказа '. $formOrder->num_order)
@endisset

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
                                   aria-controls="content-tab" aria-selected="true">Информация о заказе</a>
                            </li>
                            @if(!empty($formOrder->products))
                                <li class="nav-item">
                                    <a class="nav-link" id="products-tab" data-toggle="tab" href="#products" role="tab"
                                       aria-controls="products-tab" aria-selected="false">Товары</a>
                                </li>
                            @endif
                        </ul>


                        <div class="tab-content mt-4" id="myTabContent">

                            @if(!empty($formOrder->products))
                                <div class="tab-pane fade" id="products" role="tabpanel" aria-labelledby="products-tab">


                                    <!---------------- List Products --------------->


                                    <table class="w-100 table table-responsive table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Фото</th>
                                            <th scope="col">Название</th>
                                            <th scope="col">Цена</th>
                                            <th scope="col">Кол-во</th>
                                            <th scope="col">Cумма</th>
                                        </tr>
                                        </thead>
                                        <tbody>


                                        @foreach($formOrder->products as $product)



                                            <tr>
                                                <td>
                                                    {{$product->id}}
                                                </td>
                                                <td>
                                                    @if(!empty($product->productModel['pathImgThumbnail']) && isset($product->productModel))
                                                        <a target="_blank" class="link-product"
                                                           href="{{$product->productModel['fullUrl']}}">
                                                            <img alt="{{$product->name}}" class="img-product img-fluid"
                                                                 src="{{$product->productModel['pathImgThumbnail']}}">
                                                        </a>
                                                    @else
                                                        <span class="not-image">Нет фото</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a target="_blank"
                                                       href="{{$product->productModel['fullUrl']}}">{{$product->name}}</a>
                                                </td>
                                                <td>
                                                    {{$product->price}}
                                                </td>
                                                <td>
                                                    {{$product->qty}}
                                                </td>
                                                <td>
                                                    {{$product->total_price}}
                                                </td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>


                                    <!---------------- End List Products --------------->

                                </div>
                        @endif

                        <!------------- TAB CONTENT ----------------->
                            <div class="tab-pane fade show active" id="content" role="tabpanel"
                                 aria-labelledby="content-tab">

                                <div class="row">
                                    <!-------------- Detail Order  -------------->
                                    <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                                        <div class="card card-detail-order">
                                            <h5 class="card-header">Детали заказа</h5>
                                            <div class="card-body">


                                                <ul class="list-group">
                                                    @if(!empty($formOrder->delivery_method))
                                                        <li class="list-group-item list-group-item-action">
                                                            <b>Номер заказа:</b> {{$formOrder->num_order}}
                                                        </li>
                                                    @endif

                                                    @if(!empty($formOrder->dateOrder))
                                                        <li class="list-group-item list-group-item-action">
                                                            <b>Дата заказа:</b> {{$formOrder->dateOrder}}
                                                        </li>
                                                    @endif

                                                    @if(!empty($formOrder->delivery_method))
                                                        <li class="list-group-item list-group-item-action">
                                                            <b>Способ
                                                                доставки:</b> @php echo getMethodDelivery($formOrder->delivery_method); @endphp
                                                        </li>
                                                    @endif

                                                    @if(!empty($formOrder->payment_method))
                                                        <li class="list-group-item list-group-item-action">
                                                            <b>Способ
                                                                оплаты:</b> @php echo getMethodPayment($formOrder->payment_method); @endphp
                                                        </li>
                                                    @endif


                                                    @if(!empty($formOrder->text_order))
                                                        <li class="list-group-item list-group-item-action">
                                                            <b>Текст комментария к
                                                                заказу:</b> {{$formOrder->text_order}}
                                                        </li>
                                                    @endif

                                                    <li class="list-group-item list-group-item-action">
                                                        <b>Статус заказа:</b>
                                                    </li>

                                                </ul>


                                            </div>
                                        </div>
                                    </div>
                                    <!-------------- End Detail Order  -------------->

                                    <!-------------- Personal Info Order  -------------->
                                    @if(!empty($formOrder->personal))
                                        <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                                            <div class="card card-personal-order">
                                                <h5 class="card-header">Персональная информация</h5>
                                                <div class="card-body">

                                                    <ul class="list-group">

                                                        @if(!empty($formOrder->personal->name))
                                                            <li class="list-group-item list-group-item-action">
                                                                <b>Имя и фамилия
                                                                    заказчика:</b> {{$formOrder->personal->name}} {{$formOrder->personal->surname}}
                                                            </li>
                                                        @endif

                                                        @if(!empty($formOrder->personal->phone))
                                                            <li class="list-group-item list-group-item-action">
                                                                <b>Номер
                                                                    телефона:</b> {{$formOrder->personal->phone}}
                                                            </li>
                                                        @endif


                                                        @if(!empty($formOrder->personal->email))
                                                            <li class="list-group-item list-group-item-action">
                                                                <b>Email:</b> {{$formOrder->personal->email}}
                                                            </li>
                                                        @endif


                                                    </ul>


                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                <!-------------- End Personal Info Order  -------------->


                                    <!-------------- Delivery Order  -------------->
                                    @if(!empty($formOrder->delivery) && isset($formOrder->delivery))
                                        <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                                            <div class="card card-delivery-order">
                                                <h5 class="card-header">Информация о доставке</h5>
                                                <div class="card-body">

                                                    <ul class="list-group">

                                                        @if(!empty($formOrder->city))
                                                            <li class="list-group-item list-group-item-action">
                                                                <b>Город:</b> {{$formOrder->city}}
                                                            </li>
                                                        @endif

                                                        @if(!empty($formOrder->delivery->street))
                                                            <li class="list-group-item list-group-item-action">
                                                                <b>Улица:</b> {{$formOrder->delivery->street}}
                                                            </li>
                                                        @endif

                                                        @if(!empty($formOrder->delivery->house_num))
                                                            <li class="list-group-item list-group-item-action">
                                                                <b>Номер
                                                                    дома:</b> {{$formOrder->delivery->house_num}}
                                                            </li>
                                                        @endif

                                                        @if(!empty($formOrder->delivery->corps))
                                                            <li class="list-group-item list-group-item-action">
                                                                <b>Корпус:</b> {{$formOrder->delivery->corps}}
                                                            </li>
                                                        @endif

                                                        @if(!empty($formOrder->delivery->structure))
                                                            <li class="list-group-item list-group-item-action">
                                                                <b>Строение:</b> {{$formOrder->delivery->structure}}
                                                            </li>
                                                        @endif

                                                        @if(!empty($formOrder->delivery->office))
                                                            <li class="list-group-item list-group-item-action">
                                                                <b>Офис:</b> {{$formOrder->delivery->office}}
                                                            </li>
                                                        @endif
                                                        @if(!empty($formOrder->delivery->zip_code))
                                                            <li class="list-group-item list-group-item-action">
                                                                <b>Почтовый
                                                                    индекс:</b> {{$formOrder->delivery->zip_code}}
                                                            </li>
                                                    @endif

                                                </div>


                                            </div>
                                        </div>
                                </div>
                            @endif
                            <!-------------- End Delivery Order  -------------->


                            </div>
                            <!------------- END TAB CONTENT ----------------->


                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

