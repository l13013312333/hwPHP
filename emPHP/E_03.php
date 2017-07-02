<!DOCTYPE html>
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
?>
<html>
<head>
	<meta charset="UTF-8">
	<title>個人資料</title>
	<style>
	div{ text-align:left; font-weight:bold; font-family:標楷體; font-size:18px}
	</style>
</head>
<body>
<div>
<?php
	$db_conn->query("SET NAMES UTF8");
	$id_number = $_SESSION['id_number'];
	$sql = "SELECT * FROM staff WHERE id_number='$id_number'";
	$result = $db_conn->query($sql);
	$user = $result->fetchall();
	if(count($user)==0){
		
	}
	else{
		foreach($user AS $item){
			$name=$item['name'];
		}
	}
	echo "<span style='font-size:20px;'>我是編號 ";
	echo "<span style='color:orange;'>".$item['id_number']."</span>";
	echo " 員工</span></br></br>";
	echo "姓名 : ".$item['name'];
	if(isset($_POST['name'])) {
		$namesql = "UPDATE staff SET name ='".$_POST['name']."' WHERE id_number='$id_number'";
		$result = $db_conn->query($namesql);
		$user = $result->fetchall();
		header("Location:E_03.php"); 
	}
	if(isset($_POST['email'])) {
		$emailsql = "UPDATE staff SET email ='".$_POST['email']."' WHERE id_number='$id_number'";
		$result = $db_conn->query($emailsql);
		$user = $result->fetchall();
		header("Location:E_03.php"); 
	}
?>
	<form method="POST" action="" >請輸入正確姓名 : 
	<input type="text" name="name" value="">
	<input type="submit" value="修改">
	</form>
<?php
	echo "</br>性別 : ";
	if($item['sex'] == "M") echo "男性</br>";
	else if($item['sex'] == "F")echo "女性</br>";
	else echo "中性</br>";
	echo "生日 : ".$item['birth']."</br></br>";
	echo "電子信箱 : ".$item['email'];
?>
	<form method="POST" action="" >請輸入正確信箱 :
	<input type="text" name="email" value=""  >
	<input type="submit" value="修改">
	</form>
	</br>
	<span style="color:red;">請注意!</span><span style='font-size:20px;'> 如員工資料有變更請盡速修改,蒼龍公司感謝您的配合!</span>
</div>
</body>
</html>