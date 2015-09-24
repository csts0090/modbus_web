<?php
	require("mysql.php");
	$sch_id = $_POST['sta'];
	$upload = $_POST['up'];
	echo 'success'.'<br/>';
	$filename = "temp.txt";
	$fp = fopen($filename, "w");
	$tit=""; //將陣列變數設成空字串 
	$sql= mysql_db_query ("$dbname", "select * from Schedule_data where schedule_id=$sch_id");
	 /* 取出欄位名稱，並串成陣列 */
	while ($row=mysql_fetch_field($sql)) {
		$tit.=$row->name.",";
        }
	/* 分解欄位名稱陣列 */
	$titName=explode(",", $tit);
	for ($i=0,$j=0; $i<5; $i++,$j++){
		fwrite($fp,$titName[$i]);
		if($j < 4)
			fwrite($fp, ",");
		else if($j == 4)
		{
			 fwrite($fp, " \n ");
			 $j=0;
		}
	}


	while($row=mysql_fetch_row($sql))
	{
		for($i=0,$j=0; $i<count($row); $i++,$j++) {
				echo $row[$i];
				fwrite($fp, $row[$i]);
			if($j < 4)
				fwrite($fp, ",");
			else if($j == 4)
			{
				 fwrite($fp, " \n ");
				 $j=0;
			}
		}
		
	}
	fclose($fp);
	mysql_close($dbc);

		 $url = 'http://'.$upload;
		 $ch = curl_init();
	         curl_setopt( $ch, CURLOPT_URL, $url );
		 curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		 curl_setopt( $ch, CURLOPT_POST, true );
		 curl_setopt( $ch, CURLOPT_POSTFIELDS, 
		 array(
		 //'my_file' => file_get_contents( '/path/my_file_data' ) 
		 'my_file' => '@/var/www/demo/temp.txt' 
		 )
		 );  
		 echo curl_exec( $ch );
		 curl_close( $ch );

	//header("Location: http://192.168.4.127/demo/download3.php");

//	$url = "http://http://140.127.196.107/test/";
	//$url = "http://140.127.196.231:9292/v2/images/01c2975d-ba52-4c12-8d17-8cb1d596a1a5/file";

//	$headers = array("Content-Type:application/octet-stream");
	//$headers = array("X-Auth-Token:8df274da4cbf4427ba664c19c33874a7","Content-Type:application/octet-stream");
	//$headers = array("X-Auth-Token:8df274da4cbf4427ba664c19c33874a7","Content-Type:text/plain");

/*	$file_path_str = "/var/www/demo/temp.txt";
	 $ch = curl_init();
	 curl_setopt($ch, CURLOPT_URL, $url);
	 curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	 curl_setopt($ch, CURLOPT_PUT, 1);
	 $fh_res = fopen($file_path_str, 'r');
	 curl_setopt($ch, CURLOPT_INFILE, $fh_res);
	 curl_setopt($ch, CURLOPT_INFILESIZE, filesize($file_path_str));
	 curl_exec($ch);
	 curl_close($ch);*/


/*	    $data = array( 
	        'action'=>'POST', 
		'file'=>'@'.$fv_realfile,
		'name'=>urldecode( $fv_filename )
		);
		curl_setopt($ch,CURLOPT_URL, "http://SERVER-B/PGET.php");
		curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch,CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch,CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 0);
		curl_setopt($ch,CURLOPT_POSTFIELDS, $data);
		$result = curl_exec($ch);
		$info = curl_getinfo($ch);
		curl_close($ch);*/

?>

