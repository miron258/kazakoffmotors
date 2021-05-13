<template>
    <div class="wrapper-box-search-catalog__box-search-catalog box-search-catalog">
        <form v-bind:class="{'loading': loaderSearch}" method="get" action="/search"
              class="box-search-catalog__form-search-catalog form-search-catalog d-flex">
            <input autocomplete="off" v-model="query" placeholder="Поиск запчастей"
                   class="form-search-catalog__field-input-search field-input-search" type="text"
                   name="query">
            <a v-bind:class="{'close-search-visible': isCloseSearch}" @click.prevent="closeSearch" href=""
               class="close-search"></a>
            <button type="submit"
                    class="form-search-catalog__button-search button-search">
                <span class="text-button-search">найти</span>
            </button>
        </form>
        <products-search></products-search>
    </div>
</template>
<script type="module">
import VueAxios from 'vue-axios'
import axios from 'axios';
import Vuex from 'vuex'
import ProductsSearch from '../Search/ProductsSearch'
import {mapGetters} from 'vuex'
// import {urlMixins} from '../mixins/mixins'; //Vue Mixins
import DisableAutocomplete from 'vue-disable-autocomplete';

export default {
    name: "Search",
    // mixins: [urlMixins],
    components: {axios, VueAxios, Vuex, ProductsSearch, DisableAutocomplete},
    watch: {
        query: {
            handler: _.debounce(function (newVal, oldVal) {
                if (oldVal != null) {
                    this.searchProducts()
                }
            }, 50)
        }
    },
    props: {},
    computed: {
        ...mapGetters(['loaderSearch', 'isCloseSearch']),
        queryParam() {
            return new URL(location.href).searchParams.get('query');
        }
    },

    beforeMount() {

    },
    mounted() {

        // this.updateURLParameter(location.href, 'query', 'Новое значение');


        // console.log(location.href);

        this.query = (this.queryParam !== '') ? this.queryParam : null
    },
    created() {

    },
    data() {
        return {
            query: null,
            //Вешаем несколько событий на поле ввода
        }
    },
    methods: {
        closeSearch() {
            this.query = null; //Сбрасывем введенное значенеи в поле поиска
            this.$store.productsSearch = []; //Сбрасываем найденный результат по запросу
        },
        searchProducts() {
            this.$store.dispatch('SEARCH_PRODUCTS', this.query)
        }


    }
}
</script>

<style lang="scss">
////////// FORM SEARCH
@import "resources/sass/desktop/search/layouts/form_search";
////////// END FORM SEARCH
@media (max-width: 576px) {
    @import "resources/sass/mobile/search/layouts/form_search";
}

</style>
