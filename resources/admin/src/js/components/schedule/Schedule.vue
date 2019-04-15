<template>
    <div class="row">
        <input type="hidden" :name="name" :value="value">
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
            officeType: String
        },
        mounted() {
        },
        data() {
            return {
                items: [
                    {
                        days: [0, 1, 2, 3, 4],
                        time: {
                            work: {
                                start: '09:00',
                                end: '18:00'
                            },
                            breaks: [
                                {
                                    start: '14:00',
                                    end: '15:00'
                                },
                                {
                                    start: '15:30',
                                    end: '16:00'
                                }
                            ]
                        }
                    },
                    {
                        days: [5, 6],
                        time: {
                            work: {
                                start: '10:00',
                                end: '16:00'
                            },
                            breaks: [
                                {
                                    start: '13:00',
                                    end: '14:00'
                                }
                            ]
                        }
                    },
                    {
                        days: '30.04.2019',
                        time: {
                            work: {
                                start: '10:00',
                                end: '16:00'
                            },
                            breaks: [
                                {
                                    start: '13:00',
                                    end: '14:00'
                                }
                            ]
                        }
                    },
                    {
                        days: '01.05.2019',
                        time: null
                    },
                ]
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
            },
            value() {
                return JSON.stringify(this.items);
            }
        }
    }
</script>
