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
$dev_no = $_POST['device_no'];
$dev_addr = $_POST['address'];
$num = count($_POST['address']);
$content = $_POST['content'];

system("sudo /usr/bin/client_serial2 $dev_addr 1 $content >123.txt 2>1234.txt");
//system("sudo /usr/bin/client_serial $dev_addr 1  >123.txt 2>1234.txt");
//system("mysql -uroot -pgh37143715 SystemControl -e 'select * from Schedule_data'");

	$handle = fopen('/var/www/demo/test2.txt',"r");
	if($handle){
		$number=0;
		$content=array();
		while(!feof($handle)){
			//echo fgets($handle);
			$content[$number] = fgets($handle);
			$number++;
		}
		fclose($handle);
	}
	echo "<form>"."<table>";
	echo "<tr>"."<td>"."位址"."</td>"."<td>"."資料"."</td>"."</tr>";
	echo "<tr>";
	for($i=0;$i<$num;$i++){
		echo "<td>".$dev_addr."</td>";	
	}

	for($i=0;$i<($number-1);$i++){
		echo "<td>".$content[$i]."</td>";
	}
	echo "</tr>";
	echo "</table>";
	echo "</from>";
?>
</body>
</html>
