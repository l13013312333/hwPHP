<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="css/style2.css" media="screen" type="text/css" />
<link rel="stylesheet" href="css/style3.css" media="screen" type="text/css" />
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
		$name=$item['name'];
	}
}
?>
<html>
<head>
<meta charset="UTF-8">
<title>員工頁面</title>

</head>
<script type="text/javascript">

	window.history.forward(1);

	document.oncontextmenu=function(){ return false; }//防右鍵選單
	document.onkeydown=function(){ if(event.keyCode==67){ return false; } }//防ctrl+c
	document.onunload=function(){ if(event.clientY<0){ document.location=document.location.href; } }//防上一頁按鈕

	function ShowTime(){
		var Now = new Date();
		document.getElementById('showbox').innerHTML = "" + Now.getFullYear() + " / " + (Now.getMonth() + 1) + " / " + Now.getDate();
		var h = Now.getHours();
		if(h < 12){
			if (h == 0) h = 12;
			document.getElementById('showbox2').innerHTML = "上午 " + h + " : " + Now.getMinutes() + " : " + Now.getSeconds();
		}
		else if (h >= 12){
			h = h - 12;
			if (h == 0) h = 12;
			document.getElementById('showbox2').innerHTML = "下午 " + h + " : " + Now.getMinutes() + " : " + Now.getSeconds();
		}
		setTimeout('ShowTime()',1000);
	}

</script>

<body onload="ShowTime()" background="image/white.jpg" style="background-position:center 10%;background-size:100% 1039px;background-repeat:no-repeat;">
	<h1 id="showbox"></h1>
	<h2 id ="showbox2"></h2>
	<iframe  frameborder="0" name="showframe"  style="position:fixed; top: 30%; left:15%;" src="emPHP/E_01.php" width='80%' height='50%'>
	</iframe>
	<div class='card-holder'>
		<div class='card-wrapper'>
			<a href='emPHP/E_01.php' target ="showframe">
				<div class='card bg-01'>
					<span class='card-content'>主畫面</span>
				</div>
			</a>
		</div>
		<div class='card-wrapper'>
			<a href='emPHP/E_02.php' target ="showframe">
				<div class='card bg-02'>
					<span class='card-content'>記錄查詢</span>
				</div>
			</a>
		</div>
		<div class='card-wrapper'>
			<a href='emPHP/E_03.php' target ="showframe">
				<div class='card bg-03'>
					<span class='card-content'>個人資料</span>
				</div>
			</a>
		</div>
		<div class='card-wrapper'>
			<a href='emPHP/E_04.php' target ="showframe">
				<div class='card bg-04'>
					<span class='card-content'>簽到</span>
				</div>
			</a>
		</div>
		<div class='card-wrapper'>
			<a href='emPHP/E_05.php' target ="showframe">
				<div class='card bg-05'>
					<span class='card-content'>簽退</span>
				</div>
			</a>
		</div>
		<div class='card-wrapper'>
			<a id="logout" href="javascript:location.replace('logout.php')">
				<div class='card bg-06'>
					<span class='card-content'>登出</span>
				</div>
			</a>

		</div>

	</div>

</body>
</html>