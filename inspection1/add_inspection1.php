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
	

		
		
	echo "<p class=\"hx1\">Routine Maintenance Inspection Report</p>";
	

	//	Save data to data base.........
	

	if(isset($_POST['yes_submit']))
	{

		$query_master	= "select Inspection1HeaderDataID from bms_inspection1headerdatas";
		$result_master	= mysql_query($query_master) or die (mysql_error());

		while($row_master	= mysql_fetch_array($result_master))
		{	
			$Inspection1HeaderDataID = $row_master['Inspection1HeaderDataID'];
		}
		
		
		$BridgeProfileID 			= $_POST['BridgeProfileID'];
		
		$dateofinspection 			= $_POST['dateofinspection'];
		$dateofninspection 			= $_POST['dateofninspection'];
		$level1ins					= $_POST['level1ins'];
		$comment					= $_POST['comment'];		

		
		$sections_SectionID	= $_SESSION['logined_sections_SectionID'];
		$AddedBy			= $_SESSION['log_UserID'];
		$AddedDate			= date("Y-m-d H:i:s");
		

		////////////////////////////////////////////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////////
		$query_resource = "insert into bms_inspection1headerdatas(bridgeprofile_BridgeProfileID, 
														InspectionDate, 
														NextInspectionDate,
														Level1Inspection,
														GeneralComment,
														AddedBy, 
														AddedDate) 
											values ('".$BridgeProfileID."', 
													'".$dateofinspection."', 
													'".$dateofninspection."',
													'".$level1ins."',
													'".$comment."', 													
													'".$AddedBy."', 
													'".$AddedDate."')";
		$result_resource = mysql_query($query_resource) or die (mysql_error());
				
		$users_UserID	= $AddedBy;
		$TableName		= "bms_inspection1headerdatas";		
		$SQLQuery 		= str_replace("'", "\'", $query_resource);
		$Action			= "INSERT";		
		$query_log = "insert into bms_logs(users_UserID, TableName,	SQLQuery, 	Action) values ('".$users_UserID."','".$TableName."','". $SQLQuery."','". $Action."')";
		$result_log = mysql_query($query_log) or die (mysql_error());
		////////////////////////////////////////////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////////

		$Inspection1HeaderDataID = $Inspection1HeaderDataID + 1;
		
		for ( $i = 1; $i <= 7; $i++)
		{
			for ( $j = 1; $j <= 5; $j++)
			{	
				for ( $k = 1; $k <= 7; $k++)
				{
					$ijkval	= $i.$j.$k;
					
					$secval = "Inspection1SecondaryInfo".$i.$j.$k;
					$select1val = "select1".$i.$j.$k;
					$select2val = "select2".$i.$j.$k;
					$select3val = "select3".$i.$j.$k;
					$select4val = "select4".$i.$j.$k;
					$textval 	= "text".$i.$j.$k;
					
						$Inspection1SecondaryInfoID = $_POST[$secval];
						$problem					= $_POST[$select1val];
						$comment					= $_POST[$textval];
						$rectified					= $_POST[$select2val];		
						$maintainacerequired		= $_POST[$select3val];
						$inspectionrequired			= $_POST[$select4val];

						
						
						$sections_SectionID	= $_SESSION['logined_sections_SectionID'];
						$AddedBy			= $_SESSION['log_UserID'];
						$AddedDate			= date("Y-m-d H:i:s");
						
					if(isset($_POST[$select1val]))
					{
						
						////////////////////////////////////////////////////////////////////////////////////
						////////////////////////////////////////////////////////////////////////////////////
					$query_resource = "insert into bms_inspection1datas(bms_inspection1headerdatas_Inspection1HeaderDataID, 
																		bms_inspection1secondaryinfos_Inspection1SecondaryInfoID,
																		ijkval,														
																		Problem,
																		Comment,
																		Rectified,
																		MaintainaceRequired, 
																		InspectionRequired) 
															values ('".$Inspection1HeaderDataID."', 
																	'".$Inspection1SecondaryInfoID."',
																	'".$ijkval."',													
																	'".$problem."',
																	'".$comment."', 
																	'".$rectified."',													
																	'".$maintainacerequired."', 
																	'".$inspectionrequired."')";
						$result_resource = mysql_query($query_resource) or die (mysql_error());
								
						$users_UserID	= $AddedBy;
						$TableName		= "bms_inspection1datas";		
						$SQLQuery 		= str_replace("'", "\'", $query_resource);
						$Action			= "INSERT";		
						$query_log = "insert into bms_logs(users_UserID, TableName,	SQLQuery, 	Action) values ('".$users_UserID."','".$TableName."','". $SQLQuery."','". $Action."')";
						$result_log = mysql_query($query_log) or die (mysql_error());
						////////////////////////////////////////////////////////////////////////////////////
						////////////////////////////////////////////////////////////////////////////////////
					}
				}
			}
		
		}
		echo "<p class=\"bodytextsus\"><BR />Successfully Added ....<BR /></p>";		
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
				<input type=\"hidden\" name=\"BridgeProfileID\" value=".$BridgeProfileID.">	
				<td><span id=\"SearchString_id\" class=\"bodytextred\"></span></td>	
			</tr>	
			</table>
			</form>";
	
	if(isset($_POST['SearchString']) and $BridgeProfileID>0 )
	{
		
			echo "<form autocomplete=\"off\"  name=\"myfirstformxx\" id=\"myfirstformxx\" method=\"POST\" action=\"#\"  >";
			
			$query_ea		= "select * from bms_bridgeprofiles where BridgeProfileID = ".$BridgeProfileID;		
			$result_fac		= mysql_query($query_ea) or die (mysql_error());
			while($row_fac	= mysql_fetch_array($result_fac))
			{
				$StructureID  	= $row_fac['StructureID'];
				$BridgeName		= $row_fac['BridgeName'];
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
						
						echo "<input type=\"text\" class=\"mytextbox3\" name=\"dateofinspection\" id=\"dateofinspection\" onclick=\"return validate_dateofinspection( );\">";
						echo "<div id=\"dateofinspectio\" class=\"bodytextred\"></div>";
					
					echo "</td>";
					echo "			
				</tr>						
				
				<tr>			
					<td class=\"mytd\" >Date of next Inspection</td>
					";
						echo "<td  class=\"mytd\">";					
						
						echo "<input type=\"text\" class=\"mytextbox3\" name=\"dateofninspection\" id=\"dateofninspection\" onclick=\"return validate_dateofninspection ( );\">";
						echo "<div id=\"dateofninspectio\" class=\"bodytextred\"></div>";
					
					echo "</td>";
					echo "			
				</tr>

				<tr>			
					<td class=\"mytd\" >Level 1 Inspection</td>
					
					<td class=\"mytd\" >
						<select name=\"level1ins\">
								<option value=\"\">---</option>
								<option value=\"p\">Programmed</option>
								<option value=\"e\">Exceptional</option>
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
			
			
			<div id="tabs">
				<ul>
					<li><a href="#fragment-1"><span>Approaches</span></a></li>
					<li><a href="#fragment-2"><span>Bridge Surface</span></a></li>
					<li><a href="#fragment-3"><span>Waterway</span></a></li>
					<li><a href="#fragment-4"><span>SubStructure</span></a></li>
					<li><a href="#fragment-5"><span>Superstructure</span></a></li>
					<li><a href="#fragment-6"><span>Miscellaneous</span></a></li>
					<li><a href="#fragment-7"><span>Culverts</span></a></li>
					<li><a href="#fragment-8"><span>Comments</span></a></li>
				</ul>
			
				<div id="fragment-1">
				<?php
				$i = 1;
				
					$query_master	= "select Inspection1MasterInfoID, Inspection1MasterInfo from bms_inspection1masterinfos";
					$result_master	= mysql_query($query_master) or die (mysql_error());
					
					$j = 0;
					
					while($row_master	= mysql_fetch_array($result_master))
					{	
						$j ++;
						$Inspection1MasterInfoID = $row_master['Inspection1MasterInfoID'];
						$Inspection1MasterInfo	 = $row_master['Inspection1MasterInfo'];
						
						if($Inspection1MasterInfoID <= 4)
						{
							echo "<p class=\"bodytextbold\"><u>$Inspection1MasterInfo</u></p>";
							echo "<table class=\"bodytext\">";
							echo "	<tr>
											<td class=\"myth\" width=\"250\">Inspection Element</td>
											<td class=\"myth\">Problem</td>
											<td class=\"myth\">Location and Comments</td>
											<td class=\"myth\">Rectified</td>
											<td class=\"myth\">Maintenance Required</td>
											<td class=\"myth\">Inspection Required</td>
											</tr>";
							echo "</br>";
						
								$query_sec	= "select Inspection1SecondaryInfoID, Inspection1SecondaryInfo from bms_inspection1secondaryinfos where inspection1masterinfos_Inspection1MasterInfoID =".$Inspection1MasterInfoID;
								$result_sec	= mysql_query($query_sec) or die (mysql_error());
								
								$k = 0;
								
								while($row_sec	= mysql_fetch_array($result_sec))
								{
									$k ++;
									$Inspection1SecondaryInfoID  = $row_sec['Inspection1SecondaryInfoID'];
									$Inspection1SecondaryInfo	 = $row_sec['Inspection1SecondaryInfo'];
									
									$ijkval = $i.$j.$k;
									echo "	
											<tr>
											<td class=\"mytd\">$Inspection1SecondaryInfo</td>
											<input type=\"hidden\" name=\"ijk".$i.$j.$k."\" value=\"".$i.$j.$k."\">
											<input type=\"hidden\" name=\"Inspection1SecondaryInfo$i$j$k\" value=\"$Inspection1SecondaryInfoID\">
											
											<td class=\"mytd\" align=\"center\">
											<select name=\"select1$i$j$k\">
													<option value=\"-\">---</option>
													<option value=\"y\">Yes</option>
													<option value=\"n\">No</option>
											</select>
											</td>
											<td class=\"mytd\"> <input type=\"text\" class=\"mytextbox3\" name=\"text$i$j$k\"  oninput=\"ajaxFunction();\"  id=\"$Inspection1SecondaryInfo\" >
											
											<td class=\"mytd\"  align=\"center\">
											<select name=\"select2$i$j$k\">
													<option value=\"-\">---</option>
													<option value=\"y\">Yes</option>
													<option value=\"n\">No</option>
											</select>
											</td>
											<td class=\"mytd\"  align=\"center\">
											<select name=\"select3$i$j$k\">
													<option value=\"-\">---</option>
													<option value=\"y\">Yes</option>
													<option value=\"n\">No</option>
											</select>
											</td>
											<td class=\"mytd\" align=\"center\">
											<select name=\"select4$i$j$k\">
													<option value=\"-\">---</option>
													<option value=\"y\">Yes</option>
													<option value=\"n\">No</option>
											</select>
											</td>
											<span name=\"des\" id=\"des\"></span></td>
											</tr>
											";
											
								}	
							echo "</table>";
						}
					}			

				?>
				</div>
				
					
				<div id="fragment-2">
				<?php
					
					$i = 2;
					$query_master	= "select Inspection1MasterInfoID, Inspection1MasterInfo from bms_inspection1masterinfos";
					$result_master	= mysql_query($query_master) or die (mysql_error());
					
					$j = 0;					
					while($row_master	= mysql_fetch_array($result_master))
					{	
					
						$Inspection1MasterInfoID = $row_master['Inspection1MasterInfoID'];
						$Inspection1MasterInfo	 = $row_master['Inspection1MasterInfo'];
						
						if(($Inspection1MasterInfoID <= 8) && ($Inspection1MasterInfoID > 4))
						{
						$j ++;
							echo "<p class=\"bodytextbold\"><u>$Inspection1MasterInfo</u></p>";
							echo "<table class=\"bodytext\">";
							echo "	<tr>
											<td class=\"myth\"  width=\"270\">Inspection Element</td>
											<td class=\"myth\">Problem</td>
											<td class=\"myth\">Location and Comments</td>
											<td class=\"myth\">Rectified</td>
											<td class=\"myth\">Maintenance Required</td>
											<td class=\"myth\">Inspection Required</td>
											</tr>";
							echo "</br>";
						
								$query_sec	= "select Inspection1SecondaryInfoID, Inspection1SecondaryInfo from bms_inspection1secondaryinfos where inspection1masterinfos_Inspection1MasterInfoID =".$Inspection1MasterInfoID;
								$result_sec	= mysql_query($query_sec) or die (mysql_error());
										
								$k = 0;
								
								while($row_sec	= mysql_fetch_array($result_sec))
								{
									$k ++;				
									$Inspection1SecondaryInfoID  = $row_sec['Inspection1SecondaryInfoID'];
									$Inspection1SecondaryInfo	 = $row_sec['Inspection1SecondaryInfo'];
									
									echo "	
											<tr>
											<td class=\"mytd\">$Inspection1SecondaryInfo</td>
											<input type=\"hidden\" name=\"Inspection1SecondaryInfo$i$j$k\" value=\"$Inspection1SecondaryInfoID\">
											<td class=\"mytd\" align=\"center\">
											<select name=\"select1$i$j$k\">
													<option value=\"-\">---</option>
													<option value=\"y\">Yes</option>
													<option value=\"n\">No</option>
											</select>
											</td>
											<td class=\"mytd\"> <input type=\"text\" class=\"mytextbox3\" name=\"text$i$j$k\"  oninput=\"ajaxFunction();\"  id=\"text$i$j$k\" >
											
											<td class=\"mytd\" align=\"center\">
											<select name=\"select2$i$j$k\">
													<option value=\"-\">---</option>
													<option value=\"y\">Yes</option>
													<option value=\"n\">No</option>
											</select>
											</td>
											<td class=\"mytd\" align=\"center\">
											<select name=\"select3$i$j$k\">
													<option value=\"-\">---</option>
													<option value=\"y\">Yes</option>
													<option value=\"n\">No</option>
											</select>
											</td>
											<td class=\"mytd\" align=\"center\">
											<select name=\"select4$i$j$k\">
													<option value=\"-\">---</option>
													<option value=\"y\">Yes</option>
													<option value=\"n\">No</option>
											</select>
											</td>
											<span name=\"des\" id=\"des\"></span></td>
											</tr>
											";
								}	
							echo "</table>";
						}
						
					}
				
				?>
				</div>
					

				<div id="fragment-3">
				<?php
					
					$i = 3;
					$query_master	= "select Inspection1MasterInfoID, Inspection1MasterInfo from bms_inspection1masterinfos";
					$result_master	= mysql_query($query_master) or die (mysql_error());
					
					$j = 0;
					while($row_master	= mysql_fetch_array($result_master))
					{
					
						$Inspection1MasterInfoID = $row_master['Inspection1MasterInfoID'];
						$Inspection1MasterInfo	 = $row_master['Inspection1MasterInfo'];
						
						if(($Inspection1MasterInfoID <= 9) && ($Inspection1MasterInfoID > 8))
						{
						$j ++;
							echo "<p class=\"bodytextbold\"><u>$Inspection1MasterInfo</u></p>";
							echo "<table class=\"bodytext\">";
							echo "	<tr>
											<td class=\"myth\"  width=\"270\">Inspection Element</td>
											<td class=\"myth\">Problem</td>
											<td class=\"myth\">Location and Comments</td>
											<td class=\"myth\">Rectified</td>
											<td class=\"myth\">Maintenance Required</td>
											<td class=\"myth\">Inspection Required</td>
											</tr>";
							echo "</br>";
						
								$query_sec	= "select Inspection1SecondaryInfoID, Inspection1SecondaryInfo from bms_inspection1secondaryinfos where inspection1masterinfos_Inspection1MasterInfoID =".$Inspection1MasterInfoID;
								$result_sec	= mysql_query($query_sec) or die (mysql_error());
										
								$k = 0;
								
								while($row_sec	= mysql_fetch_array($result_sec))
								{
									$k ++;			
									$Inspection1SecondaryInfoID  = $row_sec['Inspection1SecondaryInfoID'];
									$Inspection1SecondaryInfo	 = $row_sec['Inspection1SecondaryInfo'];
									
									echo "																				
											<tr>
											<td class=\"mytd\">$Inspection1SecondaryInfo</td>
											<input type=\"hidden\" name=\"Inspection1SecondaryInfo$i$j$k\" value=\"$Inspection1SecondaryInfoID\">
											<td class=\"mytd\" align=\"center\">
											<select name=\"select1$i$j$k\">
													<option value=\"-\">---</option>
													<option value=\"y\">Yes</option>
													<option value=\"n\">No</option>
											</select>
											</td>
											<td class=\"mytd\"> <input type=\"text\" class=\"mytextbox3\" name=\"text$i$j$k\"  oninput=\"ajaxFunction();\"  id=\"text$i$j$k\" >
											
											<td class=\"mytd\" align=\"center\">
											<select name=\"select2$i$j$k\">
													<option value=\"-\">---</option>
													<option value=\"y\">Yes</option>
													<option value=\"n\">No</option>
											</select>
											</td>
											<td class=\"mytd\"  align=\"center\">
											<select name=\"select3$i$j$k\">
													<option value=\"-\">---</option>
													<option value=\"y\">Yes</option>
													<option value=\"n\">No</option>
											</select>
											</td>
											<td class=\"mytd\" align=\"center\">
											<select name=\"select4$i$j$k\">
													<option value=\"-\">---</option>
													<option value=\"y\">Yes</option>
													<option value=\"n\">No</option>
											</select>
											</td>
											<span name=\"des\" id=\"des\"></span></td>
											</tr>
											";
								}	
							echo "</table>";
						}
						
					}
					
				
				?>
				</div>
					
					
				<div id="fragment-4">
				<?php
					
					$i = 4;
					$query_master	= "select Inspection1MasterInfoID, Inspection1MasterInfo from bms_inspection1masterinfos";
					$result_master	= mysql_query($query_master) or die (mysql_error());
					
					$j = 0;
					while($row_master	= mysql_fetch_array($result_master))
					{
					
						$Inspection1MasterInfoID = $row_master['Inspection1MasterInfoID'];
						$Inspection1MasterInfo	 = $row_master['Inspection1MasterInfo'];
						
						if(($Inspection1MasterInfoID <= 12) && ($Inspection1MasterInfoID > 9))
						{
						$j ++;
							echo "<p class=\"bodytextbold\"><u>$Inspection1MasterInfo</u></p>";
							echo "<table class=\"bodytext\">";
							echo "	<tr>
											<td class=\"myth\"  width=\"270\">Inspection Element</td>
											<td class=\"myth\">Problem</td>
											<td class=\"myth\">Location and Comments</td>
											<td class=\"myth\">Rectified</td>
											<td class=\"myth\">Maintenance Required</td>
											<td class=\"myth\">Inspection Required</td>
											</tr>";
							echo "</br>";
						
								$query_sec	= "select Inspection1SecondaryInfoID, Inspection1SecondaryInfo from bms_inspection1secondaryinfos where inspection1masterinfos_Inspection1MasterInfoID =".$Inspection1MasterInfoID;
								$result_sec	= mysql_query($query_sec) or die (mysql_error());
										
								$k = 0;
								
								while($row_sec	= mysql_fetch_array($result_sec))
								{
									$k ++;				
									$Inspection1SecondaryInfoID  = $row_sec['Inspection1SecondaryInfoID'];
									$Inspection1SecondaryInfo	 = $row_sec['Inspection1SecondaryInfo'];
									
									echo "																				
											<tr>
											<td class=\"mytd\">$Inspection1SecondaryInfo</td>
											<input type=\"hidden\" name=\"Inspection1SecondaryInfo$i$j$k\" value=\"$Inspection1SecondaryInfoID\">
											<td class=\"mytd\" align=\"center\">
											<select name=\"select1$i$j$k\">
													<option value=\"-\">---</option>
													<option value=\"y\">Yes</option>
													<option value=\"n\">No</option>
											</select>
											</td>
											<td class=\"mytd\"> <input type=\"text\" class=\"mytextbox3\" name=\"text$i$j$k\"  oninput=\"ajaxFunction();\"  id=\"text$i$j$k\" >
											
											<td class=\"mytd\" align=\"center\">
											<select name=\"select2$i$j$k\">
													<option value=\"-\">---</option>
													<option value=\"y\">Yes</option>
													<option value=\"n\">No</option>
											</select>
											</td>
											<td class=\"mytd\" align=\"center\">
											<select name=\"select3$i$j$k\">
													<option value=\"-\">---</option>
													<option value=\"y\">Yes</option>
													<option value=\"n\">No</option>
											</select>
											</td>
											<td class=\"mytd\" align=\"center\">
											<select name=\"select4$i$j$k\">
													<option value=\"-\">---</option>
													<option value=\"y\">Yes</option>
													<option value=\"n\">No</option>
											</select>
											</td>
											<span name=\"des\" id=\"des\"></span></td>
											</tr>
											";
								}	
							echo "</table>";
						}
						
					}
				
				?>
				</div>
				
					
				<div id="fragment-5">
				<?php		
				
					$i = 5;
					$query_master	= "select Inspection1MasterInfoID, Inspection1MasterInfo from bms_inspection1masterinfos";
					$result_master	= mysql_query($query_master) or die (mysql_error());
					
					$j = 0;
					while($row_master	= mysql_fetch_array($result_master))
					{
					
						$Inspection1MasterInfoID = $row_master['Inspection1MasterInfoID'];
						$Inspection1MasterInfo	 = $row_master['Inspection1MasterInfo'];
						
						if(($Inspection1MasterInfoID <= 14) && ($Inspection1MasterInfoID > 12))
						{
						$j ++;
							echo "<p class=\"bodytextbold\"><u>$Inspection1MasterInfo</u></p>";
							echo "<table class=\"bodytext\">";
							echo "	<tr>
											<td class=\"myth\"  width=\"270\">Inspection Element</td>
											<td class=\"myth\">Problem</td>
											<td class=\"myth\">Location and Comments</td>
											<td class=\"myth\">Rectified</td>
											<td class=\"myth\">Maintenance Required</td>
											<td class=\"myth\">Inspection Required</td>
											</tr>";
							echo "</br>";
						
								$query_sec	= "select Inspection1SecondaryInfoID, Inspection1SecondaryInfo from bms_inspection1secondaryinfos where inspection1masterinfos_Inspection1MasterInfoID =".$Inspection1MasterInfoID;
								$result_sec	= mysql_query($query_sec) or die (mysql_error());
										
								$k = 0;
								
								while($row_sec	= mysql_fetch_array($result_sec))
								{
									$k ++;				
									$Inspection1SecondaryInfoID  = $row_sec['Inspection1SecondaryInfoID'];
									$Inspection1SecondaryInfo	 = $row_sec['Inspection1SecondaryInfo'];
									
									echo "																					
											<tr>
											<td class=\"mytd\">$Inspection1SecondaryInfo</td>
											<input type=\"hidden\" name=\"Inspection1SecondaryInfo$i$j$k\" value=\"$Inspection1SecondaryInfoID\">
											<td class=\"mytd\" align=\"center\">
											<select name=\"select1$i$j$k\">
													<option value=\"-\">---</option>
													<option value=\"y\">Yes</option>
													<option value=\"n\">No</option>
											</select>
											</td>
											<td class=\"mytd\"> <input type=\"text\" class=\"mytextbox3\" name=\"text$i$j$k\"  oninput=\"ajaxFunction();\"  id=\"text$i$j$k\" >
											
											<td class=\"mytd\" align=\"center\">
											<select name=\"select2$i$j$k\">
													<option value=\"-\">---</option>
													<option value=\"y\">Yes</option>
													<option value=\"n\">No</option>
											</select>
											</td>
											<td class=\"mytd\" align=\"center\">
											<select name=\"select3$i$j$k\">
													<option value=\"-\">---</option>
													<option value=\"y\">Yes</option>
													<option value=\"n\">No</option>
											</select>
											</td>
											<td class=\"mytd\" align=\"center\">
											<select name=\"select4$i$j$k\">
													<option value=\"-\">---</option>
													<option value=\"y\">Yes</option>
													<option value=\"n\">No</option>
											</select>
											</td>
											<span name=\"des\" id=\"des\"></span></td>
											</tr>
											";
								}	
							echo "</table>";
						}
						
					}
					
				?>
				</div>
						
				
				<div id="fragment-6">
				<?php	
				
					$i = 6;
					$query_master	= "select Inspection1MasterInfoID, Inspection1MasterInfo from bms_inspection1masterinfos";
					$result_master	= mysql_query($query_master) or die (mysql_error());
					
					$j = 0;
					while($row_master	= mysql_fetch_array($result_master))
					{
					
						$Inspection1MasterInfoID = $row_master['Inspection1MasterInfoID'];
						$Inspection1MasterInfo	 = $row_master['Inspection1MasterInfo'];
						
						if(($Inspection1MasterInfoID <= 16) && ($Inspection1MasterInfoID > 14))
						{
						$j ++;
							echo "<p class=\"bodytextbold\"><u>$Inspection1MasterInfo</u></p>";
							echo "<table class=\"bodytext\">";
							echo "	<tr>
											<td class=\"myth\"  width=\"270\">Inspection Element</td>
											<td class=\"myth\">Problem</td>
											<td class=\"myth\">Location and Comments</td>
											<td class=\"myth\">Rectified</td>
											<td class=\"myth\">Maintenance Required</td>
											<td class=\"myth\">Inspection Required</td>
											</tr>";
							echo "</br>";
						
								$query_sec	= "select Inspection1SecondaryInfoID, Inspection1SecondaryInfo from bms_inspection1secondaryinfos where inspection1masterinfos_Inspection1MasterInfoID =".$Inspection1MasterInfoID;
								$result_sec	= mysql_query($query_sec) or die (mysql_error());
										
								$k = 0;
								
								while($row_sec	= mysql_fetch_array($result_sec))
								{
									$k ++;				
									$Inspection1SecondaryInfoID  = $row_sec['Inspection1SecondaryInfoID'];
									$Inspection1SecondaryInfo	 = $row_sec['Inspection1SecondaryInfo'];
									
									echo "																					
											<tr>
											<td class=\"mytd\">$Inspection1SecondaryInfo</td>
											<input type=\"hidden\" name=\"Inspection1SecondaryInfo$i$j$k\" value=\"$Inspection1SecondaryInfoID\">
											<td class=\"mytd\" align=\"center\">
											<select name=\"select1$i$j$k\">
													<option value=\"-\">---</option>
													<option value=\"y\">Yes</option>
													<option value=\"n\">No</option>
											</select>
											</td>
											<td class=\"mytd\"> <input type=\"text\" class=\"mytextbox3\" name=\"text$i$j$k\"  oninput=\"ajaxFunction();\"  id=\"text$i$j$k\" >
											
											<td class=\"mytd\" align=\"center\">
											<select name=\"select2$i$j$k\">
													<option value=\"-\">---</option>
													<option value=\"y\">Yes</option>
													<option value=\"n\">No</option>
											</select>
											</td>
											<td class=\"mytd\" align=\"center\">
											<select name=\"select3$i$j$k\">
													<option value=\"-\">---</option>
													<option value=\"y\">Yes</option>
													<option value=\"n\">No</option>
											</select>
											</td>
											<td class=\"mytd\" align=\"center\">
											<select name=\"select4$i$j$k\">
													<option value=\"-\">---</option>
													<option value=\"y\">Yes</option>
													<option value=\"n\">No</option>
											</select>
											</td>
											<span name=\"des\" id=\"des\"></span></td>
											</tr>
											";
								}	
							echo "</table>";
						}
						
					}
				
				?>
				</div>
				
					
				<div id="fragment-7">
				<?php		
				
					$i = 7;
					$query_master	= "select Inspection1MasterInfoID, Inspection1MasterInfo from bms_inspection1masterinfos";
					$result_master	= mysql_query($query_master) or die (mysql_error());
					
					$j = 0;
					while($row_master	= mysql_fetch_array($result_master))
					{
					
						$Inspection1MasterInfoID = $row_master['Inspection1MasterInfoID'];
						$Inspection1MasterInfo	 = $row_master['Inspection1MasterInfo'];
						
						if(($Inspection1MasterInfoID <= 17) && ($Inspection1MasterInfoID > 16))
						{
						$j ++;
							echo "<p class=\"bodytextbold\"><u>$Inspection1MasterInfo</u></p>";
							echo "<table class=\"bodytext\">";
							echo "	<tr>
											<td class=\"myth\"  width=\"270\">Inspection Element</td>
											<td class=\"myth\">Problem</td>
											<td class=\"myth\">Location and Comments</td>
											<td class=\"myth\">Rectified</td>
											<td class=\"myth\">Maintenance Required</td>
											<td class=\"myth\">Inspection Required</td>
											</tr>";
							echo "</br>";
						
								$query_sec	= "select Inspection1SecondaryInfoID, Inspection1SecondaryInfo from bms_inspection1secondaryinfos where inspection1masterinfos_Inspection1MasterInfoID =".$Inspection1MasterInfoID;
								$result_sec	= mysql_query($query_sec) or die (mysql_error());
										
								$k = 0;
								
								while($row_sec	= mysql_fetch_array($result_sec))
								{
									$k ++;				
									$Inspection1SecondaryInfoID  = $row_sec['Inspection1SecondaryInfoID'];
									$Inspection1SecondaryInfo	 = $row_sec['Inspection1SecondaryInfo'];
									
									echo "									
											<tr>
											<td class=\"mytd\">$Inspection1SecondaryInfo</td>
											<input type=\"hidden\" name=\"Inspection1SecondaryInfo$i$j$k\" value=\"$Inspection1SecondaryInfoID\">
											<td class=\"mytd\"  align=\"center\">
											<select name=\"select1$i$j$k\">
													<option value=\"-\">---</option>
													<option value=\"y\">Yes</option>
													<option value=\"n\">No</option>
											</select>
											</td>
											<td class=\"mytd\"> <input type=\"text\" class=\"mytextbox3\" name=\"text$i$j$k\"  oninput=\"ajaxFunction();\"  id=\"text$i$j$k\" >
											
											<td class=\"mytd\" align=\"center\">
											<select name=\"select2$i$j$k\">
													<option value=\"-\">---</option>
													<option value=\"y\">Yes</option>
													<option value=\"n\">No</option>
											</select>
											</td>
											<td class=\"mytd\" align=\"center\">
											<select name=\"select3$i$j$k\">
													<option value=\"-\">---</option>
													<option value=\"y\">Yes</option>
													<option value=\"n\">No</option>
											</select>
											</td>
											<td class=\"mytd\" align=\"center\">
											<select name=\"select4$i$j$k\">
													<option value=\"-\">---</option>
													<option value=\"y\">Yes</option>
													<option value=\"n\">No</option>
											</select>
											</td>
											<span name=\"des\" id=\"des\"></span></td>
											</tr>									
											";
								}				
							echo "</table>";
						}
						
					}
				?>
				</div>

				
				<div id="fragment-8">
				<?php		
					echo "<p class=\"bodytextbold\"><u>Comments</u></p>";
					
						echo "<table class=\"bodytext\">";
							echo "<tr>";
								echo "<td class=\"altmytd\">";
											echo "<textarea name=\"comment\" cols=\"140\" rows=\"12\"></textarea>";
										echo "</td>";
								echo "</tr>";
								
				echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
				echo "<input type=\"hidden\" name=\"BridgeProfileID\" value=\"$BridgeProfileID\">";				
			
				echo "<tr id=\"mysubtr\"  name=\"mysubtr\"><td colspan=\"3\" align=\"center\">";
					echo "<input type=\"button\" name=\"go\" class=\"Submit_Button_Long_Long\" value=\"Add Report\" onclick=\"checkOnSubmit()\">";
				echo "</td></tr>";
				
				
				echo "<tr id=\"mysublasttr\"  name=\"mysublasttr\"><td colspan=\"3\" align=\"left\">";
					echo "<font class\"bodytextred\" color=\"red\"><b>Are you sure you want save the inspection report ?</b></font>";
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