<template>
    <div class="choose">
        <div class="item" :class="{'item-select': index === 0}" @click="onClick(0)">
            <div class="title">全部({{all}})</div>
        </div>
        <div class="item" :class="{'item-select': index === 1}" @click="onClick(1)">
            <div class="title">
                <span class="icon">
                    运单中({{has}})
                </span>
                </div>
        </div>
        <div class="item" :class="{'item-select': index === 2}" @click="onClick(2)">
            <div class="title no_order">未出车({{noWork}})</div>
        </div>
        <div class="result" :class="{'item-show': sShow === true && index === 1}">
            <!--<div class="item" :class="{'item-select': sIndex }"
                 @click="sOnClick(index)">-->
            <div class="item" :class="{'item-select': sIndex == 0}"
                 @click="sOnClick(0)">
                <span class="orange icon"></span>
                <span class="result_item_name">小B业务运单中({{work}})</span>
            </div>
            <div class="item" :class="{'item-select': sIndex === 1}" @click="sOnClick(1)">
                <span class="violet icon"></span>
                <span class="result_item_name">大B业务运单中({{bigWork}})</span>
            </div>
            <div class="item" :class="{'item-select': sIndex === 2}" @click="sOnClick(2)">
                <span class="green icon"></span>
                <span class="result_item_name">空闲({{noHas}})</span>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "choose",
        props: {
            noHas: {
                type: Number,
                default: 0
            },
            bigWork: {
                type: Number,
                default: 0
            },
            work: {
                type: Number,
                default: 0
            },
            noWork: {
                type: Number,
                default: 0
            }
        },
        data: () => ({
            index: 0,
            sIndex: undefined,
            sShow: false
        }),
        computed: {
            all() {
                return this.noWork + this.bigWork + this.work + this.noHas;
            },
            has() {
                return this.bigWork + this.work + this.noHas;
            }
        },
        methods: {
            onClick(index) {
                this.index = index
                if (index === 1) {
                    this.sShow = true
                    this.$emit('on-change', index)
                } else {
                    this.sIndex = undefined
                    this.$emit('on-change', index)
                }
            },
            sOnClick(index) {
                this.sIndex = index
                this.sShow = false
                this.$emit('on-change', 's_' + index)
            }
        }
    }
</script>

<style scoped lang="less">
    @import '../../../../less/choose';
    
</style>