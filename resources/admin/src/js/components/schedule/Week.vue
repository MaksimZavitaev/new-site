<template>
    <div class="col-sm-6">
        <div class="form-group row">
            <div class="btn-group btn-group-sm">
                <button type="button"
                        class="btn"
                        v-for="(day, index) in week"
                        :class="[isActive(index) ? 'btn-warning' : 'btn-default']"
                        @click="toggle(index)"
                >
                    {{day}}
                </button>
            </div>
        </div>
        <div class="form-group row">
            <div class="btn-group btn-group-sm btn-group-justified">
                <div class="btn-group btn-group-sm">
                    <button type="button" class="btn btn-default" @click="selectWeekday">будни</button>
                </div>
                <div class="btn-group btn-group-sm">
                    <button type="button" class="btn btn-default" @click="selectWeekend">выходные</button>
                </div>
                <div class="btn-group btn-group-sm">
                    <button type="button" class="btn btn-default" @click="selectWeek">ежедневно</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            days: Array
        },
        data() {
            return {
                week: [
                    'пн',
                    'вт',
                    'ср',
                    'чт',
                    'пт',
                    'сб',
                    'вс',
                ],
                items: this.days
            }
        },
        watch: {
            items(items) {
                this.$emit('changed', items);
            }
        },
        methods: {
            add(index) {
                this.items.push(index);
            },
            remove(index) {
                this.items.splice(this.items.indexOf(index), 1)
            },
            toggle(index) {
                const action = this.isActive(index) ? this.remove : this.add;
                action(index);
            },
            isActive(index) {
                return this.items.indexOf(index) > -1;
            },
            selectWeekday() {
                this.items = [...Array(5).keys()]
            },
            selectWeekend() {
                this.items = [5, 6];
            },
            selectWeek() {
                this.items = [...Array(7).keys()]
            }
        }
    }
</script>
