<template>
    <div class="box box-warning">
        <div class="box-header">
            <h3 class="box-title">
                Переменные
            </h3>
            <div class="box-tools">
                <button class="btn" @click="loadVariables">
                    <i class="fa fa-refresh" :class="{'fa-spin': loading}"></i>
                </button>
            </div>
        </div>
        <div class="box-body">
            <div class="nav-tabs-custom tab-warning">
                <div class="col-lg-4 col-md-4">
                    <div class="box box-warning">
                        <div class="box-body">
                            <ul class="nav nav-stacked">
                                <li v-for="(title, type) in tabs">
                                    <a :href="`#${type}`" data-toggle="tab" aria-expanded="false">{{ title }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="tab-content">
                        <div v-for="(title, type) in tabs" :id="type" class="tab-pane">
                            <div class="box box-warning">
                                <div class="box-header">
                                    <div class="box-tools">
                                        <button class="btn btn-xs" @click="addVariable(type)">
                                            Добавить
                                        </button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <component
                                        v-for="(item, key) in items[type]"
                                        :key="item.key"
                                        :is="'v-' + item.type"
                                        v-model="items[type][key]"
                                        :page-id="pageId"
                                        @deleted="removeVariable(item)"></component>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="overlay" v-show="loading">
            <i class="fa fa-refresh fa-spin"></i>
        </div>
    </div>
</template>

<style>

</style>

<script>
    import _ from 'lodash';
    import axios from 'axios';

    import Box from './components/Box.vue';
    import VFile from './types/File.vue';
    import VImage from './types/Image.vue';
    import VLink from './types/Link.vue';
    import VString from './types/String.vue';
    import VText from './types/Text.vue';
    import VList from './types/List.vue';

    export default {
        props: ['pageId'],
        components: {
            Box,
            VFile,
            VImage,
            VLink,
            VString,
            VText,
            VList
        },
        data() {
            return {
                tabs: {
                    string: 'Строки',
                    text: 'Текст',
                    link: 'Сссылки',
                    image: 'Изображения',
                    file: 'Файлы',
                    list: 'Списки'
                },
                items: [],
                loading: false,
            }
        },
        created() {
            this.loadVariables();
        },
        methods: {
            loadVariables() {
                this.loading = true;
                axios.get(`/admin/pages/${this.pageId}/variables`)
                    .then(({data}) => {
                        this.loading = false;
                        this.items = _.mapValues({...this.tabs}, () => []);
                        this.items = {
                            ...this.items,
                            ..._.chain(data)
                                .groupBy('key')
                                .toPairs()
                                .map((data) => {
                                    let [key, item] = data;
                                    if (item.length > 0) {
                                        const {data, ...first} = item[0];
                                        if (!first.is_list)
                                            return {
                                                ...data,
                                                ...first
                                            };

                                        return {
                                            ...first,
                                            type: 'list',
                                            itemsType: first.type,
                                            items: item.map(item => {
                                                let {data, ...fields} = item;
                                                return {...data, ...fields};
                                            })
                                        }
                                    }
                                })
                                .groupBy('type')
                                .value()
                        };
                    })
                    .catch(error => {
                        this.loading = false;
                        this.$notify({
                            group: 'app',
                            duration: 3000,
                            type: 'error',
                            title: 'Ошибка',
                            text: 'При загрузке переменных произошла ошибка. Пожалуйста, нажмите кнопку обновить!'
                        });
                    })
            },
            addVariable(type) {
                let max = Math.max.apply(Math, _.values(this.items).flatMap(i => i).map(i => (typeof i.key === 'string') ? 0 : i.key));
                max = Number.isFinite(max) ? max : 0;
                this.items[type].unshift({key: max + 1, type})
            },
            removeVariable({key, type}) {
                this.items[type].splice(this.items[type].findIndex(variable => variable.key === key), 1)
            }
        }
    }
</script>
