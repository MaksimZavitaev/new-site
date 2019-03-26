import axios from 'axios';
import emmiter from './emitter';

export default {
    mixins: [
        emmiter
    ],
    props: {
        isNew: {
            type: Boolean,
            default: false,
        },
        inList: {
            type: Boolean,
            default: false,
        },
        pageId: {},
        value: {}
    },
    data() {
        return {
            endpoint: `/admin/pages/${this.pageId}/variables`,
            item: {},
            errors: {
                key: false
            },
            changed: false,
            processing: false,
        }
    },
    created() {
        let item = this.value.id ? {} : this.item;
        this.item = {...item, ...this.value};
        if (this.inList) {
            this.$emit('input', this.item);
        } else {
            this.$emit('input', {...this.item});
        }
    },
    methods: {
        check() {
            return axios.get(`${this.endpoint}/${this.value.id}`)
        },

        uploadFile(file = null) {
            let formData = new FormData();

            formData.append('files[]', file ? file : this.file);

            return new Promise((resolve, reject) => {
                axios.post(`/admin/media/upload`, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(response => {
                    this.item = {...this.item, ...response.data};
                    resolve(response);
                }).catch(error => {
                    reject(error);
                })
            })
        },

        submit() {
            this.processing = true;

            let action = this.value.id ? this.update : this.create;
            if (this.file) {
                this.uploadFile()
                    .then(response => {
                        action();
                    })
                    .catch(error => {
                        this.$notify({
                            group: 'app',
                            duration: 3000,
                            type: 'error',
                            title: 'Ошибка',
                            text: 'При загрузке файла произошла ошибка!'
                        });
                    });
            } else {
                action();
            }
        },
        create() {
            const {page_id, ...data} = this.item;
            axios
                .post(`${this.endpoint}`, data)
                .then(response => {
                    this.processing = false;
                    this.changed = false;
                    const {data, ...fields} = response.data;
                    this.$emit('input', {...data, ...fields});

                    this.$notify({
                        group: 'app',
                        duration: 3000,
                        type: 'success',
                        text: 'Переменная успешно создана!'
                    });
                })
                .catch(error => {
                    this.processing = false;
                    this.$notify({
                        group: 'app',
                        duration: 3000,
                        type: 'error',
                        title: 'Ошибка',
                        text: 'При создании переменной произошла ошибка.'
                    });
                });
        },
        update() {
            const {page_id, ...data} = this.item;
            axios
                .put(`${this.endpoint}/${this.value.id}`, data)
                .then(response => {
                    this.processing = false;
                    this.changed = false;
                    const {data, ...fields} = response.data;
                    this.$emit('input', {...data, ...fields});

                    this.$notify({
                        group: 'app',
                        duration: 3000,
                        type: 'success',
                        text: 'Переменная успешно обновлена!'
                    });
                })
                .catch(error => {
                    this.processing = false;

                    this.$notify({
                        group: 'app',
                        duration: 3000,
                        type: 'error',
                        title: 'Ошибка',
                        text: 'При обновлении переменной произошла ошибка.'
                    });
                });
        },
        reset() {
            if (this.file) this.file = null;

            let item = this.value.id ? {} : this.item;
            this.item = {...item, ...this.value};
        },
        destroy() {
            if (this.item.id) {
                this.processing = true;
                axios
                    .delete(`${this.endpoint}/${this.value.key}`)
                    .then(response => {
                        this.processing = false;
                        this.changed = false;
                        this.$emit('deleted', this);

                        this.$notify({
                            group: 'app',
                            duration: 3000,
                            type: 'success',
                            text: 'Переменная успешно удалена!'
                        });
                    })
                    .catch(error => {
                        this.processing = false;

                        this.$notify({
                            group: 'app',
                            duration: 3000,
                            type: 'error',
                            title: 'Ошибка',
                            text: 'При удалении переменной произошла ошибка.'
                        });
                    });
            } else {
                this.$emit('deleted', this);

                this.$notify({
                    group: 'app',
                    duration: 3000,
                    type: 'success',
                    text: 'Переменная успешно удалена!'
                });
            }
        }
    },
    watch: {
        'item.key': {
            handler(val, old) {
                if (old === undefined || this.value.key === val) {
                    this.broadcast('KeyInput', 'handleError', false);
                    return;
                }

                if (this.$parent.items.some(item => item.key === val)) {
                    this.broadcast('KeyInput', 'handleError', 'Ключ уже используется другой переменной');
                } else {
                    this.broadcast('KeyInput', 'handleError', false);
                }
            }
        },
        item: {
            handler() {
                this.changed = !(JSON.stringify(this.value) === JSON.stringify(this.item))
            },
            deep: true
        },
    }
}
