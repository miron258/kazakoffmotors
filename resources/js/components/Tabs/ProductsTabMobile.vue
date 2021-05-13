<template>
    <div class="products-tab">

        <div class="products-tab__tabs-product tabs-product">
            <tabs @clicked="tabClicked" @changed="tabChanged">
                <tab name="Новинки">
                    <products v-if="load" class-wrapper="block-list-products-in-catalog"
                              v-bind:products="productsNewItems" :columns=2>
                        <template slot="titleProducts" slot-scope="props">
                            <h2 class="title-list-products">Новинки</h2>
                        </template>
                    </products>
                </tab>

                <tab name="Распродажа">
                    <products v-if="load" class-wrapper="block-list-products-in-catalog"
                              v-bind:products="productsSale" :columns=2>
                        <template slot="titleProducts" slot-scope="props">
                            <h2 class="title-list-products">Распродажа</h2>
                        </template>
                    </products>
                </tab>

                <tab name="Все товары">
                    <products v-if="load" class-wrapper="block-list-products-in-catalog" v-bind:products="products"
                              :columns=2>
                        <template slot="titleProducts" slot-scope="props">
                            <h2 class="title-list-products">Все товары</h2>
                        </template>
                    </products>
                </tab>

            </tabs>
        </div>


    </div>
</template>

<script type="module">
import VueAxios from 'vue-axios'
import axios from 'axios';
import Vuex from 'vuex'
import Products from '../Products/Products'
import {mapGetters} from 'vuex'
import {Tabs, Tab} from 'vue-tabs-component';

export default {
    name: "ProductsTabMobile",
    components: {axios, VueAxios, Vuex, Tabs, Tab, Products},
    watch: {},
    props: {
        idCatalog: {
            type: Number,
            required: true
        }

    },
    computed: {

        ...mapGetters(['total', 'totalSum', 'subTotalSum', 'loader']),

    },
    beforeMount() {

    },
    mounted() {
        this.getProducts();
    },
    created() {

    },
    destroyed() {

    },
    data() {
        return {
            load: false,
            products: [],
            productsSale: [],
            productsNewItems: []
        }
    },
    methods: {

        getProducts() {
            axios.get('/api/v1/getProducts/' + this.idCatalog).then(
                response => {
                    let status = response.data.success;
                    if (status) {
                        this.products = response.data.products;
                        this.productsSale = response.data.productsSale;
                        this.productsNewItems = response.data.productsNewItems;
                        this.load = true;
                    } else {

                    }


                    console.log(response);


                }).catch(e => {
                console.log(e);
            }).finally(() => {
                this.load = true;
            });


        },

        tabClicked(selectedTab) {
            console.log('Current tab re-clicked:' + selectedTab.tab.name);
        },
        tabChanged(selectedTab) {
            console.log('Tab changed to:' + selectedTab.tab.name);
        },
    }
}
</script>

<style lang="scss">


////////// Tabs Mobile
@import "resources/sass/mobile/layouts/tabs_mobile";
////////// END Tabs Mobile

.products-tab {
    padding-left: 5px;
    padding-right: 5px;
    margin-top: 20px;

    .tabs-product {

        .tabs-component {

            .tabs-component-tabs {
                padding-left: 20px;
                padding-right: 20px;
            }

            .tabs-component-panel {
                padding-top: 28px;

                ////////// List Products
                @import "resources/sass/mobile/product/layouts/list_products_in_catalog";
                ////////// End List Products

                ////// Block List Products
                //.block-list-products {
                //
                //    .title-list-products {
                //
                //    }
                //
                //    .wrapper-row-list-products{
                //
                //    }
                //
                //}

                ////// End Block List Products

                &:before {
                    display: none;
                }

                &:after {
                    display: none;
                }


            }

        }


    }

}


</style>
