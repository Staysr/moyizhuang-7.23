<template>
    <Modal :title="title" :value="true" @on-visible-change="change" :transfer="false" :mask-closable="false" style="position: relative;"
           :width="width">
        <Spin size="large" fix v-if="loading"></Spin>
        <div class="modal-body">
            <slot></slot>
        </div>
        <div slot="footer">
            <slot name="footer"></slot>
        </div>
    </Modal>
</template>

<script>
    export default {
        name: "component-modal",
        props: {
            title: {
                type: String,
                default: '弹窗'
            },
            width: {
                type: Number,
                default: 650
            },
            loading: {
                type: Boolean,
                default: false
            }
        },
        methods: {
            change(v) {
                this.$parent.$emit('on-change')
            }
        }
    }
</script>

<style scoped>
    .modal-body {
        max-height: 650px;
        overflow-y: auto;
    }
</style>