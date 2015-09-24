<!DOCTYPE html>
<html>
<head>
<title>ajax test</title>
</head>
<body>
	<select id="sch_list">
		<option></option>
	</select>
</body>
<?php
	require("mysql.php");
	$tit = "";
	$sql = mysql_db_query("$dbname","select distinct schedule_id from Schedule_item");
	if(!$sql)
	{
		echo "Execute SQL failed:".mysql_error();
	}
	while($row = mysql_fetch_field($sql)){
		$tit .=$row->name.",";
	}
	$titName=explode(",", $tit);

	$sch_id = array();
	$i=0;
	//while($rowDb=mysql_fetch_array($sql)){
	 	//$sch_id[$i] = $rowDb["schedule_id"];//Index can use number or string; 
	while($rowDb=mysql_fetch_row($sql)){ //Index only uses number;
	 	$sch_id[$i] = $rowDb[0];
		$i++;
	 }

	//echo count($sch_id);
	 for($i=0; $i<count($sch_id);$i++)
	 {
	 	echo "<script type='text/javascript'>";
		echo "document.getElementById('sch_list').options[$i] = new Option('$sch_id[$i]');";
		echo "</script>";
	 }
	 mysql_close($dbc);

?>
</html>
