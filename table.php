<?php
	

	require_once("funktsioon.php");
	require_once("edit_user.php");
	
	
	if(isset($_POST["update"])){
		
		updateCar($id, $autonr, $sisenemismass, $lahkumismass);
		
	}

	if(isset($_GET["delete"])){
		

		deleteCar($_GET["delete"]);
		
	}
	
	
	
	$autodd = getCar();
	//var_dump($car_list);
?>
<table border=1 >
	<tr>
		<th>id</th>
		<th>kasutaja id</th>
		<th>Autode nr</th>
		<th>Sisenemismass</th>
		<th>Lahkumismass</th>
		<th>X</th>
	</tr>
	
	
	<?php
	
	
		// count($car_list) - massiivi pikkus
	for($i = 0; $i < count($autodd); $i++){
			// $i = $i +1; sama mis $i += 1; sama mis $i++;
			
			
			if(isset($_GET["edit"]) && $autodd[$i]->id == $_GET["edit"]){
				echo "<tr>";
					echo "<form action='table.php' method='post'>";
						echo "<td>".$autodd->id."</td>";
						echo "<td>".$autodd->user_id."</td>";
						echo "<td><input name='autonr' value='".$autodd->autonr."'></td>";
						echo "<td><input name='sisenemismass' value='".$autodd->sisenemismass."'></td>";
						echo "<td><input name='lahkumismass' value='".$autodd->lahkumismass."'></td>";
						echo "<td><input type='submit' name='update'></td>";
						echo "<td><a href='table.php'>cancel</a></td>";
					echo "</form>";
				echo "</tr>";
				
			}else{
				// tavaline rida
				echo "<tr>";
				echo "<td>".$autodd[$i]->id."</td>";
				echo "<td>".$autodd[$i]->user_id."</td>";
				echo "<td>".$autodd[$i]->autonr."</td>";
				echo "<td>".$autodd[$i]->sisenemismass."</td>";
				echo "<td>".$autodd[$i]->lahkumismass."</td>";
				echo "<td><a href='?delete=".$autodd[$i]->id."'>X</a></td>";
				echo "<td><a href='?edit=".$autodd[$i]->id."'>edit</a></td>";
			
				//echo "</tr>";
			}
			
        }		
		
	
?>

</table>