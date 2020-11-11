<template>
    <div>
        <template v-if="isLoading">
            <p>Loading ...</p>
        </template>
        <template v-else>
            <table>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Status</th>
                    <th>Sum</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <template v-for="order in orders">
                    <tr :key="order.id">
                        <td>{{ order.id }}</td>
                        <td>{{ order.status }}</td>
                        <td>{{ order.sum }}</td>
                        <td>
                            <button @click="pay(order)"
                                    :disabled="isLoading || order.status === 'paid'"
                            >
                                Pay
                            </button>
                        </td>
                    </tr>
                </template>
                </tbody>
            </table>
        </template>
    </div>
</template>

<script>
import {mapState} from "vuex";

export default {
    name: "OrdersList",
    data() {
        return {
            isLoading: false,
        };
    },
    computed: {
        ...mapState({
            orders: state => state.orders.items,
        }),
    },
    methods: {
        pay(order) {
            this.$store
                .dispatch('orders/payOrder', order)
                .then(() => this.isLoading = false)
                .catch(() => this.isLoading = false);
        },
    },
    mounted() {
        this.isLoading = true;
        this.$store
            .dispatch('orders/getItems')
            .then(() => this.isLoading = false)
            .catch(() => this.isLoading = false);
    },
}
</script>

<style scoped>

</style>