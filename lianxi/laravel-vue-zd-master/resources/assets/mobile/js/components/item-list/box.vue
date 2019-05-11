<template>
    <div class="item-list">
        <slot></slot>
    </div>
</template>

<script>
    import  {parentMixin} from '../../mixins/multi-items'
    export default {
        name: "switch-box",
        mixins: [parentMixin]
    }
</script>

<style scoped>
.item-list{
    padding:0 20px;
    background-color: white;
}
</style>