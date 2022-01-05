<?php
	include ("../global.php");
	include ("../top.php");


	if(isset($_SESSION['BridgeProfileID'])){
		unset($_SESSION['BridgeProfileID']);
	}if(isset($_SESSION['StructureTypeName'])){
		unset($_SESSION['StructureTypeName']);
	}if(isset($_SESSION['ConstructionMaterial'])){
		unset($_SESSION['ConstructionMaterial']);
	}if(isset($_SESSION['ClimateZone'])){
		unset($_SESSION['ClimateZone']);
	}if(isset($_SESSION['YearOfConstructionStartx'])){
		unset($_SESSION['YearOfConstructionStartx']);
	}

$BridgeProfileID	= 0;
if(isset($_POST['SearchString']) or $_POST['BridgeProfileIDX']>0)
{
	if(!isset($_POST['BridgeProfileIDX']))
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
				echo $$key = stripslashes( $val );
			}				
		}
	}
	else
	{
		$query_bsr_resource = "select * from bms_bridgeprofiles where BridgeProfileID=\"".$_POST['BridgeProfileIDX']."\"  and sections_SectionID=".$_SESSION['logined_sections_SectionID'];           
		$result_bsr_resource = mysql_query($query_bsr_resource) or die (mysql_error());		
		while($row_bsr = mysql_fetch_array($result_bsr_resource))
		{			
			foreach($row_bsr AS $key => $val )
			{
				$$key = stripslashes( $val );

			}				
		}
	
	
	}
	
	
	if($_POST['BridgeProfileIDX'] > 0)
		$BridgeProfileID	= $_POST['BridgeProfileIDX'];
	
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
	$comment_spgroup[$i] 							= array();
	$comment_deck									= array();
	
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
		$comment_spgroup[$i]					= $row_bsr['Original'];

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
		$comment_deck[$i]							= $row_bsr['Original'];
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
	echo "<script src=\"../lib/jquery.autocomplete-1.1.3/jquery.autocomplete-min.js\"></script>";	
	
