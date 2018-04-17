<?php
	include_once('header.php');
	if(isset($_SESSION["product"]) == FALSE){
		echo 'No item selected.';
	}else{
		/*Override Purchase*/
		$override = $conn->prepare("UPDATE products SET state='2' WHERE id= ?".$_SESSION["product"]);
		$override->bind_param("i",$id);
		$id = $_SESSION["product"];
		$override->execute();
			
		/*Place Delivery*/
		$deliver = $conn->prepare("INSERT INTO deliveries ( saledate, fullname, address, py_id) VALUES ( ?, ?, ?, ?)");
		$deliver->bind_param("sssi", $saledate, $fullname, $address, $py_id);
		$saledate = date("Y/m/d");
		$fullname = $_SESSION["fullname"];
		$address = $_SESSION["address"];
		/*Convert payment string to id num*/
		$py_id = 0;
		if(strcmp($_SESSION["payid"],"cash") == 0){
				$py_id = 2;
		}else{
				$py_id = 1;
		}
		$deliver->execute();
		
		echo '<div class="alert alert-success">';
		echo '<strong>Success!</strong> Indicates a successful or positive action.';
		echo '</div>';
	}
	

		
	
?>


<?php
	
	include_once('footer.php');
?>
