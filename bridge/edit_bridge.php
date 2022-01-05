<?php
	include ("../global.php");
	include ("../top.php");
@session_start();
	
$BridgeProfileID = 0;
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
		$searchBridgeName = $elements['0'];
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
	
	$spanmaterials_SpanMaterialID_spgrou	 		= array();
	$spantypes_SpanTypeID_spgroup					= array();
	$comment_spgroup	 							= array();
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
	$pierComments_foun_pier							= array();
	$abutmentmaterials_AbutmentMaterialID_foun_abunt= array();
	$abutmenttypes_SpanTypeID_foun_abunt			= array();
	$abutmentComments_foun_abunt					= array();
	$wingmaterials_WingMaterialID_foun_ww			= array();
	$wingtypes_WingTypeID_foun_ww					= array();
	$wingComments_foun_ww							= array();
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
		$abutmentComments_foun_abunt[$i]							= $row_bsr['Comments'];
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
		$spantypes_SpanTypeID_spgroup[$i]		= $row_bsr['SpanType'];
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
		$pierComments_foun_pier[$i]						= $row_bsr['Comments'];
	}
	
	
	$i	= 0;
	$query_bsr_resource = "select * from bms_wingwallfoundations where bridgeprofile_BridgeProfileID=".$BridgeProfileID." order by WingWallPosition";        
	$result_bsr_resource = mysql_query($query_bsr_resource) or die (mysql_error());
	while($row_bsr = mysql_fetch_array($result_bsr_resource))
	{	
		$i++;
		$wingtypes_WingTypeID_foun_ww[$i]			= $row_bsr['wingfoundationtypes_WingFoundationTypeID'];
		$wingmaterials_WingMaterialID_foun_ww[$i]	= $row_bsr['wingfoundationmaterials_WingFoundationMaterialID'];
		$wingComments_foun_ww[$i]					= $row_bsr['Comments'];
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
			
			$("#HighestFloodLevelDate").datepicker({
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
				if(isset($_POST['yes_submit']))
				{
					$NoOfSpans									= (int)$_POST['NoOfSpans'];				
				}
				
				for($i=1; $i<=30; $i++)
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
			for(var i=1; i<=30; i++)
			{
				if(i<=val)
					$('#spgroup'+i).show();	
				else
					$('#spgroup'+i).hide();	
			}

			for(var i=1; i<=30; i++)
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
			for(var i=1; i<=30; i++)
			{
				if(i<=val)
					$('#sub_pier_'+i).show();	
				else
					$('#sub_pier_'+i).hide();	
			}

			for(var i=1; i<=30; i++)
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
	

		
	echo "<p class=\"hx1\">Edit Bridge Profile</p>";
	
	////////////////////////////////////////////////////////////////////////////////////

	//	Save data to data base.........
	

	if(isset($_POST['yes_submit']))
	{
	
		$BridgeProfileID				= $_POST['BridgeProfileID'];
		$StructureID 					= $_POST['StructureID'];
		$BridgeName 					= $_POST['BridgeName'];
		$owners_OwnerID					= $_POST['owners_OwnerID'];
		$roadnames_RoadNameID			= $_POST['roadnames_RoadNameID'];
		$routenos_RouteNoID				= $_POST['routenos_RouteNoID'];
		$roadclasses_RoadClassID		= $_POST['roadclasses_RoadClassID'];
		$funcofbridges_FuncOfBridgeID	= $_POST['funcofbridges_FuncOfBridgeID'];
		$RiverName						= $_POST['RiverName'];
		$OverPassRoad					= $_POST['OverPassRoad'];
		$railroadnames_RailRoadID		= $_POST['railroadnames_RailRoadID'];
		$UnderPassRoad					= $_POST['UnderPassRoad'];
		
		$structuretypes_StructureTypeID					= $_POST['structuretypes_StructureTypeID'];
		$constructionmaterials_ConstructionMaterialID	= $_POST['constructionmaterials_ConstructionMaterialID'];
		$YearOfConstructionStart						= $_POST['YearOfConstructionStart'];
		$operationalstatuses_OperationalStatusID		= $_POST['operationalstatuses_OperationalStatusID'];
		$operationstdate								= $_POST['operationstdate'];
		$district_DistrictID							= $_POST['district_DistrictID'];
		$provinces_ProvinceID							= $_POST['provinces_ProvinceID'];
		$EEDivision										= $_POST['EEDivision'];
		
		$ClosestTown									= $_POST['ClosestTown'];
		$StartChainage									= $_POST['StartChainage'];
		$EndChainage									= $_POST['EndChainage'];
		$GazettedLength									= $_POST['GazettedLength'];
		$GPSCoordinateN									= $_POST['GPSCoordinateN'];
		$GPSCoordinateN = str_replace("'", "\\'", $GPSCoordinateN);
		$GPSCoordinateN = str_replace('"', '\\"', $GPSCoordinateN);
		$GPSCoordinateE									= $_POST['GPSCoordinateE'];
		$GPSCoordinateE = str_replace("'", "\\'", $GPSCoordinateE);
		$GPSCoordinateE = str_replace('"', '\\"', $GPSCoordinateE);
		$GPSCoordinateZ									= $_POST['GPSCoordinateZ'];
		$GPSCoordinateZ = str_replace("'", "\\'", $GPSCoordinateZ);
		$GPSCoordinateZ = str_replace('"', '\\"', $GPSCoordinateZ);

		
		$designstandards_DesignStandardID			= $_POST['designstandards_DesignStandardID'];
		$DesignLoading								= $_POST['DesignLoading'];
		$StructureLength							= $_POST['StructureLength'];
		$StructureWidth								= $_POST['StructureWidth'];
		$NoOfSpans									= (int)$_POST['NoOfSpans'];
		$NoOfPiers									= (int)$_POST['NoOfPiers'];
		$GrossLoadLimit								= $_POST['GrossLoadLimit'];
		$PostedLoadLimit							= $_POST['PostedLoadLimit'];
		$AADT										= $_POST['AADT'];
		$Detours									= $_POST['Detours'];
		$HeavyVehicle								= $_POST['HeavyVehicle'];
		$AttachmentsServices						= $_POST['AttachmentsServices'];
		$AttachmentsDetails							= $_POST['AttachmentsDetails'];
		$attachmentslocations_AttachmentsLocationsID= $_POST['attachmentslocations_AttachmentsLocationsID'];
		$NumberOfLampPosts							= $_POST['NumberOfLampPosts'];
		$economicsfactors_EconomicsFactorID			= $_POST['economicsfactors_EconomicsFactorID'];
		$loadingfactors_LoadingFactorID				= $_POST['loadingfactors_LoadingFactorID'];


		$CarriagewayWidth					= $_POST['CarriagewayWidth'];
		$NoOfLanes							= $_POST['NoOfLanes'];
		$LaneWidth							= $_POST['LaneWidth'];
		$FootPathWidthLeft					= $_POST['FootPathWidthLeft'];
		$FootPathWidthRight					= $_POST['FootPathWidthRight'];
		$MedianWidth						= $_POST['MedianWidth'];
		$MedianHeight						= $_POST['MedianHeight'];
		$BarrierWidth						= $_POST['SuperStructure_barrierwidth'];
		$BarrierHeight						= $_POST['SuperStructure_barrierheight'];
		$SuperStructure_barriertypes		= $_POST['SuperStructure_barriertypes'];
		$SuperStructure_BarrierNumber		= $_POST['SuperStructure_BarrierNumber'];
		
		
		$RoadApproachAlignmentVertical		= $_POST['RoadApproachAlignmentVertical'];
		$RoadApproachAlignmentHorizontal	= $_POST['RoadApproachAlignmentHorizontal'];
		$spantypes_SpanTypeID				= $_POST['spantypes_SpanTypeID'];
		$SkewAngle							= $_POST['SkewAngle'];
		$SkewAngle = str_replace("'", "\\'", $SkewAngle);
		$SkewAngle = str_replace('"', '\\"', $SkewAngle);
		$barriertypes_ASBarrierTypeID				= $_POST['barriertypes_ASBarrierTypeID'];
		$barrierlocations_ASBarrierLocationsID	= $_POST['barrierlocations_ASBarrierLocationsID'];



		$HeightInvertBridgeUnderside		= $_POST['HeightInvertBridgeUnderside'];
		$HeightOWLBridgeUnderside			= $_POST['HeightOWLBridgeUnderside'];
		$HighestFloodLevelBridgeUnderside	= $_POST['HighestFloodLevelBridgeUnderside'];
		$HighestFloodLevelDate				= $_POST['HighestFloodLevelDate'];
		$NormalFloodLevelBridgeUnderside	= $_POST['NormalFloodLevelBridgeUnderside'];
		$HeadRoom							= $_POST['HeadRoom'];
		$Navigable							= $_POST['Navigable'];
		if($_POST['InitialSignedClearance'] != "" and $_POST['InitialSignedClearance']!=0){
			$InitialSignedClearance			= $_POST['InitialSignedClearance'];
		}


		$ParapetLeftParapetTypeID	= $_POST['parapet_left_type'];
		$ParapetLeftLenth			= $_POST['parapet_left_lenth'];
		$ParapetRIghtParapetTypeID	= $_POST['parapet_right_type'];
		$ParapetRIghtLenth			= $_POST['parapet_right_lenth'];
			
		
		
		
		
		$spanmaterials_SpanMaterialID_spgroup	= array();
		$spantypes_SpanTypeID_spgroup			= array();
		$SpanLength_spgroup						= array();
		$YearOfConstruction_spgroup				= array();		
		$deckmaterials_DeckMaterialID_deck		= array();
		$desksurfacetypes_DeskSurfaceTypeID_deck= array();
		$DeckSurfaceThickness_deck				= array();
		$YearOfConstruction_deck				= array();
		$comment_spgroup						= array();
		$comment_deck							= array();
		
		for($i=1; $i<=$NoOfSpans; $i++)
		{	
			$spanmaterials_SpanMaterialID_spgroup[$i]	= $_POST['spanmaterials_SpanMaterialID_spgroup_'.$i];
			$spantypes_SpanTypeID_spgroup[$i]			= $_POST['spantypes_SpanTypeID_spgroup_'.$i];
			$SpanLength_spgroup[$i]						= $_POST['SpanLength_spgroup_'.$i];
			$YearOfConstruction_spgroup[$i]				= $_POST['YearOfConstruction_spgroup_'.$i];
			
			
			$deckmaterials_DeckMaterialID_deck[$i]		= $_POST['deckmaterials_DeckMaterialID_deck_'.$i];
			$desksurfacetypes_DeskSurfaceTypeID_deck[$i]= $_POST['desksurfacetypes_DeskSurfaceTypeID_deck_'.$i];
			$DeckSurfaceThickness_deck[$i]				= $_POST['DeckSurfaceThickness_deck_'.$i];
			$YearOfConstruction_deck[$i]				= $_POST['YearOfConstruction_deck_'.$i];
			
			
			$comment_spgroup[$i]						= $_POST['comment_spgroup_'.$i];
			$comment_deck[$i]							= $_POST['comment_deck_'.$i];
			
		}

		$ExpansionJointsType						= $_POST['ExpansionJointsType'];


		$piermaterials_PierMaterialID_sub_pier		= array();
		$piertypes_PierTypeID_sub_pier				= array();		
		for($i=1; $i<=$NoOfPiers; $i++)
		{	
			$piermaterials_PierMaterialID_sub_pier[$i]	= $_POST['piermaterials_PierMaterialID_sub_pier_'.$i];
			$piertypes_PierTypeID_sub_pier[$i]			= $_POST['piertypes_PierTypeID_sub_pier_'.$i];
			$ThicknessCappingLevel[$i]					= $_POST['ThicknessCappingLevel_'.$i];
		}
		
	

		$abutmentmaterials_AbutmentMaterialID_sub_abunt_1	= $_POST['abutmentmaterials_AbutmentMaterialID_sub_abunt_1'];
		$abutmenttypes_SpanTypeID_sub_abunt_1				= $_POST['abutmenttypes_SpanTypeID_sub_abunt_1'];
		$abutmentmaterials_AbutmentMaterialID_sub_abunt_2	= $_POST['abutmentmaterials_AbutmentMaterialID_sub_abunt_2'];
		$abutmenttypes_SpanTypeID_sub_abunt_2				= $_POST['abutmenttypes_SpanTypeID_sub_abunt_2'];


		$wingmaterials_WingMaterialID_sub_ww_1				= $_POST['wingmaterials_WingMaterialID_sub_ww_1'];
		$wingtypes_WingTypeID_sub_ww_1						= $_POST['wingtypes_WingTypeID_sub_ww_1'];
		$WingWallLenth_1									= $_POST['WingWallLenth_1'];
		$wingmaterials_WingMaterialID_sub_ww_2				= $_POST['wingmaterials_WingMaterialID_sub_ww_2'];
		$wingtypes_WingTypeID_sub_ww_2						= $_POST['wingtypes_WingTypeID_sub_ww_2'];
		$WingWallLenth_2									= $_POST['WingWallLenth_2'];
		$wingmaterials_WingMaterialID_sub_ww_3				= $_POST['wingmaterials_WingMaterialID_sub_ww_3'];
		$wingtypes_WingTypeID_sub_ww_3						= $_POST['wingtypes_WingTypeID_sub_ww_3'];
		$WingWallLenth_3									= $_POST['WingWallLenth_3'];
		$wingmaterials_WingMaterialID_sub_ww_4				= $_POST['wingmaterials_WingMaterialID_sub_ww_4'];
		$wingtypes_WingTypeID_sub_ww_4						= $_POST['wingtypes_WingTypeID_sub_ww_4'];
		$WingWallLenth_4									= $_POST['WingWallLenth_4'];


		$bearingtypes_BearingTypeID							= $_POST['bearingtypes_BearingTypeID'];
		$bearingtypes_BearingMaterialID						= $_POST['bearingtypes_BearingMaterialID'];
		
		
		$piermaterials_PierMaterialID_foun_pier		= array();
		$piertypes_PierTypeID_foun_pier				= array();		
		$pierComments_foun_pier						= array();
		for($i=1; $i<=$NoOfPiers; $i++)
		{	
			$piermaterials_PierMaterialID_foun_pier[$i]	= $_POST['piermaterials_PierMaterialID_foun_pier_'.$i];
			$piertypes_PierTypeID_foun_pier[$i]			= $_POST['piertypes_PierTypeID_foun_pier_'.$i];
			$pierComments_foun_pier[$i]					= $_POST['pierComments_foun_pier_'.$i];
		}
		


		$abutmentmaterials_AbutmentMaterialID_foun_abunt1	= $_POST['abutmentmaterials_AbutmentMaterialID_foun_abunt1'];
		$abutmenttypes_SpanTypeID_foun_abunt1				= $_POST['abutmenttypes_SpanTypeID_foun_abunt1'];
		$abutmentComments_foun_abunt1						= $_POST['abutmentComments_foun_abunt1'];
		$abutmentmaterials_AbutmentMaterialID_foun_abunt2	= $_POST['abutmentmaterials_AbutmentMaterialID_foun_abunt2'];
		$abutmenttypes_SpanTypeID_foun_abunt2				= $_POST['abutmenttypes_SpanTypeID_foun_abunt2'];
		$abutmentComments_foun_abunt2						= $_POST['abutmentComments_foun_abunt2'];


		$wingmaterials_WingMaterialID_foun_ww1	= $_POST['wingmaterials_WingMaterialID_foun_ww1'];
		$wingtypes_WingTypeID_foun_ww1			= $_POST['wingtypes_WingTypeID_foun_ww1'];
		$wingComments_foun_ww1					= $_POST['wingComments_foun_ww1'];
		$wingmaterials_WingMaterialID_foun_ww2	= $_POST['wingmaterials_WingMaterialID_foun_ww2'];
		$wingtypes_WingTypeID_foun_ww2			= $_POST['wingtypes_WingTypeID_foun_ww2'];
		$wingComments_foun_ww2					= $_POST['wingComments_foun_ww2'];
		$wingmaterials_WingMaterialID_foun_ww3	= $_POST['wingmaterials_WingMaterialID_foun_ww3'];
		$wingtypes_WingTypeID_foun_ww3			= $_POST['wingtypes_WingTypeID_foun_ww3'];
		$wingComments_foun_ww3					= $_POST['wingComments_foun_ww3'];
		$wingmaterials_WingMaterialID_foun_ww4	= $_POST['wingmaterials_WingMaterialID_foun_ww4'];
		$wingtypes_WingTypeID_foun_ww4			= $_POST['wingtypes_WingTypeID_foun_ww4'];
		$wingComments_foun_ww4					= $_POST['wingComments_foun_ww4'];



		$climatezones_ClimateZoneID				= $_POST['climatezones_ClimateZoneID'];
		$localenvironments_LocalEnvironmentID	= $_POST['localenvironments_LocalEnvironmentID'];
		$exposureclasses_ExposureClassID		= $_POST['exposureclasses_ExposureClassID'];
		$ProtectiveCoatings						= $_POST['ProtectiveCoatings'];
		$Contamination							= $_POST['Contamination'];
		$Comments								= $_POST['Comments'];

		
		
		$sections_SectionID	= $_SESSION['logined_sections_SectionID'];
		$AddedBy	= 	$ModifiedBy			= $_SESSION['log_UserID'];
		$AddedDate	=	$ModifiedDate		= date("Y-m-d H:i:s");
		
		////////////////////////////////////////////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////////
		$query_resource = "UPDATE   bms_bridgeprofiles  SET
									sections_SectionID 					= '".$sections_SectionID."',
									BridgeName 							= '".$BridgeName."',
									owners_OwnerID 						= '".$owners_OwnerID."',
									roadnames_RoadNameID 				= '".$roadnames_RoadNameID."',
									routenos_RouteNoID 					= '".$routenos_RouteNoID."',
									roadclasses_RoadClassID 			= '".$roadclasses_RoadClassID."',
									funcofbridges_FuncOfBridgeID 		= '".$funcofbridges_FuncOfBridgeID."',
									RiverName 						= '".$RiverName."',
									OverPassRoad 						= '".$OverPassRoad."',
									railroadnames_RailRoadID 			= '".$railroadnames_RailRoadID."',
									UnderPassRoad 						= '".$UnderPassRoad."',
									structuretypes_StructureTypeID 		= '".$structuretypes_StructureTypeID."',
									constructionmaterials_ConstructionMaterialID = '".$constructionmaterials_ConstructionMaterialID."',
									YearOfConstructionStart 			= '".$YearOfConstructionStart."',
									district_DistrictID 				= '".$district_DistrictID."',
									provinces_ProvinceID				= '".$provinces_ProvinceID."',
									EEDivision							= '".$EEDivision."',
									ClosestTown 						= '".$ClosestTown."',
									StartChainage 						= '".$StartChainage."',
									EndChainage 						= '".$EndChainage."',
									GazettedLength 						= '".$GazettedLength."',
									GPSCoordinateN 						= '".$GPSCoordinateN."',
									GPSCoordinateE 						= '".$GPSCoordinateE."',
									GPSCoordinateZ 						= '".$GPSCoordinateZ."',
									designstandards_DesignStandardID = '".$designstandards_DesignStandardID."',
									DesignLoading 						= '".$DesignLoading."',
									StructureLength 					= '".$StructureLength."',
									StructureWidth 						= '".$StructureWidth."',
									NoOfSpans 							= '".$NoOfSpans."',
									NoOfPiers 							= '".$NoOfPiers."',
									GrossLoadLimit 						= '".$GrossLoadLimit."',
									PostedLoadLimit 					= '".$PostedLoadLimit."',
									AADT 								= '".$AADT."',
									Detours 							= '".$Detours."',
									HeavyVehicle 						= '".$HeavyVehicle."',
									AttachmentsServices 				= '".$AttachmentsServices."',
									AttachmentsDetails 					= '".$AttachmentsDetails."',
									attachmentslocations_AttachmentsLocationsID = '".$attachmentslocations_AttachmentsLocationsID."',
									NumberOfLampPosts 					= '".$NumberOfLampPosts."',
									CarriagewayWidth 					= '".$CarriagewayWidth."',
									NoOfLanes 							= '".$NoOfLanes."',
									LaneWidth 							= '".$LaneWidth."',
									FootPathWidthLeft 					= '".$FootPathWidthLeft."',
									FootPathWidthRight 					= '".$FootPathWidthRight."',
									MedianWidth 						= '".$MedianWidth."',
									MedianHeight 						= '".$MedianHeight."',
									SuperStructure_barriertypes			= '".$SuperStructure_barriertypes."',
									SuperStructure_BarrierNumber		= '".$SuperStructure_BarrierNumber."',
									BarrierWidth 						= '".$BarrierWidth."',
									BarrierHeight 						= '".$BarrierHeight."',
									RoadApproachAlignmentVertical 		= '".$RoadApproachAlignmentVertical."',
									RoadApproachAlignmentHorizontal 	= '".$RoadApproachAlignmentHorizontal."',
									spantypes_SpanTypeID 				= '".$spantypes_SpanTypeID."',
									SkewAngle 							= '".$SkewAngle."',
									barriertypes_ASBarrierTypeID 		= '".$barriertypes_ASBarrierTypeID."',
									barrierlocations_ASBarrierLocationsID = '".$barrierlocations_ASBarrierLocationsID."',
									HeightInvertBridgeUnderside 		= '".$HeightInvertBridgeUnderside."',
									HeightOWLBridgeUnderside 			= '".$HeightOWLBridgeUnderside."',
									HighestFloodLevelBridgeUnderside 	= '".$HighestFloodLevelBridgeUnderside."',
									HighestFloodLevelDate				= '".$HighestFloodLevelDate."',
									NormalFloodLevelBridgeUnderside 	= '".$NormalFloodLevelBridgeUnderside."',
									HeadRoom 							= '".$HeadRoom."',
									Navigable 							= '".$Navigable."',
									InitialSignedClearance				= '".$InitialSignedClearance."',
									ExpansionJointsType 				= '".$ExpansionJointsType."',
									bearingtypes_BearingTypeID 			= '".$bearingtypes_BearingTypeID."',
									bearingtypes_BearingMaterialID		= '".$bearingtypes_BearingMaterialID."',
									climatezones_ClimateZoneID 			= '".$climatezones_ClimateZoneID."',
									localenvironments_LocalEnvironmentID = '".$localenvironments_LocalEnvironmentID."',
									exposureclasses_ExposureClassID 	= '".$exposureclasses_ExposureClassID."',
									ProtectiveCoatings 					= '".$ProtectiveCoatings."',
									Contamination						= '".$Contamination."',
									Comments 							= '".$Comments."',
									economicsfactors_EconomicsFactorID	= '".$economicsfactors_EconomicsFactorID."', 
									loadingfactors_LoadingFactorID		= '".$loadingfactors_LoadingFactorID."', 
									ParapetLeftParapetTypeID			= '".$ParapetLeftParapetTypeID."',
									ParapetLeftLenth					= '".$ParapetLeftLenth."',
									ParapetRIghtParapetTypeID			= '".$ParapetRIghtParapetTypeID."',
									ParapetRIghtLenth					= '".$ParapetRIghtLenth."',
									ModifiedBy  						= '".$ModifiedBy ."',
									ModifiedDate						= '".$ModifiedDate."'
								WHERE  BridgeProfileID ='".$BridgeProfileID."'";
	
		$result_resource = mysql_query($query_resource) or die (mysql_error());
				
		$users_UserID		= $ModifiedBy;
		$TableName			= "bms_bridgeprofiles";
		$SQLQuery 			= ""; //str_replace("'", "\'", $query_resource);
		$Action				= "INSERT";		
		$query_log 			= "insert into bms_logs(users_UserID, TableName,	SQLQuery, 	Action) values ('".$users_UserID."','".$TableName."','". $SQLQuery."','". $Action."')";
		$result_log 		= mysql_query($query_log) or die (mysql_error());
		
		
		$query_dis	= "select BridgeProfileID from bms_bridgeprofiles where ModifiedBy=\"".$ModifiedBy."\" and ModifiedDate=\"".$ModifiedDate."\" order by BridgeProfileID";
		$result_dis	= mysql_query($query_dis) or die (mysql_error());
		while($row_dis	= mysql_fetch_array($result_dis))
		{			
			$BridgeProfileID 	= $row_dis['BridgeProfileID'];
		}
		////////////////////////////////////////////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////////

		
		
		////////////////////////////////////////////////////////////////////////////////////
		///////////////// Insert Query - 01 ////////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////////
		
		$query_resource_check 	= "select * from bms_operationalstatusesrecord where bridgeprofile_BridgeProfileID = '".$BridgeProfileID."' ";
		$result_resource_check	= mysql_query($query_resource_check) or die (mysql_error());
		if(mysql_num_rows($result_resource_check) > 0){
			$query_resource_delete	= "delete from bms_operationalstatusesrecord where bridgeprofile_BridgeProfileID = '".$BridgeProfileID."' ";
			$result_resource_delete = mysql_query($query_resource_delete) or die (mysql_error());
		}		
		
		$query_resource = "insert into bms_operationalstatusesrecord(
														bridgeprofile_BridgeProfileID, 
														operationalstatuses_OperationalStatusID, 
														OperationalStatusDate, 
														AddedBy, 
														AddedDate) 
											values ('".$BridgeProfileID."', 
													'".$operationalstatuses_OperationalStatusID."', 
													'".$operationstdate."', 
													'".$AddedBy."', 
													'".$AddedDate."')";
		$result_resource = mysql_query($query_resource) or die (mysql_error());
				
		$users_UserID	= $AddedBy;
		$TableName		= "bms_operationalstatusesrecord";		
		$SQLQuery 		= str_replace("'", "\'", $query_resource);
		$Action			= "INSERT";		
		$query_log = "insert into bms_logs(users_UserID, TableName,	SQLQuery, 	Action) values ('".$users_UserID."','".$TableName."','". $SQLQuery."','". $Action."')";
		$result_log = mysql_query($query_log) or die (mysql_error());
		
		////////////////////////////////////////////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////////
		
		
		////////////////////////////////////////////////////////////////////////////////////
		///////////////// Insert Query - 02 ////////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////////
		
		$query_resource_check_2 	= "select * from bms_spangroup where bridgeprofile_BridgeProfileID = '".$BridgeProfileID."' ";
		$result_resource_check_2	= mysql_query($query_resource_check_2) or die (mysql_error());
		if(mysql_num_rows($result_resource_check_2) > 0){
			$query_resource_delete_2	= "delete from bms_spangroup where bridgeprofile_BridgeProfileID = '".$BridgeProfileID."' ";
			$result_resource_delete_2 	= mysql_query($query_resource_delete_2) or die (mysql_error());
		}
		
		for($i=1; $i<=$NoOfSpans; $i++)
		{	
			$query_resource = "insert into bms_spangroup (bridgeprofile_BridgeProfileID, 
															YearOfConstruction, 
															SpanNumber, 
															SpanLength,
															spanmaterials_SpanMaterialID, 
															SpanType, 
															Original,
															AddedBy, 
															AddedDate) 
												values ('".$BridgeProfileID."', 
														'".$YearOfConstruction_spgroup[$i]."', 
														'".$i."', 
														'".$SpanLength_spgroup[$i]."', 
														'".$spanmaterials_SpanMaterialID_spgroup[$i]."',
														'".$spantypes_SpanTypeID_spgroup[$i]."',
														'".$comment_spgroup[$i]."',
														'".$AddedBy."', 
														'".$AddedDate."')";
			$result_resource = mysql_query($query_resource) or die (mysql_error());
					
			$users_UserID	= $AddedBy;
			$TableName		= "bms_spangroup";		
			$SQLQuery 		= str_replace("'", "\'", $query_resource);
			$Action			= "INSERT";		
			$query_log = "insert into bms_logs(users_UserID, TableName,	SQLQuery, 	Action) values ('".$users_UserID."','".$TableName."','". $SQLQuery."','". $Action."')";
			$result_log = mysql_query($query_log) or die (mysql_error());
		}
		////////////////////////////////////////////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////////
		
			
		////////////////////////////////////////////////////////////////////////////////////
		///////////////// Insert Query - 03 ////////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////////
		
		$query_resource_check_3 	= "select * from bms_decks where bridgeprofile_BridgeProfileID = '".$BridgeProfileID."' ";
		$result_resource_check_3	= mysql_query($query_resource_check_3) or die (mysql_error());
		if(mysql_num_rows($result_resource_check_3) > 0){
			$query_resource_delete_3	= "delete from bms_decks where bridgeprofile_BridgeProfileID = '".$BridgeProfileID."' ";
			$result_resource_delete_3 	= mysql_query($query_resource_delete_3) or die (mysql_error());
		}
		
		for($i=1; $i<=$NoOfSpans; $i++)
		{	
			$query_resource = "insert into bms_decks (bridgeprofile_BridgeProfileID, 
															YearOfConstruction, 
															DeckNumber, 
															DeckSurfaceThickness,
															deckmaterials_DeckMaterialID, 
															desksurfacetypes_DeskSurfaceTypeID, 
															Original,
															AddedBy, 
															AddedDate) 
												values ('".$BridgeProfileID."', 
														'".$YearOfConstruction_deck[$i]."', 
														'".$i."', 
														'".$DeckSurfaceThickness_deck[$i]."', 
														'".$deckmaterials_DeckMaterialID_deck[$i]."',
														'".$desksurfacetypes_DeskSurfaceTypeID_deck[$i]."',
														'".$comment_deck[$i]."',
														'".$AddedBy."', 
														'".$AddedDate."')";
			$result_resource = mysql_query($query_resource) or die (mysql_error());
					
			$users_UserID	= $AddedBy;
			$TableName		= "bms_decks";		
			$SQLQuery 		= str_replace("'", "\'", $query_resource);
			$Action			= "INSERT";		
			$query_log = "insert into bms_logs(users_UserID, TableName,	SQLQuery, 	Action) values ('".$users_UserID."','".$TableName."','". $SQLQuery."','". $Action."')";
			$result_log = mysql_query($query_log) or die (mysql_error());
			
		}
		////////////////////////////////////////////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////////
		
		
		
		////////////////////////////////////////////////////////////////////////////////////
		///////////////// Insert Query - 04 ////////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////////
		
		$query_resource_check_4 	= "select * from bms_piers where bridgeprofile_BridgeProfileID = '".$BridgeProfileID."' ";
		$result_resource_check_4	= mysql_query($query_resource_check_4) or die (mysql_error());
		if(mysql_num_rows($result_resource_check_4) > 0){
			$query_resource_delete_4	= "delete from bms_piers where bridgeprofile_BridgeProfileID = '".$BridgeProfileID."' ";
			$result_resource_delete_4 	= mysql_query($query_resource_delete_4) or die (mysql_error());
		}
		
		for($i=1; $i<=$NoOfPiers; $i++)
		{	

			$query_resource = "insert into bms_piers (bridgeprofile_BridgeProfileID, 
															PierNumber, 
															piertypes_PierTypeID, 
															piermaterials_PierMaterialID,
															ThicknessCappingLevel,
															AddedBy, 
															AddedDate) 
												values ('".$BridgeProfileID."', 														
														'".$i."', 
														'".$piertypes_PierTypeID_sub_pier[$i]."', 
														'".$piermaterials_PierMaterialID_sub_pier[$i]."',
														'".$ThicknessCappingLevel[$i]."',
														'".$AddedBy."', 
														'".$AddedDate."')";
			$result_resource = mysql_query($query_resource) or die (mysql_error());
					
			$users_UserID	= $AddedBy;
			$TableName		= "bms_piers";		
			$SQLQuery 		= str_replace("'", "\'", $query_resource);
			$Action			= "INSERT";		
			$query_log = "insert into bms_logs(users_UserID, TableName,	SQLQuery, 	Action) values ('".$users_UserID."','".$TableName."','". $SQLQuery."','". $Action."')";
			$result_log = mysql_query($query_log) or die (mysql_error());			
		}
		////////////////////////////////////////////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////////
		
		
		////////////////////////////////////////////////////////////////////////////////////
		///////////////// Insert Query - 05 ////////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////////
		
		$query_resource_check_5 	= "select * from bms_abutments where bridgeprofile_BridgeProfileID = '".$BridgeProfileID."' ";
		$result_resource_check_5	= mysql_query($query_resource_check_5) or die (mysql_error());
		if(mysql_num_rows($result_resource_check_5) > 0){
			$query_resource_delete_5	= "delete from bms_abutments where bridgeprofile_BridgeProfileID = '".$BridgeProfileID."' ";
			$result_resource_delete_5 	= mysql_query($query_resource_delete_5) or die (mysql_error());
		}
		
		for($i=1; $i<=2; $i++)
		{	
			if($i==1)
			{
				$abutmenttypes_AbutmentTypeID			= $abutmentmaterials_AbutmentMaterialID_sub_abunt_1;
				$abutmentmaterials_AbutmentMaterialID	= $abutmenttypes_SpanTypeID_sub_abunt_1;
			}
			else if($i==2)
			{
				$abutmenttypes_AbutmentTypeID			= $abutmentmaterials_AbutmentMaterialID_sub_abunt_2;
				$abutmentmaterials_AbutmentMaterialID	= $abutmenttypes_SpanTypeID_sub_abunt_2;
			}
			
			$query_resource = "insert into bms_abutments (bridgeprofile_BridgeProfileID, 
															AbutmentNumber, 
															abutmenttypes_AbutmentTypeID, 
															abutmentmaterials_AbutmentMaterialID,
															AddedBy, 
															AddedDate) 
												values ('".$BridgeProfileID."', 														
														'".$i."', 
														'".$abutmenttypes_AbutmentTypeID."', 
														'".$abutmentmaterials_AbutmentMaterialID."',
														'".$AddedBy."', 
														'".$AddedDate."')";
			$result_resource = mysql_query($query_resource) or die (mysql_error());
					
			$users_UserID	= $AddedBy;
			$TableName		= "bms_abutments";		
			$SQLQuery 		= str_replace("'", "\'", $query_resource);
			$Action			= "INSERT";		
			$query_log = "insert into bms_logs(users_UserID, TableName,	SQLQuery, 	Action) values ('".$users_UserID."','".$TableName."','". $SQLQuery."','". $Action."')";
			$result_log = mysql_query($query_log) or die (mysql_error());			
		}
		////////////////////////////////////////////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////////

		
		////////////////////////////////////////////////////////////////////////////////////
		///////////////// Insert Query - 06 ////////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////////
		
		$query_resource_check_6 	= "select * from bms_wingwalls where bridgeprofile_BridgeProfileID = '".$BridgeProfileID."' ";
		$result_resource_check_6	= mysql_query($query_resource_check_6) or die (mysql_error());
		if(mysql_num_rows($result_resource_check_6) > 0){
			$query_resource_delete_6	= "delete from bms_wingwalls where bridgeprofile_BridgeProfileID = '".$BridgeProfileID."' ";
			$result_resource_delete_6 	= mysql_query($query_resource_delete_6) or die (mysql_error());
		}
		
		for($i=1; $i<=4; $i++)
		{	
			if($i==1)
			{
				$wingtypes_WingTypeID			= $wingmaterials_WingMaterialID_sub_ww_1;
				$wingmaterials_WingMaterialID	= $wingtypes_WingTypeID_sub_ww_1;
				$WingWallLenth					= $WingWallLenth_1;
			}
			else if($i==2)
			{
				$wingtypes_WingTypeID			= $wingmaterials_WingMaterialID_sub_ww_2;
				$wingmaterials_WingMaterialID	= $wingtypes_WingTypeID_sub_ww_2;
				$WingWallLenth					= $WingWallLenth_2;
			}
			else if($i==3)
			{
				$wingtypes_WingTypeID			= $wingmaterials_WingMaterialID_sub_ww_3;
				$wingmaterials_WingMaterialID	= $wingtypes_WingTypeID_sub_ww_3;
				$WingWallLenth					= $WingWallLenth_3;
			}
			else if($i==4)
			{
				$wingtypes_WingTypeID			= $wingmaterials_WingMaterialID_sub_ww_4;
				$wingmaterials_WingMaterialID	= $wingtypes_WingTypeID_sub_ww_4;
				$WingWallLenth					= $WingWallLenth_4;
			}
		
			$query_resource = "insert into bms_wingwalls (bridgeprofile_BridgeProfileID, 
															WingWallPosition, 
															wingtypes_WingTypeID, 
															wingmaterials_WingMaterialID,
															WingWallLenth,
															AddedBy, 
															AddedDate) 
												values ('".$BridgeProfileID."', 														
														'".$i."', 
														'".$wingtypes_WingTypeID."', 
														'".$wingmaterials_WingMaterialID."',
														'".$WingWallLenth."',
														'".$AddedBy."', 
														'".$AddedDate."')";
			$result_resource = mysql_query($query_resource) or die (mysql_error());
					
			$users_UserID	= $AddedBy;
			$TableName		= "bms_wingwalls";		
			$SQLQuery 		= str_replace("'", "\'", $query_resource);
			$Action			= "INSERT";		
			$query_log = "insert into bms_logs(users_UserID, TableName,	SQLQuery, 	Action) values ('".$users_UserID."','".$TableName."','". $SQLQuery."','". $Action."')";
			$result_log = mysql_query($query_log) or die (mysql_error());			
		}
		////////////////////////////////////////////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////////
		
		
		
		
		
		////////////////////////////////////////////////////////////////////////////////////
		///////////////// Insert Query - 07 ////////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////////
		
		$query_resource_check_7 	= "select * from bms_pierfoundations where bridgeprofile_BridgeProfileID = '".$BridgeProfileID."' ";
		$result_resource_check_7	= mysql_query($query_resource_check_7) or die (mysql_error());
		if(mysql_num_rows($result_resource_check_7) > 0){
			$query_resource_delete_7	= "delete from bms_pierfoundations where bridgeprofile_BridgeProfileID = '".$BridgeProfileID."' ";
			$result_resource_delete_7 	= mysql_query($query_resource_delete_7) or die (mysql_error());
		}
		
		for($i=1; $i<=$NoOfPiers; $i++)
		{	

			$query_resource = "insert into bms_pierfoundations (bridgeprofile_BridgeProfileID, 
															PierNumber, 
															pierfoundationtypes_PierFoundationTypeID, 
															pierfoundationmaterials_PierFoundationMaterialID,
															Comments,
															AddedBy, 
															AddedDate) 
												values ('".$BridgeProfileID."', 														
														'".$i."', 
														'".$piertypes_PierTypeID_foun_pier[$i]."', 
														'".$piermaterials_PierMaterialID_foun_pier[$i]."',
														'".$pierComments_foun_pier[$i]."',
														'".$AddedBy."', 
														'".$AddedDate."')";
			$result_resource = mysql_query($query_resource) or die (mysql_error());
					
			$users_UserID	= $AddedBy;
			$TableName		= "bms_pierfoundations";		
			$SQLQuery 		= str_replace("'", "\'", $query_resource);
			$Action			= "INSERT";		
			$query_log = "insert into bms_logs(users_UserID, TableName,	SQLQuery, 	Action) values ('".$users_UserID."','".$TableName."','". $SQLQuery."','". $Action."')";
			$result_log = mysql_query($query_log) or die (mysql_error());			
		}
		////////////////////////////////////////////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////////
		
			
		
		////////////////////////////////////////////////////////////////////////////////////
		///////////////// Insert Query - 08 ////////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////////
		
		$query_resource_check_8 	= "select * from bms_abutmentfoundations where bridgeprofile_BridgeProfileID = '".$BridgeProfileID."' ";
		$result_resource_check_8	= mysql_query($query_resource_check_8) or die (mysql_error());
		if(mysql_num_rows($result_resource_check_8) > 0){
			$query_resource_delete_8	= "delete from bms_abutmentfoundations where bridgeprofile_BridgeProfileID = '".$BridgeProfileID."' ";
			$result_resource_delete_8 	= mysql_query($query_resource_delete_8) or die (mysql_error());
		}
		
		for($i=1; $i<=2; $i++)
		{	
			if($i ==1)
			{
				$abutmenttypes_SpanTypeID_foun_abunt				= $abutmenttypes_SpanTypeID_foun_abunt1;
				$abutmentmaterials_AbutmentMaterialID_foun_abunt	= $abutmentmaterials_AbutmentMaterialID_foun_abunt1;
				$abutmentComments_foun_abunt						= $abutmentComments_foun_abunt1;
			}
			else if($i ==2)
			{
				$abutmenttypes_SpanTypeID_foun_abunt				= $abutmenttypes_SpanTypeID_foun_abunt2;
				$abutmentmaterials_AbutmentMaterialID_foun_abunt	= $abutmentmaterials_AbutmentMaterialID_foun_abunt2;
				$abutmentComments_foun_abunt						= $abutmentComments_foun_abunt2;
			}
			
			
			$query_resource = "insert into bms_abutmentfoundations (bridgeprofile_BridgeProfileID, 
															AbutmentNumber, 
															abutmentfoundationtypes_AbutmentFoundationTypeID, 
															abutmentfoundationmaterials_AbutmentFoundationMaterialID,
															Comments,
															AddedBy, 
															AddedDate) 
												values ('".$BridgeProfileID."', 														
														'".$i."', 
														'".$abutmenttypes_SpanTypeID_foun_abunt."', 
														'".$abutmentmaterials_AbutmentMaterialID_foun_abunt."',
														'".$abutmentComments_foun_abunt."',
														'".$AddedBy."', 
														'".$AddedDate."')";
			$result_resource = mysql_query($query_resource) or die (mysql_error());
					
			$users_UserID	= $AddedBy;
			$TableName		= "bms_abutmentfoundations";		
			$SQLQuery 		= str_replace("'", "\'", $query_resource);
			$Action			= "INSERT";		
			$query_log = "insert into bms_logs(users_UserID, TableName,	SQLQuery, 	Action) values ('".$users_UserID."','".$TableName."','". $SQLQuery."','". $Action."')";
			$result_log = mysql_query($query_log) or die (mysql_error());			
		}
		////////////////////////////////////////////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////////

		
		////////////////////////////////////////////////////////////////////////////////////
		///////////////// Insert Query - 09 ////////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////////
		
		$query_resource_check_9 	= "select * from bms_wingwallfoundations where bridgeprofile_BridgeProfileID = '".$BridgeProfileID."' ";
		$result_resource_check_9	= mysql_query($query_resource_check_9) or die (mysql_error());
		if(mysql_num_rows($result_resource_check_9) > 0){
			$query_resource_delete_9	= "delete from bms_wingwallfoundations where bridgeprofile_BridgeProfileID = '".$BridgeProfileID."' ";
			$result_resource_delete_9 	= mysql_query($query_resource_delete_9) or die (mysql_error());
		}
		
		for($i=1; $i<=4; $i++)
		{			
		
			if($i==1)
			{
				$wingmaterials_WingMaterialID_foun_ww	= $wingmaterials_WingMaterialID_foun_ww1;
				$wingtypes_WingTypeID_foun_ww			= $wingtypes_WingTypeID_foun_ww1;
				$wingComments_foun_ww					= $wingComments_foun_ww1;
			}
			else if($i==2)
			{
				$wingmaterials_WingMaterialID_foun_ww	= $wingmaterials_WingMaterialID_foun_ww2;
				$wingtypes_WingTypeID_foun_ww			= $wingtypes_WingTypeID_foun_ww2;
				$wingComments_foun_ww					= $wingComments_foun_ww2;
			}
			else if($i==3)
			{
				$wingmaterials_WingMaterialID_foun_ww	= $wingmaterials_WingMaterialID_foun_ww3;
				$wingtypes_WingTypeID_foun_ww			= $wingtypes_WingTypeID_foun_ww3;
				$wingComments_foun_ww					= $wingComments_foun_ww3;
			}
			else if($i==4)
			{
				$wingmaterials_WingMaterialID_foun_ww	= $wingmaterials_WingMaterialID_foun_ww4;
				$wingtypes_WingTypeID_foun_ww			= $wingtypes_WingTypeID_foun_ww4;
				$wingComments_foun_ww					= $wingComments_foun_ww4;
			}
			
			
			
			
			$query_resource = "insert into bms_wingwallfoundations (bridgeprofile_BridgeProfileID, 
															WingWallPosition, 
															wingfoundationtypes_WingFoundationTypeID, 
															wingfoundationmaterials_WingFoundationMaterialID,
															Comments,
															AddedBy, 
															AddedDate) 
												values ('".$BridgeProfileID."', 														
														'".$i."', 
														'".$wingtypes_WingTypeID_foun_ww."', 
														'".$wingmaterials_WingMaterialID_foun_ww."',
														'".$wingComments_foun_ww."',
														'".$AddedBy."',
														'".$AddedDate."')";
			$result_resource = mysql_query($query_resource) or die (mysql_error());
					
			$users_UserID	= $AddedBy;
			$TableName		= "bms_wingwallfoundations";		
			$SQLQuery 		= str_replace("'", "\'", $query_resource);
			$Action			= "INSERT";		
			$query_log = "insert into bms_logs(users_UserID, TableName,	SQLQuery, 	Action) values ('".$users_UserID."','".$TableName."','". $SQLQuery."','". $Action."')";
			$result_log = mysql_query($query_log) or die (mysql_error());			
		}
		////////////////////////////////////////////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////////
		
		////////////////////////////////////////////////////////////////////////////////////
		///////////////// File Upload //////////////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////////
		
		$CadDesignFileName	= array();	
		$DrawingFileName	= array();	
		$ImageFileName		= array();	
		$OtherFileName		= array();
		
		
		for($i=1; $i <= 5; $i++)
		{		
			$filename	= '';
			$filename 	= basename($_FILES['CadDesign'.$i.'Name']['name']);
			$CadDesignFileName[$i]	= $filename;
			if($filename != ""){
				$ext = substr($filename, strrpos($filename, '.') + 1);
				$lcase_ext = strtolower($ext);
				if($lcase_ext == "dwg")
				{
					$target = $datadir."dwg/"; 
					$target = $target . $BridgeProfileID."-".$i.".dwg";
					move_uploaded_file($_FILES['CadDesign'.$i.'Name']['tmp_name'],$target);
				}
			}
		}

		
		for($i=1; $i <= 10; $i++)
		{
			$filename	= '';
			$filename 	= basename($_FILES['Drawing'.$i.'Name']['name']);
			$DrawingFileName[$i]	= $filename;
			if($filename != ""){
				$ext = substr($filename, strrpos($filename, '.') + 1);
				$lcase_ext = strtolower($ext);
				if($lcase_ext == "pdf")
				{
					$target = $datadir."pdf/"; 
					$target = $target . $BridgeProfileID."-".$i.".pdf";
					move_uploaded_file($_FILES['Drawing'.$i.'Name']['tmp_name'],$target);
				}
			}
		}

		for($i=1; $i <= 5; $i++)
		{
			$filename	= '';
			$filename 	= basename($_FILES['Image'.$i.'Name']['name']);
			$ImageFileName[$i]	= $filename;
			if($filename != ""){
				$ext = substr($filename, strrpos($filename, '.') + 1);
				$lcase_ext = strtolower($ext);
				if($lcase_ext == "jpg")
				{
					$target = $datadir."jpg/"; 
					$target = $target . $BridgeProfileID."-".$i.".jpg";
					move_uploaded_file($_FILES['Image'.$i.'Name']['tmp_name'],$target);
				}
			}
		}
		
		for($i=1; $i <= 5; $i++)
		{
			$filename	= '';
			$lcase_ext  = '';
			$filename 	= basename($_FILES['Other'.$i.'Name']['name']);
			$OtherFileName[$i]	= $filename;
			$ext = substr($filename, strrpos($filename, '.') + 1);
			$lcase_ext = strtolower($ext);
			if($lcase_ext != "")
			{
				$target = $datadir."other/"; 
				$target = $target . $BridgeProfileID."-".$i.".".$lcase_ext;
				move_uploaded_file($_FILES['Other'.$i.'Name']['tmp_name'],$target);
			}	
		}
		


		
		$query_resource	= '';
		$query_resource = "update bms_bridgeprofileattachments set ";
		$x1 = 0;
		$tempx1 = 0;
		$tempx1 = $x1;
		for($i=1; $i <= 5; $i++)
		{	
			if($CadDesignFileName[$i] != ""){
				if($x1 > $tempx1){
					$query_resource = $query_resource .", ";
				}
				$tempx1 = $x1;
				$query_resource = $query_resource . "CadDesign".$i."Name = '".$CadDesignFileName[$i]."'";
				$x1++;
			}
			if($_POST['CadDesign'.$i.'Dis'] != ""){
				if($x1 > $tempx1){
					$query_resource = $query_resource .", ";
				}
				$tempx1 = $x1;
				$query_resource = $query_resource . "CadDesign".$i."Dis = '".$_POST['CadDesign'.$i.'Dis']."'";
				$x1++;
			}
		}
	
		
		for($i=1; $i <= 10; $i++)
		{	
			if($DrawingFileName[$i] != ""){
				if($x1 > $tempx1){
					$query_resource = $query_resource .", ";
				}
				$tempx1 = $x1;
				$query_resource = $query_resource . "Drawing".$i."Name = '".$DrawingFileName[$i]."'";
				$x1++;
			}
			if($_POST['Drawing'.$i.'Dis'] != ""){
				if($x1 > $tempx1){
					$query_resource = $query_resource .", ";
				}
				$tempx1 = $x1;
				$query_resource = $query_resource . "Drawing".$i."Dis = '".$_POST['Drawing'.$i.'Dis']."'";
				$x1++;
			}
		}

		for($i=1; $i <= 5; $i++)
		{	
			if($ImageFileName[$i] != ""){
				if($x1 > $tempx1){
					$query_resource = $query_resource .", ";
				}
				$tempx1 = $x1;
				$query_resource = $query_resource . "Image".$i."Name = '".$ImageFileName[$i]."'";
				$x1++;
			}
			if($_POST['Image'.$i.'Dis'] != ""){
				if($x1 > $tempx1){
					$query_resource = $query_resource .", ";
				}
				$tempx1 = $x1;
				$query_resource = $query_resource . "Image".$i."Dis = '".$_POST['Image'.$i.'Dis']."'";
				$x1++;
			}
		}
		
		
		
		for($i=1; $i <= 5; $i++)
		{	
			if($OtherFileName[$i] != ""){
				if($x1 > $tempx1){
					$query_resource = $query_resource .", ";
				}
				$tempx1 = $x1;
				$query_resource = $query_resource . "Other".$i."Name = '".$OtherFileName[$i]."'";
				$x1++;
			}
			if($_POST['Other'.$i.'Dis'] != ""){
				if($x1 > $tempx1){
					$query_resource = $query_resource .", ";
				}
				$tempx1 = $x1;
				$query_resource = $query_resource . "Other".$i."Dis = '".$_POST['Other'.$i.'Dis']."'";
				$x1++;
			}
		}
		
		
		$query_resource = $query_resource ."";
		if($x1 > 0){
			$result_resource = mysql_query($query_resource) or die (mysql_error());
						
			$users_UserID	= $AddedBy;
			$TableName		= "bms_bridgeprofileattachments";		
			$SQLQuery 		= str_replace("'", "\'", $query_resource);
			$Action			= "UPDATE";		
			$query_log = "insert into bms_logs(users_UserID, TableName,	SQLQuery, 	Action) values ('".$users_UserID."','".$TableName."','". $SQLQuery."','". $Action."')";
			$result_log = mysql_query($query_log) or die (mysql_error());
		}
		
		
		echo "<p class=\"bodytextsus\"><BR />Successfully Edited ....<BR /></p>";		
				


	}
	
	
	
	
	
	
	
	
	
	
	
	
	echo "<form autocomplete=\"off\"  enctype=\"multipart/form-data\" name=\"myfirstformx\" id=\"myfirstformx\" method=\"POST\" action=\"#\"  >";
		
		
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
{

	echo "<form autocomplete=\"off\" enctype=\"multipart/form-data\"  name=\"myfirstform\" id=\"myfirstform\" method=\"POST\" action=\"#\"  >";
	echo "<input type=\"hidden\"  name=\"BridgeProfileID\" value=\"".$BridgeProfileID."\" />";
	

	
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
					<td class=\"mytd\">".$StructureID."</td>
					<td><span id=\"structure_id\" class=\"bodytextred\"></span></td>
				</tr>
				<tr>
					<td class=\"mytd\">Name of the Bridge</td>
					<td class=\"mytd\"> <input type=\"text\" class=\"mytextbox3\" name=\"BridgeName\" value=\"".$BridgeName."\" id=\"BridgeName\" > </td>
					<td><span id=\"bname_id\" class=\"bodytextred\"></span></td>
				</tr>	
				
				<tr>
				
				<td class=\"mytd\">Owner of the Bridge</td>
				";
					echo "<td  class=\"mytd\">";
					$query_dis	= "select * from bms_owners order by OwnerName";
					$result_dis		= mysql_query($query_dis) or die (mysql_error());

					echo "<select name=\"owners_OwnerID\" class=\"myselect3\">";
						echo "<option value=\"0\">Unspecified</option>";
						while($row_dis	= mysql_fetch_array($result_dis))
						{
							$OwnerID 	= $row_dis['OwnerID'];
							$OwnerName	= $row_dis['OwnerName'];
							
							echo "<option value=\"".$OwnerID."\"";
								if($owners_OwnerID == $OwnerID){
									echo "selected = 'selected'";
								}
							echo ">".$OwnerName."</option>";
							
						}
					echo "</select>";
				echo "</td>";
				echo "
				
				</tr>

				
				
				<tr>
				
				<td class=\"mytd\">Road Name</td>
				";
					echo "<td  class=\"mytd\">";
					$query_dis	= "select RoadNameID, RoadName from bms_roadnames order by RoadName";
					$result_dis		= mysql_query($query_dis) or die (mysql_error());

					echo "<select name=\"roadnames_RoadNameID\" class=\"myselect3\">";
						echo "<option value=\"0\">Unspecified</option>";
						while($row_dis	= mysql_fetch_array($result_dis))
						{
							$RoadNameID = $row_dis['RoadNameID'];
							$RoadName	= $row_dis['RoadName'];
							
							echo "<option value=\"".$RoadNameID."\"";
							if($roadnames_RoadNameID == $RoadNameID)
							{
								echo "selected='selected'";
							}
							echo ">".$RoadName."</option>";
						}
					echo "</select>";
				echo "</td>";
				echo "
				
				</tr>
				
				<tr>
				
				<td class=\"mytd\">Road Number</td>
				";
					echo "<td  class=\"mytd\">";
					$query_dis	= "select RouteNoID, RouteNo from bms_routenos order by RouteNo";
					$result_dis		= mysql_query($query_dis) or die (mysql_error());

					echo "<select name=\"routenos_RouteNoID\" class=\"myselect3\">";
						echo "<option value=\"0\">Unspecified</option>";
						while($row_dis	= mysql_fetch_array($result_dis))
						{
							$RouteNoID  = $row_dis['RouteNoID'];
							$RouteNo	= $row_dis['RouteNo'];
							echo "<option value=\"".$RouteNoID."\"";
							if($routenos_RouteNoID == $RouteNoID)
							{
								echo "selected='selected'";
							}
							echo ">".$RouteNo."</option>";
						}
					echo "</select>";
				echo "</td>";
				echo "
				
				</tr>
				
				<tr>
				
				<td class=\"mytd\">Road Class</td>
				";
					echo "<td  class=\"mytd\">";
					$query_dis	= "select RoadClassID, RoadClass from bms_roadclasses order by RoadClass";
					$result_dis		= mysql_query($query_dis) or die (mysql_error());

					echo "<select name=\"roadclasses_RoadClassID\" class=\"myselect3\">";
						echo "<option value=\"0\">Unspecified</option>";
						while($row_dis	= mysql_fetch_array($result_dis))
						{
							$RoadClassID  = $row_dis['RoadClassID'];
							$RoadClass	  = $row_dis['RoadClass'];
							
							echo "<option value=\"".$RoadClassID."\"";
							if($roadclasses_RoadClassID == $RoadClassID)
							{
								echo "selected='selected'>".$RoadClass."</option>";
							}
							echo ">".$RoadClass."</option>";
						}
					echo "</select>";
				echo "</td>";
				echo "
				
				</tr>
				
				<tr>			
				<td class=\"mytd\" width=\"285\">Function of the Bridge</td>
				";
					echo "<td  class=\"mytd\">";
					$query_dis	= "select FuncOfBridgeID, FuncOfBridge from bms_funcofbridges order by FuncOfBridge";
					$result_dis		= mysql_query($query_dis) or die (mysql_error());

					echo "<select name=\"funcofbridges_FuncOfBridgeID\" class=\"myselect3\" onChange=\"selfun(this)\">";
						echo "<option value=\"0\">Unspecified</option>";
						while($row_dis	= mysql_fetch_array($result_dis))
						{
							$FuncOfBridgeID = $row_dis['FuncOfBridgeID'];
							$FuncOfBridge	= $row_dis['FuncOfBridge'];
							
							echo "<option value=\"".$FuncOfBridgeID."\"";
							if($funcofbridges_FuncOfBridgeID == $FuncOfBridgeID)
							{
								echo "selected='selected'";
							}
							echo ">".$FuncOfBridge."</option>";
						}
					echo "</select>";
				echo "</td>";
				echo "			
				</tr>
				
				
				
				<tr name=\"div_nriver\" id=\"div_nriver\">			
				<td class=\"mytd\" >Name of the River</td>
				";
					echo "<td  class=\"mytd\">";
					
					echo "
					<input type=\"text\" class=\"mytextbox3\" name=\"RiverName\" value=\"".$RiverName."\"  id=\"RiverName\" >
				</td>";
				echo "
				
				</tr>
		
				<tr name=\"div_nr\" id=\"div_nuproad\">
					<td class=\"mytd\">Name of the Road - UnderPass</td>
					<td class=\"mytd\"> <input type=\"text\" class=\"mytextbox3\" name=\"UnderPassRoad\" value=\"".$UnderPassRoad."\"  id=\"UnderPassRoad\" > </td>
					<td><span id=\"oname_id\" class=\"bodytextred\"></span></td>
				</tr>	
			
				<tr name=\"div_nr\" id=\"div_noproad\">
					<td class=\"mytd\">Name of the Road - OverPass</td>
					<td class=\"mytd\"> <input type=\"text\" class=\"mytextbox3\" name=\"OverPassRoad\" value=\"".$OverPassRoad."\" id=\"OverPassRoad\" > </td>
					<td><span id=\"oname_id\" class=\"bodytextred\"></span></td>
				</tr>	
				

				
				<tr name=\"div_nr\" id=\"div_norail\">
				
				<td class=\"mytd\">Name of the Railway - Road over rail</td>
				";
					echo "<td  class=\"mytd\">";
					$query_dis	= "select * from bms_railroadnames order by RailRoadName";
					$result_dis		= mysql_query($query_dis) or die (mysql_error());

					echo "<select name=\"railroadnames_RailRoadID\" class=\"mytextbox3\">";
						while($row_dis	= mysql_fetch_array($result_dis))
						{
						
							$RailRoadNameID    = $row_dis['RailRoadNameID'];
							$RailRoadName	= $row_dis['RailRoadName'];
							if($railroadnames_RailRoadID == $RailRoadNameID)
							{
								echo "<option value=\"".$RailRoadNameID."\" selected=\"selected\">".$RailRoadName."</option>";
							}
							else
							{
								echo "<option value=\"".$RailRoadNameID."\" >".$RailRoadName."</option>";
							}
						}
					echo "</select>";
				echo "</td>";
				echo "			
				</tr>		
			</table>";
			
			
			
			
			
			
			echo "<br />";
			echo "<p class=\"bodytextbold\"><u>Overview</u></p>";
			
		
			echo "<table class=\"bodytext\">
			
			
				<tr>			
					<td class=\"mytd\" width=\"285\">Economic Factor</td>
					";
						echo "<td  class=\"mytd\">";
						$query_dis	= "select * from bms_economicsfactors order by EconomicsFactorName";
						$result_dis		= mysql_query($query_dis) or die (mysql_error());

						echo "<select name=\"economicsfactors_EconomicsFactorID\" class=\"mytextbox3\">";
							while($row_dis	= mysql_fetch_array($result_dis))
							{
							
								$EconomicsFactorID 	= $row_dis['EconomicsFactorID'];
								$EconomicsFactorName	= $row_dis['EconomicsFactorName'];
								if($economicsfactors_EconomicsFactorID == $EconomicsFactorID)
								{
									echo "<option value=\"".$EconomicsFactorID."\" selected=\"selected\">".$EconomicsFactorName."</option>";
								}
								else
								{
									echo "<option value=\"".$EconomicsFactorID."\" >".$EconomicsFactorName."</option>";
								}
							}
						echo "</select>";
					echo "</td>";
					echo "			
				</tr>
				
				
				<tr>			
					<td class=\"mytd\" width=\"285\">Structure Type</td>
					";
						echo "<td  class=\"mytd\">";
						$query_dis	= "select * from bms_structuretypes order by StructureTypeName";
						$result_dis		= mysql_query($query_dis) or die (mysql_error());

						echo "<select name=\"structuretypes_StructureTypeID\" class=\"mytextbox3\">";
							echo "<option value=\"0\">Unspecified</option>";
							while($row_dis	= mysql_fetch_array($result_dis))
							{
								$StructureTypeID 	= $row_dis['StructureTypeID'];
								$StructureTypeName	= $row_dis['StructureTypeName'];
								echo "<option value=\"".$StructureTypeID."\"";
									if($structuretypes_StructureTypeID == $StructureTypeID)
									{	
										echo "selected='selected'";
									}
								echo ">".$StructureTypeName."</option>";
							}
						echo "</select>";
					echo "</td>";
					echo "			
				</tr>
				
				
				
				<tr>			
					<td class=\"mytd\" >Construction Material</td>
					";
						echo "<td  class=\"mytd\">";
						$query_dis	= "select * from bms_constructionmaterials order by ConstructionMaterial";
						$result_dis		= mysql_query($query_dis) or die (mysql_error());

						echo "<select name=\"constructionmaterials_ConstructionMaterialID\" class=\"mytextbox3\">";
							echo "<option value=\"0\">Unspecified</option>";
							while($row_dis	= mysql_fetch_array($result_dis))
							{
								$ConstructionMaterialID 	= $row_dis['ConstructionMaterialID'];
								$ConstructionMaterial	= $row_dis['ConstructionMaterial'];
								echo "<option value=\"".$ConstructionMaterialID."\"";
									if($constructionmaterials_ConstructionMaterialID == $ConstructionMaterialID)
									{
										echo "selected='selected'";
									}
								echo ">".$ConstructionMaterial."</option>";
							}
						echo "</select>";
					echo "</td>";
					echo "			
				</tr>
				
				
				
				
				
				
				
				<tr>			
					<td class=\"mytd\" >Construction Year</td>
					";
						echo "<td  class=\"mytd\">";
						echo "<select name=\"YearOfConstructionStart\" class=\"mytextbox3\">";
							$thisyear = date(Y);
							echo "<option value=\"0\">Unspecified</option>";
							for($myi=$thisyear; $myi >=2000; $myi--)
							{							
								echo "<option value=\"".$myi."\"";
									if($YearOfConstructionStart == $myi)
									{
										echo "selected=\"selected\"";
									}
								echo ">".$myi."</option>";
							}
						echo "</select>";
					echo "</td>";
					echo "			
				</tr>
				
				
				
				<tr>			
					<td class=\"mytd\" >Operational Status</td>
					";
						echo "<td  class=\"mytd\">";
						$query_dis	= "select * from bms_operationalstatuses order by OperationalStatus";
						$result_dis		= mysql_query($query_dis) or die (mysql_error());
						echo "<input type=\"hidden\" name=\"OperationalStatusesRecordID\" value=\"".$OperationalStatusesRecordID."\" />";
						echo "<select name=\"operationalstatuses_OperationalStatusID\" class=\"mytextbox3\">";
							echo "<option value=\"0\">Unspecified</option>";
							while($row_dis	= mysql_fetch_array($result_dis))
							{
								$OperationalStatusID	= $row_dis['OperationalStatusID'];
								$OperationalStatus	= $row_dis['OperationalStatus'];
								echo "<option value=\"".$OperationalStatusID."\"";
									if($operationalstatuses_OperationalStatusID == $OperationalStatusID)
									{	
										echo "selected=\"selected\"";
									}
								echo ">".$OperationalStatus."</option>";
							}
						echo "</select>";
					echo "</td>";
					echo "			
				</tr>
				
				
				
				<tr>			
					<td class=\"mytd\" >Operational Status Date</td>
					";
						echo "<td  class=\"mytd\">";					
						
						echo "<input type=\"text\" class=\"mytextbox3\" name=\"operationstdate\" value=\"".$OperationalStatusDate."\"  id=\"operationstdate\" >";
						
					
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
						echo "<td  class=\"mytd\">";
						$query_dis	= "select * from bms_districts order by District";
						$result_dis		= mysql_query($query_dis) or die (mysql_error());

						echo "<select name=\"district_DistrictID\" class=\"mytextbox3\">";
							echo "<option value=\"0\">Unspecified</option>";
							while($row_dis	= mysql_fetch_array($result_dis))
							{
								$DistrictID 	= $row_dis['DistrictID'];
								$District	= $row_dis['District'];
								echo "<option value=\"".$DistrictID."\"";
									if($district_DistrictID == $DistrictID)
									{
										echo "selected=\"selected\"";
									}
								echo ">".$District."</option>";
							}
						echo "</select>";
					echo "</td>";
					echo "			
				</tr>
				
				
				<tr>			
					<td class=\"mytd\" width=\"285\">Province</td>
					";
						echo "<td  class=\"mytd\">";
						$query_dis	= "select * from bms_provinces order by Province";
						$result_dis		= mysql_query($query_dis) or die (mysql_error());

						echo "<select name=\"provinces_ProvinceID\" class=\"mytextbox3\">";
							echo "<option value=\"0\">Unspecified</option>";
							while($row_dis	= mysql_fetch_array($result_dis))
							{
								$ProvinceID 	= $row_dis['ProvinceID'];
								$Province		= $row_dis['Province'];
								echo "<option value=\"".$ProvinceID."\"";
									if($provinces_ProvinceID == $ProvinceID)
									{
										echo "selected=\"selected\"";
									}
								echo ">".$Province."</option>";
							}
						echo "</select>";
					echo "</td>";
					echo "			
				</tr>
				
				
				<tr>			
					<td class=\"mytd\" >EE-Division</td>
					";
						echo "<td  class=\"mytd\">";
						echo "<input type=\"text\" value=\"".$EEDivision."\" class=\"mytextbox3\" name=\"EEDivision\" id=\"EEDivision\" >";
					echo "</td>";
					echo "			
				</tr>
				
				
				
				<tr>			
					<td class=\"mytd\" >Closest Town</td>
					";
						echo "<td  class=\"mytd\">";
						echo "<input type=\"text\" class=\"mytextbox3\" name=\"ClosestTown\" value=\"".$ClosestTown."\"  id=\"ClosestTown\" >";
					echo "</td>";
					echo "			
				</tr>
				
				
				
				
				
				
				
				<tr>			
					<td class=\"mytd\" >Start Chainage (Km)</td>
					";
						echo "<td  class=\"mytd\">";
						echo "<input type=\"text\" class=\"mytextbox3\" name=\"StartChainage\"  value=\"".$StartChainage."\" id=\"StartChainage\" >";
					echo "</td>";
					echo "			
				</tr>
				
				
				<tr>			
					<td class=\"mytd\" >End Chainage (Km)</td>
					";
						echo "<td  class=\"mytd\">";
						echo "<input type=\"text\" class=\"mytextbox3\" name=\"EndChainage\" id=\"EndChainage\" value=\"".$EndChainage."\">";
					echo "</td>";
					echo "			
				</tr>
				
				
				<tr>			
					<td class=\"mytd\" >Length of Bridge (m)</td>
					";
						echo "<td  class=\"mytd\">";
						echo "<input type=\"text\" class=\"mytextbox3\" name=\"GazettedLength\" id=\"GazettedLength\"  value=\"".htmlentities($GazettedLength)."\" >";
					echo "</td>";
					echo "			
				</tr>
				
				
				
				
				<tr>			
					<td class=\"mytd\" >GPS Coordinate (N)</td>
					";
						echo "<td  class=\"mytd\">";
						echo "<input type=\"text\" class=\"mytextbox3\" name=\"GPSCoordinateN\" value=\"".htmlentities($GPSCoordinateN)."\"  id=\"GPSCoordinateN\" >";
					echo "</td>";
					echo "			
				</tr>
				
				
				<tr>			
					<td class=\"mytd\" >GPS Coordinate (E)</td>
					";
						echo "<td  class=\"mytd\">";
						echo "<input type=\"text\" class=\"mytextbox3\" name=\"GPSCoordinateE\"  value=\"".htmlentities($GPSCoordinateE)."\" id=\"GPSCoordinateE\" >";
					echo "</td>";
					echo "			
				</tr>
				
				
				<tr>			
					<td class=\"mytd\" >GPS Coordinate (Z)</td>
					";
						echo "<td  class=\"mytd\">";
						echo "<input type=\"text\" class=\"mytextbox3\" name=\"GPSCoordinateZ\"   value=\"".$GPSCoordinateZ."\" id=\"GPSCoordinateZ\" >";
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
						echo "<td  class=\"mytd\">";
						$query_dis	= "select * from bms_designstandards order by DesignStandard";
						$result_dis		= mysql_query($query_dis) or die (mysql_error());

						echo "<select name=\"designstandards_DesignStandardID\" class=\"mytextbox3\">";
							echo "<option value=\"0\">Unspecified</option>";
							while($row_dis	= mysql_fetch_array($result_dis))
							{
								$DesignStandardID 	= $row_dis['DesignStandardID'];
								$DesignStandard	= $row_dis['DesignStandard'];
								echo "<option value=\"".$DesignStandardID."\"";
									if($designstandards_DesignStandardID == $DesignStandardID)
									{
										echo "selected=\"selected\"";
									}
								echo ">".$DesignStandard."</option>";
							}
						echo "</select>";
					echo "</td>";
					echo "			
				</tr>";
				
			
				
				echo "	
				
				
				
				<tr>			
					<td class=\"mytd\" >Structure (Deck area) Length (m)</td>
					";
						echo "<td  class=\"mytd\">";
						echo "<input type=\"text\" class=\"mytextbox3\" name=\"StructureLength\"  value=\"".$StructureLength."\" id=\"StructureLength\" >";
					echo "</td>";
					echo "			
				</tr>
				
				
				<tr>			
					<td class=\"mytd\" >Structure (Deck area) Width	(m)</td>
					";
						echo "<td  class=\"mytd\">";
						echo "<input type=\"text\" class=\"mytextbox3\" name=\"StructureWidth\"  value=\"".$StructureWidth."\" id=\"StructureWidth\" >";
					echo "</td>";
					echo "			
				</tr>
				
				
				
				<tr>			
					<td class=\"mytd\" >Number of Spans</td>
					";
						echo "<td  class=\"mytd\">";
						echo "<select name=\"NoOfSpans\" class=\"mytextbox3\" onChange=\"selfunnumspan(this)\">";
							for($myj=0; $myj<=30; $myj++)
							{							
								if($NoOfSpans == $myj)
								{
									echo "<option value=\"".$myj."\" selected=\"selected\">".$myj."</option>";
								}
								else
								{
									echo "<option value=\"".$myj."\" >".$myj."</option>";
								}
							}
						echo "</select>";
					echo "</td>";
					echo "			
				</tr>
				
				
				<tr>			
					<td class=\"mytd\" >Number of Piers</td>
					";
						echo "<td  class=\"mytd\">";
						echo "<select name=\"NoOfPiers\" class=\"mytextbox3\"    onChange=\"selfunnumpier(this)\"             >";
							for($myk=0; $myk<=30; $myk++)
							{							
								if($NoOfPiers == $myk)
								{
									echo "<option value=\"".$myk."\" selected=\"selected\">".$myk."</option>";
								}
								else
								{
									echo "<option value=\"".$myk."\" >".$myk."</option>";
								}
							}
						echo "</select>";
					echo "</td>";
					echo "			
				</tr>	
				
			</table>";	
			
		
		
		
		echo "<p class=\"bodytextbold\"><br /><u>Structure Load Capacity</u></p>";
			
		
			echo "<table class=\"bodytext\">
			
				<tr>			
					<td class=\"mytd\" width=\"285\">Gross Load Limit (Tons)</td>
					";
						echo "<td  class=\"mytd\">";
							echo "<input type=\"text\" class=\"mytextbox3\" value=\"".$GrossLoadLimit."\"  name=\"GrossLoadLimit\" id=\"GrossLoadLimit\" >";
					echo "</td>";
					echo "			
				</tr>
				
				
				
				<tr>			
					<td class=\"mytd\" >Posted Load Limit (Tons)</td>
					";
						echo "<td  class=\"mytd\">";
						echo "<input type=\"text\" class=\"mytextbox3\"  value=\"".$PostedLoadLimit."\" name=\"PostedLoadLimit\" id=\"PostedLoadLimit\" >";
					echo "</td>";
					echo "			
				</tr>
				
				
				
				<tr>			
					<td class=\"mytd\" width=\"285\">Loading Factor</td>
					";
						echo "<td  class=\"mytd\">";
						$query_dis	= "select * from bms_loadingfactors order by LoadingFactorID";
						$result_dis		= mysql_query($query_dis) or die (mysql_error());

						echo "<select name=\"loadingfactors_LoadingFactorID\" class=\"mytextbox3\">";
							while($row_dis	= mysql_fetch_array($result_dis))
							{
							
								$LoadingFactorID 	= $row_dis['LoadingFactorID'];
								$LoadingFactorName	= $row_dis['LoadingFactorName'];
								if($loadingfactors_LoadingFactorID == $LoadingFactorID)
								{
									echo "<option value=\"".$LoadingFactorID."\" selected=\"selected\">".$LoadingFactorName."</option>";
								}
								else
								{
									echo "<option value=\"".$LoadingFactorID."\" >".$LoadingFactorName."</option>";
								}
							}
						echo "</select>";
					echo "</td>";
					echo "			
				</tr>
				
				
				
				<tr>			
					<td class=\"mytd\" >Human Factor (AADT)</td>
					";
						echo "<td  class=\"mytd\">";
						echo "<select name=\"AADT\" id=\"AADT\" class=\"myselect3\">
							<option value=\"1\""; if($AADT=="1") echo "selected='selected'"; echo ">0-1000</option>
							<option value=\"2\""; if($AADT=="2") echo "selected='selected'"; echo ">1000-5000</option>
							<option value=\"3\""; if($AADT=="3") echo "selected='selected'"; echo ">5000-10000</option>
							<option value=\"4\""; if($AADT=="4") echo "selected='selected'"; echo ">>10000</option>
						</select>";			
					echo "</td>";
					echo "			
				</tr>
				
				
				<tr>			
					<td class=\"mytd\" >Traffic Access Detour (Km)</td>
					";
						echo "<td  class=\"mytd\">";
						echo "<select name=\"Detours\" id=\"Detours\" class=\"myselect3\">
							<option value=\"1\""; if($Detours=="1") echo "selected='selected'"; echo ">0-10</option>
							<option value=\"2\""; if($Detours=="2") echo "selected='selected'"; echo ">10-20</option>
							<option value=\"3\""; if($Detours=="3") echo "selected='selected'"; echo ">20-50</option>
							<option value=\"4\""; if($Detours=="4") echo "selected='selected'"; echo ">50-100</option>
							<option value=\"5\""; if($Detours=="5") echo "selected='selected'"; echo ">>100</option>
						</select>";	
					echo "</td>";
					echo "			
				</tr>
				
				
				<tr>			
					<td class=\"mytd\" >Heavy Vehicle (HV)</td>
					";
						echo "<td  class=\"mytd\">";
						echo "<input type=\"text\" class=\"mytextbox3\"  value=\"".$HeavyVehicle."\" name=\"HeavyVehicle\" id=\"HeavyVehicle\" >";
					echo "</td>";
					echo "			
				</tr>
										
			</table>";
			
			
		
		
		echo "<p class=\"bodytextbold\"><br /><u>Utilities</u></p>";
			
		
			echo "<table class=\"bodytext\">
			
				<tr>			
					<td class=\"mytd\" width=\"285\">Services</td>
					";
						echo "<td  class=\"mytd\">";
							echo "<input type=\"text\" class=\"mytextbox3\"   value=\"".$AttachmentsServices."\" name=\"AttachmentsServices\" id=\"AttachmentsServices\" >";
					echo "</td>";
					echo "			
				</tr>
				
				
				
				<tr>			
					<td class=\"mytd\" >Details</td>
					";
						echo "<td  class=\"mytd\">";
						echo "<input type=\"text\" class=\"mytextbox3\"   value=\"".$AttachmentsDetails."\" name=\"AttachmentsDetails\" id=\"AttachmentsDetails\" >";
					echo "</td>";
					echo "			
				</tr>
				
				
				
				
				<tr>			
					<td class=\"mytd\" >Locations</td>
					";
						echo "<td  class=\"mytd\">";
						$query_dis	= "select * from bms_attachmentslocations order by AttachmentsLocations";
						$result_dis		= mysql_query($query_dis) or die (mysql_error());

						echo "<select name=\"attachmentslocations_AttachmentsLocationsID\" class=\"mytextbox3\">";
							echo "<option value=\"0\">Unspecified</option>";
							while($row_dis	= mysql_fetch_array($result_dis))
							{
								$AttachmentsLocationsID 	= $row_dis['AttachmentsLocationsID'];
								$AttachmentsLocations	= $row_dis['AttachmentsLocations'];
								echo "<option value=\"".$AttachmentsLocationsID."\"";
									if($attachmentslocations_AttachmentsLocationsID == $AttachmentsLocationsID)
									{
										echo "selected=\"selected\"";
									}
								echo ">".$AttachmentsLocations."</option>";
							}
						echo "</select>";
					echo "</td>";
					echo "			
				</tr>
				
				
				<tr>			
					<td class=\"mytd\" >Number of Lamp Posts</td>
					";
						echo "<td  class=\"mytd\">";
							echo "<input type=\"text\" class=\"mytextbox3\"  value=\"".$NumberOfLampPosts."\" name=\"NumberOfLampPosts\" id=\"NumberOfLampPosts\" >";
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
						echo "<td  class=\"mytd\">";
						echo "<input type=\"text\" class=\"mytextbox3\" value=\"".$CarriagewayWidth."\"  name=\"CarriagewayWidth\" id=\"CarriagewayWidth\" >";
					echo "</td>";
					echo "			
				</tr>
				
				
				<tr>			
					<td >&nbsp;</td><td >&nbsp;</td>
				</tr>
				
				<tr>			
					<td class=\"mytd\" >Number of Lanes</td>
					";
						echo "<td  class=\"mytd\">";
						
						echo "<select name=\"NoOfLanes\" class=\"mytextbox3\">";
							for($myj=0; $myj<=10; $myj++)
							{							
								if($NoOfSpans == $myj)
								{
									echo "<option value=\"".$myj."\" selected=\"selected\">".$myj."</option>";
								}
								else
								{
									echo "<option value=\"".$myj."\" >".$myj."</option>";
								}
							}
						echo "</select>";
					echo "</td>";
					echo "			
				</tr>
				
				
				<tr>			
					<td class=\"mytd\" >Lane Width (m)</td>
					";
						echo "<td  class=\"mytd\">";
						echo "<input type=\"text\" class=\"mytextbox3\" name=\"LaneWidth\"  value=\"".$LaneWidth."\" id=\"LaneWidth\" >";
					echo "</td>";
					echo "			
				</tr>
				
				
				<tr>			
					<td class=\"mytd\" >Foot Path Width Left (m)</td>
					";
						echo "<td  class=\"mytd\">";
						echo "<input type=\"text\" class=\"mytextbox3\" value=\"".$FootPathWidthLeft."\" name=\"FootPathWidthLeft\" id=\"FootPathWidthLeft\" >";
					echo "</td>";
					echo "			
				</tr>
				
				<tr>			
					<td class=\"mytd\" >Foot Path Width Right (m)</td>
					";
						echo "<td  class=\"mytd\">";
						echo "<input type=\"text\" class=\"mytextbox3\" value=\"".$FootPathWidthRight."\" name=\"FootPathWidthRight\" id=\"FootPathWidthRight\" >";
					echo "</td>";
					echo "			
				</tr>
				
				
				<tr>			
					<td >&nbsp;</td><td >&nbsp;</td>
				</tr>
				
				
				
				
				<tr>			
					<td class=\"mytd\" >Median Width (m)</td>
					";
						echo "<td  class=\"mytd\">";
						echo "<input type=\"text\" class=\"mytextbox3\" name=\"MedianWidth\"  value=\"".$MedianWidth."\"  id=\"MedianWidth\" >";
					echo "</td>";
					echo "			
				</tr>
				
				<tr>			
					<td class=\"mytd\" >Median Height (m)</td>
					";
						echo "<td  class=\"mytd\">";
						echo "<input type=\"text\" class=\"mytextbox3\" name=\"MedianHeight\"  value=\"".$MedianHeight."\"  id=\"MedianHeight\" >";
					echo "</td>";
					echo "			
				</tr>
				
				<tr>			
					<td >&nbsp;</td><td >&nbsp;</td>
				</tr>
				";
								
				
				echo "
				<tr>			
					<td class=\"mytd\" >Road Approach Vertical Alignment (m)</td>
					";
						echo "<td  class=\"mytd\">";
						echo "<input type=\"text\" class=\"mytextbox3\"  value=\"".$RoadApproachAlignmentVertical."\" name=\"RoadApproachAlignmentVertical\" id=\"RoadApproachAlignmentVertical\" >";
					echo "</td>";
					echo "			
				</tr>
				
				<tr>			
					<td class=\"mytd\" >Road Approach Horizontal Alignment (m)</td>
					";
						echo "<td  class=\"mytd\">";
						echo "<input type=\"text\" class=\"mytextbox3\"   value=\"".$RoadApproachAlignmentHorizontal."\"  name=\"RoadApproachAlignmentHorizontal\" id=\"RoadApproachAlignmentHorizontal\" >";
					echo "</td>";
					echo "			
				</tr>
				
				
				
				
				<tr>			
					<td >&nbsp;</td><td >&nbsp;</td>
				</tr>
				
				<tr>			
					<td class=\"mytd\" >Span Type</td>
					";
						echo "<td  class=\"mytd\">";
						$query_dis	= "select * from bms_spantypes order by SpanType";
						$result_dis		= mysql_query($query_dis) or die (mysql_error());

						echo "<select name=\"spantypes_SpanTypeID\" class=\"mytextbox3\">";
							echo "<option value=\"0\">Unspecified</option>";
							while($row_dis	= mysql_fetch_array($result_dis))
							{
								$SpanTypeID 	= $row_dis['SpanTypeID'];
								$SpanType	= $row_dis['SpanType'];
								echo "<option value=\"".$SpanTypeID."\"";
									if($spantypes_SpanTypeID == $SpanTypeID)
									{
										echo "selected=\"selected\"";
									}
								echo ">".$SpanType."</option>";
							}
						echo "</select>";
					echo "</td>";
					echo "			
				</tr>
				
				
				<tr>			
					<td class=\"mytd\" >Skew Angle (degree) </td>
					";
						echo "<td  class=\"mytd\">";
						echo "<input type=\"text\" class=\"mytextbox3\" value=\"".htmlentities($SkewAngle)."\"  name=\"SkewAngle\" id=\"SkewAngle\" >";
					echo "</td>";
					echo "			
				</tr>
				
				
				
				
				<tr>			
					<td >&nbsp;</td><td >&nbsp;</td>
				</tr>
				
				
				<tr>			
					<td class=\"mytd\" >Approach Safety Barrier Type</td>
					";
						echo "<td  class=\"mytd\">";
						$query_dis	= "select * from bms_barriertypes order by BarrierType";
						$result_dis		= mysql_query($query_dis) or die (mysql_error());

						echo "<select name=\"barriertypes_ASBarrierTypeID\" class=\"mytextbox3\">";
							echo "<option value=\"0\">Unspecified</option>";
							while($row_dis	= mysql_fetch_array($result_dis))
							{
								$BarrierTypeID 	= $row_dis['BarrierTypeID'];
								$BarrierType	= $row_dis['BarrierType'];
								echo "<option value=\"".$BarrierTypeID."\"";
									if($barriertypes_ASBarrierTypeID == $BarrierTypeID)
									{
										echo "selected=\"selected\"";
									}
								echo ">".$BarrierType."</option>";
							}
						echo "</select>";
					echo "</td>";
					echo "			
				</tr>
				
				
				
				
				
				
				<tr>			
					<td class=\"mytd\" >Approach Safety Barrier Location</td>
					";
						echo "<td  class=\"mytd\">";
						$query_dis	= "select * from bms_barrierlocations";
						$result_dis		= mysql_query($query_dis) or die (mysql_error());

						echo "<select name=\"barrierlocations_ASBarrierLocationsID\" class=\"mytextbox3\">";
							echo "<option value=\"0\">Unspecified</option>";
							while($row_dis	= mysql_fetch_array($result_dis))
							{
								$BarrierLocationsID 	= $row_dis['BarrierLocationsID'];
								$BarrierLocations	= $row_dis['BarrierLocations'];
								echo "<option value=\"".$BarrierLocationsID."\"";
									if($barrierlocations_ASBarrierLocationsID == $BarrierLocationsID)
									{	
										echo "selected=\"selected\"";
									}
								echo ">".$BarrierLocations."</option>";
							}
						echo "</select>";
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
						echo "<td  class=\"mytd\">";
						echo "<input type=\"text\" class=\"mytextbox3\"  value=\"".$HeightInvertBridgeUnderside."\" name=\"HeightInvertBridgeUnderside\" id=\"HeightInvertBridgeUnderside\" >";
					echo "</td>";
					echo "			
				</tr>
				
				
				<tr>			
					<td class=\"mytd\"  width=\"285\">Initial Signed Clearance (m)</td>
					";
						echo "<td  class=\"mytd\">";
						echo "<input type=\"text\" class=\"mytextbox3\" value=\"".$InitialSignedClearance."\" name=\"InitialSignedClearance\" id=\"InitialSignedClearance\" >";
					echo "</td>";
					echo "			
				</tr>
				
				
				
				
				<tr>			
					<td class=\"mytd\" >Height from OWL to bridge underside (m)</td>
					";
						echo "<td  class=\"mytd\">";
						echo "<input type=\"text\" class=\"mytextbox3\"  value=\"".$HeightOWLBridgeUnderside."\"  name=\"HeightOWLBridgeUnderside\" id=\"HeightOWLBridgeUnderside\" >";
					echo "</td>";
					echo "			
				</tr>
				
				
				<tr>			
					<td class=\"mytd\" >Highest flood level wrt bridge underside (m)</td>
					";
						echo "<td  class=\"mytd\">";
						echo "<input type=\"text\" class=\"mytextbox3\"  value=\"".$HighestFloodLevelBridgeUnderside."\" name=\"HighestFloodLevelBridgeUnderside\" id=\"HighestFloodLevelBridgeUnderside\" >";
					echo "</td>";
					echo "			
				</tr>
				
				<tr>			
					<td class=\"mytd\" >Highest flood level Date</td>
					";
						echo "<td  class=\"mytd\">";
						echo "<input type=\"text\" class=\"mytextbox3\"    value=\"".$HighestFloodLevelDate."\" name=\"HighestFloodLevelDate\" id=\"HighestFloodLevelDate\" >";
					echo "</td>";
					echo "			
				</tr>
				
				<tr>			
					<td class=\"mytd\" >Normal flood level wrt bridge underside (m)</td>
					";
						echo "<td  class=\"mytd\">";
						echo "<input type=\"text\" class=\"mytextbox3\"    value=\"".$NormalFloodLevelBridgeUnderside."\" name=\"NormalFloodLevelBridgeUnderside\" id=\"NormalFloodLevelBridgeUnderside\" >";
					echo "</td>";
					echo "			
				</tr>
				
				
				<tr>			
					<td class=\"mytd\" >Head Room (m)</td>
					";
						echo "<td  class=\"mytd\">";
						echo "<input type=\"text\" class=\"mytextbox3\"    value=\"".$HeadRoom."\" name=\"HeadRoom\" id=\"HeadRoom\" >";
					echo "</td>";
					echo "			
				</tr>
				
				<tr>			
					<td class=\"mytd\" >Navigable (m)</td>
					";
						echo "<td  class=\"mytd\">";
						echo "<input type=\"text\" class=\"mytextbox3\"    value=\"".$Navigable."\" name=\"Navigable\" id=\"Navigable\" >";
					echo "</td>";
					echo "			
				</tr><table>";
				
				
				
				
				
			
			echo "<p class=\"bodytextbold\" name=\"clearance_wt_ph\" id=\"clearance_wt_ph\"   ><br /><u>Hydraulic Information</u></p>";

			echo "<p class=\"bodytextbold\" name=\"clearance_wt_pss\" id=\"clearance_wt_pss\" ><br /><u>Sounding/ Scour</u></p>";


			echo "<p class=\"bodytextbold\"  name=\"clearance_nonwt_p\" id=\"clearance_nonwt_p\"   ><u>Clearance</u></p>";
			
		
			echo "<table class=\"bodytext\" name=\"clearance_nonwt_tb\" id=\"clearance_nonwt_tb\">";
			
		echo "	
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
						<td class=\"myth\" width=\"115\">Comment</td>
					</tr>";
					
					
					
					for($i=1; $i<=30; $i++)
					{
						echo "<tr name=\"spgroup".$i."\" id=\"spgroup".$i."\">			
							<td class=\"mytd\" width=\"115\">
								Span - ".$i."						
							</td>
							
							
							
							<td class=\"mytd\" width=\"115\">";
								$query_dis	= "select * from bms_spanmaterials order by SpanMaterial";
								$result_dis		= mysql_query($query_dis) or die (mysql_error());
								echo "<select name=\"spanmaterials_SpanMaterialID_spgroup_".$i."\" class=\"mytextbox2\">";
									while($row_dis	= mysql_fetch_array($result_dis))
									{
									
										$SpanMaterialID 	= $row_dis['SpanMaterialID'];
										$SpanMaterial	= $row_dis['SpanMaterial'];
										if($spanmaterials_SpanMaterialID_spgrou[$i] == $SpanMaterialID)
										{
											echo "<option value=\"".$SpanMaterialID."\" selected=\"selected\">".$SpanMaterial."</option>";
										}
										else
										{
											echo "<option value=\"".$SpanMaterialID."\" >".$SpanMaterial."</option>";
										}
									}
								echo "</select>";
							echo "</td>
							
							
							<td class=\"mytd\" width=\"115\">";
							
								echo "
								<input type=\"text\" class=\"mytextbox1\"  value=\"".$spantypes_SpanTypeID_spgroup[$i]."\" name=\"spantypes_SpanTypeID_spgroup_".$i."\" id=\"spantypes_SpanTypeID_spgroup_".$i."\" >
							</td>						
							
							<td class=\"mytd\" width=\"115\">";
								echo "<input type=\"text\" class=\"mytextbox1\"  value=\"".$SpanLength_spgroup[$i]."\" name=\"SpanLength_spgroup_".$i."\" id=\"SpanLength_spgroup_".$i."\" >				
							</td>
							
							
							<td class=\"mytd\" width=\"115\">";								
								echo "<select name=\"YearOfConstruction_spgroup_".$i."\" class=\"mytextbox1\">";
									$thisyear = date(Y);
									for($myi=2000; $myi <=$thisyear; $myi++)
									{							
										if($YearOfConstruction_spgroup[$i] == $myi)
										{
											echo "<option value=\"".$myi."\" selected=\"selected\">".$myi."</option>";
										}
										else
										{
											echo "<option value=\"".$myi."\" >".$myi."</option>";
										}
									}
								echo "</select>";							
							echo "</td>		





							<td class=\"mytd\" width=\"115\">";								
								echo "<select name=\"comment_spgroup_".$i."\" class=\"mytextbox1\">";
									echo "<option value=\"o\" ";
									if($comment_spgroup[$i] == "o")
										echo " selected=\"selected\" ";
									echo " >Original</option>";
									
									
									
									echo "<option value=\"w\"  ";
									if($comment_spgroup[$i] == "w")
										echo " selected=\"selected\" ";
									echo " >Widened</option>";
								echo "</select>";							
							echo "</td>	



							
						</tr>";
					}				
			echo "</table>";
			
			
			
			
			echo "<p class=\"bodytextbold\"><br /><u>Decks</u></p>";
			
				echo "<table class=\"bodytext\">
					<tr>			
						<td class=\"myth\" width=\"115\">Deck</td>					
						<td class=\"myth\" width=\"200\">Material</td>
						<td class=\"myth\" width=\"200\">Surface Type</td>
						<td class=\"myth\" width=\"115\">Thickness (mm)</td>
						<td class=\"myth\" width=\"115\">Year of Constructed</td>
						<td class=\"myth\" width=\"115\">Comment</td>
					</tr>";
					
					
					
					for($i=1; $i<=30; $i++)
					{
						echo "<tr name=\"deck".$i."\" id=\"deck".$i."\">			
							<td class=\"mytd\" width=\"115\">
								Deck - ".$i."						
							</td>
							
							
							
							<td class=\"mytd\" width=\"115\">";
								$query_dis	= "select * from bms_deckmaterials order by DeckMaterial";
								$result_dis		= mysql_query($query_dis) or die (mysql_error());
								echo "<select name=\"deckmaterials_DeckMaterialID_deck_".$i."\" class=\"mytextbox2\">";
									while($row_dis	= mysql_fetch_array($result_dis))
									{
									
										$DeckMaterialID 	= $row_dis['DeckMaterialID'];
										$DeckMaterial	= $row_dis['DeckMaterial'];
										if($deckmaterials_DeckMaterialID_deck[$i] == $DeckMaterialID)
										{
											echo "<option value=\"".$DeckMaterialID."\" selected=\"selected\">".$DeckMaterial."</option>";
										}
										else
										{
											echo "<option value=\"".$DeckMaterialID."\" >".$DeckMaterial."</option>";
										}
									}
								echo "</select>";
							echo "</td>
							
							
							<td class=\"mytd\" width=\"115\">";
								$query_dis	= "select * from bms_desksurfacetypes order by DeskSurfaceType";
								$result_dis		= mysql_query($query_dis) or die (mysql_error());
								echo "<select name=\"desksurfacetypes_DeskSurfaceTypeID_deck_".$i."\" class=\"mytextbox2\">";
									while($row_dis	= mysql_fetch_array($result_dis))
									{
									
										$DeskSurfaceTypeID 	= $row_dis['DeskSurfaceTypeID'];
										$DeskSurfaceType 	= $row_dis['DeskSurfaceType'];
										if($desksurfacetypes_DeskSurfaceTypeID_deck[$i] == $DeskSurfaceTypeID)
										{
											echo "<option value=\"".$DeskSurfaceTypeID."\" selected=\"selected\">".$DeskSurfaceType."</option>";
										}
										else
										{
											echo "<option value=\"".$DeskSurfaceTypeID."\" >".$DeskSurfaceType."</option>";
										}
									}
								echo "</select>";
							echo "</td>						
							
							
							<td class=\"mytd\" width=\"115\">";
								echo "<input type=\"text\" class=\"mytextbox1\"  value=\"".$DeckSurfaceThickness_deck[$i]."\"  name=\"DeckSurfaceThickness_deck_".$i."\" id=\"DeckSurfaceThickness_deck_".$i."\" >				
							</td>
							
							<td class=\"mytd\" width=\"115\">";
								
								echo "<select name=\"YearOfConstruction_deck_".$i."\" class=\"mytextbox1\">";
									$thisyear = date(Y);
									for($myi=2000; $myi <=$thisyear; $myi++)
									{							
										if($YearOfConstruction_deck[$i] == $myi)
										{
											echo "<option value=\"".$myi."\" selected=\"selected\">".$myi."</option>";
										}
										else
										{
											echo "<option value=\"".$myi."\" >".$myi."</option>";
										}
									}
								echo "</select>";							
							echo "</td>	
							
							<td class=\"mytd\" width=\"115\">";								
								echo "<select name=\"comment_deck_".$i."\" class=\"mytextbox1\">";
									echo "<option value=\"o\" ";
									if($comment_deck[$i] == "o")
										echo " selected=\"selected\" ";
									echo " >Original</option>";
									
									
									
									echo "<option value=\"w\"  ";
									if($comment_deck[$i] == "w")
										echo " selected=\"selected\" ";
									echo " >Widened</option>";
								echo "</select>";							
							echo "</td>								
						</tr>";
					}				
			echo "</table>";
			
			
			
			
			
			
			
			echo "<p class=\"bodytextbold\"><br /><u>Barrier</u></p>";		
		
			echo "<table class=\"bodytext\">
				<tr>			
					<td class=\"mytd\" >Type</td>";
					echo "<td  class=\"mytd\">";					
						$query_dis	= "select * from bms_barriertypes order by BarrierType";
						$result_dis		= mysql_query($query_dis) or die (mysql_error());
						echo "<select name=\"SuperStructure_barriertypes\" class=\"mytextbox2\">";
							while($row_dis	= mysql_fetch_array($result_dis))
							{
							
								$BarrierTypeID 	= $row_dis['BarrierTypeID'];
								$BarrierType 	= $row_dis['BarrierType'];
								if($SuperStructure_barriertypes == $BarrierTypeID)
								{
									echo "<option value=\"".$BarrierTypeID."\" selected=\"selected\">".$BarrierType."</option>";
								}
								else
								{
									echo "<option value=\"".$BarrierTypeID."\" >".$BarrierType."</option>";
								}
							}
						echo "</select>";
					echo "</td>";
					echo "			
				</tr>
				
				
				<tr>			
					<td class=\"mytd\" >Number</td>
					";
						echo "<td  class=\"mytd\">";
							echo "<select name=\"SuperStructure_BarrierNumber\" class=\"mytextbox2\">";
								for($myj=0; $myj<=5; $myj++)
								{							
									if($SuperStructure_BarrierNumber	 == $myj)
									{
										echo "<option value=\"".$myj."\" selected=\"selected\">".$myj."</option>";
									}
									else
									{
										echo "<option value=\"".$myj."\" >".$myj."</option>";
									}
								}
							echo "</select>";
					echo "</td>";
					echo "			
				</tr>
				
				<tr>			
					<td class=\"mytd\" width=\"285\">Barrier Width (m)</td>";
					echo "<td  class=\"mytd\">";					
						
						echo "<input type=\"text\" value=\"".$BarrierWidth."\" class=\"mytextbox3\" name=\"SuperStructure_barrierwidth\" id=\"ExpansionJointsType\" >";	
					echo "</td>";
					echo "			
				</tr>
				<tr>			
					<td class=\"mytd\" width=\"285\">Barrier Height (m)</td>";
					echo "<td  class=\"mytd\">";					
						
						echo "<input type=\"text\"  value=\"".$BarrierHeight."\" class=\"mytextbox3\" name=\"SuperStructure_barrierheight\" id=\"ExpansionJointsType\" >";	
					echo "</td>";
					echo "			
				</tr>";
				
			echo "</table>";		
			
			
			
			
			
			
			
			
			echo "<p class=\"bodytextbold\"><br /><u>Up Rights/Hand Rails or Parapet</u></p>";
			
				echo "<table class=\"bodytext\">
					<tr>			
						<td class=\"myth\" width=\"115\">Location</td>					
						<td class=\"myth\" width=\"115\">Type</td>
						<td class=\"myth\" width=\"115\">Length</td>
					</tr>";
					

						echo "<tr>			
							<td class=\"mytd\" width=\"115\">
								Left						
							</td>
							
							
							
							<td class=\"mytd\" width=\"115\">";
								$query_dis	= "select * from bms_parapettypes";
								$result_dis		= mysql_query($query_dis) or die (mysql_error());
								echo "<select name=\"parapet_left_type\" class=\"mytextbox2\">";
									while($row_dis	= mysql_fetch_array($result_dis))
									{
									
										$ParapetTypeID 	= $row_dis['ParapetTypeID'];
										$ParapetType	= $row_dis['ParapetType'];
										if($ParapetLeftParapetTypeID == $ParapetTypeID)
										{
											echo "<option value=\"".$ParapetTypeID."\" selected=\"selected\">".$ParapetType."</option>";
										}
										else
										{
											echo "<option value=\"".$ParapetTypeID."\" >".$ParapetType."</option>";
										}
									}
								echo "</select>";
							echo "</td>
							
							
							
							<td class=\"mytd\" width=\"115\">";
								echo "<input type=\"text\" value=\"".$ParapetLeftLenth."\"  class=\"mytextbox1\" name=\"parapet_left_lenth\"  >				
							</td>							
						</tr>";
						
						
						
						
						echo "<tr>			
							<td class=\"mytd\" width=\"115\">
								Right						
							</td>
							
							
							
							<td class=\"mytd\" width=\"115\">";
								$query_dis	= "select * from bms_parapettypes";
								$result_dis		= mysql_query($query_dis) or die (mysql_error());
								echo "<select name=\"parapet_right_type\" class=\"mytextbox2\">";
									while($row_dis	= mysql_fetch_array($result_dis))
									{
									
										$ParapetTypeID 	= $row_dis['ParapetTypeID'];
										$ParapetType	= $row_dis['ParapetType'];
										if($ParapetRIghtParapetTypeID == $ParapetTypeID)
										{
											echo "<option value=\"".$ParapetTypeID."\" selected=\"selected\">".$ParapetType."</option>";
										}
										else
										{
											echo "<option value=\"".$ParapetTypeID."\" >".$ParapetType."</option>";
										}
									}
								echo "</select>";
							echo "</td>
							
							
							
							<td class=\"mytd\" width=\"115\">";
								echo "<input type=\"text\"  value=\"".$ParapetRIghtLenth."\"  class=\"mytextbox1\" name=\"parapet_right_lenth\"  >				
							</td>							
						</tr>";
						
									
			echo "</table>";
			
			
			
			echo "<p class=\"bodytextbold\"><br /><u>Expansion Joints</u></p>";		
		
			echo "<table class=\"bodytext\">
				<tr>			
					<td class=\"mytd\" width=\"285\">Type</td>";
					echo "<td  class=\"mytd\">";					
						
						echo "<input type=\"text\" class=\"mytextbox3\"  value=\"".$ExpansionJointsType."\"  name=\"ExpansionJointsType\" id=\"ExpansionJointsType\" >";	
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
						<td class=\"myth\" width=\"115\">Material</td>
						<td class=\"myth\" width=\"115\">Type</td>
						<td class=\"myth\" width=\"115\">Thickness at Capping Level (m)</td>
					</tr>";
					
					
					
					for($i=1; $i<=30; $i++)
					{
						echo "<tr name=\"sub_pier_".$i."\" id=\"sub_pier_".$i."\">			
							<td class=\"mytd\" width=\"115\">
								Pier - ".$i."						
							</td>
							
							
							
							<td class=\"mytd\" width=\"115\">";
								$query_dis	= "select * from bms_piermaterials order by PierMaterial";
								$result_dis		= mysql_query($query_dis) or die (mysql_error());
								echo "<select name=\"piermaterials_PierMaterialID_sub_pier_".$i."\" class=\"mytextbox3\">";
									while($row_dis	= mysql_fetch_array($result_dis))
									{
									
										$PierMaterialID 	= $row_dis['PierMaterialID'];
										$PierMaterial	= $row_dis['PierMaterial'];
										if($piermaterials_PierMaterialID_sub_pier[$i] == $PierMaterialID)
										{
											echo "<option value=\"".$PierMaterialID."\" selected=\"selected\">".$PierMaterial."</option>";
										}
										else
										{
											echo "<option value=\"".$PierMaterialID."\" >".$PierMaterial."</option>";
										}
									}
								echo "</select>";
							echo "</td>
							
							
							<td class=\"mytd\" width=\"115\">";
								$query_dis	= "select * from bms_piertypes order by PierType";
								$result_dis		= mysql_query($query_dis) or die (mysql_error());
								echo "<select name=\"piertypes_PierTypeID_sub_pier_".$i."\" class=\"mytextbox3\">";
									while($row_dis	= mysql_fetch_array($result_dis))
									{
									
										$PierTypeID 	= $row_dis['PierTypeID'];
										$PierType 	= $row_dis['PierType'];
										if($piertypes_PierTypeID_sub_pier[$i] == $PierTypeID)
										{
											echo "<option value=\"".$PierTypeID."\" selected=\"selected\">".$PierType."</option>";
										}
										else
										{
											echo "<option value=\"".$PierTypeID."\" >".$PierType."</option>";
										}
									}
								echo "</select>";
							echo "</td>		
							
							<td class=\"mytd\" width=\"115\">";
								echo "<input type=\"text\" value=\"".$ThicknessCappingLevel[$i]."\" class=\"mytextbox1\" name=\"ThicknessCappingLevel_".$i."\" id=\"ThicknessCappingLevel_".$i."\" >				
							</td>

							
						</tr>";
					}				
			echo "</table>";
			
					
			echo "<p class=\"bodytextbold\"><br /><u>Wing Walls</u></p>";
			
				echo "<table class=\"bodytext\">
					<tr>			
						<td class=\"myth\" width=\"115\">Wing Wall</td>					
						<td class=\"myth\" width=\"115\">Material</td>
						<td class=\"myth\" width=\"115\">Type</td>
						<td class=\"myth\" width=\"115\">Lenth (m)</td>
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
								echo "<select name=\"wingmaterials_WingMaterialID_sub_ww_".$i."\" class=\"mytextbox3\">";
									while($row_dis	= mysql_fetch_array($result_dis))
									{
									
										$WingMaterialID 	= $row_dis['WingMaterialID'];
										$WingMaterial	= $row_dis['WingMaterial'];
										if($wingmaterials_WingMaterialID_sub_ww[$i] == $WingMaterialID)
										{
											echo "<option value=\"".$WingMaterialID."\" selected=\"selected\">".$WingMaterial."</option>";
										}
										else
										{
											echo "<option value=\"".$WingMaterialID."\" >".$WingMaterial."</option>";
										}
									}
								echo "</select>";
							echo "</td>
							
							
							<td class=\"mytd\" width=\"115\">";
								$query_dis	= "select * from bms_wingtypes order by WingType";
								$result_dis		= mysql_query($query_dis) or die (mysql_error());
								echo "<select name=\"wingtypes_WingTypeID_sub_ww_".$i."\" class=\"mytextbox3\">";
									while($row_dis	= mysql_fetch_array($result_dis))
									{
									
										$WingTypeID 	= $row_dis['WingTypeID'];
										$WingType 	= $row_dis['WingType'];
										if($wingtypes_WingTypeID_sub_ww[$i] == $WingTypeID)
										{
											echo "<option value=\"".$WingTypeID."\" selected=\"selected\">".$WingType."</option>";
										}
										else
										{
											echo "<option value=\"".$WingTypeID."\" >".$WingType."</option>";
										}
									}
								echo "</select>";
							echo "</td>				
							

							<td class=\"mytd\" width=\"115\">";
								echo "<input type=\"text\" value=\"".$WingWallLenth[$i]."\" class=\"mytextbox1\" name=\"WingWallLenth_".$i."\" id=\"WingWallLenth_".$i."\" >				
							</td>							
						</tr>";
					}				
			echo "</table>";		
					
					
			echo "<p class=\"bodytextbold\"><br /><u>Abutments</u></p>";
			
				echo "<table class=\"bodytext\">
					<tr>			
						<td class=\"myth\" width=\"115\">Abutment</td>					
						<td class=\"myth\" width=\"115\">Material</td>
						<td class=\"myth\" width=\"115\">Type</td>
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
								echo "<select name=\"abutmentmaterials_AbutmentMaterialID_sub_abunt_".$i."\" class=\"mytextbox3\">";
									while($row_dis	= mysql_fetch_array($result_dis))
									{
									
										$AbutmentMaterialID 	= $row_dis['AbutmentMaterialID'];
										$AbutmentMaterial	= $row_dis['AbutmentMaterial'];
										if($abutmentmaterials_AbutmentMaterialID_sub_abunt[$i] == $AbutmentMaterialID)
										{
											echo "<option value=\"".$AbutmentMaterialID."\" selected=\"selected\">".$AbutmentMaterial."</option>";
										}
										else
										{
											echo "<option value=\"".$AbutmentMaterialID."\" >".$AbutmentMaterial."</option>";
										}
									}
								echo "</select>";
							echo "</td>
							
							
							<td class=\"mytd\" width=\"115\">";
								$query_dis	= "select * from bms_abutmenttypes order by AbutmentType";
								$result_dis		= mysql_query($query_dis) or die (mysql_error());
								echo "<select name=\"abutmenttypes_SpanTypeID_sub_abunt_".$i."\" class=\"mytextbox3\">";
									while($row_dis	= mysql_fetch_array($result_dis))
									{
									
										$AbutmentTypeID 	= $row_dis['AbutmentTypeID'];
										$AbutmentType 	= $row_dis['AbutmentType'];
										if($abutmenttypes_SpanTypeID_sub_abunt[$i] == $AbutmentTypeID)
										{
											echo "<option value=\"".$AbutmentTypeID."\" selected=\"selected\">".$AbutmentType."</option>";
										}
										else
										{
											echo "<option value=\"".$AbutmentTypeID."\" >".$AbutmentType."</option>";
										}
									}
								echo "</select>";
							echo "</td>				
											
						</tr>";
					}				
			echo "</table>";		
					
				
					
			echo "<p class=\"bodytextbold\"><br /><u>Bearings</u></p>";		
					
					
					
			echo "<table>			
			<tr>			
					<td class=\"mytd\" width=\"115\">Type</td>
					";
						echo "<td  class=\"mytd\">";
						$query_dis	= "select * from bms_bearingtypes order by BearingType";
						$result_dis		= mysql_query($query_dis) or die (mysql_error());

						echo "<select name=\"bearingtypes_BearingTypeID\" class=\"mytextbox3\">";
							while($row_dis	= mysql_fetch_array($result_dis))
							{
							
								$BearingTypeID 	= $row_dis['BearingTypeID'];
								$BearingType	= $row_dis['BearingType'];
								if($bearingtypes_BearingTypeID == $BearingTypeID)
								{
									echo "<option value=\"".$BearingTypeID."\" selected=\"selected\">".$BearingType."</option>";
								}
								else
								{
									echo "<option value=\"".$BearingTypeID."\" >".$BearingType."</option>";
								}
							}
						echo "</select>";
					echo "</td>";
					echo "			
				</tr>
				
				<tr>			
					<td class=\"mytd\" width=\"115\">Material</td>
					";
						echo "<td  class=\"mytd\">";
						$query_dis	= "select * from bms_bearingmaterials order by BearingMaterial";
						$result_dis		= mysql_query($query_dis) or die (mysql_error());

						echo "<select name=\"bearingtypes_BearingMaterialID\" class=\"mytextbox3\">";
							while($row_dis	= mysql_fetch_array($result_dis))
							{
							
								$BearingMaterialID 	= $row_dis['BearingMaterialID'];
								$BearingMaterial	= $row_dis['BearingMaterial'];
								if($bearingtypes_BearingMaterialID == $BearingMaterialID)
								{
									echo "<option value=\"".$BearingMaterialID."\" selected=\"selected\">".$BearingMaterial."</option>";
								}
								else
								{
									echo "<option value=\"".$BearingMaterialID."\" >".$BearingMaterial."</option>";
								}
							}
						echo "</select>";
					echo "</td>";
					echo "			
				</tr>				
			</table>";		
					
					
					
					
					
			echo "<p class=\"bodytextbold\"><br /><u>Foundations</u></p>";
			
				echo "<table class=\"bodytext\">
					<tr>			
						<td class=\"myth\" width=\"115\">Foundation</td>					
						<td class=\"myth\" width=\"115\">Material</td>
						<td class=\"myth\" width=\"115\">Type</td>
						<td class=\"myth\" width=\"115\">Comments</td>
					</tr>";
					
					
					
					
					
					
					for($i=1; $i<=30; $i++)
					{
						echo "<tr name=\"foun_pier_".$i."\" id=\"foun_pier_".$i."\">			
							<td class=\"mytd\" width=\"115\">
								Pier - ".$i."						
							</td>
							
							
							
							<td class=\"mytd\" width=\"115\">";
								
										
								$query_dis	= "select * from bms_pierfoundationmaterials order by PierFoundationMaterial ";
								$result_dis		= mysql_query($query_dis) or die (mysql_error());
								echo "<select name=\"piermaterials_PierMaterialID_foun_pier_".$i."\" class=\"mytextbox3\">";
									while($row_dis	= mysql_fetch_array($result_dis))
									{
									
										$PierMaterialID 	= $row_dis['PierFoundationMaterialID'];
										$PierMaterial	= $row_dis['PierFoundationMaterial'];		
										
										
										
										
										if($piermaterials_PierMaterialID_foun_pier[$i] == $PierMaterialID)
										{
											echo "<option value=\"".$PierMaterialID."\" selected=\"selected\">".$PierMaterial."</option>";
										}
										else
										{
											echo "<option value=\"".$PierMaterialID."\" >".$PierMaterial."</option>";
										}
									}
								echo "</select>";
							echo "</td>
							
							
							<td class=\"mytd\" width=\"115\">";
								$query_dis	= "select * from bms_pierfoundationtypes order by PierFoundationType";
								$result_dis		= mysql_query($query_dis) or die (mysql_error());
								echo "<select name=\"piertypes_PierTypeID_foun_pier_".$i."\" class=\"mytextbox3\">";
									while($row_dis	= mysql_fetch_array($result_dis))
									{
									
										$PierTypeID 	= $row_dis['PierFoundationTypeID'];
										$PierType 	= $row_dis['PierFoundationType'];
										if($piertypes_PierTypeID_foun_pier[$i] == $PierTypeID)
										{
											echo "<option value=\"".$PierTypeID."\" selected=\"selected\">".$PierType."</option>";
										}
										else
										{
											echo "<option value=\"".$PierTypeID."\" >".$PierType."</option>";
										}
									}
								echo "</select>";
							echo "</td>				
							<td class=\"mytd\" width=\"115\">
								<input type=\"text\" class=\"mytextbox2\" name=\"pierComments_foun_pier_".$i."\" id=\"pierComments_foun_pier_".$i."\" value=\"".$pierComments_foun_pier[$i]."\" />					
							</td>				
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
								$query_dis	= "select * from bms_abutmentfoundationmaterials order by AbutmentFoundationMaterial";
								$result_dis		= mysql_query($query_dis) or die (mysql_error());
								echo "<select name=\"abutmentmaterials_AbutmentMaterialID_foun_abunt".$i."\" class=\"mytextbox3\">";
									while($row_dis	= mysql_fetch_array($result_dis))
									{
									
										$AbutmentFoundationMaterialID 	= $row_dis['AbutmentFoundationMaterialID'];
										$AbutmentFoundationMaterial	= $row_dis['AbutmentFoundationMaterial'];
										if($abutmentmaterials_AbutmentMaterialID_foun_abunt[$i] == $AbutmentFoundationMaterialID)
										{
											echo "<option value=\"".$AbutmentFoundationMaterialID."\" selected=\"selected\">".$AbutmentFoundationMaterial."</option>";
										}
										else
										{
											echo "<option value=\"".$AbutmentFoundationMaterialID."\" >".$AbutmentFoundationMaterial."</option>";
										}
									}
								echo "</select>";
							echo "</td>
							
							
							<td class=\"mytd\" width=\"115\">";
								$query_dis	= "select * from bms_abutmentfoundationtypes order by AbutmentFoundationType";
								$result_dis		= mysql_query($query_dis) or die (mysql_error());
								echo "<select name=\"abutmenttypes_SpanTypeID_foun_abunt".$i."\" class=\"mytextbox3\">";
									while($row_dis	= mysql_fetch_array($result_dis))
									{
									
										$AbutmentFoundationTypeID 	= $row_dis['AbutmentFoundationTypeID'];
										$AbutmentFoundationType 	= $row_dis['AbutmentFoundationType'];
										if($abutmenttypes_SpanTypeID_foun_abunt[$i] == $AbutmentFoundationTypeID)
										{
											echo "<option value=\"".$AbutmentFoundationTypeID."\" selected=\"selected\">".$AbutmentFoundationType."</option>";
										}
										else
										{
											echo "<option value=\"".$AbutmentFoundationTypeID."\" >".$AbutmentFoundationType."</option>";
										}
									}
								echo "</select>";
							echo "</td>				
							<td class=\"mytd\" width=\"115\">
								<input type=\"text\" class=\"mytextbox2\" name=\"abutmentComments_foun_abunt".$i."\" id=\"abutmentComments_foun_abunt".$i."\" value=\"".$abutmentComments_foun_abunt[$i]."\" />					
							</td>				
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
								echo "<select name=\"wingmaterials_WingMaterialID_foun_ww".$i."\" class=\"mytextbox3\">";
									while($row_dis	= mysql_fetch_array($result_dis))
									{
									
										$WingFoundationMaterialID 	= $row_dis['WingFoundationMaterialID'];
										$WingFoundationMaterial	= $row_dis['WingFoundationMaterial'];
										if($wingmaterials_WingMaterialID_foun_ww[$i] == $WingFoundationMaterialID)
										{
											echo "<option value=\"".$WingFoundationMaterialID."\" selected=\"selected\">".$WingFoundationMaterial."</option>";
										}
										else
										{
											echo "<option value=\"".$WingFoundationMaterialID."\" >".$WingFoundationMaterial."</option>";
										}
									}
								echo "</select>";
							echo "</td>
							
							
							<td class=\"mytd\" width=\"115\">";
								$query_dis	= "select * from bms_wingfoundationtypes order by WingFoundationType";
								$result_dis		= mysql_query($query_dis) or die (mysql_error());
								echo "<select name=\"wingtypes_WingTypeID_foun_ww".$i."\" class=\"mytextbox3\">";
									while($row_dis	= mysql_fetch_array($result_dis))
									{
									
										$WingFoundationTypeID 	= $row_dis['WingFoundationTypeID'];
										$WingFoundationType 	= $row_dis['WingFoundationType'];
										if($wingtypes_WingTypeID_foun_ww[$i] == $WingFoundationTypeID)
										{
											echo "<option value=\"".$WingFoundationTypeID."\" selected=\"selected\">".$WingFoundationType."</option>";
										}
										else
										{
											echo "<option value=\"".$WingFoundationTypeID."\" >".$WingFoundationType."</option>";
										}
									}
								echo "</select>";
							echo "</td>				
							<td class=\"mytd\" width=\"115\">
								<input type=\"text\" class=\"mytextbox2\" name=\"wingComments_foun_ww".$i."\" id=\"wingComments_foun_ww".$i."\" value=\"".$wingComments_foun_ww[$i]."\" />					
							</td>				
						</tr>";
					}				
			echo "</table>";	
		
		?>
		</div>
		
			
		<div id="fragment-7">
		<?php		
			echo "<p class=\"bodytextbold\"><u>Structure Environment</u></p>";
			
				echo "<table class=\"bodytext\">
			
				<tr>			
					<td class=\"mytd\" width=\"285\">Climate Zone</td>
					";
						echo "<td  class=\"mytd\">";
						$query_dis	= "select * from bms_climatezones";
						$result_dis		= mysql_query($query_dis) or die (mysql_error());

						echo "<select name=\"climatezones_ClimateZoneID\" class=\"mytextbox3\">";
							while($row_dis	= mysql_fetch_array($result_dis))
							{
							
								$ClimateZoneID 	= $row_dis['ClimateZoneID'];
								$ClimateZone	= $row_dis['ClimateZone'];
								if($climatezones_ClimateZoneID == $ClimateZoneID)
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
					echo "			
				</tr>
				";
				
				echo "	
				
				<tr>			
					<td class=\"mytd\" width=\"285\">Exposure Class</td>
					";
						echo "<td  class=\"mytd\">";
						$query_dis	= "select * from bms_exposureclasses order by ExposureClassID DESC";
						$result_dis		= mysql_query($query_dis) or die (mysql_error());

						echo "<select name=\"exposureclasses_ExposureClassID\" class=\"mytextbox3\">";
							while($row_dis	= mysql_fetch_array($result_dis))
							{
							
								$ExposureClass 	= $row_dis['ExposureClass'];
								$ExposureClassID	= $row_dis['ExposureClassID'];
								if($exposureclasses_ExposureClassID == $ExposureClassID)
								{
									echo "<option value=\"".$ExposureClassID."\" selected=\"selected\">".$ExposureClass."</option>";
								}
								else
								{
									echo "<option value=\"".$ExposureClassID."\" >".$ExposureClass."</option>";
								}
							}
						echo "</select>";
					echo "</td>";
					echo "			
				</tr>
					
				
				<tr>			
					<td class=\"mytd\" >Protective Coatings</td>
					";
						echo "<td  class=\"mytd\">";
						echo "<input type=\"text\" class=\"mytextbox3\" name=\"ProtectiveCoatings\"  value=\"".$ProtectiveCoatings."\" id=\"ProtectiveCoatings\" >";
					echo "</td>";
					echo "			
				</tr>
				
				
				<tr>			
					<td class=\"mytd\" >Contamination</td>
					";
						echo "<td  class=\"mytd\">";
						echo "<input type=\"text\" class=\"mytextbox3\"  value=\"".$Contamination."\"  name=\"Contamination\" id=\"Contamination\" >";
					echo "</td>";
					echo "			
				</tr>
				
				
				<tr>			
					<td class=\"mytd\" >Comments</td>
					";
						echo "<td  class=\"mytd\">";
						echo "<textarea type=\"text\" class=\"mytextbox3\" name=\"Comments\" id=\"Comments\" rows=\"5\">".$Comments."</textarea>";
					
						
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
						
						echo "<td  colspan=\"2\" class=\"myth\">";
							echo "File (.DWG)";	
						echo "</td>";
				echo "</tr>";
				

				$_SESSION['filepathx'] = array();
				$_SESSION['fileidx'] = array();				
				$myfilepathi = 0;
				
				
				
				
				for($i=1; $i <= 5; $i++)
				{
					
					$myfilepathi++;
					
					
					
					
					echo "<tr>			
						<td class=\"mytd\" width=\"185\">";
							echo "Cad Design  - ". $i;
						echo "</td>";
						
						
						echo "<td  class=\"mytd\">";
							$x	= '';
							$x	= "CadDesign".$i."Dis";
							echo "<input type=\"text\" value=\"".$$x."\" class=\"mytextbox3\" name=\"CadDesign".$i."Dis\" id=\"CadDesign".$i."Dis\" >";
						echo "</td>";
						
						echo "<td  class=\"mytd\"  align=\"center\"  width=\"185\">";							
							
							$x	= '';
							$x	= "CadDesign".$i."Name";

							$query_check = "select CadDesign".$i."Name  from bms_bridgeprofileattachments where bridgeprofile_BridgeProfileID = '".$BridgeProfileID."' ";
							$result_check =  mysql_query($query_check) or die (mysql_error());
							while($row_check	= mysql_fetch_array($result_check)){
								$name = $row_check['CadDesign'.$i.'Name'];
							}
							
							
							$_SESSION['filepathx'][$myfilepathi]	= $datadir."dwg/";
							$_SESSION['fileidx'][$myfilepathi]	= $BridgeProfileID."-".$i.".dwg";
							
							
							if($name == ""){
								echo "--";
							}else{
							
							
								echo "<a href=\"../download.php?id=".$myfilepathi."\" target=\"_blank\">".$$x."</a>";
							}
							
							
							
						echo "</td>";
						
						echo "<td  class=\"mytd\">";
							echo "<input type=\"file\" class=\"mytextbox3\" name=\"CadDesign".$i."Name\" id=\"CadDesign".$i."Name\" >";
						echo "</td>";
					echo "</tr>";
				
				}
				echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
				////////////////////////////////////////////////////
				////////////////////////////////////////////////////

				echo "<tr>			
						<td class=\"myth\" width=\"185\">";
							echo "Category";
						echo "</td>";
						
						echo "<td  class=\"myth\">";
							echo "Description";	
						echo "</td>";
						
						echo "<td  colspan=\"2\" class=\"myth\">";
							echo "File (.PDF)";	
						echo "</td>";
				echo "</tr>";
				for($i=1; $i <= 10; $i++)
				{
					$myfilepathi++;
					echo "<tr>			
						<td class=\"mytd\" width=\"185\">";
							echo "Drawing  - ". $i;
						echo "</td>";
						
						
						echo "<td  class=\"mytd\">";
							echo "<input type=\"text\" class=\"mytextbox3\" name=\"Drawing".$i."Dis\" id=\"Drawing".$i."Dis\" >";
						echo "</td>";
						
						
						echo "<td  class=\"mytd\"  align=\"center\">";
	
							$x	= '';
							$x	= "Drawing".$i."Name";
							$query_check = "select Drawing".$i."Name  from bms_bridgeprofileattachments where bridgeprofile_BridgeProfileID = '".$BridgeProfileID."' ";
							$result_check =  mysql_query($query_check) or die (mysql_error());
							while($row_check	= mysql_fetch_array($result_check)){
								$name = $row_check['Drawing'.$i.'Name'];
							}
							
							
							$_SESSION['filepathx'][$myfilepathi]	= $datadir."pdf/";
							$_SESSION['fileidx'][$myfilepathi]	= $BridgeProfileID."-".$i.".pdf";
							if($name == ""){
								echo "--";
							}else{
								echo "<a href=\"../download.php?id=".$myfilepathi."\" target=\"_blank\">".$$x."</a>";
							}
						echo "</td>";
						
						
						echo "<td  class=\"mytd\">";
							echo "<input type=\"file\" class=\"mytextbox3\" name=\"Drawing".$i."Name\" id=\"Drawing".$i."Name\" >";
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
						
						echo "<td  colspan=\"2\" class=\"myth\">";
							echo "File (.JPG)";	
						echo "</td>";
				echo "</tr>";
				for($i=1; $i <= 5; $i++)
				{
					$myfilepathi++;
					echo "<tr>			
						<td class=\"mytd\" width=\"185\">";
							echo "Image  - ". $i;
						echo "</td>";
						
						
						echo "<td  class=\"mytd\">";
							echo "<input type=\"text\" class=\"mytextbox3\" name=\"Image".$i."Dis\" id=\"Image".$i."Dis\" >";
						echo "</td>";
						
						
						echo "<td  class=\"mytd\" align=\"center\">";
							$x	= '';
							$x	= "Image".$i."Name";
							$query_check = "select Image".$i."Name  from bms_bridgeprofileattachments where bridgeprofile_BridgeProfileID = '".$BridgeProfileID."' ";
							$result_check =  mysql_query($query_check) or die (mysql_error());
							while($row_check	= mysql_fetch_array($result_check)){
								$name = $row_check['Image'.$i.'Name'];
							}
							
							
							$_SESSION['filepathx'][$myfilepathi]	= $datadir."jpg/";
							$_SESSION['fileidx'][$myfilepathi]	= $BridgeProfileID."-".$i.".jpg";
							
							if($name == ""){
								echo "--";
							}else{
								echo "<a href=\"../download.php?id=".$myfilepathi."\" target=\"_blank\">".$$x."</a>";
							}
						echo "</td>";
						
						echo "<td  class=\"mytd\">";
							echo "<input type=\"file\" class=\"mytextbox3\" name=\"Image".$i."Name\" id=\"Image".$i."Name\" >";
						echo "</td>";
					echo "</tr>";
				
				}
				////////////////////////////////////////////////////
				////////////////////////////////////////////////////
				

				echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";			
			
								////////////////////////////////////////////////////
				////////////////////////////////////////////////////
				echo "<tr>			
						<td class=\"myth\" width=\"185\">";
							echo "Category";
						echo "</td>";
						
						echo "<td  class=\"myth\">";
							echo "Description";	
						echo "</td>";
						
						echo "<td  colspan=\"2\" class=\"myth\">";
							echo "File (Others)";	
						echo "</td>";
				echo "</tr>";
				for($i=1; $i <= 5; $i++)
				{
					$myfilepathi++;
					echo "<tr>			
						<td class=\"mytd\" width=\"185\">";
							echo "Other  - ". $i;
						echo "</td>";
						
						
						echo "<td  class=\"mytd\">";
							echo "<input type=\"text\" class=\"mytextbox3\" name=\"Other".$i."Dis\" id=\"Other".$i."Dis\" >";
						echo "</td>";
						
						
						echo "<td  class=\"mytd\" align=\"center\">";
							
							$x	= '';
							$x	= "Other".$i."Name";
							$query_check = "select Other".$i."Name  from bms_bridgeprofileattachments where bridgeprofile_BridgeProfileID = '".$BridgeProfileID."' ";
							$result_check =  mysql_query($query_check) or die (mysql_error());
							while($row_check	= mysql_fetch_array($result_check)){
								$name = $row_check['Other'.$i.'Name'];
								$ext = substr($name, strrpos($name, '.') + 1);
								$lcase_ext = strtolower($ext);
							}
							
							
							$_SESSION['filepathx'][$myfilepathi]	= $datadir."other/";
							$_SESSION['fileidx'][$myfilepathi]	= $BridgeProfileID."-".$i.".".$lcase_ext;
							
							if($name == ""){
								echo "--";
							}else{
								echo "<a href=\"../download.php?id=".$myfilepathi."\"   target=\"_blank\">".$$x."</a>";
							}
							
						echo "</td>";
						
						echo "<td  class=\"mytd\">";
							echo "<input type=\"file\" class=\"mytextbox3\" name=\"Other".$i."Name\" id=\"Other".$i."Name\" >";
						echo "</td>";
					echo "</tr>";
				
				}
				////////////////////////////////////////////////////
				////////////////////////////////////////////////////
				

				echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";	
				
				
				echo "<tr id=\"mysubtr\"  name=\"mysubtr\"><td colspan=\"2\" align=\"center\">";
					echo "<input type=\"button\" name=\"go\" class=\"Submit_Button_Long_Long\" value=\"Save Bridge\" onclick=\"checkOnSubmit()\">";
				echo "</td></tr>";
				
				
				echo "<tr id=\"mysublasttr\"  name=\"mysublasttr\"><td colspan=\"2\" align=\"left\">";
					echo "<font class\"bodytextred\" color=\"red\"><b>Are you sure you want save the changes ?</b></font>";
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
	echo "</body>";
	include '../bottom.php';

?>