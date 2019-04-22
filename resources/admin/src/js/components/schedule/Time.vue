<template>
    <div class="col-sm-6">
        <div class="form-group row">
            <div class="col-sm-3">
                <button type="button" class="btn btn-sm btn-default" @click="allTime">24 ч.</button>
            </div>
            <time-input v-model="time.work.start" class="col-sm-4"/>
            <time-input v-model="time.work.end" class="col-sm-4"/>
            <slot name="remove"/>
        </div>
        <div class="form-group">
            <template v-for="(item, index) in time.breaks">
                <div class="row">
                    <div class="col-sm-3" v-if="index < 1">
                        перерыв:
                    </div>
                    <time-input
                        class="col-sm-4"
                        :class="{'col-sm-offset-3': index > 0}"
                        v-model="time.breaks[index].start"
                    />
                    <time-input
                        class="col-sm-4"
                        v-model="time.breaks[index].end"
                    />
                    <i class="fa fa-times" v-if="index > 0" @click="remove(index)"></i>
                    <i class="fa fa-plus" v-else @click="add"></i>
                </div>
            </template>
        </div>
    </div>
</template>

<script>
    import TimeInput from './TimeInput.vue'

    export default {
        components: {
            TimeInput,
        },
        props: {
            time: {}
        },
        data() {
            return {
                item: this.time,
            }
        },
        methods: {
            allTime() {
                this.item.work = {start: '00:00', end: '00:00'}
            },
            add() {
                this.time.breaks.push({start: '12:00', end: '12:00'})
            },
            remove(index) {
                this.time.breaks.splice(index, 1);
            },
        },
    }
</script>
