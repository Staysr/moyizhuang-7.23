<template>
    <div class="layout-header-right-ownspace">
        <Dropdown @on-click="tagDropdown">
            <a href="javascript:void(0);">
          <span class="username">
            {{ user.name }}
            <Icon type="arrow-down-b"></Icon>
          </span>
            </a>
            <DropdownMenu slot="list">
                <DropdownItem name="ownspace">个人中心</DropdownItem>
                <DropdownItem name="logout">退出登录</DropdownItem>
            </DropdownMenu>
        </Dropdown>
        <span class="ivu-avatar ivu-avatar-circle ivu-avatar-default ivu-avatar-image">
            <img  src="/images/admin/basicprofile.jpg" style="max-height: 32px; max-height: 32px;">
        </span>
    </div>
</template>

<script>
    import Photo from "../upload/photo";
    import http from "../../mixins/http";

    export default {
        name: "my-header-ownspace",
        mixins: [http],
        computed: {
            user() {
                return this.$store.state.Auth.data
            }
        },
        mounted() {
            this.$nextTick(function () {
                if (!this.$store.state.Auth.data.id) {
                    this.$http.get(`token`).then((res) => {
                        this.$store.commit('setAuthData', res.data.data);
                    })
                }
            })
        },
        methods: {
            tagDropdown(name) {
                if (name === 'ownspace') {
                    this.$router.push({
                        name: 'common.profile'
                    })
                } else {
                    this.$http.delete(`auth`)
                    this.$cache.clear()
                    this.$router.push({
                        name: 'common.login'
                    })
                    window.location.reload()
                }
            }
        },
        components: {Photo}
    }
</script>

<style lang="scss">
    .layout-header-right-ownspace {
        display: inline-block;
        .username {
            display: inline-block;
            max-width: 100px;
            word-break: keep-all;
            white-space: nowrap;
            vertical-align: middle;
            overflow: hidden;
            text-overflow: ellipsis;
            text-align: right;
            color: #fff;
        }
        .ivu-avatar {
            background: rgb(97, 159, 231);
            margin-left: 10px;
            margin-right: 20px;
        }
    }
</style>