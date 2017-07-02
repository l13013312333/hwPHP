<?php
session_start();
session_unset();
session_destroy();
echo'<meta charset="utf-8">';
echo "<p style='text-align:center; font-size:30px; height:300px; line-height:300px;'>Redirecting... <strong>登出中</strong></p>";
echo'<meta http-equiv="expires" content="-1">';
echo'<meta http-equiv="cache-control" content="no-cache">'; 
echo'<meta http-equiv="pragma" content="no-cache">';
//echo'<meta http-equiv="refresh" content="1; url=index.html">';
//header("Location:index.html");
header("Refresh:1; url=index.html");
exit();
?>