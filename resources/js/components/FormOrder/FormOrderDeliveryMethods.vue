<template>
    <!---------------------- BLOCK SELECT DELIVERY METHOD ---------------------->
    <div class="box-left-form-order__block-select-delivery-method block-select-delivery-method">


        <div class="block-select-delivery-method__title-delivery-method title-delivery-method">
            Выберите способ доставки
        </div>

        <div
            class="block-select-delivery-method__wrapper-custom-radios wrapper-custom-radios">

            <div class="custom-control custom-radio custom-radio-delivery">
                <input @change="changeMethodDelivery" name="method_delivery" v-model.lazy="form.methodDelivery" :value=1
                       type="radio" class="custom-control-input" id="radioDelivery1">
                <label class="custom-control-label" for="radioDelivery1">
                    <span class="form-check-label__title-label title-label">Самовывоз</span>
                    <span class="form-check-label__text-label text-label">
                                        Вы можете самостоятельно забрать заказ<br>
                                        из нашего магазина.
                                    </span>
                </label>
            </div>

            <div class="custom-control custom-radio custom-radio-delivery">
                <input @change="changeMethodDelivery" name="method_delivery" v-model.lazy="form.methodDelivery" :value=2
                       type="radio" class="custom-control-input" id="radioDelivery2">
                <label class="custom-control-label" for="radioDelivery2">
                    <span class="form-check-label__title-label title-label">Доставка курьером по Москве</span>
                    <span class="form-check-label__text-label text-label">
                                        Доставка осуществляется в течение дня<br>
                                        в удобное для вас время.
                                    </span>
                </label>
            </div>

            <div class="custom-control custom-radio custom-radio-delivery">
                <input @change="changeMethodDelivery" name="method_delivery" v-model.lazy="form.methodDelivery" :value=3
                       type="radio" class="custom-control-input" id="radioDelivery3">
                <label class="custom-control-label" for="radioDelivery3">
                                        <span
                                            class="form-check-label__title-label title-label">Почта России (от 250 ₽)</span>
                    <span class="form-check-label__text-label text-label">
                                        Стоимость доставки будет рассчитана менеджером после
                                        оформления заказа и включена как наложенный платеж.
                                    </span>
                </label>
            </div>

            <div class="custom-control custom-radio custom-radio-delivery">
                <input @change="changeMethodDelivery" name="method_delivery" v-model.lazy="form.methodDelivery" :value=4
                       type="radio" class="custom-control-input" id="radioDelivery4">
                <label class="custom-control-label" for="radioDelivery4">
                    <span class="form-check-label__title-label title-label">EMS Почта России (от 650 ₽)</span>
                    <span class="form-check-label__text-label text-label">
                                        Стоимость доставки будет рассчитана менеджером после
                                        оформления заказа и включена как наложенный платеж.
                                    </span>
                </label>
            </div>
        </div>

        <div class="block-select-delivery-method__note-delivery-method note-delivery-method">
            Также можно выбрать альтернативные способы доставки <br>
            различными транспортными компаниями.<br>
            Подробности уточняйте у менеджеров по телефону <br><a class="link-phone-number"
                                                                  href="tel:+74957664703">+7
            (495) 766-47-03</a>
        </div>

    </div>
    <!---------------------- END BLOCK SELECT DELIVERY METHOD ---------------------->
</template>

<script>
export default {
    name: "FormOrderDeliveryMethods",
    watch: {
        // methodDelivery: function (newValue, oldValue) {
        //     console.log("сработал watch methodDelivery");
        //     console.log(newValue, oldValue);
        //
        // }
    },
    data(){
        return {
            methodDelivery: this.form.methodDelivery
        }
    },
    methods: {
        changeMethodDelivery() {
            this.$emit('onChangeMethodDelivery');
        }
    },
    props: ['form'],
    components: {}
}
</script>

<style scoped>

</style>
