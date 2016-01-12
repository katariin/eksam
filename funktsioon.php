<?php
	
	// functions.php
	require_once("config.php");
	$database = "if15_jekavor";
	
	//loome uue funktsiooni, et k�sida ab'ist andmeid
	function getCar(){
		
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("SELECT id, user_id, autonr, sisenemismass, lahkumismass FROM auto");
		echo $mysqli->error;
		$stmt->bind_result($id, $user_id, $autonr, $sisenemismass, $lahkumismass);
		$stmt->execute();
		
		// t�hi massiiv kus hoiame objekte (1 rida andmeid)
		$array = array();
		
		// tee ts�klit nii mitu korda, kui saad 
		// ab'ist �he rea andmeid
		while($stmt->fetch()){
			
			// loon objekti iga while ts�kli kord
			$car = new StdClass();
			$car->id = $id;
			$car->user_id = $user_id;
			$car->autonr = $autonr;
			$car->sisenemismass = $sisenemismass;
			$car->lahkumismass = $lahkumismass;
			
			// lisame selle massiivi
			array_push($array, $car);
			//echo "<pre>";
			//var_dump($array);
			//echo "</pre>";
			
		}
		
		$stmt->close();
		$mysqli->close();
		
		return $array;
		
		
	}
	
	
	function deleteCar($id_to_be_deleted){
		
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("UPDATE auto SET deleted=NOW() WHERE id=?");
		$stmt->bind_param("i", $id_to_be_deleted);
		
		if($stmt->execute()){
			// sai edukalt kustutatud
			header("Location: table.php");
			
		}
		
		$stmt->close();
		$mysqli->close();
		
	}
	

	
?>