<?php
	include_once 'header.php';
	$_SESSION["product"] = $_GET["title"];
	
	$productid= $_SESSION["product"];
	$get_product = "SELECT * from products WHERE p_id=".$productid;
	$result = $conn->query($get_product);
	$count = mysqli_num_rows($result);
	
	$row = null;
	
	if($count == 1){
		$row = $result->fetch_assoc();
	}
	
	$pname = $row['title'];
	$pprice = $row['price'];
	$pdesc = $row['description'];
	
?>

	<div class="panel panel-default">
	  <div class="panel-heading"><?php echo $pname;?></div>
	  <div class="panel-body">
		<p>Price: ₱<?php echo $pprice;?></p>
		<p>Description:</p>
		<p>"<?php echo $pdesc;?>"</p>
		
		<a href="cart_shipping.php?title=<?php echo $_SESSION["product"];?>" class="btn btn-info" role="button">Buy</a> 
	  </div>
	</div>

<?php
	//session_unset();
	//session_destroy(); 
	include_once 'footer.php';
?>