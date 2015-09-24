<?php
	
	
	//檔案上傳
	//$filename=$_FILES['file']['name'];
	//$tmpname=$_FILES['file']['tmp_name'];
	//$filetype=$_FILES['file']['type'];
	//$filesize=$_FILES['file']['size'];	
	
	
	$mail = new PHPMailer(); 
				
	mb_internal_encoding('UTF-8');
	    					
	$mail->SetFrom($_POST['email'],$_POST['name']);								
	
	//你要寄送到的信箱
	$mail->AddAddress("isu10203015M@cloud.isu.edu.tw", "isu10203015M");

	$mail->Subject =  mb_encode_mimeheader("測試", "UTF-8");
	$mail->CharSet="UTF-8";				
	
	$body=nl2br($_POST['contents']);
			 			
	
				
	
?>
