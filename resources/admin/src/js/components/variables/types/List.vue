<template>
    <box title="Список"
         :name="item.key"
         :is-new="!item.created_at"
         :in-list="inList"
         :processing="processing"
         :changed="changed"
         @submit="submit"
         @reset="reset"
         @destroy="destroy">
        <key-input v-if="!inList" v-model="item.key"></key-input>
        <div class="form-group" v-if="!item.itemsType">
            <label for="type">Выберите тип списка</label>
            <select id="type" class="form-control" v-model="item.itemsType">
                <option v-for="(name, key) in types" :key="key" :value="key">
                    {{ name }}
                </option>
            </select>
        </div>
        <div class="row" v-else>
            <div class="col-md-12">
                <draggable v-model="item.items" :options="{handle: '.box-header'}">
                    <component
                        v-for="(el, key) in item.items"
                        :key="el.key"
                        :is="'v-' + item.itemsType"
                        v-model="item.items[key]"
                        :page-id="pageId"
                        :in-list="true"
                        @fileChanged="fileChanged"
                        @deleted="removeElement(el)"></component>
                </draggable>
                <button class="btn btn-block btn-success" @click="addElement">Добавить</button>
            </div>
        </div>
    </box>
</template>

<script>
    import axios from 'axios'
    import variable from '../../../mixins/variable'
    import draggable from 'vuedraggable'

    import Box from '../components/Box.vue';
    import KeyInput from '../components/KeyInput.vue';
    import VFile from './File.vue';
    import VImage from './Image.vue';
    import VLink from './Link.vue';
    import VString from './String.vue';
    import VText from './Text.vue';
    import VList from './List.vue';

    export default {
        mixins: [variable],
        components: {
            draggable,
            Box,
            KeyInput,
            VFile,
            VImage,
            VLink,
            VString,
            VText,
            VList
        },
        data() {
            return {
                files: [],
                types: {
                    'string': 'Строка',
                    'text': 'Текст',
                    'link': 'Ссылка',
                    'file': 'Файл',
                    'image': 'Изображение',
                },
                item: {
                    type: 'list',
                    itemsType: '',
                    sort: 0,
                    items: []
                },
            }
        },
        mounted() {
            console.log('Component List mounted.')
        },
        methods: {
            submit() {
                this.processing = true;
                let action = this.value.created_at ? this.update : this.create;

                if (this.files.length) {
                    Promise.all(this.uploadFiles())
                        .then(() => {
                            action();
                        });
                } else {
                    action();
                }
            },
            reset() {
                this.processing = true;

                axios.get(`${this.endpoint}/${this.value.key}`)
                    .then(response => {
                        const {data, ...fields} = response.data;
                        this.item = {...data, ...fields};
                        this.processing = false;
                    })
            },
            uploadFiles() {
                let promises = [];
                this.files.forEach((component, i, components) => {
                    promises.push(this.uploadFile(component.file)
                        .then(response => {
                            component.item = Object.assign(component.item, response.data)
                            component.file = false;
                            components.splice(i, 1);
                        }));
                });

                return promises;

            },
            addElement() {
                let max = Math.max.apply(Math, this.item.items.map(i => (typeof i.key === 'string') ? 0 : i.key));
                max = Number.isFinite(max) ? max : 0;
                this.item.items.push({key: max + 1, type: this.item.itemsType});
            },
            removeElement({key}) {
                this.item.items.splice(this.item.items.findIndex(el => el.key === key), 1)
            },
            // addVariable(type) {
            //     let max = Math.max.apply(Math, this.item.items.map(i => (typeof i.key === 'string') ? 0 : i.key));
            //     max = Number.isFinite(max) ? max : 0;
            //     this.item.items.unshift({key: max + 1, type})
            // },
            fileChanged(component) {
                if (component.file) {
                    this.files.push(component);
                }
            }
        },
        watch: {
            'item.items': {
                handler(newVal, oldVal) {
                    this.changed = oldVal.length !== 0
                },
                deep: true
            }
        }
    }
</script>
