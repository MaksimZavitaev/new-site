<template>
    <select>
        <slot></slot>
    </select>
</template>
<script>
    export default {
        props: {
            options: Array,
            value: {
                type: Array,
                default: () => [],
            },
        },
        data() {
            return {
                items: [],
            }
        },
        mounted: function () {
            const vm = this;
            $(this.$el)
            // init select2
                .select2({data: this.options})
                .val(this.value)
                // emit event on change.
                .on('change', function (e, external) {
                    if (!external)
                        vm.$emit('input', $(this).val())
                });
        },
        watch: {
            value: function (value) {
                if ([...value].sort().join(",") !== [...$(this.$el).val()].sort().join(",")) {
                    $(this.$el).val(value).trigger('change', true);
                }
            },
            options: function (options) {
                // update options
                $(this.$el).select2({data: options})
            }
        },
        destroyed: function () {
            $(this.$el).off().select2('destroy')
        }
    }
</script>
