<?php
	$filename = "/var/www/demo/temp.txt";
	header("Content-type:application/force-download");
	header("Content-Length: " .(string)(filesize($filename)));
	header("Content-Disposition: attachment; filename=".$filename);
	readfile($filename);

?>
