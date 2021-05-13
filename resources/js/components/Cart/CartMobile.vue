<template>

    <div class="cart-mobile">


        <div class="cart-mobile-description">
            <a v-bind:href="urlPrevious"
               class="cart-mobile-description__link-back-return-mobile link-back-return-mobile"></a>
            <h1 class="cart-mobile-description__title-cart title-cart">Корзина</h1>

            <div class="cart-mobile-description__block-total-cart block-total-cart">
                <span class="block-total-cart__text-total-cart text-total-cart">Итого:</span>
                <span class="block-total-cart__total-cart total-cart">
                    <span v-text="totalSum" class="price"></span>
                    <span class="ruble">p</span>
                </span>
            </div>


            <div class="cart-mobile-description__block-order-payment-method block-order-payment-method">

                <h3 class="block-order-payment-method__title-payment-method title-payment-method">Способы
                    оплаты:</h3>
                <ul class="block-order-payment-method__list-payment-methods list-payment-methods">
                    <li class="list-payment-methods__item-payment-method item-payment-method">
                        <img class="item-payment-method__img-payment-method img-payment-method"
                             alt="Apple Pay"
                             src="/img/tpl_img/img_shop/icons_order_payments/apple_pay_small.png">
                    </li>
                    <li class="list-payment-methods__item-payment-method item-payment-method">
                        <img class="item-payment-method__img-payment-method img-payment-method"
                             alt="Master Card"
                             src="/img/tpl_img/img_shop/icons_order_payments/master_card_small.png">
                    </li>
                    <li class="list-payment-methods__item-payment-method item-payment-method">
                        <img class="item-payment-method__img-payment-method img-payment-method" alt="Visa"
                             src="/img/tpl_img/img_shop/icons_order_payments/visa_small.png">
                    </li>
                </ul>

            </div>

        </div>


        <div class="cart-mobile__cart-wrapper cart-wrapper">
            <cart></cart>
        </div>


    </div>

</template>

<script>
// import axios from 'axios'
import VueAxios from 'vue-axios'
import InputNumberSpinner from '../spinner/InputNumberSpinner'
import axios from 'axios';
import Vuex from 'vuex'
import {mapGetters} from 'vuex'
import {mapActions} from 'vuex'
import Cart from './Cart'

export default {
    name: "CartMobile",
    props: ['urlPrevious'],
    computed: {
        ...mapGetters(['total', 'totalSum', 'subTotalSum', 'products', 'loader', 'message'])
    },
    mounted() {

        // console.log("this.products");
        // console.log(this.products);

    },
    data() {
        return {
            //// Settings Scrollbar
            // settingsScrollbar: {
            //     suppressScrollY: false,
            //     suppressScrollX: false,
            //     wheelPropagation: false
            // }
        };
    },
    ///Инциализация списка товаров в корзине
    created: function () {

        // alert("dssssss");
        // this.$store.dispatch('initStore');
    },

    methods: {
        ...mapActions(['deleteProduct', 'updateCart']),

    },
    components: {axios, VueAxios, InputNumberSpinner, Vuex, Cart}

};


</script>

<style lang="scss">


//@import "./resources/sass/desktop/cart/layouts/modal_cart";

</style>
