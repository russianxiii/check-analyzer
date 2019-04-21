<template>

    <div>

        <label class="block text-grey-darker text-sm font-bold mb-2 mt-3">
            Телефон
        </label>

        <input v-model="username" placeholder="+7xxxxxxxxxx" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight">

        <label class="block text-grey-darker text-sm font-bold mb-2 mt-3">
            Пароль
        </label>

        <input v-model="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight">

        <div class="text-center">

        <Button type="primary" :loading="loading" @click="sendCode" style="width: 200px; margin-top: 1.5rem">
            <span v-if="!loading">Войти</span>
        </Button>

        </div>

    </div>
</template>

<script>
    export default {
        props: ['phone'],

        data() {
            return {
                password: '',
                username: this.phone,
                loading: false,
                error: ''
            }
        },

        methods: {
            sendCode() {
                this.loading = true;
                let params = {
                    phone: this.username,
                    password: this.password
                };
                axios
                    .post('fns/login', params)
                    .then(response => {
                        //this.toLogin();
                    })
                    .catch(error => {
                        console.log(error);
                        if (error.response.data.message.includes('user exist')) {
                            this.error = 'Пользователь уже существует'
                        }
                        if (error.response.data.errors) {
                            this.error = '';
                            let errors = error.response.data.errors;
                            for (let key in errors) {
                                this.error += errors[key] + '<br>';
                            }
                        }
                    })
                    .then(result => {
                        this.loading = false;
                    });
            }
        }
    }
</script>

<style scoped>

</style>