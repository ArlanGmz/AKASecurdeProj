<?php
	include_once 'header.php';
	$_SESSION["shop"] = $_GET["shop"];
	$seller = $_SESSION["shop"];
	$get_shopinfo = "SELECT shop_name, description,firstname, lastname from shops s, users u, user_shops us WHERE s.s_id = us.s_id AND u.id=us.id AND us.s_id =".$seller;
	$acquire_products = "SELECT * from products WHERE seller=".$seller;
	$get_shopinfo2 = "SELECT * from shops s, users u, user_shops us WHERE s.s_id = us.s_id AND u.id=us.id AND us.s_id =".$seller;
     
	 /* WHEN SOMEONE EDIT shop info 
	 */
	 if(isset($_POST['s_name'] ) || isset($_POST['s_desc'])){
		 if(!empty($_POST["s_name"])){
			$change = $conn->prepare("UPDATE products SET title=? WHERE s_id=".$_POST["s_num"]);
			$change->bind_param("s", $n);
			$n = $_POST["s_name"];
			$change->execute();
			unset($_POST["s_name"]);
		}
		
		if(!empty($_POST["s_desc"])){
			$change = $conn->prepare("UPDATE products SET description=? WHERE s_id=".$_POST["s_num"]);
			$change->bind_param("s", $d);
			$d = $_POST["s_desc"];
			$change->execute();
			unset($_POST["s_desc"]);
		}
		 
		 
	 }
	 /* WHEN SOMEONE ADD PRODUCTS*/
	 if(isset($_POST['ap_name']) && isset($_POST['ap_desc']) && isset($_POST['ap_price'])){
		 
		 	$product = $conn->prepare(" INSERT into products (`seller`,`title`,`price`,`description`, `state`,`p_type`) values(?,?,?,?,?,?)");
		    $product->bind_param("isisii",$d , $d1 , $d2 , $d3 , $d4 , $d5);
			
			$d=$seller;
			$d1=$_POST['ap_name'];
			$d2=$_POST['ap_price'];
			$d3=$_POST['ap_desc'];
			$d4=1;
			$d5=$_POST['ap_type'];
			
			$product->execute();
			
			unset($_POST['ap_name']);
			unset($_POST['ap_desc']);
			unset($_POST['ap_price']);
	 
	 }
	 /*When someone edits products*/
	if(isset($_POST["i_name"])||isset($_POST["i_desc"])){
		echo "Number: ".$_POST["i_num"];
		if(!empty($_POST["i_name"])){
			echo "Name: ".$_POST["i_name"];
			$change = $conn->prepare("UPDATE products SET title= ? WHERE p_id=".$_POST["i_num"]);
			$change->bind_param("s", $n);
			$n = $_POST["i_name"];
			$change->execute();
			unset($_POST["i_name"]);
		}
		
		if(!empty($_POST["i_desc"])){
			echo "Desc:".$_POST["i_desc"];
			$change = $conn->prepare("UPDATE products SET description= ? WHERE p_id=".$_POST["i_num"]);
			$change->bind_param("s", $d);
			$d = $_POST["i_desc"];
			$change->execute();
			unset($_POST["i_desc"]);
			
		}
		
		unset($_POST["i_num"]);
	}
	
	/*Whe someone deletes*/
	if(isset($_POST["delete_num"])){
		$delete = $conn->prepare("DELETE from products WHERE p_id= ?");
		$delete->bind_param("i", $d);
		$d = $_POST["delete_num"];
		$delete->execute();
		unset($_POST["delete_num"]);
	}
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
	
	$result2 = $conn->query($get_shopinfo2);
	$count2 = mysqli_num_rows($result2);
	$row2 = null;
	$row2 = $result2->fetch_assoc();

	echo "<div class='well well-lg'>";
	echo "<h3 class='text-left'>".$s_name."</h3>";
	echo "<p class='float-right'>Owner: ".$s_owner."</p>";
	echo "<small>".$s_desc."</small><br>";
	
	if(isset($_SESSION['loggedinuser']))
		if($row2["id"] == $_SESSION['loggedinuser'])
        	echo "<a href='#shopEditModal' class='btn btn-info' role='button' data-toggle='modal'>Edit</a><a href='#shopAddModal' class='btn btn-info' role='button' data-toggle='modal'>Add Product</a>" ;
	echo "</div>";
	
	/*The shop's products*/
	?><!-- Shop Edit Modal-->
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
							<label for="s_name">Shop Name:</label>
							<input type="text" class="form-control" id="s_name" name="s_name">
						</div>
						<div class="form-group">
							<label for="s_desc">Description:</label>
							<input type="text" class="form-control" id="s_desc" name="s_desc">
						</div>
						<div class="form-group">
							<input type="hidden" class="form-control" name="s_num" value=<?php echo $seller;?>>
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
			 <div class="form-group" >
			   <label for ="ap_type">Product Type:</label>
			   <select class="form-control" id = "ap_type" name = "ap_type">
				   <option value="1">Accessories</option>
				   <option value="2">Art Collectibles</option>
				   <option value="3">Bags</option>
				   <option value="4">Beauty</option>
				   <option value="5">Books, Movies, and Music</option>
				   <option value="6">Clothing</option>
				   <option value="7">Craft Supplies and Tools</option>
				   <option value="8">Electronics</option>
				   <option value="9">Home and Living</option>
				   <option value="10">Jewellry</option>
				   <option value="11">Party Supplies</option>
				   <option value="12">Pet Supplies</option>
				   <option value="13">Shoes</option>
				   <option value="14">Toys and Games</option>
				   <option value="15">Weddings</option>	  
			   </select>
			   
			 
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
	$result = $conn->query($acquire_products);
	$count = mysqli_num_rows($result);
	
	if($count >= 1){
		echo "<div class='list-group'>";
			
			while($row = $result->fetch_assoc()){
				echo "<a href='product.php?title=".$row["p_id"]."' class='list-group-item'>";
				echo "<h4 class='list-group-item-heading'>".$row["p_id"].") ".$row["title"]."</h4>";
				echo "<p class='list-group-item-text'>₱".$row["price"]."</p>";
				
				if(isset($_SESSION['loggedinuser'])){
					if($row2["id"] == $_SESSION['loggedinuser']){
						echo "<a class='btn btn-info' data-toggle='modal' data-pID='".$row["p_id"]."' href='#editModal'><span class='glyphicon glyphicon-cog'>".$row["p_id"]."</span></a>" ;
						echo "<a class='btn btn-info' data-toggle='modal' data-dID='".$row["p_id"]."' href='#deleteModal'><span class='glyphicon glyphicon-remove'>".$row["p_id"]."</span></a>"; 
					}
				}
				echo "</a>";
			}
			
			echo "</div>";
			
		} else {
			echo "<p class='bg-warning text-center'>No products to display</p>";
		}
	
?>
	<!-- Edit Modal-->
	<div id="editModal" class="modal fade" role="dialog">
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
							<input type="text" class="form-control" name="i_num">
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
	<div id="deleteModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Delete Item</h4>
          </div>
          <div class="modal-body">
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]."?shop=".$_SESSION["shop"]);?>">
						<p>Are you sure you want to delete this item?</p>
						<div class="form-group">
							<input type="text" class="form-control" id="delete_num" name="delete_num">
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
	
	
<script type="text/javascript">
		$(document).ready(function(){
			$('#editModal').on('show.bs.modal', function(e) {
								var prID = $(this).attr('data-pID');
								$(this).find('input[name=i_num]').text(prID);
			});
									
			$('#deleteModal').on('show.bs.modal', function(e) {
								var dID = $(this).attr('data-dID');
								$(this).find('input[name=delete_num]').val(dID);
			});
		});
	</script>
<?php
	include 'footer.php';
?>
