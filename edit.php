<?php

	require_once("edit_user.php");

	if(isset($_POST["update"])){
		
		updateCar($_POST["id"],$_POST["autonr"], $_POST["sisenemismass"], $_POST["lahkumismass"]);
	}
	
	
	

	if(!isset($_GET["edit"])){

		
		header("location: table.php");
		
	}else{


		$autodd = getOneCar($_GET["edit"]);
		var_dump($autodd);
	}
	
	
	
	
	
?>
<h2>Tee muudatusi</h2>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
	<input type="hidden" name="id" value="<?=$_GET["edit"];?>" > 
  	<label for="auto">Auto nr</label><br>
	<input id="auto" name="auto" type="text" value="<?php echo $car_object->autonr;?>" ><br><br>
  	<label for="sisenemismass">Sisenemismass</label><br>
	<input id="sisenemismass" name="sisenemismass" type="text" value="<?=$car_object->sisenemismass;?>"><br><br>
  	  	<label for="ahkumismass">Lahkumismass</label><br>
	<input id="lahkumismass" name="lahkumismass" type="text" value="<?=$car_object->lahkumismass;?>"><br><br>
	<input type="submit" name="update" value="Salvesta">
  </form>