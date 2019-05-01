<template>
    <div>
        <Button type="primary" icon="ios-add-circle" @click="openQr">Добавить чек</Button>

        <Modal
                v-model="modalQr"
                title="Добавление чека"
                @on-cancel="closeQr">
            <label class="block text-grey-darker text-sm font-bold mb-2 mt-3">
                Загрузка изображения
            </label>
            <Upload :before-upload="handleUpload" action="" :format="['jpg','jpeg','png']" accept=".jpg, .jpeg, .png">
                <Button icon="ios-cloud-upload-outline">Upload files</Button>
            </Upload>

            <div slot="footer">
                <Button size="large" @click="closeQr">Отменить</Button>
            </div>
        </Modal>

        <Table :columns="columns1" :data="data1" no-data-text="Чеки не добавлены" class="mt-3"></Table>
    </div>
</template>

<script>

    import QrScanner from 'qr-scanner';
    QrScanner.WORKER_PATH = '/js/qr-scanner/qr-scanner-worker.min.js';

    export default {
        data () {
            return {
                modalQr: false,
                columns1: [
                    {
                        title: 'Дата покупки',
                        key: 'date'
                    },
                    {
                        title: 'Магазин',
                        key: 'store'
                    },
                    {
                        title: 'Количество товаров',
                        key: 'products_count'
                    }
                    ,
                    {
                        title: 'Сумма',
                        key: 'amount'
                    }
                ],
                data1: []
            }
        },

        methods: {

            openQr() {
                this.modalQr = true;
            },

            handleUpload(file) {
                QrScanner.scanImage(file)
                    .then(result => {
                        console.log(result);
                        axios
                            .post('check?'+ result)
                            .then(response => {
                                //window.location.href='/checks';
                            })
                            .catch(error => {
                                console.log(error);

                            })
                            .then(() => {
                                this.loading = false;
                            });
                    })
                    .catch(error => console.log(error || 'No QR code found.'));
                return false;
            },

            closeQr() {
                this.modalQr = false;
            }
        }
    }
</script>

<style scoped>

</style>