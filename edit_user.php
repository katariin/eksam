<?php
	require_once("config.php");
	$database = "if15_jekavor";
	
	function getOneCar($edit_id){
		

		
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("SELECT autonr, sisenemismass, lahkumismass FROM auto WHERE id=? AND deleted IS NULL");

		$stmt->bind_param("i", $edit_id);
		$stmt->bind_result($autonr, $sisenemismass, $lahkumismass);
		$stmt->execute();

		$car = new Stdclass();
		

		if($stmt->fetch()){

			$car->autonr = $autonr;
			$car->sisenemismass = $sisenemismass;
			$car->lahkumismass = $lahkumismass;
			
			
		}else{

			header("Location: table.php");
		}
		
		return $car;
		
		
		$stmt->close();
		$mysqli->close();
		
	}
	function updateCar($id, $autonr, $sisenemismass, $lahkumismass){
		
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("UPDATE auto SET autonr = ?, sisenemismass = ?, lahkumismass = ? WHERE id=?");
		$stmt->bind_param("iiii", $autonr, $sisenemismass, $lahkumismass, $id);
		

		if($stmt->execute()){

			echo "Edukalt tehtud";
		}
		
		
		$stmt->close();
		$mysqli->close();
		
		
	}
	
	
?>