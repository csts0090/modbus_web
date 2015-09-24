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
	<h3>資料庫備份</h3>
	<hr />
    	 備份地點:<select name='device_no' id="dev_no" onchange="showaddr(this.value)">
		  <option selected="selected" value='0'>請選擇</option>
		  <option value='1'>系統本地</option>
		  <option value='2'>遠端主機</option>
	</select >
	<span id="ip_addr"></span>
	<br><br>
	<span id="list"></span>
	<br>

	<hr />
	<div id='dump_file'></div>

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
	 	//echo "<script type='text/javascript'>";
		//echo "document.getElementById('dev_no').options[0] = new Option('請選擇');";
		//echo "</script>";
	 for($i=1; $i<=count($dev_no);$i++)
	 {
	 	//echo "<script type='text/javascript'>";
		//echo "document.getElementById('dev_no').options[$i] = new Option('$dev_no[$i]');";
		//echo "</script>";
	 }
	 mysql_close($dbc);
?>
<script >

function showaddr(str){
	if(str === '1'){
	 //document.getElementById("dev_addr").innerHTML = "";
	 //return;
			document.getElementById("ip_addr").innerHTML = "<input type='button' value='備份' onclick='localload()'>";
	 }
	 else if(str === '2'){
				document.getElementById("ip_addr").innerHTML = "<input id='addr' type='text' name='addr'/><input type='button' value='上傳' onclick='upload()'>";
			    }
}


function localload(){
	        if (window.XMLHttpRequest) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
	        	xmlhttp = new XMLHttpRequest();
		} else {
		     // code for IE6, IE5
	            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		  xmlhttp.onreadystatechange = function() {
		  if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	                document.getElementById("dump_file").innerHTML = xmlhttp.responseText;
		  }
		}
		//xmlhttp.open("GET","sql_dump2.php?q="+str,true);
		//xmlhttp.send();
		xmlhttp.open("POST","sql_dump2.php",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send("q=");
}

function upload(){

	        if (window.XMLHttpRequest) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
	        	xmlhttp = new XMLHttpRequest();
		} else {
		     // code for IE6, IE5
	            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		  xmlhttp.onreadystatechange = function() {
		  if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	                //document.getElementById("dev_addr").innerHTML = xmlhttp.responseText;
			 alert("上傳成功");
		  }
		}
		//xmlhttp.open("GET","sql_dump3.php?q="+str,true);
		//xmlhttp.send();
		xmlhttp.open("POST","sql_dump3.php",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send("addr="+document.getElementById("addr").value);
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
