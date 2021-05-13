//Здесь мы собираем модули и экспортируем хранилище
import Vue from 'vue'
import Vuex from 'vuex'
import cart from './modules/cart'
import search from './modules/search'
import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';


Vue.use(Vuex);
Vue.use(VueToast);

export default new Vuex.Store({
    modules: {
        cart,
        search
    },
    plugins: [

    ]
});
