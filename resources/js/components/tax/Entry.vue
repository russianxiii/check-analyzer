<template>

    <div>

        <Alert>Для получения данных из чеков необходимо быть зарегистрированным в сервисе ФНС.</Alert>

        <Card>

            <Steps :current="step" class="mt-2">
                <Step title="Регистрация"></Step>
                <Step title="Вход"></Step>
            </Steps>

            <Divider/>

            <fns-registration @step="onStep" v-if="step === 0" ></fns-registration>

            <fns-login v-else-if=" step === 1 " :phone="phone"></fns-login>

        </Card>

    </div>


</template>

<script>

    import Registration from './Registration.vue';
    import Login from './Login.vue';

    export default {

        components: {
            'fns-registration': Registration,
            'fns-login': Login,
        },

        data() {
            return {
                step: 0,
                phone: ''
            }
        },

        methods: {
            toLogin() {
                this.step = 1;
            },
            onStep(data){
                if (data.step) this.step = data.step;
                if (data.phone) this.phone = data.phone;
            }
        }

    }
</script>

<style scoped>

</style>