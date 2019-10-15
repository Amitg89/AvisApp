<?php
    session_start();
	ob_start();
	require_once 'db.php';
	date_default_timezone_set('Asia/Tel_Aviv');
    
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<html dir="rtl">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="manifest" href="/AvisApp_files/AvisAppManifest.json">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
	<script src="/AvisApp_files/AvisAppScripts.js" defer></script>
	
<script>
        if ('serviceWorker' in navigator) {
        console.log('service workers supported')
        this.navigator.serviceWorker.register('./AvisAppSw.js')
            .then(reg => { console.log('Service Worker: Registered') })
            .catch(err => {
                console.log(`Service Worker Registration Error: ${err}`);
            })
    }
</script>



</head>

<body style="background:#f0f1f2;">
		<nav>
			<div class="nav-wrapper red darken-3">
					
					<a href="#" class="btn red darken-1 z-depth-4" id="btnGas" style="width: 40px;">דלק</a>
					<a href="#" class="btn red darken-1 z-depth-4" id="btnDamage" style="width: 40px;">נזק</a>
					<a href="#" class="btn red darken-1 z-depth-4" id="btnOrder" >הזמנת אוכל</a>
					<a href="#" class="btn red darken-1 z-depth-4" id="btnCancel" >ביטול הזמנה</a>
					<a href="#" class="btn red darken-1 z-depth-4" id="btnManage" style="width: 50px;">ניהול</a>
			</div>
		</nav>
		  
		<div class="container" id="gasBox" >
			
				<h3 style= "font-family: 'Varela Round', sans-serif;" class="titles"> <?php echo "הכנס נתונים"?> <i class="large material-icons left">ev_station</i></h3>
				<form action= "<?php echo $_SERVER['PHP_SELF'];?>" method="POST">


					<input type = "number" name="carNum" style="width: 200px;" min="1000000" max="99999999" placeholder="מספר רכב" class="inputFields" autofocus required /></br>
					<input type = "number" name="employee" style="width: 200px;" min="0" max="99999" placeholder="מספר עובד" class="inputFields" required /></br>
					<input type = "number" min="0" name="carKm" style="width: 200px;" placeholder="קמ ברכב" class="inputFields" required /></br>
					<input type = "number" min="0" max="150" step="0.001" name="gasAmount" style="width: 200px;" placeholder="כמות ליטרים שתודלק" class="inputFields" required /></br>

					<button class="waves-effect waves-light btn-large red z-depth-3" type="submit" name="btnGas"> הזן רשומה <i class="material-icons right">send </i> </button>
					<button type="reset" value="נקה טופס" class="blue-grey darken-4 waves-effect waves-light btn-large z-depth-3">נקה טופס<i class="material-icons right">clear_all</i></button>

				</form>
		</div>
		
		<div class="container" id="damageBox" style="display: none;">
				
				<h3 style= "font-family: 'Varela Round', sans-serif;" class="titles"> <?php echo "הכנס נתונים"?> <i class="large material-icons left">directions_car</i></h3>
				<form action= "<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">

					<input type = "number" name="carNum" style="width: 200px;" min="1000000" max="99999999" placeholder="מספר רכב" class="inputFields" autofocus required /></br>
						<div class="file-field input-field"  style="width: 200px; ">
						  
						  <input type="file" name="fileToUpload" id="fileToUpload" style="display: none; !important">
							<button class="waves-effect waves-light btn-large indigo darken-3 z-depth-3" onclick="document.querySelector('#fileToUpload').click();" style="margin: 0 auto;">
								<i class="large material-icons">attach_file</i>
								בחר תמונה
							</button>
						</div>
					<select class="browser-default" name="checkbox" id="checkbox" style="width: 300px; margin:25px 0px 50px 0px; background:#F2F2F2;color:#9e9e9e;font-size:20px;" required >
						<option value="" disabled selected >בחר נמען מבוקש</option>
						<?php  
						$result = $conn->query("SELECT name FROM Agents"); 
						while($row = $result->fetch_assoc()){  
						?>  
							<option value="<?php echo "".$row["name"]; ?>">  <?php echo "".$row["name"];?>  </option>  
						<?php  
						}  
						?>
					</select></br>
					<img id="loading" style="width: 220px; height: 150px; visibility: hidden;" src="AvisApp_files/loadingNew.gif"></br>
					
					<button class="waves-effect waves-light btn-large red z-depth-3" type="submit" name="btnDamage" value="Upload Image" id="upload"> הזן רשומה <i class="material-icons right">send </i> </button>
					<button type="reset" value="נקה טופס" class="blue-grey darken-4 waves-effect waves-light btn-large z-depth-3">נקה טופס<i class="material-icons right">clear_all</i></button>
					
				</form>
		</div>
		
		<div class="container" id="orderBox" style="display: none;">
		
				<h3 style="font-family: 'Varela Round', sans-serif;" class="titles"><?php echo "מה להזמין לך?"?><i class="large material-icons left">restaurant_menu</i></h3>
				<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">


					
					<input type="text" name="main" style="width: 200px;" placeholder="מנה עיקרית" class="inputFields" required /></br>
					<input type="text" name="sideDish" style="width: 200px;" placeholder="תוספת" class="inputFields" required /></br>
					<input type="text" name="vegetables" style="width: 200px;" placeholder="ירק" class="inputFields" /></br>
					<input type="number" name="employee" style="width: 200px;" min="0" max="99999" maxlength="5" placeholder="מספר עובד"
					 class="inputFields" id="inputEmpNum" required/></br>
					<input type="text" name="name" style="width: 200px;" placeholder="שם העובד" class="inputFields" required /></br>
					
					<button class="waves-effect waves-light btn-large red z-depth-3" type="submit" name="btnSubmit">שלח הזמנה<i class="material-icons right">send</i> </button>
					<button type="reset" value="נקה טופס" class="blue-grey darken-4 waves-effect waves-light btn-large z-depth-3">נקה טופס<i class="material-icons right">clear_all</i></button>
				</form>
		</div>

		<div class="container" id="cancelBox" style="display: none;">
			
				<h4 style="font-family: 'Varela Round', sans-serif;" class="titles"><?php echo "לביטול הזמנה הקש מספר עובד ושם"?><i class="large material-icons left">remove_shopping_cart</i></h4>
				<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
			
						<input type="number" name="employee" style="width: 200px;" min="0" max="99999" maxlength="5" placeholder="מספר עובד"
						 class="inputFields" id="inputEmpNum" required autofocus /></br>
						<input type="text" name="name" style="width: 200px;" placeholder="שם העובד" class="inputFields" required /></br>
	
						<button class="waves-effect waves-light btn-large red z-depth-3" type="submit" name="btnDelete">בטל הזמנה<i class="material-icons right">send</i> </button>
						<button type="reset" value="נקה טופס" class="blue-grey darken-4 waves-effect waves-light btn-large z-depth-3">נקה טופס<i class="material-icons right">clear_all</i></button>
				</form>
		</div>

		<div class="container" id="manageBox" style="display: none;">
		
		
				<h3 style= "font-family: 'Varela Round', sans-serif;" class="titles"> <?php echo "התחבר לאזור ניהול";?><i class="large material-icons left">account_box</i></h3>
				<form action= "<?php echo $_SERVER['PHP_SELF'];?>" method="POST">


					<input type = "text" name="userName" style="width: 200px;"  placeholder="שם משתמש" class="inputFields" required autofocus /></br>
					<input type = "password" name="password" style="width: 200px;" placeholder="סיסמה" class="inputFields" required /></br>

					<button class="waves-effect waves-light btn-large red z-depth-3" type="submit" name="btnManage">התחבר<i class="material-icons right">send</i> </button>
					<button type="reset" value="נקה טופס" class="blue-grey darken-4 waves-effect waves-light btn-large z-depth-3">נקה טופס<i class="material-icons right">clear_all</i></button>
							
				</form>
		</div>
	

