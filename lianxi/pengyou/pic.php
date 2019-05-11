<?php
require_once("./conn/conn.php");
require_once("./conn/function.php");
session_start();
?>
<?php 
$file = $_FILES['myfile'];  //得到传输的数据,以数组的形式
$name = $file['name'];      //得到文件名称，以数组的形式
$upload_path = "./images/upload/"; //上传文件的存放路径
$wznr=addslashes($_POST['pengyou-wz-nr']);
@$pengyou_user=$_SESSION['pengyou_user'];
if($pengyou_user){
	if($wznr){
$imgcs=1;	
$hqtype='';
		$pinglunsql="insert into pengyou_content(username,content,time) values('$pengyou_user','$wznr','$time') ";
		$zxplsql=mysql_query($pinglunsql);
		$crId=mysql_insert_id();
		if($zxplsql){
			tishi(2,"发布成功",1000,'index.php');
		}
//当前位置
foreach ($name as $k=>$names){
	
    $type = strtolower(substr($names,strrpos($names,'.')+1));//得到文件类型，并且都转化成小写
    $allow_type = array('jpg','jpeg','gif','png'); //定义允许上传的类型
    //把非法格式的图片去除
    if (!in_array($type,$allow_type)){
        unset($name[$k]);
    }else{
		$hqtype=$type;
	}
}
$str = '';
		$hqtype=".".$hqtype;
		
foreach ($name as $k=>$item){
    $type = strtolower(substr($item,strrpos($item,'.')+1));//得到文件类型，并且都转化成小写
	$zxname=time().rand(1,100).$hqtype;
    if (move_uploaded_file($file['tmp_name'][$k],$upload_path.$zxname)){
		$images='images_'.$imgcs;
		@$sql="update pengyou_content set $images ='$zxname' where id =$crId";
        //$str .= ','.$upload_path.time().$name[$k];
      // echo '{"success":true,"msg":"上传成功！","img","'.$zxname.'"}';
		mysql_query($sql);
		$imgcs++;
    }else{
        echo 'failed';
    }
}
	}else{
		tishi(1,"你什么都还没说呢，快去重新发布吧",3000,"index.php");
	}
}else{
	tishi(1,"非法提交数据记录ip表示尊敬",3000,"index.php");
}
//向指定id插入图片地址（虽然是插入，但是是更新字段，不要迷糊了）
	

?>