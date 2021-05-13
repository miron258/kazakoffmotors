<template>
    <div class="product-mobile">

        <div class="product-properties">
            <a v-bind:href="linkReturn"
               class="product-properties__link-back-return-mobile link-back-return-mobile"></a>
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

            <div v-if="productData.properties" v-html="productData.properties"
                 class="product-properties__block-features-product block-features-product">

            </div>

            <div v-if="formatPrice" class="product-properties__block-price-product block-price-product">
                <span v-text="formatPrice" class="block-price-product__price-product price-product"></span>
                <span class="block-price-product__rub rub">p</span>
            </div>
        </div>


        <div class="product-mobile__block-tabs-product block-tabs-product">

            <div class="block-tabs-product__tabs-product tabs-product">
                <tabs @clicked="tabClicked" @changed="tabChanged">
                    <tab v-if="productData.images" name="Фото">
                        <slick-carousel-imgs-product v-bind:arrows=true is-thummbnails=false
                                                     v-bind:images=productData.images></slick-carousel-imgs-product>
                    </tab>

                    <tab v-html="productData.description" v-if="productData.description" name="Описание">
                    </tab>

                    <tab v-html="productData.compatibility" v-if="productData.compatibility" name="Совместимость">
                    </tab>

                    <tab v-html="productData.equipment" v-if="productData.equipment" name="Особенности">
                    </tab>
                </tabs>
            </div>


            <div class="product-block-add-to-cart">
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
                    <span v-else class="text-button">Добавить в корзину</span>
                </button>
            </div>


        </div>


    </div>
</template>

<script type="module">
import InputNumberSpinner from '../spinner/InputNumberSpinner'
import VueAxios from 'vue-axios'
import axios from 'axios';
import Vuex from 'vuex'
import {mapGetters} from 'vuex'
import {mapActions} from 'vuex'
import SlickCarouselImgsProduct from "../SlickCarouselImgsProduct/SlickCarouselImgsProduct";
import {Tabs, Tab} from 'vue-tabs-component';

export default {
    name: "ProductMobile",
    components: {InputNumberSpinner, axios, VueAxios, Vuex, Tabs, Tab, SlickCarouselImgsProduct},
    watch: {
        product: function (product) {
            let self = this;
            if (product !== undefined && product.classButton !== undefined) {
                self.classButtonProduct = product.classButton;
                self.isCartProduct = product.isCart;
            }
        }
    },
    ///Если Props буду реакивные то надо их перезадать через Data
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
            return new Intl.NumberFormat().format(this.priceProduct);
        },
        linkReturn() {
            return "/catalog/" + this.productData.catalog.url;
        }
    },
    methods:
        {
            tabClicked(selectedTab) {
                console.log('Current tab re-clicked:' + selectedTab.tab.name);
            },
            tabChanged(selectedTab) {
                console.log('Tab changed to:' + selectedTab.tab.name);
            },
            addToCart(product) {
                this.$store.dispatch('addToCart', product);
                this.classButtonProduct = 'in-cart';
                this.isCartProduct = true;


            },

            getCountProduct(data) {
                this.countProduct = data.qty;
            }

        },
}
</script>

<style lang="scss">

.block-product {
    .container-view-product-mobile {
        .product-mobile {
            .block-tabs-product {
                .tabs-product {
                    .tabs-component {



                        .tabs-component-tabs {
                            .tabs-component-tab {
                                .tabs-component-tab-a {
                                    padding: 3px 3px 3px 3px;
                                }
                            }
                        }

                      .tabs-component-panel{
                        //min-height: 400px;
                        //max-height: 900px;
                      }


                    }
                }
            }
        }
    }

}


</style>
