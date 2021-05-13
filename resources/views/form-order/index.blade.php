@extends('form-order.template')
@isset($formOrder)
    @section('meta_tag_title',  "Оформление заказа")
@section('meta_tag_description',  "Оформление заказа")
@section('meta_tag_keywords',  "Оформление заказа")
@endisset

@section('content')
    <div class="block-form-order">


        <!---------------- Desktop Form Order ----------------->
        <div
            class="container cart__container-view-form-order d-xl-block d-lg-block d-md-block d-sm-block d-none container-view-form-order">
            <div class="form-order__title-form-order title-form-order">
                Оформление заказа
            </div>
            <a href="{{ route('cart.index') }}" class="cart__link-back-return link-back-return">
                вернуться в корзину
            </a>

            @if($isFormOrder)
                <form-order v-if="!$root.isMobile()" ref="formOrder" cities='@json($cities)'>
                </form-order>
            @else

                @if($order['orderDataResponse']['Success'] === 'true')
                    <div class="form-order-success">
                        <img class="icon-check-order img-fluid" alt="Заказ оформлен" src="/img/tpl_img/check_order.png">
                        <div class="form-order-success__title-form-order-success title-form-order-success">
                            Заказ № <span class="num-order">{{$order['orderDataResponse']['OrderId']}}</span> оформлен.<br>
                            Payment ID <span class="payment-id">{{$order['orderDataResponse']['PaymentId']}}</span><br>
                            Компания <span class="company-name">{{$order['orderDataResponse']['CompanyName']}}</span><br>
                        </div>
                        <div class="text-order-success">
                            Заказ в сборке, ожидайте ответа менеджера.<br>
                            На указанный вами при регистрации e-mail отправлено письмо<br>
                            с реквизитами заказа.
                        </div>
                    </div>
                @else
                    <div class="form-order-success form-order-cancel">
                        <img class="icon-check-order img-fluid" alt="Заказ сброшен" src="/img/tpl_img/check_order.png">
                        <div class="form-order-success__title-form-order-success title-form-order-success">
                            Заказ № <span class="num-order">{{$order['orderDataResponse']['OrderId']}}</span> отменен.<br>
                        </div>
                        <div class="text-order-success">
                            Причина  <b>{{$order['orderDataResponse']['Message']}}</b>
                        </div>
                    </div>

                @endif


            @endif
        </div>
        <!---------------- End Desktop Form Order ----------------->


        <!---------------- Mobile Form Order ----------------->
        <div
            class="container d-xl-none d-lg-none d-md-none d-sm-none d-block cart__container-view-form-order-mobile container-view-form-order-mobile">
            @if($isFormOrder)
                <form-order-mobile v-if="$root.isMobile()" url-previous={{ url()->previous() }} ref="formOrder"
                                   cities='@json($cities)'>
                </form-order-mobile>
            @else
                @if($order['orderDataResponse']['Success'] === 'true')
                    <div class="form-order-success">
                        <img class="icon-check-order img-fluid" alt="Заказ оформлен" src="/img/tpl_img/check_order.png">
                        <div class="form-order-success__title-form-order-success title-form-order-success">
                            Заказ № <span class="num-order">{{$order['orderDataResponse']['OrderId']}}</span> оформлен.<br>
                            Payment ID <span class="payment-id">{{$order['orderDataResponse']['PaymentId']}}</span><br>
                            Компания <span class="company-name">{{$order['orderDataResponse']['CompanyName']}}</span><br>
                        </div>
                        <div class="text-order-success">
                            Заказ в сборке, ожидайте ответа менеджера.<br>
                            На указанный вами при регистрации e-mail отправлено письмо<br>
                            с реквизитами заказа.
                        </div>
                    </div>
                @else
                    <div class="form-order-success form-order-cancel">
                        <img class="icon-check-order img-fluid" alt="Заказ сброшен" src="/img/tpl_img/check_order.png">
                        <div class="form-order-success__title-form-order-success title-form-order-success">
                            Заказ № <span class="num-order">{{$order['orderDataResponse']['OrderId']}}</span> отменен.<br>
                        </div>
                        <div class="text-order-success">
                            Причина  <b>{{$order['orderDataResponse']['Message']}}</b>
                        </div>
                    </div>

                @endif

            @endif
        </div>
        <!---------------- End Mobile Form Order ----------------->

    </div>


@endsection
@push('styles')
    <link href="{{ asset('css/form_order.css') }}" rel="stylesheet">
@endpush
