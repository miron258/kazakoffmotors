//Registered Components Vue JS
// npm run
window.Vue = require('vue');
/// Vue Scripts Site
Vue.config.devtools = true;
import store from './store/index';
import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '378e605b8b1e16d38848',
    cluster: 'mt1',
    encrypted: false
});

window.widthDisplay = window.innerWidth;


////////////// ROUTING
// import VueRouter from 'vue-router'
// Vue.use(VueRouter)

// const routes = [
//     { path: '/foo', component: Foo },
//     { path: '/bar', component: Bar }
// ]
// const router = new VueRouter({
//     // routes // сокращённая запись для `routes: routes`
// })
////////////// END ROUTING


Vue.prototype.isMobile = function () {
    let check = false;
    (function (a) {
        if (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0, 4))) check = true;
    })(navigator.userAgent || navigator.vendor || window.opera);
    return check;
}

// window.appOrder = new Vue({
//     el: '#app-cart',
//     // router,
//     store: store,
//     components: {
//         /////// Tabs Products
//         'products-tab': require('./Tabs/ProductsTab').default,
//         'form-order-mobile': require('./FormOrder/FormOrderMobile').default,
//         //// End Form Order Component
//     },
//
// }).$mount('#app-cart');
import AOS from 'aos'
import 'aos/dist/aos.css'

window.app = new Vue({
    el: '#app',
    // router,
    store: store,
    created() {
        AOS.init({
                disable: window.innerWidth < 1024
            }
        )
    },
    components: {
        'slick-carousel-our-work': require('./SlickCarouselOurWork.vue').default,
        'slick-carousel-evacuation': require('./SlickCarouselEvacuation.vue').default,
        'slick-carousel-our-work-thumbnails': require('./SlickCarouselOurWorkThumbnails.vue').default,
        'slick-carousel-portfolio': require('./SlickCarouselPortfolio/SlickCarouselPortfolio').default,
        'slick-carousel-custom-gallery': require('./SlickCarouselCustomGallery.vue').default,
        'slick-carousel-contacts': require('./SlickCarouselContacts.vue').default,
        'slick-carousel-main-page': require('./SlickCarouselOurWorkMainPage/SlickCarouselMainPage').default,
        'input-number-spinner': require('./spinner/InputNumberSpinner').default,
        'slick-carousel-custom-gallery-thumbnails': require('./SlickCarouselCustomGalleryThumbnails').default,
        'mmenu-mobile': require('./MmenuMobile').default,

        'form-order-spare-parts': require('./FormOrderSpareParts/FormOrderSpareParts').default,
        'modal-delivery': require('./ModalDelivery/ModalDelivery').default,


        /////// Tabs Products
        'products-tab': require('./Tabs/ProductsTab').default,
        'products-tab-mobile': require('./Tabs/ProductsTabMobile').default,
        /////// End Tabs Products

        /////// Products Components
        'products': require('./Products/Products').default,
        'product': require('./Product/Product').default,
        'productMobile': require('./Product/ProductMobile').default,
        'slickCarouselImgsProduct': require('./SlickCarouselImgsProduct/SlickCarouselImgsProduct').default,
        /////// End Products Components


        ////// Fixed Header Custom
        'fixed-header-custom': require('./FixedHeader/FixedHeaderCustom').default,
        ////// End Fixed Header Custom

        //// Form Order Component
        'form-order': require('./FormOrder/FormOrder').default,
        'form-order-mobile': require('./FormOrder/FormOrderMobile').default,
        //// End Form Order Component

        ////// Cart Components
        'header-cart': require('./HeaderCart/HeaderCart').default,
        'cart': require('./Cart/Cart').default,
        'cart-mobile': require('./Cart/CartMobile').default,
        ////// End Cart Components

        ////////// Live Search Components
        'search': require('./Search/Search').default
        ////////// End Live Search Components


    },

}).$mount('#app');

console.log(Vue.mixins);

////// Хранилище состояний Vuex Store
///// Обращение к переменных Vuex в шаблонизаторе Blade $store.state.{название переменной}


window.vue2PanelDebug = true;
window.__VUE_DEVTOOLS_GLOBAL_HOOK__.Vue = app.constructor;


// import renderVueComponentToString from 'vue-server-renderer/basic';


// renderVueComponentToString(app, (err, html) => {
//     if (err) {
//         throw new Error(err);
//     }
//
//     dispatch(html);
// });

// Шаг 2: Создаём рендерер
// const renderer = require('vue-server-renderer').createRenderer()

// Шаг 3: Рендерим экземпляр Vue в HTML
// renderer.renderToString(app, (err, html) => {
//     if (err) throw err
//     console.log(html)
//     // => <div data-server-rendered="true">Hello World</div>
// })

// с версии 2.5.0+, возвращает Promise если коллбэк не указан:
// renderer.renderToString(app).then(html => {
//     console.log(html)
// }).catch(err => {
//     console.error(err)
// })


