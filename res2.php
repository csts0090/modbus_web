<?php
	require("mysql.php");
//	$sch_id = $_POST['sch'][4];
	$sch_id = $_POST['sta'];
	$mail_name = $_POST['email_name'];
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
			fwrite($fp, " ");
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
	 exec("echo .|mail  -s 'test file'  -r ' 10203015m@gmail.com' -q /var/www/demo/mail_file -a /var/www/demo/temp.txt $mail_name ");
?>

