<template>
    <div>

        <div :class="classBlock" class="block-shop-cover-product">

            <div class="container">

                <div :class="classBox" class="align-items-center d-flex box-shop-cover-products">


                    <div class="wrapper-description-cover-products">
                        <h3 v-text="textTitle" :class="classTitle"
                            class="box-shop-cover-products__title-box-shop-cover-products  title-box-shop-cover-products"></h3>


                        <ul class="block-shop-cover-product__list-type-products list-type-products">
                            <li class="list-type-products__item-type-products item-type-products item-type-products-new">
                                <router-link class="item-type-products__link-type-products link-type-products"
                                             :to="{name:'novelty'}">новинки</router-link>
                            </li>
                            <li class="list-type-products__item-type-products item-type-products item-type-products-sale">
                                <router-link class="item-type-products__link-type-products link-type-products"
                                             :to="{name:'sale'}">распродажа</router-link>
                            </li>
                            <li class="list-type-products__item-type-products item-type-products item-type-products-all">
                                <router-link class="item-type-products__link-type-products link-type-products"
                                             :to="{name:'all'}">все товары</router-link>
                            </li>
                        </ul>


                    </div>

                </div>

            </div>


        </div>

        <div class="list-products">
            <router-view :route="$route.fullPath" v-if="products" :url="url" :products=products :columns=5>
                <template slot="titleProducts" slot-scope="props">
                    <h2 v-text="title" class="block-list-products__title-list-products title-list-products"></h2>
                </template>
            </router-view>
        </div>


    </div>
</template>

<script type="module">
import VueAxios from 'vue-axios'
import axios from 'axios';
import Vuex from 'vuex'
import Products from '../Products/Products'
import {mapGetters} from 'vuex'
import VueRouter from 'vue-router'


export default {
    name: "ProductsTab",
    ////// Vue Router
    router: new VueRouter({
        mode: 'history',
        hash: true,
        linkActiveClass: "active",
        linkExactActiveClass: "active",
        routes: [
            {
                path: '/catalog/:name/novelty',
                name: 'novelty',
                component: Products,
                props: true
            },
            {
                path: '/catalog/:name/sale',
                name: 'sale',
                component: Products,
                props: true
            },
            {
                path: '/catalog/:name/all',
                name: 'all',
                component: Products,
                props: true
            }
        ]
    }),
    components: {axios, VueAxios, Vuex, Products},
    watch: {
        products: function(newVal, oldVal){

        },
        $route: function(newVal, oldVal) {
            this.getProducts();
        }
    },
    props: {
        idCatalog: {
            type: Number,
            required: true
        },
        url:{
            type: String,
            required: true
        },
        classBlock: {
            type: String,
            required: true
        },
        classBox: {
            type: String,
            required: true
        },
        classTitle: {
            type: String,
            required: true
        },
        textTitle: {
            type: String,
            required: true
        }

    },
    computed: {

        ...mapGetters(['total', 'totalSum', 'subTotalSum', 'loader']),

    },
    beforeMount() {
        window.basePathCatalog = this.url;
    },
    mounted() {
        console.log("this.products");
        console.log(this.products);

        this.getProducts();
        const path = this.url+`/novelty`;
        if (this.$route.path !== path) this.$router.push({ path: this.url+'/novelty' })
    },
    created() {

    },
    destroyed() {

    },
    data() {
        return {
            products: null,
            title: null
        }
    },
    methods: {

        getProducts() {

            axios.get('/api/v1/getProducts/' + this.idCatalog).then(
                response => {
                    let status = response.data.success;
                    if (status) {

                        switch(this.$route.name){
                            case 'novelty':
                                this.products = response.data.productsNewItems
                                this.title = "Новинки";
                                break;
                            case 'sale':
                                this.products = response.data.productsSale
                                this.title = "Распродажа";
                                break;
                            case 'all':
                                this.products = response.data.products
                                this.title = "Все товары";
                                break;

                        }

                    }



                }).catch(e => {
                console.log(e);
            }).finally(() => {
                // this.loader.$set = true;
            });


        },


    }
}
</script>

<style lang="scss">


</style>
