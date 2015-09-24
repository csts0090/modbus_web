<!DOCTYPE html>
<html lang="zh-TW">
<head>
<title></title>
<meta charset="utf-8">
</head>
<body>
<?php
	$month = $_POST['M'];
	$day = $_POST['D'];
	$hours = $_POST['H'];
	$min = $_POST['m'];
	//echo 'success'.'<br/>';
	echo '<h2>系統本地所擁有備份檔</h2>'.'<br/>';
	$command="$min $hours $day $month * /var/www/demo/crontab.sh";
	system("sudo echo \"$command\" > /var/spool/cron/crontabs/www-data");
		if ($handle = opendir('/var/www/demo/sql')) {  //開啟現在的資料夾
		      while (false !== ($file = readdir($handle))) {
		      	//避免搜尋到的資料夾名稱是false,像是0
		      	if ($file != "." && $file != "..") {
		      	//去除掉..跟.
		      		echo "<a href='$file'>$file</a><br>";              
		      	}
		      }
			   closedir($handle);
		}


	//header("Location: http://192.168.4.127/demo/download3.php");






?>
</body>
</html>
