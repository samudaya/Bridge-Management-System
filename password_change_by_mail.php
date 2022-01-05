<?php
@session_start();
include("global.php");


function generatePassword ($length = 8)
	{
		// start with a blank password
		$password = "";
		
		// define possible characters
		$possible = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"; 
		
		// set up a counter
		$i = 0; 
		
		// add random characters to $password until $length is reached
		while ($i < $length)
		{			
			// pick a random character from the possible ones
			$char = substr($possible, mt_rand(0, strlen($possible)-1), 1);

			// we don't want this character if it's already in the password
			if (!strstr($password, $char)) 
			{ 
				$password .= $char;
				$i++;
			}
		}
		return $password;
	}
	
	?>
	<html>
	<head>
	<title>...:: BIS 1.0 ::...</title>
	<style type="text/css">
	<!--
	.style1 {
		font-size: 24px;
		font-weight: bold;
	}
	.style5 {font-size: 14px; font-weight: bold; }
	.style7 {font-size: 11px}
	.style8 {font-size: 36px}
	.style9 {font-size: 12px}
	.style10 {font-size: 10px}
	-->
	</style>

	<link href="common/common.css" rel="stylesheet" type="text/css">

	<script type="text/javascript">
	function setFocus()
	{
		document.theForm.BIMSUsername.focus();
	}
	</script>

	</head>

	<body onload="setFocus()" >
	<div id="Layer2" style="position:absolute; width:800px; height:487px; z-index:9; left: 98px; top: 5px;" align="center">

	<table  width="100%"  border="0" align="left">
	  <tr>
		  <td width="800"  ><img src="images/topbanner.jpg"  width="800" align="left"></td>
	  </tr>

	  
	  <tr>
		  <td height="180"> 
		<table width="100%" border="0">
				<tr align="left" valign="middle"> 
				<td colspan="3">				
				</td>
				</tr>

			  </table>
		</td>
	  </tr>
		<tr>  
				<td>
					<div id="Layer6" style="position:absolute; width:804px; height:25px; z-index:5; left: 2px; top: 540px;">
					 <table  border="0" align="center">
						<tr class="bill-heading">
							<td colspan="7" width="800"><hr /></td>
						<tr/>						
					  </table>
					</div>
			
			
			
			
					
					<div id="Layer2" style="position:absolute; width:563px; height:103px; z-index:2; left: 170px; top: 180px;" >
						
					<?php	
						
		
		
		echo "<p  align=\"left\" class=\"hx1\" >Reset my BMS password</p>";
		
		
			echo "<table>";
			echo "<form name=\"fr_set_ass_per\" method=\"POST\" action=\"#\">";
				echo "<tr>";				
					echo "<td class=\"bodytextbold\">";
						echo "Username";
					echo "</td>";
					echo "<td>";
						echo ":";
					echo "</td>";
					echo "<td>";
							echo "<input type=\"text\" name=\"user_name\"  class=\"myselect3\"/>";
					echo "</td>";
					echo "<td>";
							echo "&nbsp;";
					echo "</td>";					
				echo "</tr>";
				
				echo "<tr>";				
					echo "<td class=\"bodytextbold\">";
						echo "E-mail";
					echo "</td>";
					echo "<td>";
						echo ":";
					echo "</td>";
					echo "<td>";
							echo "<input type=\"text\" name=\"email\" class=\"myselect3\"/>";
					echo "</td>";
					echo "<td class=\"bodytext\">";
					echo "</td>";					
				echo "</tr>";
				
				
				echo "<tr>";				
					echo "<td class=\"bodytextbold\">";
						echo "What is in image";
					echo "</td>";
					echo "<td>";
						echo ":";
					echo "</td>";
					echo "<td>";
							echo "<input type=\"text\" name=\"image_name\" class=\"myselect3\" />";
					echo "</td>";
					echo "<td>";
							echo "&nbsp;";
							echo "<img src=\"password_change_by_mail_random_image.php\">";
					echo "</td>";					
				echo "</tr>";
				
				
				echo "<tr>";				
					echo "<td>";
							echo "&nbsp;";
					echo "</td>";					
					echo "<td>";
							echo "&nbsp;";
					echo "</td>";
					echo "<td align=\"center\">";
						echo "<input type=\"submit\" name=\"reset_pasword\" value=\"Reset my password\" class=\"Submit_Button_Long_Long\" />";
					echo "</td>";					
					echo "<td>";
							echo "&nbsp;";
					echo "</td>";
				echo "</tr>";
				echo "</form>";
			echo "</table>";			
		

		
		if(isset($_POST['reset_pasword']))
		{
			$UserName		= mysql_real_escape_string($_POST['user_name']);
			$email			= mysql_real_escape_string($_POST['email']);
			$image_name		= mysql_real_escape_string($_POST['image_name']);
			
			$user_ok		= 0;
			$image_ok		= 0;
			
			$query_userx3 = "select UserID from bms_users where UserName = '".$UserName."'";
			$result_userx3 = mysql_query($query_userx3) or die (mysql_error());
			while($row_userx3 = mysql_fetch_array($result_userx3))
			{
				$UserID						= $row_userx3['UserID'];
			}

			if($image_name == $_SESSION['new_string'])
			{
				$image_ok	= 1;
			}
			
			
			$query_user = "select UserID from bms_users where Username= '".$UserName."' and eMail = '".$email."'";
			$result_user = mysql_query($query_user) or die (mysql_error());
			if(mysql_num_rows($result_user) == 1)
			{	
				$user_ok		= 1;
			}

			
			if(($user_ok == 1) and ($image_ok == 1))
			{
	
				$new_password	= generatePassword();
				//echo "<br />";
				$UserPassword	= md5($new_password);
				$update_password = "update bms_users set Password='$UserPassword' where UserID='".$UserID."'";
			//	echo "<br />";
				mysql_query($update_password) or die (mysql_error());
				
				$subject	= "BMS Password";
				$from		= "info@bms";
				$message	= '';
				$message	= "BMS has successfully changed your password.\n\n";
				$message	= $message. "New password : ".$new_password."\n";
				$message	= $message. "Please change your password as soon as possible.\n\n\n";
				$message	= $message. "Thank you,\n";
				$message	= $message. "BMS Team";
				
				mail($email, $subject, $message, "From: $from");
				
				////////////////////////////////////////////////////////////////////////////////////////////
				////////////////////////////////////////////////////////////////////////////////////////////
				////////////////////////////////////////////////////////////////////////////////////////////
				///////////////////// 			Log the query						////////////////////////		

				$Table_Name			= "bms_users";
				$SQL_Query			= "update bms_users set Password=\'$UserPassword\' where UserID=\'".$UserID."\'";
				$Action				= "Update";				
				$insert_log = "insert into bms_logs(users_UserID , TableName, SQLQuery, Action) values ('$UserID' , '$Table_Name','$SQL_Query' , '$Action')";
				mysql_query($insert_log);		
				////////////////////////////////////////////////////////////////////////////////////////////
				////////////////////////////////////////////////////////////////////////////////////////////
				////////////////////////////////////////////////////////////////////////////////////////////
				echo "<strong><font color='#0000FF'    class=\"bodytext\">Your new password sent via email .......</font></strong>";
			}
			else
			{
				echo "<strong><font color='#FF0000'    class=\"bodytext\">Process unsuccessful .......</font></strong>";
			}
		}
		
		
		
		//echo "<hr/>";
		
		echo "<br />";
		echo "<p   align=\"left\" class=\"hx1\" >E-mail my BMS username</p>";
		
		
			echo "<table>";
			echo "<form name=\"fr_set_ass_per\" method=\"POST\" action=\"#\">";
				echo "<tr>";				
					echo "<td class=\"bodytextbold\">";
						echo "E-mail";
					echo "</td>";
					echo "<td>";
						echo ":";
					echo "</td>";
					echo "<td>";
							echo "<input  class=\"myselect3\" type=\"text\" name=\"email\" />";
					echo "</td>";
					echo "<td class=\"bodytext\">";
					echo "</td>";					
				echo "</tr>";
				
							
				
				
				
				echo "<tr>";				
					echo "<td class=\"bodytextbold\">";
						echo "What is in image";
					echo "</td>";
					echo "<td>";
						echo ":";
					echo "</td>";
					echo "<td>";
							echo "<input class=\"myselect3\" type=\"text\" name=\"image_name\" />";														
					echo "</td>";
					echo "<td>";
						echo "&nbsp;";
						echo "<img src=\"password_change_by_mail_random_image.php\">";
					echo "</td>";					
				echo "</tr>";									
				
				
				echo "<tr>";
					echo "<td>";
						echo "&nbsp;";
					echo "</td>";
					echo "<td>";
						echo "&nbsp;";
					echo "</td>";
					echo "<td  align=\"center\">";
						echo "<input type=\"submit\" name=\"reset_username\" value=\"Send my username\" class=\"Submit_Button_Long_Long\" />";
					echo "</td>";
					echo "<td>";
						echo "&nbsp;";
					echo "</td>";
				echo "</tr>";
			echo "</form>"; 
			echo "</table>";			
		
		//echo "<br />";
		
		if(isset($_POST['reset_username']))
		{
			$email				= mysql_real_escape_string($_POST['email']);
			$image_name			= mysql_real_escape_string($_POST['image_name']);
			
		

			$image_ok		= 0;
			$mail_sent		= 0;
			if($image_name == $_SESSION['new_string'])
			{
				$image_ok	= 1;
			}	
			
			if($image_ok == 1)
			{
				if($mail_sent == 0)
				{
					$query_user = "select * from bms_users where eMail = '".$email."'";
					$result_user = mysql_query($query_user) or die (mysql_error());
					if(mysql_num_rows($result_user) == 1)
					{	
						while($row_user = mysql_fetch_array($result_user))
						{
							$UserID						= $row_user['UserID'];
							$UserName					= $row_user['Username'];
						}
										
						$subject	= "BMS Username";
						$from		= "info@bms";
						$message	= '';
						$message	= $message. "Your Username : ".$UserName."\n\n";
						$message	= $message. "Thank you,\n";
						$message	= $message. "BMS Team";
						
						mail($email, $subject, $message, "From: $from");
					
						////////////////////////////////////////////////////////////////////////////////////////////
						////////////////////////////////////////////////////////////////////////////////////////////
						////////////////////////////////////////////////////////////////////////////////////////////
						///////////////////// 			Log the query						////////////////////////		
						$Table_Name			= "bms_users";
						$SQL_Query			= "";
						$Action				= "Request Username";			
						$insert_log = "insert into mis_exam_log(uomuser_UserID, Table_Name, SQL_Query, Action) values ('$UserID' , '$Table_Name','$SQL_Query' , '$Action')";
						mysql_query($insert_log);		
						////////////////////////////////////////////////////////////////////////////////////////////
						////////////////////////////////////////////////////////////////////////////////////////////
						////////////////////////////////////////////////////////////////////////////////////////////
						echo "<strong><font color='#0000FF'    class=\"bodytext\">Your BMS Username sent via e-mail .......</font></strong>";
						$mail_sent = 1;
					}
					else
					{						echo "<strong><font color='#FF0000'    class=\"bodytext\">Process unsuccessful .......</font></strong>";
					
					}
				}
				else
				{				
					echo "<strong><font color='#FF0000'    class=\"bodytext\">Process unsuccessful .......</font></strong>";
					
				}
			}
			else
			{
				echo "<strong><font color='#FF0000'    class=\"bodytext\">Process unsuccessful .......</font></strong>";

			}
		}
?>
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
					</div>	
						
					
					
		
					<div id="Layer7" style="position:absolute; width:631px; height:12px; z-index:6; left: 200px; top: 555px;">
					<DIV class="bodytextbold">
					<EM>&copy; Bridge Management System</EM></DIV>
					</div>
				</td>
		</tr>
	</table>
	</div>

	<div id="Layer9" style="position:absolute; width:640px; height:91px; z-index:8; left: 103px; top: 515px;">
		<div align="justify"> 
			<table width="800" class="bodytext" cellpadding="0" cellspacing="0">
				<tr> 
					<td align="center" class="errortext">
						<font size="2">
							Welcome to the Bridge Management System......<br /><br />
							
						</font>
					</td>
				</tr>
			</table>
		</div>
	</div>

		
		
	</body>
	</html>