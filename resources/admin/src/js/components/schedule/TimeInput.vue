<template>
    <div>
        <input type="text" class="form-control input-sm" v-model="time" v-timepicker/>
    </div>
</template>

<script>
    export default {
        props: {
            value: String,
            default: '12:00'
        },
        data() {
            return {time: this.value}
        },
        watch: {
            value(val) {
                this.time = val
            },
            time(val) {
                this.$emit('input', val);
            }
        }
    }
</script>
