<!DOCTYPE html>

<?php
session_start();
$dbhost = 'localhost';
$dbuser = 'dbuser';
$dbpwd = 'linda93060';
$dbname = 'i4010db';
$dsn = "mysql:host=$dbhost;dbname=$dbname";
require_once("include/db_func.php");
require_once("lib/PHPMailer/PHPMailerAutoload.php");
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
?>
<html>
<head>
<meta charset="UTF-8">
<title>電腦簽到系統</title>

<link rel="stylesheet" href="css/style.css">

<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
<link rel='stylesheet prefetch' href='https://fonts.googleapis.com/icon?family=Material+Icons'>
<style>
.Outerbox { width:100%; margin:0px auto; overflow:auto; height:auto; z-index:10; }
</style>
</head>
<body background="image/back.jpg">
<ul class="bg-bubbles">
	<li></li>
	<li></li>
	<li></li>
	<li></li>
	<li></li>
	<li></li>
	<li></li>
	<li></li>
	<li></li>
	<li></li>
	<li></li>
	<li></li>
	<li></li>
	<li></li>
	<li></li>
</ul>
<div class="cotn_principal">
<br>
 <h1>蒼龍替天行道公司の簽到系統</h1>
 <?php
				if(isset($_POST['Submit'])){
					if(isset($_POST['ID'])&&isset($_POST['PWD'])){//驗證
						$id = $_POST['ID'];
						$Password = $_POST['PWD'];
						$pw = sha1($Password);
						$sql = "SELECT * FROM staff WHERE id='$id' AND password='$pw'";
						$result = $db_conn->query($sql);
						$user = $result->fetchall();
						if(count($user)==0) {
							echo "<b style='color:red;'>帳號或密碼錯誤，請重新輸入 </b>";
						}
						else{
							foreach($user AS $item){
								$_SESSION['ID']=$id;
								header("location:login_sucess.php");
								exit();
							}
						}
					}
					else {
						echo "<b style='color:red;'>請輸入帳號密碼</b>" ;
						
					}
				}
				
				//////////////////////////////////////////////////////
				
				
				if(isset($_POST['forget_pwd'])){
					if(isset($_POST['ID_forget'])){//驗證
						$id = $_POST['ID_forget'];
						$sql = "SELECT * FROM staff WHERE id_number='$id'";
						$result = $db_conn->query($sql);
						$user = $result->fetchall();
						if(count($user)==0) {
							echo "<b style='color:red;'>查無此人!! </b>";
						}
						else{
							foreach($user AS $item){
								$name=$item['name'];
								if (!isset($_COOKIE['email'])){
									$mail->Subject = '蒼龍替天行道公司，密碼寄送通知!!';
									$eMail = $item['email'];
									
									$word = array();
									$word[] = 'abcdefghijklmnopqrstuvwxyz';
									$word[] = 'ABCDEFGHJKLMNOPQRSTUVWXYZ';
									$num = '2345678';
									$length = rand(8, 12);
									$password_len = $length;
									$password = '';
									
									$x = rand(1, $password_len-4);
									$y = ($password_len-4) - $x;
									$len = strlen($word[0]);
									for($i = 0; $i < $x; $i++){
										$password .= substr($word[0], (rand() % $len), 1);
									}
									$len = strlen($word[1]);
									for($i = 0; $i < $y; $i++){
										$password .= substr($word[1], (rand() % $len), 1);
									}
									$len = strlen($num);
									for($i = 0; $i < 3; $i++){
										$password .= $num[rand() % $len];
									}
									$pdw = str_shuffle($password);
									
									$Notice = "（此為系統通知信，請勿回覆）\n\n    親愛的用戶 $name 您好，\n\n";
									$Notice .= "    您申請 蒼龍替天行道公司簽到系統的 更改密碼！\n";
									$Notice .= "=============================================================\n";
									$Notice .= "\n	您新的密碼為 : ".$pdw;
									
									
									$mail->AddAddress($eMail, $eMail);
									$mail->Body = $Notice;
									
									$P = sha1($pdw);
									$sql = "UPDATE staff SET password = '$P' WHERE id_number='$id'";
									$result=$db_conn->query($sql);
									
									if($mail->Send()) {
										setcookie("email","sent",time()+30);
										echo "<b style='color:red;'>己寄出，請勿頻繁操作。</b>";
									}
									else{
										echo $mail->ErrorInfo . "<br/>"; 
									}
									$mail->ClearAllRecipients();
								}
								else {
									echo "<b style='color:red;'>請勿頻繁操作，稍等30秒。</b>";
								}
							}
						}
					}
					else {
						echo "<b style='color:red;'>請輸入帳號密碼</b>" ;
						
					}
				}
				////////////////////////////////////////////
				
				
				if(isset($_POST['Con_GM'])){
					if(!empty($_POST['con_id']) && !empty($_POST['con_thing'])){
						$id=$_POST['con_id'];
						$sql = "SELECT * FROM staff WHERE id_number='$id'";
						$result = $db_conn->query($sql);
						$user = $result->fetchall();
						if(count($user)==0){
							echo "<b style='color:red;'>查無此人!! </b>";
						}
						else{
							$thing=$_POST['con_thing'];
							$today=date("Y-m-d");
							$sql="INSERT INTO `quest`( `Time`, `id_number`, `things`) VALUES ('$today','$id','$thing')";
							$result=$db_conn->query($sql);
							echo "<b style='color:orange;'>己送出成功。</b>";
						}
					}
					else echo "<b style='color:red;'>請勿空白。 </b>";
				}

			?>
  <div class="cont_centrar">
	<div class="cont_login">
	  <div class="cont_info_log_sign_up">
		<div class="col_md_login">
		  <div class="cont_ba_opcitiy">
			<h2>員工簽到處</h2>
			<p >休息時間不需要簽到。</p>
			<button id="Submit_login" class="btn_login" onClick="cambiar_login()">登入</button>
		  </div>
		</div>
		<div class="col_md_sign_up">
		  <div class="cont_ba_opcitiy">
			<h2>其他</h2>
			<button class="btn_sign_up" onClick="cambiar_forget_password()">忘記密碼</button>
			<button class="btn_sign_up" onClick="cambiar_sign_up()">連絡管理員</button>
		  </div>
		</div>
	  </div>
	  <div class="cont_back_info">
		<div class="cont_img_back_grey"> <img src="po.jpg" alt="" /> </div>
	  </div>
	  <div class="cont_forms" >
		<div class="cont_img_back_"> <img src="po.jpg" alt="" /> </div>
		<div class="cont_form_login"> <a href="#" onClick="ocultar_login_sign_up()" ><i class="material-icons">&#xE5C4;</i></a>
		  <h2>登入</h2>
		  <form method="POST" name="LoginForm" action="">
			  <p style="color:#555555;">第一次登入者帳號、密碼，<br>請用公司員工碼登入。</p>
			  <input class="input_sign" id="ID" name="ID" type="text" placeholder="帳號" /><br>
			  <input class="input_sign" id="PWD" name="PWD" type="password" placeholder="密碼" /><br>
			  <input type="submit"  name="Submit" class="btn_login"  value="進入"></input>
		  </form>
		  
		</div>
		<div class="cont_form_sign_up"> <a href="#" onClick="ocultar_login_sign_up()"><i class="material-icons">&#xE5C4;</i></a>
		  <h2>連絡管理員</h2>
		  <form method="POST" name="Contact" action="">
			  <br><p style="color:white;">請先填寫員工編號，填寫問題。</p>
			  <input name="con_id" class="input_sign" type="text" placeholder="員工編號" />
			  <input name="con_thing" class="input_sign" type="text" placeholder="簡單說明事項" />
			  <br><br>
			  <input type="submit" class="btn_sign_up" name="Con_GM" onClick="cambiar_sign_up()" value="寄出"></input>
		  </form>
		</div>
		<div class="cont_form_forget_password"> <a href="#" onClick="ocultar_login_sign_up()"><i class="material-icons">&#xE5C4;</i></a>
		  <h2>忘記密碼</h2>
			<form method="POST" name="Contact" action="">
			  <br><p style="color:white;">密碼將寄往信箱，請五鐘後查看。</p>
			  <input name="ID_forget" class="input_sign" type="text" placeholder="員工編號" />
			  <br><br>
			  <input type="submit" name="forget_pwd" class="btn_forget_password" onClick="cambiar_forget_password()" value="寄出" ></input>
			</form>
			
		</div>
	  </div>
	</div>
  </div>
</div>


<script src="js/index.js"></script>
<script src="js/jquery-2.1.1.min.js" type="text/javascript"></script>

<footer>
<div class="Outerbox"><div class="Outerbox" style="position: fixed; bottom:20px;">
<table align="center"><tr>
	<th width="100%">
	此處所有載明之商標為各持有者之財產。著作權 &copy; 2017 蒼龍替天行道公司の簽到系統。蒼龍替天行道公司。版權所有。
	</th>
</tr></table>
</div></div>
</footer>
</body>
</html>

