<?php
include "../basic/include.php";
include "../basic/database.php";

$itemid = $_GET[itemid];		
$flag = '';
if($itemid=='')
	$flag = 'none';

if($flag == ''){//��ȡ�ֿ���Ϣ
	$query = "select * from table_warehouse order by id";//echo $query."<br>";
	$result_warehouse = mysql_query($query);
	$x_length = mysql_num_rows($result_warehouse);
}

if($flag == ''){//��ȡ��Ʒ��Ϣ
	$query = "select * from tb_product where encode = '$itemid'";//echo $query."<br>";
	$result_iteminfo = mysql_query($query);	
}
$RS = mysql_fetch_array($result_iteminfo);
$title = "$RS[encode]-$RS[name]-���ͳ��";

include ("jpgraph/jpgraph.php");
include ("jpgraph/jpgraph_bar.php");

//$datay=array(160,180,203,289,405,488,489,408,299,166,187,105);

$i = 0;
while($RS = mysql_fetch_array($result_warehouse)){
	$aix_x[$i] = $RS[name];
	
	$query = "select * from table_warehouse_$RS[id] where id = '$itemid'";//echo $query."<br>";
	$result_storage = mysql_query($query);
	$RS2 = mysql_fetch_array($result_storage);
	if(empty($RS2))
		$aix_y[$i] = 0;
	else
		$aix_y[$i] = $RS2[num];
	
	$i++;
	$sum += $RS2[num];
}

//print_r($aix_x);
//print_r($aix_y);
//die('\n end \n');

//��������
$graph = new Graph(600,300,"auto");	
$graph->SetScale("textlin");
$graph->yaxis->scale->SetGrace(20);

//����������Ӱ
$graph->SetShadow();

//������ʾ�����ҡ��ϡ��¾���ߵľ��룬��λΪ����
$graph->img->SetMargin(40,30,30,40);

//����һ�����εĶ���
$bplot = new BarPlot($aix_y);

//��������ͼ����ɫ
$bplot->SetFillColor('orange');	
//������ʾ����	
$bplot->value->Show();
//������ͼ����ʾ��ʽ����ͼ������
$bplot->value->SetFormat('%d');
//������ͼ��ӵ�ͼ����
$graph->Add($bplot);

//���û�������ɫΪ����ɫ
$graph->SetMarginColor("lightblue");

//��������
$graph->title->Set($title);

//����X����������
//$a=array("1��","2��","3��","4��","5��","6��","7��","8��","9��","10��","11��","12��");
$graph->xaxis->SetTickLabels($aix_x); 

//��������
$graph->title->SetFont(FF_SIMSUN);
$graph->xaxis->SetFont(FF_SIMSUN); 

//�������ͼ��
$graph->Stroke();
?>

