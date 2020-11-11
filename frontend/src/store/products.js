import axios from 'axios';

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
    actions: {
        getItems({ commit }) {
            return new Promise((resolve) => {
                axios
                    .get('/products')
                    .then(response => {
                        commit('setItems', response.data);
                        resolve();
                    })
                    .catch(error => console.error(error));
            });
        },
    },
}