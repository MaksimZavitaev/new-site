<template>
    <div class="box box-warning" :class="{'collapsed-box': !isNew && !inList && collapsed}" @keyup.ctrl.enter="submit">
        <div class="box-header" @click="collapsed = !collapsed">
            <h3 class="box-title" v-if="!inList">
                {{ title }}
                <small>({{ name }})</small>
            </h3>
            <i class="fa fa-arrows-v" style="font-size: 12px;" v-else></i>
            <div class="box-tools">
                <button type="button" class="btn btn-box-tool" v-if="!inList">
                    <i class="fa" :class="[collapsed ? 'fa-plus' : 'fa-minus']"></i>
                </button>
                <delete-button class="btn-box-tool" @destroyed="destroy" v-if="inList"></delete-button>
            </div>
        </div>
        <div class="box-body">
            <slot/>
        </div>
        <div class="box-footer">
            <button class="btn btn-warning btn-sm" @click="reset()" v-show="!isList && changed">Сброс</button>
            <button class="btn btn-success btn-sm" @click="submit()" v-show="changed">Сохранить</button>
            <delete-button class="btn-sm pull-right" @destroyed="destroy" v-if="!inList"></delete-button>
        </div>
        <div class="overlay" v-show="processing">
            <i class="fa fa-refresh fa-spin"></i>
        </div>
    </div>
</template>

<script>
    import DeleteButton from './DeleteButton.vue'

    export default {
        components: {
            DeleteButton
        },
        props: {
            title: {
                type: String,
            },
            name: {},
            isList: {
                type: Boolean,
                default: false,
            },
            inList: {
                type: Boolean,
                default: false,
            },
            isNew: {
                type: Boolean,
                default: false
            },
            changed: {
                type: Boolean,
                default: false,
            },
            processing: {
                type: Boolean,
                default: false,
            }
        },
        data() {
            return {
                confirmDelete: false,
                collapsed: true,
            }
        },
        methods: {
            reset() {
                this.$emit('reset')
            },
            submit() {
                this.$emit('submit')
            },
            destroy() {
                this.$emit('destroy')
            }
        }
    }
</script>
