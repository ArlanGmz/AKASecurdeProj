<?php
	include_once 'header.php';
	$_SESSION["shop"] = $_GET["shop"];
	$seller = $_SESSION["shop"];
	$get_shopinfo = "SELECT shop_name, description,firstname, lastname from shops s, users u, user_shops us WHERE s.s_id = us.s_id AND u.id=us.id AND us.s_id =".$seller;
	$acquire_products = "SELECT * from products WHERE seller=".$seller;

	/*When someone edits*/
	if(isset($_POST["i_name"])||isset($_POST["i_desc"])){
		if(!empty($_POST["i_name"])){
			$change = $conn->prepare("UPDATE products SET title=? WHERE p_id=".$_POST["i_num"]);
			$change->bind_param("s", $n);
			$n = $_POST["i_name"];
			$change->execute();
			unset($_POST["i_name"]);
		}else if(!empty($_POST["i_desc"])){
			$change = $conn->prepare("UPDATE products SET description=? WHERE p_id=".$_POST["i_num"]);
			$change->bind_param("s", $d);
			$d = $_POST["i_desc"];
			$change->execute();
			unset($_POST["i_desc"]);
		}
	}
	
	/*Whe someone deletes*/
	if(isset($_POST["delete_num"])){
		$delete = $conn->prepare("DELETE from products WHERE p_id= ?");
		$delete->bind_param("i", $d);
		$d = $_POST["delete_num"];
		$delete->execute();
		unset($_POST["delete_num"]);
	}
	/*
	$stmt = $conn->prepare("INSERT INTO MyGuests (firstname, lastname, email) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $firstname, $lastname, $email);

// set parameters and execute
$firstname = "John";
$lastname = "Doe";
$email = "john@example.com";
$stmt->execute();
*/
	
	/*The shop's name and description*/
	
	$result = $conn->query($get_shopinfo);
	$count = mysqli_num_rows($result);
	$row = null;
	
	if($count == 1){
		$row = $result->fetch_assoc();
	}

	$s_name = $row["shop_name"];
	$s_desc = $row["description"];
	$s_owner = $row["firstname"]." ".$row["lastname"];
	
	$result = null;
	
	
	echo "<div class='well well-lg'>";
	echo "<h3 class='text-left'>".$s_name."</h3>";
	echo "<p class='float-right'>Owner: ".$s_owner."</p>";
	echo "<small>".$s_desc."</small><br>";
	echo "<a href='#shopEditModal' class='btn btn-info' role='button' data-toggle='modal'>Edit</a><a href='#shopAddModal' class='btn btn-info' role='button' data-toggle='modal'>Add Product</a>" ;
	echo "</div>";
	
	
?>
	<!-- Shop Edit Modal-->
	<div id="shopEditModal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Edit Shop Information</h4>
          </div>
          <div class="modal-body">
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]."?shop=".$_SESSION["shop"]);?>">
						<div class="form-group">
							<label for="i_name">Shop Name:</label>
							<input type="text" class="form-control" id="i_name" name="i_name">
						</div>
						<div class="form-group">
							<label for="i_desc">Description:</label>
							<input type="text" class="form-control" id="i_desc" name="i_desc">
						</div>
			 
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
			</form>
          </div>
        </div>
      </div>
    </div>
	
	<!-- Add Product Modal-->
	<div id="shopAddModal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Add Product</h4>
          </div>
          <div class="modal-body">
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]."?shop=".$_SESSION["shop"]);?>">
						<div class="form-group">
							<label for="ap_name">Item Name:</label>
							<input type="text" class="form-control" id="ap_name" name="ap_name">
						</div>
						<div class="form-group">
							<label for="ap_desc">Description:</label>
							<input type="text" class="form-control" id="ap_desc" name="ap_desc">
						</div>
						<div class="form-group">
							<label for="ap_price">Price:</label>
							<input type="number" class="form-control" id="ap_price" name="ap_price">
						</div>
			 
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
			</form>
          </div>
        </div>
      </div>
    </div>
<?php
	/*The shop's products*/
	
	$result = $conn->query($acquire_products);
	$count = mysqli_num_rows($result);

	if($count >= 1){
		echo "<div class='list-group'>";
			
			while($row = $result->fetch_assoc()) {
				echo "<a href='product.php?title=".$row["p_id"]."' class='list-group-item'>";
				echo "<h4 class='list-group-item-heading'>".$row["title"]."</h4>";
				echo "<p class='list-group-item-text'>₱".$row["price"]."</p>";
				echo "<a href='#editModal' class='btn btn-info' role='button' data-toggle='modal'><span class='glyphicon glyphicon-cog'></span></a>" ;
				echo "<a href='#deleteModal' class='btn btn-info' role='button' data-toggle='modal'><span class='glyphicon glyphicon-remove'></span></a>"; 
				echo "</a>";
?>		
	<!-- Edit Modal-->
	<div id="editModal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Edit Item</h4>
          </div>
          <div class="modal-body">
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]."?shop=".$_SESSION["shop"]);?>">
						<div class="form-group">
							<label for="i_name">Item Name:</label>
							<input type="text" class="form-control" id="i_name" name="i_name">
						</div>
						<div class="form-group">
							<label for="i_desc">Description:</label>
							<input type="text" class="form-control" id="i_desc" name="i_desc">
						</div>
						<div class="form-group">
							<input type="hidden" class="form-control" name="i_num" value=<?php echo $row["p_id"];?>>
						</div>
			 
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
			</form>
          </div>
        </div>
      </div>
    </div>
	<!-- Delete Modal-->
	<div id="deleteModal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Edit Item</h4>
          </div>
          <div class="modal-body">
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]."?shop=".$_SESSION["shop"]);?>">
						<p>Are you sure you want to delete this item?</p>
						<div class="form-group">
							<input type="hidden" class="form-control" name="delete_num" value=<?php echo $row["p_id"];?>>
						</div> 
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            <button type="submit" class="btn btn-primary">Yes</button>
			</form>
          </div>
        </div>
      </div>
    </div>
<?php
			}
			
			echo "</div>";
			
		} else {
			echo "<p class='bg-warning text-center'>No products to display</p>";
		}
	
?>

<?php
	include 'footer.php';
?>
