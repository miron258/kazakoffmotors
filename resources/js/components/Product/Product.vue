<template>
    <div>
        <h1 v-if="productData.name" v-text="productData.name"
            class="product-properties__title-product title-product"></h1>

        <div v-if="productData.art" class="product-properties__block-number-product block-number-product">
            <span class="block-number-product__title-number-product title-number-product">Номер запчасти: </span>
            <span v-text="productData.art"
                  class="block-number-product__value-number-product value-number-product"></span>
        </div>

        <div v-if="isAvailability" class="product-properties__block-not-available block-not-available">
            <span class="block-not-available__text-not-available text-not-available">нет в наличии</span>
        </div>

        <div v-if="formatPrice" class="product-properties__block-price-product block-price-product">
            <span v-text="formatPrice" class="block-price-product__price-product price-product"></span>
            <span class="block-price-product__rub rub">p</span>
        </div>

        <div v-if="productData.properties" v-html="productData.properties"
             class="product-properties__block-features-product block-features-product">

        </div>
        <div v-if="!isAvailability" v-bind:class="{'block-select-count-product-top': !productData.properties}"
             class="product-properties__block-select-count-product block-select-count-product">
            <input-number-spinner :product=productData :count=countProduct
                                  @onUpdateCountProduct='getCountProduct'></input-number-spinner>
        </div>


        <button v-if="!isAvailability" v-bind:class="classButtonProduct" @click="addToCart({
                    qty: countProduct,
                    id: productData.id,
                    price: productData.price,
                    properties: productData.properties,
                    name: productData.name
                    // selectorImgProduct: '#product-img-single'
                }, this); $root.$emit('onAddToCart', {
                    qty: countProduct,
                    id: idProduct,
                    price: priceProduct,
                    properties: productProperties,
                    name: nameProduct,
                    product: this
                })"
                class="product-properties__button-add-to-cart button-add-to-cart">
            <span v-if="isCartProduct" class="text-button">в корзине</span>
            <span v-else class="text-button">в корзину</span>
        </button>

    </div>
</template>

<script type="module">
import InputNumberSpinner from '../spinner/InputNumberSpinner'
import VueAxios from 'vue-axios'
import axios from 'axios';
import Vuex from 'vuex'
import {mapGetters} from 'vuex'
// import $ from 'jquery';  // подключаем jQuery
import mixins from '../mixins/mixins'; //Vue Mixins
Vue.mixin(mixins);


export default {
    name: "Product",
    mixins: ['mixins'],
    components: {InputNumberSpinner, axios, VueAxios, Vuex},
    watch: {
        product: function (product) {
            let self = this;
            if (product !== undefined && product.classButton !== undefined) {
                self.classButtonProduct = product.classButton;
                self.isCartProduct = product.isCart;
            }
        }
    },
    ///Если Props буду реакивные то она их перезадать через Data
    props: {
        productData: {
            type: Object,
            required: true
        },

    },
    mounted() {
        let self = this;
        this.$root.$on('onDeleteProduct', function (idProduct) {
            if (self.idProduct === idProduct) {
                self.classButtonProduct = 'not-in-cart';
                self.isCartProduct = false;
            }
        });

    },
    created() {
    },
    data() {
        return {
            classButtonProduct: this.productData.classButton,
            isCartProduct: this.productData.isCart,
            countProduct: 1,
            priceProduct: parseInt(this.productData.price),
            idProduct: parseInt(this.productData.id),
            nameProduct: this.productData.name,
            urlProduct: null,
            productProperties: {}
        }
    },
    computed: {
        isAvailability() {
            if (this.productData.count_stock <= 0) {
                return true;
            }
            return false;
        },
        ...mapGetters(['total', 'totalSum', 'subTotalSum', 'loader', 'product']),
        formatPrice() {
            return new Intl.NumberFormat().format(this.productData.price);
        },
    },
    methods:
        {
            addToCart(product) {
                this.$store.dispatch('addToCart', product);
                if (!this.$root.isMobile()) {
                    this.flyToElement(
                        '.column-list-images-product .slick-carousel-product .box-slick-item img',
                        '.link-cart .text-cart');
                }
            },

            getCountProduct(data) {

                this.countProduct = data.qty;
            }

        },
}
</script>

<style lang="scss">

</style>
