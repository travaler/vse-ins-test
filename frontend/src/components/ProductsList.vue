<template>
    <div>
        <template v-if="isLoading">
            <p>Loading ...</p>
        </template>
        <template v-else>
            <table>
                <thead>
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Price</th>
                </tr>
                </thead>
                <tbody>
                <template v-for="product in products">
                    <tr :key="product.id">
                        <td>
                            <input type="checkbox"
                                   :value="product.id"
                                   v-model="selected"
                            >
                        </td>
                        <td>{{ product.name }}</td>
                        <td>{{ product.price }}</td>
                    </tr>
                </template>
                </tbody>
            </table>
        </template>
    </div>
</template>

<script>
import { mapState } from 'vuex';

export default {
    name: "ProductsList",
    data() {
        return {
            isLoading: false,
        };
    },
    computed: {
        ...mapState({
            products: state => state.products.items,
        }),
        selected: {
            get: function () {
                return this.$store.getters["selectedItems/getItems"];
            },
            set: function (value) {
                this.$store.commit('selectedItems/setItems', value);
            }
        },
    },
    mounted() {
        this.isLoading = true;
        this.$store
            .dispatch('products/getItems')
            .then(() => this.isLoading = false)
            .catch(() => this.isLoading = false);
    },
}
</script>

<style scoped>

</style>