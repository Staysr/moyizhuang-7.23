<template>
    <div class="mapinfo">
        <el-amap vid="amapDemo" :zoom="zoom" :center="this.center == '' ? [113.939912,22.523353] : this.center" class="amap-demo" :amap-manager="amapManager" :events="mapevents">
            
            <el-amap-marker v-for="(item, index) in markers" :vid="item.id" :visible="true" :key="index" :content-render="contentRender" :position='[item.position.lng, item.position.lat]' :ext-data="item"  :events="events" ref="marker"></el-amap-marker>

            <div class="map_cover" v-for="(item ,index) in focuesitem" v-show="isshow">
                <ul class="map_cover_ul">
                    <li class="map_cover_li">
                        <span>姓名</span>
                        <span class="map_cover_info">{{item.name}}</span>
                    </li>
                    <li class="map_cover_li">
                        <span>车牌号</span>
                        <span class="map_cover_info">{{item.position._id}}</span>
                    </li>
                    <li class="map_cover_li">
                        <span>出车状态</span>
                        <span class="map_cover_info">{{item.carTypeId}}</span>
                    </li> 
                    <li class="map_cover_li" @click="showmoredetail(item)">查看更多</li>
                </ul>
            </div>
            <div class="tools">
                <img src="../../../../images/search.png" alt="" class="map_search" @click="mapresult">
                <img src="../../../../images/renovate.png" alt="" @click="refresh">
                <img src="../../../../images/position.png" alt="" class="position" @click="getView">
            </div>
      </el-amap>

      <components :is="is" :mapsearch='markers' @closeresult="closeresult" @searchresult="searchresult"></components>
    
    </div>
</template>

<script>
import Search from '../../search/mapsearch'
import Vue from 'vue'
import VueAMap from 'vue-amap';
import moment from 'moment'
Vue.use(VueAMap)

VueAMap.initAMapApiLoader({
  key: '9798eb91fcd5a3e7b97aff38e9a3ee',
  plugin: ['AMap.Autocomplete', 'AMap.PlaceSearch', 'AMap.Scale', 'AMap.OverView', 'AMap.ToolBar', 'AMap.MapType', 'AMap.PolyEditor', 'AMap.CircleEditor'],
   v: '1.4.4',
   uiVersion: '1.0.11'
})


