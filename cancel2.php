<?php
	$socket = socket_create(AF_UNIX, SOCK_STREAM,0);
	echo "Socket created \n";
	if(!socket_connect($socket,'sch'))
	{
		    $errorcode = socket_last_error();
		    $errormsg = socket_strerror($errorcode);
	
		    die("Could not connect: [$errorcode] $errormsg \n");
	}	    
	echo "Connection established \n";
	 
	 $message = "csts0090";
	 $length = strlen($message);
	  
	  //Send the message to the server
/*	  if( ! socket_send ( $socket , $message , strlen($message), 0))
	  {
	      $errorcode = socket_last_error();
	      $errormsg = socket_strerror($errorcode);
		       
	      die("Could not send data: [$errorcode] $errormsg \n");
	  }*/
	socket_write($socket, $message,$length);
			    
	echo "Message send successfully \n";
	socket_close($socket);
?>
