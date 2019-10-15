<?php
    session_start();
	ob_start();
	require_once 'db.php';
	date_default_timezone_set('Asia/Tel_Aviv');
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) 
	{
		?>
		<div id="form1">
		<h6 style="font-family: 'Varela Round', sans-serif; text-align: center;" class="titles"> <?php echo $_SESSION['username'].", Welcome to the management area"; ?> </h6>
		</div>
		<?php
    ;
	?>
	<!DOCTYPE html>
		<html>

		<head>
		<meta charset="utf-8">
		<html dir="rtl">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="manifest" href="/manifest2.json">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
		<script src="/AvisApp_files/AvisAppAdminScripts.js" defer></script>
		

	</head>

	<body>

	<body>
				<nav>
					<div class="nav-wrapper">
							
							<a href="#" class="btn cyan lighten-1 z-depth-4" id="btnGas">ניהול דלק</a>
							<a href="#" class="btn red accent-2 z-depth-4" id="btnFood">ניהול אוכל</a>
							<a href="#" class="btn red accent-2 z-depth-4" id="btnDamage">ניהול נזק</a>
					</div>
			  </nav>
			  
		<div class="container" id="gasBox" style="display: none;" >  <!--Gas box management form-->
			
				
					<h3 style= "font-family: 'Varela Round', sans-serif;" class="titles"> <?php echo "הכנס נתונים"?> <i class="large material-icons left">ev_station</i></h3>
					<form action= "<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
						
						<input type="email" name="email" id="maillerValue" style="width: 200px;" placeholder="אימייל לשליחת הדוח (לא חובה)" class="inputFields" autofocus /></br>
						<input type = "number" name="searchCar" style="width: 200px;" min="1000000" max="99999999" placeholder="מספר רכב לחיפוש" class="inputFields" /></br>
						<input type = "number" name="searchEmployee" style="width: 200px;" min="0" max="99999" placeholder="מספר עובד לחיפוש" class="inputFields"/></br>
						<input type = "date" name="searchDate" style="width: 200px;" placeholder="תאריך לחיפוש" class="inputFields"/></br>

						<button class="waves-effect waves-light btn-large red z-depth-3" type="submit" name="btnGas"> בצע חיפוש <i class="material-icons right">send </i> </button>
						<button type="reset" value="נקה טופס" class="waves-effect waves-light btn-large z-depth-3">נקה טופס<i class="material-icons right">clear_all</i></button>
					</form>
		</div>
		
		<div class="container" id="foodBox" style="display: none;"> <!--Food box management form-->
			
					<h3 style="font-family: 'Varela Round', sans-serif;" class="titles"><?php echo "הכנס נתונים לחיפוש"?><i class="large material-icons left">restaurant_menu</i></h3>
					<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
						
						

						<input type="email" name="email" id="maillerValue" style="width: 200px;" placeholder="אימייל לשליחת הדוח (לא חובה)" class="inputFields" autofocus /></br>
						<input type="text" name="startDate" placeholder="תאריך התחלה" class="datepicker" style="width: 200px;" onfocus="(this.type='date')" onblur="if(this.value==''){this.type='text'}"></br>
						<input type="text" name="endDate" placeholder="תאריך סיום" class="datepicker" style="width: 200px;" onfocus="(this.type='date')" onblur="if(this.value==''){this.type='text'}"></br>
						<input type="number" name="searchEmployee" style="width: 200px;" min="0" max="99999" maxlength="5" placeholder="מספר עובד לחיפוש"
						 class="inputFields" id="inputEmpNum"/></br>
						
						
						<br>
									
				
						<button class="waves-effect waves-light btn-large red z-depth-3" type="submit" name="btnSubmit">בצע חיפוש<i class="material-icons right">send</i> </button>
						<button type="reset" value="נקה טופס" class="waves-effect waves-light btn-large z-depth-3">נקה טופס<i class="material-icons right">clear_all</i></button>

					</form>
		</div>
		
		<div class="container" id="damageBox" style="display: none;"> <!--Damage box management form-->
			
					<h3 style="font-family: 'Varela Round', sans-serif;" class="titles"><?php echo "הוסף פרטים להוספת עובד או בחר עובד למחיקה"?><i class="large material-icons left">restaurant_menu</i></h3>
					<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
						
						

						<input type="email" name="email" id="email" style="width: 200px;" placeholder="כתובת אימייל" class="inputFields" autofocus  /></br>
						<input type="text" name="name" style="width: 200px;" placeholder="שם העובד" class="inputFields"  /></br>
						
				<select class="browser-default" name="checkbox" id="checkbox" style="width: 300px; margin:25px 0px 50px 0px; background:#F2F2F2;color:#9e9e9e;font-size:20px;"  >
					<option value="" disabled selected >בחר נמען מבוקש</option>
					<?php  
						$result = $conn->query("SELECT name FROM Agents"); 
					while($row = $result->fetch_assoc()){  
					?>  
						<option value="<?php echo "".$row["name"]; ?>">  <?php echo "".$row["name"];?>  </option>  
					  
					<?php  
					}  
					?>
				

				</select>
				</br>

						
						
						<br>
									
				
						<button class="waves-effect waves-light btn-large red z-depth-3" type="submit" name="btnDamage">שלח<i class="material-icons right">send</i> </button>
						<button type="reset" value="נקה טופס" class="waves-effect waves-light btn-large z-depth-3">נקה טופס<i class="material-icons right">clear_all</i></button>

					</form>
		</div>

	</body>

	</html>


	<?php	
	} 
	else //if not loggedin will show error
	{
	?>
	<h1 style= "color: red;"> <?php echo "Please log in first to see this page."; ?> </h1>
    <?php
	header('Refresh: 2; URL = AvisApp.php');
	exit();
	}


	if(!empty($_POST))
	{		
			
			if (isset($_POST['btnGas'])) // >>>>>>>>if user choose Gas box<<<<<<<<<
			{
				if(!empty($_POST["searchCar"]) && !empty($_POST["searchDate"])) //user search for car and date
				{
					$searchCar = (int)$_POST["searchCar"];
					$searchDate = $_POST["searchDate"];
					$sql = "SELECT CarNum, Employee, CarKm, GasAmount, Date, RefuelTime FROM Gas where carNum = '$searchCar' && Date = '$searchDate' ";
					$result = $conn->query($sql);	
					$headers = headersBuilder();
					// Email Variables
					$toUser  = $_POST["email"]; // recipient
					$subject = "דוח תדלוקים"; // subject
					
					$body = gasBodyBuilder($result);

					if (!empty($_POST["email"]) && mail($toUser,$subject,$body,$headers)) 
					{
						$message = "אימייל נשלח לכתובת שציינת";
						echo "<script type='text/javascript'>alert('$message');</script>";
					} 
					else 
					{
                         $my_file = 'result.html';
                         file_put_contents($my_file, $body); 
						//echo "<a download='result.html' href='result.html'><b class='download'>Download</b></a>";
                        echo "<script type='text/javascript'>window.open('result.html');</script>";
						$message = "אימייל לא נשלח ומוצג פה בלבד";
						echo "<script type='text/javascript'>alert('$message');</script>";
					}
				}
				
				else if(!empty($_POST["searchCar"])) //user search only for a car
				{
					$searchCar = (int)$_POST["searchCar"];
					$sql = "SELECT CarNum, Employee, CarKm, GasAmount, Date, RefuelTime FROM Gas where carNum = '$searchCar' ";
					$result = $conn->query($sql);	
					$headers = headersBuilder();
					// Email Variables
					$toUser  = $_POST["email"]; // recipient
					$subject = "דוח תדלוקים"; // subject
					
					$body = gasBodyBuilder($result);

					if (!empty($_POST["email"]) && mail($toUser,$subject,$body,$headers)) 
					{
						$message = "אימייל נשלח לכתובת שציינת";
						echo "<script type='text/javascript'>alert('$message');</script>";
					} 
					else 
					{
                         $my_file = 'result.html';
                         file_put_contents($my_file, $body); 
						//echo "<a download='result.html' href='result.html'><b class='download'>Download</b></a>";
                        echo "<script type='text/javascript'>window.open('result.html');</script>";
						$message = "אימייל לא נשלח ומוצג פה בלבד";
						echo "<script type='text/javascript'>alert('$message');</script>";
					}

				}
				
				
				else if(!empty($_POST["searchDate"])) //user search for date
				{
					$searchDate = $_POST["searchDate"];
					$sql = "SELECT CarNum, Employee, CarKm, GasAmount, Date, RefuelTime FROM Gas where Date = '$searchDate' ";
					$result = $conn->query($sql);	
					$headers = headersBuilder();
					// Email Variables
					$toUser  = $_POST["email"]; // recipient
					$subject = "דוח תדלוקים"; // subject
					
					$body = gasBodyBuilder($result);

					if (!empty($_POST["email"]) && mail($toUser,$subject,$body,$headers)) 
					{
						$message = "אימייל נשלח לכתובת שציינת";
						echo "<script type='text/javascript'>alert('$message');</script>";
					} 
					else 
					{
                         $my_file = 'result.html';
                         file_put_contents($my_file, $body); 
						//echo "<a download='result.html' href='result.html'><b class='download'>Download</b></a>";
                        echo "<script type='text/javascript'>window.open('result.html');</script>";
						$message = "אימייל לא נשלח ומוצג פה בלבד";
						echo "<script type='text/javascript'>alert('$message');</script>";
					}
				}
				
				
				else if(!empty($_POST["searchEmployee"])) //user search for employee number
				{
					$searchEmployee = (int)$_POST["searchEmployee"];
					$sql = "SELECT CarNum, Employee, CarKm, GasAmount, Date, RefuelTime FROM Gas where Employee = '$searchEmployee' ";
					$result = $conn->query($sql);	
					$headers = headersBuilder();
					// Email Variables
					$toUser  = $_POST["email"]; // recipient
					$subject = "דוח תדלוקים"; // subject
					
					$body = gasBodyBuilder($result);

					if (!empty($_POST["email"]) && mail($toUser,$subject,$body,$headers)) 
					{
						$message = "אימייל נשלח לכתובת שציינת";
						echo "<script type='text/javascript'>alert('$message');</script>";
					} 
					else 
					{
                         $my_file = 'result.html';
                         file_put_contents($my_file, $body); 
						//echo "<a download='result.html' href='result.html'><b class='download'>Download</b></a>";
                        echo "<script type='text/javascript'>window.open('result.html');</script>";
						$message = "אימייל לא נשלח ומוצג פה בלבד";
						echo "<script type='text/javascript'>alert('$message');</script>";
					}
				}
				
				
				else if(empty($_POST["searchCar"]) && empty($_POST["searchDate"]) && empty($_POST["Employee"]) ) //if all empty it show all the records
				{
					$sql = "SELECT CarNum, Employee, CarKm, GasAmount, Date, RefuelTime FROM Gas";
					$result = $conn->query($sql);	
					$headers = headersBuilder();
					// Email Variables
					$toUser  = $_POST["email"]; // recipient
					$subject = "דוח תדלוקים"; // subject
					
					$body = gasBodyBuilder($result);

					if (!empty($_POST["email"]) && mail($toUser,$subject,$body,$headers)) 
					{
						$message = "אימייל נשלח לכתובת שציינת";
						echo "<script type='text/javascript'>alert('$message');</script>";
					} 
					else 
					{
                         $my_file = 'result.html';
                         file_put_contents($my_file, $body); 
						//echo "<a download='result.html' href='result.html'><b class='download'>Download</b></a>";
                        echo "<script type='text/javascript'>window.open('result.html');</script>";
						$message = "אימייל לא נשלח ומוצג פה בלבד";
						echo "<script type='text/javascript'>alert('$message');</script>";
					}
				}
				echo "<meta http-equiv='refresh' content='0'>";
				exit();
			}
			
			
			else if (isset($_POST['btnSubmit']))// >>>>>>>>if user choose Food box<<<<<<<<<
			{
				if(!empty($_POST["startDate"]) && !empty($_POST["endDate"]) && !empty($_POST["searchEmployee"]))
				{
					$startDate = $_POST["startDate"];
					$endDate = $_POST["endDate"];
					$searchEmployee = $_POST["searchEmployee"];
					$sql = "SELECT mainDish, sideDish, vegetables, employee, name, date, time FROM Food where employee='$searchEmployee' And date between '$startDate' AND '$endDate' ";
					$result = $conn->query($sql);	
					$headers = headersBuilder();
					// Email Variables
					$toUser  = $_POST["email"]; // recipient
					$subject = "הזמנת אוכל"; // subject
					$body = foodBodyBuilder($result);
								
				
				
					if (!empty($_POST["email"]) && mail($toUser,$subject,$body,$headers)) 
					{
						$message = "אימייל נשלח לכתובת שציינת";
						echo "<script type='text/javascript'>alert('$message');</script>";
					} 
					else 
					{
                         $my_file = 'result.html';
                         file_put_contents($my_file, $body); 
						//echo "<a download='result.html' href='result.html'><b class='download'>Download</b></a>";
                        echo "<script type='text/javascript'>window.open('result.html');</script>";
						$message = "אימייל לא נשלח ומוצג פה בלבד";
						echo "<script type='text/javascript'>alert('$message');</script>";
					}

				} 
			
				else if(!empty($_POST["searchEmployee"]))
				{
					$searchEmployee = (int)$_POST["searchEmployee"];
					$sql = "SELECT mainDish, sideDish, vegetables, employee, name, date, time FROM Food where Employee = '$searchEmployee' ";
					$result = $conn->query($sql);	
					$headers = headersBuilder();
					// Email Variables
					$toUser  = $_POST["email"]; // recipient
					$subject = "הזמנת אוכל"; // subject
					
					$body = foodBodyBuilder($result);

					if (!empty($_POST["email"]) && mail($toUser,$subject,$body,$headers)) 
					{
						$message = "אימייל נשלח לכתובת שציינת";
						echo "<script type='text/javascript'>alert('$message');</script>";
					} 
					else 
					{
                         $my_file = 'result.html';
                         file_put_contents($my_file, $body); 
						//echo "<a download='result.html' href='result.html'><b class='download'>Download</b></a>";
                        echo "<script type='text/javascript'>window.open('result.html');</script>";
						$message = "אימייל לא נשלח ומוצג פה בלבד";
						echo "<script type='text/javascript'>alert('$message');</script>";
					}
						
				}
				else if(!empty($_POST["startDate"]) && !empty($_POST["endDate"]) )
				{
					$startDate = $_POST["startDate"];
					$endDate = $_POST["endDate"];
					$sql = "SELECT mainDish, sideDish, vegetables, employee, name, date, time FROM Food where date between '$startDate' AND '$endDate' order by employee ";
					$result = $conn->query($sql);	
						
					$headers = headersBuilder();
					// Email Variables
					$toUser  = $_POST["email"]; // recipient
					$subject = "הזמנת אוכל"; // subject
					
					$body = foodBodyBuilder($result);

					if (!empty($_POST["email"]) && mail($toUser,$subject,$body,$headers)) 
					{
						$message = "אימייל נשלח לכתובת שציינת";
						echo "<script type='text/javascript'>alert('$message');</script>";
					} 
					else 
					{
						
                         $my_file = 'result.html';
                         file_put_contents($my_file, $body); 
						//echo "<a download='result.html' href='result.html'><b class='download'>Download</b></a>";
                        echo "<script type='text/javascript'>window.open('result.html');</script>";
						$message = "אימייל לא נשלח ומוצג פה בלבד";
						echo "<script type='text/javascript'>alert('$message');</script>";
					}
				} 
				echo "<meta http-equiv='refresh' content='0'>";
				exit();
				
			}
			else if (isset($_POST['btnDamage']))// >>>>>>>>if user choose Damage box<<<<<<<<<
			{
				if(!empty($_POST["email"]) && !empty($_POST["name"]) )
				{
					$name = $_POST["name"];
					$email = $_POST["email"];
					
					$sql = "INSERT INTO `Agents`(`name`, `email`) VALUES ('$name','$email')";
					$result = $conn->query($sql);
						if(mysqli_affected_rows($conn) > 0)
						{
							$message = "המשתמש התווסף בהצלחה";
							echo "<script type='text/javascript'>alert('$message');</script>";
						 }
						 else
						{
							$message = "קרתה תקלה, אנא נסה שוב";
							echo "<script type='text/javascript'>alert('$message');</script>";
						}
				
				}
				else if(!empty($_POST["checkbox"]) && empty($_POST["name"]) )
				{
					$selected = $_POST["checkbox"];
					
					
					$sql = "DELETE FROM Agents WHERE name='$selected'";
				
					$result = $conn->query($sql);
						if(mysqli_affected_rows($conn) > 0)
						{
							$message = "משתמש נמחק בהצלחה";
							echo "<script type='text/javascript'>alert('$message');</script>";
						 }
						 else
						{
							$message = "קרתה תקלה, אנא נסה שוב";
							echo "<script type='text/javascript'>alert('$message');</script>";
						}
						
				}
				echo "<meta http-equiv='refresh' content='0'>";
				exit();
				
			}
		} 

				
	
	function headersBuilder()
	{
		$headers =  'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=UTF-8'."\r\n";
		$headers .= "Content-Disposition:attachment;filename=attachment.html" . "\r\n";
		$headers .= 'From: System Admin <Sysadmin@avis.co.il>' . "\r\n";
		
		return $headers;
	}	

	function foodBodyBuilder($result)
	{
		$count = 0;

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
					table, th, td {
						border: 1px solid black;
					}
					</style>
					</head>
					<body>
					<input type='button' style='width: 100px display: inline-block' value='לחץ להדפסה!' onClick='box.print()'>
					<table style='width:100%'>
					<tr><th>מנה עיקרית</th><th>תוספת</th><th>ירק</th><th>מספר עובד</th><th>שם העובד</th><th>תאריך</th></tr>"; // content
		
		if ($result->num_rows > 0)  
		{
			// output data of each row
			while($row = $result->fetch_assoc()) 
			{
			
				$body .="<tr><td>" . $row["mainDish"]. "</td><td>" . $row["sideDish"]."</td><td>".$row["vegetables"]."</td><td>".$row["employee"]."</td><td>".$row["name"]."</td><td>".$row["date"]." </td></tr>";
				$count++;
				
			}
			$body.="</table>";
			$body.=	"סך הכל ".$count."ארוחות";
			$body.=	"</body>
					</html>";
			
			return $body;
		}
		else 
		{
			$message = "אין רשומות לפרמטרים שהקשת";
			echo "<script type='text/javascript'>alert('$message');</script>";
		}

	}
	function gasBodyBuilder($result)
	{
		$count = 0;

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
					table, th, td {
						border: 1px solid black;
					}
					</style>
					</head>
					<body>
					<input type='button' style='width: 100px display: inline-block' value='לחץ להדפסה!' onClick='window.print()'>
					<table style='width:100%'>
					<tr><th>מספר רכב</th><th>עובד</th><th>קמ ברכב</th><th>כמות ליטרים</th><th>תאריך תדלוק</th><th>שעת דתלוק</th></tr>"; // content
		
		if ($result->num_rows > 0)  
		{
			// output data of each row
			while($row = $result->fetch_assoc()) 
			{
				$body .="<tr><td>" . $row["CarNum"]. "</td><td>" . $row["Employee"]."</td><td>".$row["CarKm"]."</td><td>".$row["GasAmount"]."</td><td>".$row["Date"]."</td><td>".$row["RefuelTime"]." </td></tr>";
				$count++;
			}
			$body.="</table>";
			$body.=	"סך הכל ".$count."רשומות";
			$body.=	"</body>
					</html>";
			
			return $body;
		}
		else 
		{
			$message = "אין רשומות לפרמטרים שהקשת";
			echo "<script type='text/javascript'>alert('$message');</script>";
		}

	}
	

	?>