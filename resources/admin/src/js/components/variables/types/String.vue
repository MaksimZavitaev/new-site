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
            <input id="value" class="form-control" type="text" v-model="item.value" v-focus>
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
        name: 'v-string',
        mixins: [
            variable
        ],
        components: {
            Box,
            KeyInput,
        },
        data() {
            return {
                item: {
                    type: 'string',
                    name: '',
                    sort: 0,
                    value: ''
                }
            }
        },
        mounted() {
            console.log('Component String mounted.')
        }
    }
</script>
