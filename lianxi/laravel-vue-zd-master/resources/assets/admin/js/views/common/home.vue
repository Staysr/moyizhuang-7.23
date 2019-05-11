<template>
    <div>
        <div class="top">
            <Input search v-model="search_val" placeholder="请输入商户简称/线路名称/司机姓名">
            <Select slot="prepend" v-model="search_sel" style="width: 80px">
                <Option value="merchants">商户</Option>
                <Option value="task">线路</Option>
                <Option value="driver">司机</Option>
            </Select>
            <Button slot="append" icon="ios-search" @click="search()"></Button>
            </Input>
            <div :style="{marginLeft:'5rem'}">
                <span class="btn btn-radius-left pointer" @click="settime()">
                    <Icon type="md-sync" />&nbsp;刷新</span>
                <span class="btn pointer" @click="cejuf()">
                    <Icon type="md-color-filter" />&nbsp;测距</span>
                <span class="btn btn-radius-right pointer" v-show="marker_visi" @click="marker_isvisi()">
                    <Icon type="ios-eye-off" />&nbsp;隐藏配送点</span>
                <span class="btn btn-radius-right pointer" v-show="!marker_visi" @click="marker_isvisi()">
                    <Icon type="ios-eye" />&nbsp;显示配送点</span>
            </div>
            <div :style="{marginLeft:'5rem'}">
                <span class="btn btn-radius-left">订单:待配送
                    <b class="icon-yellow">&nbsp;{{point[0]}}</b>
                </span>
                <span class="btn">已妥投
                    <b class="icon-green">&nbsp;{{point[1]}}</b>
                </span>
                <span class="btn btn-radius-right">未妥投
                    <b class="icon-red">&nbsp;{{point[2]}}</b>
                </span>
            </div>
            <div class="tip">
                <ul>
                    <li @click="last()">昨天</li>
                    <li @click="getTime()">今天</li>
                    <li @click="next()">明天</li>
                </ul>
            </div>
            <DatePicker :open="open" :value="time" confirm type="date" @on-change="handleChange" @on-clear="handleClear" @on-ok="handleOk">
                <div class="time_box">
                    <div class="time_temp">{{time | timeformat}}</div>
                    <a href="javascript:void(0)" @click="handleClick" class="time_icon">
                        <Icon type="ios-calendar-outline"></Icon>
                    </a>
                </div>
            </DatePicker>
        </div>
        <div style="padding: 20px;position:absolute;z-index:9999;top:1.9rem;z-index:1;">
            <Card :bordered="false" :style="{borderRadius:'5px',border:'1px solid #dadada'}" v-show="cardflag">
                <table class="card_table">
                    <tbody>
                        <tr>
                            <td rowspan="2" @click="settime()">全部 {{status[0]+status[1]+status[2]+status[3]+status[4]+status[6]}}</td>
                            <td @click="tab(0)">未签到 {{status[0]}}</td>
                            <td @click="tab(1)">签到 {{status[1]}}</td>
                            <td @click="tab(2)">配送中 {{status[2]}}</td>
                        </tr>
                        <tr>
                            <td @click="tab(3)">已完成 {{status[3]}}</td>
                            <td @click="tab(4)">不配送 {{status[4]}}</td>
                            <td @click="tab(6)">取消 {{status[6]}}</td>
                        </tr>
                    </tbody>
                </table>
                <Card style="width:350px;font-size:12px;margin-bottom:6px;" v-for="(i,index) in list.data" :key="index">
                    <p slot="title">
                        <span class="temporary">{{i.task.type == 1?"主":"临"}}</span>
                        <span :style="{margin:'0 0.2rem'}" class="nameFormat">{{i.name}}</span>
                        <span :style="{margin:'0 0.2rem'}" class="nameFormat">{{i.merchant.short_name}}</span>
                        <a slot="extra" @click="task(i)">
                            任务详情
                        </a>
                    </p>
                    <a slot="extra" @click="car_close(i)">
                        详情
                        <Icon type="md-arrow-dropright" />
                    </a>
                    <div @click="card_coor(i)" class="card_body">
                        <p>{{i.car_type.name}}
                        </p>
                        <router-link to="task.create" :style="{color:'#515a6e'}">{{i.driver.name}}{{i.driver.phone}}</router-link>
                        <br />{{status_type[i.status]}}{{i.late}}<br /> 到仓时间：{{i.arrival_warehouse_time}}

                    </div>
                </Card>
                <div :style="{textAlign: 'right'}">
                    <Button type="dashed" :style="{color:'#2b85e4'}" @click="prev_page()">上一页</Button>{{list.current_page}}/{{list.last_page}}
                    <Button type="dashed" :style="{color:'#2b85e4'}" @click="last_page()">下一页</Button>
                </div>
                <div :style="{textAlign: 'right'}">
                    <Button type="primary" ghost to="task.create/?type=1">+招主司机</Button>
                    <Button type="primary" to="task.create/?type=2">+招临时司机</Button>
                </div>
            </Card>
            <span class="cardmin" @click="cardmin()">
                {{pack}}
            </span>
        </div>
        <div class="amap-page-container">
            <el-amap vid="amapDemo" ref="amap" :amap-manager="amapManager" :center="center" :events="events" class="amap-demo" :zoom="zoom">
                <template v-for="(item, index) in markers.data">
                    <el-amap-marker vid="car-marker" :key="`car${index}`" v-if="item.position" :position="item.position.location" :ext-data="item" :events="makerEvents" :content-render="markers.car"></el-amap-marker>
                    <el-amap-marker vid="warehouse-marker" :key="`warehouse${index}`" v-if="item.warehouse.location" :position="item.warehouse.location" :events="makerEvents" :ext-data="item.warehouse" :content-render="markers.warehouse"></el-amap-marker>
                    <el-amap-marker v-for="(val, key) in item.delivery" vid="delivery-marker" :key="`${index}-${key}`" :position="val.location" :events="makerEvents" :ext-data="val" class="amap-marker" :visible="marker_visi" :content-render="markers.delivery">
                    </el-amap-marker>
                </template>
                <el-amap-info-window v-if="position" :position="position" :events="windowEvents" :content="content"></el-amap-info-window>
            </el-amap>
        </div>

        <components v-bind:is="component.current" :data="component.data" @on-change="hideComponent"></components>

        <div class="prompt">
            <span class="tools">
                <i class="yellow"></i> 待配送
            </span>
            <span class="tools">
                <i class="green"></i> 已妥投
            </span>
            <span class="tools">
                <i class="red"></i> 未妥投
            </span>
        </div>

    </div>
