<?php

	@session_start();
	include ("global.php");
	include ("top.php");
	if(isset($bms_Error)){ echo "!Error $bms_Error"; }

	echo "<head>";		
		echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"common/common.css\" />";
	echo "</head>";

	echo "<p class=\"hx1\">Welcome to BMS</p>";

	function previousAttemptAt($Username)
	{
		$sql = mysql_query("SELECT LastloginTime FROM bms_users  WHERE  UserName='$Username'");						
		$result1 = mysql_fetch_row($sql) ;
		$lastLogin=$result1[0];
		$sql = mysql_query("UPDATE bms_users SET LastloginTime =CURRENT_TIMESTAMP WHERE  UserName='$Username'");						
		return $lastLogin;
	}
	
	function previousAttemptIP($Username)
	{
		$sql = mysql_query("SELECT UserID FROM bms_users  WHERE  UserName='$Username'");						
		$result1 = mysql_fetch_row($sql) ;
		$userid=$result1[0];
		
		$ip = '';
		$sql2 = mysql_query("SELECT IP FROM bms_login_logs  WHERE  users_UserID='$userid'");
		$num_of_login	= mysql_num_rows($sql2);
		$temp_x	= 0;
		while($row_2 = mysql_fetch_array($sql2))
		{
			$temp_x++;
			if($temp_x<$num_of_login)
			{
				$ip	= $row_2['IP'];
			}
		}
		return $ip;
	}
?>
	<table cellpadding="0" cellspacing="0" border="0" width="100%" >
		<tr> 
			<TD class="bodytextred">
			<font color="#FF0000">
			<?php 
			
			$lastLogin		= previousAttemptAt($_SESSION['logined_UserName']); 			
			$Date = date_create($lastLogin);
			$Date	=  date_format($Date, 'l jS \of F Y h:i:s A');
			$lastLoginIP	= previousAttemptIP($_SESSION['logined_UserName']); 
			echo "<br> <br>";
			echo "<table class=\"bodytextred\"><tr>";
				echo "<td>";
					echo "<font color=\"#FF0000\">";
						echo "Last time you have login at";
					echo "</font>";
				echo "</td>";
				echo "<td>";
					echo "<font color=\"#FF0000\">";
						echo ":";
					echo "</font>";
				echo "</td>";
				echo "<td>";
					echo "<font color=\"#FF0000\">";
						echo $Date;
					echo "</font>";
				echo "</td>";
			echo "</tr><tr>";
				echo "<td>";
					echo "<font color=\"#FF0000\">";
						echo "Last time you have login from";
					echo "</font>";
				echo "</td>";
				echo "<td>";
					echo "<font color=\"#FF0000\">";
						echo ":";
					echo "</font>";	
				echo "</td>";
				echo "<td>";
					echo "<font color=\"#FF0000\">";
						echo $lastLoginIP;
					echo "</font>";
				echo "</td>";
			echo "</tr></table>";
			?>
			</font>
			</TD>
		</tr>
		<tr> 
			<TD align="left" class="" >&nbsp;</TD>
		</tr>
	</table>
    
<?php
include 'bottom.php';
?>
