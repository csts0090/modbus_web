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
$operator = $_POST['operator'];
$operand = $_POST['content'];
//system("sudo /usr/bin/client_serial2 $dev_addr 1 $content >123.txt 2>1234.txt");
system("sudo /usr/bin/client_serial $dev_addr 1  >123.txt 2>1234.txt");
//system("mysql -uroot -pgh37143715 SystemControl -e 'select * from Schedule_data'");

	$handle = fopen('/var/www/demo/test.txt',"r");
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
	$devaddr=array();
	echo "<form>"."<table>";
	echo "<tr>"."<td>"."位址"."</td>"."<td>"."資料"."</td>"."</tr>";
	echo "<tr>";
	for($i=0;$i<$num;$i++){
		echo "<td>".$dev_addr."</td>";	
		$devaddr[$i] = $dev_addr;
	}

	for($i=0;$i<($number-1);$i++){
		echo "<td>".$content[$i]."</td>";
	}
	echo "</tr>";
	echo "</table>";
	echo "</from>";
	echo "<h2>事件紀錄</h2>";
	echo "<hr/>";
	for($i=0;$i<($number-1);$i++){
		switch($operator){
			case "==":
				if((int)$content[$i] == (int)$operand){
						system("mosquitto_pub -d -t test -m \"警告時間:`date +%Y-%m-%d-%T裝置`".$dev_no."位址:".$devaddr[$i]."已超出範圍\"");
					$handle2 = fopen('/var/www/demo/LOG',"a");
					if($handle2){
						fwrite($handle2,system('date +%Y-%m-%d-%T>>/var/www/demo/LOG'));
						fwrite($handle2,"警告!!位址:".$devaddr[$i]."已超出範圍\n");
						fclose($handle2);
					}
					$handle = fopen('/var/www/demo/LOG',"r");
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
						for($i=0;$i<($number-1);$i++){
							echo "<h3>".$content[$i]."</h3>";
						}

				}
				
			break;
			case ">":
				if((int)$content[$i] > (int)$operand){
						system("mosquitto_pub -d -t test -m \"警告時間:`date +%Y-%m-%d-%T裝置`".$dev_no."位址:".$devaddr[$i]."已超出範圍\"");
					$handle2 = fopen('/var/www/demo/LOG',"a");
					if($handle2){
						fwrite($handle2,system('date +%Y-%m-%d-%T>>/var/www/demo/LOG'));
						fwrite($handle2,"警告!!位址:".$devaddr[$i]."已超出範圍\n");
						fclose($handle2);
					}
				//	system('date +%Y-%m-%d-%T');
				//	echo "警告!!位址:".$devaddr[$i]."已超出範圍";
					$handle = fopen('/var/www/demo/LOG',"r");
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
						for($i=0;$i<($number-1);$i++){
							echo "<h3>".$content[$i]."</h3>";
						}
					}
			break;
			case "<":
				if((int)$content[$i] < (int)$operand){
						system("mosquitto_pub -d -t test -m \"警告時間:`date +%Y-%m-%d-%T裝置`".$dev_no."位址:".$devaddr[$i]."已超出範圍\"");
					$handle2 = fopen('/var/www/demo/LOG',"a");
					if($handle2){
						fwrite($handle2,system('date +%Y-%m-%d-%T>>/var/www/demo/LOG'));
						fwrite($handle2,"警告!!位址:".$devaddr[$i]."已超出範圍\n");
						fclose($handle2);
					}
					$handle = fopen('/var/www/demo/LOG',"r");
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
						for($i=0;$i<($number-1);$i++){
							echo "<h3>".$content[$i]."</h3>";
						}
				}
				
			break;
			}
	}
?>
</body>
</html>