</template>
<script>
import { amapManager } from "vue-amap";
import lists from "../../mixins/lists.js";
import moment from "moment";
import mView from "../taskOrder/view";
import show from "../task/show";
import info from "../../mixins/information.js";
import marker from "../../mixins/markers.js";
export default {
    mixins: [lists, info, marker],
    data() {
        return {
            amapManager,
            buttonSize: "large",
            cardflag: true,
            pack: "收起",
            zoom: 12,
            center: [113.933665, 22.517327],
            ceju: false,
            ranging: null,
            driving: null,
            time: "",
            list: [],
            status: [],
            point: [],
            page: "",
            marker_visi: true,
            search_val: "",
            search_sel: "",
            status_type: {
                0: "未签到",
                1: "签到",
                2: "配送中",
                3: "已完成",
                4: "不配送",
                5: "取消"
            },
            open: false,
            events: {
                init: o => {
                    AMap.plugin(
                        ["AMap.RangingTool", "AMap.TruckDriving"],
                        () => {
                            this.ranging = new AMap.RangingTool(o);
                        }
                    );
                }
            },
            makerEvents: {
                click: e => {
                    this.information(e.target.F);
                }
            }
        };
    },
    created() {
        this.getTime();
    },
    methods: {
        handleClick() {
            this.open = !this.open;
        },
        handleChange(date) {
            this.time = date;
            this.settime();
        },
        handleClear() {
            this.open = false;
        },
        handleOk() {
            this.open = false;
        },
        cejuf() {
            if (this.ranging !== null) {
                if (this.ceju) {
                    this.ceju = false;
                    this.ranging.turnOff();
                } else {
                    this.ceju = true;
                    this.ranging.turnOn();
                }
            }
        },
        marker_isvisi() {
            if (this.marker_visi) {
                this.marker_visi = false;
            } else {
                this.marker_visi = true;
            }
        },
        getTime() {
            this.time = new Date();
            this.settime();
        },
        last() {
            this.time = new Date();
            this.time = new Date(this.time.getTime() - 24 * 60 * 60 * 1000);
            this.settime();
        },
        next() {
            this.time = new Date();
            this.time = new Date(this.time.getTime() + 24 * 60 * 60 * 1000);
            this.settime();
        },
        req(url, pages) {
            this.$http
                .get(url, {
                    params: {
                        page: pages,
                        arrival_warehouse_time: moment(this.time).format(
                            "YYYY-MM-DD"
                        )
                    }
                })
                .then(res => {
                    this.list = res.data.data.data;
                    this.status = res.data.data.status;
                    this.point = res.data.data.point;
                    this.page = this.list.current_page;
                    this.markers.data = JSON.parse(
                        JSON.stringify(res.data.data.data.data)
                    );
                });
        },
        settime() {
            this.req(`index/index`, 1);
            if (this.driving) {
                this.driving.clear();
            }
            this.position = "";
            this.content = "";
        },
        last_page() {
            this.req(`index/index`, this.page + 1);
        },
        prev_page() {
            this.req(`index/index`, this.page - 1);
        },
        cardmin() {
            if (this.cardflag) {
                this.pack = "展开";
            } else {
                this.pack = "收起";
            }
            this.cardflag = !this.cardflag;
        },
        search() {
            if (this.search_sel === "merchants") {
                this.req(`index/index?merchant=${this.search_val}`);
            } else if (this.search_sel === "task") {
                this.req(`index/index?task=${this.search_val}`);
            } else if (this.search_sel === "driver") {
                this.req(`index/index?driver=${this.search_val}`);
            }
        },
        tab(sta) {
            this.req(`index/index?status=${sta}`);
        },
        car_close(row) {
            this.showComponent("mView", row);
        },
        task(row) {
            row.id = row.task_id;
            this.showComponent("show", row);
        },
        card_coor(item) {
            this.markers.data = [item];
            let truck = [
                {
                    lnglat: item.warehouse.location
                }
            ];
            item.delivery.forEach(delivery => {
                truck.push({
                    lnglat: [delivery.lng, delivery.lat]
                });
            });
            this.setTruckDriving(truck);
        },

        setTruckDriving(paths) {
            if (this.driving) {
                this.driving.clear();
            }
            this.driving = new AMap.TruckDriving({
                map: this.$refs["amap"].$amap,
                policy: 0,
                size: 1,
                hideMarkers: true,
                autoFitView: true
            });
            this.driving.search(paths);
        }
    },
    components: {
        mView,
        show
    }
};
</script>
<style lang="scss">
.amap-demo,
.amap-page-container {
    height: 100%;
}
.btn {
    float: left;
    height: 2.2rem;
    display: inline-block;
    border: 1px solid #dcdee2;
    background-color: #fff;
    text-align: center;
    line-height: 2.2rem;
    padding: 0 1rem;
    color: #000;
    &:nth-child(2) {
        border-left: none;
        border-right: none;
    }
    &.pointer {
        cursor: pointer;
        &:hover {
            color: #2d8cf0;
        }
    }
    &.btn-radius-left {
        border-radius: 4px 0 0 4px;
    }
    &.btn-radius-right {
        border-radius: 0 4px 4px 0;
    }
    .icon-green {
        color: #34ccb6;
    }
    .icon-yellow {
        color: #fab308;
    }
    .icon-red {
        color: #da0000;
    }
}
.top {
    position: fixed;
    z-index: 99;
    top: 7.5rem;
    left: 13.75rem;
    width: 100%;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    .tip {
        float: right;
        height: 2.2rem;
        line-height: 2rem;
        border-radius: 5px 0 0 5px;
        background-color: #fff;
        display: inline-block;
        -webkit-box-shadow: 0px 2px 2px #d0cfcc;
        box-shadow: 0px 2px 2px #d0cfcc;
        margin-left: 3rem;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        padding: 0.31rem 0;
        ul {
            list-style: none;
            margin: 0px;
            padding: 0 20px;
            float: left;
            li {
                float: left;
                list-style: none;
                border: 1px #dadada solid;
                height: 24px;
                line-height: 23px;
                -webkit-box-sizing: border-box;
                box-sizing: border-box;
                padding: 0 12px;
                cursor: pointer;
                color: #000;
                &:hover {
                    color: #2d8cf0;
                }
            }
        }
    }
    .time_box {
        -webkit-box-shadow: 0px 2px 2px #d0cfcc;
        box-shadow: 0px 2px 2px #d0cfcc;
        border-left: none;
        height: 2.2rem;
        .time_temp {
            height: 2.2rem;
            width: 10rem;
            line-height: 2.2rem;
            text-align: center;
            font-size: 14px;
            background-color: #fff;
            float: left;
        }
        .time_icon {
            display: inline-block;
            width: 2.2rem;
            height: 2.2rem;
            background-color: #fff;
            color: #414141;
            font-size: 1rem;
            text-align: center;
            line-height: 2.2rem;
            border-left: 1px #dadada solid;
            border-radius: 0 5px 5px 0;
        }
    }
}
.ivu-input-group {
    width: 25%;
}
.ivu-input-group-append .ivu-btn {
    background-color: #2d8cf0;
    color: #fff;
}
.ivu-card-head {
    p {
        font-weight: 400;
        padding-left: 0.8rem;
    }
}
.card_table {
    border-collapse: collapse;
    border: 1px #dadada solid;
    margin-bottom: 0.5rem;
    td {
        padding: 6px 18px;
        text-align: center;
        border: 1px #dadada solid;
        cursor: pointer;
    }
}
.cardmin {
    position: absolute;
    display: inline-block;
    width: 28px;
    height: 55px;
    padding: 8px;
    background-color: #fff;
    border-top-right-radius: 5px;
    border-bottom-right-radius: 5px;
    border: 1px solid rgb(218, 218, 218);
    border-left: none;
    top: 1.2rem;
    right: -5px;
    color: #414141;
    cursor: pointer;
}
.amap-window {
    width: 11rem;
    dd {
        margin-left: 0;
        color: #666666;
        line-height: 25px;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        strong {
            font-weight: normal;
            -ms-flex-preferred-size: 60px;
            flex-basis: 60px;
            text-align: right;
        }
        span {
            margin-left: 0.3rem;
            color: #010101;
            -webkit-box-flex: 1;
            -ms-flex: 1;
            flex: 1;
        }
    }
}
.prompt {
    width: 12rem;
    background-color: #fff;
    height: 3rem;
    line-height: 3rem;
    position: relative;
    bottom: 8rem;
    right: -88rem;
    padding-left: 0.6rem;
    border-radius: 10px;
    .tools {
        color: #000;
        i {
            display: inline-block;
            height: 16px;
            width: 16px;
            vertical-align: middle;
        }
    }
}
.layout > .ivu-layout .layout-footer-center {
    display: none;
}
.layout > .ivu-layout .layout-content-main > div {
    display: -webkit-box;
}
.marker-car,
.marker-warehouse,
.marker-delivery {
    display: block;
    height: 28px;
    width: 28px;
    border: 3px solid #fff;
    text-align: center;
    border-radius: 50%;
    color: #fff;
    font-size: 16px;
}
.marker-car {
    background-color: #c300d5;
}
.marker-warehouse {
    background-color: #414141;
}
.yellow {
    background-color: #fab308;
}
.green {
    background-color: #34ccb6;
}
.red {
    background-color: #da0000;
}
</style>