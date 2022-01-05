<?php
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
	echo "<script src=\"../lib/jquery.autocomplete-1.1.3/jquery.autocomplete-min.js\"></script>";	
	
?>

		
	<link href="../lib/jquery/development-bundle/themes/base/jquery.ui.all.css" rel="stylesheet" type="text/css"/>
	<script src="../lib/jquery/js/jquery-1.5.1.min.js"></script>
	<script src="../lib/jquery/js/jquery-ui-1.8.12.custom.min.js"></script>
	<script type="text/javascript" src="../lib/jquery/cal/cal.js"></script> 

	<script>
		
		$(document).ready(function() {
			$("#tabs").tabs();	
			
			
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
	

		
	echo "<p class=\"hx1\">Views of Bridges by Properties</p>";

	
			echo "<form name=\"view_fac\" id=\"view_fac\" method=\"POST\" autocomplete=\"off\" action=\"#\">";				
				echo "<table>";
					echo "<tr>";
						echo "<td colspan=\"3\">";
							echo "&nbsp";
						echo "</td>";
					echo "</tr>";
					
					echo "<tr>";
						echo "<td colspan=\"3\">";
							echo "&nbsp";
						echo "</td>";
					echo "</tr>";
					
					echo "<tr>";
						echo "<td class=\"mytd\">";
							echo "<b>Structure Type</b>";
						echo "</td>";
						echo "<td class=\"mytd\">";
							$query_ea		= "select StructureTypeID, StructureTypeName from bms_structuretypes order by StructureTypeName";		
							$result_ea		= mysql_query($query_ea) or die (mysql_error());
							
							echo "<select name=\"StructureTypeName\" class=\"myselect1\">";
								echo "<option>All </option>";
								while($row_ea	= mysql_fetch_array($result_ea))
								{
									$temp++;
									$StructureTypeID    = $row_ea['StructureTypeID'];
									$StructureTypeName	= $row_ea['StructureTypeName'];
									
									if(isset($_POST['StructureTypeID']) and ($_POST['StructureTypeID'] == $StructureTypeID))
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
							echo "<b>Function of Bridge</b>";
						echo "</td>";
						echo "<td class=\"altmytd\">";
							$query_ea		= "select FuncOfBridgeID, FuncOfBridge from bms_funcofbridges";		
							$result_ea		= mysql_query($query_ea) or die (mysql_error());
							
							echo "<select name=\"FuncOfBridge\" class=\"myselect1\" >";
								echo "<option>All </option>";
								while($row_ea	= mysql_fetch_array($result_ea))
								{
									$temp++;
									$FuncOfBridgeID = $row_ea['FuncOfBridgeID'];
									$FuncOfBridge	= $row_ea['FuncOfBridge'];
									if(isset($_POST['FuncOfBridgeID']) and ($_POST['FuncOfBridgeID'] == $FuncOfBridgeID))
									{
										echo "<option value=\"".$FuncOfBridgeID."\" selected=\"selected\">".$FuncOfBridge."</option>";
									}
									else
									{
										echo "<option value=\"".$FuncOfBridgeID."\" >".$FuncOfBridge."</option>";
									}
								}
							echo "</select>";							
							echo "</td>";
						echo "</tr>";
						
						echo "<tr>";
						echo "<td class=\"mytd\">";
							echo "<b>Construction Material</b>";
						echo "</td>";
						echo "<td class=\"mytd\">";
							$query_hea		= "select ConstructionMaterialID, ConstructionMaterial from bms_constructionmaterials";		
							$result_hea		= mysql_query($query_hea) or die (mysql_error());
							echo "<select name=\"ConstructionMaterial\" class=\"myselect1\" >";
								echo "<option>All </option>";
								while($row_hea	= mysql_fetch_array($result_hea))
								{
									$temp++;
									$ConstructionMaterialID = $row_hea['ConstructionMaterialID'];
									$ConstructionMaterial   = $row_hea['ConstructionMaterial'];
									if(isset($_POST['ConstructionMaterialID']) and ($_POST['ConstructionMaterialID'] == $ConstructionMaterialID))
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
						echo "<td>";
							echo "&nbsp";
						echo "</td>";
						echo "<td>";
							echo "<input type=\"submit\" name=\"select\" value=\"Select\"  class=\"Submit_Button_long\" />";	
						echo "</td>";
					echo "</tr>";	
				echo "</table>";
			echo"</form>";
	
	
		if (isset ($_POST['select'])){
		
			$StructureTypeName   = $_POST['StructureTypeName'];
			$FuncOfBridge        = $_POST['FuncOfBridge'];
			$ConstructionMaterial= $_POST['ConstructionMaterial'];
			
			$QueryOne ="SELECT * FROM bms_bridgeprofiles";
			$searcharray =array() ; 
			$arr_lenth = 0;
			if ($StructureTypeName != "All"){
				$StructureTypeName = "structuretypes_StructureTypeID = '".$StructureTypeName."'";
				$searcharray [$arr_lenth] = $StructureTypeName ;
				$arr_lenth++;
			}
			if($FuncOfBridge != "All"){
				$FuncOfBridge = "funcofbridges_FuncOfBridgeID = '".$FuncOfBridge."'";
				$searcharray [$arr_lenth] = $FuncOfBridge ;
				$arr_lenth++;
			}
			if($ConstructionMaterial != "All"){
				$ConstructionMaterial = "constructionmaterials_ConstructionMaterialID = '".$ConstructionMaterial."'";
				$searcharray [$arr_lenth] = $ConstructionMaterial ;
				$arr_lenth++;
			}
			
			
			if ($arr_lenth == 0){
				$result_fac		= mysql_query($QueryOne) or die (mysql_error());
			}
			else{
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
				echo $QueryOne	= $QueryOne.$add_part;
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
							echo "<strong>Bridge Structure ID</strong>";
						echo "</td>";
					
						echo "<td class=\"myth\"  height=\"36\">";
							echo "<strong>Bridge Name</strong>";
						echo "</td>";
					
						echo "<td class=\"myth\">";
							echo "<strong>Structure Type</strong>";
						echo "</td>";
						echo "<td class=\"myth\">";
							echo "<strong>Function of Bridge</strong>";
						echo "</td>";
						echo "<td class=\"myth\">";
							echo "<strong>Construction Material</strong>";
						echo "</td>";
 
						echo "<td class=\"myth\">";
							echo "<strong>Action</strong>";
						echo "</td>";
					echo "</tr>";
				
				$temp = 0;	
				while($row_fac = mysql_fetch_array($result_fac))
				{
					$BridgeProfileID		= $row_fac['BridgeProfileID'];
					$StructureID			= $row_fac['StructureID'];
					$BridgeName				= $row_fac['BridgeName'];	
					$StructureTypeID		= $row_fac['structuretypes_StructureTypeID'];	
					$FuncOfBridgeID			= $row_fac['funcofbridges_FuncOfBridgeID'];
					$ConstructionMaterialID	= $row_fac['constructionmaterials_ConstructionMaterialID'];
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
						echo $StructureID;
					echo "</td>";
					
					if($temp%2 == 0)
					{
						echo "<td class=\"mytd\">";
					}
					else
					{
						echo "<td class=\"altmytd\">";				
					}
							echo $BridgeName;
						echo "</td>";
					
					if($temp%2 == 0)
					{
						echo "<td class=\"mytd\">";
					}
					else
					{
						echo "<td class=\"altmytd\">";				
					}
						
						$query_ea		= "select StructureTypeID, StructureTypeName from bms_structuretypes where StructureTypeID = ".$StructureTypeID;		
						$result_ea		= mysql_query($query_ea) or die (mysql_error());

							while($row_ea	= mysql_fetch_array($result_ea))
							{
								$temp++;
								$StructureTypeID    = $row_ea['StructureTypeID'];
								$StructureTypeName	= $row_ea['StructureTypeName'];
							}
							
							echo $StructureTypeName;
						echo "</td>";
							
					if($temp%2 == 0)
					{
						echo "<td class=\"mytd\">";
					}
					else
					{
						echo "<td class=\"altmytd\">";				
					}

							$query_ea		= "select FuncOfBridgeID, FuncOfBridge from bms_funcofbridges where FuncOfBridge = ".$FuncOfBridgeID;		
							$result_ea		= mysql_query($query_ea) or die (mysql_error());

								while($row_ea	= mysql_fetch_array($result_ea))
								{
									$temp++;
									$FuncOfBridgeID = $row_ea['FuncOfBridgeID'];
									$FuncOfBridge	= $row_ea['FuncOfBridge'];
								}
								
							echo $FuncOfBridge;
						echo "</td>";
						
					if($temp%2 == 0)
					{
						echo "<td class=\"mytd\">";
					}
					else
					{
						echo "<td class=\"altmytd\">";				
					}
							$query_hea		= "select ConstructionMaterialID, ConstructionMaterial from bms_constructionmaterials where ConstructionMaterialID = ".$ConstructionMaterialID;		
							$result_hea		= mysql_query($query_hea) or die (mysql_error());
								while($row_hea	= mysql_fetch_array($result_hea))
								{
									$temp++;
									$ConstructionMaterialID = $row_hea['ConstructionMaterialID'];
									$ConstructionMaterial   = $row_hea['ConstructionMaterial'];
								}
								
							echo $ConstructionMaterial;
									
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
						echo "<input type=\"hidden\" name=\"BridgeProfileID\" value=".$BridgeProfileID.">";	
						echo "</td>";
					echo "</form>";
							
					echo "</tr>";
				}
			}				
				echo "</table>";				
		}
	
{	
	
	echo "<form autocomplete=\"off\"  name=\"myfirstform\" id=\"myfirstform\" method=\"POST\" action=\"#\"  >";
	
	echo $BridgeProfileID = $_POST['BridgeProfileID'];

	?>
	<div id="tabs">
		<ul>
			<li><a href="#fragment-1"><span>General</span></a></li>
			<li><a href="#fragment-2"><span>Structure Info</span></a></li>
			<li><a href="#fragment-3"><span>Geometry</span></a></li>
			<li><a href="#fragment-4"><span>Clearance</span></a></li>
			<li><a href="#fragment-5"><span>Superstructure</span></a></li>
			<li><a href="#fragment-6"><span>SubStructure</span></a></li>
			<li><a href="#fragment-7"><span>Environment</span></a></li>
			<li><a href="#fragment-8"><span>Attachments</span></a></li>
		</ul>
	
		<div id="fragment-1">
		<?php
			echo "<p class=\"bodytextbold\"><u>General Information</u></p>";
			
		
			echo "<table class=\"bodytext\">
				<tr>
					<td class=\"mytd\">Structure ID</td>
					<td class=\"mytd\" width=\"400\">".$StructureID."</td>
					<td><span id=\"structure_id\" class=\"bodytextred\"></span></td>
				</tr>
				<tr>
					<td class=\"mytd\">Name of the Bridge</td>
					<td class=\"mytd\">".$BridgeName."</td>
				</tr>	
				
				<tr>
				
				<td class=\"mytd\">Owner of the Bridge</td>
				";
					echo "<td  class=\"mytd\">";
					$query_dis	= "select OwnerID, OwnerName from bms_owners order by OwnerName";
					$result_dis		= mysql_query($query_dis) or die (mysql_error());

						while($row_dis	= mysql_fetch_array($result_dis))
						{
							
							$OwnerID 	= $row_dis['OwnerID'];
							$OwnerName	= $row_dis['OwnerName'];
							if($owners_OwnerID == $OwnerID)
							{
								echo $OwnerName;
							}
							else
							{
							}
						}
				echo "</td>";
				echo "
				
				</tr>

				<tr>
				
				<td class=\"mytd\">Road Name</td>
				";
					echo "<td  class=\"mytd\">";
					$query_dis	= "select RoadNameID, RoadName from bms_roadnames order by RoadName";
					$result_dis		= mysql_query($query_dis) or die (mysql_error());

						while($row_dis	= mysql_fetch_array($result_dis))
						{
						
							$RoadNameID = $row_dis['RoadNameID'];
							$RoadName	= $row_dis['RoadName'];
							if($roadnames_RoadNameID == $RoadNameID)
							{
								echo $RoadName;
							}
							else
							{
							}
						}
				echo "</td>";
				echo "
				
				</tr>
				
				<tr>
				
				<td class=\"mytd\">Road Number</td>
				";
					echo "<td  class=\"mytd\">";
					$query_dis	= "select RouteNoID, RouteNo from bms_routenos order by RouteNo";
					$result_dis		= mysql_query($query_dis) or die (mysql_error());

						while($row_dis	= mysql_fetch_array($result_dis))
						{
							
							$RouteNoID  = $row_dis['RouteNoID'];
							$RouteNo	= $row_dis['RouteNo'];
							if($routenos_RouteNoID == $RouteNoID)
							{
								echo $RouteNo;
							}
							else
							{
							}
						}
				echo "</td>";
				echo "
				
				</tr>
				
				<tr>
				
				<td class=\"mytd\">Road Class</td>
				";
					echo "<td  class=\"mytd\">";
					$query_dis	= "select RoadClassID, RoadClass from bms_roadclasses";
					$result_dis		= mysql_query($query_dis) or die (mysql_error());

						while($row_dis	= mysql_fetch_array($result_dis))
						{
							
							$RoadClassID  = $row_dis['RoadClassID'];
							$RoadClass	  = $row_dis['RoadClass'];
							if($roadclasses_RoadClassID == $RoadClassID)
							{
								echo $RoadClass;
							}
							else
							{
							}
						}
				echo "</td>";
				echo "
				
				</tr>
				
				<tr>			
				<td class=\"mytd\" width=\"285\">Function of the Bridge</td>
				";
					echo "<td  class=\"mytd\">";
					$query_dis	= "select FuncOfBridgeID, FuncOfBridge from bms_funcofbridges order by FuncOfBridge";
					$result_dis		= mysql_query($query_dis) or die (mysql_error());

						while($row_dis	= mysql_fetch_array($result_dis))
						{
							
							$FuncOfBridgeID = $row_dis['FuncOfBridgeID'];
							$FuncOfBridge	= $row_dis['FuncOfBridge'];
							if($funcofbridges_FuncOfBridgeID == $FuncOfBridgeID)
							{
								echo $FuncOfBridge;
							}
							else
							{
							}
						}
				echo "</td>";
				echo "			
				</tr>
				
				
				
				<tr name=\"div_nriver\" id=\"div_nriver\">			
				<td class=\"mytd\" >Name of the River</td>
				";
					echo "<td  class=\"mytd\">";
					$query_dis	= "select RiverID, RiverName from bms_rivers order by RiverName";
					$result_dis		= mysql_query($query_dis) or die (mysql_error());

						while($row_dis	= mysql_fetch_array($result_dis))
						{
							
							$RiverID    = $row_dis['RiverID'];
							$RiverName	= $row_dis['RiverName'];
							if($river_RiverID == $RiverID)
							{
								echo $RiverName;
							}
							else
							{
							}
						}
				echo "</td>";
				echo "
				
				</tr>
		
				<tr name=\"div_nr\" id=\"div_nuproad\">
					<td class=\"mytd\">Name of the Road - UnderPass</td>
					<td class=\"mytd\">".$UnderPassRoad."</td>
					<td><span id=\"oname_id\" class=\"bodytextred\"></span></td>
				</tr>	
			
				<tr name=\"div_nr\" id=\"div_noproad\">
					<td class=\"mytd\">Name of the Road - OverPass</td>
					<td class=\"mytd\">".$OverPassRoad."</td>
					<td><span id=\"oname_id\" class=\"bodytextred\"></span></td>
				</tr>	
				

				
				<tr name=\"div_nr\" id=\"div_norail\">
				
				<td class=\"mytd\">Name of the Railway - Road over rail</td>
				";
					echo "<td  class=\"mytd\">";
					$query_dis	= "select * from bms_railroadnames order by RailRoadName";
					$result_dis		= mysql_query($query_dis) or die (mysql_error());

						while($row_dis	= mysql_fetch_array($result_dis))
						{
						
							$RailRoadNameID    = $row_dis['RailRoadNameID'];
							$RailRoadName	= $row_dis['RailRoadName'];
							if($railroadnames_RailRoadID == $RailRoadNameID)
							{
								echo $RailRoadName;
							}
							else
							{
							}
						}
				echo "</td>";
				echo "			
				</tr>		
			</table>";
			
			
			echo "<br />";
			echo "<p class=\"bodytextbold\"><u>Overview</u></p>";
			
		
			echo "<table class=\"bodytext\">
			
				<tr>			
					<td class=\"mytd\" width=\"285\">Economics Factor</td>
					";
						echo "<td  class=\"mytd\">";
						$query_dis	= "select * from bms_economicsfactors order by EconomicsFactorName";
						$result_dis		= mysql_query($query_dis) or die (mysql_error());

							while($row_dis	= mysql_fetch_array($result_dis))
							{
							
								$EconomicsFactorID 	= $row_dis['EconomicsFactorID'];
								$EconomicsFactorName	= $row_dis['EconomicsFactorName'];
								if($economicsfactors_EconomicsFactorID == $EconomicsFactorID)
								{
									echo $EconomicsFactorName;
								}
								else
								{
								}
							}
					echo "</td>";
					echo "			
				</tr>
				
				<tr>			
					<td class=\"mytd\" width=\"285\">Structure Type</td>
					";
						echo "<td  class=\"mytd\" width=\"400\">";
						$query_dis	= "select * from bms_structuretypes order by StructureTypeName";
						$result_dis		= mysql_query($query_dis) or die (mysql_error());

							while($row_dis	= mysql_fetch_array($result_dis))
							{
							
								$StructureTypeID 	= $row_dis['StructureTypeID'];
								$StructureTypeName	= $row_dis['StructureTypeName'];
								if($structuretypes_StructureTypeID == $StructureTypeID)
								{
									echo $StructureTypeName;
								}
								else
								{
								}
							}
					echo "</td>";
					echo "			
				</tr>
				
				
				
				<tr>			
					<td class=\"mytd\" >Construction Material</td>
					";
						echo "<td  class=\"mytd\">";
						$query_dis	= "select * from bms_constructionmaterials order by ConstructionMaterial";
						$result_dis		= mysql_query($query_dis) or die (mysql_error());

							while($row_dis	= mysql_fetch_array($result_dis))
							{
								
								$ConstructionMaterialID 	= $row_dis['ConstructionMaterialID'];
								$ConstructionMaterial	= $row_dis['ConstructionMaterial'];
								if($constructionmaterials_ConstructionMaterialID == $ConstructionMaterialID)
								{
									echo $ConstructionMaterial;
								}
								else
								{
								}
							}
					echo "</td>";
					echo "			
				</tr>
				
				
				<tr>			
					<td class=\"mytd\" >Construction Year</td>
					";
						echo "<td  class=\"mytd\">";
							$thisyear = date(Y);
							for($myi=2000; $myi <=$thisyear; $myi++)
							{							
								if($YearOfConstructionStart == $myi)
								{
									echo $myi;
								}
								else
								{
								}
							}
					echo "</td>";
					echo "			
				</tr>
				
				
				
				<tr>			
					<td class=\"mytd\" >Operational Status</td>
					";
						echo "<td  class=\"mytd\">";
						$query_dis	= "select * from bms_operationalstatuses order by OperationalStatus";
						$result_dis		= mysql_query($query_dis) or die (mysql_error());

							while($row_dis	= mysql_fetch_array($result_dis))
							{
								
								$OperationalStatusID	= $row_dis['OperationalStatusID'];
								$OperationalStatus	= $row_dis['OperationalStatus'];
								if($operationalstatuses_OperationalStatusID == $OperationalStatusID)
								{
									echo $OperationalStatus;
								}
								else
								{
								}
							}
					echo "</td>";
					echo "			
				</tr>
				
				
				
				<tr>			
					<td class=\"mytd\" >Operational Status Date</td>
					";
						echo "<td  class=\"mytd\">";					
						
						echo $OperationalStatusDate;
						
					
					echo "</td>";
					echo "			
				</tr>						
				
			</table>";
			
			
			
			echo "<br />";
			echo "<p class=\"bodytextbold\"><u>Location Information</u></p>";
			
		
			echo "<table class=\"bodytext\">
			
				<tr>			
					<td class=\"mytd\" width=\"285\">District</td>
					";
						echo "<td  width=\"400\" class=\"mytd\">";
						$query_dis	= "select * from bms_districts order by District";
						$result_dis		= mysql_query($query_dis) or die (mysql_error());

							while($row_dis	= mysql_fetch_array($result_dis))
							{
							
								$DistrictID 	= $row_dis['DistrictID'];
								$District	= $row_dis['District'];
								if($district_DistrictID == $DistrictID)
								{
									echo $District;
								}
								else
								{
								}
							}
					echo "</td>";
					echo "			
				</tr>
				
				
				<tr>			
					<td class=\"mytd\" width=\"285\">Province</td>
					";
						echo "<td  width=\"400\" class=\"mytd\">";
						$query_dis	= "select * from bms_provinces order by Province";
						$result_dis		= mysql_query($query_dis) or die (mysql_error());

							while($row_dis	= mysql_fetch_array($result_dis))
							{
							
								$ProvinceID 	= $row_dis['ProvinceID'];
								$Province	= $row_dis['Province'];
								if($provinces_ProvinceID == $ProvinceID)
								{
									echo $Province;
								}
								else
								{
								}
							}
					echo "</td>
									
				
				<tr>			
					<td class=\"mytd\" >EE-Division</td>
					";
						echo "<td  class=\"mytd\">";
						echo $EEDivision;
					echo "</td>";
					echo "			
				</tr>
				
				
				
				<tr>			
					<td class=\"mytd\" >Closest Town</td>
					";
						echo "<td  class=\"mytd\">";
						echo $ClosestTown;
					echo "</td>";
					echo "			
				</tr>
				
				
				<tr>			
					<td class=\"mytd\" >Start Chainage (Km)</td>
					";
						echo "<td  class=\"mytd\">";
						echo $StartChainage;
					echo "</td>";
					echo "			
				</tr>
				
				
				<tr>			
					<td class=\"mytd\" >End Chainage (Km)</td>
					";
						echo "<td  class=\"mytd\">";
						echo $EndChainage;
					echo "</td>";
					echo "			
				</tr>
				
				
				<tr>			
					<td class=\"mytd\" >Gazetted Length (m)</td>
					";
						echo "<td  class=\"mytd\">";
						echo $GazettedLength;
					echo "</td>";
					echo "			
				</tr>
				
				
				
				
				<tr>			
					<td class=\"mytd\" >GPS Coordinate (N)</td>
					";
						echo "<td  class=\"mytd\">";
						echo $GPSCoordinateN;
					echo "</td>";
					echo "			
				</tr>
				
				
				<tr>			
					<td class=\"mytd\" >GPS Coordinate (E)</td>
					";
						echo "<td  class=\"mytd\">";
						echo $GPSCoordinateE;
					echo "</td>";
					echo "			
				</tr>
				
				
				<tr>			
					<td class=\"mytd\" >GPS Coordinate (Z)</td>
					";
						echo "<td  class=\"mytd\">";
						echo $GPSCoordinateZ;
					echo "</td>";
					echo "			
				</tr>
							
				
			</table>";
			
			
			
			
			
		
		
		?>
		</div>
		
			
		<div id="fragment-2">
		<?php
			
			
			echo "<p class=\"bodytextbold\"><u>Structure Information</u></p>";
			
		
			echo "<table class=\"bodytext\">
			
				<tr>			
					<td class=\"mytd\" width=\"285\">Design Standard</td>
					";
						echo "<td  class=\"mytd\" width=\"400\">";
						$query_dis	= "select * from bms_designstandards order by DesignStandard";
						$result_dis		= mysql_query($query_dis) or die (mysql_error());

							while($row_dis	= mysql_fetch_array($result_dis))
							{
							
								$DesignStandardID 	= $row_dis['DesignStandardID'];
								$DesignStandard	= $row_dis['DesignStandard'];
								if($designstandards_DesignStandardID == $DesignStandardID)
								{
									echo $DesignStandard;
								}
								else
								{
								}
							}
					echo "</td>";
					echo "			
				</tr>
				
				
				
				<tr>			
					<td class=\"mytd\" >Design	Loading (Tons)</td>
					";
						echo "<td  class=\"mytd\">";
						echo $DesignLoading;
					echo "</td>";
					echo "			
				</tr>
				
				
				
				
				<tr>			
					<td class=\"mytd\" >Structure (Deck area) Length (m)</td>
					";
						echo "<td  class=\"mytd\">";
						echo $StructureLength;
					echo "</td>";
					echo "			
				</tr>
				
				
				<tr>			
					<td class=\"mytd\" >Structure (Deck area) Width	(m)</td>
					";
						echo "<td  class=\"mytd\">";
						echo $StructureWidth;
					echo "</td>";
					echo "			
				</tr>
				
				
				
				<tr>			
					<td class=\"mytd\" >Number of Spans</td>
					";
						echo "<td  class=\"mytd\">";
							for($myj=0; $myj<=15; $myj++)
							{							
								if($NoOfSpans == $myj)
								{
									echo $myj;
								}
								else
								{
								}
							}
					echo "</td>";
					echo "			
				</tr>
				
				
				<tr>			
					<td class=\"mytd\" >Number of Piers</td>
					";
						echo "<td  class=\"mytd\">";
							for($myk=0; $myk<=15; $myk++)
							{							
								if($NoOfPiers == $myk)
								{
									echo $myk;
								}
								else
								{
								}
							}
					echo "</td>";
					echo "			
				</tr>	
				
			</table>";	
			
		
		
		
		echo "<p class=\"bodytextbold\"><br /><u>Structure Load Capacity</u></p>";
			
		
			echo "<table class=\"bodytext\">
			
				<tr>			
					<td class=\"mytd\" width=\"285\">Gross Load Limit (Tons)</td>
					";
						echo "<td  class=\"mytd\" width=\"400\">";
							echo $GrossLoadLimit;
					echo "</td>";
					echo "			
				</tr>
				
				
				
				<tr>			
					<td class=\"mytd\" >Posted Load Limit (Tons)</td>
					";
						echo "<td  class=\"mytd\">";
						echo $PostedLoadLimit;
					echo "</td>";
					echo "			
				</tr>
				
				
				
				
				<tr>			
					<td class=\"mytd\" >AADT</td>
					";
						echo "<td  class=\"mytd\">";
						echo $AADT;
					echo "</td>";
					echo "			
				</tr>
				
				
				<tr>			
					<td class=\"mytd\" >Detours (Km)</td>
					";
						echo "<td  class=\"mytd\">";
						echo $Detours;
					echo "</td>";
					echo "			
				</tr>
				
				
				<tr>			
					<td class=\"mytd\" >Heavy Vehicle (HV) %</td>
					";
						echo "<td  class=\"mytd\">";
						echo $HeavyVehicle;
					echo "</td>";
					echo "			
				</tr>
										
			</table>";
			
			
			
			
			
			
			
			
			
		
		
		
		echo "<p class=\"bodytextbold\"><br /><u>Attached Services</u></p>";
			
		
			echo "<table class=\"bodytext\">
			
				<tr>			
					<td class=\"mytd\" width=\"285\">Services</td>
					";
						echo "<td  class=\"mytd\" width=\"400\">";
							echo $AttachmentsServices;
					echo "</td>";
					echo "			
				</tr>
				
				
				
				<tr>			
					<td class=\"mytd\" >Details</td>
					";
						echo "<td  class=\"mytd\">";
						echo $AttachmentsDetails;
					echo "</td>";
					echo "			
				</tr>
				
				
				
				
				<tr>			
					<td class=\"mytd\" >Locations</td>
					";
						echo "<td  class=\"mytd\">";
						$query_dis	= "select * from bms_attachmentslocations order by AttachmentsLocations";
						$result_dis		= mysql_query($query_dis) or die (mysql_error());

							while($row_dis	= mysql_fetch_array($result_dis))
							{
							
								$AttachmentsLocationsID 	= $row_dis['AttachmentsLocationsID'];
								$AttachmentsLocations	= $row_dis['AttachmentsLocations'];
								if($attachmentslocations_AttachmentsLocationsID == $AttachmentsLocationsID)
								{
									echo $AttachmentsLocations;
								}
								else
								{
								}
							}
					echo "</td>";
					echo "			
				</tr>
				
				
				<tr>			
					<td class=\"mytd\" >Number of Lamp Posts</td>
					";
						echo "<td  class=\"mytd\">";
							echo $NumberOfLampPosts;
						echo "</td>";
					echo "			
				</tr>
				
										
			</table>";
		
		?>
		</div>
			

		<div id="fragment-3">
		<?php
			
			
			echo "<p class=\"bodytextbold\"><u>Structure Geometry</u></p>";
			
		
			echo "<table class=\"bodytext\">
			
				
				<tr>			
					<td class=\"mytd\"  width=\"285\">Carriageway Width (m)</td>
					";
						echo "<td  width=\"400\" class=\"mytd\">";
						echo $CarriagewayWidth;
					echo "</td>";
					echo "			
				</tr>
				
				
				
				
				<tr>			
					<td class=\"mytd\" >Number of Lanes</td>
					";
						echo "<td  class=\"mytd\">";
						
							for($myj=0; $myj<=10; $myj++)
							{							
								if($NoOfSpans == $myj)
								{
									echo $myj;
								}
								else
								{
								}
							}
					echo "</td>";
					echo "			
				</tr>
				
				
				<tr>			
					<td class=\"mytd\" >Lane Width (m)</td>
					";
						echo "<td  class=\"mytd\">";
						echo $LaneWidth;
					echo "</td>";
					echo "			
				</tr>
				
				
				<tr>			
					<td class=\"mytd\" >Foot Path Width Left (m)</td>
					";
						echo "<td  class=\"mytd\">";
						echo $FootPathWidthLeft;
					echo "</td>";
					echo "			
				</tr>
				
				<tr>			
					<td class=\"mytd\" >Foot Path Width Right (m)</td>
					";
						echo "<td  class=\"mytd\">";
						echo $FootPathWidthRight;
					echo "</td>";
					echo "			
				</tr>
				
				
				
				
				
				
				
				<tr>			
					<td class=\"mytd\" >Median Width (m)</td>
					";
						echo "<td  class=\"mytd\">";
						echo $MedianWidth;
					echo "</td>";
					echo "			
				</tr>
				
				<tr>			
					<td class=\"mytd\" >Median Height (m)</td>
					";
						echo "<td  class=\"mytd\">";
						echo $MedianHeight;
					echo "</td>";
					echo "			
				</tr>
				
				<tr>			
					<td class=\"mytd\" >Barrier Width (m)</td>
					";
						echo "<td  class=\"mytd\">";
						echo $BarrierWidth;
					echo "</td>";
					echo "			
				</tr>
				
				<tr>			
					<td class=\"mytd\" >Barrier Height (m)</td>
					";
						echo "<td  class=\"mytd\">";
						echo $BarrierHeight;
					echo "</td>";
					echo "			
				</tr>
				
				
				
				
				<tr>			
					<td class=\"mytd\" >Road Approach Vertical Alignment (m)</td>
					";
						echo "<td  class=\"mytd\">";
						echo $RoadApproachAlignmentVertical;
					echo "</td>";
					echo "			
				</tr>
				
				<tr>			
					<td class=\"mytd\" >Road Approach Horizontal Alignment (m)</td>
					";
						echo "<td  class=\"mytd\">";
						echo $RoadApproachAlignmentHorizontal;
					echo "</td>";
					echo "			
				</tr>
				
				
				
				
				
				
				<tr>			
					<td class=\"mytd\" >Span Type</td>
					";
						echo "<td  class=\"mytd\">";
						$query_dis	= "select * from bms_spantypes order by SpanType";
						$result_dis		= mysql_query($query_dis) or die (mysql_error());

							while($row_dis	= mysql_fetch_array($result_dis))
							{
							
								$SpanTypeID 	= $row_dis['SpanTypeID'];
								$SpanType	= $row_dis['SpanType'];
								if($spantypes_SpanTypeID == $SpanTypeID)
								{
									echo $SpanType;
								}
								else
								{
								}
							}
					echo "</td>";
					echo "			
				</tr>
				
				
				<tr>			
					<td class=\"mytd\" >Skew Angle (degree) </td>
					";
						echo "<td  class=\"mytd\">";
						echo $SkewAngle;
					echo "</td>";
					echo "			
				</tr>
				
				
				
				
				
				
				
				<tr>			
					<td class=\"mytd\" >Approach Safety Barrier Type</td>
					";
						echo "<td  class=\"mytd\">";
						$query_dis	= "select * from bms_barriertypes order by BarrierType";
						$result_dis		= mysql_query($query_dis) or die (mysql_error());

							while($row_dis	= mysql_fetch_array($result_dis))
							{
							
								$BarrierTypeID 	= $row_dis['BarrierTypeID'];
								$BarrierType	= $row_dis['BarrierType'];
								if($barriertypes_BarrierTypeID == $BarrierTypeID)
								{
									echo $BarrierType;
								}
								else
								{
								}
							}
					echo "</td>";
					echo "			
				</tr>
				
				
				
				
				
				
				<tr>			
					<td class=\"mytd\" >Approach Safety Barrier Location</td>
					";
						echo "<td  class=\"mytd\">";
						$query_dis	= "select * from bms_barrierlocations order by BarrierLocations";
						$result_dis		= mysql_query($query_dis) or die (mysql_error());

							while($row_dis	= mysql_fetch_array($result_dis))
							{
							
								$BarrierLocationsID 	= $row_dis['BarrierLocationsID'];
								$BarrierLocations	= $row_dis['BarrierLocations'];
								if($barrierlocations_BarrierLocationsID == $BarrierLocationsID)
								{
									echo $BarrierLocations;
								}
								else
								{
								}
							}
					echo "</td>";
					echo "			
				</tr>	
				
				
					
				
			</table>";	
			
		
		?>
		</div>
			
			
		<div id="fragment-4">
		<?php
			
			
			echo "<p class=\"bodytextbold\" name=\"clearance_wt_pwc\"  id=\"clearance_wt_pwc\" ><u>Waterway Clearance</u></p>";
			
		
			echo "<table class=\"bodytext\" name=\"clearance_wt_twc\"  id=\"clearance_wt_twc\">
			
				
				<tr>			
					<td class=\"mytd\"  width=\"285\">Height from invert to bridge underside (m)</td>
					";
						echo "<td  class=\"mytd\" width=\"400\">";
						echo $HeightInvertBridgeUnderside;
					echo "</td>";
					echo "			
				</tr>
				
				
				
				
				<tr>			
					<td class=\"mytd\" >Height from OWL to bridge underside (m)</td>
					";
						echo "<td  class=\"mytd\">";
						echo $HeightOWLBridgeUnderside;
					echo "</td>";
					echo "			
				</tr>
				
				
				<tr>			
					<td class=\"mytd\" >Highest flood level wrt bridge underside (m)</td>
					";
						echo "<td  class=\"mytd\">";
						echo $HighestFloodLevelBridgeUnderside;
					echo "</td>";
					echo "			
				</tr>
				
				
				<tr>			
					<td class=\"mytd\" >Normal flood level wrt bridge underside (m)</td>
					";
						echo "<td  class=\"mytd\">";
						echo $NormalFloodLevelBridgeUnderside;
					echo "</td>";
					echo "			
				</tr>
				
				<tr>			
					<td class=\"mytd\" >Head Room (m)</td>
					";
						echo "<td  class=\"mytd\">";
						echo $HeadRoom;
					echo "</td>";
					echo "			
				</tr>
				
				<tr>			
					<td class=\"mytd\" >Navigable (m)</td>
					";
						echo "<td  class=\"mytd\">";
						echo $Navigable;
					echo "</td>";
					echo "			
				</tr><table>";
				
				
				
				
				
			
			echo "<p class=\"bodytextbold\" name=\"clearance_wt_ph\" id=\"clearance_wt_ph\"   ><br /><u>Hydraulic Information</u></p>";

			echo "<p class=\"bodytextbold\" name=\"clearance_wt_pss\" id=\"clearance_wt_pss\" ><br /><u>Sounding/ Scour</u></p>";


			echo "<p class=\"bodytextbold\"  name=\"clearance_nonwt_p\" id=\"clearance_nonwt_p\"   ><u>Clearance</u></p>";
			
		
			echo "<table class=\"bodytext\" name=\"clearance_nonwt_tb\" id=\"clearance_nonwt_tb\">
			
				
					<tr>			
						<td class=\"mytd\"  width=\"285\">Initial Signed Clearance (m)</td>
						";
							echo "<td  class=\"mytd\" width=\"400\">";
							echo $InitialSignedClearance;
						echo "</td>";
						echo "			
					</tr>
					
				</table>";
				
				
				
				
				
				
				
			
		
		?>
		</div>
		
			
		<div id="fragment-5">
		<?php		
			echo "<p class=\"bodytextbold\"><u>Span Group</u></p>";
			
				echo "<table class=\"bodytext\">
					<tr>			
						<td class=\"myth\" width=\"115\">Span</td>					
						<td class=\"myth\" width=\"200\">Material</td>
						<td class=\"myth\" width=\"200\">Type</td>
						<td class=\"myth\" width=\"115\">Length	(m)</td>
						<td class=\"myth\" width=\"115\">Year of Constructed</td>
					</tr>";
					
					
					
					for($i=1; $i<=15; $i++)
					{
						echo "<tr name=\"spgroup".$i."\" id=\"spgroup".$i."\">			
							<td class=\"mytd\" width=\"115\">
								Span - ".$i."						
							</td>
							
							
							
							<td class=\"mytd\" width=\"115\">";
								$query_dis	= "select * from bms_spanmaterials order by SpanMaterial";
								$result_dis		= mysql_query($query_dis) or die (mysql_error());
									while($row_dis	= mysql_fetch_array($result_dis))
									{
									
										$SpanMaterialID 	= $row_dis['SpanMaterialID'];
										$SpanMaterial	= $row_dis['SpanMaterial'];
										if($spanmaterials_SpanMaterialID_spgrou[$i] == $SpanMaterialID)
										{
											echo $SpanMaterial;
										}
										else
										{
										}
									}
							echo "</td>
							
							
							<td class=\"mytd\" width=\"115\">";
								$query_dis	= "select * from bms_spantypes order by SpanType";
								$result_dis		= mysql_query($query_dis) or die (mysql_error());
									while($row_dis	= mysql_fetch_array($result_dis))
									{
									
										$SpanTypeID 	= $row_dis['SpanTypeID'];
										$SpanType 	= $row_dis['SpanType'];
										if($spantypes_SpanTypeID_spgroup[$i] == $SpanTypeID)
										{
											echo $SpanType;
										}
										else
										{
										}
									}
							echo "</td>						
							
							<td class=\"mytd\" width=\"115\" align=\"right\">";
								echo $SpanLength_spgroup[$i];				
							echo "</td>
							
							
							<td class=\"mytd\" width=\"115\"  align=\"center\">";
								
									$thisyear = date(Y);
									for($myi=2000; $myi <=$thisyear; $myi++)
									{							
										if($YearOfConstruction_spgroup[$i] == $myi)
										{
											echo $myi;
										}
										else
										{
										}
									}
							echo "</td>					
						</tr>";
					}				
			echo "</table>";
			
		
			
			echo "<p class=\"bodytextbold\"><br /><u>Decks</u></p>";
			
				echo "<table class=\"bodytext\">
					<tr>			
						<td class=\"myth\" width=\"115\">Deck</td>					
						<td class=\"myth\" width=\"200\">Material</td>
						<td class=\"myth\" width=\"200\">Type</td>
						<td class=\"myth\" width=\"115\">Thickness (mm)</td>
						<td class=\"myth\" width=\"115\">Year of Constructed</td>
					</tr>";
					
					
					
					for($i=1; $i<=15; $i++)
					{
						echo "<tr name=\"deck".$i."\" id=\"deck".$i."\">			
							<td class=\"mytd\" width=\"115\">
								Deck - ".$i."						
							</td>
							
							
							
							<td class=\"mytd\" width=\"115\">";
								$query_dis	= "select * from bms_deckmaterials order by DeckMaterial";
								$result_dis		= mysql_query($query_dis) or die (mysql_error());
									while($row_dis	= mysql_fetch_array($result_dis))
									{
									
										$DeckMaterialID 	= $row_dis['DeckMaterialID'];
										$DeckMaterial	= $row_dis['DeckMaterial'];
										if($deckmaterials_DeckMaterialID_deck[$i] == $DeckMaterialID)
										{
											echo $DeckMaterial;
										}
										else
										{
										}
									}
							echo "</td>
							
							
							<td class=\"mytd\" width=\"115\">";
								$query_dis	= "select * from bms_desksurfacetypes order by DeskSurfaceType";
								$result_dis		= mysql_query($query_dis) or die (mysql_error());
									while($row_dis	= mysql_fetch_array($result_dis))
									{
									
										$DeskSurfaceTypeID 	= $row_dis['DeskSurfaceTypeID'];
										$DeskSurfaceType 	= $row_dis['DeskSurfaceType'];
										if($desksurfacetypes_DeskSurfaceTypeID_deck[$i] == $DeskSurfaceTypeID)
										{
											echo $DeskSurfaceType;
										}
										else
										{
										}
									}
							echo "</td>						
							
							
							<td class=\"mytd\" width=\"115\"  align=\"right\">";
								echo $DeckSurfaceThickness_deck[$i];				
							echo "</td>
							
							<td class=\"mytd\" width=\"115\"  align=\"center\">";
								
									$thisyear = date(Y);
									for($myi=2000; $myi <=$thisyear; $myi++)
									{							
										if($YearOfConstruction_deck[$i] == $myi)
										{
											echo $myi;
										}
										else
										{
										}
									}
							echo "</td>					
						</tr>";
					}				
			echo "</table>";
			
			
			
			
			
			
			
			echo "<p class=\"bodytextbold\"><br /><u>Expansion Joints</u></p>";		
		
			echo "<table class=\"bodytext\">
				<tr>			
					<td class=\"mytd\" width=\"285\">Type</td>";
					echo "<td  class=\"mytd\" width=\"400\">";					
						
						echo $ExpansionJointsType;	
					echo "</td>";
					echo "			
				</tr>";
			echo "</table>";	
				
				
			
			
		?>
		</div>
				
		
		<div id="fragment-6">
		<?php		
			echo "<p class=\"bodytextbold\"><u>Piers</u></p>";
			
				echo "<table class=\"bodytext\">
					<tr>			
						<td class=\"myth\" width=\"115\">Pier</td>					
						<td class=\"myth\" width=\"200\">Material</td>
						<td class=\"myth\" width=\"200\">Type</td>
						<td class=\"myth\" width=\"115\">Thickness at Capping Level (m)</td>
					</tr>";
					
					
					
					for($i=1; $i<=15; $i++)
					{
						echo "<tr name=\"sub_pier_".$i."\" id=\"sub_pier_".$i."\">			
							<td class=\"mytd\" width=\"115\">
								Pier - ".$i."						
							</td>
							
							
							
							<td class=\"mytd\" width=\"115\">";
								$query_dis	= "select * from bms_piermaterials order by PierMaterial";
								$result_dis		= mysql_query($query_dis) or die (mysql_error());
									while($row_dis	= mysql_fetch_array($result_dis))
									{
									
										$PierMaterialID 	= $row_dis['PierMaterialID'];
										$PierMaterial	= $row_dis['PierMaterial'];
										if($piermaterials_PierMaterialID_sub_pier[$i] == $PierMaterialID)
										{
											echo $PierMaterial;
										}
										else
										{
										}
									}
							echo "</td>
							
							
							<td class=\"mytd\" width=\"115\">";
								$query_dis	= "select * from bms_piertypes order by PierType";
								$result_dis		= mysql_query($query_dis) or die (mysql_error());
									while($row_dis	= mysql_fetch_array($result_dis))
									{
									
										$PierTypeID 	= $row_dis['PierTypeID'];
										$PierType 	= $row_dis['PierType'];
										if($piertypes_PierTypeID_sub_pier[$i] == $PierTypeID)
										{
											echo $PierType;
										}
										else
										{
										}
									}
							echo "</td>	

							<td class=\"mytd\" width=\"115\">";
								echo $ThicknessCappingLevel[$i];
							echo "</td>	
							

							
											
						</tr>";
					}				
			echo "</table>";
			
					
					
					
					
					
					
					
					
					
					
			echo "<p class=\"bodytextbold\"><br /><u>Wing Walls</u></p>";
			
				echo "<table class=\"bodytext\">
					<tr>			
						<td class=\"myth\" width=\"115\">Wing Wall</td>					
						<td class=\"myth\" width=\"200\">Material</td>
						<td class=\"myth\" width=\"200\">Type</td>
						<td class=\"myth\" width=\"200\">Lenth (m)</td>
					</tr>";
					
					
					
					for($i=1; $i<=4; $i++)
					{
						echo "<tr name=\"sub_ww_".$i."\" id=\"sub_ww_".$i."\">			
							<td class=\"mytd\" width=\"115\">";
								if($i ==1)
									echo "L-1";
								if($i ==2)
									echo "L-2";
								if($i ==3)
									echo "R-1";		
								if($i ==4)
									echo "R-2";								
							echo "</td>
							
							
							
							<td class=\"mytd\" width=\"115\">";
								$query_dis	= "select * from bms_wingmaterials order by WingMaterial";
								$result_dis		= mysql_query($query_dis) or die (mysql_error());
									while($row_dis	= mysql_fetch_array($result_dis))
									{
									
										$WingMaterialID 	= $row_dis['WingMaterialID'];
										$WingMaterial	= $row_dis['WingMaterial'];
										if($wingmaterials_WingMaterialID_sub_ww[$i] == $WingMaterialID)
										{
											echo $WingMaterial;
										}
										else
										{
										}
									}
							echo "</td>
							
							
							<td class=\"mytd\" width=\"115\">";
								$query_dis	= "select * from bms_wingtypes order by WingType";
								$result_dis		= mysql_query($query_dis) or die (mysql_error());
									while($row_dis	= mysql_fetch_array($result_dis))
									{
									
										$WingTypeID 	= $row_dis['WingTypeID'];
										$WingType 	= $row_dis['WingType'];
										if($wingtypes_WingTypeID_sub_ww[$i] == $WingTypeID)
										{
											echo $WingType;
										}
										else
										{
										}
									}
							echo "</td>				
								
							<td class=\"mytd\" width=\"115\">";
								echo $WingWallLenth[$i];
							echo "</td>	


								
						</tr>";
					}				
			echo "</table>";		
					
					
					
					
					
			echo "<p class=\"bodytextbold\"><br /><u>Abutments</u></p>";
			
				echo "<table class=\"bodytext\">
					<tr>			
						<td class=\"myth\" width=\"115\">Abutment</td>					
						<td class=\"myth\" width=\"200\">Material</td>
						<td class=\"myth\" width=\"200\">Type</td>
					</tr>";
					
					
					
					for($i=1; $i<=2; $i++)
					{
						echo "<tr name=\"sub_abunt_".$i."\" id=\"sub_abunt_".$i."\">			
							<td class=\"mytd\" width=\"115\">
								Abutment - ".$i."						
							</td>
							
							
							
							<td class=\"mytd\" width=\"115\">";
								$query_dis	= "select * from bms_abutmentmaterials order by AbutmentMaterial";
								$result_dis		= mysql_query($query_dis) or die (mysql_error());
									while($row_dis	= mysql_fetch_array($result_dis))
									{
									
										$AbutmentMaterialID 	= $row_dis['AbutmentMaterialID'];
										$AbutmentMaterial	= $row_dis['AbutmentMaterial'];
										if($abutmentmaterials_AbutmentMaterialID_sub_abunt[$i] == $AbutmentMaterialID)
										{
											echo $AbutmentMaterial;
										}
										else
										{
										}
									}
							echo "</td>
							
							
							<td class=\"mytd\" width=\"115\">";
								$query_dis	= "select * from bms_abutmenttypes order by AbutmentType";
								$result_dis		= mysql_query($query_dis) or die (mysql_error());
									while($row_dis	= mysql_fetch_array($result_dis))
									{
									
										$AbutmentTypeID 	= $row_dis['AbutmentTypeID'];
										$AbutmentType 	= $row_dis['AbutmentType'];
										if($abutmenttypes_SpanTypeID_sub_abunt[$i] == $AbutmentTypeID)
										{
											echo $AbutmentType;
										}
										else
										{
										}
									}
							echo "</td>				
											
						</tr>";
					}				
			echo "</table>";		
					
					
					
					
					
					
			echo "<p class=\"bodytextbold\"><br /><u>Bearings</u></p>";		
					
					
					
			echo "<table>			
			<tr>			
					<td class=\"mytd\" width=\"115\">Type</td>
					";
						echo "<td  class=\"mytd\" width=\"400\">";
						$query_dis	= "select * from bms_bearingtypes order by BearingType";
						$result_dis		= mysql_query($query_dis) or die (mysql_error());

							while($row_dis	= mysql_fetch_array($result_dis))
							{
							
								$BearingTypeID 	= $row_dis['BearingTypeID'];
								$BearingType	= $row_dis['BearingType'];
								if($bearingtypes_BearingTypeID == $BearingTypeID)
								{
									echo $BearingType;
								}
								else
								{
								}
							}
					echo "</td>";
					echo "			
				</tr>			
			</table>";		
					
					
					
					
					
			echo "<p class=\"bodytextbold\"><br /><u>Foundations</u></p>";
			
				echo "<table class=\"bodytext\">
					<tr>			
						<td class=\"myth\" width=\"115\">Foundation</td>					
						<td class=\"myth\" width=\"200\">Material</td>
						<td class=\"myth\" width=\"200\">Type</td>
					</tr>";
					
					
					
					
					
					
					for($i=1; $i<=15; $i++)
					{
						echo "<tr name=\"foun_pier_".$i."\" id=\"foun_pier_".$i."\">			
							<td class=\"mytd\" width=\"115\">
								Pier - ".$i."						
							</td>
							
							
							
							<td class=\"mytd\" width=\"115\">";
								$query_dis	= "select * from bms_piermaterials order by PierMaterial";
								$result_dis		= mysql_query($query_dis) or die (mysql_error());
									while($row_dis	= mysql_fetch_array($result_dis))
									{
									
										$PierMaterialID 	= $row_dis['PierMaterialID'];
										$PierMaterial	= $row_dis['PierMaterial'];
										if($piermaterials_PierMaterialID_foun_pier[$i] == $PierMaterialID)
										{
											echo $PierMaterial;
										}
										else
										{
										}
									}
							echo "</td>
							
							
							<td class=\"mytd\" width=\"115\">";
								$query_dis	= "select * from bms_piertypes order by PierType";
								$result_dis		= mysql_query($query_dis) or die (mysql_error());
									while($row_dis	= mysql_fetch_array($result_dis))
									{
									
										$PierTypeID 	= $row_dis['PierTypeID'];
										$PierType 	= $row_dis['PierType'];
										if($piertypes_PierTypeID_foun_pier[$i] == $PierTypeID)
										{
											echo $PierType;
										}
										else
										{
										}
									}
							echo "</td>				
											
						</tr>";
					}		
					
					echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
					for($i=1; $i<=2; $i++)
					{
						echo "<tr name=\"foun_abunt".$i."\" id=\"foun_abunt".$i."\">			
							<td class=\"mytd\" width=\"115\">
								Abutment - ".$i."						
							</td>
							
							
							
							<td class=\"mytd\" width=\"115\">";
								$query_dis	= "select * from bms_abutmentmaterials order by AbutmentMaterial";
								$result_dis		= mysql_query($query_dis) or die (mysql_error());
									while($row_dis	= mysql_fetch_array($result_dis))
									{
									
										$AbutmentMaterialID 	= $row_dis['AbutmentMaterialID'];
										$AbutmentMaterial	= $row_dis['AbutmentMaterial'];
										if($abutmentmaterials_AbutmentMaterialID_foun_abunt[$i] == $AbutmentMaterialID)
										{
											echo $AbutmentMaterial;
										}
										else
										{
										}
									}
							echo "</td>
							
							
							<td class=\"mytd\" width=\"115\">";
								$query_dis	= "select * from bms_abutmenttypes order by AbutmentType";
								$result_dis		= mysql_query($query_dis) or die (mysql_error());
									while($row_dis	= mysql_fetch_array($result_dis))
									{
									
										$AbutmentTypeID 	= $row_dis['AbutmentTypeID'];
										$AbutmentType 	= $row_dis['AbutmentType'];
										if($abutmenttypes_SpanTypeID_foun_abunt[$i] == $AbutmentTypeID)
										{
											echo $AbutmentType;
										}
										else
										{
										}
									}
							echo "</td>				
											
						</tr>";
					}		
					
					
					echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
					
					
					
					
					
					for($i=1; $i<=4; $i++)
					{
						echo "<tr name=\"foun_ww".$i."\" id=\"foun_ww".$i."\">			
							<td class=\"mytd\" width=\"115\">";
								if($i ==1)
									echo "Wing Wall - L1";
								if($i ==2)
									echo "Wing Wall - L2";
								if($i ==3)
									echo "Wing Wall - R1";		
								if($i ==4)
									echo "Wing Wall - R2";								
							echo "</td>
							
							
							
							<td class=\"mytd\" width=\"115\">";
								$query_dis	= "select * from bms_wingfoundationmaterials order by WingFoundationMaterial";
								$result_dis		= mysql_query($query_dis) or die (mysql_error());
									while($row_dis	= mysql_fetch_array($result_dis))
									{
									
										$WingFoundationMaterialID 	= $row_dis['WingFoundationMaterialID'];
										$WingFoundationMaterial	= $row_dis['WingFoundationMaterial'];
										if($wingmaterials_WingMaterialID_foun_ww[$i] == $WingFoundationMaterialID)
										{
											echo $WingFoundationMaterial;
										}
										else
										{
										}
									}
							echo "</td>
							
							
							<td class=\"mytd\" width=\"115\">";
								$query_dis	= "select * from bms_wingfoundationtypes order by WingFoundationType";
								$result_dis		= mysql_query($query_dis) or die (mysql_error());
									while($row_dis	= mysql_fetch_array($result_dis))
									{
									
										$WingFoundationTypeID 	= $row_dis['WingFoundationTypeID'];
										$WingFoundationType 	= $row_dis['WingFoundationType'];
										if($wingtypes_WingTypeID_foun_ww[$i] == $WingFoundationTypeID)
										{
											echo $WingFoundationType;
										}
										else
										{
										}
									}
							echo "</td>				
											
						</tr>";
					}				
			echo "</table>";	
		
		?>
		</div>
		
			
		<div id="fragment-7">
		<?php		
			echo "<p class=\"bodytextbold\"><u>Structure Environment</u></p>";
			
				echo "<table class=\"bodytext\" width=\"100%\">
			
				<tr>			
					<td class=\"mytd\" width=\"285\">Climate Zone</td>
					";
						echo "<td  class=\"mytd\" width=\"400\">";
						$query_dis	= "select * from bms_climatezones order by ClimateZone";
						$result_dis		= mysql_query($query_dis) or die (mysql_error());

							while($row_dis	= mysql_fetch_array($result_dis))
							{
							
								$ClimateZoneID 	= $row_dis['ClimateZoneID'];
								$ClimateZone	= $row_dis['ClimateZone'];
								if($climatezones_ClimateZoneID == $ClimateZoneID)
								{
									echo $ClimateZone;
								}
								else
								{
								}
							}
					echo "</td>";
					echo "			
				</tr>
				
				
				<tr>			
					<td class=\"mytd\" width=\"285\">Local Environment</td>
					";
						echo "<td  class=\"mytd\">";
						$query_dis	= "select * from bms_localenvironments order by LocalEnvironment";
						$result_dis		= mysql_query($query_dis) or die (mysql_error());

							while($row_dis	= mysql_fetch_array($result_dis))
							{
							
								$LocalEnvironmentID 	= $row_dis['LocalEnvironmentID'];
								$LocalEnvironment	= $row_dis['LocalEnvironment'];
								if($localenvironments_LocalEnvironmentID == $LocalEnvironmentID)
								{
									echo $LocalEnvironment;
								}
								else
								{
								}
							}
					echo "</td>";
					echo "			
				</tr>
				
				
				<tr>			
					<td class=\"mytd\" width=\"285\">Exposure Class</td>
					";
						echo "<td  class=\"mytd\">";
						$query_dis	= "select * from bms_exposureclasses order by ExposureClass";
						$result_dis		= mysql_query($query_dis) or die (mysql_error());

							while($row_dis	= mysql_fetch_array($result_dis))
							{
							
								$ExposureClass 	= $row_dis['ExposureClass'];
								$ExposureClassID	= $row_dis['ExposureClassID'];
								if($exposureclasses_ExposureClassID == $ExposureClassID)
								{
									echo $ExposureClass;
								}
								else
								{
								}
							}
					echo "</td>";
					echo "			
				</tr>
					
				
				<tr>			
					<td class=\"mytd\" >Protective Coatings</td>
					";
						echo "<td  class=\"mytd\">";
						echo $ProtectiveCoatings;
					echo "</td>";
					echo "			
				</tr>
				
				
				<tr>			
					<td class=\"mytd\" >Contamination</td>
					";
						echo "<td  class=\"mytd\">";
						echo $Contamination;
					echo "</td>";
					echo "			
				</tr>
				
				
				<tr>			
					<td class=\"mytd\" >Comments</td>
					";
						echo "<td  class=\"mytd\" width=\"485\">";
						echo $Comments;
					echo "</td>";
					echo "			
				</tr>";
				

				
				
			echo "</table>";	
		?>
		</div>	
		
		
		
		
		
		
		
		
		
		<div id="fragment-8">
		<?php		
			echo "<p class=\"bodytextbold\"><u>File Attachments</u></p>";
			
				echo "<table class=\"bodytext\">";
				
				////////////////////////////////////////////////////
				////////////////////////////////////////////////////
				echo "<tr>			
						<td class=\"myth\" width=\"185\">";
							echo "Category";
						echo "</td>";
						
						echo "<td  class=\"myth\">";
							echo "Description";	
						echo "</td>";
						
						echo "<td  class=\"myth\">";
							echo "File (.DWG)";	
						echo "</td>";
				echo "</tr>";
				for($i=1; $i <= 5; $i++)
				{
					echo "<tr>			
						<td class=\"mytd\" width=\"185\">";
							echo "Cad Design  - ". $i;
						echo "</td>";
						
						
						echo "<td  class=\"mytd\">";
							$x	= '';
							$x	= "CadDesign".$i."Dis";
							echo $$x;
						echo "</td>";
						
						echo "<td  class=\"mytd\"  align=\"center\">";							
							$x	= '';
							$x	= "CadDesign".$i."Name";
							$filepath	= '';
							$filepath	= $pathprefix."bridge/fileattachment/dwg/".$BridgeProfileID."-".$i.".dwg";
							echo "<a href=\"".$filepath."\">".$$x."</a>";
	
						echo "</td>";
					echo "</tr>";
				
				}
				echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
				////////////////////////////////////////////////////
				////////////////////////////////////////////////////
				
				
				
				////////////////////////////////////////////////////
				////////////////////////////////////////////////////
				echo "<tr>			
						<td class=\"myth\" width=\"185\">";
							echo "Category";
						echo "</td>";
						
						echo "<td  class=\"myth\" width=\"350\">";
							echo "Description";	
						echo "</td>";
						
						echo "<td  class=\"myth\">";
							echo "File (.PDF)";	
						echo "</td>";
				echo "</tr>";
				for($i=1; $i <= 10; $i++)
				{
					echo "<tr>			
						<td class=\"mytd\" width=\"185\">";
							echo "Drawing  - ". $i;
						echo "</td>";
						
						
						echo "<td  class=\"mytd\">";
							$x	= '';
							$x	= "Drawing".$i."Dis";
							echo $$x;
						echo "</td>";
						
						echo "<td  class=\"mytd\"  align=\"center\">";
							$x	= '';
							$x	= "Drawing".$i."Name";
							$filepath	= '';
							$filepath	= $pathprefix."bridge/fileattachment/pdf/".$BridgeProfileID."-".$i.".pdf";
							echo "<a href=\"".$filepath."\">".$$x."</a>";	
						echo "</td>";
					echo "</tr>";
				
				}
				echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
				////////////////////////////////////////////////////
				////////////////////////////////////////////////////
				
				
				
				////////////////////////////////////////////////////
				////////////////////////////////////////////////////
				echo "<tr>			
						<td class=\"myth\" width=\"185\">";
							echo "Category";
						echo "</td>";
						
						echo "<td  class=\"myth\">";
							echo "Description";	
						echo "</td>";
						
						echo "<td  class=\"myth\">";
							echo "File (.JPG)";	
						echo "</td>";
				echo "</tr>";
				for($i=1; $i <= 5; $i++)
				{
					echo "<tr>			
						<td class=\"mytd\" width=\"185\">";
							echo "Image  - ". $i;
						echo "</td>";
						
						
						echo "<td  class=\"mytd\">";
							$x	= '';
							$x	= "Image".$i."Dis";
							echo $$x;
						echo "</td>";
						
						echo "<td  class=\"mytd\" align=\"center\">";
							$x	= '';
							$x	= "Image".$i."Name";
							$filepath	= '';
							$filepath	= $pathprefix."bridge/fileattachment/jpg/".$BridgeProfileID."-".$i.".jpg";
							echo "<a href=\"".$filepath."\">".$$x."</a>";	
						echo "</td>";
					echo "</tr>";
				
				}
				////////////////////////////////////////////////////
				////////////////////////////////////////////////////
				

				
				
			echo "</table>";	
		?>
		</div>
		
		
		
		
		
		
		
		

	</div>

</form>


<?php	
}
	echo "</body>";
	include '../bottom.php';

?>