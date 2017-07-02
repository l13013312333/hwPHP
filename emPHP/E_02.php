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
	<title>記錄查詢</title>
	<style>
	div{ text-align:center; font-weight:bold; font-family:標楷體; }
	table.imagetable {
		font-family: verdana,arial,sans-serif;
		font-size:25px;
		color:#333333;
		border-width: 1px;
		border-color: #999999;
		border-collapse: collapse;
	}
	table.imagetable th {
		background:#b5cfd2 url('cell-grey.jpg');
		border-width: 1px;
		padding: 4px;
		border-style: solid;
		border-color: #999999;
	}
	table.imagetable td {
		background:#dcddc0 url('cell-blue.jpg');
		border-width: 1px;
		padding: 4px;
		border-style: solid;
		border-color: #999999;
	}
	</style>
</head>
<body>
<?php
$id_number = $_SESSION['id_number'];
$sql= "SELECT * FROM checklist WHERE id_number='$id_number'";
$result = $db_conn->query($sql);
$data=$result->fetchall();
if(count($data) == 0){
	echo '此員工沒有簽到簽退紀錄';
}
else{
?>
	<div>
	<table class="imagetable" align="center">
		<caption style="text-align:center; font-size:20px;">
		<?php echo "<span style='color:orange;'>".$id_number."</span>"; ?> 本月和上個月的簽到簽退紀錄</caption>
		<tr><td>日期</td><td>簽到狀態</td><td>簽到時間</td><td>簽退狀態</td><td>簽退時間</td></tr>
<?php
    foreach($data AS $item){
		$getDate= date("Y-m-d");
		$o1 = substr($getDate,5,2);
		$date=$item['date'];
		$o2 = substr($date,5,2);
		if($o2 == $o1 || $o2 == $o1 - 1){
			$morning=$item['morning'];
			$check_in=$item['check_in'];
			$afternoon=$item['afternoon'];
			$check_out=$item['check_out'];
?>
	<tr>
		<th><?php echo $date;?></th>
		<th>
		<?php 
		if($morning == 1) echo "<span style='color:green;'>已簽到</span>";
		else if($morning == 2) echo "<span style='color:blue;'>遲到</span>";
		else	echo "<span style='color:red; font-weight:bold;'>未出席</span>";
		?>
		</th>
		<th><?php echo $check_in;?></th>
		<th>
		<?php
		if($morning){
			if($afternoon == 1) echo "<span style='color:green;'>已簽退</span>";
			else if($afternoon == 0) echo "<span style='color:blue;'>未簽退</span>";
			else	echo "<span style='color:red; font-weight:bold;'>早退</span>";
		}else	echo "<span style='color:red; font-weight:bold;'>未出席</span>";
		?>
		</th>
		<th><?php echo $check_out;?></th>
	</tr>

<?php	}
	}
?>
    </table>
	</div>
<?php
}
?>
</body>
</html>