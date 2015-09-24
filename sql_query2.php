<!DOCTYPE html>
<html lang="zh-TW">
<head>
<meta charset="utf-8">
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
$command = $_POST['command'];
$database = $_POST['database'];
exec("sudo mysql -uroot -pgh37143715 $database -e \"$command\" > sql.txt 2>&1");
//system("sudo mysql -uroot -pgh37143715 SystemControl -e \"$command\" > sql.txt 2>sql.txt");
//system("mysql -uroot -pgh37143715 SystemControl -e 'select * from Schedule_data' > sql.txt");

	$handle = fopen('/var/www/demo/sql.txt',"r");
	if($handle){
		$number=0;
		$content=array();
		while(!feof($handle)){
		//	echo fgets($handle);
			$content[$number] = fgets($handle);
			$number++;
		}
		fclose($handle);
	}
	header("Location: http://140.127.196.105:3987/demo/sql.txt");


	//echo "<form>"."<table>";
	//echo "<tr>"."<td>"."位址"."</td>"."<td>"."資料"."</td>"."</tr>";
	//echo "<tr>";
	//for($i=0;$i<$num;$i++){
		//echo "<td>".$dev_addr."</td>";	
	//}

	//for($i=0;$i<($number-1);$i++){
		//echo "<td>".$content[$i]."</td>";
	//}
	//echo "</tr>";
	//echo "</table>";
	//echo "</from>";
?>
</body>
</html>
