<template>
    <box title="Ссылка"
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
            <label>
                <input type="checkbox" class="flat-orange" v-model="item.blank">
                Открывать в новой вкладке
            </label>
        </div>
        <div class="form-group">
            <label for="href">Ссылка</label>
            <input id="href" class="form-control" type="text" v-model="item.href">
        </div>
        <div class="form-group">
            <label for="text">Текст</label>
            <input id="text" class="form-control" type="text" v-model="item.text">
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
                item: {
                    type: 'link',
                    name: '',
                    sort: 0,
                    blank: false,
                    href: '',
                    text: ''
                }
            }
        },
        mounted() {
            $('input[type="checkbox"].flat-orange, input[type="radio"].flat-orange').iCheck({
                checkboxClass: 'icheckbox_flat-orange',
                radioClass: 'iradio_flat-orange'
            });
            console.log('Component String mounted.');
        }
    }
</script>
