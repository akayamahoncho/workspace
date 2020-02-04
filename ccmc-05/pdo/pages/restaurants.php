<?php

require_once("../database.php");
require_once("../classes.php");
$area = -1;
if (isset($_REQUEST["area"])) {
      $area = intval($_REQUEST["area"]);
}
//データベース
$pdo = connectDatabase();
///SQL
$sql = "select * from restaurants where area=:area";
//sqlを実行
$pstmt = $pdo->prepare($sql);
//プレースホルダを設定
$pstmt->bindValue(1, $area);
$param[":area"] = $area;
//SQLを実行
$pstmt->execute();
//結果
$rs = $pstmt->fetchAll();
$restaurants = [];
foreach ($rs as $record) {
    $id = intval($record["id"]);
    $name = $record["name"];
    $detail = $record["detail"];
    $image = $record["image"];
    $restaurants = new Restaurant($id, $name, $detail, $image, $area);
    $restaurants[] = $restaurant;
    
}
echo "OK";
exit(0);
?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8" />
		<title>PDOを使ってみる</title>
	</head>
	<body>
		<h1>PDOを使ってみる</h1>
		<h2>選択された地域のレストラン一覧</h2>
		<table border="1">
			<tr>
				<th>レストランID</th>
				<th>レストラン名</th>
				<th>詳細</th>
				<th>画像ファイル名</th>
				<th>地域ID</th>
			</tr>
			<?php foreach ($restaurants as $restaurant) { ?>
			<tr>
			    <td><?= $restaurant->getId() ?></td>
			    <td><?= $restaurant->getName() ?></td>
			    <td><?= $restaurant->getDetail() ?></td>
			    <td><?= $restaurant->getImage() ?></td>
			    <td><?= $restaurant->getArea() ?></td>
			</tr>
			<?php } ?>
		</table>
	</body>
</html>