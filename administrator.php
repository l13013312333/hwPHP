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

  <title>管理員頁面</title>

    <link rel="stylesheet" href="css/style4.css" media="screen" type="text/css" />

</head>

<body>

  <span class='bckg'></span>
<header>
  <h1>
    <b>管理員頁面</b>
  </h1>
  <nav>
    <ul>
      <li>
        <a href="amPHP/A_01.php" target ="showframe" data-title='信息區' >信息區</a>
      </li>
      <li>
        <a href="amPHP/A_02.php" data-title='員工新增' target ="showframe">員工新增</a>
      </li>
      <li>
        <a href="amPHP/A_03.php" data-title='員工刪除' target ="showframe">員工刪除</a>
      </li>
      <li>
        <a href="amPHP/A_04.php" data-title='員工資料修改' target ="showframe">員工資料修改</a>
      </li>
      <li>
        <a href="amPHP/A_05.php" data-title='簽到查詢' target ="showframe">簽到查詢</a>
      </li>
      <li>
        <a href="javascript:location.replace('logout.php')" data-title='登出'>登出</a>
      </li>
    </ul>
  </nav>
</header>
<main>
  <div class='title'>
    <h2>歡迎</h2>
    <a href='javascript:location.replace("logout.php")' title='Profile'>
      Hello <?php echo $name;?> !
    </a>
  </div>
  <iframe  frameborder="1" name="showframe" src="amPHP/A_05.php" width='99%' height='200%' >
	</iframe>
  
</main>

  <script src='js/jquery.js'></script>
  <script src='js/index2.js'></script>
</body>
</html>