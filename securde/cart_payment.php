<?php
	include_once('header.php');
	if(isset($_SESSION["product"]) == FALSE){
		echo 'No item selected.';
	}else{
		$_SESSION["address"] = $_POST["street"]. " ".$_POST["other"]." ".$_POST["city"]." ".$_POST["postal"];
		$_SESSION["fullname"] ="";
		$loggeduser=$_SESSION["loggedinuser"];
		$Selectname="Select firstname, lastname from users where uname ==".$loggeduser;
		$result = $conn->query($Selectname);
		if($result->num_rows==1)
		{
			while($row = $result->fetch_assoc()) {
				$_SESSION["fullname"]=$row["firstname"]." ".$row["lastname"];
			}
		}
		//$_SESSION["product"]
	
?>


<div class="panel panel-default center_div">
  <div class="panel-heading text-center">Choose Payment Method</div>
  <div class="panel-body">
	<form class="form-horizontal center_div" action="cart_done.php" method="post">
	  <div class="form-group">
		<div class="radio">
		  <label><input type="radio" name="paytype" value="card">Credit Card</label>
		</div>
	  </div>
	  <div class="form-group">
		<div class="radio">
		  <label><input type="radio" name="paytype" value="cash">Cash in Delivery</label>
		</div>
	  </div>

	  <div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
		  <button type="submit" class="btn btn-default">Submit</button>
		</div>
	  </div>
	</form> 		
  </div>
</div>
	


<?php
	}
	include_once('footer.php');
?>
