<template>
    <box title="Список"
         :name="item.key"
         :is-new="!item.id"
         :processing="processing"
         :changed="changed"
         :is-list="true"
         @submit="submit"
         @reset="reset"
         @destroy="destroy">
        <key-input v-model="item.key"></key-input>
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
                        :key="key"
                        :is="'v-' + item.itemsType"
                        v-model="item.items[key]"
                        :page-id="pageId"
                        :in-list="true"
                        @submitElement="submitElement"
                        @deleted="removeElement(key)"></component>
                </draggable>
                <button class="btn btn-block btn-success" @click="addElement">Добавить</button>
            </div>
        </div>
    </box>
</template>

<script>
    import axios from 'axios'
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
        props: {
            pageId: null,
            value: {}
        },
        data() {
            return {
                endpoint: `/admin/pages/${this.pageId}/variables/list`,
                processing: false,
                changed: false,
                files: [],
                types: {
                    'string': 'Строка',
                    'text': 'Текст',
                    'link': 'Ссылка',
                    'file': 'Файл',
                    'image': 'Изображение',
                },
                item: {
                    id: null,
                    key: null,
                    variable_id: null,
                    type: 'list',
                    itemsType: '',
                    sort: 0,
                    items: []
                },
            }
        },
        created() {
            let item = this.value.variable_id ? {} : this.item;
            this.item = {...item, ...this.value};
        },
        mounted() {
            console.log('Component List mounted.')
        },
        methods: {
            submit() {
                // this.processing = true;
                let action = this.item.variable_id ? this.update : this.create;
                action();
            },
            create() {
                this.processing = true;

                axios.post(`${this.endpoint}`, {
                    key: this.item.key
                }).then(res => {
                    console.log('Success');
                    console.log(res);
                    this.item.variable_id = res.data.id;
                    this.item.items.map(item => {
                        item.variable_id = res.data.id;
                        return item;
                    });
                    this.$emit('input', this.item);
                    this.changed = false;
                    this.processing = false;
                }).catch(err => {
                    this.processing = false;
                });
            },
            update() {
                this.processing = true;

                axios.put(`${this.endpoint}/${this.item.variable_id}`, {
                    key: this.item.key
                }).then(res => {
                    console.log('Success');
                    this.item.variable_id = res.data.id;
                    this.item.items.map(item => {
                        item.variable_id = res.data.id;
                        return item;
                    });
                    this.$emit('input', this.item);
                    this.processing = false;
                }).catch(err => {
                    this.processing = false;
                });
            },
            destroy() {
                this.processing = true;
                if (this.value.variable_id) {
                    axios.delete(`${this.endpoint}/${this.item.variable_id}`)
                        .then(() => {
                            this.$emit('deleted', this.item);
                            this.processing = false;
                        })
                } else {
                    this.$emit('deleted', this.item);
                    this.processing = false;
                }
            },
            reset() {
                this.item.key = this.value.key;
                this.item.itemsType = this.value.itemsType;
            },
            addElement() {
                this.item.items.push({
                    key: this.item.key,
                    variable_id: this.item.variable_id,
                    is_list: true,
                    type: this.item.itemsType
                });
            },
            removeElement(index) {
                this.item.items.splice(index, 1)
            },
            submitElement(payload) {
                this.item.variable_id = payload.variable_id;
                this.item.key = payload.key;
                this.item.items.map(item => {
                    item.variable_id = this.item.variable_id;
                    return item;
                });
            }
        },
        watch: {
            'item.variable_id'(val) {
                this.changed = val !== this.item.variable_id;
            },
            'item.key'() {
                this.changed = this.item.variable_id && (this.value.key.toString() !== this.item.key.toString());
            },
            //     this.changed = this.value.key.toString() !== this.item.key.toString();
            //     // if (this.changed)
            //     //     this.item.items.map(item => {
            //     //         item.key = this.item.key;
            //     //         return item;
            //     //     })
            // },
            // 'item.itemsType'() {
            //     this.changed = this.value.itemsType !== this.item.itemsType;
            // }
        }
    }
</script>
