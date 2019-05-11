<template>
    <Table :columns="tableCol" :data="data" size="small" ref="table"
           :loading="loading"></Table>
</template>

<script>
    export default {
        name: "my-table",
        props: {
            data: {
                type: Array,
                default: () => []
            },
            columns: {
                type: Array,
                default: () => {return []}
            },
            loading: {
                type: Boolean,
                default: false
            }
        },
        data() {
            return {
                leftCol: [{
                    title: '序号',
                    render: (h, {index}) => {
                        return <span>{++index}</span>
                    },
                    width: 75
                }],
                rightCol:[]
            }
        },
        computed: {
            tableCol(){
                return this.leftCol.concat(this.columns, this.rightCol)
            }
        },
    }
</script>

<style scoped>

</style>