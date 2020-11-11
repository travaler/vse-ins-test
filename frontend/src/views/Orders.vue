<template>
    <div class="orders">
        <OrdersList></OrdersList>
    </div>
</template>

<script>
import OrdersList from "@/components/OrdersList.vue";

export default {
    name: 'Orders',
    components: {
        OrdersList,
    },
}
</script>
