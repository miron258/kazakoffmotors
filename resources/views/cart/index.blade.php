@extends('cart.template')
@isset($cart)
    @section('meta_tag_title',  "Корзина товаров")
@section('meta_tag_description',  "Корзина товаров")
@section('meta_tag_keywords',  "Корзина товаров")
@endisset

@section('content')
    <div class="cart">
        <div
            class="container cart__container-view-cart d-xl-block d-lg-block d-md-block d-sm-block d-none container-view-cart">
            <div class="cart__title-cart title-cart">
                <h1>
                    Корзина
                </h1>
            </div>

            <a href="{{ url()->previous() }}" class="cart__link-back-return link-back-return">
                продолжить покупки
            </a>


            <!-------------------------- Wrapper Cart ---------------------------->
            <div class="cart__wrapper-cart-row row wrapper-cart-row">

                <!----------------- Column List Products In Cart ---------------------->
                <div
                    class="col-xl-6 col-lg-6 col-md-6 wrapper-cart__column-list-products-in-cart column-list-products-in-cart">
                    <cart v-if="!$root.isMobile()" ref="cart">
                        <template slot="totalQtyProduct" slot-scope="props">
                            <div v-if="props.productsTotal" class="total-count-products">
                                <span v-text="props.productsTotal" class="count-products"></span>
                                <span class="text-products">товара(ов)</span>
                            </div>
                        </template>
                    </cart>
                </div>
                <!----------------- End Column List Products In Cart ---------------------->


                <!----------------- Column Order ---------------------->
                <div class="col-xl-6 col-lg-6 col-md-6 wrapper-cart__column-order column-order">

                    <div class="column-order__box-order box-order">

                        <h3 class="box-order__title-box-order title-box-order">Оформление заказа</h3>

                        <div class="box-order__block-order-total-sum block-order-total-sum">
                            <span class="block-order-total-sum__text-total-sum text-total-sum">Итого:</span>
                            <span class="block-total-sum__block-price block-price">
                                <span v-if="$store.getters.totalSum" id="price-total" class="block-price__price price">
                                    @{{$store.getters.totalSum}}
                                </span>
                                <span class="block-price__ruble ruble">p</span>
                            </span>
                        </div>

                        <div class="box-order__block-order-payment-method block-order-payment-method">

                            <h3 class="block-order-payment-method__title-payment-method title-payment-method">Способы
                                оплаты:</h3>
                            <ul class="block-order-payment-method__list-payment-methods list-payment-methods">
                                <li class="list-payment-methods__item-payment-method item-payment-method">
                                    <img class="item-payment-method__img-payment-method img-payment-method"
                                         alt="Apple Pay"
                                         src="{{asset('img/tpl_img/icon_payments/apple_pay.png')}}">
                                </li>
                                <li class="list-payment-methods__item-payment-method item-payment-method">
                                    <img class="item-payment-method__img-payment-method img-payment-method"
                                         alt="Master Card"
                                         src="{{asset('img/tpl_img/icon_payments/master_card.png')}}">
                                </li>
                                <li class="list-payment-methods__item-payment-method item-payment-method">
                                    <img class="item-payment-method__img-payment-method img-payment-method" alt="Visa"
                                         src="{{asset('img/tpl_img/icon_payments/visa.png')}}">
                                </li>
                            </ul>

                        </div>


                        <a class="box-order__link-form-order link-form-order" href="/cart/form-order">оформить</a>


                        <div class="box-order__block-order-contacts block-order-contacts">

                            <div
                                class="block-order-contacts__title-block-order-contacts title-block-order-contacts open-contacts">
                                Нужна помощь?
                            </div>

                            <div class="block-order-contacts__box-feedback box-feedback">
                                <div class="box-feedback__title-box-feedback title-box-feedback">Свяжитесь с нами:</div>
                                <a href="tel:+74957664703"
                                   class="box-feedback__link-phone-feedback link-phone-feedback">
                                    +7 (495) 766-47-03
                                </a>
                                <a href="mailto:info@kazakoffmotors.ru"
                                   class="box-feedback__link-email-feedback link-email-feedback">
                                    info@kazakoffmotors.ru
                                </a>
                                <div class="box-feedback__block-time-work block-time-work">
                                    пн-пт 10:<span
                                        class="block-time-work__num-minutes num-minutes num-minutes-first">00</span>-20:<span
                                        class="block-time-work__num-minutes num-minutes num-minutes-last">00</span>
                                </div>

                            </div>


                        </div>

                    </div>


                </div>
                <!----------------- End Column Order ---------------------->

            </div>
            <!-------------------------- End Wrapper Cart ---------------------------->


        </div>


        <div
            class="container d-xl-none d-lg-none d-md-none d-sm-none d-block cart__container-view-cart-mobile container-view-cart-mobile">

            <cart-mobile v-if="$root.isMobile()" url-previous={{ url()->previous() }}></cart-mobile>

        </div>


        @if(isset($productsPopular) && !empty($productsPopular))
            <div class="d-xl-block d-lg-block d-md-block d-sm-block d-none">
                <products :products='@json($productsPopular)'>
                    <template slot="titleProducts" slot-scope="props">
                        <h2 class="block-list-products__title-list-products title-list-products">популярные товары</h2>
                    </template>
                </products>
            </div>
        @endisset

    </div>


@endsection
@push('styles')
    <link href="{{ asset('css/cart.css') }}" rel="stylesheet">
@endpush
