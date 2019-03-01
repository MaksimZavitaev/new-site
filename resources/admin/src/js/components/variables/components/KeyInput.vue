<template>
    <div class="form-group" :class="{'has-error': message}">
        <label for="key">Ключ</label>
        <input id="key" class="form-control" type="text" :value="value" @input="input" @focusout="transform">
        <span id="helpBlock2" class="help-block" v-show="message">{{ message }}</span>
    </div>
</template>

<script>
    import {debounce, camelCase} from 'lodash'
    import slugify from 'slugify'

    export default {
        name: 'key-input',
        componentName: 'KeyInput',
        props: {
            value: ''
        },
        data() {
            return {
                message: false
            }
        },
        mounted() {
            this.$on('handleError', message => this.message = message);
        },
        methods: {
            input: debounce(function (e) {
                this.$emit('input', e.target.value)
            }, 800),
            transform(e) {
                this.$emit('input', camelCase(slugify(e.target.value)))
            }
        }
    }
</script>
