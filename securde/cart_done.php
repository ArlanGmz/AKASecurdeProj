<?php
	include_once('header.php');
	if(isset($_SESSION["product"]) == FALSE){
		echo 'No item selected.';
	}else{
		$paymode = 0;
		
<<<<<<< HEAD
		if(strcmp ( $_POST["paytype"] , "cash" ) == 0){$paymode = 1;}
		if(strcmp ( $_POST["paytype"] , "card" ) == 0){$paymode = 2;}
=======
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
>>>>>>> ac65b5af87638dcbbd7b2e746a684e6fc864681a
		
		$override = $conn->prepare("UPDATE products SET state='2' WHERE id= ? ");
		$override->bind_param("i", $mode);
		$mode = $_SESSION["product"];
		$override->execute();
		
		$adddelivery= $conn->prepare("INSERT INTO deliveries (p_id, saledate, fullname, address, py_id)VALUES (?,?,?,?,?)");
		$adddelivery->bind_param("isssi", $product, $date, $name, $address, $payment);
		$product=$_SESSION["product"];
		$date= date("Y/m/d");
		$name= $_SESSION["fullname"];
		$address= $_SESSION["address"]; 
		$payment= $paymode;
		$adddelivery->execute();
	}
		?>

	<div class="alert alert-success">
	  <strong>Success!</strong> You should <a href="#" class="alert-link">read this message</a>.
	</div>

<?php
	
	include_once('footer.php');
?>
