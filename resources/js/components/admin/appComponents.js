//Registered Components Vue JS
// window.Vue = require('vue/dist/vue.min.js');
window.Vue = require('vue');
/// Vue Scripts Site
Vue.config.devtools = true;
// import store from '../store/index';


window.app = new Vue({
    el: '#app-vue',
    // store: store,
    components: {
        'gallery': require('./Gallery/Gallery').default,
        'dropzone-gallery': require('./Gallery/DropzoneGallery').default,
        'transliterate': require('./Transliterate/Transliterate').default,
        'gallery-images': require('./Gallery/GalleryImages').default,
        'currency-converter': require('./CurrencyConverter/CurrencyConverter').default,
        'tiny-mce': require('./TinyMCE/TinyMce').default,


    },

}).$mount('#app-vue');

console.log(Vue);

////// Хранилище состояний Vuex Store
///// Обращение к переменных Vuex в шаблонизаторе Blade $store.state.{название переменной}
window.vue2PanelDebug = true;
window.__VUE_DEVTOOLS_GLOBAL_HOOK__.Vue = app.constructor;



