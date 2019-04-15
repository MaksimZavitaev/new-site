<template>
    <div class="row">
        <s-day
            :days="item.days"
            :is-weekend="isWeekend"
            @changeCheckbox="setTime"
            @change="setDay"></s-day>
        <s-time
            :time="item.time"
            v-if="item.time">
            <template v-slot:remove>
                <i class="fa fa-times" @click="$emit('remove')"></i>
            </template>
        </s-time>
        <div class="col-sm-6" v-else>
            <i class="fa fa-times pull-right" @click="$emit('remove')"></i>
        </div>
    </div>
</template>

<script>
    import SDay from './Day.vue'
    import STime from './Time.vue'

    export default {
        props: {
            value: {}
        },
        components: {
            SDay,
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
            },
            isWeekend: {
                get() {
                    return !this.item.time
                },
                set(val) {
                    if (this.item)
                        this.item.time = val;
                }
            }
        },
        methods: {
            setTime(val) {
                this.item.time = !val ? {
                    work: {
                        start: '',
                        end: ''
                    },
                    breaks: [
                        {
                            start: '',
                            end: ''
                        }]
                } : null;
            },
            setDay(val) {
                this.item.days = val;
            }
        }
    }
</script>
