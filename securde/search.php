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
				echo "item found.///";
			}
			
			echo "</div>";
			
		} else {
			echo "No items found...";
		}
?>

<?php
	include_once 'footer.php';
?>