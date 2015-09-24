<?php
	$no = $_POST['q'];
	require("mysql.php");
	$tit = "";
	$sql = mysql_db_query("$dbname","select address from DeviceDataField where station_no=$no");
	if(!$sql)
	{
		echo "Execute SQL failed:".mysql_error();
	}
	/* 取出欄位名稱，並串成陣列 */
	while($row = mysql_fetch_field($sql)){
		$tit .=$row->name.",";
	}
	/* 分解欄位名稱陣列 */
	$titName=explode(",", $tit);

	$dev_addr = array();
	$i=0;
	//while($rowDb=mysql_fetch_array($sql)){
		//$dev_addr[$i] = $rowDb["station_no"];//The index can use number or string; 
	while($rowDb=mysql_fetch_row($sql)){ //The index only uses a number;
		$dev_addr[$i] = $rowDb[0];
		$i++;
	}

	//echo count($dev_addr);
	for($i=0; $i<count($dev_addr);$i++)
	{      
		//select tag無法解析javascript
	       //echo "<script type='text/javascript'>";
		//echo "document.getElementById('dev_addr').options[$i] = new Option('$dev_addr[$i]');";
		//echo "document.createElement('option');";
		echo "<option>$dev_addr[$i]</option>";
		//echo "</script>";
	}
	mysql_close($dbc);

?>
