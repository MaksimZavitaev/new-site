import Vue from 'vue';
import Axios from 'axios';

const store = {
    debug: true,
    state: {
        process: false,
        types: [],
        subways: [],
        office: {
            id: null,
            active: false,
            address: '',
            address_note: '',
            lat: null,
            lon: null,
            sort: 100,
            subways: [],
            types: []
        }
    },
    async loadOfficeById(id = null) {
        if (!this.state.office.id) {
            const {data} = await Axios.get(`/admin/offices/${id}`);
            this.state.office = {
                ...data,
                types: data.types.map(i => {
                    i.type_id = i.office_type_id;
                    return i;
                })
            };
            return data;
        }
    },
    async getTypes() {
        if (!this.state.types.length) {
            const {data} = await Axios.get('/admin/offices/types');
            this.state.types = data.map(i => {
                i.status = store.state.office.types.some(j => i.id === j.type_id);
                return i;
            });

            data.forEach(i => {
                if (this.state.office.types.some(j => i.id === j.type_id))
                    return;

                this.state.office.types.push({
                    type_id: i.id,
                    seo: {
                        title: '',
                        keywords: '',
                        description: '',
                        h1: '',
                    },
                    address_note: '',
                    phones: [],
                    emails: [],
                    schedule: [],
                    vip: false,
                    main: false,
                    master: false,
                    card: false,
                    delimobil: false
                })
            });
        }
        return this.state.types;
    },
    async getSubways() {
        if (!this.state.subways.length) {
            const {data} = await Axios.get('/admin/subways');
            this.state.subways = data;
        }
    },
    async submit() {
        this.state.process = true;
        this.state.office.id ? await this.update() : await this.create();
        this.state.process = false;
    },
    async create() {
        const office = {
            ...this.state.office,
            types: this.state.office.types.filter(i => this.state.types.some(j => (i.type_id === j.id && j.status)))
        };
        const {data} = await Axios.post('/admin/offices', office)
            .then(res => {
                Vue.notify({
                    group: 'app',
                    duration: 3000,
                    type: 'success',
                    text: 'Успешно!'
                });

                return res;
            })
            .catch(err => {
                Vue.notify({
                    group: 'app',
                    duration: 3000,
                    type: 'error',
                    text: 'При выполнении операции произошла ошибка. Пожалуйста, повторите попытку.'
                });
            });
        if (data.id) {
            this.state.office.id = data.id;
            window.location.href = `/admin/offices/${data.id}/edit`;
        }
        return data;
    },
    async update() {
        const office = {
            ...this.state.office,
            types: this.state.office.types.filter(i => this.state.types.some(j => (i.type_id === j.id && j.status)))
        };
        const {data} = await Axios.put(`/admin/offices/${this.state.office.id}`, office)
            .then(res => {
                Vue.notify({
                    group: 'app',
                    duration: 3000,
                    type: 'success',
                    text: 'Успешно!'
                });

                return res;
            })
            .catch(err => {
                Vue.notify({
                    group: 'app',
                    duration: 3000,
                    type: 'error',
                    text: 'При выполнении операции произошла ошибка. Пожалуйста, повторите попытку.'
                });
            });
        return data;
    },
};

export default store;
