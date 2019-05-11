<?php
require "sphinxapi.php";
function replace($words, $title) {
	foreach ($words as $k => $v) {
		$title = str_replace($k, "<font color='red'>$k</font>", $title);
	}
	return $title;
}
$k = $_GET['k'];
// print_r($_GET);
// die();
$pdo = new PDO('mysql:host=localhost;dbname=psd1803', 'root', 'root');
// print_r($pdo
// $k = $_GET['k'];
// $pdo = new PDO('mysql:host=localhost;dbname=blog', 'root', 'root');

$cl = new SphinxClient();
$cl->SetServer('127.0.0.1', 9312);
$cl->SetConnectTimeout(3);
$cl->SetArrayResult(true);
$cl->SetMatchMode(SPH_MATCH_ANY);
$res = $cl->Query($k, "*");
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $_GET['k'] ?></title>
</head>
<body>
<form action="search.php" method="get">
	搜索：<input value="<?php echo $_GET['k'] ?>" type="text" style="width:300px;height:25px;line-height:25px;font-size:16px" name='k'/>&nbsp;&nbsp;
	<input type="submit" value="查询"/>

</form>
<hr/>
<ul>
<?php
if (isset($res['matches'])) {
	foreach ($res['matches'] as $v) {
		$id = $v['id'];
		$sql = "select * from use1 where id=$id";
		$pdoS = $pdo->query($sql);
		$arr = $pdoS->fetch(PDO::FETCH_ASSOC);
		?>
		<li><?php echo replace($res['words'], $arr['title']); ?></li>
		<?php
}
}
?>
</ul>
</body>
</html>