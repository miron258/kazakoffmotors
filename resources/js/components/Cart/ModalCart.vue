<template>
    <div>
        <button class="btn-panel-close-cart" v-on:click.prevent="closePanel"></button>
        <div v-if="message" v-text="message" class="notification-panel-cart"></div>
        <h2 v-if="titleCart" v-text="titleCart" class="title-cart"></h2>
        <cart classClsImgProduct="col-xl-6 col-lg-6 col-md-6" classClsPropertiesProduct="col-xl-6 col-lg-6 col-md-6">
            <template slot="priceSum" slot-scope="props">
                <div class="price-sum">
                    <span class="price-sum__text-sum text-sum">Итого:</span>
                    <span class="price-sum__sum-cart sum-cart">
                        <span v-text="props.total" class="price"></span>
                        <span class="ruble">p</span>
                    </span>
                </div>
            </template>
            <a slot="buttonBuy" class="link-buy" href="/cart">купить</a>
        </cart>

    </div>

</template>

<script>
import axios from 'axios'
import VueAxios from 'vue-axios'
import Cart from '../Cart/Cart'
import Vuex from 'vuex'
import {mapGetters} from 'vuex'
export default {
    name: "ModalCart",
    props: {
        titleCart: {
            type: String,
            required: false,
            default: 'Ваша корзина'
        }
    },
    computed: {
        ...mapGetters(['total', 'totalSum', 'subTotalSum', 'products', 'loader', 'message'])
    },
    mounted() {


    },
    data() {
        return {

        };
    },
    created: function () {


    },

    methods: {
        //Закрыть панель корзины
        closePanel() {
            this.$emit("closePanel", {});
        }
    },
    components: {axios, VueAxios, Cart, Vuex }

};


</script>

<style lang="scss">


@import "./resources/sass/desktop/cart/layouts/modal_cart";

</style>
