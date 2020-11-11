import Vue from 'vue'
import Vuex from 'vuex'
import products from "./products";
import selectedItems from "./selectedItems";
import orders from "./orders";

Vue.use(Vuex)

export default new Vuex.Store({
    state: {},
    mutations: {},
    actions: {},
    modules: {
        products: products,
        selectedItems: selectedItems,
        orders: orders,
    }
})
