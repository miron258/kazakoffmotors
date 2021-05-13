<template>
    <form class="form-count-product" method="post">
        <div class="form-group form-group-count-product">
            <slot name="labelCountProduct"></slot>
            <vue-number-input @change="change" size="small" id="number" placeholder="Default number input"
                              v-model="countProduct"
                              :min="1"
                              :max="1000" inline center controls></vue-number-input>
        </div>
    </form>
</template>

<script>
import VueNumberInput from '@chenfengyuan/vue-number-input';
import Vuex from 'vuex'
import {mapActions} from 'vuex'

export default {

    watch: {

        count: function (newValue, oldValue) {

            console.log("this.update");
            console.log(this.update);

            if (this.update) {
                this.countProduct = newValue;
            } else {
                this.$emit('onUpdateCountProduct', {
                    qty: newValue,
                    id: this.product.id
                })
            }
        },

        countProduct(newValue, oldValue){
            if (this.update) {
                this.countProduct = newValue;
            } else {
                this.$emit('onUpdateCountProduct', {
                    qty: newValue,
                    id: this.product.id
                })
            }
        }
    },
    props: {
        count: {
            type: Number,
            required: true
        },
        update: {
            type: Boolean,
            required: false
        },
        product: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            countProduct: this.count
        };
    },

    methods: {
        ...mapActions(['updateCart']),
        change(value) {
            this.product.qty = value;
            this.countProduct = value;
            if (this.update) {
                this.updateCart(this.product);
            }

        },
    },
    components: {VueNumberInput, Vuex}

};


</script>

<style lang="scss">
/////////// style spinner
.form-group-count-product {
    position: relative;
    width: max-content;


    //// Number Input
    .number-input.number-input--small.number-input--inline {
        .number-input__button {

        }

        .number-input__input {
            font-family: Montserrat;
            font-style: normal;
            color: #000000;
            border: 1px solid #DBE0E8;
            box-sizing: border-box;
        }


        .number-input__button--minus {
            border-right: 1px solid #dee4e6;

            &:before {
                background-color: #8E94A5;
            }

            &:after {
                background-color: #8E94A5;
            }
        }

        .number-input__button--plus {
            border-left: 1px solid #dee4e6;

            &:before {
                background-color: #8E94A5;
            }

            &:after {
                background-color: #8E94A5;
            }
        }
    }

    .number-input {


    }

    //// End Number Input
}

/////////// end style spinner
</style>
