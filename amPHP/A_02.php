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
			var where = document.getElementById('where').value;
			document.getElementById('iframe').src = php_name + '?people=' + id + "&where=" + where;
		}

</script>
<body>
<b style="color:red;">會員編號由民國年份(106) + 月份 + 地區(公司) + 編號(五碼) - 組成。</b><br><br>
<input type="text" name="id" id="id"  placeholder="新增人數" />
<select name='where' id="where">
<option value="2">台北(02)</option>
<option value="3">桃園(03)</option>
<option value="4">台中(04)</option>
<option value="7">高雄(07)</option>
</select>
<br><br>
<input type="submit" name="add" onclick="asd('newStaff.php')" value="新增"></input>
<iframe id="iframe" frameborder="0" width='99%' height='500dp'></br></iframe>

</body>
</html>