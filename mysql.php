<?php
	$dbhost="127.0.0.1"; //MySQL主機位址，localhost=本機

	$dbuser="root"; //MySQL帳號

	$dbpass="gh37143715"; //MySQL密碼

	$dbname="SystemControl"; //資料庫名稱

	$dbc=mysql_connect ($dbhost, $dbuser, $dbpass); //連結MySQL資料庫

	$linkdb=mysql_select_db($dbname); //資料庫連結資訊
?>
