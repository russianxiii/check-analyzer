<template>

    <div>

        <Alert type="error" v-if="error" v-html="error"></Alert>

        <div>

            <label class="block text-grey-darker text-sm font-bold mb-2 mt-3">
                E-mail адрес
            </label>

            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight" v-model="email" placeholder="example@example.com">

        </div>

        <div>

            <label class="block text-grey-darker text-sm font-bold mb-2 mt-3">
                Имя
            </label>

            <input v-model="name" placeholder="example@example.com" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight">

        </div>

        <div>

            <label class="block text-grey-darker text-sm font-bold mb-2 mt-3">
                Телефон
            </label>

            <input v-model="phone" placeholder="+7xxxxxxxxxx" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight">

        </div>

        <div class="flex flex-row">

            <Button type="primary" :loading="loading" @click="toLoading" style="width: 200px; margin-top: 1.5rem">
                <span v-if="!loading">Получить пароль</span>
                <span v-else>Loading...</span>
            </Button>

            <Button type="success" class="mb-3" @click="toLogin" style="margin: 1.5rem 0 0 0.75rem;">Уже зарегистрированы?</Button>

        </div>

    </div>
</template>

<script>
    export default {

        data() {
            return {
                phone: '',
                name: '',
                email: '',
                loading: false,
                error: ''
            }
        },

        mounted() {
            console.log('Component mounted.')
        },

        methods: {
            toLogin() {
                this.$emit('step', {
                    step: 1,
                    phone: this.phone
                });
            },
            toLoading() {
                this.loading = true;
                let params = {
                    phone: this.phone,
                    name: this.name,
                    email: this.email
                };
                axios
                    .post('fns/registration', params)
                    .then(response => {
                        this.toLogin();
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