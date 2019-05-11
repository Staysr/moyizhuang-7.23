<template>
    <div class="main" v-if="value">

        <m-header @on-click-left="cancel">
            <slot></slot>
        </m-header>

        <search-input v-model="keyword"  @on-cancel="cancel"></search-input>

        <transition name="fade">
            <div v-if="showItems" class="scroll">
                <item-box @on-change="change">
                    <item-input v-for="(item, index) in showValues" :name="item" :key="index">{{ formatField
                        (item) }}</item-input>
                </item-box>
            </div>
        </transition>

        <div class="scroll empty" v-if="!showItems">
            <div class="icon"></div>
            <div class="text">搜索暂无结果</div>
        </div>
    </div>
</template>

<script>
    import SearchInput from "./components/input";
    import MHeader from "../header/index";

    import ItemBox from "../item-list/box";
    import ItemInput from "../item-list/index";


    export default {
        name: "m-search",
        components: {ItemInput, ItemBox, SearchInput, MHeader},
        props: {
            data: {
                type: Array,
                default: () => []
            },
            value: {
                type: Boolean,
                default: false
            },
            searchField:{
                type: String,
                default: 'name'
            }
        },
        data() {
            return {
                keyword: '',
                showValues: []
            }
        },
        computed: {
            showItems() {
                return this.showValues.length > 0;
            }
        },
        methods: {
            change(value) {
                this.$emit('on-change', value)
                this.$emit('input', false)
                this.keyword = ''
            },
            cancel() {
                this.$emit('input', false)
                this.keyword = ''
            },
            formatField(item){
                let arr = this.searchField.split('.');
                arr.forEach((key) => {
                    item = item[key] || ''
                })
                return item
            }
        },
        watch: {
            keyword(value){
                if (value === '') {
                    this.showValues =  []
                }else{
                    this.showValues = this.data.filter((val) => {
                        let item = this.formatField(val)
                        return item.indexOf(value) > -1
                    })
                }
            }
        }
    }
</script>

<style scoped lang="less">
    .main {
        position: absolute;
        z-index: 10000000;
        top: 0;
        bottom: 0;
        background-color: #eee;
        .scroll {
            padding-bottom: 180px;
            box-sizing: border-box;
        }
        .empty {
            color: #666;
            .icon {
                margin: 150px auto 0;
                width: 326px;
                height: 208px;
                background-size: 100% 100%;
                background-image: url("/images/mobile/search_icon.png");
            }
            .text {
                font-size: 28px;
                color: #ccc;
                text-align: center;
                margin-top: 20px;
            }
        }
    }
</style>