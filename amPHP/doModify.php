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

$id_number=$_GET['id'];
$sql= "SELECT * FROM staff WHERE id_number='$id_number'";
$result = $db_conn->query($sql);
$data=$result->fetchall();

if(count($data)==0){
	
}
foreach($data AS $item){
	$name=$item['name'];
	$birth=$item['birth'];
	$sex=$item['sex'];
	$email=$item['email'];
	$checkintime=$item['checkintime'];
	$checkouttime=$item['checkouttime'];
	$id=$item['id'];
	$password=$item['password'];
	$IP=$item['IP'];
}

?>
<html>
<body>
<div style="text-align:center;color: white;">
<form align = 'center' method='post' action=''>
<table class="imagetable" align="center">
		<caption style="color:red; text-align:left; font-size:18px;">修改</caption>
		<tr><th colspan="5">個人資料</th></tr>
		<tr><td>姓名</td>
			<th colspan="4" align="left"><input type="text" name="name" size="10" value="<?php echo $name?>" ></th></tr>
		<tr><td>生日</td>
			<th colspan="4" align="left"><input type="date" name="birth" size="8" value="<?php echo $birth?>" ></th></tr>
		<tr><td>性別</td>
			<th colspan="4" align="left"><select name="sex" id="sex" value="">
				<option value="M"<?php if($sex=="M") echo "selected";?>>男性</option>
				<option value="F"<?php if($sex=="F") echo "selected";?>>女性</option>
				<option value="D"<?php if($sex=="D") echo "selected";?>>中性</option>
			</select></th></tr>
		<tr><td>E-mail</td>
			<th colspan="4" align="left"><input type="text" name="email" size="40" value="<?php echo $email?>" /></th></tr>
		<tr><td>簽到時間</td>
			<th colspan="4" align="left"><input type="text" name="checkintime" size="6" value="<?php echo $checkintime?>" /></th></tr>
		<tr><td>簽退時間</td>
			<th colspan="4" align="left"><input type="text" name="checkouttime" size="6" value="<?php echo $checkouttime?>" /></th></tr>
		<tr><td>帳號</td>
			<th colspan="4" align="left"><input type="text" name="id" size="30" value="<?php echo $id?>" /></th></tr>
		<tr><td>密碼</td>
			<th colspan="4" align="left"><input type="submit" name="password" size="10" value="還原成員工編號" /></th></tr>
		<tr><td>IP位置</td>
			<th colspan="4" align="left"><input type="text" name="IP" size="50" value="<?php echo $IP?>" /></th></tr>
	</table>
	<input name='aaa' type='submit' value='更新'>
</form>
<?php
if(isset($_POST['password'])){//這裡呢?
	$P=sha1($id_number);
	$sql="UPDATE staff SET password='$P'WHERE id_number='$id_number'";//這
	$result = $db_conn->query($sql);
	echo "<p style='color:red;'>還原成功!</p>";
}
if(isset($_POST['aaa'])){
	$name=$_POST['name'];
	$birth=$_POST['birth'];
	$sex=$_POST['sex'];
	$email=$_POST['email'];
	$checkintime=$_POST['checkintime'];
	$checkouttime=$_POST['checkouttime'];
	$id=$_POST['id'];
	$IP=$_POST['IP'];
	$sql="UPDATE staff SET name='$name',birth='$birth',sex='$sex',email='$email',checkintime='$checkintime',checkouttime='$checkouttime',id='$id',IP='$IP' WHERE id_number='$id_number'";	
	$reseult = $db_conn->query($sql);
	echo "<p style='color:red;'>修改成功!!!!</p>" ;

	header("refresh:1; url=modStaff.php");
}

?>
</html>