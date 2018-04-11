<?php
	include_once('header.php');
	if(isset($_SESSION["product"]) == FALSE){
		echo 'No item selected.';
	}else{
		
	$sql = "UPDATE products SET state='2' WHERE id=".$_SESSION["product"];

		if ($conn->query($sql) === TRUE) {
			echo "Record updated successfully";
		} else {
			echo "Error updating record: " . $conn->error;
		}
	//$adddelivery= "INSERT INTO deliveries (p_id, saledate, fullname, address, py_id) VALUES (".", "."".$_SESSION["fullname"].", ".$_SESSION["address"].", ". "";
					
	$stmt = $conn->prepare("INSERT INTO deliveries ( saledate, fullname, address, py_id) VALUES ( ?, ?, ?, ?)");
	$stmt->bind_param("sssi", $saledate, $fullname, $address, $py_id);
	
	
	$saledate = date("Y.m.d");
	$fullname = $_SESSION["fullname"];
	$address = $_SESSION["address"];
	$py_id = $_SESSION["payid"];
	
	$stmt->execute();
	
	}
	
	}
		
	
?>


<?php
	
	include_once('footer.php');
?>
