<?php
	include_once('header.php');
	if(isset($_SESSION["product"]) == FALSE){
		echo 'No item selected.';
	}else{
?>

<div class="panel panel-default center_div">
  <div class="panel-heading text-center">Shipping Address</div>
  <div class="panel-body">
	<form class="form-horizontal center_div" action="cart_payment.php?title=<?php echo $_SESSION["product"];?>" method="post">
	  <div class="form-group">
		<label class="control-label col-sm-2" for="street">Street Address:</label>
		<div class="col-sm-10">
		  <input type="text" class="form-control" id="street" name= "street">
		</div>
	  </div>
	  <div class="form-group">
		<label class="control-label col-sm-2" for="other">Apt./Suite/Other:</label>
		<div class="col-sm-10">
		  <input type="text" class="form-control" id="other" name= "other">
		</div>
	  </div>
	  <div class="form-group">
		<label class="control-label col-sm-2" for="city">City:</label>
		<div class="col-sm-10">
		  <input type="text" class="form-control" id="city" name= "city">
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

/**
	- center form 
*/
?>
