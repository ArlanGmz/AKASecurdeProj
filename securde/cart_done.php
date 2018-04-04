<?php
	include_once('header.php');
	if(isset($_SESSION["product"]) == FALSE){
		echo 'No item selected.';
	}else{
		echo 'Submitted...'
	}
		
	
?>


<?php
	
	include_once('footer.php');
?>
