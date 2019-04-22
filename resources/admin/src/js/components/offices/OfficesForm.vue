<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-5">
                <h4>Дополнительные свойства:</h4>
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <checkbox v-model="item.vip"/>
                            VIP
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <checkbox v-model="item.main"/>
                            Использовать как основной
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <checkbox v-model="item.master"/>
                            Главный офис
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <checkbox v-model="item.card"/>
                            Прием карт к оплате
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <checkbox v-model="item.delimobil"/>
                            Делимобиль
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <h4>SEO:</h4>
                <div class="form-group">
                    <label for="seo.title">Title</label>
                    <input type="text" id="seo.title" class="form-control" v-model="item.seo.title">
                </div>
                <div class="form-group">
                    <label for="seo.keywords">Keywords</label>
                    <input type="text" id="seo.keywords" class="form-control" v-model="item.seo.keywords">
                </div>
                <div class="form-group">
                    <label for="seo.description">Description</label>
                    <input type="text" id="seo.description" class="form-control" v-model="item.seo.description">
                </div>
                <div class="form-group">
                    <label for="seo.h1">H1</label>
                    <input type="text" id="seo.h1" class="form-control" v-model="item.seo.h1">
                </div>

                <h4>Уточнение адреса:</h4>
                <div class="form-group">
                    <textarea class="form-control" cols="30" rows="4" v-model="item.address_note"></textarea>
                </div>

                <h4>Телефоны:</h4>
                <phone-input v-model="item.phones"/>
                <h4>E-mail:</h4>
                <mail-input v-model="item.emails"/>
            </div>
            <div class="col-lg-5 col-md-7">
                <schedule v-model="item.schedule">
                    <template v-slot:header>
                        <h4>График работы:</h4>
                    </template>
                </schedule>

            </div>
        </div>
        <div class="row">
            <div class="btn btn-sm btn-success" @click="submit">Сохранить</div>
        </div>
    </div>
</template>

<script>
    import {findIndex} from 'lodash';
    import store from './store';

    import Schedule from '../schedule/Schedule.vue';
    import Checkbox from '../Checkbox.vue';
    import PhoneInput from './PhoneInput.vue';
    import MailInput from './MailInput.vue';

    export default {
        props: {
            tid: Number,
        },
        components: {
            Schedule,
            Checkbox,
            PhoneInput,
            MailInput,
        },
        mounted() {
            const index = findIndex(this.office.types, {type_id: this.tid});
            this.item = store.state.office.types[index];
        },
        data() {
            return {
                office: store.state.office,
                item: {
                    type_id: this.tid,
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
                    delimobil: false,
                }
            }
        },
        methods: {
            submit() {
                this.$emit('submitted');
            }
        },
        watch: {
            item: {
                handler(val) {
                    const index = findIndex(this.office.types, {type_id: this.tid});
                    this.office.types[index] = val;
                },
                deep: true,
            }
        }
    }
</script>
