<template>
    <!----------------------- BLOCK ADDRESS DELIVERY ------------------------>
    <div class="box-right-form-order__block-address-delivery block-address-delivery">

        <div class="block-address-delivery__title-address-delivery title-address-delivery">Адрес
            доставки
        </div>

        <slot name="helpBlock"></slot>

        <ValidationProvider rules="required|min:2" v-slot="{ errors, valid }">
            <div v-bind:class="{'has-error' : form.errors.has('city')}"
                 class="form-group form-group-select-city">
                <model-select :aria-readonly="true" autocomplete="off" name="city" class="form-control-city" :options="listCities"
                              v-model="form.city" placeholder="Город*">
                </model-select>
                <div v-show="errors[0]" class="invalid-feedback">{{ errors[0] }}</div>
                <has-error :form="form" field="city"></has-error>
            </div>
        </ValidationProvider>

        <ValidationProvider rules="required|min:3" v-slot="{ errors, valid }">
            <div v-bind:class="{'has-error' : form.errors.has('street')}"
                 class="form-group form-group-street">
                <input v-bind:class="getClassForm('street', errors[0], valid)" placeholder="Улица*"
                       name="street" class="form-control form-control-street"
                       v-model="form.street">
                <div v-show="errors[0]" class="invalid-feedback">{{ errors[0] }}</div>
                <has-error :form="form" field="street"></has-error>
            </div>
        </ValidationProvider>


        <div v-bind:class="{'has-error' : form.errors.has('houseNum')}"
             class="form-group form-group-row row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-6 box-field-form">
                <ValidationProvider rules="required" v-slot="{ errors, valid }">
                    <input v-bind:class="getClassForm('houseNum', errors[0], valid)" placeholder="Дом*"
                           name="house_num" v-model="form.houseNum"
                           class="form-control form-control-house-num">
                    <div v-show="errors[0]" class="invalid-feedback">{{ errors[0] }}</div>
                    <has-error :form="form" field="houseNum"></has-error>
                </ValidationProvider>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-6 box-field-form">
                <input :class="{ 'is-invalid': form.errors.has('corps') }" placeholder="Корпус"
                       name="corps" v-model="form.corps"
                       class="form-control form-control-corps">
                <has-error :form="form" field="corps"></has-error>
            </div>
        </div>


        <div v-bind:class="{'has-error' : form.errors.has('structure')}"
             class="form-group form-group-row row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-6 box-field-form">
                <input :class="{ 'is-invalid': form.errors.has('structure') }"
                       placeholder="Строение" name="structure" v-model="form.structure"
                       class="form-control form-control-structure">
                <has-error :form="form" field="structure"></has-error>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-6 box-field-form">
                <input :class="{ 'is-invalid': form.errors.has('office') }" placeholder="Офис"
                       name="office" v-model="form.office"
                       class="form-control form-control-office">
                <has-error :form="form" field="office"></has-error>
            </div>
        </div>


        <ValidationProvider rules="required" v-slot="{ errors, valid }">
            <div v-bind:class="{'has-error' : form.errors.has('zipCode')}"
                 class="form-group form-group-zip-code">
                <input v-bind:class="getClassForm('zipCode', errors[0], valid)"
                       placeholder="Почтовый индекс*" name="zip_code"
                       class="form-control form-control-zip-code" v-model="form.zipCode">
                <div v-show="errors[0]" class="invalid-feedback">{{ errors[0] }}</div>
                <has-error :form="form" field="zipCode"></has-error>
            </div>
        </ValidationProvider>

    </div>


    <!----------------------- END BLOCK ADDRESS DELIVERY ------------------------>
</template>

<script>
//Import v-from
import {Form, HasError, AlertError, AlertErrors, AlertSuccess} from 'vform'
import {ModelSelect} from 'vue-search-select'
import 'vue-search-select/dist/VueSearchSelect.css'

import DisableAutocomplete from 'vue-disable-autocomplete';
////// VEE VALIDATE
import {ValidationProvider, validate, localize, ValidationObserver, extend} from 'vee-validate';
import VeeValidateLaravel from 'vee-validate-laravel';
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

extend('email', email);
// Override the default message.
extend('required', required);


export default {
    name: "FormOrderAddressDelivery",
    props: ['form', 'cities', 'methodDelivery'],
    mounted() {

        // console.log(this.cities);
        console.log(this.listCities);

    },
    computed: {
        listCities() {

            if (this.form.methodDelivery === 2) {
                this.form.city = 524894;
            } else {
                this.form.city = null;
            }

            if (this.cities) {
                let cities = JSON.parse(this.cities);
                return cities.map(function (city) {

                    city.text = city.name;
                    city.value = city.code;

                    // product.name = product.name + " " + product.art;
                    // product.pathImg = (product.img !== '') ? "/storage/products/thumbs/" + product.img : "";
                    // product.url = "/product/" + product.url;
                    return city;
                });
            }

        }
    },
    methods: {
        getClassForm(field, errors, valid) {
            return {
                'is-invalid': this.form.errors.has(field) || errors,
                'is-valid': valid
            }
        },
        reset() {

        },
        selectFromParentComponent1() {
            // select option from parent component

        },
        reset2() {

        },
        selectFromParentComponent2() {
            // select option from parent component

        }
    },
    components: {
        DisableAutocomplete,
        ValidationProvider,
        ValidationObserver,
        VeeValidateLaravel,
        ModelSelect,
        Form,
        HasError,
        AlertError,
        AlertErrors,
        AlertSuccess
    }
}
</script>

<style scoped>

</style>
