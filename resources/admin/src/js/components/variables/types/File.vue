<template>
    <box title="Файл"
         :name="item.key"
         :is-new="!item.id"
         :in-list="inList"
         :processing="processing"
         :changed="changed"
         @submit="submit"
         @reset="reset"
         @destroy="destroy">
        <key-input v-if="!inList" v-model="item.key"></key-input>
        <div class="form-group" v-show="item.name">
            <label for="name">Имя</label>
            <input id="name" class="form-control" type="text" v-model="item.name">
        </div>
        <div class="form-group">
            <label for="updated">Обновлено</label>
            <input type="text" class="form-control" v-model="item.updated" v-mask="'datetime'"/>
        </div>
        <div v-if="!item.name && !file">
            <input id="file" type="file" @change="onFileChange">
        </div>
        <div v-else>
            <div style="position:relative;">
                <p>{{ item.name }}</p>
                <a href="javascript:void(0);" style="position:absolute; top: -5px; left: -10px;" @click="removeImage">
                    <i class="fa fa-remove"></i>
                </a>
            </div>
        </div>
    </box>
</template>

<style>

</style>

<script>
    import variable from '../../../mixins/variable'

    import Box from '../components/Box.vue'
    import KeyInput from '../components/KeyInput.vue'

    export default {
        mixins: [variable],
        components: {
            Box,
            KeyInput
        },
        data() {
            return {
                file: null,
                item: {
                    type: 'image',
                    sort: 0,
                    link: false,
                    name: '',
                    updated: '',
                    filename: ''
                }
            }
        },
        mounted() {
            console.log('Component Image mounted.')
            // $(":input").inputmask();
        },
        methods: {
            onFileChange(e) {
                const files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;

                this.file = files[0];
                this.item.name = this.file.name.split('.').slice(0, -1).join('.');
                this.$emit('fileChanged', this);
            },
            removeImage(e) {
                this.file = null;
                this.item.name = '';
            }
        }
    }
</script>
