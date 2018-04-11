<?php
	include_once 'header.php';
	
?>

<div class="panel panel-default center_div">
  <div class="panel-heading text-center">Open Shop</div>
  <div class="panel-body">
	<form class="form-horizontal center_div" action="" method="post">
	  <div class="form-group">
		<label class="control-label col-sm-2" for="sname">Name of Shop:</label>
		<div class="col-sm-10">
		  <input type="text" class="form-control" id="sname">
		</div>
	  </div>
	  <div class="form-group">
		<label class="control-label col-sm-2" for="sdesc">Description:</label>
		<div class="col-sm-10">
		  <input type="text" class="form-control" id="sdesc">
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
	include_once 'footer.php';
?>