<template>
    <div>
        <button type="button" class="btn btn-sm btn-success" @click="addInput">
            <i class="fa fa-plus-circle"></i>
        </button>
        <div v-for="(item, key) in inputs" :key="key">
            <div class="input-group input-group-sm">
                <div class="input-group-btn">
                    <button type="button" class="btn btn-danger" @click="removeInput(key)">
                        <i class="fa fa-minus-circle"></i>
                    </button>
                </div>
                <input class="form-control" type="text" v-model="inputs[key].phone" v-mask="'phone'" v-focus/>
                <div class="input-group-btn">
                    <button type="button" class="btn btn-warning" @click="toggleDescription(key)">
                        <i class="fa"
                           :class="[inputs[key].description === null ? 'fa-chevron-circle-down' : 'fa-chevron-circle-up']"></i>
                    </button>
                </div>
            </div>
            <input class="form-control" type="text" v-model="inputs[key].description" placeholder="Описание"
                   v-if="inputs[key].description !== null"/>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            value: {
                type: Array,
                default: () => [],
            },
        },
        data() {
            return {
                inputs: this.value,
            }
        },
        methods: {
            addInput() {
                this.inputs.push({phone: '', description: null});
            },
            removeInput(index) {
                this.inputs.splice(index, 1);
            },
            toggleDescription(index) {
                this.inputs[index].description = this.inputs[index].description === null ? '' : null;
            }
        },
        watch: {
            inputs: {
                handler(val) {
                    this.$emit('input', val);
                },
                deep: true,
            }
        }
    }
</script>
