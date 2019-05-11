<template>
    <i-select
            v-model="publicValue"
            :filterable="remote"
            :remote="remote"
            :remote-method="remoteMethod"
            clearable
            :loading="loading"
            @on-change="setValue"
            class="remote-select"
            :ref="uuid"
    >
        <i-option v-for="(option, index) in options" :value="option.id" :key="option.id">{{option.name}}</i-option>
    </i-select>
</template>

<script>
    import http from "../../mixins/http";
    import uuid from "../../mixins/uuid";

    /**
     * 使用方法
     * <remote remote-url="company/select"></remote>
     * 请求url remoteUrl
     * 是否开启远程搜索 remote
     * 是否开启缓存 cache
     * 是否加载初始数据 ready
     * 请求参数 params
     * 搜索key searchKey
     *
     * 后台程序尽量用 getWhere 或者 limit
     */
    export default {
        name: "remote",
        mixins: [http, uuid],
        props: {
            remoteUrl: {
                type: String,
                default: '',
                required: true
            },
            remote: {
                type: Boolean,
                default: true
            },
            cache: {
                type: Boolean,
                default: true
            },
            ready: {
                type: Boolean,
                default: false
            },
            params: {
                type: Object,
                default: () => {
                }
            },
            searchKey: {
                type: String,
                default: 'name'
            },
            value: {
                type: [String, Number]
            }
        },
        data() {
            return {
                publicValue: '',
                publicOptions: [],
                publicParams: {},
                options: this.defaultOption()
            }
        },
        mounted() {
            if (this.ready) {
                this.request()
            }
        },
        methods: {
            setValue(val) {
                this.$emit('input', val)
                this.$emit('on-change', this.options.find((item) => item.id === val))
            },
            remoteMethod(query) {
                if (this.value == query) {
                    return
                }
                
                if (this.options.find((item) => item.id === this.$refs[this.uuid].publicValue) &&
                    this.options.find((item) => item.id === this.$refs[this.uuid].publicValue).name === query) {
                    return;
                }

                if (this.remote) {
                    this.publicParams[this.searchKey] = query;
                    this.request()
                }
            },
            request() {
                if (this.$store.getters.cache(this.key()).length === 0) {
                    if (this.$store.getters.cacheLock(this.key())) {
                        this.loading = true
                        setTimeout(() => {
                            this.refresh()
                            this.loading = false
                        }, 4000);
                    } else {
                        this.search()
                    }
                } else {
                    this.refresh()
                }
            },
            search() {
                this.loading = true
                this.$store.commit('setCacheLock', this.key())
                this.$http.get(this.remoteUrl, {
                    params: this.getParams()
                }).then((res) => {
                    if (this.cache) {
                        this.$store.commit('setCacheData', {
                            key: this.key(),
                            data: res.data.data
                        });
                    } else {
                        this.publicOptions = res.data.data
                    }
                }).finally(() => {
                    this.refresh()
                    this.loading = false
                })
            },
            defaultOption() {
                return this.cache ? this.$store.getters.cache(this.key()) : this.publicOptions;
            },
            key() {
                return this.remoteUrl + JSON.stringify(this.getParams())
            },
            refresh() {
                this.options = this.cache ? this.$store.getters.cache(this.key()) : this.publicOptions
            },
            getParams() {
                return Object.assign({}, this.params, this.publicParams);
            },
            unObserver(data) {
                return JSON.parse(JSON.stringify(data))
            }
        },
        watch: {
            params: {
                handler(val, old) {
                    if(JSON.stringify(val) !== JSON.stringify(old)){
                        this.$refs[this.uuid].clearSingleSelect()
                        this.request()
                    }
                },
                deep: true
            },
            value: {
                handler(val) {
                    this.publicValue = val
                },
                immediate: true
            }
        }
    }
</script>

<style scoped>
    .remote-select {
        width: 150px;
    }
</style>