<?php
	session_start();
	header("Content-Type:text/html; charset=utf-8");
	header("CACHE-CONTROL:NO-CACHE");
	include_once 'config.php';
	include_once 'func.php';
?>
<style type="text/css">
<!--
body,td,th {
	font-size: 12px;
}
body {
	margin-left: 12px;
	margin-top: 12px;
	background-color:#e5eefa;
}
-->
</style>
<script language="javascript" src="main.js"></script>
<script language="javascript" src="xmlhttprequest.js"></script>
<!--<body onLoad="javascript:top.bottomFrame.talk.cont.focus();" oncontextmenu=self.event.returnValue=false>-->
<body onLoad="javascript:top.bottomFrame.talk.cont.focus();" oncontextmenu=self.event.returnValue=false>
<table border="0" cellpadding="0" cellspacing="0">
<form id="talk" name="talk" action="talk.php?action=send">
	<tr>
		<td height="12" colspan="6"></td>
	</tr>
	<tr>
		<td height="25"  colspan="2">表情：
<select id="face" name="face" size="1">
	<option value="微笑着">微笑着</option>
	<option value="大笑着">大笑着</option>
	<option value="喜悦的">喜悦着</option>
	<option value="笑呵呵地">笑呵呵地</option>
	<option value="热情的">热情的</option>
	<option value="温柔的">温柔的</option>
	<option value="红着脸">红着脸</option>
	<option value="幸福的">幸福的</option>
	<option value="嘟着嘴">嘟着嘴</option>
	<option value="热泪盈眶的">热泪盈眶的</option>
	<option value="依依不舍的">依依不舍的</option>
	<option value="得意的">得意的</option>
	<option value="神秘兮兮的">神秘兮兮的</option>
	<option value="恶狠狠的">恶狠狠的</option>
	<option value="大声的">大声的</option>
	<option value="生气的">生气的</option>
	<option value="幸灾乐祸的">幸灾乐祸的</option>
	<option value="同情的">同情的</option>
	<option value="遗憾的">遗憾的</option>
	<option value="正义凛然的">正义凛然的</option>
	<option value="严肃的">严肃的</option>
	<option value="慢条斯理的">慢条斯理的</option>
	<option value="无精打采的">无精打采的</option>
</select>
		</td>
		<td>字体颜色：
<select name="color" size="1" id="select">
	<option value="000000">默认颜色</option>
	<option style="color:#FF0000" value="FF0000">红色热情</option>
	<option style="color:#0000FF" value="0000ff">蓝色开朗</option>
	<option style="color:#ff00ff" value="ff00ff">桃色浪漫</option>
	<option style="color:#009900" value="009900">绿色青春</option>
	<option style="color:#009999" value="009999">青色清爽</option>
	<option style="color:#990099" value="990099">紫色拘谨</option>
	<option style="color:#990000" value="990000">暗夜兴奋</option>
	<option style="color:#000099" value="000099">深蓝忧郁</option>
	<option style="color:#999900" value="999900">卡其制服</option>
	<option style="color:#ff9900" value="ff9900">镏金岁月</option>
	<option style="color:#0099ff" value="0099ff">湖波荡漾</option>
	<option style="color:#9900ff" value="9900ff">发亮蓝紫</option>
	<option style="color:#ff0099" value="ff0099">爱的暗示</option>
	<option style="color:#006600" value="006600">墨绿深沉</option>
	<option style="color:#999999" value="999999">烟雨蒙蒙</option>
</select></td>
		<td>是否滚屏：<input id="rollscreen1" name="rollscreen1" type="checkbox"  onClick="changeroll(talk)" /></td>
		<!--<td><input type="button" value="退出聊天室" onClick="alert('欢迎下次光临');top.window.close()" style=" border:1px #e5eefa solid;"/> </td>-->
        <td><input type="button" value="退出聊天室" onClick="logout()" style=" border:1px #e5eefa solid;"/> </td>
		<td><iframe id="tail" frameborder="0" src="tail.php" style="display:none;"></iframe></td>
	</tr>
	<tr class="6" height="10">
		<td><div id='itail' style="display:none;"><script> timer = window.setTimeout("logout()",<?php echo MAXTIME;?>);  </script></div></td></tr>
	<tr>
		<td><input id="user" name="user" type="text" size="5" value="<?php echo $_SESSION['user'];?>" readonly=""  style=" text-align:right;"/>
		对：</td>
		<td>
          <div id="obtobt">
            <select id="obt" name="obt">
            <?php
                foreach($_SESSION['per'] as $value){
                    echo '<option value="'.$value.'">'.$value.'</option>';
                }
            ?>
            </select>
          </div>
		</td>
	<td colspan="3">说：
	  <textarea name="cont" cols="50" id="cont"></textarea></td>
	<td><input type="submit" style=" border:1px #e5eefa solid;" value="发言" onClick="return tk(talk,<?php echo MAXTIME;?>)"/></td>
	</tr>
</form>	
</table>
</body>
