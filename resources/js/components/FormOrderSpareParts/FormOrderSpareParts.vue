<template>
    <div class="container-form-spare-part">
        <div v-show="loader" class="loader-gif">
            <img src="/img/tpl_img/ajax.gif" class="ajax-loader"/>
        </div>
                <div v-html="message" class="message-order-spare-part"></div>
        <form @keydown="form.onKeydown($event)" @submit.prevent="submit" method="post" class="form-send-spare-part"
              ref="formSpareParts">

            <div v-bind:class="{'has-error' : form.errors.has('spart')}" class="form-group form-group-spare-part">
                <input v-model="form.spart" :class="{ 'is-invalid': form.errors.has('spart') }" type="text" name="spart"
                       class="form-control form-control-spare-part"
                       placeholder="Какая нужна запчасть?">
                <has-error :form="form" field="spart"></has-error>
            </div>

            <div v-bind:class="{'has-error' : form.errors.has('name')}" class="form-group form-group-fio">
                <input v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" type="text" name="name"
                       class="form-control form-control-fio" placeholder="Ваше имя">
                <has-error :form="form" field="name"></has-error>
            </div>

            <div v-bind:class="{'has-error' : form.errors.has('phone')}" class="form-group form-group-phone">
                <masked-input placeholder="Ваш номер телефона" type="tel" ref="inputPhone" class="form-control form-control-phone" v-bind:class="{ 'is-invalid': form.errors.has('phone') }" name="phone" v-model="form.phone" mask="\+\7 (111) 111-11-11" />
                <has-error :form="form" field="phone"></has-error>
            </div>

            <div v-bind:class="{'has-error' : form.errors.has('email')}" class="form-group form-group-email">
                <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" type="text" name="email"
                       class="form-control form-control-email" placeholder="Ваш E-mail">
                <has-error :form="form" field="email"></has-error>
            </div>
            <div class="form-group form-group-bt-send">
                <button type="submit" class="btn btn-send-form">Отправить</button>
            </div>
        </form>

    </div>
</template>

<script>
//Import v-from
import {Form, HasError, AlertError, AlertErrors, AlertSuccess} from 'vform'
import MaskedInput from 'vue-masked-input'
window.Form = Form;


export default {
    name: "FormOrderSpareParts",
    components: {
        Form,
        MaskedInput,
        HasError,
        AlertError,
        AlertErrors,
        AlertSuccess
    },
    mounted() {

        

    },
    computed: {},
    data() {
        return {
            message: null,
            loader: false,
            form: new Form({
                name: '',
                spart: '',
                phone: '',
                email: ''
            })
        }
    },
    methods: {
        hide() {

        },
        submit() {

            this.loader = true;
            //Отправляем введенные данные на сервер через библиотеку AXIOS
            this.form.post('/api/v1/saveformspart')
                .then(res => {
                    this.message = res.data.message;
                    this.status = res.data.success;

                    if (this.status) {
                        //Чистим поля формы после успешной отправки
                        this.form.reset();
                    }
                    console.log(res);


                }).catch(err => {
                this.message = "Произошла ошибка при отправке формы!";
                this.loader = false;

                console.log(err);


            })
                .finally(() => (this.loader = false));


        }
    }
}
</script>

<style lang="scss">
@import "resources/sass/desktop/catalog/layouts/form_order_sparts.scss";

</style>
