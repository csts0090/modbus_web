<?php
	$station_no = $_POST['station_no'];
	$address = $_POST['address'];
	$reg_number = $_POST['reg_number'];
	$cmd = "./client_serial $address $reg_number";
	system($cmd);


/*	$fp = fopen("test.txt","r");
	$mydata = fgets($fp,2048);
		echo $mydata."</br>";
	while(!feof($fp))
	{
		$arr= fgets($fp,1);
		echo $arr."</br>";
	}
	fclose($fp);
	for($i = 0; $i < count($arr); $i++)
	{
		echo $arr[$i]."</br>";
	}
*/
?>
