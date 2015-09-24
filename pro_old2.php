<!DOCTYPE html>
<html lang="zh-TW">
  <head>
    <title>優越科技測試專案</title>
    <meta charset="utf-8">
    <meta name="keywords" content="網頁關鍵字">
    <meta name="description" content="網頁大網">
    <link rel="stylesheet" href="css-js/layout.css">
    <script src="css-js/jquery-1.11.0.min.js"></script>
    <script src="css-js/layout.js"></script>
  </head>
  <body>
    <div id="headArea">
      <div id="head-L">
        <a title="優越科技" href="./index.html"><img src="images/layout_set_logo.jpg"></a>
      </div>
    </div>

    <!--head_Button_Area-->
    <div id="headBtnArea">
      <div id="headBtn">
          <li id="Line">
            <a title="資料收集" class="btn1" href="data1.php">資料收集</a>
                <div class="headBtn-items">
                  <div><a title= "新增資料" href="data_add.html">新增資料</a></div>
                  <div><a title= "程式化" href="pro.html">程式化</a></div>
                  <div><a title= "手動" href="data1.php">手動</a></div>
                </div>
          </li>
          <li>
            <a title="資料發佈" class="btn1" href="datapull.php">資料發佈</a>
                <div class="headBtn-items">
                  <div><a title= "經由PHP" href="data1.php">PHP</a></div>
                  <div><a title= "經由E-mail" href="data2.php">E-mail</a></div>
                  <div><a title= "經由HTTP" href="data2.php">HTTP</a></div>
                  <div><a title= "自行下載" href="data2.php">自行下載</a></div>
                </div>
          </li>
          <li>
            <a title="資料管理" class="btn1" href="datamg.php">資料管理</a>
                <div class="headBtn-items">
                  <div><a title= "遠端備份" href="data1.php">遠端備份</a></div>
                  <div><a title= "遠端存取" href="data2.php">遠端存取</a></div>
                </div>
          </li>
      </div>
    </div>
		<table id="sch_table" width="580">
		 <tr>
		    <td width="150" class="td" >裝置名稱</td>
		    <td width="150" class="td" >資料位址</td>
		    <td width="150" class="td" >開始時間</td>
		    <td width="150" class="td" >結束時間</td>
		    <td width="150" class="td" >period</td>
		 </tr>
	<?php
		
		$num1 = count($_POST["sch1"]);
		$dbc = mysqli_connect('localhost', 'root', 'gh37143715', 'SystemControl') or die('Error connecting to MySQL server');
	  	$query = "INSERT INTO Schedule (schedule_id,status,name,pid)"."VALUES('','1','$_POST[schname]','0')";
	  	$result = mysqli_query($dbc, $query) or die('Error querying database.');
		
		$query = "SELECT max(schedule_id) from Schedule";
		$sch_id=mysqli_query($dbc,$query);
	  	$sch_row = mysqli_fetch_array($sch_id);
		$schedule_id =(int) $sch_row['max(schedule_id)'];
		echo $schedule_id.'<br/>';	
		//$schedule_id = mysql_insert_id();

		$filename = "temp_file.txt";
		$fp = fopen($filename, "w");
		fwrite($fp, $schedule_id."\n");
		for($_i=0; $_i<$num1; $_i++)
		{
			$station_no = $_POST["sch1"][$_i];
			$address = $_POST["sch2"][$_i];
			$time_start = $_POST["sch3"][$_i];
			$time_stop = $_POST["sch4"][$_i];
			$time_period = $_POST["sch5"][$_i];
				
			echo $station_no.'<br/>';
			echo $address.'<br/>';
			echo $time_start.'<br/>';
			echo $time_stop.'<br/>';
			echo $time_period.'<br/>';

	  		$query2 = "INSERT INTO Schedule_item (schedule_id,station_no,address,time_start,time_stop,time_period)"."VALUES('$schedule_id','$station_no','$address','$time_start','$time_stop','$time_period')";
	  		$result2 = mysqli_query($dbc, $query2) or die('Error querying database.');
			echo '<br/><br/><br/><br/>'.$query2;
			
			fwrite($fp, $station_no." ");
			fwrite($fp, $address." ");
			fwrite($fp, $time_start." ");
			fwrite($fp, $time_stop." ");
			fwrite($fp, $time_period."\n");
			
		}

	  	$query3 = "SELECT * FROM Schedule";
	  	$result3 = mysqli_query($dbc, $query3);

	  	while($row = mysqli_fetch_array($result3))
	  	{
	  	  echo $row['schedule_id'].'<br/>'.$row['status'].'<br/>'.$row['name'].'<br/>'.$row['pid'].'<br/>';
	  	}





		$pid = pcntl_fork();
		
	if ( $pid == -1 ) {       
		// Fork failed           
		exit(1);
	} else if ( $pid ) {
		// We are the parent
		// Can no longer use $db because it will be closed by the child
		// Instead, make a new MySQL connection for ourselves to work with
		//$db = mysql_connect($server, $username, $password, true);
		
		$status = null;
	  	$query = "UPDATE Schedule SET pid=$pid where Schedule_id=$schedule_id";
	  	$result = mysqli_query($dbc, $query) or die('Error querying database.');
		pcntl_waitpid($pid, $status);
	} else  {
		   // We are the child
		   // Do something with the inherited connection here
		   // It will get closed upon exit
		   if( pcntl_exec('/usr/bin/serial_read3', array('/var/www/demo/temp_file.txt')) == 0)
		   {
		   	echo 'error';
		   }
		   else
			echo 'sucessful';

		}
		


	  /*	$query4 = "SELECT * FROM Schedule_item";
	  	$result4 = mysqli_query($dbc, $query4);
	  	while($row = mysqli_fetch_array($result4))
	  	{
	  	  echo $row['schedule_id'].'<br/>'.$row['station_no'].'<br/>'.$row['address'].'<br/>'.$row['time_start'].'<br/>'.$row['time_stop'].'<br/>'.$row['time_period'].'<br/>';
	  	}*/
		
		fclose($fp);
	  	mysqli_close($dbc);
	?>

  </body>
</html>

