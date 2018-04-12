<?php


session_start();

require_once('Logs.class.php');

date_default_timezone_set("Asia/Manila");
$datas = new Log();

$words = $_SESSION['username'].'['.$_SERVER['REMOTE_ADDR'].'] has logged out.('.date("h:i:sa").')';
$datas->List('account_mng/CraftCourtLog_'.date("n.j.Y").'.txt',$words);

unset($_SESSION['loggedinuser']);


unset($_SESSION['username']);
			
header('Location:index.php');



?>