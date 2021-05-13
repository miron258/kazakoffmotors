<template>
    <!---------------------- BLOCK SELECT PAYMENT METHOD ---------------------->
    <div class="box-left-form-order__block-select-payment-method block-select-payment-methods">
        <div class="block-select-payment-method__title-payment-method title-payment-methods">
            Выберите способ оплаты
        </div>


        <div
            class="block-select-payment-method__wrapper-custom-radios wrapper-custom-radios">

            <div v-if="isPaymentMoney" class="custom-control custom-radio custom-radio-payment">
                <input @change="changePaymentMethods" name="method_payment" v-model="form.methodPayment" :value=1
                       type="radio" class="custom-control-input" id="radioPayment1">
                <label class="custom-control-label" for="radioPayment1">
                    <span class="form-check-label__title-label title-label">Наличными</span>
                </label>
            </div>


            <div v-if="isPaymentCardShop" class="custom-control custom-radio custom-radio-payment">
                <input @change="changePaymentMethods" name="method_payment" v-model="form.methodPayment" :value=2
                       type="radio" class="custom-control-input" id="radioPayment2">
                <label class="custom-control-label" for="radioPayment2">
                                        <span
                                            class="form-check-label__title-label title-label">Оплата картой в магазине</span>
                    <ul class="list-payment-methods">
                        <li class="list-payment-methods__item-payment-method item-payment-method">
                            <img class="item-payment-method__img-payment-method img-payment-method"
                                 alt="Apple Pay"
                                 src="/img/tpl_img/img_shop/icons_order_payments/apple_pay_small.png">
                        </li>
                        <li class="list-payment-methods__item-payment-method item-payment-method">
                            <img class="item-payment-method__img-payment-method img-payment-method"
                                 alt="Master Card"
                                 src="/img/tpl_img/img_shop/icons_order_payments/master_card_small.png">
                        </li>
                        <li class="list-payment-methods__item-payment-method item-payment-method">
                            <img class="item-payment-method__img-payment-method img-payment-method"
                                 alt="Visa"
                                 src="/img/tpl_img/img_shop/icons_order_payments/visa_small.png">
                        </li>
                    </ul>
                </label>
            </div>

            <div v-if="isPaymentCardSite" class="custom-control custom-radio custom-radio-payment">
                <input @change="changePaymentMethods" name="method_payment" v-model="form.methodPayment" :value=3
                       type="radio" class="custom-control-input" id="radioPayment3">
                <label class="custom-control-label" for="radioPayment3">
                                        <span
                                            class="form-check-label__title-label title-label">Оплата картой на сайте</span>
                    <ul class="list-payment-methods">
                        <li class="list-payment-methods__item-payment-method item-payment-method">
                            <img class="item-payment-method__img-payment-method img-payment-method"
                                 alt="Apple Pay"
                                 src="/img/tpl_img/img_shop/icons_order_payments/apple_pay_small.png">
                        </li>
                        <li class="list-payment-methods__item-payment-method item-payment-method">
                            <img class="item-payment-method__img-payment-method img-payment-method"
                                 alt="Master Card"
                                 src="/img/tpl_img/img_shop/icons_order_payments/master_card_small.png">
                        </li>
                        <li class="list-payment-methods__item-payment-method item-payment-method">
                            <img class="item-payment-method__img-payment-method img-payment-method"
                                 alt="Visa"
                                 src="/img/tpl_img/img_shop/icons_order_payments/visa_small.png">
                        </li>
                    </ul>
                </label>
            </div>
        </div>


    </div>
    <!---------------------- END BLOCK SELECT PAYMENT METHOD ---------------------->
</template>

<script>
export default {
    name: "FormOrderPaymentMethods",
    props: ['form', 'isAddressDelivery', 'valueAddressDelivery'],
    data() {
        return {
            methodDelivery: this.form.methodDelivery,
            // methodPayment: this.form.methodPayment,
            isPaymentMoney: true,
            isPaymentCardSite: true,
            isPaymentCardShop: true
        }
    },
    watch: {
        isAddressDelivery: function (newValue, oldValue) {
            console.log("сработал watch isAddressDelivery");
            console.log(newValue, oldValue);

        },
        valueAddressDelivery: function (newValue, oldValue) {
            console.log("сработал watch valueAddressDelivery");
            console.log(newValue, oldValue);
            this.setMethodPayment(newValue)


            // switch (newValue) {
            //     case 2:
            //         this.isPaymentMoney = true;
            //         this.isPaymentCardSite = true;
            //         this.isPaymentCardShop = false;
            //         this.form.methodPayment = 1;
            //         break;
            //     case 3:
            //     case 4:
            //         this.isPaymentMoney = false;
            //         this.isPaymentCardSite = true;
            //         this.isPaymentCardShop = false;
            //         this.form.methodPayment = 3;
            //         break;
            //     default:
            //         this.isPaymentMoney = true;
            //         this.isPaymentCardSite = true;
            //         this.isPaymentCardShop = true;
            //         this.form.methodPayment = 1;
            //         break;
            // }

        },
    },
    methods: {
        changePaymentMethods() {
            this.$emit('onChangePaymentMethods');
        },
        setMethodPayment(methodDelivery = '') {

            this.methodDelivery = (methodDelivery !== '') ? methodDelivery : this.form.methodDelivery;

            switch (this.methodDelivery) {
                case 2:
                    this.isPaymentMoney = true;
                    this.isPaymentCardSite = true;
                    this.isPaymentCardShop = false;
                    this.form.methodPayment = 1;
                    break;
                case 3:
                case 4:
                    this.isPaymentMoney = false;
                    this.isPaymentCardSite = true;
                    this.isPaymentCardShop = false;
                    this.form.methodPayment = 3;
                    break;
                default:
                    this.isPaymentMoney = true;
                    this.isPaymentCardSite = true;
                    this.isPaymentCardShop = true;
                    this.form.methodPayment = 1;
                    break;
            }
        }

    },
    mounted() {
        this.setMethodPayment(this.methodDelivery);
        console.log("Зашел в payment methods component");
        console.log(this.form);
        console.log(this.isAddressDelivery);

    },
    components: {}
}
</script>

<style scoped>

</style>
