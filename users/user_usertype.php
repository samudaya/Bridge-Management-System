<?php
@session_start();
	include ("../global.php");
	include ("../top.php");

	
?>
	<head>
	<link href="../common/common.css" rel="stylesheet" type="text/css">

	<link rel="stylesheet" href="../lib/ajax/mSuggest.css" type="text/css" />
	<script src="../lib/ajax/mTools.js"></script>
	<script src="../lib/ajax/mSuggest.js"></script>	
	</head>
	<?php
echo "<p class=\"hx1\">Manage User Roles</p>";

$username = array();
$counterA=0;
$query_user = "SELECT *  FROM  bms_users";	
$result_user = mysql_query($query_user) or die (mysql_error());
while($row_user = mysql_fetch_array($result_user))
{
	$username[$counterA++]	= $row_user['Username'];
}

				
echo "<form name=\"firstform1\" autocomplete=\"off\"  method=\"post\">
		<table class=\"bodytext\">
		<tr>
			<td class=\"mytd\" width=\"175\" class=\"mytd\">
			Search User
			</td>
			<td class=\"mytd\">";
			?>
			<input type="text"  class="mytextbox3" name="SearchString" id="SearchString"  rel="Suggest"  autocomplete="off" data="<?php for($i=0;$i<count($username);$i++) echo $username[$i].","; ?>" />
		    <?php
			echo "</td>
			<td class=\"mytd\">
			<input name=\"bms_Search\"  type=\"submit\"  class=\"Submit_Button_Long\" id=\"bms_Search\" value=\"Search\" />
			</td>		
		</tr>	
		</table>
		</form>";


	if(isset($_POST['hiddenUserID']))
	{
		$mysql_result3 = mysql_query("SELECT *  FROM  bms_usertypes");
		while ($row3 = mysql_fetch_array($mysql_result3)) 
		{
			foreach ($row3 AS $key => $val) 
			{
				$$key = stripslashes($val);
			}
			$UserIDx	= $_POST['hiddenUserID'];
			
			$cc= "uttype_".$UserTypeID;
			if(isset($_POST[$cc]))
			{
				$q31 = "INSERT INTO bms_users_usertypes VALUES (null, '$UserIDx','$UserTypeID')";
				$sql_QU=mysql_query($q31);
			
				///////////////////////////////////////////////////////////////////////
				///////////////////// 			Log the query							
				$users_UserID		= $_SESSION['log_UserID'];
				$Table_Name			= "bms_users_usertypes";
				$SQL_Query			= "INSERT INTO bms_users_usertypes VALUES (null, \'$users_UserID\',\'$UserTypeID\')";
				$Action				= "INSERT";								
				$insert_log = "insert into bms_logs(users_UserID, TableName, SQLQuery, Action) values ('$users_UserID' , '$Table_Name','$SQL_Query' , '$Action')";
				mysql_query($insert_log);		
				///////////////////////////////////////////////////////////////////////
				///////////////////////////////////////////////////////////////////////
			}
			else
			{
				$q4321 = "DELETE FROM bms_users_usertypes WHERE users_UserID ='$UserIDx' AND usertypes_UserTypeID='$UserTypeID'";
				$sql_QU=mysql_query($q4321);
				///////////////////////////////////////////////////////////////////////
				///////////////////////////////////////////////////////////////////////
				///////////////////// 			Log the query						
				$users_UserID		= $_SESSION['log_UserID'];
				$Table_Name			= "bms_users_usertypes";
				$SQL_Query			= "DELETE FROM bms_users_usertypes WHERE users_UserID =\'$users_UserID\' AND usertypes_UserTypeID=\'$UserTypeID\'";
				$Action				= "DELETE";		
				$insert_log = "insert into bms_logs(users_UserID, TableName, SQLQuery, Action) values ('$users_UserID' , '$Table_Name','$SQL_Query' , '$Action')";
				mysql_query($insert_log);		
				///////////////////////////////////////////////////////////////////////
				///////////////////////////////////////////////////////////////////////
				///////////////////////////////////////////////////////////////////////
			}
		}
		echo "<p class=\"bodytextsus\" >Successfully saved ...</p>";
	}

	
	
	if(isset($_POST['bms_Search']) and $_POST['SearchString'] !='')
	{
		echo "<form  name=\"fomr3\" method=\"post\">";
		
		$UserIDx = '';
		$mysql_result1 = mysql_query("SELECT *  FROM  bms_users    
														WHERE Username =\"".$_POST['SearchString']."\"");
		while ($row = mysql_fetch_array($mysql_result1)) 
		{
		
			$UserIDx 	= $row['UserID'];
			$Name		= $row['NameWithInitials'];
			$Username	= $row['Username'];
		}

		if($UserIDx > 0)
		{
			?>
			<table>
					<tr> 
					<td class="myth" align="center">User Name</td>
					<td  class="myth">Name</td><?php
			$mysql_result2 = mysql_query("SELECT *  FROM  bms_usertypes");
			while ($row = mysql_fetch_array($mysql_result2)) 
			{
				foreach ($row AS $key => $val) 
				{
					$$key = stripslashes($val);
				}
				echo "<td  class=\"myth\">".$UserType."</td>";		
			}
			echo "</tr>";
			echo "<tr>";
			echo "<td  class=\"mytd\" >".$Username."</td>";	
			echo "<td  class=\"mytd\" width=\"175\">".$Name."</td>";
			
			$myx = 2;
			$mysql_result2 = mysql_query("SELECT *  FROM  bms_usertypes");
			while ($row = mysql_fetch_array($mysql_result2)) 
			{
				foreach ($row AS $key => $val) 
				{
					$$key = stripslashes($val);
				}
				echo "<td  align=\"center\" class=\"mytd\">";
					echo "<input name=\"uttype_".$UserTypeID."\" value=\"".$UserTypeID."\" type=\"checkbox\" ";
					$q1212	= "SELECT *  FROM  bms_users_usertypes where users_UserID=".$UserIDx." and usertypes_UserTypeID=".$UserTypeID."";
					$mysql_result3 = mysql_query($q1212);
					if(mysql_num_rows($mysql_result3) == 1) 
					{  
						echo "  checked "; 
					} 
					
					echo " />";
				echo "</td>";
				
				$myx++;
			}
			echo "</tr>";
			echo "<tr>";
			echo "<td  align=\"center\" colspan=\"".$myx."\" class=\"mytd\">";
				echo "<input type=\"hidden\" value=\"".$UserIDx."\" name=\"hiddenUserID\">";
					?><input name="Change_User_Type"  type="submit"  class="Submit_Button_Long_Long" id="bms_Search" value="Save"><?php
				echo "</td>";
			echo "</tr>";	
			echo "</table>";
		}
		echo "</form>";
	}
include '../bottom.php';
?>