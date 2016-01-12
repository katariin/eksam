<?php
	// siia lisame auto nr märgite vormi
	//laeme funktsiooni failis
	require_once("function.php");
	
	//kontrollin, kas kasutaja ei ole sisseloginud
	if(!isset($_SESSION["id_from_db"])){
		// suunan login lehele
		header("Location: login.php");
	}
	
	//login välja, aadressireal on ?logout=1
	if(isset($_GET["logout"])){
		//kustutab kõik sessiooni muutujad
		session_destroy();
		
		header("Location: login.php");
		
	}
	
	$autonr = $sisenemismass =  $autonr_error = $sisenemismass_error =  "";
	
	// et ei ole tühjad
	// clean input
	// salvestate
	
	if(isset($_POST["create"])){
		if ( empty($_POST["auto"]) ) {
			$autonr_error = "See väli on kohustuslik";
		}else{
			$autonr = cleanInput($_POST["auto"]);
		}
		if ( empty($_POST["sisenemismass"]) ) {
			$sisenemismass_error = "See väli on kohustuslik";
		} else {
			$sisenemismass = cleanInput($_POST["sisenemismass"]);
		}
		
		if(	$autonr_error == "" && $sisenemismass_error == ""){
			

			$message = createCar($autonr, $sisenemismass);
			
			header("Location: data2.php");
			
			if($message != ""){
				//salvestamine õnnestus
				// teen tühjaks input value'd
				$autonr = "";
				$sisenemismass = "";
								
				echo $message;
				
			}
			
		}
    } // create if end
	
		
	
	function cleanInput($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	  }
	
	
	
	
?>

<p>
	Tere, <?=$_SESSION["user_email"];?>
	<a href="?logout=1"> Logi välja</a>
</p>

 <h2>Lisa auto</h2>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
  	<label for="auto" >Auto number</label><br>
	<input id="auto" name="auto" type="text" value="<?=$autonr; ?>"> <?=$autonr_error; ?><br><br>
  	<label>Sisenemismass</label><br>
	<input name="sisenemismass" type="text" value="<?=$sisenemismass; ?>"> <?=$sisenemismass_error; ?><br><br>
  	<input type="submit" name="create" value="Salvesta">
  </form>
  

