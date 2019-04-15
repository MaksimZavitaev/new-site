<template>
    <div class="col-sm-6">
        <day-input v-model="day"/>
        <div class="form-group row">
            <div class="checkbox">
                <label>
                    <input type="checkbox" v-model="weekend"> Выходной
                </label>
            </div>
        </div>
    </div>
</template>

<script>
    import DayInput from './DayInput.vue';

    export default {
        components: {
            DayInput
        },
        props: {
            days: String,
            isWeekend: {
                type: Boolean,
                default: false,
            },
        },
        computed: {
            weekend: {
                get() {
                    return this.isWeekend;
                },
                set(val) {
                    this.$emit('changeCheckbox', val);
                }
            },
            day: {
                get() {
                    return this.days;
                },
                set(val) {
                    this.$emit('change', val);
                }
            }
        }
    }
</script>
