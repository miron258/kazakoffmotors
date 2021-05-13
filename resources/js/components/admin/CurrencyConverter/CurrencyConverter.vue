<template>

    <div class="container-form-currency-converter">
            <div  class="form-group form-group-price-usd">
                <div v-show="loader" class="loader-gif">
                    <img src="/img/tpl_img/ajax.gif" class="ajax-loader"/>
                </div>
                <label style="display: block;" for="priceUsd">Цена $ ЦЕНТЫ ЧЕРЕЗ ТОЧКУ</label>
                <input id="priceUsd" v-model="price"
                       type="text" name="price_usd"
                       class="form-control form-control-email" placeholder="Цена в долларах">
                <div v-if="message" style="color: red" v-html="message"></div>
            </div>
            <div class="form-group form-group-bt-send">
                <button @click.prevent="convert" type="submit" class="btn btn-primary btn-send-form">Конвертировать</button>
            </div>
    </div>

</template>

<script>
import axios from "axios"
import {Form, HasError, AlertError, AlertErrors, AlertSuccess} from 'vform'

export default {
    name: "CurrencyConverter",
    props: ['priceUsd'],
    components: {
        Form,
        axios,
        HasError,
        AlertError,
        AlertErrors,
        AlertSuccess
    },


    data() {
        return {
            message: null,
            loader: false,
            price: this.priceUsd,
            wrapping: null,
            // form: new Form({
            //     priceUsd: null,
            //     fromCurrency: 'USD',
            //     toCurrency: 'RUB'
            // })
        }
    },
    mounted() {

        let wrapping =document.getElementById('wrapping').value;

        console.log("elementWrapping");
        console.log(wrapping);

this.wrapping = wrapping;

    },
    methods: {
        convert() {
            this.loader = true;

            axios.post('/api/v1/product/convert',
                {'priceUsd': this.price, 'wrapping': document.getElementById('wrapping').value}).then(
                response => {
                    console.log(response);

                    this.message = response.data.message;
                    this.status = response.data.success;

                    if (this.status) {
                        let price = response.data.price;
                        let elementInputPrice = document.getElementById('price');

                        elementInputPrice.value = price;
                    }
                }).catch(e => {
            }).finally(() => {
                this.loader = false;
            });



            //Отправляем введенные данные на сервер через библиотеку AXIOS
            // this.form.post('/api/v1/product/convert')
            //     .then(response => {
            //
            //
            //         // console.log(res);
            //
            //
            //     }).catch(err => {
            //
            //     this.loader = false;
            //
            //     console.log(err);
            //
            //
            // })
            //     .finally(() => (this.loader = false));


        }
    },
    computed: {}
}
</script>

<style lang="scss">
.container-form-currency-converter {

    .form-group-price-usd {

        /****************** AJAX LOADER *******************/
        .loader-gif {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1000;
            background-color: #fff;
            opacity: 0.8;

            .ajax-loader {
                position: absolute;
                left: 0;
                right: 0;
                top: 50%;
                transform: translateY(-50%);
                margin-left: auto;
                margin-right: auto;
                display: block;
            }
        }

        /****************** END AJAX LOADER *******************/
    }
}
</style>
