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
	
	$id = $_POST['id'];
	
	$sql = "SELECT * FROM staff WHERE id='$id'";
	$result = $db_conn->query($sql);
	$user = $result->fetchall();
	
	if(count($user)==0) {
		echo "yes";
		
	}
	else{
		foreach($user AS $item){
			$id_number=$item['id_number'];
			if($id == $id_number) echo "same";
			else echo "no";
		}
	}

?>