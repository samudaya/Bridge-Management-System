<?php
@session_start();
include("global.php");


if(isset($_SESSION['log_UserID']))
{
	require_once 'global.php';
	$newpage3 = $pathprefix . "welcome.php";
	header("Location: $newpage3");
	exit();
}
else
{
	if($_SESSION['log_user_ip_set'] != 1)
	{
		require_once 'global.php';
		$newpage3 = $pathprefix . "index.php";
		header("Location: $newpage3");
		exit();
	}


	if(!isset($_POST['BIMSUsername']) and !isset($_POST['BIMSPassword']) and !isset($_SESSION['log_UserID']))
	{
		require_once 'global.php';
		$newpage3 = $pathprefix . "login_index.php";
		header("Location: $newpage3");
		exit();
	}

	
	if($_SERVER["HTTPS"] != "on") 
	{
		$newpage = "https://". $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
		header("Location: $newpage");
		exit();
	}


	if(isset($_POST['BIMSLogin']))
	{	
		$BIMSUsername	=$_POST['BIMSUsername']; 
		$BIMSPassword	=md5($_POST['BIMSPassword']);
		$_SESSION['logined_Password'] =$_POST['BIMSPassword'];
		$_SESSION['logined_UserName'] =$_POST['BIMSUsername'];

		if((!$BIMSUsername)||(!$BIMSPassword))
		{		
			$BIMSLoginError="<b>Please Enter User Name & Password</b>";
			require_once 'login_index.php';
			exit();
		}

		if(!isset($BIMSLoginError))
		{
			$sql_query2	= "SELECT * FROM bms_users WHERE  UserName='$BIMSUsername' AND Password ='$BIMSPassword' AND Active='1'";
			$sql2 = mysql_query($sql_query2)  or die (mysql_error());			
			$login_check = mysql_num_rows($sql2);
			
			if($login_check==1)
			{
				while($row = mysql_fetch_array($sql2))
				{
					foreach( $row AS $key => $val )
					{
						$$key = stripslashes( $val );
					}
				}					


				
				$_SESSION['log_UserID'] 				= $UserID;
				$_SESSION['logined_sections_SectionID'] = $sections_SectionID;	
				$_SESSION['log_Name'] 					= $Name;	
				$_SESSION['log_Username'] 				= $Username;
				////////////////////////////////////////////////////////////////////////////////////
				////////////////////////////////////////////////////////////////////////////////////
				//Successful login logs to the database for auditing
				$ProxyIP	= '';
				$IP			= '';
				$Environment= '';
								
				if($_SESSION['log_user_ip'] != '')
				{
					$IP			= $_SESSION['log_user_ip'];
					$ProxyIP	= $_SERVER['REMOTE_ADDR'];
				}
				else
				{
					$IP	= $_SERVER['REMOTE_ADDR'];
				}
				
				$Environment= $_SERVER['HTTP_USER_AGENT'];				
				$insert_login_log = "insert into bms_login_logs(users_UserID, IP, ProxyIP, Environment) values ( '$UserID' , '$IP','$ProxyIP' , '$Environment')";
				mysql_query($insert_login_log);						
				////////////////////////////////////////////////////////////////////////////////////
				////////////////////////////////////////////////////////////////////////////////////
				require_once 'global.php';
				$newpage3 = $pathprefix . "welcome.php";
				header("Location: $newpage3");
				exit();			
			}
			else
			{
				$BIMSLoginError="<b>Login Incorrect</b>";
				include 'login_index.php';
				exit();

			}		
		}
	}
}
?>
