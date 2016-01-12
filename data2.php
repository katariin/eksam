<?php
	// siia lisame auto nr märgite vormi
	//laeme funktsiooni failis
	require_once("function.php");
	
	//kontrollin, kas kasutaja ei ole sisseloginud
	if(!isset($_SESSION["id_from_db"])){
		// suunan login lehele
		//header("Location: login.php");
	}
	
	//login välja, aadressireal on ?logout=1
	if(isset($_GET["logout"])){
		//kustutab kõik sessiooni muutujad
		session_destroy();
		
		header("Location: login.php");
		
	}
		$lahkumismass = $lahkumismass_error = "";
		
		
		if(isset($_POST["create2"])){
		//if ( empty($_POST["autonr"]) ) {
		//	$autonr_error = "See väli on kohustuslik";
		//}else{
		//	$autonr = cleanInput($_POST["autonr"]);
		//}
		if ( empty($_POST["lahkumismass"]) ) {
			$lahkumismass_error = "See väli on kohustuslik";
		} else {
			$lahkumismass = cleanInput($_POST["lahkumismass"]);
		}
		if($lahkumismass_error == ""){
			
			// functions.php failis käivina funktsiooni
			// msq on message funktsioonist mis tagasi saadame
			$mesg = createAuto($lahkumismass);
			
			if($mesg != ""){
				//salvestamine õnnestus
				// teen tühjaks input value'd
				$lahkumismass = "";
								
				echo $mesg;
				
			}
			
		}
    }
	
	function cleanInput($data) {
	  $data = trim($data);
		$data = stripslashes($data);
	  $data = htmlspecialchars($data);
		return $data;
	  }
	
	
	
	
	?>
	

	
	   <h2>Lisa auto</h2>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
	<label>Lahkumismass</label><br>
	<input name="lahkumismass" type="text" value="<?=$lahkumismass; ?>"> <?=$lahkumismass_error; ?><br><br>
  	<input type="submit" name="create2" value="Salvesta">
  </form>