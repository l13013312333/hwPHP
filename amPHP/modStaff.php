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

$db_conn->query("SET NAMES UTF8");

$sql = "SELECT * FROM staff WHERE id_number Like '%%'";
$result = $db_conn->query($sql);
$user = $result->fetchall();

?>
<html>
<style type="text/css"> 
body { 
font: normal 11px auto "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif; 
    color: #4f6b72; 
    background: #E6EAE9; } 
a { 
    color: #c75f3e; } 
#mytable { 
    width: 400px; 
    padding: 0; 
    margin: 0; } 
caption { 
    padding: 0 0 5px 0; 
    width: 700px;      
font: italic 11px "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif; 
    text-align: right; } 
th { 
font: bold 11px "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif; 
    color: #4f6b72; 
    border-right: 1px solid #C1DAD7; 
    border-bottom: 1px solid #C1DAD7; 
    border-top: 1px solid #C1DAD7; 
    letter-spacing: 2px; 
    text-transform: uppercase; 
    text-align: left; 
    padding: 6px 6px 6px 12px; 
    background: #CAE8EA; } 
th.nobg { 
    border-top: 0; 
    border-left: 0; 
    border-right: 1px solid #C1DAD7; 
    background: none; } 
td { 
    border-right: 1px solid #C1DAD7; 
    border-bottom: 1px solid #C1DAD7; 
    background: #fff; 
    font-size:11px; 
    padding: 6px 6px 6px 12px; 
    color: #4f6b72; } 
td.alt { 
    background: #F5FAFA; 
    color: #797268; } 
th.spec { 
    border-left: 1px solid #C1DAD7; 
    border-top: 0; 
    background: #fff; 
font: bold 10px "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif; 
} 
th.specalt { 
    border-left: 1px solid #C1DAD7; 
    border-top: 0; 
    background: #f5fafa; 
font: bold 10px "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif; 
    color: #797268; } 
html>body td {
    font-size:11px;} 
	    input[type="text"]{padding:5px 15px; border:2px black solid;
		cursor:pointer;
		-webkit-border-radius: 5px;
		border-radius: 5px; }
</style>

<body>

<table id="mytable" cellspacing="0">
  <tr>
    <th scope="col" abbr="Configurations">員工編號</th>
    <th scope="col" abbr="Dual 1.8">姓名</th>
    <th scope="col" abbr="Dual 2">Email</th>
	<th scope="col" abbr="Dual 2">修改</th>
  </tr>
  
  <?php
	$count=0;
	if(count($user)==0){
		echo "無資料";
	}
	else{
		foreach($user AS $item){
			if($count==0){
				echo "<tr>";
				echo "<th scope='row' abbr='Model' class='spec'>" . $item['id_number'] . "</th>";
				echo "<td>". $item['name']."</td>";
				echo "<td>" . $item['email'] ."</td>";
				echo "<td> <input type='button' onclick='javascript:location.href=\"doModify.php?id=". $item['id_number']."\"' value='修改'></input></td>";
				echo "</tr>";
				$count = 1;
			}
			else{
				echo "<tr>";
				echo "<th scope='row' abbr='G5 Processor' class='specalt'>" . $item['id_number'] . "</th>";
				echo "<td>". $item['name']."</td>";
				echo "<td>" . $item['email'] ."</td>";
				echo "<td> <input type='button' onclick='javascript:location.href=\"doModify.php?id=". $item['id_number']."\"' value='修改'></input></td>";
				echo "</tr>";
				$count = 0;
			}
		}
	}
	
	
  ?>
  
</table>

</body>
</html>