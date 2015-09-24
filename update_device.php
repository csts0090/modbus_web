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
	<h2>即時監控</h2>
	          <hr /> 
    	 Device no.:<select name=device_no id="dev_no" onchange="showaddr(this.value)">
		<option></option>
	</select >
    	 address:<select name=address id="dev_addr">
		<option></option>
	</select >
	<input name=content id='content' type=text />
	<input type="button" value="更改" onclick="showlist()">
	<br><br>
	<input id="on" type="button" value="監控" onclick="showlist2()">
	<hr />
	<span id="list"></span>
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

function showlist(){
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
		  }
		}
	//	xmlhttp2.open("GET","monitor_up.php?device_no="+document.getElementById("dev_no").value+"&address="+document.getElementById("dev_addr").value+"&content="+document.getElementById("content").value,true);
	//	xmlhttp2.send();
		xmlhttp2.open("POST","monitor_up.php",true);
		xmlhttp2.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp2.send("device_no="+document.getElementById("dev_no").value+"&address="+document.getElementById("dev_addr").value+"&content="+document.getElementById("content").value);
}

function showlist2(){
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
		  }
		}
	//	xmlhttp2.open("GET","monitor_up.php?device_no="+document.getElementById("dev_no").value+"&address="+document.getElementById("dev_addr").value+"&content="+document.getElementById("content").value,true);
	//	xmlhttp2.send();
		xmlhttp2.open("POST","monitor_up2.php",true);
		xmlhttp2.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp2.send("device_no="+document.getElementById("dev_no").value+"&address="+document.getElementById("dev_addr").value);
	setTimeout(showlist2,500);
}
function sleep(milliseconds) {
  var start = new Date().getTime();
    for (var i = 0; i < 1e7; i++) {
        if ((new Date().getTime() - start) > milliseconds){
	      break;
	  }
    }
}
</script>
</html>
