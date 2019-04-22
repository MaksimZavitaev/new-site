<template>
    <select2 v-model="selected" :options="items" multiple="multiple"></select2>
</template>

<script>
    import Select2 from '../Select2.vue';

    export default {
        props: {
            options: {
                type: Array,
                default: () => []
            },
            value: Array
        },
        components: {
            Select2,
        },
        data() {
            return {
                lines: {
                    1: {
                        color: 'red',
                        name: 'Сокольническая',
                    },
                    2: {
                        color: 'green',
                        name: 'Замоскворецкая',
                    },
                    3: {
                        color: 'blue',
                        name: 'Арбатско-Покровская',
                    },
                    4: {
                        color: 'lightblue',
                        name: 'Филёвская',
                    },
                    5: {
                        color: 'brown',
                        name: 'Кольцевая',
                    },
                    6: {
                        color: 'orange',
                        name: 'Калужско-Рижская',
                    },
                    7: {
                        color: 'purple',
                        name: 'Таганско-Краснопресненская',
                    },
                    8: {
                        color: 'yellow',
                        name: 'Калининская',
                    },
                    '8A': {
                        color: 'yellow',
                        name: 'Солнцевская',
                    },
                    9: {
                        color: 'gray',
                        name: 'Серпуховско-Тимерязевская',
                    },
                    10: {
                        color: 'lime',
                        name: 'Люблинско-Дмитровская',
                    },
                    11: {
                        color: 'teal',
                        name: 'Большая кольцевая',
                    },
                    '11A': {
                        color: 'teal',
                        name: 'Каховская',
                    },
                    12: {
                        color: 'gray-blue',
                        name: 'Бутовская',
                    },
                    15: {
                        color: 'pink',
                        name: 'Некрасовская',
                    },
                }
            };
        },
        computed: {
            items() {
                return this.options.map(i => ({
                    id: i.id,
                    text: `${i.station} (${this.lines[i.line].name})`,
                    selected: this.selected.includes(i.id),
                }));
            },
            selected: {
                get() {
                    return this.value;
                },
                set(val) {
                    this.$emit('input', val);
                }
            }
        }
    }
</script>
