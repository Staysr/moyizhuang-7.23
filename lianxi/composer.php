<?php



//
//function t($n){
//  echo  $n . "&nbsp;";
//  if ($n>0){
//      t($n-1);
//  }else{
//      echo "�Ҳ�ѭ����";
//  }
//    echo  $n . "&nbsp;";
//}
//t(100);

//function genTree5($items) {
//    foreach ($items as $item)
//        $items[$item['pid']]['son'][$item['id']] = &$items[$item['id']];
//    return isset($items[0]['son']) ? $items[0]['son'] : array();
//}
//
///**
// * �����ݸ�ʽ�������νṹ
// * @author Xuefen.Tong
// * @param array $items
// * @return array
// */
//function genTree9($items) {
//    $tree = array(); //��ʽ���õ���
//    foreach ($items as $item)
//        if (isset($items[$item['pid']]))
//            $items[$item['pid']]['son'][] = &$items[$item['id']];
//        else
//            $tree[] = &$items[$item['id']];
//    return $tree;
//}
//
//$items = array(
//    1 => array('id' => 1, 'pid' => 0, 'name' => '����ʡ'),
//    2 => array('id' => 2, 'pid' => 0, 'name' => '������ʡ'),
//    3 => array('id' => 3, 'pid' => 1, 'name' => '�ϲ���'),
//    4 => array('id' => 4, 'pid' => 2, 'name' => '��������'),
//    5 => array('id' => 5, 'pid' => 2, 'name' => '������'),
//    6 => array('id' => 6, 'pid' => 4, 'name' => '�㷻��'),
//    7 => array('id' => 7, 'pid' => 4, 'name' => '�ϸ���'),
//    8 => array('id' => 8, 'pid' => 6, 'name' => '����·'),
//    9 => array('id' => 9, 'pid' => 7, 'name' => '����ֱ��'),
//    10 => array('id' => 10, 'pid' => 8, 'name' => '������ҵ��ѧ'),
//    11 => array('id' => 11, 'pid' => 9, 'name' => '��������ҵ��ѧ'),
//    12 => array('id' => 12, 'pid' => 8, 'name' => '������ʦ����ѧ'),
//    13 => array('id' => 13, 'pid' => 1, 'name' => '������'),
//    14 => array('id' => 14, 'pid' => 13, 'name' => '����'),
//    15 => array('id' => 15, 'pid' => 13, 'name' => '�ڶ���'),
//    16 => array('id' => 16, 'pid' => 14, 'name' => 'é����'),
//    17 => array('id' => 17, 'pid' => 14, 'name' => '������'),
//    18 => array('id' => 18, 'pid' => 16, 'name' => '��Դ��'),
//    19 => array('id' => 19, 'pid' => 16, 'name' => '�ϰӴ�'),
//);
//echo "<pre>";
//print_r(genTree5($items));
//print_r(genTree9($items));
// echo "<pre>";
// $area = array(
//     array('id'=>1,'area'=>'����','pid'=>0),
//     array('id'=>2,'area'=>'����','pid'=>0),
//     array('id'=>3,'area'=>'�㶫','pid'=>0),
//     array('id'=>4,'area'=>'����','pid'=>0),
//     array('id'=>11,'area'=>'������','pid'=>1),
//     array('id'=>12,'area'=>'������','pid'=>1),
//     array('id'=>21,'area'=>'������','pid'=>2),
//     array('id'=>45,'area'=>'������','pid'=>4),
//     array('id'=>113,'area'=>'���˴�','pid'=>11),
//     array('id'=>115,'area'=>'���˴�','pid'=>11),
//     array('id'=>234,'area'=>'������','pid'=>21)
// );
// function t($arr,$pid=0,$lev=0){
//     static $list = array();
//     foreach($arr as $v){
//         if($v['pid']==$pid){
//             echo str_repeat(" ",$lev).$v['area']."<br />";
// //�����������Ϊ�˿�Ч��
//             $list[] = $v;
//             t($arr,$v['id'],$lev+1);
//         }
//     }
//     return $list;
// }
// $list = t($area);
// echo "<hr >";
// print_r($list);
// $a=1;
// $b=3;
// if ($a=2||$b=5) {
//     $a++;
//     $b++;

// }
// echo  $a,',',$b;
// $func='stytoupper';
// echo $func('php');
// $n=1;
// if ($n==1) {
//    $result=2;
// }elseif ($n<2) {
//     $result=3;
// }elseif ($n>0) {
//     $result=4;
// }else{
//     $result=5;
// }
// echo $result;
// $db = new PDO('mysql:dbname=blog', 'root', 'root');
// $sql = 'create table if not exists tedu_comment(
// 	id int unsigned key auto_increment,
// 	uid int unsigned comment "�������۵��û�id",
// 	bid int unsigned comment "���۵Ĳ���id",
// 	content varchar(255)comment "��������",
// 	created int unsigned comment "����ʱ��"
// )';
// $db->exec($sql);
// $link = mysqli_connect('localhost', 'root', '', 'poetry', 3306); mysqli_select_db ($link ,'t_shop'); $sql = 'select * from members'; $result = mysqli_query($link ,$sql); mysqli_data_seek($result,3); 
// class my_class{ var $my_var; function _my_class($value){ $this->my_var = $value; } } $a = new my_class(10); echo $a->my_var();
// class my_class{ var $value; } $a = new my_class(); $a->my_value = 5; $b = $a; $b->my_value = 10; echo $a->my_value
// class my_class{ var $value; } 
// $a = new my_class(); 
// $a->my_value = 5; 
// $b = $a; 
// $b->my_value = 10; 
// echo $a->my_value
// $c=file_get_contents("http://www.baidu.com");
// echo $c;
// Class father{ Private $str="hello"; 
// Function fun1(){ Echo $this->str; } } 
// Class son extends father{ Private $str="hello-son"; } 
// $ob=new son; 
// $ob->fun1()
// class my_class{ private $index = 0; 
// 	var $my_value = array(); 
// 	function my_class ($value){ $this->my_value[$this->index] = $value; 
// 		$this->index++; } function set_value ($value){ $this->my_value = $value; } } $a = new my_class ('a'); 
// 		$a->my_value[] = 'b'; 
// 		$a->set_value ('c'); 
// 		$a->my_class('d')
// class Foo{ private $name = 'hdj'; public function getName(){ return $this->name; } } class Bar extends Foo{ public $name = 'dedeka'; } $bar = new Bar; 
// var_dump($bar->name); 
// var_dump($bar->getName()); \
// function toChineseDate($date){ \
// 	return date(""Y-m-d"",mktime($date)); 
// }
// class my_class{ var $my_var; function _my_class($value){ $this->my_var = $value; } } $a = new my_class(10); echo $a->my_var()
$link = mysqli_connect("localhost","root","root"); mysqli_select_db($link ,"user5"); mysqli_query($link ,"set names gbk"); $result = mysqli_query($link ,"select * from user5"); while($re = mysqli_fetch_array($result)){ echo "{$re->id}<br>"; echo "{$re->title}<br>"; } mysqli_free_result($result);