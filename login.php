<?php
session_start();


$username = "";

$errors = array();
$_SESSION['success'] = "";


 $db = mysqli_connect('localhost', 'root','','craftcourt_db');
 


if (isset($_POST['sublog'])) {
	$username = $_POST['uname'];
	$password =  $_POST['pcode'];
	
	$username = stripcslashes($username);
	$password =  stripcslashes($password);
	
	$username = mysqli_real_escape_string($db,$username);
	$password =  mysqli_real_escape_string($db,$password);

	if (empty($username)) {
		array_push($errors, "Username is required");
	}
	if (empty($password)) {
		array_push($errors, "Password is required");
	}

	if(count($errors) == 0) {
		$password = hash('sha256',$password);
	//	"SELECT * FROM users WHERE uname='$username' AND pcode='$password'";
		$results = mysqli_query($db,"SELECT * FROM users WHERE uname='$username' AND pcode='$password'") or die("failure".mysql_error());

		if (mysqli_num_rows($results) == 1) {
			$_SESSION['username'] = $username;
			setcookie("loggedinuser",$username);
			$_SESSION['success'] = "You are now logged in";
			header('Location:../index.php');
		}else {
			array_push($errors, "Wrong username/password combination");
			header('Location:signup.php');
		}
	}
}
?>