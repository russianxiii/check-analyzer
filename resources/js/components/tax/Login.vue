<template>

    <div>

        <label class="block text-grey-darker text-sm font-bold mb-2 mt-3">
            Телефон
        </label>

        <input v-model="username" placeholder="+7xxxxxxxxxx" type="tel" v-mask="'+7##########'"
               class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight">

        <label class="block text-grey-darker text-sm font-bold mb-2 mt-3">
            Пароль
        </label>

        <input v-model="password"
               class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight"
               type="password" placeholder="*************">
        <div class="flex flex-row">

            <Button type="primary" :loading="loading" @click="sendCode" style="flex: 1; margin-top: 1.5rem">
                <span v-if="!loading">Войти</span>
            </Button>

            <Tooltip content="Выслать новый пароль">
                <Button type="warning" :loading="loading" @click="remindPassword"
                        style="flex: 1; margin: 1.5rem 0 0 0.75rem;">
                    <span v-if="!loading">Забыли пароль?</span>
                </Button>

                <Modal
                        v-model="modalRemind"
                        title="Восстановление пароля"
                        @on-cancel="cancel">
                    <label class="block text-grey-darker text-sm font-bold mb-2 mt-3">
                        Телефон
                    </label>
                    <input v-model="username" placeholder="+7xxxxxxxxxx" type="tel" v-mask="'+7##########'"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight">
                    <div slot="footer">
                        <Button size="large" :loading="loading"  @click="cancel"><span v-if="!loading">Отменить</span></Button>
                        <Button type="primary" :loading="loading" size="large" @click="sendNew"><span v-if="!loading">Получить новый пароль</span></Button>
                    </div>
                </Modal>

            </Tooltip>

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
                error: '',
                modalRemind: false
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
                    .then(() => {
                        window.location.href='/check';
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
                    .then(() => {
                        this.loading = false;
                    });
            },

            remindPassword() {
                this.modalRemind = true;
            },

            sendNew() {

                this.loading = true;
                let params = {
                    phone: this.username
                };
                axios
                    .post('fns/remind', params)
                    .then(() => {
                        this.$Message.info('Пароль отправлен');
                        this.modalRemind = false;
                    })
                    .catch(error => {
                        console.log(error);
                        if (error.response.data.message.includes('the user was not found'))
                            this.$Message.error('Телефон не найден');
                        else this.$Message.error('Произошла ошибка, попробуйте позже');
                    })
                    .then(() => {
                        this.loading = false;
                    })
            },

            cancel() {
                this.modalRemind = false;
            }
        }
    }
</script>

<style scoped>

</style>