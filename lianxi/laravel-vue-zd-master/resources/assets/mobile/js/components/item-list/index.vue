<template>
    <div class="item"  :class="{'item-select': currentSelected, 'item-drop-down': dropDown}" @click="onClick">
        <slot></slot>
    </div>
</template>

<script>
    import  {childMixin} from '../../mixins/multi-items'

    export default {
        name: "switch-item",
        mixins: [childMixin],
        props: {
            dropDown: Boolean,
            name:{}
        },
        methods: {
            onClick(){
                this.onItemClick();
                this.$parent.$emit('on-change', this.name);
            }
        }
    }
</script>

<style scoped lang="less">
.item{
    line-height: 88px;
    height: 88px;
    font-size: 30px;
    border-bottom: 1px solid #eee;
    box-sizing: border-box;
    padding: 0 20px;
    position: relative;
    text-align: left;
    &::after {
        border-bottom: 1px solid transparent;
    }
}
.item-select.item-drop-down{
    color: #07ca61!important;
}
.item-select.item-drop-down::after {
    content: "";
    height: 30px;
    width: 3px;
    background: #07CA61;
    display: inline-block;
    transform: rotate(45deg);
    position: absolute;
    right: 24px;
    top: 32%;
}
.item-select.item-drop-down::before{
    content: "";
    height: 16px;
    width: 3px;
    background: #07CA61;
    display: inline-block;
    transform: rotate(-45deg);
    position: absolute;
    right: 40px;
    top: 45%;
}
</style>