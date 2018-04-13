<?php
	include_once 'header.php';
	if(isset($_POST["sname"])&&isset($_POST["sdesc"])){
		$create_shop=$conn->prepare("INSERT into shops(`shop_name`,`description`) VALUES(?,?)");
		$create_shop->bind_param("ss",$name,$desc);
		$name = $_POST["sname"];
		$desc = $_POST["sdesc"];
		$create_shop->execute();
		$shop_id = $create_shop->insert_id;

		$link_shop = $conn->prepare("INSERT into user_shops(`id`,`s_id`) VALUES(?,?)");
		$link_shop->bind_param("ii",$id,$sh_id);
		$id = $_SESSION['loggedinuser'];
		$sh_id = $shop_id;
		$link_shop->execute();
		
		header("Location: index.php");
		
	}else{
		echo '<div class="alert alert-warning">';
		echo '<strong>Warning!</strong> Both fields required.';	
		echo '</div>';
	}
?>

<div class="panel panel-default center_div">
  <div class="panel-heading text-center">Open Shop</div>
  <div class="panel-body">
	<form class="form-horizontal center_div" action="" method="post">
	  <div class="form-group">
		<label class="control-label col-sm-2" for="sname">Name of Shop:</label>
		<div class="col-sm-10">
		  <input type="text" class="form-control" id="sname" name="sname">
		</div>
	  </div>
	  <div class="form-group">
		<label class="control-label col-sm-2" for="sdesc">Description:</label>
		<div class="col-sm-10">
		  <input type="text" class="form-control" id="sdesc" name="sdesc">
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