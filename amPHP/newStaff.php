<!DOCTYPE html>
<html>
<body>
<?php
session_start();
$dbhost = 'localhost';
$dbuser = 'dbuser';
$dbpwd = 'linda93060';
$dbname = 'i4010db';
$dsn = "mysql:host=$dbhost;dbname=$dbname";
try {
    $db_conn = new PDO($dsn, $dbuser, $dbpwd);
}
catch (PDOException $e) {
    echo $e->getMessage();
    die ("錯誤: 無法連接到資料庫");
}

$db_conn->query("SET NAMES UTF8");
$peo = $_GET['people'];
$where = $_GET['where'];
$year=(date("Y")-1911);
$month=date("m");

$sql = "SELECT * FROM time_add WHERE year='$year' AND month='$month' AND wh='$where'";
$result = $db_conn->query($sql);
$user = $result->fetchall();

if(count($user) == 0){
	$sql = "INSERT INTO `time_add`(`year`, `month`, `wh`) VALUES ('$year','$month','$where')";
	$result = $db_conn->query($sql);
}
foreach($user AS $item){
	$Nm=($item['number'] + $peo);
	$num=$item['number'];
	
	while(strlen($num) != 5){
		$num = "0".$num;
	}
		
	$add=$year.$month."0".$where.$num;
	echo "已增加 :<br><br>";
	for($i = 0; $i < $peo; $i++){
		$add = ($add + 1);
		$pad = sha1($add);
		$sql = "INSERT INTO `staff`(`id_number`, `id`, `password`) VALUES ('$add', '$add', '$pad')";
		$result = $db_conn->query($sql);
		echo $add."<br>";
	}
	echo "完成";
	$sql = "UPDATE `time_add` SET `number`='$Nm' WHERE year='$year' AND month='$month' AND wh='$where'";
	$result = $db_conn->query($sql);
}


?>
</body>
</html>