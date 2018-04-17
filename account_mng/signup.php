<?php
session_start();
require_once('../Logs.class.php');

date_default_timezone_set("Asia/Manila");
$datas = new Log();


$username = "";

$errors = array();
$_SESSION['success'] = "";



 $db = mysqli_connect('localhost', 'root','e01_bright','craftcourt_db') or die("EN");
 
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

  $results = mysqli_query($db,"SELECT uname from users WHERE uname ='$username'");
  if(mysqli_num_rows($results) > 0)
  {array_push($errors, "*Username is taken"); }
  $pw_error = checkPassword($password, $errors)
	if(!empty($pw_error)){
		array_push($errors, $pw_error);
	}

  

if(count($errors) == 0)
{  $password = password_hash($password , PASSWORD_BCRYPT);
	$results = mysqli_query($db,"INSERT INTO users(uname,pcode,email,firstname,lastname) VALUES ('$username','$password','$mail','$first','$last')");
  
$_SESSION['username'] = $username;
setcookie("loggedinuser",$username);

$words = 'Guest['.$_SERVER['REMOTE_ADDR'].'] has created an account.('.date("h:i:sa").')';
$datas->List('CraftCourtLog_'.date("n.j.Y").'.txt',$words);
$_SESSION['sucess'] = "You are logged in now";
header('location:../index.php');
}
else
{
	
 $words = 'Guest['.$_SERVER['REMOTE_ADDR'].'] has failed in creating an account.('.date("h:i:sa").')';
 $datas->List('CraftCourtLog_'.date("n.j.Y").'.txt',$words);
 header('location:../index.php');
}



} 

/*Will Check If Password Contains A Set of Character*/ 
 public function checkPassword($pwd) {
    $errors=array();

    if (strlen($pwd) < 8) {
        $errors[] = "Password too short!";
    }

    if (!preg_match("#[0-9]+#", $pwd)) {
        $errors[] = "Password must include at least one number!";
    }

    if (!preg_match("#[a-zA-Z]+#", $pwd)) {
        $errors[] = "Password must include at least one letter!";
    }     

    return $errors;
}
?>