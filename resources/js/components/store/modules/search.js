import axios from "axios";

let state = {
    loaderSearch: false,
    isCloseSearch: false,
    productsSearch: []
};
let getters = {
    productsSearch: state => {
        return state.productsSearch
    },
    loaderSearch: state => {
        return state.loaderSearch
    },
    isCloseSearch: state=>{
        if (state.productsSearch.length>0){
            return true;
        }
        return false;
    }
};
let actions = {

    /////Поиск товаров
    SEARCH_PRODUCTS({commit}, query) {
        state.loaderSearch = true;
        axios.post('/api/v1/search-result', {'query': query})
            .then(response => {
                let status = response.data.success;
                if (status) {
                }
            }).catch(err => {
            console.log(err)
        })
            .finally(() => {
                state.loaderSearch = false;
            });
    },

};
let mutations = {
    'SET_PRODUCTS'(state, products) {
        state.productsSearch = products;
        state.loaderSearch = false;
    }
};
export default {
    state,
    getters,
    actions,
    mutations
}
