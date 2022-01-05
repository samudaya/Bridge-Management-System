<?php
	session_start();
	include ("../global.php");
	include ("../top.php");

$BridgeProfileID	= 0;
if(isset($_POST['SearchString']) )
{
	$elements               = array();
	$separator              = "(";
	$elements               = explode($separator, $_POST['SearchString']);

	if($elements['1'] == '' or !isset($elements['1']))
	{
		$searchUsername =  $elements['0'];		
	}
	else
	{
	
		$separator = "Structure ID : ";			
		$elements       = explode($separator, $elements['1']);			
		$searchUsername =  $elements['1'];
		
		
		
		$separator = ")";			
		$elements       = explode($separator, $searchUsername);			
		$searchUsername =  $elements['0'];
		
	}

	$query_bsr_resource = "select * from bms_bridgeprofiles where StructureID=\"".$searchUsername."\" and sections_SectionID=".$_SESSION['logined_sections_SectionID'];        
	$result_bsr_resource = mysql_query($query_bsr_resource) or die (mysql_error());
	$result_bsr_resource_rows = mysql_num_rows ( $result_bsr_resource );			
	while($row_bsr = mysql_fetch_array($result_bsr_resource))
	{			
		foreach($row_bsr AS $key => $val )
		{
			 $$key = stripslashes( $val );
		}				
	}



	$query_bsr_resource = "select * from bms_operationalstatusesrecord where bridgeprofile_BridgeProfileID=".$BridgeProfileID;        
	$result_bsr_resource = mysql_query($query_bsr_resource) or die (mysql_error());
	$result_bsr_resource_rows = mysql_num_rows ( $result_bsr_resource );			
	while($row_bsr = mysql_fetch_array($result_bsr_resource))
	{			
		foreach($row_bsr AS $key => $val )
		{
			 $$key = stripslashes( $val );
		}				
	}
	
	
	$query_bsr_resource = "select * from bms_bridgeprofileattachments where bridgeprofile_BridgeProfileID=".$BridgeProfileID;        
	$result_bsr_resource = mysql_query($query_bsr_resource) or die (mysql_error());
	$result_bsr_resource_rows = mysql_num_rows ( $result_bsr_resource );			
	while($row_bsr = mysql_fetch_array($result_bsr_resource))
	{			
		foreach($row_bsr AS $key => $val )
		{
			 $$key = stripslashes( $val );
		}				
	}
	
	
	$spanmaterials_SpanMaterialID_spgrou[$i] 		= array();
	$spantypes_SpanTypeID_spgroup					= array();	
	$SpanLength_spgroup								= array();			
	$YearOfConstruction_spgroup 					= array();
	$deckmaterials_DeckMaterialID_deck				= array();
	$desksurfacetypes_DeskSurfaceTypeID_deck		= array();
	$DeckSurfaceThickness_deck						= array();				
	$YearOfConstruction_deck						= array();
	$piermaterials_PierMaterialID_sub_pier			= array();
	$piertypes_PierTypeID_sub_pier					= array();
	$abutmentmaterials_AbutmentMaterialID_sub_abunt	= array();
	$abutmenttypes_SpanTypeID_sub_abunt				= array();
	$wingmaterials_WingMaterialID_sub_ww			= array();
	$wingtypes_WingTypeID_sub_ww					= array();
	$piermaterials_PierMaterialID_foun_pier			= array();
	$piertypes_PierTypeID_foun_pier					= array();
	$abutmentmaterials_AbutmentMaterialID_foun_abunt= array();
	$abutmenttypes_SpanTypeID_foun_abunt			= array();
	$wingmaterials_WingMaterialID_foun_ww			= array();
	$wingtypes_WingTypeID_foun_ww					= array();
	$ThicknessCappingLevel							= array();	
	$WingWallLenth									= array();	
	
	
	$i	= 0;
	$query_bsr_resource = "select * from bms_abutmentfoundations where bridgeprofile_BridgeProfileID=".$BridgeProfileID." order by AbutmentNumber";        
	$result_bsr_resource = mysql_query($query_bsr_resource) or die (mysql_error());
	while($row_bsr = mysql_fetch_array($result_bsr_resource))
	{	
		$i++;
		$abutmenttypes_SpanTypeID_foun_abunt[$i]					= $row_bsr['abutmentfoundationtypes_AbutmentFoundationTypeID'];
		$abutmentmaterials_AbutmentMaterialID_foun_abunt[$i]		= $row_bsr['abutmentfoundationmaterials_AbutmentFoundationMaterialID'];
	}
	
	$i	= 0;
	$query_bsr_resource = "select * from bms_abutments where bridgeprofile_BridgeProfileID=".$BridgeProfileID." order by AbutmentNumber";        
	$result_bsr_resource = mysql_query($query_bsr_resource) or die (mysql_error());
	while($row_bsr = mysql_fetch_array($result_bsr_resource))
	{	
		$i++;
		$abutmentmaterials_AbutmentMaterialID_sub_abunt[$i]	= $row_bsr['abutmentmaterials_AbutmentMaterialID'];
		$abutmenttypes_SpanTypeID_sub_abunt[$i]				= $row_bsr['abutmenttypes_AbutmentTypeID'];
	}
	
	
	$i	= 0;
	$query_bsr_resource = "select * from bms_spangroup where bridgeprofile_BridgeProfileID=".$BridgeProfileID." order by SpanNumber";        
	$result_bsr_resource = mysql_query($query_bsr_resource) or die (mysql_error());
	while($row_bsr = mysql_fetch_array($result_bsr_resource))
	{	
		$i++;
		$YearOfConstruction_spgroup[$i]			= $row_bsr['YearOfConstruction'];
		$SpanLength_spgroup[$i]					= $row_bsr['SpanLength'];
		$spanmaterials_SpanMaterialID_spgrou[$i]= $row_bsr['spanmaterials_SpanMaterialID'];
		$spantypes_SpanTypeID_spgroup[$i]		= $row_bsr['spantypes_SpanTypeID'];
	}
	
	
	$i	= 0;
	$query_bsr_resource = "select * from bms_decks where bridgeprofile_BridgeProfileID=".$BridgeProfileID." order by DeckNumber";        
	$result_bsr_resource = mysql_query($query_bsr_resource) or die (mysql_error());
	while($row_bsr = mysql_fetch_array($result_bsr_resource))
	{	
		$i++;
		$YearOfConstruction_deck[$i]				= $row_bsr['YearOfConstruction'];
		$DeckSurfaceThickness_deck[$i]				= $row_bsr['DeckSurfaceThickness'];
		$deckmaterials_DeckMaterialID_deck[$i]		= $row_bsr['deckmaterials_DeckMaterialID'];
		$desksurfacetypes_DeskSurfaceTypeID_deck[$i]= $row_bsr['desksurfacetypes_DeskSurfaceTypeID'];
	}
	
	
	
	$i	= 0;
	$query_bsr_resource = "select * from bms_piers where bridgeprofile_BridgeProfileID=".$BridgeProfileID." order by PierNumber";        
	$result_bsr_resource = mysql_query($query_bsr_resource) or die (mysql_error());
	while($row_bsr = mysql_fetch_array($result_bsr_resource))
	{	
		$i++;
		$piertypes_PierTypeID_sub_pier[$i]				= $row_bsr['piertypes_PierTypeID'];
		$piermaterials_PierMaterialID_sub_pier[$i]		= $row_bsr['piermaterials_PierMaterialID'];
		$ThicknessCappingLevel[$i]						= $row_bsr['ThicknessCappingLevel'];
	}
	
	
	$i	= 0;
	$query_bsr_resource = "select * from bms_wingwalls where bridgeprofile_BridgeProfileID=".$BridgeProfileID." order by WingWallPosition";        
	$result_bsr_resource = mysql_query($query_bsr_resource) or die (mysql_error());
	while($row_bsr = mysql_fetch_array($result_bsr_resource))
	{	
		$i++;
		$wingtypes_WingTypeID_sub_ww[$i]				= $row_bsr['wingtypes_WingTypeID'];
		$wingmaterials_WingMaterialID_sub_ww[$i]		= $row_bsr['wingmaterials_WingMaterialID'];
		$WingWallLenth[$i]								= $row_bsr['WingWallLenth'];
	}
	
	
	$i	= 0;
	$query_bsr_resource = "select * from bms_pierfoundations where bridgeprofile_BridgeProfileID=".$BridgeProfileID." order by PierNumber";        
	$result_bsr_resource = mysql_query($query_bsr_resource) or die (mysql_error());
	while($row_bsr = mysql_fetch_array($result_bsr_resource))
	{	
		$i++;
		$piertypes_PierTypeID_foun_pier[$i]				= $row_bsr['pierfoundationtypes_PierFoundationTypeID'];
		$piermaterials_PierMaterialID_foun_pier[$i]		= $row_bsr['pierfoundationmaterials_PierFoundationMaterialID'];
	}
	
	
	$i	= 0;
	$query_bsr_resource = "select * from bms_wingwallfoundations where bridgeprofile_BridgeProfileID=".$BridgeProfileID." order by WingWallPosition";        
	$result_bsr_resource = mysql_query($query_bsr_resource) or die (mysql_error());
	while($row_bsr = mysql_fetch_array($result_bsr_resource))
	{	
		$i++;
		$wingtypes_WingTypeID_foun_ww[$i]			= $row_bsr['wingfoundationtypes_WingFoundationTypeID'];
		$wingmaterials_WingMaterialID_foun_ww[$i]	= $row_bsr['wingfoundationmaterials_WingFoundationMaterialID'];
	}

}
	
	echo "<head>";

	echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"../common/common.css\" />";
	echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"../lib/jquery/cal/cal.css\" />";
		
	
