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
            <div class="col-lg-4 col-md-4">
                <div class="box box-warning">
                    <div class="box-header">
                        <h3 class="box-title">
                            Добавить переменную
                        </h3>
                    </div>
                    <div class="box-body">
                        <button type="button" class="btn btn-default btn-block" @click="addVariable('string')">Строка
                        </button>
                        <button type="button" class="btn btn-default btn-block" @click="addVariable('text')">Текст
                        </button>
                        <button type="button" class="btn btn-default btn-block" @click="addVariable('link')">Ссылка
                        </button>
                        <button type="button" class="btn btn-default btn-block" @click="addVariable('image')">
                            Изображение
                        </button>
                        <button type="button" class="btn btn-default btn-block" @click="addVariable('file')">Файл
                        </button>
                        <button type="button" class="btn btn-default btn-block" @click="addVariable('list')">Список
                        </button>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <div class="col-lg-6 col-md-8">
                <component
                    v-for="(item, key) in items"
                    :key="item.key"
                    :is="'v-' + item.type"
                    v-model="items[key]"
                    :page-id="pageId"
                    @deleted="removeVariable(item)"></component>
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
                        this.items = data.map(item => {
                            const {data, ...fields} = item;
                            return {...data, ...fields}
                        })
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
                let max = Math.max.apply(Math, this.items.map(i => (typeof i.key === 'string') ? 0 : i.key));
                max = Number.isFinite(max) ? max : 0;
                this.items.unshift({key: max + 1, type})
            },
            removeVariable({key}) {
                this.items.splice(this.items.findIndex(variable => variable.key === key), 1)
            }
        }
    }
</script>
