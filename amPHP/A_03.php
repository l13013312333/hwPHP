<!DOCTYPE html>

<html>
<style type="text/css"> 
body { 
font: normal 11px auto "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif; 
    color: #4f6b72; 
    background: #E6EAE9; } 
a { 
    color: #c75f3e; } 

html>body td {
    font-size:11px;} 
	    input[type="text"]{padding:5px 15px; border:2px black solid;
		cursor:pointer;
		-webkit-border-radius: 5px;
		border-radius: 5px; }
</style>
<script language='javascript'>
function asd(php_name) {
			var id = document.getElementById('id').value;
			document.getElementById('iframe').src = php_name + '?id_number=' + id; 
		}

</script>
<body>
<input type="text" name="id" id="id" onkeyup="asd('delStaff2.php');" placeholder="輸入員工編號" /><br><br>
<iframe id="iframe" frameborder="0" src="delStaff.php" width='99%' height='500dp'></br></iframe>

</body>
</html>