<?php
@session_start();
require_once '../global.php';

if(!isset($_SESSION['log_UserID']))
{
	header("Location: $pathprefix");
	exit();
}
include '../top.php';
?>
	<head>
	<link href="../common/common.css" rel="stylesheet" type="text/css">

	<link rel="stylesheet" href="../lib/ajax/mSuggest.css" type="text/css" />
	<script src="../lib/ajax/mTools.js"></script>
	<script src="../lib/ajax/mSuggest.js"></script>	
	</head>
	<?php
echo "<p class=\"hx1\">User Type Administration</p>";

		
?><form action="privilege_manage.php"  autocomplete="off"   method="post">
<table class="BodyText"> 
	<tr> 		
	    <td class="mytd" align="left" class="bodytextbold">Privilage Description </td>
	    <td  class="mytd" align="left"> 			
				<?php
				$username = array();
				$counterA=0;
				$query_user = "select Description from bms_privileges";		//Chechk user is availble
				$result_user = mysql_query($query_user) or die (mysql_error());
				while($row_user = mysql_fetch_array($result_user))
				{
					$username[$counterA++]	= $row_user['Description'];
				}
				?>
		        <input type="text"  class="mytextbox3" name="SearchString" id="SearchString" class="inputText" rel="Suggest"  autocomplete="off" data="<?php for($i=0;$i<count($username);$i++) echo $username[$i].","; ?>" />
		        <input type="hidden" value="22" name="BIMSState">
		</td>
		<td class="mytd" >
		        <input name="bms_Search"  type="submit"  class="Submit_Button_Long" id="bms_Search" value="Search" />
	        
		</td>

	</tr>
	</table>   
			</form>	
		
	<?php
	if(isset($_POST['BIMSState']) and $_POST['BIMSState']==22) 
	{
		$_SESSION['bms_SearchString']=$_POST['SearchString'];
	}
	else
	{
		if(!isset($_SESSION['bms_SearchString']))
		{
			$_SESSION['bms_SearchString']="";
		}
		else
		{
			$_SESSION['bms_SearchString']="This is To Disable";
		}
	}
	if(isset($_POST['BIMSState']) and $_POST['BIMSState']==22) 
	{
		if(isset($Change_User_Type))
		{
				echo "<p class=\"bodytextsus\" >Successfully saved...</p>";
		}
	 	?>

		
		<form action="privilege_manage.php" method="post">
		<table cellpadding="0" cellspacing="0" border="0" class="bodytext" width="100%"> 
	    	<?php
			$n=0;	
			$q11xcv	= "SELECT PrivilegeID, Description   FROM  bms_privileges WHERE Description  LIKE  \"%".$_SESSION['bms_SearchString']."%\"  ORDER BY PrivilegeID ";
			$mysql_result1xcv = mysql_query($q11xcv);
			while($rowxcv = mysql_fetch_array($mysql_result1xcv))
			{
				$PrivilegeIDx	= $rowxcv['PrivilegeID'];
				$Descriptionx	= $rowxcv['Description'];
				
				//////////////////////////////////////////////////////////////////////////////////////////////////
				//////////////////////// 		Start the repeating top row			////////////////////////////////////					
				if($n%8 ==0)
				{
				?>
					<tr > 
						<td class="myth" align="center"><strong>ID</strong></td>
						<td  class="myth" align="center"><strong>Description</strong></td>
						<?php						
							//Display USer Groups
							$myqxx	= "SELECT *   FROM bms_usertypes  ORDER BY UserTypeID";
							$mysql_UserTypesxx = mysql_query($myqxx);
							while($rowxx = mysql_fetch_array($mysql_UserTypesxx))
							{
								$UserTypexx	= $rowxx['UserType'];
						?>
								<td  class="myth" align="center"><strong><?php echo "$UserTypexx"; ?></strong>
								</td>
							<?php
							}
							?>
						<td   class="myth" align="center"><strong>Description</strong></td>
						<td  class="myth" align="center"><strong>ID</strong></td>
					</tr>
					
				<?php
				}
				$n=$n+1;
			
				/////////////////////////////////////////////////////////////////////
				/////////////////////////////
				//////////////////////// 		End the repeating top row			////////////////////////////////////										
				?>
			
				<tr> 
					<td  width="69"  class="<?php if($n%2==1) echo "mytd"; else  echo "altmytd"; ?>" > 
						<?php  echo "$PrivilegeIDx"; ?>
					</td>
					<td   class="<?php if($n%2==1) echo "mytd"; else  echo "altmytd"; ?>" > 
						<?php  echo "$Descriptionx"; ?>
					</td>
					   
					<?php
					
					$q22	= "SELECT * FROM bms_usertypes ORDER BY UserTypeID";
					$mysql_UserTypesx = mysql_query($q22);
					//echo mysql_error() ;
					while($row = mysql_fetch_array($mysql_UserTypesx))
					{
						foreach( $row AS $key => $val )
						{
							$$key = stripslashes( $val );
						}
						
						$cc= "UserType_".$PrivilegeIDx."_".$UserTypeID."";					
						if(isset($_POST['Change_User_Type']))
						{	
							if(isset($_POST[$cc]))
							{
								
								$Values=1;
								$q31 = "INSERT INTO bms_usertypes_privileges VALUES (null, '$UserTypeID','$PrivilegeIDx')";
								$sql_QU=mysql_query($q31);
							
								///////////////////////////////////////////////////////////////////////
								///////////////////// 			Log the query							
								$users_UserID		= $_SESSION['log_UserID'];
								$Table_Name			= "bms_usertypes_privileges";
								$SQL_Query			= "INSERT INTO bms_usertypes_privileges VALUES (null, \'$UserTypeID\',\'$PrivilegeIDx\')";
								$Action				= "INSERT";								
								$insert_log = "insert into bms_logs(users_UserID, TableName, SQLQuery, Action) values ('$users_UserID' , '$Table_Name','$SQL_Query' , '$Action')";
								mysql_query($insert_log);		
								///////////////////////////////////////////////////////////////////////
								///////////////////////////////////////////////////////////////////////
							}
							else
							{
								$Values=0;
								$q4321 = "DELETE FROM bms_usertypes_privileges WHERE privileges_PrivilegeID ='$PrivilegeIDx' AND usertypes_UserTypeID='$UserTypeID'";
								$sql_QU=mysql_query($q4321);
								///////////////////////////////////////////////////////////////////////
								///////////////////////////////////////////////////////////////////////
								///////////////////// 			Log the query						
								$users_UserID		= $_SESSION['log_UserID'];
								$Table_Name			= "bms_usertypes_privileges";
								$SQL_Query			= "DELETE FROM bms_usertypes_privileges WHERE privileges_PrivilegeID =\'$PrivilegeIDx\' AND usertypes_UserTypeID =\'$UserTypeID\'";
								$Action				= "DELETE";		
								$insert_log = "insert into bms_logs(users_UserID, TableName, SQLQuery, Action) values ( '$users_UserID' , '$Table_Name','$SQL_Query' , '$Action')";
								mysql_query($insert_log);		
								///////////////////////////////////////////////////////////////////////
								///////////////////////////////////////////////////////////////////////
								///////////////////////////////////////////////////////////////////////
							}
						}
						?>						
						<td align="center" class="<?php if($n%2==1) echo "mytd"; else  echo "altmytd"; ?>" >
							<input name="UserType_<?php  echo "$PrivilegeIDx"; ?>_<?php echo $UserTypeID; ?>" type="checkbox" value="<?php  echo $UserTypeID; ?>"<?php 
							$q22xxxx	= "SELECT *   FROM  bms_usertypes_privileges where 	usertypes_UserTypeID  = '$UserTypeID' AND privileges_PrivilegeID  ='$PrivilegeIDx'";
							$mysql_UserTypesxss = mysql_query($q22xxxx);							
							if(mysql_num_rows($mysql_UserTypesxss) == 1) 
							{  
								echo "  checked "; 
							} 
							?> /> 
						</td>
						<?php
					}
					?>
					
					<td  class="<?php if($n%2==1) echo "mytd"; else  echo "altmytd"; ?>" > 
						<?php  echo "$Descriptionx"; ?>
					</td>
					<td  width="69" align="left" class="<?php if($n%2==1) echo "mytd"; else  echo "altmytd"; ?>"  > 
						<?php  echo "$PrivilegeIDx"; ?>
					</td>					
				</tr>
				<?php				
			}
			?>
			<input type="hidden" value="22" name="BIMSState">
			<input type="hidden" name="SearchString" id="SearchString" class="inputText"  value="<?php echo $_SESSION['bms_SearchString']; ?>">
			
			<tr> 
				<TD></TD>
				<TD><br /><input name="Change_User_Type"  type="submit"  class="Submit_Button_Long_Long" id="bms_Search" value="Save"></TD>
			</tr>
		</table>
		</form>
	
	
	<?php
	}
	
	include '../bottom.php';
?>
