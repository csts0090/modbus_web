<!DOCTYPE html>
<html lang="zh-TW">
<head>
<title>ajax test</title>
	<style>
	    table{
		  width: 50%;
	          border-collapse: collapse;
	    }
		    
	    table, td, th {
	          border: 1px solid black;
		  padding: 5px;
	   }
			    
	    th {text-align: left;}
	</style>
<body>
	
<?php
	$id = $_GET['q'];
	require("mysql.php");
	$tit = "";
	$sql = mysql_db_query("$dbname","select * from Schedule_item where schedule_id='$id'");
	if(!$sql)
	{
		echo "Execute SQL failed:".mysql_error();
	}
	/* 取出欄位名稱，並串成陣列 */
	while($row = mysql_fetch_field($sql)){
		$tit .=$row->name.",";
	}
	/* 分解欄位名稱陣列 */
	$titName=explode(",", $tit);
	echo "<form>"."<table>"."<tr>";
	for ($i=0; $i<count($titName)-1; $i++){
		echo "<td >".$titName[$i]."</td>";
	}
	echo "</tr>";
	echo "<tr>";
	 /* 列出所有資料錄，並將資料錄內容轉成變數 */
	 while ($rowDb=mysql_fetch_row($sql)) {
		for ($i=0; $i<count($rowDb); $i++)
		{
		/* 將列的出欄位數值陣列，轉成變數 */
			$titName2[$i]=$rowDb[$i];
			echo "<td >".$titName2[$i]."<input id='btn' type=\"hidden\" name=\"sch[]\" value='$titName2[$i]'/></td>";
		}
		echo "</tr>";						
	 }
		echo "</table>";
		echo "</form>";
	 mysql_close($dbc);
?>
</body>
</html>
