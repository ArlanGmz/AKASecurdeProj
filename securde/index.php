<?php
	include_once 'header.php';
	unset($_SESSION["product"]);
?>

	<?php
		$select_shops = "SELECT * FROM shops;";
		
		$result = $conn->query($select_shops);

		if ($result->num_rows > 0) {
			
			echo "<div class='list-group'>";
			
			while($row = $result->fetch_assoc()) {
				echo "<a href='shop.php?shop=".$row["s_id"]."' class='list-group-item'>";
				echo "<h4 class='list-group-item-heading'>".$row["shop_name"]."</h4>";
				echo "</a>";
			}
			
			echo "</div>";
			
		} else {
			echo "0 results";
		}
	?>

<?php
	include 'footer.php';
?>

<!--

<div class="list-group">
    <a href="#" class="list-group-item active">
      <h4 class="list-group-item-heading">First List Group Item Heading</h4>
      <p class="list-group-item-text">List Group Item Text</p>
    </a>
    <a href="#" class="list-group-item">
      <h4 class="list-group-item-heading">Second List Group Item Heading</h4>
      <p class="list-group-item-text">List Group Item Text</p>
    </a>
    <a href="#" class="list-group-item">
      <h4 class="list-group-item-heading">Third List Group Item Heading</h4>
      <p class="list-group-item-text">List Group Item Text</p>
    </a>
  </div>
-->