<template>
    <div class="box box-warning">
        <div class="nav-tabs-custom tab-warning">
            <ul id="tabs" class="nav nav-tabs">
                <li :class="{'active': isActive(0)}"><a href="#" @click="setActiveTab(0)">Офис</a></li>
                <li v-for="type in types" :class="{'active': isActive(type.id)}" :key="type.id" v-show="type.status">
                    <a href="#" @click="setActiveTab(type.id)">{{type.name}}</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="active tab-pane" v-show="isActive(0)">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-3">

                                <div class="form-group">
                                    <div class="checkbox">
                                        <label>
                                            <checkbox v-model="office.active"></checkbox>
                                            Активно
                                        </label>
                                    </div>
                                </div>

                                <h4>Тип офиса:</h4>
                                <div id="tabs-checkboxes">
                                    <div class="form-group"
                                         v-for="type in types"
                                         :key="type.id">
                                        <div class="checkbox">
                                            <label>
                                                <checkbox v-model="type.status"></checkbox>
                                                {{ type.name }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="input-group">
                                    <input type="text" class="form-control" v-model="address">

                                    <span class="input-group-btn">
                                <button type="button" class="btn btn-warning btn-flat"
                                        @click="setAddress">Найти!</button>
                            </span>
                                </div>
                                <y-map :lat="lat" :lon="lon" ref="ymap" @addressChanged="changeAddress"/>

                                <div class="form-group">
                                    <label for="address_note" class="control-label">Уточнение адреса:</label>
                                    <textarea class="form-control" id="address_note" v-model="address_note"></textarea>
                                </div>


                                <div class="form-group">
                                    <label>Метро</label>
                                    <stations class="form-control" v-model="subways" :options="stations"></stations>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="btn btn-sm btn-success" @click="submit">Сохранить</div>
                        </div>
                    </div>
                </div>
                <div class="active tab-pane"
                     v-for="type in types"
                     :key="type.id"
                     v-show="isActive(type.id)">
                    <office-form :tid="type.id" @submitted="submit"/>
                </div>
            </div>
        </div>

        <div class="overlay" v-show="process">
            <i class="fa fa-refresh fa-spin"></i>
        </div>
    </div>
</template>

<script>
    import store from './store';

    import OfficeForm from './OfficesForm.vue';
    import Checkbox from '../Checkbox.vue';
    import Stations from './Stations.vue';
    import YMap from '../YMap.vue';

    export default {
        props: {
            id: {
                default: null
            }
        },
        components: {
            OfficeForm,
            Checkbox,
            Stations,
            YMap,
        },
        async mounted() {
            this.process = true;
            if (this.id)
                await store.loadOfficeById(this.id);

            await store.getTypes();
            await store.getSubways();
            this.types = store.state.types;
            this.stations = store.state.subways;
            this.process = false;
        },
        data() {
            return {
                state: store.state,
                active_tab: 0,
                types: [],
                stations: [],
            }
        },
        computed: {
            lat() {
                return this.state.office.lat
            },
            lon() {
                return this.state.office.lon
            },

            address() {
                return this.state.office.address
            },
            address_note: {
                get() {
                    return this.state.office.address_note
                },
                set(val) {
                    this.state.office.address_note = val
                },
            },
            office() {
                return this.state.office
            },
            subways: {
                get() {
                    return this.state.office.subways
                },
                set(val) {
                    this.state.office.subways = val
                },
            },
            process: {
                get() {
                    return store.state.process;
                },
                set(val) {
                    store.state.process = val;
                },
            },
        },
        methods: {
            setActiveTab(id) {
                this.active_tab = id;
            },
            isActive(id) {
                return this.active_tab === id;
            },
            submit() {
                store.submit();
            },
            setAddress() {
                this.$refs.ymap.$emit('setAddress', this.address);
            },
            changeAddress({address, lat, lon}) {
                this.$set(store.state.office, 'address', address);
                store.state.office.lat = lat;
                store.state.office.lon = lon;
            }
        },
    }
</script>
