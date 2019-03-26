<template>
    <box title="Изображение"
         :name="item.key"
         :is-new="!item.id"
         :in-list="inList"
         :processing="processing"
         :changed="changed"
         @submit="submit"
         @reset="reset"
         @destroy="destroy">
        <key-input v-if="!inList" v-model="item.key"></key-input>
        <div class="form-group">
            <label for="alt">Alt</label>
            <input id="alt" class="form-control" type="text" v-model="item.alt">
        </div>
        <div v-if="!item.url && !file">
            <input id="file" type="file" accept="image/*" @change="onFileChange">
        </div>
        <div v-else>
            <div style="position:relative;">
                <img class="img-responsive" width="100" height="100" :src="item.url"/>
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
                    filename: '',
                    url: '',
                    alt: ''
                }
            }
        },
        mounted() {
            console.log('Component Image mounted.')
        },
        methods: {
            onFileChange(e) {
                const files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;

                if (files[0].name.match(/\.(jpg|jpeg|png|gif|svg)$/)) {
                    this.file = files[0];
                    this.createImage(files[0]);
                }
                this.$emit('fileChanged', this);
            },
            createImage(file) {
                const reader = new FileReader();
                const self = this;

                reader.onload = e => {
                    self.item.url = e.target.result;
                };
                reader.readAsDataURL(file);
            },
            removeImage(e) {
                this.file = null;
                this.item.url = '';
            }
        }
    }
</script>
