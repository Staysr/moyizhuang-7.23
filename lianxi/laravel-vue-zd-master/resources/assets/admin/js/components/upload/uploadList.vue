<template>
  <div>
  <div class="demo-upload-list" :style="fBoxSize" v-for="(item, index) in fileList">
      <img :src="item.path">
      <div class="demo-upload-list-cover">
        <Icon type="ios-eye-outline" @click.native="handleView(item.path)"></Icon>
        <Icon type="ios-trash-outline" @click.native="handleRemove(index)"></Icon>
      </div>
  </div>
  <Upload
    ref="input"
    :show-upload-list="false"
    :default-file-list="fileList"
    :format="format"
    :max-size="maxSize"
    :on-format-error="handleFormatError"
    :on-exceeded-size="handleMaxSize"
    :before-upload="handleBeforeUpload"
    :name="name"
    multiple
    type="drag"
    :action="action"
    style="display: inline-block;" :style="fBoxSize">
    <div :style="fBoxSize">
      <Icon type="ios-camera" size="20"></Icon>
    </div>
  </Upload>
  <Modal title="浏览图片" v-model="visible" class-name="top-modal">
    <img :src="imgUrl" v-if="visible" style="width: 100%">
  </Modal>
  </div>
</template>
<script>
/**
 * 使用方法
 * <Update v-model="value"></Update>
 *
 * v-model 绑定数据，并实现双向绑定，如果不需要双向绑定可以用:value  [{path: xxxx}]
 * max 最多文件上传个数
 * maxSize 超出文件大小限制
 * format 文件格式
 * name 文件提交表单name
 * action 文件提交url
 * boxSize 文件列表box大小
 * @type {String}
 */
  export default {
    name: 'upload-list',
    props: {
      value: {
        type: Array
      },
      max: {
        type: Number,
        default: 5
      },
      maxSize: {
        type: Number,
        default: 2048
      },
      format: {
        type: Array,
        default: () => ['jpg','jpeg','png']
      },
      name: {
        type: String,
        default: 'file'
      },
      action: {
        type: String,
        default: 'contract/upload'
      },
      boxSize: {
        type: Number,
        default: 100
      }
    },
    data () {
      return {
        imgUrl: '',
        visible: false,
        fileList:  this.value,
        fBoxSize: {
          width: this.boxSize + 'px',
          height: this.boxSize + 'px',
          lineHeight: this.boxSize + 'px',
        }
      }
    },
    methods: {
      handleView (path) {
        this.imgUrl = path;
        this.visible = true;
      },
      handleRemove (index) {
        this.fileList.splice(index, 1);
        this.$emit('input', this.fileList);
      },
      handleFormatError (file) {
        this.$Notice.warning({
          title: '文件格式错误',
          desc: 'File format of ' + file.name + ' is incorrect, please select jpg or png.'
        });
      },
      handleMaxSize (file) {
        this.$Notice.warning({
          title: '超出文件大小限制',
          desc: `文件太大,最大限制.${this.maxSize} KB`
        });
      },
      handleBeforeUpload (file) {
        const check = this.fileList.length < this.max;
        if (!check) {
          this.$Notice.warning({
            title: `最多可以上传${this.max}张图片。`
          });
        }else {
            var reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = (e) => {
                this.$http.post(`contract/upload`, {
                    base64: e.target.result
                }).then((res) => {
                    this.setFileList(res.data.data.path)
                }).catch((res) => {
                    this.$Message.error('网络超时！');
                })
            }
        }
        return false;
      },
      setFileList (value) {
        this.fileList.push({
            path: value
        });
        this.$emit('input', this.fileList);
      }
    },
    watch: {
        value(val){
            this.fileList = val
        }
    }
  }
</script>
<style>
  .demo-upload-list{
    display: inline-block;
    text-align: center;
    border: 1px solid transparent;
    border-radius: 4px;
    overflow: hidden;
    background: #fff;
    position: relative;
    box-shadow: 0 1px 1px rgba(0,0,0,.2);
    margin-right: 4px;
  }
  .demo-upload-list img{
    width: 100%;
    height: 100%;
  }
  .demo-upload-list-cover{
    display: none;
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background: rgba(0,0,0,.6);
  }
  .demo-upload-list:hover .demo-upload-list-cover{
    display: block;
  }
  .demo-upload-list-cover i{
    color: #fff;
    font-size: 20px;
    cursor: pointer;
    margin: 0 2px;
  }
</style>