const small = {
    background: `url(${require("../../../../images/small.png")}) 0% 0% / contain no-repeat`,
    height:`80px`,
    width:`60px`,
    color: `white`,
    fontSize: `18px`,
    textAlign: `center`,
    lineHeight: `30px`,
    transform: `scale(.9,.9)`,
    transition: `all 1s`,
    overflow: `hidden`,
    textOverflow:`ellipsis`,
    whiteSpace:`nowrap`
}
const big = {
    background: `url(${require("../../../../images/big.png")}) 0% 0% / contain no-repeat`,
    height:`80px`,
    width:`60px`,
    color: `white`,
    fontSize: `18px`,
    textAlign: `center`,
    lineHeight: `30px`,
    transform: `scale(.9,.9)`,
    transition: `all 1s`,
    overflow: `hidden`,
    textOverflow:`ellipsis`,
    whiteSpace:`nowrap`
}
const nobill = {
    background: `url(${require("../../../../images/no_bill.png")}) 0% 0% / contain no-repeat`,
    height:`80px`,
    width:`60px`,
    color: `white`,
    fontSize: `18px`,
    textAlign: `center`,
    lineHeight: `30px`,
    transform: `scale(.9,.9)`,
    transition: `all 1s`,
    overflow: `hidden`,
    textOverflow:`ellipsis`,
    whiteSpace:`nowrap`
}
const nowork = {
    background: `url(${require("../../../../images/no_work.png")}) 0% 0% / contain no-repeat`,
    height:`80px`,
    width:`60px`,
    color: `white`,
    fontSize: `18px`,
    textAlign: `center`,
    lineHeight: `30px`,
    transform: `scale(.9,.9)`,
    transition: `all 1s`,
    overflow: `hidden`,
    textOverflow:`ellipsis`,
    whiteSpace:`nowrap`
}

    module.exports = {
        components: {Search},
        props: [ 'mapdata', 'getview' ],
        name: 'amap-page',
        watch: {
            mapdata() {
                let marker;
                this.mapdata.forEach((res)=> {
                    marker = res.position
                    if( !marker ) {
                        res.position = {
                            _id: res.id,
                            categoryId: 6,
                            carTypeId: 1,
                            driverType: 1,
                            address: "未知位置",
                            lat: 22.523353,
                            lng: 113.719965,
                            createTime: moment().format('YYYY-MM-DD HH:mm:ss')
                        }
                    }
                })
                this.markers = this.mapdata
            },
            getview() {
                if(this.getview) {
                    this.amapManager.getMap().setFitView()
                }
            }
        },
        data() {
            return {
                is:"",
                amapManager: new VueAMap.AMapManager(),
                zoom: 14,
                center: '',
                markers: [],
                focuesitem: [],
                isshow: true,
                contentRender: (h, instance) =>{
                    let data = instance.extData
                    if( data.is_work == 0 && data.work_status == 0) {
                        return <div class="marker-driver" style={nowork}>{instance.extData.name}</div>
                    } else if ( data.is_work == 1 && data.is_big_work == 0 && data.work_status == 1) {
                        return <div class="marker-driver" style={small}>{instance.extData.name}</div>
                    } else if ( data.is_big_work == 1 ) {
                        return <div class="marker-driver" style={big}>{instance.extData.name}</div>
                    }else if ( data.work_status == 0 && data.is_work == 1 && data.is_big_work == 0) {
                        return <div class="marker-driver" style={nobill}>{instance.extData.name}</div>
                    }
                },
                markertarget: '',
                events: {
                    click: ((target)=> {
                        let pos, type, content;
                        if(target.type == 'click') {
                            pos = target.target.F.extData.position
                            type = target.target.F.content
                            content= target.target.F.extData
                            
                        }else {
                            pos = target.extData.position
                            type = target.$amapComponent.F.content
                            content = target.extData
                        }
                        this.markertarget = type
                        this.center = [pos.lng, pos.lat]
                        this.changeStyle(type)
                        this.focuesitem = [content]
                      
                    }),
                },
                mapevents: {
                    click: ((target)=> {
                        if(this.markertarget.style.transform != 'scale(0.9, 0.9)') {
                            this.markertarget.style.transform = 'scale(0.9, 0.9)'
                            this.isshow = false
                        }
                    })
                }
            }
        },
        methods: {
            changeStyle(e) {
                let action = e.style.transform
                if ( action == 'scale(0.9, 0.9)') {
                    e.style.transform = 'scale(1.1, 1.1)'
                    this.isshow = true
                }else {
                    e.style.transform = 'scale(0.9, 0.9)'
                    this.isshow = false
                }
            },
            showmoredetail(item) {
               
                this.$router.push({path: '/memberdetail', query: {id: this.$route.query.id, memberid: item.id}})
                
            },
            getView() {
                this.getview = true
            },
            mapresult() {
                this.is = 'Search'
            },
            closeresult(e) {
                this.is = ''
            },
            searchresult(e) {
                this.is =''
                this.events.click(e)
            },
            refresh() {
                this.$emit('update', 2)
            }
        }
    };
</script>

<style lang="less">
    .mapinfo {
        width: 100%;
        height: 100%;
        .map_cover {
            padding: 0 20px;
            position: absolute;
            bottom: 0;  
            left: 0;
            right: 0;          
            background: #fff;
            padding: 0 20px;
            line-height: 98px;
            color: #999;
            font-size: 30px;
            z-index: 90;
            .map_cover_ul {
                line-height: 88px;
                height: 358px;

                .map_cover_li { 
                    line-height: 88px;
                    height: 88px;
                    width: 100%;
                    border-right: 1px solid transparent;
                    border-bottom: 1px solid #e9e9e9;

                    span {
                       float: left; 
                    }
                    .map_cover_info {
                        color: #333; 
                        float: right;
                    }
                    &:last-child {
                        border-bottom: 1px solid transparent;
                    }
                }
            }
        }
    }
</style>


