<template>
    <div>
        <div class="col-md-4">
            <div class="input-group input-group-sm">
                <div class="input-group-btn">
                    <button type="button" class="btn btn-danger" @click="$emit('remove')">
                        <i class="fa fa-minus-circle"></i>
                    </button>
                </div>
                <!-- /btn-group -->
                <input
                    type="text"
                    class="form-control"
                    :name="`breadcrumbs[${index}][title]`"
                    v-model="value.title"
                    placeholder="Заголовок"
                    v-focus>
            </div>
        </div>
        <div class="col-md-8">
            <input
                type="text"
                class="form-control input-sm"
                :name="`breadcrumbs[${index}][link]`"
                v-model="value.link"
                placeholder="Ссылка"
                @keydown.tab="$emit('add')">
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            index: {
                type: Number
            },
            value: {}
        }
    }
</script>
