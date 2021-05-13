<template>
    <modal :name="name"
           :adaptive="adaptive"
           :classes="classes"
           :width="modalWidth"
           :height="height"
           :dialog=true
           :focusTrap="focusTrap"
           :scrollable="scrollable"
           :draggable="draggable"
           :resizable="resizable"
           :reset="reset"
           :clickToClose="clickToClose">


        <!--        <div slot="top-right">-->
        <!--            <button class="v-modal-close" @click="$modal.hide('modal-video')"></button>-->
        <!--        </div>-->
        <div class="dialog-content">

            <div class="header-modal-delivery">
                <div class="title-modal-delivery">Способы доставки</div>
                <button @click="$modal.hide('modal-delivery')" class="button-close-modal" type="button"></button>
            </div>

            <ul class="list-delivery-methods">
                <li class="list-delivery-methods__item-delivery item-delivery">
                    <div class="item-delivery__title-delivery title-delivery">Самовывоз из нашего офиса в г. Москва
                    </div>
                    <div class="item-delivery__text-delivery text-delivery">по адресу Пр-д Березовой Рощи, 10<br>
                        (пн-пт с 10:00 до 20:00)
                    </div>
                </li>
                <li class="list-delivery-methods__item-delivery item-delivery">
                    <div class="item-delivery__title-delivery title-delivery">Доставка курьером по Москве</div>
                    <div class="item-delivery__text-delivery text-delivery">Доставка осуществляется в течение дня<br>
                        в удобное для вас время, стоимость - 500₽
                    </div>
                </li>
                <li class="list-delivery-methods__item-delivery item-delivery">
                    <div class="item-delivery__title-delivery title-delivery">Доставка транспортными компаниями</div>
                    <div class="item-delivery__text-delivery text-delivery">Стоимость доставки будет рассчитана
                        менеджером<br>
                        после оформления заказа.
                    </div>
                </li>
            </ul>


        </div>


    </modal>
</template>

<script type="module">
import VModal from 'vue-js-modal'
import 'vue-js-modal/dist/styles.css'

Vue.use(VModal);
const MODAL_WIDTH = 832

export default {
    name: "ModalDelivery",
    // props: ['minHeight', 'maxWidth', 'minWidth'],
    mounted() {


    },
    created() {
        this.modalWidth =
            window.innerWidth < MODAL_WIDTH ? MODAL_WIDTH / 2 : MODAL_WIDTH
    },
    data() {
        return {
            modalWidth: MODAL_WIDTH,
            name: "modal-delivery", //String required Обязательно для заполнения свойство
            classes: "v-modal-delivery", //String | Array
            scrollable: true, //Boolean
            focusTrap: true, //Boolean
            draggable: false, //Boolean
            resizable: false, //Boolean
            reset: true, //Boolean Resets position and size before showing
            clickToClose: true, //Boolean If set to false, it will not be possible to close modal by clicking on the background or by pressing Esc key.
            maxHeight: "",
            height: "auto",
            styles: "", //String | Array | Object
            adaptive: true
        }
    },
    computed: {},
    methods: {
        show() {

            // this.$modal.show('dialog', {
            //     title: 'The standard Lorem Ipsum passage',
            //     text: 'Lorem ipsum dolor sit amet, ...',
            //     buttons: [
            //         {
            //             title: 'Cancel',
            //             handler: () => {
            //                 this.$modal.hide('dialog')
            //             }
            //         },
            //         {
            //             title: 'Like',
            //             handler: () => {
            //                 alert('Like action')
            //             }
            //         },
            //         {
            //             title: 'Repost',
            //             handler: () => {
            //                 alert('Repost action')
            //             }
            //         }
            //     ]
            // });


            this.$modal.show('modal-delivery');
        },
        hide() {
            this.$modal.hide('modal-delivery');
        },
        //Access Events
        beforeOpen(event) {
            console.log('Opening...')
        },
        beforeClose(event) {
            console.log('Closing...')

        }
    }
}
</script>

<style lang="scss">
.vm--container {
    .vm--overlay {
        background: rgba(11, 25, 31, 0.8);

        .vm--top-right-slot {

            .v-modal-close {

            }
        }
    }
}

.vm--modal.v-modal-delivery {
    box-shadow: 4px 4px 5px rgba(0, 0, 0, 0.15);

    @import "resources/sass/desktop/catalog/layouts/modal_delivery";
    @media (max-width: 576px) {
        @import "resources/sass/mobile/catalog/layouts/modal_delivery";
    }

    .vue-dialog-buttons {
        .vue-dialog-button {

        }
    }


}


</style>
