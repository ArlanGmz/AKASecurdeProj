<?php
	include_once 'header.php';
	$_SESSION["shop"] = $_GET["shop"];
	$get_shopinfo = "SELECT shop_name, description,firstname, lastname from shops s, users u, user_shops us WHERE s.s_id = us.s_id AND u.id=us.id AND us.s_id =".$_SESSION["shop"];
	$acquire_products = "SELECT * from products WHERE seller=".$_SESSION["shop"];

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
	echo "<a href='' class='btn btn-info' role='button'>Edit</a>" ;
	echo "</div>";
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
