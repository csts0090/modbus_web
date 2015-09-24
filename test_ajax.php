<!DOCTYPE html>
<html lang="zh-TW">
<head>
<title>ajax test</title>
</head>
<body>
	
	Schedule id:<select id="sch_list" onchange="showlist(this.value)">
		<option></option>
	</select >
	<br><br>
	<span id="list"></span>
	<br><br>
		<button>submit</button>
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
	 	//$sch_id[$i] = $rowDb["schedule_id"];//The index can use number or string; 
	while($rowDb=mysql_fetch_row($sql)){ //The index only uses a number;
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
<script >
function showlist(str){
	if(str == ""){
	 document.getElementById("list").innerHTML = "";
	 return;
	}else {
	        if (window.XMLHttpRequest) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
	        	xmlhttp = new XMLHttpRequest();
		} else {
		     // code for IE6, IE5
	            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		  xmlhttp.onreadystatechange = function() {
		  if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	                document.getElementById("list").innerHTML = xmlhttp.responseText;
		  }
		}
		xmlhttp.open("GET","test_ajax2.php?q="+str,true);
		xmlhttp.send();
	}
}
</script>
</html>
