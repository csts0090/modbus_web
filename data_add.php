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
                  <div><a title= "程式化" href="pro.html">排程設定</a></div>
                  <div><a title= "手動" href="res.php">排程列示</a></div>
                </div>
          </li>
          <li>
            <a title="資料發佈" class="btn1" href="datapull.php">資料發佈</a>
                <div class="headBtn-items">
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
	<?php
	  $ip = $_POST['ip'];
	  $station_no = $_POST['station_no'];
	  $name = $_POST['name'];

	  //$dbc = mysqli_connect('127.0.0.1', 'root', 'gh37143715', 'SystemControl') or die('Error connecting to MySQL server');
	  require("mysql.php");
	  $sql= mysql_db_query ("$dbname", "INSERT INTO Device (ip,station_no,name)"."VALUES('$ip','$station_no','$name')")or die('Error querying database.');

	  $sql= mysql_db_query ("$dbname", "select * from Device");
	  $tit=""; //將陣列變數設成空字串 
	  /* 取出欄位名稱，並串成陣列 */
	  while ($row=mysql_fetch_field($sql)) {
	  	$tit.=$row->name.",";
	  }
	  /* 分解欄位名稱陣列 */
	  $titName=explode(",", $tit);   
	  echo "<form>"."<table>"."<tr>";
	  for ($i=0; $i<4; $i++){
	  	echo "<td width='150'>".$titName[$i]."</td>";
	  }
	  
	  echo "</tr>"."</table>";
	  echo "<table>"."<tr>";
	  //echo "<br/>";
	  /* 列出所有資料錄，並將資料錄內容轉成變數 */
	  while ($rowDb=mysql_fetch_row($sql)) {
	  	for ($i=0; $i<count($rowDb); $i++)
		{
		/* 將列的出欄位數值陣列，轉成變數 */
		$titName2[$i]=$rowDb[$i];
		echo "<td width='150'>".$titName2[$i]."<input id='btn' type=\"hidden\" name=\"sch[]\" value='$titName2[$i]'/></td>";
		}
		echo "</tr>";
		}
		echo "</table>";
		echo "</form>";



/*	while($row = mysqli_fetch_array($result3))
	  {
	    //echo $row['ip'].'<br/>'.$row['station_no'].'<br/>'.$row['name'].'<br/>';
	  }*/
	  mysqli_close($dbc);
  
	?>

  </body>
</html>