?>

		
	<link href="../lib/jquery/development-bundle/themes/base/jquery.ui.all.css" rel="stylesheet" type="text/css"/>
	<script src="../lib/jquery/js/jquery-1.5.1.min.js"></script>
	<script src="../lib/jquery/js/jquery-ui-1.8.12.custom.min.js"></script>
	<script type="text/javascript" src="../lib/jquery/cal/cal.js"></script> 


	<script>
		
		$(document).ready(function() {
			$("#tabs").tabs();	
			
			$("#dateofinspection").datepicker({
                altField: '#realdate', 
                dateFormat:'yy-mm-dd'
			}); 

			$("input#SearchString").autocomplete({
				source: [<?php 
							$sections_SectionID	= $_SESSION['logined_sections_SectionID'];
							$bsr = array();
							$counterA=0;
							$query_bsr = "select * from bms_bridgeprofiles where sections_SectionID=".$sections_SectionID." order by StructureID";        
							$result_bsr = mysql_query($query_bsr) or die (mysql_error());
							while($row_user = mysql_fetch_array($result_bsr))
							{
								echo "\"".$row_user['StructureID']."\",";
							}
		
				
							$query_bsr = "select * from bms_bridgeprofiles where sections_SectionID=".$sections_SectionID." order by BridgeName";        
							$result_bsr = mysql_query($query_bsr) or die (mysql_error());
							while($row_user = mysql_fetch_array($result_bsr))
							{
								echo "\"".$row_user['BridgeName']." (Structure ID : ".$row_user['StructureID'].")\",";
								
							}?>]
			});
			
	
			$("#operationstdate").datepicker({
                altField: '#realdate', 
                dateFormat:'yy-mm-dd'
			});   
			
			
			$("#dateofninspection").datepicker({
                altField: '#realdate', 
                dateFormat:'yy-mm-dd'
			}); 

			
			<?php 
				if($funcofbridges_FuncOfBridgeID == 1)
				{
				?>
					$('#div_nriver').show();	
					$('#div_nuproad').hide();
					$('#div_noproad').hide();
					$('#div_norail').hide();
				<?php
				}
				else if($funcofbridges_FuncOfBridgeID == 2)
				{
				?>
					$('#div_nriver').hide();	
					$('#div_nuproad').show();
					$('#div_noproad').hide();
					$('#div_norail').hide();
				<?php
				}
				else if($funcofbridges_FuncOfBridgeID == 3)
				{
				?>
					$('#div_nriver').hide();	
					$('#div_nuproad').hide();
					$('#div_noproad').show();
					$('#div_norail').hide();
				<?php
				}
				else if($funcofbridges_FuncOfBridgeID == 5)
				{
				?>
					$('#div_nriver').hide();	
					$('#div_nuproad').hide();
					$('#div_noproad').hide();
					$('#div_norail').show();
				<?php
				}
				else
				{				
				?>
					$('#div_nriver').hide();	
					$('#div_nuproad').hide();
					$('#div_noproad').hide();
					$('#div_norail').hide();
				<?php
				}
				
				
				
				if($funcofbridges_FuncOfBridgeID == 1)
				{
				?>
					$('#clearance_wt_pwc').show();
					$('#clearance_wt_twc').show();
					$('#clearance_wt_ph').show();
					$('#clearance_wt_pss').show();				
					
					$('#clearance_nonwt_p').hide();
					$('#clearance_nonwt_tb').hide();
				<?php
				}
				else
				{
				?>
					$('#clearance_wt_pwc').hide();
					$('#clearance_wt_twc').hide();
					$('#clearance_wt_ph').hide();
					$('#clearance_wt_pss').hide();				
					
					$('#clearance_nonwt_p').show();
					$('#clearance_nonwt_tb').show();
				<?php
				}
				
				
				for($i=1; $i<=15; $i++)
				{
					if($i<=$NoOfSpans)
					{
					?>
						$('#spgroup<?php echo $i; ?>').show();	
						$('#deck<?php echo $i; ?>').show();
					<?php
					}
					else
					{
					?>
						$('#spgroup<?php echo $i; ?>').hide();	
						$('#deck<?php echo $i; ?>').hide();
						
					<?php						
					}
					
					
					if($i<=$NoOfPiers)
					{
					?>
						$('#sub_pier_<?php echo $i; ?>').show();	
						$('#foun_pier_<?php echo $i; ?>').show();
											
					<?php
					}
					else
					{
					?>
						$('#sub_pier_<?php echo $i; ?>').hide();	
						$('#foun_pier_<?php echo $i; ?>').hide();				
					<?php
					}
					
				}	
				
				
			?>
			
			$('#mysublasttr').hide();	
		});
		
		function selfunnumspan(selectobj){
			var val;
			val	= selectobj.value;
			for(var i=1; i<=15; i++)
			{
				if(i<=val)
					$('#spgroup'+i).show();	
				else
					$('#spgroup'+i).hide();	
			}

			for(var i=1; i<=15; i++)
			{
				if(i<=val)
					$('#deck'+i).show();	
				else
					$('#deck'+i).hide();	
			}			
		}
		
		
		function selfunnumpier(selectobj){
			var val;
			val	= selectobj.value;
			for(var i=1; i<=15; i++)
			{
				if(i<=val)
					$('#sub_pier_'+i).show();	
				else
					$('#sub_pier_'+i).hide();	
			}

			for(var i=1; i<=15; i++)
			{
				if(i<=val)
					$('#foun_pier_'+i).show();	
				else
					$('#foun_pier_'+i).hide();	
			}		
		}
		
		function selfun(selectobj){
			var val;
			val	= selectobj.value;
			
			if(val == 1)
			{
				$('#div_nriver').show();
				$('#div_nuproad').hide();
				$('#div_noproad').hide();
				$('#div_norail').hide();				
				
			}
			else if(val == 2)
			{
				$('#div_nriver').hide();
				$('#div_nuproad').show();
				$('#div_noproad').hide();
				$('#div_norail').hide();				
				
			}
			else if(val == 3)
			{
				$('#div_nriver').hide();
				$('#div_nuproad').hide();
				$('#div_noproad').show();
				$('#div_norail').hide();				
				
			}
			else if(val == 5)
			{
				$('#div_nriver').hide();
				$('#div_nuproad').hide();
				$('#div_noproad').hide();
				$('#div_norail').show();				
				
			}
			else
			{
				$('#div_nriver').hide();
				$('#div_nuproad').hide();
				$('#div_noproad').hide();
				$('#div_norail').hide();				
				
			}
			
			
			if(val == 1)
			{
				$('#clearance_wt_pwc').show();
				$('#clearance_wt_twc').show();
				$('#clearance_wt_ph').show();
				$('#clearance_wt_pss').show();				
				
				$('#clearance_nonwt_p').hide();
				$('#clearance_nonwt_tb').hide();	
			}
			else
			{			
				$('#clearance_wt_pwc').hide();
				$('#clearance_wt_twc').hide();
				$('#clearance_wt_ph').hide();
				$('#clearance_wt_pss').hide();				
				
				$('#clearance_nonwt_p').show();
				$('#clearance_nonwt_tb').show();	
			}
		}

		
		function checkOnSubmit(){
			valid = true;
			if ( document.myfirstformxx.dateofinspection.value == "" )
				{
						uname_div=document.getElementById("dateofinspectio");
						uname_div.innerHTML = "Please Enter Inspection Date";
						valid = false;
				}
				
			if ( document.myfirstformxx.dateofninspection.value == "" )
				{
						passwd_div=document.getElementById("dateofninspectio");
						passwd_div.innerHTML = "Please Enter Next Inspection Date";
						valid = false;
				}
		
			if (valid == true)
			{
				$('#mysublasttr').show();	
				$('#mysubtr').hide();
			}
		}
		
		
		function checkOnSubmitNo(){
			$('#mysublasttr').hide();	
			$('#mysubtr').show();				
		}
		
	</script>


