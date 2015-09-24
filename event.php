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
           <a title="資料收集" class="btn1" href="index.html">資料收集</a>
               <div class="headBtn-items">
                 <div><a title= "新增資料" href="data_add.html">新增資料</a></div>
                 <div><a title= "程式化" href="pro.html">排程設定</a></div>
                 <!--<div id="print_sch"><a>排程列示</a></div>-->
                 <div><a title= "手動" href="res.php">排程列示</a></div>
               </div>
         </li>
         <li>
           <a title="資料庫管理" class="btn1" href="index.html">資料庫管理</a>
               <div class="headBtn-items">
                 <div><a title= "資料庫備份" href="sql_dump.php">資料庫備份</a></div>
                 <div><a title= "排程備份" href="crontab.php">排程備份</a></div>
                 <div><a title= "資料庫操作" href="sql_query.php">資料庫操作</a></div>
               </div>
         </li>
         <li>
           <a title="設備監控" class="btn1" href="index.html">設備監控</a>
               <div class="headBtn-items">
                 <div><a title= "即時監控" href="update_device.php">即時監控</a></div>
                 <div><a title= "事件監控" href="event.php">事件監控</a></div>
               </div>
         </li>
     </div>
   </div>

<h2>事件監控</h2>
          <hr /> 

    	 Device No:<select name=device_no id="dev_no" onchange="showaddr(this.value)">
		<option></option>
	</select >
    	 address:<select name=address id="dev_addr">
		<option></option>
	</select >
	<select name=operator id='operator'>
		<option selected="selected" value='0'>請選擇</option>
		<option value='=='>==</option>
		<option value='>'>></option>
		<option value='<'><</option>
	</select>
	<input name=content id='content' type=text />
	<input id="on" type="button" value="監控" onclick="show()">
	<br><br>
	<hr />
	<div id="list">
	<div id="list2"></div>
	</div>
	<br>


</body>
<?php
	require("mysql.php");
	$tit = "";
	$sql = mysql_db_query("$dbname","select distinct station_no from DeviceDataField");
	if(!$sql)
	{
		echo "Execute SQL failed:".mysql_error();
	}
	while($row = mysql_fetch_field($sql)){
		$tit .=$row->name.",";
	}
	$titName=explode(",", $tit);

	$dev_no = array();
	$i=1;
	//while($rowDb=mysql_fetch_array($sql)){
	 	//$dev_no[$i] = $rowDb["station_no"];//The index can use number or string;
	while($rowDb=mysql_fetch_row($sql)){ //The index only uses a number;
	 	$dev_no[$i] = $rowDb[0];
		$i++;
	 }

	//echo count($dev_no);
	 	echo "<script type='text/javascript'>";
		echo "document.getElementById('dev_no').options[0] = new Option('請選擇');";
		echo "</script>";
	 for($i=1; $i<=count($dev_no);$i++)
	 {
	 	echo "<script type='text/javascript'>";
		echo "document.getElementById('dev_no').options[$i] = new Option('$dev_no[$i]');";
		echo "</script>";
	 }
	 mysql_close($dbc);
?>
<script >
function showaddr(str){
	if(str == ""){
	 document.getElementById("dev_addr").innerHTML = "";
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
	                document.getElementById("dev_addr").innerHTML = xmlhttp.responseText;
		  }
		}
		//xmlhttp.open("GET","update_device2.php?q="+str,true);
		//xmlhttp.send();
		xmlhttp.open("POST","update_device2.php",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send("q="+str);
	}
}


function show(){
	if(window.XMLHttpRequest){
			// code for IE7+, Firefox, Chrome, Opera, Safari
	        	xmlhttp2 = new XMLHttpRequest();
		} else {
		     // code for IE6, IE5
	            xmlhttp2 = new ActiveXObject("Microsoft.XMLHTTP");
		}
		  xmlhttp2.onreadystatechange = function() {
		  if (xmlhttp2.readyState == 4 && xmlhttp2.status == 200) {

			document.getElementById("list").innerHTML = xmlhttp2.responseText;
		  	//var text = document.createTextNode("嚴重警告");
		  	//document.getElementById('list').appendChild(text);
		  }
		}
	//	xmlhttp2.open("GET","monitor_up.php?device_no="+document.getElementById("dev_no").value+"&address="+document.getElementById("dev_addr").value+"&content="+document.getElementById("content").value,true);
	//	xmlhttp2.send();
		xmlhttp2.open("POST","event2.php",true);
		xmlhttp2.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp2.send("device_no="+document.getElementById("dev_no").value+"&address="+document.getElementById("dev_addr").value+"&operator="+document.getElementById("operator").value+"&content="+document.getElementById("content").value);
	setTimeout(show,900);
}
</script>
</html>
