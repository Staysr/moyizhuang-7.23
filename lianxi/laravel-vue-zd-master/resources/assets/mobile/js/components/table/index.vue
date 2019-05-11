<template>
    <div class="pages-tables">
        <div class="rolling-table meal-table" :class="uuid">
            <div class="table" :style="{width: trWidth + 'px'}">
                <div class="header tr">
                    <div class="rows th"
                         v-for="(item,index) in column" :style="{width: (item.width || widths[index]) + 'px'}"
                         :class="{'cross': item.fixed}"
                         :key="index">{{item.name}}
                    </div>
                </div>
                <div class="tbody tr" v-for="(row,key) in data" :key="key + 'a'">
                    <template v-for="(item, index) in column">
                        <div :style="{width: (item.width || widths[index]) + 'px'}"
                             class="td"
                             :class="{'cols': item.fixed}">
                            <i-expand v-if="item.render" :row="row" :column="item" :index="index"
                                      :render="item.render"></i-expand>
                            <span v-else>{{row[item.field]}}</span>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import {createIScroller, refreshScroller} from "../../plugins/iscrollTable/index";
    import IExpand from './expand'
    import uuid from "../../../../admin/js/mixins/uuid";
    export default {
        name: 'is-table',
        components: {IExpand},
        mixins: [uuid],
        props: {
            column: {
                type: Array,
                default: () => []
            },
            data: {
                type: Array,
                default: () => []
            },
            height: [Number]
        },
        data() {
            return {
                iScroller: null,
                widths: [],
                scroller: {}
            }
        },
        computed: {
            trWidth() {
                let w = 0;
                this.widths.forEach((item, index) => {
                    w += item;
                });
                return w;
            }
        },
        mounted() {
            this.init()
        },
        methods: {
            refresh() {
                refreshScroller(this.iScroller, "." + this.uuid)
            },
            init: function () {
                let $this = this, selector = document.querySelectorAll('.' + this.uuid + ' .header .rows');

                for (let i = 0; i < selector.length; i++) {
                    this.widths.push(selector[i].offsetWidth + 1);
                }

                this.iScroller = createIScroller("." + this.uuid);

                this.iScroller.on('scrollStart', () => {
                    this.scroller.x = this.iScroller.x;
                    this.scroller.y = this.iScroller.y;
                });


                this.iScroller.on('scrollEnd', () => {
                    if (this.scroller.x !== this.iScroller.x) {
                        if (this.iScroller.x === this.iScroller.maxScrollX) {
                            $this.$emit('on-scroll-x-bottom')
                        }
                        if (this.iScroller.x === 0) {
                            $this.$emit('on-scroll-x-top')
                        }
                    }

                    if (this.scroller.y !== this.iScroller.y) {
                        if (this.iScroller.y === this.iScroller.maxScrollY) {
                            $this.$emit('on-scroll-y-bottom')
                        }
                        if (this.iScroller.y === 0) {
                            $this.$emit('on-scroll-y-top')
                        }
                    }

                    this.scroller.x = this.iScroller.x;
                    this.scroller.y = this.iScroller.y;
                });
            }
        }
    }

</script>
<style lang="less" scoped>
    .pages-tables {
        -webkit-overflow-scrolling: touch;
        position: relative;
    }

    .rolling-table {
        height: 100%;
        font-size: 0.28rem;
        color: #86939a;
        background-color: #fff;
        width: 100%;
        -webkit-overflow-scrolling: touch;
        position: relative;
        top: 0;
        overflow: hidden;
    }

    .rows {
        position: relative;
        z-index: 3;
    }

    .cross {
        position: relative;
        z-index: 5;
    }

    .table .td {
        border: 0px solid #000;
        font-size: 0.32rem;
        background: #fff;
    }

    ::-webkit-scrollbar {
        display: none;
    }

    .table {
        /*//   border-collapse: collapse; //去掉重复的border*/
        color: #86939e;
        font-size: 0.32rem;
        border: 0px solid #000;
        min-height: 100%;
        text-align: center;
        .td {
            white-space: nowrap;
            padding: 0;
            float: left;
            box-sizing: border-box;
            font-size: 28px;
            height: 98px;
            line-height: 98px;
            border-top: 1px solid transparent;
            border-left: 1px solid transparent;
            border-right: 1px solid transparent;
            border-bottom: 1px solid #eee;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .th {
            color: #43484d;
            white-space: nowrap;
            font-weight: normal;
            padding: 0;
            background-color: #f8f8f8;
            display: inline-block;
            box-sizing: border-box;
            float: left;
            font-size: 30px;
            height: 98px;
            line-height: 98px;
            border-bottom: 1px solid #eee;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    }

    .tr {
        position: relative;
        box-sizing: border-box;
        &::after {
            clear: both;
            content: '';
            display: block;
            width: 0;
            height: 0;
            visibility: hidden;
        }
    }

    .phonecall {
        height: 60px;
        width: 60px;
        background: url('../../../images/phonecall.png') no-repeat center center;
        background-size: cover;
        display: inline-block;
        vertical-align: middle;
        text-align: center;
    }

    .active {
        box-shadow: 4px 2px 15px -2px rgba(0, 0, 0, .2);
    }
</style>