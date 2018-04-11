<?php
session_start();
require_once('../Logs.class.php');

date_default_timezone_set("Asia/Manila");
$datas = new Log();


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
	   
	//	"SELECT * FROM users WHERE uname='$username' AND pcode='$password'";
		$results = mysqli_query($db,"SELECT * FROM users WHERE uname='$username' ") or die("failure".mysql_error());
          
		  
		  $hash = $results->fetch_assoc();
		  
		
		if ( password_verify($password,$hash["pcode"])) {
		
			$_SESSION['username'] = $username;
			setcookie("loggedinuser", $results["id"], time() + (86400 * 30), "/");
			$_SESSION['success'] = "You are now logged in";
			
             $words = $_SESSION['username'].'['.$_SERVER['REMOTE_ADDR'].'] has logged in.('.date("h:i:sa").')';
             $datas->List('CraftCourtLog_'.date("n.j.Y").'.txt',$words);
			header('Location:../index.php');
		}else {
			array_push($errors, "Wrong username/password combination");
			
            $words = 'Guest['.$_SERVER['REMOTE_ADDR'].'] has failed to logged in.('.date("h:i:sa").')';
            $datas->List('CraftCourtLog_'.date("n.j.Y").'.txt',$words);
			header('Location:signup.php');
		}
	}
}
?>