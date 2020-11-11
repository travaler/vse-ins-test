export default {
    namespaced: true,
    state: {
        items: [],
    },
    mutations: {
        setItems(state, items) {
            state.items = items;
        },
    },
    getters: {
        getItems(state) {
            return state.items;
        },
    },
}