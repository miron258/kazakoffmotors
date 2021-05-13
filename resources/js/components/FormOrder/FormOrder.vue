<template>
    <div class="container-form-order">
        <div v-show="loader" class="loader-gif">
            <img src="/img/tpl_img/ajax.gif" class="ajax-loader"/>
        </div>
        <div v-html="message" class="message-form-order"></div>


        <form v-if="!isFormOrder" @keydown="form.onKeydown($event)" @submit.prevent="submit" method="post"
              class="form-order">
            <div class="form-order__row-boxes-form-order row row-boxes-form-order">


                <div class="col-xl-6 col-lg-6 col-md-6 row-boxes-form-order__wrapper-left-box wrapper-left-box">

                    <div class="wrapper-left-box wrapper-left-box__box-left-form-order box-left-form-order">

                        <h2 class="box-left-form-order__title-box title-box">
                            Доставка и оплата
                        </h2>


                        <form-order-delivery-methods @onChangeMethodDelivery="changeMethodDelivery"
                                                     v-bind:form="form"></form-order-delivery-methods>
                        <form-order-payment-methods @onChangePaymentMethods="changePaymentMethods"
                                                    v-bind:value-address-delivery="form.methodDelivery"
                                                    v-bind:is-address-delivery="isAddressDelivery"
                                                    v-bind:form="form"></form-order-payment-methods>


                    </div>


                </div>


                <div class="col-xl-6 col-lg-6 col-md-6 row-boxes-form-order__wrapper-right-box wrapper-right-box">

                    <div class="wrapper-right-box__box-right-form-order box-right-form-order">

                        <h2 class="box-right-form-order__title-box title-box">
                            Персональные данные
                        </h2>

                        <form-order-personal v-bind:form="form">
                            <template slot="helpBlock">
                                <div class="title-notification-form">
                                    Поля, отмеченные * обязательны для заполнения.
                                </div>
                            </template>
                        </form-order-personal>
                        <form-order-address-delivery v-bind:method-delivery="form.methodDelivery" v-bind:cities="cities"
                                                     v-if="isAddressDelivery"
                                                     v-bind:form="form">
                            <template slot="helpBlock">
                                <div class="title-notification-form">
                                    Поля, отмеченные * обязательны для заполнения.
                                </div>
                            </template>
                        </form-order-address-delivery>
                    </div>

                </div>


            </div>


            <!-------------------------- ROW BOX TEXT ORDER ------------------------>
            <div class="form-order__row-boxes-text-order row row-boxes-text-order">


                <div class="col-xl-8 col-lg-8 row-box-text-order__wrapper-box-text-order wrapper-box-text-order">

                    <div v-bind:class="{'has-error' : form.errors.has('textOrder')}"
                         class="form-group form-group-text-order">
                        <label class="label-text-order" for="textOrder">Комментарий к заказу</label>
                        <textarea :class="{ 'is-invalid': form.errors.has('textOrder') }" name="text_order"
                                  v-model="form.textOrder"
                                  class="form-control form-control-text-order" id="textOrder"></textarea>
                        <has-error :form="form" field="textOrder"></has-error>
                    </div>

                </div>


                <div
                    class="col-xl-4 col-lg-4 row-box-text-order__wrapper-box-total-price-order wrapper-box-total-price-order">

                    <div class="wrapper-box-total-price-order__block-total-price block-total-price">
                        <div class="block-total-price__total-price-sum total-price-sum">
                            <span class="total-price-text">Итого:</span>
                            <span v-if="totalSum" class="total-price">
                                <span v-text="totalSum" class="total-price__price price"></span>
                                <span class="total-price__ruble ruble">p</span>
                            </span>
                        </div>

                        <div v-if="priceDelivery>0" class="block-total-price__total-price-order total-price-order">
                            <span class="total-price-text">Заказ:</span>
                            <span v-if="totalSum" class="total-price">
                                <span v-text="totalSumNotDelivery" class="total-price__price price"></span>
                                <span class="total-price__ruble ruble">p</span>
                            </span>
                        </div>

                        <div v-if="priceDelivery>0"
                             class="block-total-price__total-price-delivery total-price-delivery">
                            <span class="total-price-text">Доставка:</span>
                            <span class="total-price">
                                <span v-text="priceDelivery" class="total-price__price price"></span>
                                <span class="total-price__ruble ruble">p</span>
                            </span>
                        </div>
                    </div>


                    <button :disabled='!isValidate'
                            class="wrapper-box-total-price-order__button-form-order button-form-order">
                        оформить
                    </button>

                </div>


            </div>
            <!-------------------------- END ROW BOX TEXT ORDER ------------------------>

        </form>


        <div v-else class="form-order-success">
            <img class="icon-check-order img-fluid" alt="Заказ оформлен" src="/img/tpl_img/check_order.png">
            <div v-if="numOrder" class="form-order-success__title-form-order-success title-form-order-success">
                Заказ № <span v-text="numOrder" class="num-order"></span> оформлен.
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
////// VEE VALIDATE
// import {ValidationProvider, localize, ValidationObserver, extend} from 'vee-validate';
// import VeeValidateLaravel from 'vee-validate-laravel';
// import {required, email} from 'vee-validate/dist/rules';
// import ru from 'vee-validate/dist/locale/ru.json';
// // Install Russian locales.
// localize('ru', ru);
//
// ///Импортируем и создаем правила для полей
// // No message specified.
// extend('email', email);
// // Override the default message.
// extend('required', required);

export default {
    name: "FormOrder",
    props: ['cities'],
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
        AlertSuccess
    },
    mounted() {


    },
    computed: {
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
            form: new Form({
                methodDelivery: 1, //Способ доставки
                methodPayment: 1, //Способ оплаты
                priceDelivery: this.$store.priceDelivery,
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
        hide() {

        },
        changeMethodDelivery() {
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
