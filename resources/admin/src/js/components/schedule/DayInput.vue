<template>
    <div class="input-group input-group-sm row">
        <input type="text" class="form-control input-sm" v-model="date" v-datepicker/>
        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
    </div>
</template>

<script>
    export default {
        props: {
            value: String,
            default() {
                return new Date();
            }
        },
        data() {
            return {date: this.value}
        },
        watch: {
            value(val) {
                this.date = val
            },
            date(val) {
                this.$emit('input', val);
            }
        }
    }
</script>
