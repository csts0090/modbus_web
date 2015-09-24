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
		 <h2>排程備份</h2>
	<hr />

	 備份時間:
	 <select id="time_month" name='time_month'>
	 	<option></option>
	 </select>月
	 <select id="time_day" name='time_day'>
	 	<option></option>
	 </select>日
	 <select id="time_hours" name='time_hours'>
	 	<option></option>
	 </select>時
	 <select id="time_min" name='time_min'>
	 	<option></option>
	 </select>分鐘

    	 <br>
	 備份地點:<select name='device_no' id="dev_no" onchange="showaddr(this.value)">
		  <option value='0'>請選擇</option>
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


<script >
document.getElementById('time_month').options[0] = new Option('請選擇');
for(var i=1;i<13;i++){
	document.getElementById('time_month').options[i] = new Option(i);
}
document.getElementById('time_month').options[13] = new Option('每月');


document.getElementById('time_day').options[0] = new Option('請選擇');
for(var i=1;i<32;i++){
	document.getElementById('time_day').options[i] = new Option(i);
}
document.getElementById('time_day').options[32] = new Option('每日');

document.getElementById('time_hours').options[0] = new Option('請選擇');
for(var i=1;i<25;i++){
	document.getElementById('time_hours').options[i] = new Option(i-1);
}
document.getElementById('time_hours').options[25] = new Option('每小時');

document.getElementById('time_min').options[0] = new Option('請選擇');
for(var i=1;i<61;i++){
	document.getElementById('time_min').options[i] = new Option(i-1);
}
document.getElementById('time_min').options[61] = new Option('每分鐘');


function showaddr(str){
	if(str === '1'){
	 //document.getElementById("dev_addr").innerHTML = "";
	 //return;
			document.getElementById("ip_addr").innerHTML = "<input type='button' value='備份' onclick='localload()'>";
	 }
	 else if(str === '2'){
				document.getElementById("ip_addr").innerHTML = "<input id='addr' type='text' name='addr'/><input type='button' value='提交' onclick='upload()'>";
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
		//xmlhttp.open("GET","crontab_local.php?q="+str,true);
		//xmlhttp.send();
		xmlhttp.open("POST","crontab_local.php",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		if(document.getElementById('time_month').value === '每月') M='*';else M=document.getElementById('time_month').value;
		if(document.getElementById('time_day').value === '每日') D='*';else D=document.getElementById('time_day').value;
		if(document.getElementById('time_hours').value === '每小時') H='*';else H=document.getElementById('time_hours').value;
		if(document.getElementById('time_min').value === '每分鐘') m='*';else m=document.getElementById('time_min').value;
		xmlhttp.send("M="+M+"&D="+D+"&H="+H+"&m="+m);
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
