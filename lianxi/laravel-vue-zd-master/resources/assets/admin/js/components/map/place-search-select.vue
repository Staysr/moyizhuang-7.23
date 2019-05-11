<template>
    <Dropdown :visible="dropVisible" trigger="custom" @on-click="setValue" v-click-outside.capture="onClickOutside"
              v-click-outside:mousedown.capture="onClickOutside" style="vertical-align: top;">
        <Input :value="model" placeholder="Enter something..." @on-change="initSearch"
               @on-focus="initFocus">
        <Select v-model="city" slot="prepend" @on-change="setDefaultValue" style="width: 80px" :loading="loading">
            <Option v-for="(item, index) in category" :key="index" :value="item.name">{{item.name}}</Option>
        </Select></Input>
        <DropdownMenu slot="list">
            <DropdownItem v-for="(item, index) in places" :key="index" :name="index">{{item.name}}</DropdownItem>
        </DropdownMenu>
    </Dropdown>
</template>

<script>
    import { AMapManager }               from 'vue-amap'
    import TransferDom                   from 'iview/src/directives/transfer-dom'
    import { directive as clickOutside } from 'v-click-outside-x'

    let amapManager = new AMapManager()

    export default {
        name: 'place-search-select',
        directives: {clickOutside, TransferDom},
        props: ['searchOption', 'value'],
        data () {
            return {
                loading: false,
                places: [],
                model: this.value,
                dropVisible: false,
                city: '深圳市',
                category: []
            }
        },
        mounted: function () {
            this.loading = true
            this.$nextTick(() => {
                if (this.$store.getters.cache('category').length === 0) {
                    if (!this.$store.getters.cacheLock('category')) {
                        this.$store.commit('setCacheLock', 'category')
                        this.$http.get(`category/checkbox`).then((res) => {
                            this.$store.commit('setCacheData', {
                                key: 'category',
                                data: res.data.data
                            })
                            this.refresh()
                        })
                    } else {
                        setTimeout(() => {
                            this.refresh()
                        }, 4000)
                    }
                } else {
                    this.refresh()
                }
            })
        },
        computed: {
            _placeSearch () {
                return new AMap.PlaceSearch(this.searchOption || {
                    city: this.city,
                    citylimit: true,
                    extensions: 'all'
                })
            }
        },
        methods: {
            initSearch (event) {
                this.setDefaultValue()
                this.initFocus(event)
            },
            initFocus (event) {
                this.model = event.target.value
                this._placeSearch.search(event.target.value, (status, result) => {
                    if (result && result.poiList && result.poiList.count) {
                        this.places = result.poiList.pois
                        this.dropVisible = true
                    }
                })
            },
            setValue (index) {
                this.dropVisible = false
                this.$emit('input', this.places[index].name)
                this.$emit('pois', this.places[index])
                this.$emit('on-change', this.places[index])
                this.$emit('city', this.city)
            },
            setDefaultValue () {
                this.$emit('input', '')
                this.$emit('city', '')
                this.$emit('pois', {})
            },
            onClickOutside () {
                this.dropVisible = false
            },
            refresh () {
                this.category = this.$store.getters.cache('category')
                this.loading = false
            },
        },
        watch: {
            value (val) {
                if (val !== '')
                    this.model = val
            }
        }
    }
</script>

<style scoped>

</style>