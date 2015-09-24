<?php
	//w3cschool 有教學
	echo readfile('/var/www/demo/test.txt');
	echo '<br>';


	$handle = fopen('/var/www/demo/test.txt',"r");
//	$contents='';
	if($handle){
		while(!feof($handle)){
		echo fgets($handle);	
		}
		fclose($handle);
	}
?>
