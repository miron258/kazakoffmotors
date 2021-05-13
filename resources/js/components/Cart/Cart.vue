<template>
    <div>

        <!--------------- Корзина товаров ----------------->
        <div  class="block-cart">

            <slot v-if="total>0" :productsTotal="total" name="totalQtyProduct"></slot>

            <div class="block-cart__wrapper-list-products wrapper-list-products">
                <div v-if="total>0" v-for="(product,index) in products"
                     class="row block-cart__row-product row-product">
                    <div v-if="product.associatedModel.pathImgThumbnail" :class="classClsImgProduct" class="row-product__box-img-product box-img-product">

                        <a class="box-img-product__link-product link-product" :href="product.associatedModel.fullUrl">
                            <img :alt="product.name" :src="product.associatedModel.pathImgThumbnail"
                                 class="box-img-product__image-product image-product img-fluid">
                        </a>

                    </div>

                    <div :class="classClsPropertiesProduct" class="row-product__box-info-product box-info-product">

                        <h4 v-text="product.name" class="box-info-product__title-product title-product"></h4>

                        <div v-if="product.associatedModel.properties" v-html="product.associatedModel.properties" class="box-info-product__block-features-product block-features-product">

                            <ul class="block-features-product__list-features list-features">
                                <li class="list-features__item-feature item-feature">
                                    <span class="item-feature__name-feature name-feature">Цвет:</span>
                                    <span class="item-feature__value-feature value-feature">цвет</span>
                                </li>
                            </ul>
                        </div>

                        <div class="box-info-product__block-count-product block-count-product">
                            <input-number-spinner :update="true" :count=product.quantity :product=product>
                                <label class="label-count-product" for="number"
                                       slot="labelCountProduct">
                                    Количество:
                                </label>
                            </input-number-spinner>
                        </div>

                        <div class="box-info-product__block-price-product block-price-product">
                            <div class="block-price-product__label-price label-price">Цена:</div>
                            <div class="value-price">
                                <span v-text="product.price" class="value-price__price-product price-product"></span>
                                <span class="value-price__ruble ruble">p</span>
                            </div>
                        </div>


                        <a @click="deleteProduct(product.id); $root.$emit('onDeleteProduct', product.id)"
                           class="box-info-product__link-remove-product link-remove-product">Убрать
                            <span class="link-remove-product__border-bottom-link border-bottom-link"></span>
                        </a>

                    </div>


                </div>
            </div>

            <div v-if="total === null || total === 0" class="block-cart__cart-empty cart-empty">Ваша
                корзина пустая!
            </div>
            <slot v-if="total>0" :total="totalSum" name="priceSum"></slot>
            <slot v-if="total>0" name="buttonBuy"></slot>
            <div v-show="loader" class="loader-gif">
                <img src="/img/tpl_img/ajax.gif" class="ajax-loader"/>
            </div>


            <a href="/cart/form-order" class="block-cart__link-form-order d-xl-non d-lg-none d-md-none d-sm-none d-block link-form-order">оформить заказ</a>
        </div>
        <!--------------- ./Корзина товаров ----------------->

    </div>

</template>

<script>
// import axios from 'axios'
import VueAxios from 'vue-axios'
import InputNumberSpinner from '../spinner/InputNumberSpinner'
import axios from 'axios';
import Vuex from 'vuex'
import {mapGetters, mapActions} from 'vuex'

export default {
    name: "Cart",
    watch: {
        products: function (newVal, oldVal) {


        },
    },
    props: {
        classClsImgProduct: {
            type: String,
            required: false,
            default: 'col-xl-5 col-lg-5 col-md-5 col-sm-6 col-3'
        },
        classClsPropertiesProduct: {
            type: String,
            required: false,
            default: 'col-xl-7 col-lg-7 col-md-7 col-sm-6 col-9'
        }
    },
    computed: {
        isProperties(){



        },
        ...mapGetters(['total', 'totalSum', 'subTotalSum', 'products', 'loader', 'message'])
    },
    mounted() {


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
    components: {axios, VueAxios, InputNumberSpinner, Vuex}

};


</script>

<style lang="scss">


//@import "./resources/sass/desktop/cart/layouts/modal_cart";

</style>