</body>

</html>
<?php
if(!empty($_POST))
{		

	if ($_SERVER['REQUEST_METHOD'] === 'POST') 
	{

		if (isset($_POST['btnDelete']))
		{
			$session = $_COOKIE["res"];
			$date = date('Y-m-d');
			$name = $_POST["name"];
			$time = date('H:i:s');
			if($time <= '21:00:00')
			{
				$sql = "DELETE FROM Food WHERE session='$session' && date='$date' && name='$name' ";
			
				$result = $conn->query($sql);
			
			
				if(mysqli_affected_rows($conn) > 0)
				{
					$message = "הזמנתך נמחקה בהצלחה";
					echo "<script type='text/javascript'>alert('$message');</script>";
				 }
				 else
				{
					$message = "לא נמצאה הזמנה! נא לצור קשר עם סופרוויזר!";
					echo "<script type='text/javascript'>alert('$message');</script>";
				}
			}
			else
			{
				$message = "לאחר השעה 10:00 לא ניתן למחוק מנות, אנא פנה למנהל.";
				echo "<script type='text/javascript'>alert('$message');</script>";
			}
			
			echo "<meta http-equiv='refresh' content='2'>";
			exit();
			


			
			
		}
		else if (isset($_POST['btnManage']))
		{
			
			if($_POST["userName"] == "amit" && $_POST["password"] == 1495 || $_POST["userName"] == "admin" && $_POST["password"] == 123)
			{
				echo "Login is ok!";
				$_SESSION['loggedin'] = true;
				$_SESSION['username'] = $_POST["userName"];
				header('Refresh: 1; URL = AvisAppAdmin.php');
				exit();
			}
			else
			{
				?>
				<h3 style= "font-family: 'Varela Round', sans-serif;" class="titles"> <?php echo "שם משתמש או סיסמה שגויים, נסה שנית" ?> </h3>
				<?php
				echo "<meta http-equiv='refresh' content='2'>";
				exit();
			}
			

		}
		else if (isset($_POST['btnSubmit']))
		{
			$date = date('Y-m-d');
			$time = date('H:i:s');
			$mainDish = mysqli_real_escape_string($conn, $_POST["main"]);
			$sideDish = mysqli_real_escape_string($conn,$_POST["sideDish"]);
			$vegetables = mysqli_real_escape_string($conn,$_POST["vegetables"]);
			$employee = (int)$_POST["employee"];
			$name =mysqli_real_escape_string($conn, $_POST["name"]);
			$value = md5($employee);
			if(!isset ($_COOKIE["res"]))
			{
				setcookie("res", $value , time() + 18000);
			}
			
			$sql = "INSERT INTO `Food`(`mainDish`, `sideDish`, `vegetables`, `employee`, `name` , `date`,`time`,`session`) VALUES ('$mainDish', '$sideDish', '$vegetables', '$employee' , '$name', '$date', '$time','$value')";
			$result = mysqli_query($conn, $sql);
			
			?>
			<div id="form1">
			<h3 style= "color:red; text-align:center; margin: auto;"> <?php echo "הנתונים שהוזנו הוכנסו כראוי" ?> </h3>
			</div>
			<?php
		
			echo "<meta http-equiv='refresh' content='2'>";
			exit();
			
			

			
		}	
		else if (isset($_POST['btnGas']))
		{
			$date = date('Y-m-d');
			$refuelTime = date('H:i:s');
			$carNum = (int)$_POST["carNum"];
			$employee = (int)$_POST["employee"];
			$carKm = (int)$_POST["carKm"];
			$gasAmount = (double)$_POST["gasAmount"];
			
			$sql = "INSERT INTO `Gas`(`CarNum`, `Employee`, `CarKm`, `GasAmount` , `Date`,`RefuelTime`) VALUES ('$carNum', '$employee', '$carKm', '$gasAmount', '$date', '$refuelTime')";
			$result = mysqli_query($conn, $sql);

			?>
			<div id="form1">
			<h3 style= "color:red; text-align:center; margin: auto;"> <?php echo "הנתונים שהוזנו הוכנסו כראוי" ?> </h3>
			</div>
			<?php
			
		
			echo "<meta http-equiv='refresh' content='2'>";
			exit();
			
			
		}
		else if (isset($_POST['btnDamage']))
		{
			$target_dir = "AvisApp_files/uploads/";
			$newfilename = "damage.jpg";
			$uploadOk = 1;
			
			// Check if image file is a actual image or fake image
			if(isset($_POST["btnDamage"])) 
			{
				$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
				if($check !== false) {
					echo "OK";
					move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir. $newfilename);
					$uploadOk = 1;
				} else {
					echo "לא הועלתה תמונה! נסה שוב";
					$uploadOk = 0;
				}
			}
			$d = compress('AvisApp_files/uploads/damage.jpg', 'AvisApp_files/uploads/damageNew.jpg', 75);
		
			$agent = $_POST["checkbox"];
			
			$result = $conn->query("SELECT email FROM Agents where name = '$agent'"); 
			while($row = $result->fetch_assoc()){ 
				$email = $row["email"];
			}
			$carNum = (int)$_POST["carNum"];
			$filename = 'damageNew.jpg';
			$path = 'AvisApp_files/uploads/';
			$file = $path.$filename;
			$content = file_get_contents( $file);
			$content = chunk_split(base64_encode($content));
			$uid = md5(uniqid(time()));
			$name = basename($file);

			$mailto = 'NatbagStation@avis.co.il';
			$subject = 'נזק חדש '.$carNum;
			

		
			// header
			$header = 'From: System Admin <sysadmin@avis.co.il>' . "\r\n";  
			$header .= "MIME-Version: 1.0\r\n";
			$header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";

			// message & attachment
			$nmessage = "--".$uid."\r\n";
			$nmessage .= "Content-type:text/plain; charset=iso-8859-1\r\n";
			$nmessage .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
			$nmessage .= "--".$uid."\r\n";
			$nmessage .= "Content-Type: application/octet-stream; name=\"".$filename."\"\r\n";
			$nmessage .= "Content-Transfer-Encoding: base64\r\n";
			$nmessage .= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n";
			$nmessage .= $content."\r\n\r\n";
			$nmessage .= "--".$uid."--";

			//SEND Mail
			if (mail($email, $subject, $nmessage, $header)) {
				$message = "נשלח מייל בהצלחה";
				echo "<script type='text/javascript'>alert('$message');</script>";
				echo '<script type="text/javascript">',
				'hideLoading();',
				'</script>';
			} else {
				echo "mail send ... ERROR!";
				print_r( error_get_last() );
			}
		
			echo "<meta http-equiv='refresh' content='2'>";
			exit();
			
			
		}
		
		mysqli_close($conn);

	}
	else
	{
	}

}

function compress($source, $destination, $quality) {

    $info = getimagesize($source);

    if ($info['mime'] == 'image/jpeg') 
        $image = imagecreatefromjpeg($source);

    elseif ($info['mime'] == 'image/gif') 
        $image = imagecreatefromgif($source);

    elseif ($info['mime'] == 'image/png') 
        $image = imagecreatefrompng($source);

    imagejpeg($image, $destination, $quality);

    return $destination;
}

?>