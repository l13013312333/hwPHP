<!DOCTYPE html>
<html>
<header>
<script>
	function goOut(){
		document.write("正在處理中....");
		window.location = '../include/checkout.php';
	}
</script>
</header>
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
$id_number = $_SESSION['id_number'];
$sql = "SELECT * FROM staff WHERE id_number='$id_number'";
$result = $db_conn->query($sql);
$user = $result->fetchall();
if(count($user)==0){
	
}
else{
	foreach($user AS $item){
		
	}
}
if($item['IP'] != $_SERVER["REMOTE_ADDR"]) echo "<p style='color:red;'>IP位置不正確，無法簽退</p>";
else{
	$checkout=$item['checkouttime'];
	$today=date("Y-m-d");
	$a=date("a");
	$now=date("h:i:s");
	$nw=date("h:i:s");
	if($a=="pm" && $nw != 12) $nw= $nw+12;
	echo "系統時間 : ".$now. $a ."(桌面可能會與系統時間不一。)<br><br>";
	$H=($checkout - $nw);

	//判斷

	$sql = "SELECT * FROM checklist WHERE id_number='$id_number' AND date='$today'";
	$result = $db_conn->query($sql);
	$user = $result->fetchall();
	if(count($user)==0){
		echo "<p  style='color:red;'>無簽到記錄，不可簽退。</p>";
	}
	else{
		if($H>1){
			$sql="SELECT * FROM checklist WHERE id_number='$id_number' AND date='$today'";
			$result=$db_conn->query($sql);
			$user = $result->fetchall();
			
			foreach($user AS $item){
				
				if($item['afternoon']==0){
					echo "<p  style='color:red;'>現在並非您可以簽退的時間。</p>";
				echo "如有早退需求，請點選下方按鍵。<br>";
				echo "<input name='check' type='button'value='提早簽退' onclick='goOut()'></input>";
				}
				else{
					echo "<b  style='color:red;'>已有簽退記錄!</p>";
				}
			}
		}
		else{
			$sql="SELECT * FROM checklist WHERE id_number='$id_number' AND date='$today'";
			$result=$db_conn->query($sql);
			$user = $result->fetchall();
			if(count($user)==0){
			}
			foreach($user AS $item){
				
				if($item['afternoon']==0){
					$sql="UPDATE checklist SET afternoon='1', check_out='$now' WHERE id_number='$id_number' AND date='$today'";
					$result=$db_conn->query($sql);
					echo "<b  style='color:green;'>已簽退完畢，辛苦您了!</p>";
				}
				else{
					echo "<b  style='color:red;'>已有簽退記錄!</p>";
				}
			}
		}
	}
}
?>
</body>
</html>