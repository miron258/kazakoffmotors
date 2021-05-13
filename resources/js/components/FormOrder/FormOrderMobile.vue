<template>
    <div class="container-form-order">
        <div v-show="loader" class="loader-gif">
            <img src="/img/tpl_img/ajax.gif" class="ajax-loader"/>
        </div>
        <div v-html="message" class="message-form-order"></div>


        <form v-if="!isFormOrder" @keydown="form.onKeydown($event)" @submit.prevent="submit" method="post"
              class="form-order">

            <div class="form-order-mobile-description">
                <router-link class="form-order-mobile-description__link-back-return-mobile link-back-return-mobile"
                             :to="routerLinkPrev"></router-link>

                <h1 class="form-order-mobile-description__title-form-order title-form-order">Оформление заказа</h1>

                <div class="form-order-mobile-description__block-total-form-order block-total-form-order">
                    <span class="block-total-cart__text-total-form-order text-total-form-order">Итого:</span>
                    <span class="block-total-cart__total-form-order total-form-order">
                    <span v-text="totalSum" class="price"></span>
                    <span class="ruble">p</span>
                </span>
                </div>


                <div class="form-order-mobile-description__block-sub-total-form-order block-sub-total-form-order">
                    <span class="block-total-cart__text-sub-total-form-order text-sub-total-form-order">Заказ:</span>
                    <span class="block-total-cart__sub-total-form-order sub-total-form-order">
                    <span v-text="subTotalSum" class="price"></span>
                    <span class="ruble">p</span>
                </span>
                </div>


                <div v-if="priceDelivery>0"
                     class="form-order-mobile-description__block-total-delivery block-total-delivery">
                    <span class="block-total-cart__text-total-delivery text-total-delivery">Доставка:</span>
                    <span class="block-total-cart__total-delivery total-delivery">
                    <span v-text="priceDelivery" class="price"></span>
                    <span class="ruble">p</span>
                </span>
                </div>


            </div>


            <div class="wrapper-box-form">


                <router-view v-bind:method-delivery="form.methodDelivery"
                             v-bind:cities="cities"
                             @onChangeMethodDelivery="changeMethodDelivery"
                             @onChangePaymentMethods="changePaymentMethods"
                             v-bind:value-address-delivery="form.methodDelivery"
                             v-bind:is-address-delivery="isAddressDelivery"
                             v-bind:form="form"></router-view>


                <router-view v-bind:method-delivery="form.methodDelivery" v-bind:cities="cities"
                             v-if="isAddressDelivery"
                             v-bind:form="form"
                             name="b"/>


                <div class="wrapper-buttons-form-order">

                    <router-link v-if="!isButtonFormOrder" v-text="textButtonRouterLink"
                                 class="button-routes-form-order"
                                 :to="routerLink"></router-link>

                    <button v-else :disabled="!isValidate"
                            class="button-form-order">
                        оформить
                    </button>

                </div>


            </div>


            <!-------------------------- ROW BOX TEXT ORDER ------------------------>
            <!--            <div class="form-order__row-boxes-text-order row row-boxes-text-order">-->


            <!--                <div class="col-xl-8 col-lg-8 row-box-text-order__wrapper-box-text-order wrapper-box-text-order">-->

            <!--                    <div v-bind:class="{'has-error' : form.errors.has('textOrder')}"-->
            <!--                         class="form-group form-group-text-order">-->
            <!--                        <label class="label-text-order" for="textOrder">Комментарий к заказу</label>-->
            <!--                        <textarea :class="{ 'is-invalid': form.errors.has('textOrder') }" name="text_order"-->
            <!--                                  v-model="form.textOrder"-->
            <!--                                  class="form-control form-control-text-order" id="textOrder"></textarea>-->
            <!--                        <has-error :form="form" field="textOrder"></has-error>-->
            <!--                    </div>-->

            <!--                </div>-->




            <!--                </div>-->


            <!--            </div>-->
            <!-------------------------- END ROW BOX TEXT ORDER ------------------------>

        </form>


                <div v-else class="form-order-success">
                    <h2 class="header-form-order-success">Заказ оформлен</h2>
                    <img class="icon-check-order img-fluid" alt="Заказ оформлен" src="/img/tpl_img/mobile/shop/icon_check_form_order.png">
                    <div v-if="numOrder" class="form-order-success__title-form-order-success title-form-order-success">
                        Заказ № <span v-text="numOrder.numOrder" class="num-order"></span> оформлен.
                    </div>
                    <div v-if="numOrder" class="text-order-success">
                        Заказ в сборке, ожидайте ответа менеджера.<br>
                        На указанный вами при регистрации e-mail отправлено письмо<br>
                        с реквизитами заказа.
                    </div>
                </div>


    </div>
</template>
<script>
//Import v-from
import {Form, HasError, AlertError, AlertErrors, AlertSuccess} from 'vform'
import FormOrderDeliveryMethods from "./FormOrderDeliveryMethods";
import FormOrderPaymentMethods from "./FormOrderPaymentMethods";
import FormOrderPersonal from "./FormOrderPersonal";
import FormOrderAddressDelivery from "./FormOrderAddressDelivery";
import Vuex from 'vuex'
import {mapGetters} from 'vuex'
import VueRouter from 'vue-router'


