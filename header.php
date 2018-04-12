<?php
	include 'database.php';
	session_start();
	
	
	
      
		?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>The Marketplace</title>
		
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	
	<body>
		<nav class="navbar-inverse">
		  <div class="container-fluid">
			<div class="navbar-header">
			  <a class="navbar-brand" href="index.php">The Marketplace</a>
			</div>
			<form class="navbar-form navbar-left" action="search.php">
			  <div class="form-group">
				<input type="text" class="form-control" placeholder="Search" name="search">
			  </div>
			  <button type="submit" class="btn btn-default">Submit</button>
			</form>
			
			<ul class="nav navbar-nav navbar-right">
	 		<?php	
				if(isset($_SESSION['loggedinuser'])){
				echo '<li><a href="sessionprocess.php" ><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>';
				}else{
 	    		echo '<li><a href="#loginModal" data-toggle="modal"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>';
				echo '<li><a href="#signupModal" data-toggle="modal"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>';
			   }
		?>	</ul>
		  </div>
		</nav>
		
		<!-- Login Modal -->
			<div id="loginModal" class="modal fade" role="dialog">
			  <div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
				  <div class="modal-header">
					<h4 class="modal-title">Login Account</h4>
				  </div>
				  <div class="modal-body">
					<form method = "POST"  action="account_mng/login.php" >
						<div class="form-group">
							<label for="uname">Username:</label>
							<input type="text" class="form-control" id="uname" name="uname">
						</div>
						<div class="form-group">
							<label for="uname">Password:</label>
							<input type="password" class="form-control" id="pcode" name= "pcode">
						</div>

						<button type="submit" class="btn btn-default" name="sublog">Submit</button>
					</form> 
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				  </div>
				</div>
			  </div>
			</div>
		<!-- Signup Modal -->
			<div id="signupModal" class="modal fade" role="dialog">
			  <div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
				  <div class="modal-header">
					<h4 class="modal-title">Create Account</h4>
				  </div>
				  <div class="modal-body">
					<form method= "POST" action="account_mng/signup.php">
						<div class="form-group">
							<label for="email">Email Address:</label>
							<input type="email" class="form-control" id="email" name="email">
						</div>
						<div class="form-group">
							<label for="fname">First Name/s:</label>
							<input type="text" class="form-control" id="fname" name="fname">
						</div>
						<div class="form-group">
							<label for="lname">Surname:</label>
							<input type="text" class="form-control" id="lname" name="lname">
						</div>
						<div class="form-group">
							<label for="uname">Username:</label>
							<input type="text" class="form-control" id="uname" name="uname">
						</div>
						<div class="form-group">
							<label for="uname">Password:</label>
							<input type="password" class="form-control" id="pcode" name="pcode">
						</div>

						<button type="submit" class="btn btn-default" name="signup">Submit</button>
					</form> 
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				  </div>
				</div>
			  </div>
			</div>
			
	<script>
   
    function logout{}{
	
  	 
		
	}
   
   </script>	