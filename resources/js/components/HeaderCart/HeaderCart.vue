<template>
    <div>
        <a @click.prevent="showPanel" class="block-header-contacts__link-cart link-cart" href="">
            <span v-if="total" v-text="totalSum" class="link-cart__text-cart text-cart text-cart-total-sum"></span>
            <span v-else class="link-cart__text-cart text-cart">Корзина</span>
            <span v-if="total" class="link-cart__ruble ruble">p</span>
            <span v-if="total" id="header-count-in-cart" v-text="total"
                  class="link-cart__count-product-in-cart count-product-in-cart"></span>
        </a>
        <slideout-panel></slideout-panel>
    </div>
</template>

<script>
// import axios from 'axios'
import VueAxios from 'vue-axios'
import VueSlideoutPanel from 'vue2-slideout-panel';
import axios from  'axios';
Vue.component("modal-cart", require('../Cart/ModalCart').default);
import Vuex from 'vuex'
import {mapGetters} from 'vuex'

export default {
    name: "HeaderCart",
    //Метод позволяющий следить за  изменением свойств в компоненте
    watch: {

    },
    data() {
        return {

        };
    },

    props: {
    },
    mounted() {
    },
    created: function () {
        this.$store.dispatch('initStore');
    },
    computed: {
        ...mapGetters(['total', 'totalSum', 'subTotalSum', 'products', 'loader'])
    },
    methods: {
        showPanel() {
            let dataPanel = {
                width: 520,
                cssClass: 'panel-cart',
                openOn: 'right',
                component: 'modal-cart',
                props: {
                    titleCart: "Ваша корзина"
                }
            };

            const panelHandle = this.$showPanel(dataPanel)
            panelHandle.promise
                .then(result => {

                });

        }
    },
    components: {axios, VueAxios, VueSlideoutPanel, Vuex, mapGetters}

};


</script>

<style lang="scss">

</style>
