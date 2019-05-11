<template>
    <div class="item"  :class="{'item-select': currentSelected, 'item-drop-down': dropDown}" @click="onUpdatePopper" ref="reference">
        <div class="title" @click="onClick">
            <slot></slot>
            <template v-if="dropDown">
                <span v-if="!currentSelected" class="up icon"></span>
                <span v-if="currentSelected" class="down icon"></span>
            </template>
        </div>
        <drop  v-show="currentSelected && showChildren && hasChildren"
               class="children"
               @on-click="childrenClick"
               v-transfer-dom
               :data-transfer="true"
               :transfer="true">
            <div class="children-item">
                <slot name="children"></slot>
            </div>
            <div class="mask"></div>
        </drop>
    </div>
</template>

<script>
    import  {childMixin} from '../../mixins/multi-items'
    import transferDom from '../../directives/transfer-dom'
    import Drop from "../popper/index";
    import Emitter from "../../mixins/emitter"

    export default {
        name: "switch-item",
        components: {Drop},
        mixins: [childMixin, Emitter],
        props: {
            dropDown: Boolean
        },
        directives: {transferDom},
        data(){
            return {
                showChildren: false
            }
        },
        computed: {
            hasChildren(){
                return Boolean(this.$slots.children)
            }
        },
        methods: {
            onClick(){
                this.onItemClick();
                this.showChildren = true;
                this.$parent.$emit('on-children-show', true)

            },
            childrenClick(){
                this.showChildren = false
                this.$parent.$emit('on-children-show' , false)
            },
            onUpdatePopper(){
                this.broadcast('Drop', 'on-update-popper');
            }
        }
    }
</script>

<style scoped lang="less">
    .children{
        z-index: 9;
        overflow-y: scroll;
        width: 100%;
        height: 100%;
        .children-item{
            position: relative;
            z-index: 9;
        }
        .mask{
            width: 100%;
            height: 100%;
            position: absolute;
            background-color: #0D0D0D;
            opacity: 0.3;
            z-index:8;
            top:0;
        }
    }
    .title{
        position: relative;
        .icon{
            border: 13px solid transparent;
            display:inline-block;
            position: absolute;
            right: 13px;
            bottom: 25px;
        }
        .up {
            border-top-color: #969696;
        }
        .down {
            border-bottom-color: #07CA61;
            bottom: 40px;
        }
    }
    .item-drop-down{
        .title{
            &::after{
                display: none;
            }
        }
    }

</style>