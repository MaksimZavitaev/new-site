<template>
    <div class="row">
        <slot name="header"></slot>
        <div class="col-sm-12">
            <component
                v-for="(item, index) in items"
                :key="index"
                v-model="items[index]"
                :is="Array.isArray(item.days) ? 'week-item' : 'day-item'"
                @remove="remove(index)"
            ></component>
        </div>
        <div class="col-sm-12">
            <div class="form-group row">
                <div class="btn-group btn-group-sm btn-group-justified" role="group"
                     aria-label="...">
                    <div class="btn-group btn-group-sm" role="group">
                        <button type="button" class="btn btn-default" @click="add(false)">
                            добавить
                        </button>
                    </div>
                    <div class="btn-group btn-group-sm" role="group">
                        <button type="button" class="btn btn-default" @click="add(true)">
                            добавить праздничный день
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import WeekItem from './WeekItem.vue'
    import DayItem from './DayItem.vue'

    export default {
        componentName: 'schedule',
        components: {
            WeekItem,
            DayItem,
        },
        props: {
            value: Array
        },
        mounted() {
            this.items = this.value || [];
        },
        data() {
            return {
                items: []
            }
        },
        methods: {
            add(holiday) {
                this.items.push({
                    days: holiday ? '' : [],
                    time: {
                        work: {
                            start: '00:00',
                            end: '00:00'
                        },
                        breaks: [
                            {
                                start: '12:00',
                                end: '12:00'
                            }
                        ]
                    }
                });
            },
            remove(index) {
                this.items.splice(index, 1);
            }
        },
        computed: {
            name() {
                return `schedule[${this.officeType}]`;
            }
        },
        watch: {
            items: {
                handler(val) {
                    this.$emit('input', val);
                },
                deep: true,
            }
        }
    }
</script>
