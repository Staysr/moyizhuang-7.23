<?php
include "../basic/include.php";
include "../basic/database.php";

$warehouse = $_GET[warehouse];	

//���ò�ѯ�ֿ��Ĭ��ֵ
if($warehouse=='')
	$warehouse='0000';
//��ȡ�ֿ��еĻ�Ʒ�����Ϣ
$query = "select * from table_warehouse_$warehouse order by id asc";//die($query);
$result_item = mysql_query($query);

$i = 0;
while($RS = mysql_fetch_array($result_item)){
	$data[$i] = $RS[num];
	$query = "select * from tb_product where encode = '$RS[id]'";
	$result_iteminfo = mysql_query($query);
	$RS2 = mysql_fetch_array($result_iteminfo);
	$name[$i] = $RS2[name];
	
	$targ[$i] = "inquire_storage_item.php?itemid=".$RS[id];
	$alts[$i] = "val=%d";
	$i++;
}
$title = "�ֿ����������";

include_once ("jpgraph/jpgraph.php");
include_once ("jpgraph/jpgraph_pie.php");
include_once ("jpgraph/jpgraph_pie3d.php");			//����3D��ͼPiePlot3D�������ڵ����ļ�

//$data = array(266036,295621,335851,254256,254254,685425);			//��������
$graph = new PieGraph(600,300,'auto');				//��������
$graph->SetShadow();								//���û�����Ӱ

$graph->title->Set($title);			//��������
$graph->title->SetFont(FF_SIMSUN,FS_BOLD);			//���ñ�������
$graph->legend->SetFont(FF_SIMSUN,FS_NORMAL);			//����ͼ������

$p1 = new PiePlot3D($data);							//����3D����ͼ����
$p1->SetLegends($name);
//$targ=array("pie3d_csimex1.php?v=1","pie3d_csimex1.php?v=2","pie3d_csimex1.php?v=3",
//			"pie3d_csimex1.php?v=4","pie3d_csimex1.php?v=5","pie3d_csimex1.php?v=6");
//$alts=array("val=%d","val=%d","val=%d","val=%d","val=%d","val=%d");
$p1->SetCSIMTargets($targ,$alts);

$p1->SetCenter(0.4,0.5);					//���ñ���ͼ���ڻ�����λ��
$graph->Add($p1);							//��3D��ͼ����ӵ�ͼ����
$graph->StrokeCSIM();						//���ͼ�������

?>