const router =  new VueRouter({
    mode: 'history',
    hash: true,
    base: "/cart/form-order",
    linkActiveClass: "active",
    linkExactActiveClass: "active",
    routes: [
        {
            path: '/',
            name: 'delivery',
            component: FormOrderDeliveryMethods,
            props: true,
            // children: [
            //
            // ]
        },
        {
            path:'/:delivery',
            name:'payment',
            // params: { delivery: this.methodDelivery },
            component: FormOrderPaymentMethods,
            props: true,
        },
        {
            path:'/:delivery/:payment',
            // params: { delivery: this.methodDelivery, payment: this.methodPayment },
            name:'personal-form',
            props: true,
            components: {
                default: FormOrderPersonal,
                a: FormOrderPersonal,
                b: FormOrderAddressDelivery
            },
        }
    ]
});



export default {
    name: "FormOrderMobile",

    ////// Vue Router
   router,
    ////// End Vue Router
    props: ['cities', 'urlPrevious'],
    //Метод позволяющий следить за  изменением свойств в компоненте
    watch: {},
    components: {
        Vuex,
        mapGetters,
        FormOrderAddressDelivery,
        FormOrderPersonal,
        FormOrderPaymentMethods,
        FormOrderDeliveryMethods,
        Form,
        HasError,
        AlertError,
        AlertErrors,
        AlertSuccess,
        VueRouter
    },
    mounted() {

        if (this.$route.params.payment){
            this.form.methodPayment =  parseInt(this.$route.params.payment);
        }
        if (this.$route.params.delivery){
            this.form.methodDelivery = parseInt(this.$route.params.delivery);
            this.changeMethodDelivery();
        }


        //
        console.log(this.form);


    },
    computed: {
        currentRouteName() {
            return this.$route.name;
        },
        isButtonFormOrder() {
            let routeName = this.$route.name;
            if (routeName === 'personal-form') {
                return true;
            } else {
                return false;
            }
        },
        textButtonRouterLink() {
            let routeName = this.$route.name;
            switch (routeName) {
                case 'delivery':
                    return 'Далее';
                case 'payment':
                    return 'Далее';
                case 'personal-form':
                    return 'Оформить';
                default:
                    return 'Далее';
            }
        },
        routerLink() {
            let routeName = this.$route.name;
            switch (routeName) {
                case 'delivery':
                    return '/'+this.form.methodDelivery;
                case 'payment':
                    return '/'+this.form.methodDelivery+'/'+this.form.methodPayment;
                case 'personal-form':
                    return '/'+this.form.methodDelivery;
                default:
                    return '/';
            }

        },
        routerLinkPrev() {

            let routeName = this.$route.name;
            switch (routeName) {
                case 'delivery':
                    return '/cart';
                case 'payment':
                    return '/';
                case 'personal-form':
                    return '/'+this.form.methodDelivery;
                default:
                    return '/';
            }

        },

        // passProps() {
        //     if (this.$route.name === 'a') {
        //         return {foo: this.foo}
        //     }
        //     if (this.$route.name === 'b') {
        //         return {bar: this.bar}
        //     }
        // },


        isValidate() {

            if (this.form.methodDelivery == 1) {
                return this.form.name
                    && this.form.surname
                    && this.form.email
                    && this.form.phone;
            } else {
                return this.form.name
                    && this.form.email
                    && this.form.phone
                    && this.form.city
                    && this.form.street
                    && this.form.zipCode
                    && this.form.houseNum;
            }


        },
        ...mapGetters(['total', 'totalSum', 'subTotalSum', 'loader', 'priceDelivery', 'totalSumNotDelivery']),
    },
    data() {
        return {
            isAddressDelivery: false,
            isFormOrder: false,
            numOrder: null,
            message: null,
            // loader: false,

            ////Сформированные данные после того как форма была успешно отправлена
            formSuccess: {},
            routesPagination: {
                pageSelectDelivery: true,
                pageSelectPayment: false,
                pageFormOrder: false
            },
            form: new Form({
                methodDelivery:  1, //Способ доставки
                methodPayment: 1,
                //// Персональные данные
                name: null,
                surname: null,
                phone: null,
                email: null,

                //// Адрес доставки
                city: null,
                street: null,
                numHouse: null,
                corps: null,
                structure: null,
                office: null,
                zipCode: null,

                //Комментарий к заказу
                textOrder: null

            })
        }
    },
    methods: {

        changeMethodDelivery() {


            console.log(this.form);

            if (this.form.methodDelivery === 1) {
                this.isAddressDelivery = false;
            } else {
                this.isAddressDelivery = true;
            }

            if (this.form.methodDelivery === 2) {
                this.$store.commit('SET_PRICE_DELIVERY', 500);
            } else {
                this.$store.commit('SET_PRICE_DELIVERY', 0);
            }

            console.log("this.priceDelivery");
            console.log(this.priceDelivery);
            // console.log(this.form.methodDelivery);

        },
        changePaymentMethods() {
            // console.log(this.form.methodPayment);
        },

        submit() {

            this.$store.commit('SET_LOADER', true);
            //Отправляем введенные данные на сервер через библиотеку AXIOS
            this.form.post('/api/v1/cart/save-form-order')
                .then(res => {
                    this.message = res.data.message;
                    this.status = res.data.success;


                    if (this.status) {

                        if (this.form.methodPayment === 3) {
                            let paymentUrl = res.data.paymentUrl;
                            window.location.href = paymentUrl;

                        } else {
                            this.isFormOrder = true;
                            this.numOrder = res.data.numOrder;
                            this.$store.commit('SET_STORE', res.data.cart);
                            //Чистим поля формы после успешной отправки
                            this.form.reset();
                        }
                    }
                    console.log(res);


                }).catch(err => {
                this.message = "Произошла ошибка при отправке формы!";


                console.log(err);


            })
                .finally(() => (this.$store.commit('SET_LOADER', false)));


        }
    }
}
</script>

<style lang="scss">
//@import "resources/sass/desktop/catalog/layouts/form_order_sparts.scss";

</style>
