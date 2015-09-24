<?php
	$address = $_POST['addr'];
	echo 'success'.'<br/>';
	$filename=system("date +%Y-%m-%d-%T");
	system(" mysqldump -uroot -pgh37143715 -A --default-character-set=utf8 > remote_sql/mysql.sql");
	$filename2=system("ls -tr /var/www/demo/remote_sql/ |tail -n 1");

		 $url = 'http://'.$address;
		 $ch = curl_init();
	         curl_setopt( $ch, CURLOPT_URL, $url );
		 curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		 curl_setopt( $ch, CURLOPT_POST, true );
		 curl_setopt( $ch, CURLOPT_POSTFIELDS, 
		 array(
		 //'my_file' => file_get_contents( '/path/my_file_data' ) 
		 'my_file' => "@/var/www/demo/remote_sql/mysql.sql" 
		 )
		 );  
		 echo curl_exec( $ch );
		 curl_close( $ch );

	//header("Location: http://192.168.4.127/demo/download3.php");






?>

