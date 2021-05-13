<template>
    <div class="box-search-product d-flex align-items-center">
        <div v-if="product.imgUrl" class="box-search-product__block-img-product block-img-product col-2">
            <a class="block-img-product__link-img-product link-img-product" :href="product.url">
                <img class="link-img-product__img-product img-product img-fluid" :alt="product.name" :src="product.imgUrl">
            </a>
        </div>
        <a :href="product.url" v-bind:class="{'padding-product': !product.imgUrl}" v-html="product.name" class="box-search-product__link-product link-product col-10"></a>
    </div>
</template>


<script type="module">
import Vuex from 'vuex'

export default {
    name: "ProductSearch",
    components: {Vuex},
    watch: {},
    props: ['product'],
    computed: {

    },
    beforeMount() {

    },
    mounted() {


    },
    created() {

    },
    data() {
        return {}
    },
    methods: {}
}
</script>

<style lang="scss">


</style>
