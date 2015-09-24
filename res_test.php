<?php
		
	$num1 = count($_POST["sch1"]);
	$dbc = mysqli_connect('localhost', 'root', 'gh37143715', 'SystemControl') or die('Error connecting to MySQL server');
	$query3 = "SELECT * FROM Schedule_data where schedule_id=127";
	$result3 = mysqli_query($dbc, $query3);

		while($row = mysqli_fetch_array($result3)){

			 echo $row['schedule_id'].'<br/>'.$row['station_no'].'<br/>'.$row['address'].'<br/>'.$row['data'].'<br/>'.$row['time'];
		}
		  	mysqli_close($dbc);
?>


