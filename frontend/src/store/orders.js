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
        changeOrderStatus(state, data) {
            const index = state.items.findIndex(item => {
                return item.id === data.id;
            });

            if (index > -1) {
                let order = state.items[index];
                order.status = data.status;
                let newItems = [...state.items];
                newItems.splice(index, 1, order);
                state.items = [...newItems];
            }
        },
        addOrder(state, order) {
            state.items.push(order);
        },
    },
    actions: {
        createOrder(store, data) {
            return new Promise((resolve) => {
                axios
                    .post('/orders', {
                        productIds: data,
                    })
                    .then(response => {
                        store.dispatch('getOrder', response.data);
                        resolve();
                    })
                    .catch(error => console.error(error));
            });
        },
        getOrder({ commit }, orderId) {
            return new Promise((resolve) => {
                axios
                    .get('/orders', {
                        params: {
                            id: orderId,
                        },
                    })
                    .then(response => {
                        commit('addOrder', response.data);
                        resolve();
                    })
                    .catch(error => console.error(error));
            });
        },
        getItems({ commit }) {
            return new Promise((resolve) => {
                axios
                    .get('/orders')
                    .then(response => {
                        commit('setItems', response.data);
                        resolve();
                    })
                    .catch(error => console.error(error));
            });
        },
        payOrder({ commit }, data) {
            return new Promise((resolve) => {
                axios
                    .post('/orders/pay', {
                        orderId: data.id,
                        orderSum: data.sum,
                    })
                    .then(response => {
                        response.data && commit('changeOrderStatus', response.data)
                        resolve();
                    })
                    .catch(error => console.error(error));
            });
        },
    },
}