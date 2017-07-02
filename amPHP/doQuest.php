<!DOCTYPE html>
<?php
session_start();
$dbhost = 'localhost';
$dbuser = 'dbuser';
$dbpwd = 'linda93060';
$dbname = 'i4010db';
$dsn = "mysql:host=$dbhost;dbname=$dbname";
require_once("../lib/PHPMailer/PHPMailerAutoload.php");
try {
    $db_conn = new PDO($dsn, $dbuser, $dbpwd);
}
catch (PDOException $e) {
    echo $e->getMessage();
    die ("錯誤: 無法連接到資料庫");
}
$db_conn->query("SET NAMES UTF8");
$mail = new PHPMailer();
$mail->IsSMTP();                                 
$mail->SMTPAuth = false;
$mail->Host = "140.129.6.160";
$mail->Port = 25;
$mail->CharSet = "utf-8";
$mail->Encoding = "base64";
$mail->WordWrap = 500;
$mail->Username = "l13013312333@gmail.com";
$mail->Password = "linda93060";
$mail->SetFrom('l13013312333@gmail.com', '蒼龍替天行道公司');


$NO = $_GET['no'];
$sql= "SELECT * FROM quest WHERE number='$NO'";
$result = $db_conn->query($sql);
$user = $result->fetchall();

if(count($user) == 0){
	echo "發生錯誤";
}
else {
	foreach ($user AS $item){
		$things = $item['things'];
		$id_number = $item['id_number'];
		$time = $item['Time'];
		$sql= "SELECT * FROM staff WHERE id_number='$id_number'";
		$result = $db_conn->query($sql);
		$user2 = $result->fetchall();
		if(count($user2) == 0){
			
		}
		else{
			foreach($user2 AS $data){
				$em = $data['email'];
				$name=$data['name'];
			}
		}
	}
}


?>
<html>
<body>
<form action="" method="post">
<b style="color:red">注意! 寄出的同時會刪除事件。</b><br>
會員 : <input type="text" value='<?php echo $id_number;?>' disabled /><br><br>
事件 : <input type="text" value='<?php echo $things;?>' disabled /><br><br>
地址 : <input type="text" value='<?php echo $em;?>' disabled /><br><br>
內容 : <br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<textarea name="comment" cols="60" rows="20" placeholder="輸入事件處理內容...">
（此為系統通知信，請勿回覆）

	親愛的用戶 <?php echo $name;?> 您好，

	關於您在 <?php echo $time;?> 發生的問題:

	<?php echo $things; ?>


	以下是處理方式。
================================
</textarea>
<input name="send_mail" type="submit" value="寄出">
<?php
if(isset($_POST['send_mail'])){
	$mail->Subject = '蒼龍替天行道公司，事件寄送通知!!';
	$Notice = $_POST['comment'];
	
	$eMail = $em;
	$mail->AddAddress($eMail, $eMail);
	$mail->Body = $Notice;
	if($mail->Send()) {
		echo "<br><b style='color:red;'>己寄出，請勿重覆按鈕!!<br>並耐心等待轉頁.......</b>";
	}
	else{
		echo $mail->ErrorInfo . "<br/>"; 
	}
	$mail->ClearAllRecipients();
	
	$sql="DELETE FROM `quest` WHERE `number` = '$NO'";
	$result=$db_conn->query($sql);
	header("Refresh: 1.5; url=findQuest.php");
}
?>
</body>
</html>