<?php /* Smarty version 2.6.26, created on 2019-01-10 17:50:54
         compiled from num.tpl */ ?>

<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <link href="style/css/H-ui.min.css" rel="stylesheet" type="text/css" />
    <link href="style/css/H-ui.admin.css" rel="stylesheet" type="text/css" />
    <link href="style/css/style.css" rel="stylesheet" type="text/css" />
    <link href="style/lib/Hui-iconfont/1.0.7/iconfont.css" rel="stylesheet" type="text/css" />

    <title>产品分类管理</title>
    <?php echo '
        <style type="text/css">
            td a{
            	width: 90%;
                margin: 3%!important;
            }
             #btn1:hover{
            	background-color: #2481e5!important;
            }
             #btn1{
            	height: 36px;
            	line-height: 36px;
            }
        </style>
    '; ?>

</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe616;</i> 产品管理 <span class="c-gray en">&gt;</span> 库存管理 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
    <div class="text-c">
        <form name="form1" action="index.php" method="get">
            <input type="hidden" name="module" value="product" />
            <input type="hidden" name="action" value="num" />
            <input type="text" name="product_title" size='8' value="<?php echo $this->_tpl_vars['product_title']; ?>
" id="" placeholder=" 产品标题" style="width:200px" class="input-text">
            <input name="" id="btn1" class="btn btn-success" type="submit" value="查询">
            <input type="button" value="清空" id="btn8" style="border: 1px solid #D5DBE8; color: #6a7076;" class="reset" onclick="empty()" />
        </form>
    </div>
    <div class="mt-20">
        <table class="table table-border table-bordered table-bg table-hover">
            <thead>
            <tr class="text-c">
                <th>序</th>
                <th>产品图片</th>
                <th>产品标题</th>
                <th>发布时间</th>
                <th>价格</th>
                <th>数量</th>
                            </tr>
            </thead>
            <tbody>
            <?php $_from = $this->_tpl_vars['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['f1'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['f1']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['f1']['iteration']++;
?>
                <tr class="text-c">
                    <td><?php echo $this->_foreach['f1']['iteration']; ?>
</td>
                    <td><?php if ($this->_tpl_vars['item']->img != ''): ?><img onclick="pimg(this)" style="width: 50px;height: 50px;" src="<?php echo $this->_tpl_vars['uploadImg']; ?>
<?php echo $this->_tpl_vars['item']->img; ?>
"><?php else: ?><span>暂无图片</span><?php endif; ?></td>
                    <td>
                        <p><?php echo $this->_tpl_vars['item']->product_title; ?>
<?php echo $this->_tpl_vars['item']->rew; ?>
</p>
                    </td>
                    <td><?php echo $this->_tpl_vars['item']->add_date; ?>
</td>
                    <td><span style="color:red;"><?php echo $this->_tpl_vars['item']->price; ?>
</span></td>
                    <td><input type="number" class="input-text" name="num" id="num_<?php echo $this->_tpl_vars['item']->attribute_id; ?>
" value="<?php echo $this->_tpl_vars['item']->num; ?>
" readOnly="readOnly" style="background-color: #eeeeee;" ondblclick="double(<?php echo $this->_tpl_vars['item']->attribute_id; ?>
)" onblur="leave(<?php echo $this->_tpl_vars['item']->id; ?>
,<?php echo $this->_tpl_vars['item']->attribute_id; ?>
);" /><?php echo $this->_tpl_vars['item']->unit; ?>
</td>
                                                                    	                            	                                                            	                                                                                        </tr>
            <?php endforeach; endif; unset($_from); ?>
            </tbody>
        </table>
    </div>
    <div style="text-align: center;display: flex;justify-content: center;"><?php echo $this->_tpl_vars['pages_show']; ?>
</div>
</div>
<div id="outerdiv" style="position:fixed;top:0;left:0;background:rgba(0,0,0,0.7);z-index:2;width:100%;height:100%;display:none;"><div id="innerdiv" style="position:absolute;"><img id="bigimg" src="" /></div></div>
<script type="text/javascript" src="style/js/jquery.js"></script>

<script type="text/javascript" src="style/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="style/lib/layer/2.1/layer.js"></script>
<script type="text/javascript" src="style/lib/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript" src="style/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="style/js/H-ui.js"></script>
<script type="text/javascript" src="style/js/H-ui.admin.js"></script>

