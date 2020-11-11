<template>
    <div>
        <button @click="createOrder"
                :disabled="isLoading || productIds.length === 0"
        >
            Create order
        </button>
    </div>
</template>

<script>
import { mapState } from 'vuex';

export default {
    name: "CreateOrder",
    data() {
        return {
            isLoading: false,
        };
    },
    computed: {
        ...mapState({
            productIds: state => state.selectedItems.items,
        }),
    },
    methods: {
        createOrder() {
            this.isLoading = true;
            this.$store
                .dispatch('orders/createOrder', this.productIds)
                .then(() => this.isLoading = false)
                .catch(() => this.isLoading = false);
        },
    },
}
</script>

<style scoped>

</style>