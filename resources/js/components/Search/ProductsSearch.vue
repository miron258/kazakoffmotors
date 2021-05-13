<template>
    <!--------------------- Live Search Results ------------------------>
    <div :settings="settingsScrollbar" @ps-scroll-y="scrollHandle" is="vue-custom-scrollbar" v-if="productsSearch.length>0" class="box-search-catalog__live-search-results scroll-area live-search-results">
            <div v-for="product in productsSearch" class="row-search-products">
                <product-search :product="product"></product-search>
            </div>
    </div>
    <!--------------------- /Live Search Results ------------------------>
</template>


<script type="module">
import Vuex from 'vuex'
import ProductSearch from '../Search/ProductSearch'
import {mapGetters} from 'vuex'
import vueCustomScrollbar from 'vue-custom-scrollbar'
import "vue-custom-scrollbar/dist/vueScrollbar.css"

export default {
    name: "ProductsSearch",
    components: {Vuex, ProductSearch, vueCustomScrollbar},
    watch: {
        productsSearch(newVal, oldVal){

            // console.log(newVal, oldVal);

        }
    },
    computed: {
        ...mapGetters(['productsSearch'])
    },
    beforeMount() {

    },
    mounted() {
        window.Echo.channel('search')
            .listen('.searchResults', (e) => {
                this.$store.commit('SET_PRODUCTS', e)
            });
    },
    created() {

    },
    data() {
        return {

            //// Settings Scrollbar
            settingsScrollbar: {
                suppressScrollY: false,
                suppressScrollX: false,
                wheelPropagation: false
            }
        }
    },
    methods: {
        scrollHandle(evt) {
            console.log(evt)
        }
    }
}
</script>

<style lang="scss">


</style>