<?php echo '
<script type="text/javascript">
function empty() {
    location.replace(\'index.php?module=product&action=num\');
}
function pimg(obj){
    var _this = $(obj);//将当前的pimg元素作为_this传入函数
    imgShow("#outerdiv", "#innerdiv", "#bigimg", _this);
}
function imgShow(outerdiv, innerdiv, bigimg, _this){
    var src = _this.attr("src");//获取当前点击的pimg元素中的src属性
    $(bigimg).attr("src", src);//设置#bigimg元素的src属性

    /*获取当前点击图片的真实大小，并显示弹出层及大图*/
    $("<img/>").attr("src", src).load(function(){
        var windowW = $(window).width();//获取当前窗口宽度
        var windowH = $(window).height();//获取当前窗口高度
        var realWidth = this.width;//获取图片真实宽度
        var realHeight = this.height;//获取图片真实高度
        var imgWidth, imgHeight;
        var scale = 0.8;//缩放尺寸，当图片真实宽度和高度大于窗口宽度和高度时进行缩放

        if(realHeight>windowH*scale) {//判断图片高度
            imgHeight = windowH*scale;//如大于窗口高度，图片高度进行缩放
            imgWidth = imgHeight/realHeight*realWidth;//等比例缩放宽度
            if(imgWidth>windowW*scale) {//如宽度扔大于窗口宽度
                imgWidth = windowW*scale;//再对宽度进行缩放
            }
        } else if(realWidth>windowW*scale) {//如图片高度合适，判断图片宽度
            imgWidth = windowW*scale;//如大于窗口宽度，图片宽度进行缩放
            imgHeight = imgWidth/realWidth*realHeight;//等比例缩放高度
        } else {//如果图片真实高度和宽度都符合要求，高宽不变
            imgWidth = realWidth;
            imgHeight = realHeight;
        }
        $(bigimg).css("width",imgWidth);//以最终的宽度对图片缩放

        var w = (windowW-imgWidth)/2;//计算图片与窗口左边距
        var h = (windowH-imgHeight)/2;//计算图片与窗口上边距
        $(innerdiv).css({"top":h, "left":w});//设置#innerdiv的top和left属性
        $(outerdiv).fadeIn("fast");//淡入显示#outerdiv及.pimg
    });

    $(outerdiv).click(function(){//再次点击淡出消失弹出层
        $(this).fadeOut("fast");
    });
}

function double(attribute_id) {
    ynum = $(\'#num_\'+attribute_id).val();

    $(\'#num_\'+attribute_id).attr(\'readOnly\',false);
    document.getElementById(\'num_\'+attribute_id).style.backgroundColor="#ffffff";
}

function leave(id,attribute_id) {
    var num = $(\'#num_\'+attribute_id).val();
    $.ajax({
        type: \'POST\',
        url: \'index.php?module=product&action=see\',
        data: \'id=\'+id+\'&attribute_id=\'+attribute_id+\'&num=\'+num,
        success: function (res) {//此方法起到监视作用
            $(\'#num_\'+attribute_id).attr(\'readOnly\',true);
            document.getElementById(\'num_\'+attribute_id).style.backgroundColor="#eeeeee";
            if(res == 1){
                appendMask(\'修改产品数量成功\',"cg");
                // location.href="index.php?module=product&action=num";
            }else{
                $(\'#num_\'+attribute_id).val(ynum);
                appendMask(\'修改产品数量失败\',"ts");
            }

        }
    });
}
function appendMask(content,src){
	$("body").append(`
        <div class="maskNew">
            <div class="maskNewContent">
                <a href="javascript:void(0);" class="closeA" onclick=closeMask1() ><img src="images/icon1/gb.png"/></a>
                <div class="maskTitle">提示</div>
                <div style="text-align:center;margin-top:30px"><img src="images/icon1/${src}.png"></div>
                <div style="height: 50px;position: relative;top:20px;font-size: 22px;text-align: center;">
                    ${content}
                </div>
                <div style="text-align:center;margin-top:30px">
                    <button class="closeMask" onclick=closeMask1() >确认</button>
                </div>

            </div>
        </div>
    `)
}
function closeMask1(){
	$(".maskNew").remove();
    location.replace(location.href);
}
</script>
'; ?>

</body>
</html>