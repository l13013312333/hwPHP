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
	
	$id_number=$_SESSION['id_number'];
	$today=date("Y-m-d");
	$now=date("h:i:s");
	$sql="SELECT * FROM checklist WHERE id_number='$id_number' AND date='$today'";
	$result=$db_conn->query($sql);
	$user = $result->fetchall();
	if(count($user)==0){
		echo "<p  style='color:red;'>無簽到記錄，不可簽退。</p>";
	}
	else{
		foreach($user AS $item){
			if($item['afternoon']==0){
				$sql="UPDATE checklist SET afternoon='2', check_out='$now' WHERE id_number='$id_number' AND date='$today'";
				$result=$db_conn->query($sql);
				echo "<b  style='color:blue;'>已簽退成功!</b>";
			}
			else{
				echo "<b  style='color:red;'>已有記錄。</b>";
			}
		}
	}
	echo "處理完畢";
?>
</body>
</html>