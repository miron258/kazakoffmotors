<template>
    <!----------------------- BLOCK PERSONAL DATA ------------------------>
    <div class="box-right-form-order___block-personal-data block-personal-data">

        <div v-if="isHeaderPersonal()" class="block-personal-data__header-personal-data header-personal-data">Введите данные получателя</div>
        <div v-text="setPersonalDataTitle()" class="block-personal-data__title-personal-data title-personal-data">
        </div>

        <slot name="helpBlock"></slot>

        <div v-bind:class="{'has-error' : form.errors.has('name')}"
             class="form-group row form-group-row">


            <div class="col-xl-6 col-lg-6 col-md-6 col-6 box-field-form">
                <ValidationProvider rules="required|min:3" v-slot="{ errors, valid, invalid }">
                    <input v-bind:class="getClassForm('name', errors[0], valid)" placeholder="Имя*"
                           name="name" v-model="form.name"
                           class="form-control form-control-name">
                    <div v-show="errors[0]" class="invalid-feedback">{{ errors[0] }}</div>
                    <has-error :form="form" field="name"></has-error>
                </ValidationProvider>
            </div>


            <div class="col-xl-6 col-lg-6 col-md-6 col-6 box-field-form">
                <ValidationProvider rules="required|min:4" v-slot="{ errors, valid, invalid }">
                    <input v-bind:class="getClassForm('surname', errors[0], valid)"
                           placeholder="Фамилия*"
                           name="surname" v-model="form.surname"
                           class="form-control form-control-surname">
                    <div v-show="errors[0]" class="invalid-feedback">{{ errors[0] }}</div>
                    <has-error :form="form" field="surname"></has-error>
                </ValidationProvider>
            </div>


        </div>


        <ValidationProvider rules="required|phoneNumber" v-slot="{ errors, valid }">
            <div v-bind:class="{'has-error' : form.errors.has('phone')}"
                 class="form-group form-group-phone">
<!--                <input v-on:focus="" is="maskedInput" placeholder="Телефон*" ref="inputPhone"-->
<!--                       class="form-control form-control-phone"-->
<!--                       v-bind:class="getClassForm('phone', errors[0], valid)" name="phone" v-model="form.phone"-->
<!--                       mask="\+\7 (111) 111-11-11"/>-->
                <input is="maskedInput" mask="\+\7 (111) 111-11-11" placeholder="Телефон*" ref="inputPhone"
                                       class="form-control form-control-phone"
                                       v-bind:class="getClassForm('phone', errors[0], valid)" name="phone" v-model="form.phone"
                                       />
<!--                <div v-show="errors[0]" class="invalid-feedback">{{ errors[0] }}</div>-->
                <has-error :form="form" field="phone"></has-error>
            </div>
        </ValidationProvider>

        <ValidationProvider rules="required|email" v-slot="{ errors, valid }">
            <div v-bind:class="{'has-error' : form.errors.has('email',  errors, valid)}"
                 class="form-group form-group-email">
                <input v-bind:class="getClassForm('email', errors[0], valid)" placeholder="Email*"
                       name="email" v-model="form.email"
                       class="form-control form-control-email">
                <div v-show="errors[0]" class="invalid-feedback">{{ errors[0] }}</div>
                <has-error :form="form" field="email"></has-error>
            </div>
        </ValidationProvider>

    </div>
    <!----------------------- END BLOCK PERSONAL DATA ------------------------>




</template>

<script>

//Import v-from
import {Form, HasError, AlertError, AlertErrors, AlertSuccess} from 'vform'
import MaskedInput from 'vue-masked-input'
////// VEE VALIDATE
import {ValidationProvider, validate, localize, ValidationObserver, extend} from 'vee-validate';
import PhoneNumber from 'awesome-phonenumber'
import {required, email} from 'vee-validate/dist/rules';
import ru from 'vee-validate/dist/locale/ru.json';
// Install Russian locales.
localize('ru', ru);


///Импортируем и создаем правила для полей
// No message specified.
extend('min', {
    validate(value, args) {
        return value.length >= args.length;
    },
    params: ['length']
});
extend('max', {
    validate(value, args) {
        return value.length <= args.length;
    },
    params: ['length']
});
extend('minmax', {
    validate(value, args) {
        const length = value.length;

        return length >= args.min && length <= args.max;
    },
    params: ['min', 'max']
});
extend('between', {
    params: ['min', 'max'],
    validate(value, {min, max}) {
        return value >= min && value <= max;
    },
    message: 'This field value must be between {min} and {max}'
});
const phoneNumber = {
    getMessage: field => `${field} не действительный номер телефона`,
    validate(value) {
        return new Promise(resolve => {
            let phone = new PhoneNumber(value);
            resolve({valid: phone.isValid()})
        })
    }
}
extend('phoneNumber', phoneNumber);
extend('email', email);
// Override the default message.
extend('required', required);

export default {
    name: "FormOrderPersonal",
    props: ['form', 'HasError', 'TheMask', 'AlertError', 'AlertErrors', 'AlertSuccess'],
    computed: {
        // classObjectForm: function() {
        //     return {
        //
        //     }
        // }
    },
    data() {
        return {
            // methodDelivery: this.form.methodDelivery,
            // methodPayment: this.form.methodPayment
        }
    },
    mounted() {

    },

    created() {

    },
    methods: {

setMask(obj){




    console.log(this.$refs.inputPhone);


    this.$refs.inputPhone.setAttribute("mask", "\\+\\7 (111) 111-11-11");
    this.$refs.inputPhone.setAttribute("is", "maskedInput");



},
        isHeaderPersonal() {
            if (this.$root.isMobile()) {
                return true;
            } else {
                return false;
            }
        },
        setPersonalDataTitle() {
            if (this.$root.isMobile()) {
                return "Контактное лицо";
            } else {
                return "Контактное лицо";
            }
        },
        getClassForm(field, errors, valid) {


            console.log("field, errors, valid");
            console.log(field, errors, valid);

            return {
                'is-invalid': this.form.errors.has(field) || errors,
                'is-valid': valid
            }
        }
    },
    components: {
        ValidationProvider,
        ValidationObserver,
        Form,
        MaskedInput,
        HasError,
        AlertError,
        AlertErrors,
        AlertSuccess
    }
}
</script>

<style scoped>

</style>
