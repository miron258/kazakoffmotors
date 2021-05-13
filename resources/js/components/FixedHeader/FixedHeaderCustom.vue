<template>
    <fixed-header :threshold="threshold">
        <div id="shop-menu-catalog" class="container-fluid container-header-shop-menu">

            <div class="wrapper-button-catalog d-xl-none d-lg-none d-md-none d-sm-block d-block">
                <button
                    class="container-header-shop-menu__bt-menu-catalog bt-menu-catalog navbar-toggler"
                    type="button"
                    data-toggle="collapse"
                    data-target="#navbarContent"
                    aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                    <div class="animated-icon">
                        <span class="mburger mburger-top"></span>
                        <span class="mburger mburger-middle"></span>
                        <span class="mburger mburger-bottom"></span>
                    </div>
                </button>
                <div class="title-catalog">Каталог</div>
            </div>

            <div id="navbarContent"
                 :class="{'collapse': this.$root.isMobile()}" class="container container-header-shop-menu__block-header-shop-menu block-header-shop-menu">
                <div class="wrapper-menu">
                    <slot name="menuShopCatalog"></slot>
                </div>

            </div>
        </div>
    </fixed-header>
</template>


<script>
import FixedHeader from 'vue-fixed-header'

export default {

    name: "FixedHeaderCustom",
    //Метод позволяющий следить за  изменением свойств в компоненте
    watch: {},
    data() {
        return {
            threshold: null
        };
    },

    props: {},
    mounted() {


            let shopMenuCatalog = document.getElementById("shop-menu-catalog");
            this.threshold = shopMenuCatalog.offsetTop;




    },
    created: function () {

    },
    computed: {
        // threshold: function (){
        //
        //
        // }
    },
    methods: {},
    components: {FixedHeader}

};


</script>

<style lang="scss">

</style>
