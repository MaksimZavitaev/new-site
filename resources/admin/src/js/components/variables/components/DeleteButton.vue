<template>
    <button class="btn" :class="{'btn-danger': confirmed}" @click="confirm">
        <i class="fa fa-trash-o" :class="{'text-danger': !confirmed}"></i>
    </button>
</template>

<script>
    export default {
        data() {
            return {
                confirmed: false,
            }
        },
        methods: {
            confirm() {
                if (this.confirmed) {
                    this.destroy();
                    return;
                }
                this.confirmed = true;
            },
            destroy() {
                this.$emit('destroyed');
            }
        },
        watch: {
            confirmed() {
                if (this.confirmed) {
                    setTimeout(() => {
                        this.confirmed = false;
                    }, 3000)
                }
            }
        }
    }
</script>
