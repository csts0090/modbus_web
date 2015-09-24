<?php
if ($handle = opendir('.')) {  //開啟現在的資料夾
      while (false !== ($file = readdir($handle))) {
      //避免搜尋到的資料夾名稱是false,像是0
                if ($file != "." && $file != "..") {
		//去除掉..跟.
		              echo "$file";              
			                }
					      }
					            closedir($handle);
						      }
?>
