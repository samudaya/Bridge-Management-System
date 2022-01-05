<?php
	include ("../global.php");
	include ("../top.php");

	echo "<head>";

	echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"../common/common.css\" />

	<link rel=\"stylesheet\" href=\"../lib/ajax/mSuggest.css\" type=\"text/css\" />
	<script src=\"../lib/ajax/mTools.js\"></script>
	<script src=\"../lib/ajax/mSuggest.js\"></script>	";
?>
	
<?php	
	echo "</head>";
	
	echo "<p class=\"hx1\">View Users</p>";

	if(!isset($_POST['formHidden'])){
	echo "<form name=\"searchform\" id=\"searchform\" action=\"#\" method=\"post\">";
		$bsr = array();
		$counterA=0;
		$query_bsr = "select * from bms_users";        
		$result_bsr = mysql_query($query_bsr) or die (mysql_error());
		while($row_user = mysql_fetch_array($result_bsr))
		{
			$bsr[$counterA++]    = $row_user['Username'];
		}
		
				
		
		
		$query_bsr = "select * from bms_users";        
		$result_bsr = mysql_query($query_bsr) or die (mysql_error());
		while($row_user = mysql_fetch_array($result_bsr))
		{
			$bsr[$counterA++]    = $row_user['FirstName']." (Username : ".$row_user['Username'].")";
		}
		
		
		$query_bsr = "select * from bms_users";        
		$result_bsr = mysql_query($query_bsr) or die (mysql_error());
		while($row_user = mysql_fetch_array($result_bsr))
		{
			$bsr[$counterA++]    = $row_user['LastName']." (Username : ".$row_user['Username'].")";
		}
		
		$query_bsr = "select * from bms_users";        
		$result_bsr = mysql_query($query_bsr) or die (mysql_error());
		while($row_user = mysql_fetch_array($result_bsr))
		{
			$bsr[$counterA++]    = $row_user['NameWithInitials']." (Username : ".$row_user['Username'].")";
		}
		
	echo "
		<table class=\"bodytext\">
		<tr>
			<td class=\"mytd\">
				Search Users
			</td>
			<td class=\"mytd\">
				<input type=\"text\"  name=\"SearchString\" size=\"40\" id=\"SearchString\" class=\"inputText\" rel=\"Suggest\" size=\"35\" autocomplete=\"off\" data=\""; for($i=0;$i<count($bsr);$i++){ echo $bsr[$i].",";} echo "\" onkeyup=\"chk_empty_search()\"/>
			</td>
			<td class=\"mytd\">
				<input name=\"go\"  type=\"submit\"  class=\"Submit_Button_Long\" id=\"bms_Search\" value=\"Select\" />
			</td>
			<td><span id=\"SearchString_id\" class=\"bodytextred\"></span></td>	
		</tr>	
		</table>
		</form>";	
		
		if (isset($_POST['SearchString']) ){
	
		
		$elements               = array();
		$separator              = "(";
		$elements               = explode($separator, $_POST['SearchString']);

		if($elements['1'] == '' or !isset($elements['1']))
		{
			$searchUsername =  $elements['0'];		
		}
		else
		{
		
			$separator = "Username : ";			
			$elements       = explode($separator, $elements['1']);			
			$searchUsername =  $elements['1'];
			
			
			
			$separator = ")";			
			$elements       = explode($separator, $searchUsername);			
			$searchUsername =  $elements['0'];
			
		}

		$query_bsr_resource = "select * from bms_users where Username=\"".$searchUsername."\"";        
		$result_bsr_resource = mysql_query($query_bsr_resource) or die (mysql_error());
		$result_bsr_resource_rows = mysql_num_rows ( $result_bsr_resource );
		
			while($row_bsr = mysql_fetch_array($result_bsr_resource))
			{			
				$userID			= $row_bsr['UserID'];
				$firstName 		= $row_bsr['FirstName'];
				$lastName		= $row_bsr['LastName'];
				$userName		= $row_bsr['Username'];
				$Address		= $row_bsr['Address'];
				
				$telephone		= $row_bsr['TeleNum'];
				$email			= $row_bsr['eMail'];
				$status			= $row_bsr['Active'];
				$title			= $row_bsr['Title'];	
				$nameWithInitials	= $row_bsr['NameWithInitials'];						
			}	
	

			if ($result_bsr_resource_rows>0){
				echo "
					
					  <table class=\"bodytext\">
					  <tr>
							<td colspan=\"2\" class=\"mytd\" align=\"center\"><b>Profile</b></td>
							
						</tr>
						
					  <tr>
							<td class=\"mytd\">Username</td>
							<td class=\"mytd\">".$userName."</td>
						</tr>
						
						<tr>
							<td class=\"mytd\">Title</td>
							<td class=\"mytd\">";
								echo $title;
								echo "
							</td>
							<td><span id=\"title_id\" class=\"bodytextred\"></span></td>
						</tr>
						
						<tr>
							<td class=\"mytd\">First Name</td>
							<td  class=\"mytd\">";
							echo $firstName;
								echo "
							</td>
						</tr>
						<tr>
							<td class=\"mytd\">Last Name</td>
							<td  class=\"mytd\">";
							echo $lastName;
								echo "
							</td>
						</tr>
						<tr>
							<td class=\"mytd\">Name With Initials</td>
							<td  class=\"mytd\">";
							echo $nameWithInitials;
								echo "
							</td>
						</tr>	
						<tr>
							<td class=\"mytd\">Telephone Number</td>
							<td  class=\"mytd\">";
							echo $telephone;
								echo "
							</td>
						</tr>
						<tr>
							<td class=\"mytd\">Email</td>
							
							<td  class=\"mytd\">";
							echo $email;
								echo "
							</td>
							
						</tr>

						<tr>
							<td class=\"mytd\">Address</td>							
							
							<td  class=\"mytd\" >";
							echo $Address;
								echo "
							</td>
							
						</tr>
			
			
						<tr>
							<td class=\"mytd\">Status</td>
							<td class=\"mytd\">";
								if($status=="1")
								{
									echo "Active";
								}
								else
								{
									echo "Deactive";
								}
								
								echo "
							</td>
						</tr>	
						
						
						
						
						<tr>
							<td colspan=\"2\" class=\"mytd\">&nbsp;</td>
							
						</tr>
						
						
						<tr>
							<td colspan=\"2\" class=\"mytd\" align=\"center\"><b>Privileges</b></td>
							
						</tr>";
						
						$query_bsr_resourcex = "select * from bms_usertypes order by UserType";        
						$result_bsr_resourcex = mysql_query($query_bsr_resourcex) or die (mysql_error());
						$result_bsr_resource_rowsx = mysql_num_rows ( $result_bsr_resourcex );					
						while($row_bsrx = mysql_fetch_array($result_bsr_resourcex))
						{			
							$UserType			= $row_bsrx['UserType'];
							$UserTypeID	 		= $row_bsrx['UserTypeID'];
							
							echo "<tr>";						
								echo "<td class=\"mytd\">";
									echo $UserType;
								echo "</td>";
								
								echo "<td class=\"mytd\" align=\"center\" width=\"350\">";
									$query_bsr_resourcexx = "select * from bms_users_usertypes where users_UserID=".$userID." and usertypes_UserTypeID=".$UserTypeID;        
									$result_bsr_resourcexx = mysql_query($query_bsr_resourcexx) or die (mysql_error());
									$result_bsr_resource_rowsxx = mysql_num_rows ( $result_bsr_resourcexx );
									if($result_bsr_resource_rowsxx > 0)
									{
										echo "<img src=\"".$pathprefix."images/yes_image.png\" height=\"11%\" />";
									}
									else
									{
										echo "<img src=\"".$pathprefix."images/no_image.png\" height=\"9%\" />";
									}
									
								echo "</td>";
								
							echo "<tr>";
								
						}
					echo "</table>
							
				";
			}else{
					
					echo "<p class=\"bodytextsus\">Error.... No such a user.</p>";
			}
		}
	}
	include '../bottom.php';
	
?>