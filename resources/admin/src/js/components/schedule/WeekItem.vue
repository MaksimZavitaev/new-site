<template>
    <div class="row">
        <s-week :days="item.days" @changed="updateDays"></s-week>
        <s-time :time="item.time" @changed="updateTime">
            <template v-slot:remove>
                <i class="fa fa-times" @click="$emit('remove')"></i>
            </template>
        </s-time>
    </div>
</template>

<script>
    import SWeek from './Week.vue'
    import STime from './Time'

    export default {
        props: {
            value: {}
        },
        components: {
            SWeek,
            STime
        },
        computed: {
            item: {
                get() {
                    return this.value;
                },
                set(val) {
                    return this.$emit('input', val);
                }
            }
        },
        methods: {
            updateDays(days) {
                this.item.days = days;
            },
            updateTime(time) {
                this.item.time = time;
            }
        }
    }
</script>
