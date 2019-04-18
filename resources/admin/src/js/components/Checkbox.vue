<template>
    <input type="checkbox" v-model="value">
</template>

<script>
    export default {
        props: {
            value: {
                required: true,
            },
        },
        mounted() {
            const $vm = this;

            $(this.$el)
                .iCheck({
                    checkboxClass: 'icheckbox_flat-orange',
                    radioClass: 'iradio_flat-orange'
                })
                .on('ifChecked', () => {
                    $vm.$emit('input', $vm.v = true);
                })
                .on('ifUnchecked', () => {
                    $vm.$emit('input', $vm.v = false);
                });
        },
        destroyed() {
            $(this.$el).iCheck('destroy');
        },
        watch: {
            value(val) {
                $(this.$el).iCheck(val ? 'check' : 'uncheck');
            }
        }
    }
</script>
