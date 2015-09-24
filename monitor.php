<?php


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
	for($i=0;$i<($number-1);$i++){
		echo $content[$i];
	}
?>
