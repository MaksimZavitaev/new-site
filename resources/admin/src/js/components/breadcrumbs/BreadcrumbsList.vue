<template>
    <div class="row">
        <button type="button" class="btn btn-sm btn-success" style="margin-left: 15px" @click="addItem">
            <i class="fa fa-plus-circle"></i>
        </button>
        <!--        <draggable v-model="elements" :options="{handle: '.input-group-btn'}">-->
        <item v-for="(item, i) in elements"
              :key="i"
              :index="i"
              :title="item.title"
              :link="item.link"
              @add="add(i)"
              @remove="removeItem(i)"
              v-model="elements[i]">
        </item>
        <!--        </draggable>-->
    </div>
</template>

<script>
    import Item from './Item.vue';
    import Draggable from 'vuedraggable'

    export default {
        components: {
            Item,
            Draggable
        },
        props: {
            items: {
                default: null
            }
        },
        data() {
            return {
                elements: JSON.parse(this.items)
            }
        },
        mounted() {
        },
        methods: {
            addItem() {
                if (this.elements === null) this.elements = [];
                this.elements.push({title: '', link: ''})
            },

            add(i) {
                if (i === this.elements.length - 1) {
                    this.addItem();
                }
            },

            removeItem(i) {
                this.elements.splice(i, 1);
            }
        }
    }
</script>
