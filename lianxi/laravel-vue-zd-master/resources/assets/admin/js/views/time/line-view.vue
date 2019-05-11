<template>
    <component-modal :width="1440">
        <Row type="flex" justify="center" align="top">
            <i-Col span="4" class="left-lists">
                <div class="left-collapse">
                    <div class="ivu-collapse">
                        <div class="ivu-collapse-item">
                            <div class="ivu-collapse-header" style="padding-left: 15px;">
                                <Icon type="md-add" style="margin-right: 0px;" v-if="unarrangeEvents.boxShow === true" @click="unarrangeEvents.boxShow = !unarrangeEvents.boxShow"></Icon>
                                <Icon type="md-remove" style="margin-right: 0px;" v-else @click="unarrangeEvents.boxShow = !unarrangeEvents.boxShow"></Icon>
                                <span class="line-name">[{{unarrange.length}}] 未排线</span>
                            </div>
                            <div class="ivu-collapse-content">
                                <div class="ivu-collapse-content-box" :class="{'hide':unarrangeEvents.boxShow}">
                                    <div class="line-content">
                                        <div class="line-item" draggable="true" v-for="(item, index) in unarrange" @drop="drop($event, null)" @dragover='allowDrop($event)' @dragend="dragMarker = null" @dragstart="drag(item)" :title="item.name">
                                            <span>{{index + 1}}</span>: {{ item.name }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="ivu-collapse-item" v-for="(lists, key) in arrange">
                            <div class="ivu-collapse-header" style="padding-left: 15px;">
                                <Icon type="md-add" style="margin-right: 0px;" v-if="arrangesEvents(lists.line_id)" @click="arrangesEvents(lists.line_id, 'click')"  size="16" ></Icon>
                                <Icon type="md-remove" style="margin-right: 0px;" v-else @click="arrangesEvents(lists.line_id, 'click')" ></Icon>
                                <span class="line-name">
                                    [{{lists.data.length}}]
                                    <input style="width: 100px" type="text" v-model="lists.line_name" @blur="changeName(lists.line_id,lists.line_name)">
                                </span>
                                <a @click="deleteArrange(lists.line_id)"><Icon type="ios-trash" size="16" ></Icon></a>
                                <a style="'margin-right:5px" @click="locationHover(lists.line_id)"><Icon type="md-pin" size="16" ></Icon></a>
                            </div>
                            <div class="ivu-collapse-content">
                                <div class="ivu-collapse-content-box" :class="{'hide': arrangesEvents(lists.line_id)}">
                                    <div class="line-content">
                                        <div class="line-item" draggable="true" v-for="(item, index) in lists.data"
                                             @drop="drop($event, {id:lists.line_id,name:lists.line_name}, item)"
                                             @dragover='allowDrop($event)' @dragend="dragMarker = null"
                                             @dragstart="drag(item)" :title="item.name">
                                            <span>{{index + 1}}</span>:{{item.name }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="left-btns">
                    <p><i-Button type="success" long @click="saveCurrent()">保存待排线</i-Button></p>
                    <p><i-Button type="success" long @click="saveAll()">全部保存</i-Button></p>
                    <p><i-Button type="success" long @click="downloadAll()">导出</i-Button></p>
                </div>
            </i-Col>
            <i-Col span="20" class="col-map">
                <div class="amap-bottom-tools">
                    <div class="ivu-row">
                        <div class="ivu-col ivu-col-span-24">
                            <ButtonGroup shape="circle" style="margin-right: 15px; float: right;">
                                <Button type="primary" class="marker-color-2">
                                    已排线
                                </Button>
                                <Button type="primary" class="marker-color-1">
                                    已选中
                                </Button>
                                <Button type="primary" class="marker-color-0">
                                    未排线
                                </Button>
                            </ButtonGroup>
                        </div>
                    </div>
                </div>
                <el-amap vid="amap" :events="events">
                    <el-amap-marker vid="warehouse" top-When-Click :position="[warehouse.lng, warehouse.lat]"
                                    :template="markerWareTemplate()"></el-amap-marker>
                    <el-amap-marker
                            v-for="(item, index) in markers"
                            :key="item.id"
                            :ext-data="item"
                            top-when-click="true"
                            :vid="index"
                            :title="item.name"
                            :template="markerTemplate(item)"
                            :events="markerEvents"
                            :position="[item.lng, item.lat]">

                    </el-amap-marker>
                </el-amap>
            </i-Col>
        </Row>
    </component-modal>
</template>

<script>
    import ComponentModal from "../../components/modal/component-modal";
    import Box from "../../components/box/index";
    import component from "../../mixins/component";

    export default {
        name: "line-view",
        components: {Box, ComponentModal},
        mixins: [component],
        data() {
            return {
                warehouse: {
                    lng: 0,
                    lat: 0
                },
                markers: [],
                dragMarker: null,
                unarrangeEvents: {
                    boxShow: true
                },
                ingKey: 0,
                arrangesBoxShow: [],
            }
        },
        computed: {
            // 未排线
            unarrange() {
                return this.markers.filter((n) => n.line_id === null && n.ing !== true);
            },
            // 待排线
            arrangeing() {
                return this.markers.filter((n) => n.line_id === null && n.ing === true).sort((x, y) => {
                    return x.sort - y.sort
                });
            },
            // 已排线
            arrange() {
                let arranges = this.markers.filter((n) => n.line_id !== null)
                let array = []
                let index = -1
                arranges.forEach((item, index) => {
                    index = array.findIndex((n) => n.line_id === item.line_id)
                    if (index !== -1) {
                        array[index].data.push(item)
                    } else {
                        array.push({
                            data: [item],
                            line_id: item.line_id,
                            line_name: item.line_name
                        })
                    }
                });
                return array.sort((x, y) => {
                    return x.line_id - y.line_id
                })
            },
            arrangeArray() {
                return this.markers.filter((n) => n.line_point !== null);
            },
            events() {
                return {
                    init: (map) => {
                        let rectOptions = {
                            strokeStyle: "dashed",
                            strokeColor: "#FF33FF",
                            fillColor: "#FF99FF",
                            fillOpacity: 0.5,
                            strokeOpacity: 1,
                            strokeWeight: 2
                        };
                        map.plugin(["AMap.MouseTool"], ((res) => {
                            let mouseTool = new AMap.MouseTool(map);
                            mouseTool.rectangle(rectOptions);

                            mouseTool.on('draw', ((obj) => {
                                let contains = false;
                                this.unarrange.forEach((item, index) => {
                                    contains = obj.obj.contains([item.lng, item.lat])
                                    if (contains === true) {
                                        item.ing = true
                                        item.hover = true
                                        item.sort = this.ingKey
                                        this.ingKey++
                                    }
                                });
                                this.arrangeArray.forEach((item, index) => {
                                    item.hover = false
                                });

                                if (obj.obj.getPath().length > 1) {
                                    map.setCenter(obj.obj.F.path[0]);
                                }
                                mouseTool.close(true);
                                mouseTool.rectangle(rectOptions);
                            }));
                        }));
                    }
                }
            },

            markerEvents() {
                return {
                    click: (e) => {
                        this.markers.forEach((item, index) => {
                            if (item.line_id !== e.target.F.extData.line_id) {
                                item.hover = false
                            }
                        });
                        if (e.target.F.extData.ing === false && e.target.F.extData.line_id === null) {
                            e.target.F.extData.ing = true
                            e.target.F.extData.hover = true
                            e.target.F.extData.sort = this.ingKey
                            this.ingKey++
                        } else if (e.target.F.extData.line_id !== null) {
                            this.locationHover(e.target.F.extData.line_id)
                        } else {
                            e.target.F.extData.ing = false
                            e.target.F.extData.hover = false
                        }
                    }
                }
            }
        },
        methods: {
            // marker点模板
            markerTemplate(item) {
                let type = 1
                let index = 0
                const isFndIndex = n => n.id === item.id;
                if (item.line_id === null && item.ing !== true) {
                    index = this.unarrange.findIndex(isFndIndex) + 1
                    type = 0
                } else if (item.ing === true) {
                    index = this.arrangeing.findIndex(isFndIndex) + 1
                    type = 1;
                } else {
                    let i = -1
                    this.arrange.forEach((val, key) => {
                        i = val.data.findIndex(isFndIndex)
                        if (i != -1) {
                            index = val.data[i].hover === true ? i + 1 : key + 1
                        }
                    })
                    type = 2
                }
                return `<div  class="marker marker-size-${item.hover}"><div class="marker-center marker-color-${type}"> ${index}</div><div class="marker-cur"></div></div>`;
            },
            markerWareTemplate() {
                return `<div  class="marker marker-size-0"><div class="marker-center marker-color-0">仓</div><div class="marker-cur"></div></div>`;
            },
            // item拖动事件
            drag(item) {
                this.dragMarker = item
            },
            // item放开事件
            drop(event, list, item) {
                if (this.dragMarker === null) {
                    return false
                }

                if (list === null) {
                    this.dragMarker.line_id = null
                    this.dragMarker.line_name = null
                } else {
                    this.dragMarker.line_id = list.id
                    this.dragMarker.line_name = list.name
                    let index = this.markers.findIndex(n => n.id === item.id)
                    let key = this.markers.findIndex(n => n.id === this.dragMarker.id)
                    Vue.set(this.markers, index, this.dragMarker)
                    Vue.set(this.markers, key, item)
                }
                this.dragMarker = null
                event.preventDefault();
            },
            // item放开事件
            allowDrop(event) {
                event.preventDefault();
            },
            // 线路收起
            arrangesEvents(id, type) {
                let index = this.arrangesBoxShow.findIndex((n) => n.line_id === id)
                if (index === -1) {
                    index = this.arrangesBoxShow.push({
                        'line_id': id,
                        'boxShow': true
                    }) - 1
                }
                if (type === 'click') {
                    this.arrangesBoxShow[index].boxShow = !this.arrangesBoxShow[index].boxShow
                } else {
                    return this.arrangesBoxShow[index].boxShow
                }
            },
            // 删除线路事件
            deleteArrange(lineId) {
                this.markers.filter((n) => n.line_id === lineId).forEach((item, index) => {
                    item.line_id = null
                    item.hover = false
                })
            },
            locationHover(lineId) {
                this.markers.forEach((item, index) => {
                    item.ing = false
                    if (item.line_id === lineId) {
                        item.hover = true
                    } else {
                        item.hover = false
                    }
                })
            },
            saveCurrent() {
                let date = new Date().getTime()
                this.arrangeing.forEach((item, index) => {
                    item.ing = false
                    item.hover = false
                    item.line_id = date
                    item.line_name = '线路' + (this.arrange.length);
                })
            },
            saveAll() {
                this.$http.post(`time/change/${this.data.id}`, {
                    data: this.arrange
                }).then((response) => {
                    this.$Message.info(response.data.message);
                }).catch((error) => {
                    console.log(error.data.message);
                });
            },
            changeName(lineId, lineName) {
                this.markers.forEach((item, index) => {
                    if (item.line_id === lineId) {
                        item.line_name = lineName
                    }
                })
            },
            downloadAll() {
                this.$http.download(`point/download/${this.data.id}`, {}, '线路列表.xls');
            }


        },
        //
        mounted() {
            this.$http.get(`point/line/${this.data.id}`, {
                headers: {'X-Requested-with': 'XMLHttpRequest'}
            }).then(res => {
                this.warehouse.lng = res.data.data.data[0].point_time.warehouse.longitude;
                this.warehouse.lat = res.data.data.data[0].point_time.warehouse.latitude;

                res.data.data.data.forEach((item) => {
                    this.markers.push(Object.assign(item, {
                        ing: false,
                        hover: false,
                        sort: 0,
                        line_id: item.line_point ? item.line_point.line_id : null,
                        line_name: item.line_point ? item.line_point.line.title : null,
                    }));
                })
            })
        }
    }
</script>

<style>
    html, body, #app, #app > .ivu-row-flex, #app .col-map {
        height: 100%;
    }

    .col-map {
        position: relative;
        height: 600px;
    }

    .amap-bottom-tools {
        position: absolute;
        bottom: 15px;
        z-index: 999;
        width: 100%;
    }

    .line-item {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        height: 25px;
        line-height: 25px;
        border-top: none;
        padding: 0 5px;
    }

    .ivu-collapse-content > .ivu-collapse-content-box {
        padding-bottom: 10px;
        padding-top: 10px;
    }

    .line-name {
        margin-left: 10px;
        display: inline-block;
    }

    .left-lists {
        height: 100%;
        position: relative;
    }

    .left-collapse {
        height: 100%;
        overflow-y: auto;
        box-sizing: border-box;
        padding-bottom: 106px;
    }

    .left-lists .left-btns {
        position: absolute;
        bottom: 0px;
        left: 0px;
        width: 100%;
    }

    .left-lists .left-btns > p {
        margin-bottom: 5px;
    }

    .hide {
        display: none;
    }

    .show {
        display: block;
    }

    .ivu-collapse > .ivu-collapse-item > .ivu-collapse-header {
        cursor: default;
    }

    .ivu-collapse > .ivu-collapse-item > .ivu-collapse-header > i {
        cursor: pointer;
    }

    .ivu-collapse > .ivu-collapse-item > .ivu-collapse-header > a {
        float: right;
        padding-right: 15px;
        color: #666;
    }

    .marker {
        height: 28px;
        width: 28px;
        border-radius: 100%;
        display: inline-block;
        padding: 5px;
        background: #fff;
    }

    .marker.marker-size-true {
        height: 38px;
        width: 38px;
    }

    .marker .marker-center {
        text-align: center;
        height: 100%;
        width: 100%;
        border-radius: 100%;
        line-height: 18px;
        color: #fff;
    }

    .marker.marker-size-true .marker-center {
        line-height: 28px;
    }

    .marker-color-0 {
        background-color: #009900;
    }

    .marker-color-1 {
        background-color: #211C79;;
    }

    .marker-color-2 {
        background-color: #da0000;
    }

    .line-name input {
        height: 20px;
        border: none;
        width: 60px;
        line-height: normal;
    }

</style>