?>

		
		<link href="../lib/jquery/development-bundle/themes/base/jquery.ui.all.css" rel="stylesheet" type="text/css"/>
	<script src="../lib/jquery/js/jquery-1.5.1.min.js"></script>
	<script src="../lib/jquery/js/jquery-ui-1.8.12.custom.min.js"></script>
	<script type="text/javascript" src="../lib/jquery/cal/cal.js"></script> 

	<script>
		
		$(document).ready(function() {
			$("#tabs").tabs();	
			
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
			$('#mysublasttr').show();	
			$('#mysubtr').hide();				
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
                //xmlHttp=new XMLHttpRequest();

                if (window.XMLHttpRequest)
                {
                        // code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlHttp =new XMLHttpRequest();
                }
                else if (window.ActiveXObject)
                {
                        // code for IE6, IE5
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
	

		
	echo "<p class=\"hx1\">View Bridge Report - II</p>";
	
	
	
	echo "<form autocomplete=\"off\"  name=\"myfirstformx\" id=\"myfirstformx\" method=\"POST\" action=\"#\"  >";
		echo "<table>";					
			echo "<tr>";
				echo "<td colspan=\"3\">";
					echo "&nbsp";
				echo "</td>";
			echo "</tr>";
			
			echo "<tr>";
				echo "<td class=\"mytd\"  width=\"185\">";
					echo "<b>Structure Type</b>";
				echo "</td>";
				echo "<td class=\"mytd\">";
					$query_ea		= "select StructureTypeID, StructureTypeName from bms_structuretypes";		
					$result_ea		= mysql_query($query_ea) or die (mysql_error());
					
					echo "<select name=\"StructureTypeName\" class=\"myselect1\">";
						echo "<option>All </option>";
						while($row_ea	= mysql_fetch_array($result_ea))
						{
							$temp++;
							$StructureTypeID    = $row_ea['StructureTypeID'];
							$StructureTypeName	= $row_ea['StructureTypeName'];
							if(isset($_POST['StructureTypeName']) and ($_POST['StructureTypeName'] == $StructureTypeID))
							{
								echo "<option value=\"".$StructureTypeID."\" selected=\"selected\">".$StructureTypeName."</option>";
							}
							else
							{
								echo "<option value=\"".$StructureTypeID."\" >".$StructureTypeName."</option>";
							}
						}
					echo "</select>";								
					echo "</td>";
				echo "</tr>";
				
				echo "<tr>";
				echo "<td class=\"altmytd\">";
					echo "<b>Construction Material</b>";
				echo "</td>";
				echo "<td class=\"altmytd\">";
					$query_ea		= "select ConstructionMaterialID, ConstructionMaterial from bms_constructionmaterials";		
					$result_ea		= mysql_query($query_ea) or die (mysql_error());
					
					echo "<select name=\"ConstructionMaterial\" class=\"myselect1\" >";
						echo "<option>All </option>";
						while($row_ea	= mysql_fetch_array($result_ea))
						{
							$temp++;
							$ConstructionMaterialID = $row_ea['ConstructionMaterialID'];
							$ConstructionMaterial	= $row_ea['ConstructionMaterial'];
							if(isset($_POST['ConstructionMaterial']) and ($_POST['ConstructionMaterial'] == $ConstructionMaterialID))
							{
								echo "<option value=\"".$ConstructionMaterialID."\" selected=\"selected\">".$ConstructionMaterial."</option>";
							}
							else
							{
								echo "<option value=\"".$ConstructionMaterialID."\" >".$ConstructionMaterial."</option>";
							}
						}
					echo "</select>";							
					echo "</td>";
				echo "</tr>";
				
				echo "<tr>";
				echo "<td class=\"mytd\">";
					echo "<b>Climate Zone</b>";
				echo "</td>";
				echo "<td class=\"mytd\">";
					$query_hea		= "select ClimateZoneID, ClimateZone from bms_climatezones";		
					$result_hea		= mysql_query($query_hea) or die (mysql_error());
					echo "<select name=\"ClimateZone\" class=\"myselect1\" >";
						echo "<option>All </option>";
						while($row_hea	= mysql_fetch_array($result_hea))
						{
							$temp++;
							$ClimateZoneID = $row_hea['ClimateZoneID'];
							$ClimateZone   = $row_hea['ClimateZone'];
							if(isset($_POST['ClimateZone']) and ($_POST['ClimateZone'] == $ClimateZoneID))
							{
								echo "<option value=\"".$ClimateZoneID."\" selected=\"selected\">".$ClimateZone."</option>";
							}
							else
							{
								echo "<option value=\"".$ClimateZoneID."\" >".$ClimateZone."</option>";
							}
						}
					echo "</select>";							
					echo "</td>";
				echo "</tr>";
				
				echo "<tr>";	
					echo "<td class=\"altmytd\">";
						echo "<b>Construction Year</b>";
					echo "</td>";				
						echo "<td  class=\"altmytd\">";
						echo "<select name=\"YearOfConstructionStartx\" class=\"myselect1\">";
							echo "<option>All </option>";
							$thisyear = date(Y);
							for($myi=2000; $myi <=$thisyear; $myi++)
							{							
								if(isset($_POST['YearOfConstructionStartx']) and ($_POST['YearOfConstructionStartx'] == $myi))
								{
									echo "<option value=\"".$myi."\" selected=\"selected\">".$myi."</option>";
								}
								else
								{
									echo "<option value=\"".$myi."\" >".$myi."</option>";
								}
							}
						echo "</select>";
					echo "</td>";
				echo "</tr>";
				
			echo "<tr>";
				echo "<td>";
					echo "&nbsp";
				echo "</td>";
				echo "<td>";
					echo "<input type=\"submit\" name=\"select\" value=\"Select\"  class=\"Submit_Button_long\" />";	
				echo "</td>";
			echo "</tr>";	
		echo "</table>";				
	echo "</form>";
	

	
	
	if (isset ($_POST['select']))
	{		
		$StructureTypeName        = $_POST['StructureTypeName'];
		$ConstructionMaterial     = $_POST['ConstructionMaterial'];
		$ClimateZone     	  	  = $_POST['ClimateZone'];
		$YearOfConstructionStartx = $_POST['YearOfConstructionStartx'];
		
		$_SESSION['StructureTypeName'] 			= $StructureTypeName;
		$_SESSION['ConstructionMaterial'] 		= $ConstructionMaterial;
		$_SESSION['ClimateZone'] 				= $ClimateZone;
		$_SESSION['YearOfConstructionStartx'] 	= $YearOfConstructionStartx;
		
		$QueryOne ="SELECT * FROM bms_bridgeprofiles";
		$searcharray =array() ; 
		$arr_lenth = 0;
		
		if ($StructureTypeName != "All"){
			$StructureTypeName = "structuretypes_StructureTypeID = '".$StructureTypeName."'";
			$searcharray [$arr_lenth] = $StructureTypeName ;
			$arr_lenth++;
		}
		if($ConstructionMaterial != "All"){
			$ConstructionMaterial = "constructionmaterials_ConstructionMaterialID = '".$ConstructionMaterial."'";
			$searcharray [$arr_lenth] = $ConstructionMaterial ;
			$arr_lenth++;
		}
		if($ClimateZone != "All"){
			$ClimateZone = "climatezones_ClimateZoneID = '".$ClimateZone."'";
			$searcharray [$arr_lenth] = $ClimateZone ;
			$arr_lenth++;
		}
		if($YearOfConstructionStartx != "All"){
			$YearOfConstructionStartx = "YearOfConstructionStart = '".$YearOfConstructionStartx."'";
			$searcharray [$arr_lenth] = $YearOfConstructionStartx ;
			$arr_lenth++;
		}
		
		
		if ($arr_lenth == 0){
			$result_fac		= mysql_query($QueryOne) or die (mysql_error());
		}
		else
		{
			$a = 0;
			$add_part;
			while ($a < $arr_lenth){
				if ($a == 0){
					$add_part = " WHERE ".$searcharray [$a]." ";
				}
				else {
					$add_part = $add_part."AND ".$searcharray [$a]." ";
				}
				$a++;
			}
			$QueryOne	= $QueryOne.$add_part;
			$result_fac	= mysql_query($QueryOne) or die (mysql_error());
		}
		
		if(mysql_num_rows($result_fac) == 0)
		{
			echo "<p  class=\"bodytext\">";
				echo "<strong>No Bridges were found for given details!</strong>";
			echo "</p>";
		}
			
		else
		{
			echo "<table>";		
				echo "<tr bgcolor=\"#CFEBFA\" align=\"center\">";
			
					echo "<td class=\"myth\">";
						echo "<strong>Structure ID</strong>";
					echo "</td>";
				
					echo "<td class=\"myth\"  height=\"36\"   width=\"250\">";
						echo "<strong>Bridge Name</strong>";
					echo "</td>";
				
					echo "<td class=\"myth\"   width=\"185\">";
						echo "<strong>Road Name</strong>";
					echo "</td>";
					echo "<td class=\"myth\"   width=\"125\">";
						echo "<strong>District</strong>";
					echo "</td>";


					echo "<td class=\"myth\">";
						echo "<strong>Action</strong>";
					echo "</td>";
				echo "</tr>";
			
			$temp = 0;	
			while($row_fac = mysql_fetch_array($result_fac))
			{
				$BridgeProfileID		= $row_fac['BridgeProfileID'];
				$StructureIDx			= $row_fac['StructureID'];
				$BridgeNameX			= $row_fac['BridgeName'];	
				$roadnames_RoadNameID	= $row_fac['roadnames_RoadNameID'];	
				$district_DistrictID	= $row_fac['district_DistrictID'];
				$provinces_ProvinceID	= $row_fac['provinces_ProvinceID'];
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
					echo $StructureIDx;
				echo "</td>";
				
				if($temp%2 == 0)
				{
					echo "<td class=\"mytd\">";
				}
				else
				{
					echo "<td class=\"altmytd\">";				
				}
						echo $BridgeNameX;
					echo "</td>";
				
				if($temp%2 == 0)
				{
					echo "<td class=\"mytd\">";
				}
				else
				{
					echo "<td class=\"altmytd\">";				
				}
						$roadnames_RoadNameID;
						
					$query_hea		= "select RoadNameID, RoadName from bms_roadnames where RoadNameID = ".$roadnames_RoadNameID;		
					$result_hea		= mysql_query($query_hea) or die (mysql_error());
						while($row_hea	= mysql_fetch_array($result_hea))
						{
							$RoadNameID = $row_hea['RoadNameID'];
							$RoadName   = $row_hea['RoadName'];
						}
						
						echo $RoadName;
					echo "</td>";
						
				if($temp%2 == 0)
				{
					echo "<td class=\"mytd\">";
				}
				else
				{
					echo "<td class=\"altmytd\">";				
				}
						$district_DistrictID;
						
						$query_ea		= "select DistrictID, District from bms_districts where DistrictID = ".$district_DistrictID;		
						$result_ea		= mysql_query($query_ea) or die (mysql_error());
							while($row_ea	= mysql_fetch_array($result_ea))
							{
								$temp++;
								$DistrictID  = $row_ea['DistrictID'];
								$District	= $row_ea['District'];
							}
							
						echo $District;
					echo "</td>";
					
				
						
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
					echo "<input type=\"hidden\" name=\"BridgeProfileIDX\" value=".$BridgeProfileID.">";	
					echo "<input type=\"hidden\" name=\"select\" value=\"select\">";	
					
					echo "<input type=\"hidden\" name=\"StructureIDxx\" value=".$StructureIDx.">";
					echo "<input type=\"hidden\" name=\"BridgeNamexx\" value='".$BridgeNameX."'>";
					
					echo "<input type=\"hidden\" name=\"StructureTypeName\" value=".$_POST['StructureTypeName'].">";	
					echo "<input type=\"hidden\" name=\"ConstructionMaterial\" value=".$_POST['ConstructionMaterial'].">";	
					echo "<input type=\"hidden\" name=\"ClimateZone\" value=".$_POST['ClimateZone'].">";	
					echo "<input type=\"hidden\" name=\"YearOfConstructionStartx\" value=".$_POST['YearOfConstructionStartx'].">";	
					
		
					echo "</td>";
				echo "</form>";
						
				echo "</tr>";
			}
		}				
		echo "</table>";

			
		
		if(!isset($_POST['StructureIDxx']))
		{
			echo "
			<br />
			<table align=\"right\">
				<tr>
					<td>
						<a  target=\"_blank\" href=\"./report_bridgeproperties_main_01.php\"><input type=\"button\" name=\"print\" value=\"Print\" class=\"Submit_Button_Long\"></a>
					</td>
				</tr>
			</table>
			";
		}
	}
	
	
	
	
	if(isset($_POST['StructureIDxx']))
	{
		$_SESSION['BridgeProfileID'] 	= $_POST['BridgeProfileIDX'];
		echo "<br />";
		echo "<br />";
		echo "<br />";
			echo "<span class=\"body\" ><b>";
			echo $_POST['StructureIDxx'];
			echo "&nbsp;&nbsp;&nbsp;";
			echo "-";
			echo "&nbsp;&nbsp;&nbsp;";
			echo $_POST['BridgeNamexx'];
		echo "<br />";
		echo "<br />";
		echo "</b></span>";
		
	}
	
	
	include ("view_bridge_more.php");	

	echo "</body>";
	include '../bottom.php';

?>