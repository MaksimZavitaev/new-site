<template>
    <box :name="item.key"
         :is-new="!item.id"
         :in-list="inList"
         :processing="processing"
         :changed="changed"
         @submit="submit"
         @reset="reset"
         @destroy="destroy">
        <key-input v-if="!inList" v-model="item.key"></key-input>
        <div class="form-group">
            <label for="value">Значение</label>
            <textarea id="value" class="form-control" type="text" v-model="item.value"></textarea>
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
                    type: 'text',
                    name: '',
                    sort: 0,
                    title: {
                        href: false,
                        text: ''
                    },
                    value: ''
                }
            }
        },
        mounted() {
            console.log('Component String mounted.')
        }
    }
</script>
