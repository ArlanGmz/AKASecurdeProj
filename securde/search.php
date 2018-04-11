<?php
	include_once 'header.php';
	$search_term = $_GET["search"];
	$search_query = "SELECT * FROM products WHERE title LIKE '%".$search_term."%';";
	
	$result = $conn->query($search_query);
?>
<div class="container-fluid"><h1>Searching for...<?php echo "'".$search_term."'";?></h1></div>
<?php	
	if ($result->num_rows > 0) {
			
			echo "<div class='list-group'>";
			
			while($row = $result->fetch_assoc()) {
				echo "<a href='product.php?title=".$row["p_id"]."' class='list-group-item'>";
				echo "<h4 class='list-group-item-heading'>".$row["title"]."</h4>";
				echo "<p class='list-group-item-text'>₱".$row["price"]."</p>";
				echo "</a>";
			}
			
			echo "</div>";
			
		} else {
			echo "No items found...";
		}
?>

<?php
	include_once 'footer.php';
?>