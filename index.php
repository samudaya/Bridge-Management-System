<?php
	@session_start();
	if($_GET['logout'] == "yes")
	{
		unset($_SESSION['log_user_ip']);
		unset($_SESSION['log_user_id_set']);
		unset($_SESSION['logined_Password']);
		unset($_SESSION['logined_UserName']);
		unset($_SESSION['logined_sections_SectionID']);
		unset($_SESSION['BIMSSesDate']);
		unset($_SESSION['log_UserID']);
		unset($_SESSION['log_user_ip_set']);
	}
if($_SERVER["HTTPS"] == "on") 
{
	$newpage = "http://". $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
	header("Location: $newpage");
	exit();
}
@session_start();
$_SESSION['log_user_ip']		= '';
$_SESSION['log_user_ip']		= $_SERVER['HTTP_X_FORWARDED_FOR'];
$_SESSION['log_user_ip_set']	= 1;
require_once 'global.php';
$newpage2 = $pathprefix . "login_index.php";
header("Location: $newpage2");
?>