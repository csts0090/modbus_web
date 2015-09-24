<?php
	require("mysql.php");
	$sch_id = $_POST['sta'];
	$upload = $_POST['up'];
	$username = $_POST['user'];
	$passwd = $_POST['passwd'];
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

		$host=$upload;
		//$destdir="";
		$workdir="temp.txt";
		$ran=system(`date +%Y-%m-%d-%T`);
		$con=ftp_connect($host,21,60) or die("ftp_connect error");
		ftp_login($con, $username, $passwd);
		//if(ftp_put($con,rand(-2147483648,2147483647).".txt",$workdir,FTP_ASCII)){
		if(ftp_put($con,system('date +%Y%m%d').".txt",$workdir,FTP_ASCII)){
			echo "successfully uploaded\n";
		}else{
			echo "There was aproblem while uploading $workdir";
		}
		ftp_close($con);
		

?>

