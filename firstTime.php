<!DOCTYPE html>
<html>
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

	if(isset($_POST['submit'])){
		$id = $_POST['id'];
		$pass = sha1($_POST['pass']);
		$name = $_POST['name'];
		$birth = $_POST['birth'];
		$sex = $_POST['sex'];
		$em = $_POST['em'];
		$IP = $_SERVER["REMOTE_ADDR"];
		$sql = "UPDATE staff SET name='$name',birth='$birth',sex='$sex',email='$em',id='$id',password='$pass',first='1',IP='$IP' WHERE id_number='$id_number'";
		$result = $db_conn->query($sql);
		$sql = "SELECT * FROM staff WHERE id_number='$id_number'";
		$result = $db_conn->query($sql);
		$user = $result->fetchall();
			if(count($user)==0) {
				echo "發生錯誤。";
				header("Refresh: 1.5; url=index2.php");
				exit();
			}
			else{
				foreach($user AS $item){
					$juris=$item['juris'];
					
					if ($juris == "0") {
						//管理員頁面網址貼在這!!
						header("Refresh: 1.5; url=administrator.php");
					}
					else {
						//員工頁面網址貼在這!!
						header("Refresh: 1.5; url=employee.php");
					}
					exit();
					
				}
			}
	}
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link rel="stylesheet" media="screen" href="css/zzsc.css" /> 
</head>
<script language='javascript'>

	window.history.forward(1);
	var input = 0;

	function check_id(a){
		document.getElementById('pass').disabled = true;
		document.getElementById('cpass').disabled = true;
		document.getElementById('next_01').disabled = true;
		document.getElementById('submit').disabled = true;
		if(a.length < 4) {
			document.getElementById('write').innerHTML = "<b  style='color:red;'>帳號長度過短。</b>";
		}
		else{
			document.getElementById('write').innerHTML = " ";
			var toalarm = false;
			var ch;
			var stralarm = new Array("<", ">", ".", "!", "\'", "\"", " ", "-", "+", "=", "@", "#", "$", "%", "^", "&", "*", "(", ")", "~", "`", "//", "\\", ",", ".", "?", "{", "}", "[", "]", "|");
			
			for(var i = 0; i < stralarm.length; i++){
				for(var j = 0; j < a.length; j++){
					ch = a.substr(j, 1);
					if(ch == stralarm[i]) toalarm = true;
				}
			}
			if(toalarm) document.getElementById('write').innerHTML = "<b  style='color:red;'>請勿用特殊符號。</b>";
			else{
				var myhtml = $.ajax({
					type:"POST",
					url:"include/getuser.php",
					data:{ id:a },
					async:false
				}).responseText;
				if(myhtml == "yes") {
					document.getElementById('write').innerHTML = "<b  style='color:green;'>此帳號可以使用。</b>";
					document.getElementById('pass').disabled = false;
				}
				else if (myhtml == "no") document.getElementById('write').innerHTML = "<b  style='color:red;'>此帳號己有人使用。</b>";
				else if (myhtml == "same") document.getElementById('write').innerHTML = "<b  style='color:red;'>不可用員工編號。</b>";
			}
		}
	}
	
	function check_pass(b){
		document.getElementById('cpass').disabled = true;
		document.getElementById('next_01').disabled = true;
		document.getElementById('submit').disabled = true;
		document.getElementById('write').innerHTML = " ";
		if(b.length < 6) {
			document.getElementById('write').innerHTML = "<b  style='color:red;'>密碼長度過短。</b>";
		}
		else{
			document.getElementById('write').innerHTML = " ";
			var toalarm = false;
			var ch;
			var stralarm = new Array("<", ">", ".", "!", "\'", "\"", " ", "-", "+", "=", "@", "#", "$", "%", "^", "&", "*", "(", ")", "~", "`", "//", "\\", ",", ".", "?", "{", "}", "[", "]", "|");
			
			for(var i = 0; i < stralarm.length; i++){
				for(var j = 0; j < b.length; j++){
					ch = b.substr(j, 1);
					if(ch == stralarm[i]) toalarm = true;
				}
			}
			if(toalarm) document.getElementById('write').innerHTML = "<b  style='color:red;'>請勿用特殊符號。</b>";
			else{
				document.getElementById('cpass').disabled = false;
			}
		}
	}
	
	function check_cpass(c){
		document.getElementById('next_01').disabled = true;
		document.getElementById('submit').disabled = true;
		var a = document.getElementById('pass').value;
		document.getElementById('write').innerHTML = " ";
		
		var toalarm = false;
		var ch;
		var stralarm = new Array("<", ">", ".", "!", "\'", "\"", " ", "-", "+", "=", "@", "#", "$", "%", "^", "&", "*", "(", ")", "~", "`", "//", "\\", ",", ".", "?", "{", "}", "[", "]", "|");
		
		for(var i = 0; i < stralarm.length; i++){
			for(var j = 0; j < c.length; j++){
				ch = c.substr(j, 1);
				if(ch == stralarm[i]) toalarm = true;
			}
		}
		if(toalarm) document.getElementById('write').innerHTML = "<b  style='color:red;'>請勿用特殊符號。</b>";
		else{
			if(a == c) {
				document.getElementById('next_01').disabled = false;
				document.getElementById('write').innerHTML = "<b  style='color:green;'>下一步己解鎖。</b>";
			}
			else document.getElementById('write').innerHTML = "<b  style='color:red;'>密碼不一，請再確認。</b>";
			
		}
		
	}
	
	function check_name(d){
		document.getElementById('em').disabled = true;
		document.getElementById('birth').disabled = true;
		document.getElementById('next_02').disabled = true;
		document.getElementById('submit').disabled = true;
		document.getElementById('write2').innerHTML = " ";
		
		
		if(d.length > 0) {
			var toalarm = false;
			var ch;
			var stralarm = new Array("<", ">", ".", "!", "\'", "\"", " ", "-", "+", "=", "@", "#", "$", "%", "^", "&", "*", "(", ")", "~", "`", "//", "\\", ",", ".", "?", "{", "}", "[", "]", "|");
			for(var i = 0; i < stralarm.length; i++){
				for(var j = 0; j < d.length; j++){
					ch = d.substr(j, 1);
					if(ch == stralarm[i]) toalarm = true;
				}
			}
			
			if(toalarm) {
				document.getElementById('write2').innerHTML = "<b  style='color:red;'>請勿用特殊符號。</b>";
			}
			else{
				document.getElementById('write2').innerHTML = " ";
				document.getElementById('birth').disabled = false;
				document.getElementById('em').disabled = false;
			}
		}
		else{
			document.getElementById('write2').innerHTML = "<b  style='color:red;'>姓名請勿空白。</b>";
		}
	}
	
	function check_dat(e){
		if(e != "") {
			document.getElementById('write2').innerHTML = " ";
			document.getElementById('em').disabled = false;
		}
		else{
			document.getElementById('write2').innerHTML = "<b  style='color:red;'>生日填寫未完全。</b>";
		}
	}
	
	function check_email(f){
		document.getElementById('next_02').disabled = true;
		document.getElementById('submit').disabled = true;
		if(f != ""){
			var toalarm = false;
			var toalcheck = false;
			var ch;
			var stralarm = new Array("<", ">", "!", "\'", "\"", " ", "-", "+", "=", "#", "$", "%", "^", "&", "*", "(", ")", "~", "`", "//", "\\", ",", "?", "{", "}", "[", "]", "|");
			
			for(var i = 0; i < stralarm.length; i++){
				for(var j = 0; j < f.length; j++){
					ch = f.substr(j, 1);
					if(ch == stralarm[i]) toalarm = true;
					if(ch == "@")toalcheck = true;
				}
			}
			if(toalarm) document.getElementById('write2').innerHTML = "<b  style='color:red;'>請勿用特殊符號。</b>";
			else{
				if(toalcheck){
					document.getElementById('next_02').disabled = false;
					document.getElementById('submit').disabled = false;
					document.getElementById('write2').innerHTML = "<b  style='color:green;'>下一步己解鎖。</b>";
				}
				else{
					document.getElementById('write2').innerHTML = "<b  style='color:red;'>E-mail格式不正確。</b>";
				}
			}
		}else{
			document.getElementById('write2').innerHTML = "<b  style='color:red;'>E-mail不可空白。</b>";
		}
	}
	

