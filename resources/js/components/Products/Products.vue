<template>
    <div v-bind:class="classWrapper" class="block-list-products">

        <div v-bind:class="{'container': isContainer}">
            <div v-show="loader" class="loader-gif">
                <img src="/img/tpl_img/ajax.gif" class="ajax-loader"/>
            </div>
            <slot name="titleProducts"></slot>

            <div class="wrapper-row-list-products" v-if="productsList">
                <div v-for="(chunk, indexChunk) in productsChunk" :key="indexChunk"
                     class="row-list-products row-list-products1 flex-nowrap row">

                    <div v-bind:class="classColumns" v-for="(product, indexProduct) in chunk" :key="indexProduct"
                         class="list-products__wrapper-box-product wrapper-box-product">

                        <div ref="product" class="wrapper-box-product__box-product box-product">

                            <div class="box-product__block-img-product block-img-product">
                                <a v-if="product.pathImgThumbnail" :href="product.fullUrl"
                                   class="block-img-product__link-product link-product">
                                    <img ref="productImg" :src="product.pathImgThumbnail"
                                         class="link-product__img-product img-product img-fluid"
                                         :alt="product.fullName">
                                </a>
                                <div v-else class="block-img-product__img-empty img-empty"></div>
                            </div>

                            <a v-html="product.fullName" :href="product.fullUrl"
                               class="box-product__link-title-product link-title-product"></a>

                            <div v-if="product.count_stock <= 0" class="box-product__title-not-available title-not-available">Нет в наличии</div>


                            <div class="box-product__block-price-product block-price-product">
                            <span v-text="Intl.NumberFormat().format(product.price)"
                                  class="block-price-product__price-product price-product"></span>
                                <span class="block-price-product__rub ruble">p</span>
                            </div>


                            <button v-if="!product.count_stock <= 0" :disabled="product.loaderProduct" v-bind:class="product.classButton" @click="addToCart({
                    qty: countProduct,
                    id: product.id,
                    price: product.price,
                    properties: productProperties,
                    name: product.name
                }, indexChunk, indexProduct); $root.$emit('onAddToCart', {
                    qty: countProduct,
                    id: product.id,
                    price: product.price,
                    properties: productProperties,
                    name: product.name
                })"
                                    class="box-product__bt-add-to-cart bt-add-to-cart">
                                <span v-if="product.isCart"
                                      class="bt-add-to-cart__text-button text-button">В корзине</span>
                                <span v-else class="bt-add-to-cart__text-button text-button">В корзину</span>
                            </button>

                            <div v-else></div>

                        </div>

                    </div>
                </div>
                <slot name="paginate"></slot>
            </div>

            <div v-else class="block-list-products__products-empty products-empty">Не найдено ни одного товара!</div>

        </div>
    </div>


</template>

<script type="module">
import VueAxios from 'vue-axios'
import axios from 'axios';
import Vuex from 'vuex'
import {mapGetters} from 'vuex'
import _ from 'lodash'
import mixins from '../mixins/mixins'; //Vue Mixins
Vue.mixin(mixins);


export default {
    name: "Products",
    mixins: ['mixins'],
    components: {axios, VueAxios, Vuex},
    watch: {
        countColumns: function (newVal, oldVal) {
        },
        products: function (newVal) {
            this.productsList = newVal;
        }
    },
    props: {
        route: {
            type: String,
            required: false
        },
        products: {
            type: Array,
            required: false
        },
        isContainer: {
            type: Boolean,
            required: false,
            default: true,
        },
        classWrapper: {
            type: String,
            required: false,
            default: ""
        },
        ///Выводить список товаров построчно или нет
        rows: {
            type: Boolean,
            required: false,
            default: true
        },
        isSlickCarousel: {
            type: Boolean,
            required: false,
            default: false
        },
        // Количество колонок в ряд
        columns: {
            type: Number,
            required: false,
            default: 5
        }
    },
    computed: {
        productsChunk() {
            if (this.productsList) {
                const productsInCart = this.productsInCart;
                const productsList = this.products;
                if (productsInCart && this.products) {
                    this.products.find(function (item, key) {
                        productsList[key].isCart = false;
                        productsList[key].classButton = 'not-in-cart';
                        for (let j = 0; j < Object.values(productsInCart).length; j++) {
                            if (item.id === Object.values(productsInCart)[j].id) {
                                productsList[key].isCart = true;
                                productsList[key].classButton = 'in-cart';
                            }

                        }


                    });
                }
                this.products = productsList;
                return _.chunk(Object.values(this.productsList), parseInt(this.countColumns));
            }
        },
        classColumns() {
            switch (this.columns) {
                case 5:
                    return "col-auto";
                case 4:
                    return "col-xl-3 col-lg-3 col-md-3 col-sm-6 col-6";
                case 3:
                    return "col-xl-4 col-lg-4 col-md-4 col-sm-6 col-6";
                case 2:
                    return "col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6";
                default:
                    return "col";
            }

        },
        ...mapGetters(['total', 'totalSum', 'subTotalSum', 'loader', 'product', 'productsInCart', 'type']),

    },
    beforeMount() {},
    updated() {},
    mounted() {

        if (this.$root.isMobile()) {
            this.countColumns = 2;
        } else {
            this.countColumns = this.columns;
        }
    },
    created() {},
    destroyed() {},
    data() {
        return {
            countProduct: 1,
            countColumns: this.columns,
            loaderProducts: false,
            productsList: this.products,
            productProperties: {}
        }
    },
    methods: {
        getProductId(id) {
            for (let i = 0; i < this.productsList.length; i++) {
                if (this.productsList[i].id === id) {
                    return i;
                }
            }
        },
        addToCart(product, indexChunk, indexProduct) {
            this.$store.dispatch('addToCart', product);
            let index = this.getProductId(product.id)
            let productImg = this.$refs.productImg[index];

            console.log(productImg);

            if (!this.$root.isMobile()) {
                this.flyToElement(
                    productImg,
                    '.link-cart .text-cart');
            }


        },

    }
}
</script>

<style lang="scss">


////////// BLOCK LIST PRODUCTS
@import "resources/sass/desktop/product/layouts/list_products";
////////// END BLOCK LIST PRODUCTS

</style>
