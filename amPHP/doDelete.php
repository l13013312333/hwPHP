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

$id = $_GET['id'];
$sql="DELETE FROM `staff` WHERE `id_number` = '$id'";
$result=$db_conn->query($sql);
echo "<b style='color:green'>刪除員工編碼成功<br></b>";
sleep(1);

$sql="DELETE FROM `quest` WHERE `id_number` = '$id'";
$result=$db_conn->query($sql);
echo "<b style='color:green'>刪除員工事件成功<br></b>";
sleep(1);


$sql="DELETE FROM `checklist` WHERE `id_number` = '$id'";
$result=$db_conn->query($sql);

echo "<b style='color:green'>刪除員工簽到記錄成功<br>請耐心等待轉頁。</b>";
header("refresh:1; url=delStaff.php");

?>