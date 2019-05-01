<template>
    <Tabs>
        <TabPane label="Чеки" icon="ios-list"><checks></checks></TabPane>
        <TabPane label="Товары" icon="ios-basket"><products></products></TabPane>
    </Tabs>
</template>
<script>
    import Checks from './Checks.vue';
    import Products from './Products.vue';

    export default {

        components: {
            'checks': Checks,
            'products': Products,
        },

    }
</script>
