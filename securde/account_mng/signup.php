<?php
session_start();


$username = "";

$errors = array();
$_SESSION['success'] = "";



 $db = mysqli_connect('localhost', 'root','','craftcourt_db') or die("EN");
 
if ( isset($_POST['signup']))
{
	
	
	$username = mysqli_real_escape_string($db,$_POST['uname']);
	$password =  mysqli_real_escape_string($db,$_POST['pcode']);
	$mail =  mysqli_real_escape_string($db,$_POST['email']);
	$first =  mysqli_real_escape_string($db,$_POST['fname']);
	$last =  mysqli_real_escape_string($db,$_POST['lname']);

	
if( empty($username)) {array_push($errors, "*Username is required"); }
if( empty($password)) {array_push($errors, "*Password is required"); }
if( empty($mail)) {array_push($errors, "*Email is required"); }

if( empty($first)) {array_push($errors, "*Name is required"); }
if( empty($last)) {array_push($errors, "*Name is required"); }


if(count($errors) == 0)
{  $password = hash('sha256' , $password);
	$results = mysqli_query($db,"INSERT INTO users(uname,pcode,email,firstname,lastname) VALUES ('$username','$password','$mail','$first','$last')");
  
$_SESSION['username'] = $username;
setcookie("loggedinuser",$username);
$_SESSION['sucess'] = "You are logged in now";
header('location:../index.php');
}



}
 
 
?>