<script language="javascript" type="text/javascript" >
		function ajaxFunction()
        {
                var xmlHttp;

                if (window.XMLHttpRequest)
                {
                        xmlHttp =new XMLHttpRequest();
                }
                else if (window.ActiveXObject)
                {
                        xmlHttp =new ActiveXObject("Microsoft.XMLHTTP");
                }
                else
                {
                        alert("Your browser does not support XMLHTTP!");
                }


                xmlHttp.onreadystatechange=function()
                {
                        if(xmlHttp.readyState==4)
                        {
                                div = document.getElementById('des');
                                div.innerHTML = "<br />" + xmlHttp.responseText;
                        }
                }

                xmlHttp.open("GET","check_bridge_id_availability_ajax.php?birdeid="+document.myfirstform.StructureID.value,true);
                xmlHttp.send(null);
        }
		

</script>



</head>


<?php	
	
	
	
	
	
	
	
	echo "<body autocomplete=\"off\" >";
	

		
		
	echo "<p class=\"hx1\">Edit Photos and Sketches Record</p>";

	//	Save data to data base.........
	

	if(isset($_POST['yes_submit']))
	{

	
		$BridgeProfileID 			= $_POST['BridgeProfileID'];
		$Inspection2HeaderDataID	= $_POST['Inspection2HeaderDataID'];
		
		$dateofinspection 			= $_POST['dateofinspection'];
		$dateofninspection 			= $_POST['dateofninspection'];
		$level1ins					= $_POST['level1ins'];
		
		$ModifiedBy			= $_SESSION['log_UserID'];
		$ModifiedDate		= date("Y-m-d H:i:s");
		

		////////////////////////////////////////////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////////
		$query_resource = "update bms_inspection2headerdatas set InspectionDate = '$dateofinspection', NextInspectionDate = '$dateofninspection', Level1Inspection = '$level1ins', ModifiedBy = '$ModifiedBy', ModifiedDate = '$ModifiedDate' where Inspection2HeaderDataID = '$Inspection2HeaderDataID'";

		$result_resource = mysql_query($query_resource) or die (mysql_error());
				
		$users_UserID	= $ModifiedBy;
		$TableName		= "bms_inspection2headerdatas";		
		$SQLQuery 		= str_replace("'", "\'", $query_resource);
		$Action			= "UPDATE";		
		$query_log = "insert into bms_logs(users_UserID, TableName,	SQLQuery, 	Action) values ('".$users_UserID."','".$TableName."','". $SQLQuery."','". $Action."')";
		$result_log = mysql_query($query_log) or die (mysql_error());
		////////////////////////////////////////////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////////

		
		for ( $i = 1; $i <= 20; $i++)
		{
					$ival	= $i;
					
					$field1 = "filmnumber".$i."name";
					$field2 = "sketchnumber".$i."name";
					$field3 = "modification".$i."name";
					$field4 = "group".$i."name";
					$field5 = "component".$i."name";
					$field6 = "description".$i."name";
					
						$filmnumber 	= $_POST[$field1];
						$sketchnumber	= $_POST[$field2];
						$modification	= $_POST[$field3];
						$group			= $_POST[$field4];		
						$component		= $_POST[$field5];
						$description	= $_POST[$field6];

						$filename	= '';
						$lcase_ext 	= '';
						$filename 	= basename($_FILES['sketch'.$i.'name']['name']);
						if($filename != ""){
							$ext = substr($filename, strrpos($filename, '.') + 1);
							$lcase_ext = strtolower($ext);

							$target = $datadir2; 
							$target = $target . $Inspection2HeaderDataID."-".$i.".".$lcase_ext;
							move_uploaded_file($_FILES['sketch'.$i.'name']['tmp_name'],$target);
						}
						
					if(isset($_POST[$field1]))
					{
						
						////////////////////////////////////////////////////////////////////////////////////
						////////////////////////////////////////////////////////////////////////////////////
						$query_resource = "update bms_inspection2datas set `Filmnumber` = '".$filmnumber."', `Sketchnumber` = '".$sketchnumber."', `Modification` = '".$modification."', `Group` = '".$group."', `Component` = '".$component."', ";
						if($lcase_ext 	!= ""){
							$query_resource = $query_resource. "`Filext` = '".$lcase_ext."', ";
						}
						$query_resource = $query_resource. "`Description` = '".$description."' where `bms_inspection2headerdatas_Inspection2HeaderDataID` = '".$Inspection2HeaderDataID."' and `ival` = '".$ival."'";
						
						$result_resource = mysql_query($query_resource) or die (mysql_error());
								
						$users_UserID	= $ModifiedBy;
						$TableName		= "bms_inspection2datas";		
						$SQLQuery 		= str_replace("'", "\'", $query_resource);
						$Action			= "UPDATE";		
						$query_log = "insert into bms_logs(users_UserID, TableName,	SQLQuery, 	Action) values ('".$users_UserID."','".$TableName."','". $SQLQuery."','". $Action."')";
						$result_log = mysql_query($query_log) or die (mysql_error());
						////////////////////////////////////////////////////////////////////////////////////
						////////////////////////////////////////////////////////////////////////////////////
					}
						
		}
		echo "<p class=\"bodytextsus\"><BR />Successfully Edited ....<BR /></p>";
				
	}
	else
	{

		echo "<form autocomplete=\"off\"  name=\"myfirstformx\" id=\"myfirstformx\" method=\"POST\" action=\"#\"  >";
			
			$_SESSION['BridgeProfileID']=$BridgeProfileID;
			
			echo "
			<table class=\"bodytext\">
			<tr>
				<td width =\"160\" class=\"mytd\">
					Search Bridge Profile
				</td>
				<td class=\"mytd\">
					<input type=\"text\"  name=\"SearchString\" size=\"40\" id=\"SearchString\" class=\"inputText\" size=\"55\" />
				</td>
				<td class=\"mytd\">
					<input name=\"go\"  type=\"submit\"  class=\"Submit_Button_Long\" id=\"bms_Search\" value=\"Select\"  />
				</td>
				<td><span id=\"SearchString_id\" class=\"bodytextred\"></span></td>	
			</tr>	
			</table>
			</form>";
	
	if(isset($_POST['SearchString']) and $BridgeProfileID>0 )
	//if(isset($_POST['SearchString']))
	{
		
			echo "<form enctype=\"multipart/form-data\" autocomplete=\"off\"  name=\"myfirstformxx\" id=\"myfirstformxx\" method=\"POST\" action=\"#\"  >";
				
			$query_ea		= "select * from bms_inspection2headerdatas where bridgeprofile_BridgeProfileID = ".$BridgeProfileID;		
			$result_fac		= mysql_query($query_ea) or die (mysql_error());
			$CurrentDate	= date("Y-m-d");
			echo "<br />";
				if(mysql_num_rows($result_fac) == 0)
				{
					echo "<p  class=\"bodytext\">";
						echo "<strong>No Inspection Reports were found for given details!</strong>";
					echo "</p>";
				}			
				else
				{
					echo "<table>";		
						echo "<tr bgcolor=\"#CFEBFA\" align=\"center\">";
					
							echo "<td class=\"myth\">";
								echo "<strong>Inspection Date</strong>";
							echo "</td>";
						
							echo "<td class=\"myth\"  height=\"36\"   width=\"250\">";
								echo "<strong>Next Inspection Date</strong>";
							echo "</td>";

							echo "<td class=\"myth\"  height=\"36\"   width=\"250\">";
								echo "<strong>Next Inspection Due</strong>";
							echo "</td>";
							
							echo "<td class=\"myth\">";
								echo "<strong>Action</strong>";
							echo "</td>";
						echo "</tr>";
					
					$temp = 0;	
					while($row_fac = mysql_fetch_array($result_fac))
					{

						$Inspection2HeaderDataID= $row_fac['Inspection2HeaderDataID'];
						$InspectionDate			= $row_fac['InspectionDate'];
						$NextInspectionDate		= $row_fac['NextInspectionDate'];
						
						echo "<tr>";
						$temp++;
						if($temp%2 == 0)
						{
							echo "<td class=\"mytd\">";
						}
						else
						{
							echo "<td class=\"altmytd\">";				
						}
							echo $InspectionDate;
						echo "</td>";
						
						if($temp%2 == 0)
						{
							echo "<td class=\"mytd\">";
						}
						else
						{
							echo "<td class=\"altmytd\">";				
						}
								echo $NextInspectionDate;
							echo "</td>";
						
						if($temp%2 == 0)
						{
							echo "<td class=\"mytd\">";
						}
						else
						{
							echo "<td class=\"altmytd\">";				
						}
								if($NextInspectionDate < $CurrentDate)
								{
									echo "<font color=\"#FF3030\">Inspection Report is Delayed</font>";
								}
								else
								{
									echo "Inspection Report is Due";
								}
								
													
						echo "<form name=\"selectuser\" id=\"selectuser\" method=\"POST\" autocomplete=\"off\" action=\"#\">";
						if($temp%2 == 0)
						{
							echo "<td class=\"mytd\">";
						}
						else
						{
							echo "<td class=\"altmytd\">";				
						}						
							echo "<input type=\"submit\" name=\"more\" value=\"More Info\"  class=\"Submit_Button_long\" />";	
							echo "<input type=\"hidden\" name=\"Inspection2HeaderDataID\" value=".$Inspection2HeaderDataID.">";
							echo "<input type=\"hidden\" name=\"BridgeProfileID\" value=".$BridgeProfileID.">";								
							echo "<input type=\"hidden\" name=\"select\" value=\"select\">";	
			
							echo "</td>";
						echo "</form>";
								
						echo "</tr>";
					}
					echo "</table>";	
				}
				
	}
	
	if(isset($_POST['more']))
	{
			$BridgeProfileID 			= $_POST['BridgeProfileID'];
			$Inspection2HeaderDataID 	= $_POST['Inspection2HeaderDataID'];
			
			echo "<form enctype=\"multipart/form-data\" autocomplete=\"off\"  name=\"myfirstformxx\" id=\"myfirstformxx\" method=\"POST\" action=\"#\"  >";
			
			$query_ea		= "select * from bms_bridgeprofiles where BridgeProfileID = ".$BridgeProfileID;		
			$result_fac		= mysql_query($query_ea) or die (mysql_error());
			while($row_fac	= mysql_fetch_array($result_fac))
			{
				$StructureID  	= $row_fac['StructureID'];
				$BridgeName		= $row_fac['BridgeName'];
			}
			
			$query_valm	= "select * from bms_inspection2headerdatas where Inspection2HeaderDataID =".$Inspection2HeaderDataID;
			$result_valm	= mysql_query($query_valm) or die (mysql_error());
			while($row_valm	= mysql_fetch_array($result_valm))
			{
				$InspectionDate  	= $row_valm['InspectionDate'];
				$NextInspectionDate	= $row_valm['NextInspectionDate'];
				$Level1Inspection	= $row_valm['Level1Inspection'];
			}
	
			echo "
			<table>
				<tr>			
					<td class=\"mytd\" >Structure ID of the Bridge</td>
					";
						echo "<td  class=\"mytd\">";					
						
						echo $StructureID;
											
					echo "</td>";
					echo "			
				</tr>	
				<tr>			
					<td class=\"mytd\" >Name of the Bridge</td>
					";
						echo "<td  class=\"mytd\">";					
						
						echo $BridgeName;
											
					echo "</td>";
					echo "			
				</tr>
				<tr>			
					<td class=\"mytd\" >Date of Inspection</td>
					";
						echo "<td  class=\"mytd\">";					
						
						echo "<input type=\"text\" class=\"mytextbox3\" name=\"dateofinspection\" id=\"dateofinspection\" value=\"$InspectionDate\" onclick=\"return validate_dateofinspection( );\">";
						echo "<div id=\"dateofinspectio\" class=\"bodytextred\"></div>";
					
					echo "</td>";
					echo "			
				</tr>						
				
				<tr>			
					<td class=\"mytd\" >Date of next Inspection</td>
					";
						echo "<td  class=\"mytd\">";					
						
						echo "<input type=\"text\" class=\"mytextbox3\" name=\"dateofninspection\" id=\"dateofninspection\" value=\"$NextInspectionDate\" onclick=\"return validate_dateofninspection ( );\">";
						echo "<div id=\"dateofninspectio\" class=\"bodytextred\"></div>";
					
					echo "</td>";
					echo "			
				</tr>

					<tr>			
						<td class=\"mytd\" >Level 1 Inspection</td>
						
						<td class=\"mytd\">
							<select name=\"level1ins\">";
							if($Level1Inspection == "e")
							{
							echo "	
									<option value=\"e\">Exceptional</option>
									<option value=\"p\">Programmed</option>
									";
							}
							else
							{
							echo "	
									<option value=\"p\">Programmed</option>
									<option value=\"e\">Exceptional</option>
									";
							}
							echo "	
							</select>
						</td>			
					</tr>										
				
				<tr>
					<td>
					&nbsp
					</td>
				</tr>
				
			</table>";
			?>
			
				<?php

					echo " <table>
											<tr>
											<td class=\"myth\" width=\"100\">Film/Exposure Number</td>
											<td class=\"myth\" width=\"100\">Sketch Number</td>
											<td class=\"myth\" width=\"100\">Modification</td>
											<td class=\"myth\" width=\"100\">Group</td>
											<td class=\"myth\" width=\"100\">Component</td>
											<td class=\"myth\" width=\"100\">Description</td>
											<td class=\"myth\" width=\"100\">Attachment</td>
											</tr>";
							echo "</br>";
							
							
							
						//For file attchement outside Document Root
											$_SESSION['filepathx'] = array();
						$_SESSION['fileidx'] = array();				
						$myfilepathi = 0;
						
						
						for($i=1; $i <= 20; $i++)
						{
						
								$myfilepathi++;
											
											
								$query_valmi	= "select * from bms_inspection2datas where bms_inspection2headerdatas_Inspection2HeaderDataID =".$Inspection2HeaderDataID." and ival=".$i;
								$result_valmi	= mysql_query($query_valmi) or die (mysql_error());
								while($row_valmi	= mysql_fetch_array($result_valmi))
								{
									
									$Filmnumber  	= $row_valmi['Filmnumber'];
									$Sketchnumber	= $row_valmi['Sketchnumber'];
									$Modification	= $row_valmi['Modification'];
									$Group		 	= $row_valmi['Group'];
									$Component		= $row_valmi['Component'];
									$lcase_ext		= $row_valmi['Filext'];
									$Description 	= $row_valmi['Description'];
								}
							
							echo "	
									<tr>
									<td class=\"mytd\" width=\"100\"> <input type=\"text\" class=\"mytextbox1\" name=\"filmnumber".$i."name\"  oninput=\"ajaxFunction();\"  id=\"filmnumber".$i."name\" value=\"".$Filmnumber."\">
									</td>									
									<td class=\"mytd\" width=\"100\"> <input type=\"text\" class=\"mytextbox1\" name=\"sketchnumber".$i."name\"  oninput=\"ajaxFunction();\"  id=\"sketchnumber".$i."name\" value=\"".$Sketchnumber."\">
									</td>
									<td class=\"mytd\" width=\"100\"> <input type=\"text\" class=\"mytextbox1\" name=\"modification".$i."name\"  oninput=\"ajaxFunction();\"  id=\"modification".$i."name\" value=\"".$Modification."\">
									</td>
									<td class=\"mytd\" width=\"100\"> <input type=\"text\" class=\"mytextbox1\" name=\"group".$i."name\"  oninput=\"ajaxFunction();\"  id=\"group".$i."name\" value=\"".$Group."\">
									</td>
									<td class=\"mytd\" width=\"100\"> <input type=\"text\" class=\"mytextbox2\" name=\"component".$i."name\"  oninput=\"ajaxFunction();\"  id=\"component".$i."name\" value=\"".$Component."\">
									</td>
									<td class=\"mytd\" width=\"100\"> <input type=\"text\" class=\"mytextbox2\" name=\"description".$i."name\"  oninput=\"ajaxFunction();\"  id=\"description".$i."name\" value=\"".$Description."\">
									</td>
									<td  class=\"mytd\" width=\"100\">";
									echo "<table><tr><td class=\"mytd0\" width=\"100\">";
										$x	= '';
										$x	= "Sketch".$i;
										$filepath	= '';
										if($lcase_ext != ""){
											$_SESSION['filepathx'][$myfilepathi]	= $datadir2;
											$_SESSION['fileidx'][$myfilepathi]		= $Inspection2HeaderDataID."-".$i.".".$lcase_ext;
											echo "<a href=\"../download.php?id=".$myfilepathi."\" target=\"_blank\">".$x."</a>";

											
										}else{
											echo "--";
										}
									echo "</td><td class=\"mytd0\" >";										
										echo "<input type=\"file\" class=\"mytextbox2\" name=\"sketch".$i."name\" id=\"sketch".$i."name\" >";
									echo "</td></tr></table>";	
									echo "</td>";
									echo "
									<span name=\"des\" id=\"des\"></span></td>
									</tr>
									";
						}
					echo "</table>";
	


					echo "<table>";			
				echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
				echo "<input type=\"hidden\" name=\"BridgeProfileID\" value=\"$BridgeProfileID\">";
				echo "<input type=\"hidden\" name=\"Inspection2HeaderDataID\" value=\"$Inspection2HeaderDataID\">";						
			
				echo "<tr id=\"mysubtr\"  name=\"mysubtr\"><td colspan=\"3\" align=\"center\">";
					echo "<input type=\"button\" name=\"go\" class=\"Submit_Button_Long_Long\" value=\"Edit Report\" onclick=\"checkOnSubmit()\">";
				echo "</td></tr>";
				
				
				echo "<tr id=\"mysublasttr\"  name=\"mysublasttr\"><td colspan=\"3\" align=\"left\">";
					echo "<font class\"bodytextred\" color=\"red\"><b>Are you sure you want edit the inspection report ?</b></font>";
					echo "&nbsp;&nbsp;&nbsp;";
					echo "<input type=\"submit\" name=\"yes_submit\" class=\"Submit_Button\" value=\"Yes\" />";
					echo "&nbsp;&nbsp;&nbsp;";
					echo "<input type=\"button\" name=\"no_submit\" class=\"Submit_Button\" value=\"No\"  onclick=\"checkOnSubmitNo()\" />";
				echo "</td></tr>";
						echo "</table>";	
				?>
				</div>
				
			</div>

		</form>
<?php
	}
}
	echo "</body>";
	include '../bottom.php';

?>