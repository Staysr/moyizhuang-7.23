<template>
    <div>
        <Modal title="导入" :value="true" :mask-closable="false" @on-visible-change="visibleChange" class-name="vertical-center-modal" width="960px">
            <blockquote><p>一次最多上传{{maxCells}}行数据</p></blockquote>
            <div style="margin: 10px">
                <Upload :before-upload="file" :accept="SheetJSFT" action="">
                    <Button type="primary">导入Excel</Button>
                    <Button type="primary" slot="tip" style="margin-right: 4px;" @click="Time = true; save()" :loading="Time !== false">{{uploadButText}}</Button>
                    <Button type="primary" slot="tip" style="margin-right: 4px;" @click="Time = false" v-show="Time">暂停</Button>
                    <Button type="primary" slot="tip" style="margin-right: 4px;" @click="excelxls">导出结果</Button>
                    <Button type="primary" slot="tip" @click="downloadxls">下载模板</Button>
                </Upload>
            </div>
            <Table :columns="tableColumns" :data="tableData" :height="500" ref="importTable"></Table>
            <div slot="footer"></div>
        </Modal>
    </div>
</template>

<script>
    import XLSX from 'xlsx';
    import fileSave from 'file-saver';

    const _SheetJSFT = [
        "xlsx", "xlsb", "xlsm", "xls", "xml", "csv", "txt", "ods", "fods", "uos", "sylk", "dif", "dbf", "prn", "qpw", "123", "wb*", "wq*", "html", "htm"
    ].map(function(x) {
        return "." + x;
    }).join(",");

    export default {
        name: "excel-upload",
        props: {
            columns: {
                type: Array,
                default: () => [{title: '编号', key: '1'}]
            },
            action: {
                type: String,
                default: ''
            },
            fileName: {
                type: String,
                default: '导出'
            },
            titleHeader: {
                type: Array
            },
            maxCells: {
                type: Number,
                default: 300
            },
            url: {
                type: String,
                default: ''
            }
        },
        data(){
            return {
                original: [{
                    title: '状态',
                    render: (h, {row, column, index})=>{
                        if(!row.upload_status){
                            row.upload_status = '待上传';
                        }
                        return (
                            <div>
                                <poptip placement="top-end" trigger="hover" title="提示" transfer content={row.upload_status}>
                                    <icon type="ios-information" size="15" style="margin-right:2px;"></icon>
                                    <span>{row.upload_status}</span>
                                </poptip>
                            </div>
                        )
                    },
                    ellipsis: true,
                    filters: [
                        {
                            label: '待上传',
                            value: '待上传'
                        },
                        {
                            label: '成功',
                            value: '成功'
                        },
                        {
                            label: '失败',
                            value: '失败'
                        },
                    ],
                    filterMethod (value, row) {
                        switch (value){
                            case '待上传':
                                return !row.upload_status;
                                break;
                            case '成功':
                                return row.upload_status && row.upload_status.indexOf(value) > -1;
                                break;
                            case '失败':
                                return row.upload_status && row.upload_status.indexOf(value) > -1;
                                break;
                        }
                    },
                }],
                willdata: [],
                datasuccess: [],
                dataerror: [],
                SheetJSFT: _SheetJSFT,
                Time: false,
                title: []
            }
        },
        computed: {
            uploadButText(){
                if(this.Time){
                    return `待上传${this.willdata.length};上传成功${this.datasuccess.length};上传失败${this.dataerror.length}`;
                }else{
                    return '上传到服务器';
                }
            },
            tableData(){
                return this.willdata.concat(this.datasuccess, this.dataerror)
            },
            tableColumns(){
                return this.columns.concat(this.original)
            },
            tableExcel(){
                let data = [];
                this.$refs.importTable.rebuildData.forEach((item) => {
                    let val = {}
                    for (let i in item){
                        if(typeof this.title[i] !== 'undefined'){
                            val[this.title[i]] = item[i];
                        }
                    }
                    data.push(val)
                })
                return data
            }
        },
        methods: {
            visibleChange(visible) {
                if (visible === false) {
                    this.$emit('visibleChange', visible)
                }
            },
            save(){
                if(this.willdata.length > 0){
                    let item = this.willdata.shift()
                    this.send(item);
                }else{
                    this.Time = false;
                    this.$Message.success('上传完毕！');
                }
            },
            send(item){
                if(this.Time === true) {
                    this.$http.post(this.action, item).then((res) => {
                        item.upload_status = '成功;';
                        item.upload_status += res.data.message;
                        this.datasuccess.push(item);
                        this.save()
                    }).catch((res) => {
                        let data = (res.response.data);
                        item.upload_status = '失败';
                        console.log(res);
                        if(data.code === 422){
                            for(let i in data.data){
                                item.upload_status += '；' + data.data[i][0];
                            }
                        }else{
                            item.upload_status += data.message
                        }
                        this.dataerror.push(item)
                        this.save()
                    })
                }
            },
            excelxls(){
                let ws = XLSX.utils.json_to_sheet(this.tableExcel ,{
                    header: this.tableTitle
                });
                let wb = XLSX.utils.book_new();
                XLSX.utils.book_append_sheet(wb, ws, "SheetJS");
                let wbout = XLSX.write(wb, {
                    type: "array",
                    bookType: "xlsx"
                });
                fileSave.saveAs(new Blob([wbout], {
                    type: "application/octet-stream"
                }), this.fileName+'.xlsx');
            },
            file(file) {
                let reader = new FileReader();
                reader.onload = (e) => {
                    let bstr = e.target.result;
                    let wb = XLSX.read(bstr, {
                        type: 'binary'
                    });
                    /* 获取第一个sheet */
                    let wsname = wb.SheetNames[0];
                    let ws = wb.Sheets[wsname];
                    /* Convert array of arrays */
                    let data = XLSX.utils.sheet_to_json(ws, {
                        header: this.titleHeader
                    });
                    if(data.length > this.maxCells){
                        this.$Message.error(`一次最多上传${this.maxCells}行数据`);
                        return false;
                    }
                    this.title = data.shift();
                    this.title.upload_status = '上传状态';
                    this.willdata = data;
                };
                reader.readAsBinaryString(file);
                return false;
            },
            downloadxls(url){
                this.$http.download(this.url);
            }
        }
    }
</script>

<style scoped>
    blockquote {
        padding: 5px 5px 3px 10px;
        line-height: 1.5;
        border-left: 4px solid #ddd;
        margin-bottom: 20px;
        color: #666;
        font-size: 14px;
    }
</style>