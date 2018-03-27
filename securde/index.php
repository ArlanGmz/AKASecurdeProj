<?php
	include 'header.php';
?>

	<?php
		$select_product = "SELECT * FROM products;";
		
		$result = $conn->query($select_product);

		if ($result->num_rows > 0) {
			
			echo "<div class='list-group'>";
			
			while($row = $result->fetch_assoc()) {
				echo "<a href='/product?title=".$row["title"]."' class='list-group-item'>";
				echo "<h4 class='list-group-item-heading'>".$row["title"]."</h4>";
				echo "<p class='list-group-item-text'>".$row["description"]."</p>";
				echo "<p class='list-group-item-text'>₱".$row["price"]."</p>";
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