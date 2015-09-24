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

<?php
	header("Content-Type:text/html; charset=utf-8");

	require("mysql.php");

	$sql= mysql_db_query ("$dbname", "select * from Schedule");
	$tit=""; //將陣列變數設成空字串
	/* 取出欄位名稱，並串成陣列 */
	while ($row=mysql_fetch_field($sql)) {
	$tit.=$row->name.",";
	}
	/* 分解欄位名稱陣列 */
	$titName=explode(",", $tit);

//	echo "<form method=\"POST\" action=\"res2.php\">"."<table>"."<tr>";
	echo "<form>"."<table>"."<tr>";
	for ($i=0; $i<4; $i++){
		echo "<td width='150'>".$titName[$i]."</td>";
	}
		echo "<td width='150'>"."upload"."</td>";
		echo "<td width='150'>"."mail"."</td>";
		echo "<td width='150'>"."自行下載"."</td>";
		echo "<td width='150'>"."ftp上傳"."</td>";

	echo "</tr>";
	//echo "<br/>";
	/* 列出所有資料錄，並將資料錄內容轉成變數 */
	$j = 0;
	while ($rowDb=mysql_fetch_row($sql)) {
	echo "<tr>";
	    for ($i=0; $i<count($rowDb); $i++)
	    {
		/* 將列的出欄位數值陣列，轉成變數 */
			$titName2[$i]=$rowDb[$i];
		echo "<td width='150'>".$titName2[$i]."<input class='btn' type=\"hidden\" name=\"sch\" value='$titName2[0]'/></td>";
		//echo "<td width='150'>".$titName2[$i]."<input class='btn' type=\"hidden\" name=\"sch[]\" value='$titName2[$i]'/></td>";
	    }
		echo "<td width='150'><input class='mail$j' type='hidden' value='$titName2[0]'/><input class='upload$j' type='text'><input type='submit' value='上傳' onclick='post2($j)'></td>";
		echo "<td width='150'><input class='mail$j' type='hidden' value='$titName2[0]'/><input class='mail-2$j' type='text'  value='信箱地址'><input type='submit' value='發送' onclick='post($j)'></td>";
		echo "<td width='150'><input class='mail$j' type='hidden' value='$titName2[0]'/><input type='button' value='下載' onclick='post3($j)'></td>";
		echo "<td width='150'><input class='mail$j' type='hidden' value='$titName2[0]'/>主機<input class='ftp$j' type='test'  >使用者名稱:<input class='user$j' type='test'>密碼:<input class='passwd$j' type='password'><input type='button' value='上傳' onclick='post4($j)'></td>";
	    $j=$j+1;
	    echo "</tr>";
	}
	echo "</table>";
	echo "</form>";
?>
<script src="css-js/jquery-1.11.0.min.js"></script>
<script type="text/javascript">
function post(id)
{
	var statu_s = $('.mail'+id).val();
	var email = $('.mail-2'+id).val();
	//var statu_s=<?php echo $titName2[0] ?>;//php傳值給javascript
	//console.log(statu_s);
	alert('信件寄出中');

	$.post('res2.php',{sta:statu_s, email_name:email},
	function(data,status)
	{
		//alert("Data: " + data + "\nStatus: " + status);
		if(status=='success');
		alert(statu_s+"\nStatus"+status);
	});
}
function post2(id)
{
	var statu_s = $('.mail'+id).val();
	var upload = $('.upload'+id).val();

	$.post('upload.php',{sta:statu_s, up:upload},
	function(data,status)
	{
		document.write("<meta http-equiv='refresh' content='1; url=http://140.127.196.105:3987/demo/download3.php'>");
		if(status=='success');
		//alert(statu_s+"\nStatus"+status);
	});
}
function post3(id)
{
	var statu_s = $('.mail'+id).val();
	if(window.XMLHttpRequest){
	  // code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp2 = new XMLHttpRequest();
	  } else {
	  // code for IE6, IE5
	  xmlhttp2 = new ActiveXObject("Microsoft.XMLHTTP");
	  }
	  xmlhttp2.onreadystatechange = function() {
	  	if (xmlhttp2.readyState == 4 && xmlhttp2.status == 200) {
	  		//document.getElementById("").innerHTML = xmlhttp2.responseText;
			window.location.replace('http://140.127.196.105:3987/demo/download3.php');
	  	}
	  }
	  xmlhttp2.open("POST","download_local.php",true);
	  xmlhttp2.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	  xmlhttp2.send("sta="+statu_s);

}
function post4(id)
{
	var statu_s = $('.mail'+id).val();
	var upload = $('.ftp'+id).val();
	var user = $('.user'+id).val();
	var passwd = $('.passwd'+id).val();
	if(window.XMLHttpRequest){
	  // code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp2 = new XMLHttpRequest();
	  } else {
	  // code for IE6, IE5
	  xmlhttp2 = new ActiveXObject("Microsoft.XMLHTTP");
	  }
	  xmlhttp2.onreadystatechange = function() {
	  	if (xmlhttp2.readyState == 4 && xmlhttp2.status == 200) {
	  		//document.getElementById("").innerHTML = xmlhttp2.responseText;
			alert("上傳成功");
	  	}
	  }
	  xmlhttp2.open("POST","ftp.php",true);
	  xmlhttp2.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	  xmlhttp2.send("sta="+statu_s+"&up="+upload+"&user="+user+"&passwd="+passwd);

}
</script>
   </body>
   </html>
