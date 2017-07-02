<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="text/javascript">

window.history.forward(1);

</script>
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

?>
<html>
<head>
<meta charset="UTF-8">
<title>登入成功</title>

<link rel="stylesheet" href="css/style.css">
</head>
<body background="image/back.jpg">
<ul class="bg-bubbles">
	<li></li>
	<li></li>
	<li></li>
	<li></li>
	<li></li>
	<li></li>
	<li></li>
	<li></li>
	<li></li>
	<li></li>
	<li></li>
	<li></li>
	<li></li>
	<li></li>
	<li></li>
</ul>
<?php
	echo "<br><br><p  style='color:white;font-weight:bold;font-size:xx-large;' align='center'>已登入成功，3秒自動更轉畫面。<br></p>";
	$id=$_SESSION['ID'];
	$sqlcmd = "SELECT * FROM staff WHERE id='$id'";
	$pdodb = $db_conn->prepare($sqlcmd);
	$pdodb->execute();
	$rs = $pdodb->fetchAll();
	
	
	if(count($rs)==0) {
		echo "<b style='color:red;'>帳號或密碼錯誤，請重新輸入 </b>";
	}else{
		foreach($rs AS $item){
			$juris=$item['juris'];
			$first=$item['first'];
			$name=$item['name'];
			$id_number=$item['id_number'];
			if ($first == "0"){
				$_SESSION['id_number']=$id_number;
				header("Refresh: 1.5; url=firstTime.php");
				exit();
			}
			else {
				if ($juris == "0") {
					//管理員頁面網址貼在這!!
					$_SESSION['id_number']=$id_number;
					header("Refresh: 1.5; url=administrator.php");
				}
				else {
					//員工頁面網址貼在這!!
					$_SESSION['id_number']=$id_number;
					header("Refresh: 1.5; url=employee.php");
				}
				exit();
			}
		
		}
	}
	
	
	
?>
</body>
</html>

