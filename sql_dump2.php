<!DOCTYPE html>
<html lang="zh-TW">
<head>
<title></title>
<meta charset="utf-8">
</head>
<body>
<?php
	//$address = $_POST['p'];
	//echo 'success'.'<br/>';
	echo '<h2>系統本地所擁有備份檔</h2>'.'<br/>';
	system("sudo mysqldump -uroot -pgh37143715 -A --default-character-set=utf8 > sql/`date +%Y-%m-%d-%T`.sql");
		if ($handle = opendir('/var/www/demo/sql')) {  //開啟現在的資料夾
		      while (false !== ($file = readdir($handle))) {
		      	//避免搜尋到的資料夾名稱是false,像是0
		      	if ($file != "." && $file != "..") {
		      	//去除掉..跟.
		      		echo "<a href='sql/$file'>$file</a><br>";              
		      	}
		      }
			   closedir($handle);
		}


	//header("Location: http://192.168.4.127/demo/download3.php");






?>
</body>
</html>