</script>
<body>

<div style="display:none">
	
	<a href="http://mathiasbynens.be/demo/jquery-size" target="_blank" data-mce-href="http://mathiasbynens.be/demo/jquery-size"></a>
</div>

<form  method="POST" id="msform" name="msform" action="">
	<!-- progressbar -->
	<ul id="progressbar">
		<li class="active">帳密創建</li>
		<li>基本資料</li>
		<li>完成註冊</li>
		
	</ul>


	<!-- fieldsets -->
	<fieldset>
		<h2 class="fs-title">創建你的新帳號</h2>
		<h3 class="fs-subtitle">不可特殊符號 。</h3>
		<label id="write">0 V0</label></br>
		<input type="text" onkeyup="check_id(this.value);" name="id" id="id" maxlength="12" placeholder="帳號( 英文、數字、中文、(_)符號，4~12字)" />
		<input type="password" onkeyup="check_pass(this.value);" name="pass" id="pass" maxlength="12" placeholder="密碼( 英文、數字，6~12字 )" disabled />
		<input type="password" onkeyup="check_cpass(this.value);" name="cpass" id="cpass" placeholder="確認密碼" disabled />
		<input type="button" name="next_01" id="next_01" class="next action-button" value="下一步" disabled />
	</fieldset>
	<fieldset>
		<h2 class="fs-title">基本資料</h2>
		<h3 class="fs-subtitle">請正確填寫，創建後部分無法修改。</h3>
		<label id="write2">0 V0</label></br>
		<input type="text" onkeyup="check_name(this.value);" name="name" id="name" placeholder="姓名(可中文)"  />
		<input type="date" onkeyup="check_dat(this.value);" name="birth" id="birth" placeholder="生日" disabled />
		<select style="padding: 15px;border: 1px solid #ccc;border-radius: 3px;	margin-bottom: 10px;width: 100%;box-sizing: border-box;font-family: montserrat;	color: #2C3E50;font-size: 13px;" name="sex" id="sex">
			<option value="M" select="selected">男性</option>
			<option value="F">女性</option>
			<option value="D">中性</option>
		</select><br>
		<input type="text" onkeyup="check_email(this.value);" name="em" id="em" placeholder="E-mail" disabled />
		<input type="button" name="previous" class="previous action-button" value="上一步" />
		<input type="button" id="next_02" name="next_02" class="next action-button" value="下一步" disabled />
	</fieldset>
	<fieldset>
		<h2 class="fs-title">完成!!</h2>
		<h3 class="fs-subtitle">如無需要更改，按下確認註冊完成!</h3>
		<input type="button" name="previous" class="previous action-button" value="上一步" />
		<input type="submit" style="width: 100px;background: #27AE60;font-weight: bold;color: white;border: 0 none;border-radius: 1px;cursor: pointer;padding: 10px 5px;margin: 10px 5px;"  id="submit" name="submit" value="確認" disabled />
	</fieldset>
</form>



<script src="http://thecodeplayer.com/uploads/js/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="http://thecodeplayer.com/uploads/js/jquery.easing.min.js" type="text/javascript"></script>
<script src="js/zzsc.js" type="text/javascript"></script>
<br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br>
<div style="text-align:center;clear:both"></div>


</body>
</html>