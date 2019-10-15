<?php

require_once 'db.php';
date_default_timezone_set('Asia/Tel_Aviv');

	

	$time = date('H:i:s');
	
	if($time >= "09:15:00" && $time <= "14:30:00")
	{
		$date = date('Y-m-d');
		$sql = "SELECT mainDish, sideDish, vegetables, employee, name, date, time FROM Food where date='$date' ";
		
		$result = $conn->query($sql);	

		$headers =  'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=UTF-8'."\r\n";
		$headers .= "Content-Disposition:attachment;filename=Food.html" . "\r\n";
		$headers .= 'From: System Admin <Sysadmin@avis.co.il>' . "\r\n";
		
		

		// Email Variables
		$toUser  = "amitg@avis.co.il"; // recipient
		$subject = "הזמנת אוכל"; // subject
		$body    = "
					<html>
					<head>
					<meta charset='utf-8'>
					<html dir='rtl'>
					<title>HTML email</title>
					 <html lang='HE'>
					<style>
					body {
						
					}
						
					.box{
						font-family: 'Secular One', sans-serif;
						font-weight: bold;
						border: 1px solid #aaa; /*getting border*/
						border-radius: 4px; /*rounded border*/
						color: #000; /*text color*/
						width: 1000px;
						height: 700px;
						display: block;
						margin-left: auto;
						margin-right: auto;
						}
					</style>
					</head>
					<body>
					<input type='button' style='width: 100px display: inline-block' value='לחץ להדפסה!' onClick='window.print()'>
					<textarea class='box' readonly>"; // content
		
		if ($result->num_rows > 0)  
		{
			// output data of each row
			while($row = $result->fetch_assoc()) 
			{
			
				$body .="עיקרית: " . $row["mainDish"]. ",  תוספת: " . $row["sideDish"].",  ירק:".$row["vegetables"].",  מספר עובד:".$row["employee"].",  שם העובד: ".$row["name"].",  תאריך: ".$row["date"]."\r\n\r\n";
				
			}
			$body.="
					</textarea
					</body>
					</html>";
					
					echo $body;
		} 
		else 
		{
			echo "0 results found";
		}
		
		
		if (mail($toUser,$subject,$body,$headers)) {
			echo "sent";
		} else {
			echo "failed";
		}
	}
	else
	{
		echo "not 09:30 yet";
	}
		
?>