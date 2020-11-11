<template>
    <div class="home">
        <CreateOrder></CreateOrder>
        <ProductsList></ProductsList>
    </div>
</template>

<script>
import ProductsList from "@/components/ProductsList.vue";
import CreateOrder from "@/components/CreateOrder.vue";

export default {
    name: 'Home',
    components: {
        ProductsList,
        CreateOrder,
    }
}
</script>
