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
if($item['IP'] != $_SERVER["REMOTE_ADDR"])
	echo "<p style='color:red;'>IP位置不正確，無法簽到</p>";
else{
	$checkin=$item['checkintime'];
	$today=date("Y-m-d");
	$a=date("a");
	$now=date("h:i:s");
	$nw=date("h:i:s");
	if($a=="pm")$nw= $nw+12;
	echo "系統時間 : ".$now. $a ."(桌面可能會與系統時間不一。)<br><br>";
	$H=($checkin - $nw);

	//判斷

	$sql = "SELECT * FROM checklist WHERE id_number='$id_number' AND date='$today'";
	$result = $db_conn->query($sql);
	$user = $result->fetchall();
	if(count($user)==0){
		$sql="INSERT INTO `checklist`( `id_number`, `date`, `morning`, `afternoon`) VALUES ('$id_number','$today','0','0')";
		$result=$db_conn->query($sql);
	}

	if($H>3){ echo "<p  style='color:red;'>現在並非您可以簽到的時間。</p>"; }
	else if($H>=0){
		$sql="SELECT * FROM checklist WHERE id_number='$id_number' AND date='$today'";
		$result=$db_conn->query($sql);
		$user = $result->fetchall();
		if(count($user)==0){
		}
		foreach($user AS $item){
			if($item['morning']==0){
				$sql="UPDATE checklist SET morning='1', check_in='$now' WHERE id_number='$id_number' AND date='$today'";
				$result=$db_conn->query($sql);
				echo "<b  style='color:green;'>早安，已簽到完畢!</b>";
			}
			else{
				echo "<b  style='color:red;'>已有簽到記錄!</b>";
			}
		}	
	}
	else if($H<0) {
		$sql="SELECT * FROM checklist WHERE id_number='$id_number' AND date='$today'";
		$result=$db_conn->query($sql);
		$user = $result->fetchall();
		if(count($user)==0){
		}
		else{
			foreach($user AS $item){
				if($item['morning']==0){
					$sql="UPDATE checklist SET morning='2', check_in='$now' WHERE id_number='$id_number' AND date='$today'";
					$result=$db_conn->query($sql);
					echo "<b  style='color:blue;'>加油，已補簽完畢!";
				}
				else{
					echo "<b  style='color:red;'>已有簽到記錄!</b>";
				}
			}
		}
	}
}
?>
</body>
</html>