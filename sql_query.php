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
	<h2>資料庫操作</h2>
	<hr />
		請選擇資料庫<select name=database id="database">
			<option></option>
		    </select><br>
	請輸入SQL指令:<input id="command" type="text" >
	<input type="button" value="查詢" onclick="query()">

	<hr />
	<textarea id="content"></textarea>

<?php
	require("mysql.php");
	$sql = mysql_db_query("$dbname","show databases");
	if(!$sql)
	{
      	  echo "Execute SQL failed:".mysql_error();
        }

	$database = [];
	$i=1;
	//while($rowDb=mysql_fetch_array($sql)){
	      //$dev_no[$i] = $rowDb["station_no"];//The index can use number or string;
	while($rowDb=mysql_fetch_row($sql)){ //The index only uses a number;
		$database[$i] = $rowDb[0];
	        $i++;
	}

	//echo count($dev_no);
	echo "<script type='text/javascript'>";
	echo "document.getElementById('database').options[0] = new Option('請選擇');";
	echo "</script>";
	for($i=1; $i<=count($database);$i++)
	{
		echo "<script type='text/javascript'>";
		echo "document.getElementById('database').options[$i] = new Option('$database[$i]');";
		echo "</script>";
	}
	mysql_close($dbc);


?>
</body>
<script >



function query(){
	        if (window.XMLHttpRequest) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
	        	xmlhttp = new XMLHttpRequest();
		} else {
		     // code for IE6, IE5
	            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		  xmlhttp.onreadystatechange = function() {
		  if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	                document.getElementById("content").innerHTML = xmlhttp.responseText;
		  }
		}
		//xmlhttp.open("GET","sql_query2.php?command="+document.getElementById("command").value,true);
		//xmlhttp.send();
		xmlhttp.open("POST","sql_query2.php",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send("command="+document.getElementById("command").value+"&database="+document.getElementById("database").value);
}
</script>
</html>
