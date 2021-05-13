import axios from 'axios'
import $ from 'jquery';  // подключаем jQuery
const state = {
    message: "",
    total: "",
    totalSum: "",
    type: '',
    totalSumNotDelivery: "",
    subTotalSum: "",
    totalSumOrig: "",
    product: "",
    products: "",
    productsInCart: [],
    priceDelivery: 0,
    loader: false
};
const getters = {
    totalSum: state => {

        if (state.priceDelivery>0){
            return Intl.NumberFormat().format(parseInt(state.totalSum+state.priceDelivery));
        }else {
            return Intl.NumberFormat().format(state.totalSum);
        }

    },
    totalSumNotDelivery: state =>Intl.NumberFormat().format(state.totalSum),
    //Общая сумма заказа
    subTotalSum: state => Intl.NumberFormat().format(state.subTotalSum), //Сумма заказа с учетом скидок
    priceDelivery: state => Intl.NumberFormat().format(state.priceDelivery), //Сумма доставки
    totalSumOrig: state => state.totalSum,
    total: state => state.total, //Общее кол-во товаров в корзине
    type: state => state.type,
    loader: state => state.loader, //Общее кол-во товаров в корзине
    message: state => state.message,
    product: state => state.product,
    products: state  => state.products, //Используем геттер как функцию чтобы отключить кэширование Все товары, находящиеся в корзине товаров
    productsInCart: state  => state.products //Используем геттер как функцию чтобы отключить кэширование Все товары, находящиеся в корзине товаров
};
const actions = {

    initStore: ({commit}) => {
        state.loader = true;
        axios.get('/api/v1/cart/content').then(
            response => {
                commit('SET_STORE', response.data);
            }).catch(e => {
            console.log(e);
        }).finally(() => {
            state.loader = false;
        });
    },
    updateCart: ({state, commit}, product) => {
        state.loader = true;

        axios.post('/api/v1/cart/update',
            {product}).then(
            response => {
                commit('SET_STORE', response.data);
            }).catch(e => {
        }).finally(() => {
            state.loader = false;
        });

    },

    /////Добавление товара в корзину товаров
    addToCart: ({state, commit}, product) => {
        state.loader = true;

        axios.post('/api/v1/cart', {product}).then(
            response => {

                console.log(response.data);

                if (response.data.success) {
                    commit('SET_STORE', response.data);

                    Vue.$toast.open({
                        message: response.data.message,
                        type: 'success',
                        position: 'top-right'
                        // all of other options may go here
                    });
                } else {
                    Vue.$toast.open({
                        message: "Не удалось добавить товар в корзину товаров!",
                        type: 'error',
                        position: 'top-right'
                        // all of other options may go here
                    });
                }


            }).catch(e => {


            console.log("Ошибка");

            console.log(e);
            Vue.$toast.open({
                message: "Не удалось добавить товар в корзину товаров!",
                type: 'error',
                position: 'top-right'
                // all of other options may go here
            });

        }).finally(() => {
            state.loader = false;
        });
    },


    ////Удаление товара из корзины товаров
    deleteProduct: ({state, commit}, id) => {
        state.loader = true;
        axios.delete('/api/v1/cart/' + id).then(
            response => {
                // this.message = response.data.message;
                let status = response.data.success;
                if (status) {
                    commit('SET_STORE', response.data);
                } else {
                    console.log("Ошибка удаления");
                    state.products = [];
                }
            }).catch(e => {

            console.log(e);
        }).finally(() => {
            state.loader = false;
        });
    }


};
const mutations = {
    'SET_STORE'(state, cart) {
        state.totalSum = cart.totalSum;
        state.subTotalSum = cart.subTotalSum;
        state.product = cart.product;
        state.type = cart.type;
        // state.priceDelivery = cart.priceDelivery;



        /// Делаем мутацию надо списком товаров в корзине
        if (cart.products) {
            state.products = cart.products;
        } else {
            state.products = [];
        }



        console.log("cart.products");
        console.log(cart.products);

        state.total = cart.total;
        state.message = cart.message;
    },
    // 'SET_PRODUCTS'(state, products){
    //     state.products = products;
    // },
    'SET_PRICE_DELIVERY'(state, priceDelivery){
        state.priceDelivery = priceDelivery;
    },
    'SET_LOADER'(state, status){
        state.loader = status;
    }
};


export default {
    state,
    getters,
    actions,
    mutations
}
