<?php

	include ("../global.php");
	include ("../top.php");

	echo "<head>";
	
	/* Inserting the CSS style sheet	
	*
	*
	*/
	echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"../common/common.css\" />";
	echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"../lib/jquery/cal/cal.css\" />";
	/*	
	1.
	Approach Safety barrier
			Type :(F/S)   {Rigid,Semi Rigid, Flexible}
			Location :(F/S0{L1,L2,R1,R2}

		barriertypes_BarrierTypeID			-> barriertypes_ASBarrierTypeID
		barrierlocations_BarrierLocationsID	-> barrierlocations_ASBarrierLocationsID
	
	
	
	2.
	Barrier 		                                   
			Type		: (F/S) {Rigid, Semi rigid, flexible}			
			Number	:(F/S) {0,1,2,….,5}
			Barrier Width		(m)	:(F/S)	47.12			
			Barrier Height		(m)	:(F/S)	47.12


		SuperStructure_barriertypes
		SuperStructure_BarrierNumber
		BarrierWidth	 
		BarrierHeight
	
	
	*/
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
			
			$("#HighestFloodLevelDate").datepicker({
                altField: '#realdate', 
                dateFormat:'yy-mm-dd'
			});

			
			$('#div_nriver').hide();	
			$('#div_nuproad').hide();
			$('#div_noproad').hide();
			$('#div_norail').hide();
			
						
			
			$('#clearance_wt_pwc').show();
			$('#clearance_wt_twc').show();
			$('#clearance_wt_ph').show();
			$('#clearance_wt_pss').show();				
			
			$('#clearance_nonwt_p').hide();
			$('#clearance_nonwt_tb').hide();
			
			
			for(var i=1; i<=30; i++)
			{
				$('#spgroup'+i).hide();	
				$('#deck'+i).hide();	
				$('#sub_pier_'+i).hide();	
				$('#foun_pier_'+i).hide();
			}			
			
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
	

	echo "<form enctype=\"multipart/form-data\" autocomplete=\"off\"  name=\"myfirstform\" id=\"myfirstform\" method=\"POST\" action=\"#\"  >";
		
		
	echo "<p class=\"hx1\">New Bridge</p>";
	


	if(isset($_POST['yes_submit']))
	{
		
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
		$SpanType							= $_POST['SpanType'];
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
				$comment_spgroup[$i] = str_replace("'", "\\'", $comment_spgroup[$i]);
				$comment_spgroup[$i] = str_replace('"', '\\"', $comment_spgroup[$i]);
			$comment_deck[$i]							= $_POST['comment_deck_'.$i];
				$comment_deck[$i] = str_replace("'", "\\'", $comment_deck[$i]);
				$comment_deck[$i] = str_replace('"', '\\"', $comment_deck[$i]);
			
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
			$Comments = str_replace("'", "\\'", $Comments);
			$Comments = str_replace('"', '\\"', $Comments);

		
		
		$sections_SectionID	= $_SESSION['logined_sections_SectionID'];
		$AddedBy			= $_SESSION['log_UserID'];
		$AddedDate			= date("Y-m-d H:i:s");
		
		////////////////////////////////////////////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////////
		$query_resource = "insert into bms_bridgeprofiles(
														StructureID,	
														sections_SectionID, 
														BridgeName, 
														owners_OwnerID,
														roadnames_RoadNameID, 
														routenos_RouteNoID, 
														roadclasses_RoadClassID, 
														funcofbridges_FuncOfBridgeID, 
														RiverName, 
														OverPassRoad,
														railroadnames_RailRoadID,
														UnderPassRoad, 
														structuretypes_StructureTypeID, 
														constructionmaterials_ConstructionMaterialID,
														YearOfConstructionStart, 
														district_DistrictID,
														provinces_ProvinceID,
														EEDivision,
														ClosestTown, 
														StartChainage, 
														EndChainage, 
														GazettedLength,
														GPSCoordinateN,
														GPSCoordinateE,
														GPSCoordinateZ,
														designstandards_DesignStandardID,
														DesignLoading,
														StructureLength,
														StructureWidth,
														NoOfSpans,
														NoOfPiers,
														GrossLoadLimit,
														PostedLoadLimit,
														AADT,
														Detours,
														HeavyVehicle,
														AttachmentsServices,
														AttachmentsDetails,
														attachmentslocations_AttachmentsLocationsID,
														NumberOfLampPosts,
														CarriagewayWidth,
														NoOfLanes,
														LaneWidth,
														FootPathWidthLeft,
														FootPathWidthRight,
														MedianWidth,
														MedianHeight,
														SuperStructure_barriertypes,
														SuperStructure_BarrierNumber,														
														BarrierWidth,
														BarrierHeight,														
														RoadApproachAlignmentVertical,
														RoadApproachAlignmentHorizontal,
														spantypes_SpanTypeID,
														SkewAngle,
														barriertypes_ASBarrierTypeID,
														barrierlocations_ASBarrierLocationsID,
														HeightInvertBridgeUnderside,
														HeightOWLBridgeUnderside,
														HighestFloodLevelBridgeUnderside,
														HighestFloodLevelDate,
														NormalFloodLevelBridgeUnderside,
														HeadRoom,
														Navigable,
														InitialSignedClearance,
														ExpansionJointsType,
														bearingtypes_BearingTypeID,
														bearingtypes_BearingMaterialID,
														climatezones_ClimateZoneID,
														localenvironments_LocalEnvironmentID,
														exposureclasses_ExposureClassID,
														ProtectiveCoatings,
														Contamination,
														Comments, 
														economicsfactors_EconomicsFactorID,
														loadingfactors_LoadingFactorID,
														ParapetLeftParapetTypeID, 
														ParapetLeftLenth, 
														ParapetRIghtParapetTypeID, 
														ParapetRIghtLenth, 														
														AddedBy,
														AddedDate) 
								values ('".$StructureID."',
										'".$sections_SectionID."',
										'".$BridgeName."',
										'".$owners_OwnerID."',
										'".$roadnames_RoadNameID."',
										'".$routenos_RouteNoID."',
										'".$roadclasses_RoadClassID."',
										'".$funcofbridges_FuncOfBridgeID."',
										'".$RiverName."',
										'".$OverPassRoad."',
										'".$railroadnames_RailRoadID."',
										'".$UnderPassRoad."',
										'".$structuretypes_StructureTypeID."',
										'".$constructionmaterials_ConstructionMaterialID."',
										'".$YearOfConstructionStart."',
										'".$district_DistrictID."',
										'".$provinces_ProvinceID."',
										'".$EEDivision."',
										'".$ClosestTown."',
										'".$StartChainage."',
										'".$EndChainage."',
										'".$GazettedLength."',
										'".$GPSCoordinateN."',
										'".$GPSCoordinateE."',
										'".$GPSCoordinateZ."',
										'".$designstandards_DesignStandardID."',
										'".$DesignLoading."',
										'".$StructureLength."',
										'".$StructureWidth."',
										'".$NoOfSpans."',
										'".$NoOfPiers."',
										'".$GrossLoadLimit."',
										'".$PostedLoadLimit."',
										'".$AADT."',
										'".$Detours."',
										'".$HeavyVehicle."',
										'".$AttachmentsServices."',
										'".$AttachmentsDetails."',
										'".$attachmentslocations_AttachmentsLocationsID."',
										'".$NumberOfLampPosts."',
										'".$CarriagewayWidth."',
										'".$NoOfLanes."',
										'".$LaneWidth."',
										'".$FootPathWidthLeft."',
										'".$FootPathWidthRight."',
										'".$MedianWidth."',
										'".$MedianHeight."',										
										'".$SuperStructure_barriertypes."',
										'".$SuperStructure_BarrierNumber."',										
										'".$BarrierWidth."',
										'".$BarrierHeight."',
										'".$RoadApproachAlignmentVertical."',
										'".$RoadApproachAlignmentHorizontal."',
										'".$SpanType."',
										'".$SkewAngle."',
										'".$barriertypes_ASBarrierTypeID."',
										'".$barrierlocations_ASBarrierLocationsID."',
										'".$HeightInvertBridgeUnderside."',
										'".$HeightOWLBridgeUnderside."',
										'".$HighestFloodLevelBridgeUnderside."',
										'".$HighestFloodLevelDate."',
										'".$NormalFloodLevelBridgeUnderside."',
										'".$HeadRoom."',
										'".$Navigable."',
										'".$InitialSignedClearance."',
										'".$ExpansionJointsType."',
										'".$bearingtypes_BearingTypeID."',
										'".$bearingtypes_BearingMaterialID."',
										'".$climatezones_ClimateZoneID."',
										'".$localenvironments_LocalEnvironmentID."',
										'".$exposureclasses_ExposureClassID."',
										'".$ProtectiveCoatings."',
										'".$Contamination."',
										'".$Comments."',
										'".$economicsfactors_EconomicsFactorID."', 
										'".$loadingfactors_LoadingFactorID."', 
										'".$ParapetLeftParapetTypeID."',
										'".$ParapetLeftLenth."',
										'".$ParapetRIghtParapetTypeID."',
										'".$ParapetRIghtLenth."', 										
										'".$AddedBy."',
										'".$AddedDate."')";
		$result_resource = mysql_query($query_resource) or die (mysql_error());
				
		$users_UserID	= $AddedBy;
		$TableName		= "bms_bridgeprofiles";		
		$SQLQuery = ""; //str_replace("'", "\'", $query_resource);
		$Action			= "INSERT";		
		$query_log = "insert into bms_logs(users_UserID, TableName,	SQLQuery, 	Action) values ('".$users_UserID."','".$TableName."','". $SQLQuery."','". $Action."')";
		$result_log = mysql_query($query_log) or die (mysql_error());
		
		
		$query_dis	= "select BridgeProfileID from bms_bridgeprofiles where AddedBy=\"".$AddedBy."\" and AddedDate=\"".$AddedDate."\" order by BridgeProfileID";
		$result_dis		= mysql_query($query_dis) or die (mysql_error());
		while($row_dis	= mysql_fetch_array($result_dis))
		{			
			$BridgeProfileID 	= $row_dis['BridgeProfileID'];
		}
		////////////////////////////////////////////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////////
		
		
		
		////////////////////////////////////////////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////////
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
		////////////////////////////////////////////////////////////////////////////////////
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
		////////////////////////////////////////////////////////////////////////////////////
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
		////////////////////////////////////////////////////////////////////////////////////
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
		////////////////////////////////////////////////////////////////////////////////////
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
		////////////////////////////////////////////////////////////////////////////////////
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
		////////////////////////////////////////////////////////////////////////////////////
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
		////////////////////////////////////////////////////////////////////////////////////
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
		////////////////////////////////////////////////////////////////////////////////////
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
		
		
		
				
		
		
		
		$CadDesignFileName	= array();	
		$DrawingFileName	= array();	
		$ImageFileName		= array();
		$OtherFileName		= array();
		
		
		for($i=1; $i <= 5; $i++)
		{
			$filename	= '';
			$filename 	= basename($_FILES['CadDesign'.$i.'Name']['name']);
			$CadDesignFileName[$i]	= $filename;	
			$ext = substr($filename, strrpos($filename, '.') + 1);
			$lcase_ext = strtolower($ext);
			if($lcase_ext == "dwg")
			{
				$target = $datadir."dwg/"; 
				$target = $target . $BridgeProfileID."-".$i.".dwg";
				move_uploaded_file($_FILES['CadDesign'.$i.'Name']['tmp_name'],$target);
			}
		}

		
		for($i=1; $i <= 10; $i++)
		{
			$filename	= '';
			$filename 	= basename($_FILES['Drawing'.$i.'Name']['name']);
			$DrawingFileName[$i]	= $filename;
			
			$ext = substr($filename, strrpos($filename, '.') + 1);
			$lcase_ext = strtolower($ext);
			if($lcase_ext == "pdf")
			{
				$target = $datadir."pdf/"; 
				$target = $target . $BridgeProfileID."-".$i.".pdf";
				move_uploaded_file($_FILES['Drawing'.$i.'Name']['tmp_name'],$target);
			}		
		}

		for($i=1; $i <= 5; $i++)
		{
			$filename	= '';
			$filename 	= basename($_FILES['Image'.$i.'Name']['name']);
			$ImageFileName[$i]	= $filename;
			$ext = substr($filename, strrpos($filename, '.') + 1);
			$lcase_ext = strtolower($ext);
			if($lcase_ext == "jpg")
			{
				$target = $datadir."jpg/"; 
				$target = $target . $BridgeProfileID."-".$i.".jpg";
				move_uploaded_file($_FILES['Image'.$i.'Name']['tmp_name'],$target);
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
		$query_resource = "insert into bms_bridgeprofileattachments (bridgeprofile_BridgeProfileID, ";

		for($i=1; $i <= 5; $i++)
		{													
			$query_resource = $query_resource . "CadDesign".$i."Name, ";
		}
		for($i=1; $i <= 5; $i++)
		{													
			$query_resource = $query_resource . "CadDesign".$i."Dis, ";
		}
		
		for($i=1; $i <= 10; $i++)
		{													
			$query_resource = $query_resource . "Drawing".$i."Name, ";
		}
		for($i=1; $i <= 10; $i++)
		{													
			$query_resource = $query_resource . "Drawing".$i."Dis, ";
		}
		
		for($i=1; $i <= 5; $i++)
		{													
			$query_resource = $query_resource . "Image".$i."Name, ";
		}
		for($i=1; $i <= 5; $i++)
		{													
			$query_resource = $query_resource . "Image".$i."Dis, ";
		}
		
		for($i=1; $i <= 5; $i++)
		{													
			$query_resource = $query_resource . "Other".$i."Name, ";
		}
		for($i=1; $i <= 5; $i++)
		{													
			$query_resource = $query_resource . "Other".$i."Dis, ";
		}

		$query_resource = $query_resource . "AddedBy, AddedDate) values ('".$BridgeProfileID."',";
		
		
		for($i=1; $i <= 5; $i++)
		{													
			$query_resource = $query_resource . "'".$CadDesignFileName[$i]."', ";
		}
		for($i=1; $i <= 5; $i++)
		{													
			$query_resource = $query_resource . "'".$_POST['CadDesign'.$i.'Dis']."', ";
		}
		
		for($i=1; $i <= 10; $i++)
		{													
			$query_resource = $query_resource . "'".$DrawingFileName[$i]."',";
		}
		for($i=1; $i <= 10; $i++)
		{													
			$query_resource = $query_resource . "'".$_POST['Drawing'.$i.'Dis']."', ";
		}
		
		for($i=1; $i <= 5; $i++)
		{													
			$query_resource = $query_resource . "'".$ImageFileName[$i]."',";
		}
		for($i=1; $i <= 5; $i++)
		{
			$query_resource = $query_resource . "'".$_POST['Image'.$i.'Dis']."', ";
		}
		
		for($i=1; $i <= 5; $i++)
		{													
			$query_resource = $query_resource . "'".$OtherFileName[$i]."',";
		}
		for($i=1; $i <= 5; $i++)
		{
			$query_resource = $query_resource . "'".$_POST['Other'.$i.'Dis']."', ";
		}
		
		$query_resource = $query_resource . "'".$AddedBy."', '".$AddedDate."')";
		$result_resource = mysql_query($query_resource) or die (mysql_error());
					
		$users_UserID	= $AddedBy;
		$TableName		= "bms_bridgeprofileattachments";		
		$SQLQuery 		= str_replace("'", "\'", $query_resource);
		$Action			= "INSERT";		
		$query_log = "insert into bms_logs(users_UserID, TableName,	SQLQuery, 	Action) values ('".$users_UserID."','".$TableName."','". $SQLQuery."','". $Action."')";
		$result_log = mysql_query($query_log) or die (mysql_error());
	
		
		echo "<p class=\"bodytextsus\"><BR />Successfully Added ....<BR /></p>";		
	}
	else
	{
	
	
	
	////////////////////////////////////////////////////////////////////////////////////

	/* Data Updating Query........................................................................................
	*
	*
	*/
	
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
					<td class=\"mytd\"> <input type=\"text\" class=\"mytextbox3\" name=\"StructureID\"  oninput=\"ajaxFunction();\"  id=\"StructureID\" >
					<span name=\"des\" id=\"des\"></span></td>
					<td><span id=\"structure_id\" class=\"bodytextred\"></span></td>
				</tr>
				<tr>
					<td class=\"mytd\">Name of the Bridge</td>
					<td class=\"mytd\"> <input type=\"text\" class=\"mytextbox3\" name=\"BridgeName\" id=\"BridgeName\" > </td>
					<td><span id=\"bname_id\" class=\"bodytextred\"></span></td>
				</tr>	
				
				<tr>
				
				<td class=\"mytd\">Owner of the Bridge</td>
				";
					echo "<td  class=\"mytd\">";
					$query_dis	= "select OwnerID, OwnerName from bms_owners order by OwnerName";
					$result_dis		= mysql_query($query_dis) or die (mysql_error());

					echo "<select name=\"owners_OwnerID\" class=\"myselect3\">";
						echo "<option value=\"0\">Unspecified</option>";
						while($row_dis	= mysql_fetch_array($result_dis))
						{
							
							$OwnerID 	= $row_dis['OwnerID'];
							$OwnerName	= $row_dis['OwnerName'];
							if(isset($_POST['OwnerID']) and ($_POST['OwnerID'] == $OwnerID))
							{
								echo "<option value=\"".$OwnerID."\">".$OwnerName."</option>";
							}
							else
							{
								echo "<option value=\"".$OwnerID."\" >".$OwnerName."</option>";
							}
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
							if(isset($_POST['RoadNameID']) and ($_POST['RoadNameID'] == $RoadNameID))
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
							
							echo "<option value=\"".$RouteNoID."\">".$RouteNo."</option>";
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
							
							echo "<option value=\"".$RoadClassID."\">".$RoadClass."</option>";
							
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
							if(isset($_POST['FuncOfBridgeID']) and ($_POST['FuncOfBridgeID'] == $FuncOfBridgeID))
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
					<input type=\"text\" class=\"mytextbox3\" name=\"RiverName\" id=\"RiverName\" /> </td>
				</td>";
				echo "
				
				</tr>
		
				<tr name=\"div_nr\" id=\"div_nuproad\">
					<td class=\"mytd\">Name of the Road - UnderPass</td>
					<td class=\"mytd\"> <input type=\"text\" class=\"mytextbox3\" name=\"UnderPassRoad\" id=\"UnderPassRoad\" > </td>
					<td><span id=\"oname_id\" class=\"bodytextred\"></span></td>
				</tr>	
			
				<tr name=\"div_nr\" id=\"div_noproad\">
					<td class=\"mytd\">Name of the Road - OverPass</td>
					<td class=\"mytd\"> <input type=\"text\" class=\"mytextbox3\" name=\"OverPassRoad\" id=\"OverPassRoad\" > </td>
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
							if(isset($_POST['railroadnames_RailRoadID']) and ($_POST['railroadnames_RailRoadID'] == $RailRoadNameID))
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
						$query_dis	= "select * from bms_economicsfactors order by EconomicsFactorID";
						$result_dis		= mysql_query($query_dis) or die (mysql_error());

						echo "<select name=\"economicsfactors_EconomicsFactorID\" class=\"mytextbox3\">";
							while($row_dis	= mysql_fetch_array($result_dis))
							{
							
								$EconomicsFactorID 	= $row_dis['EconomicsFactorID'];
								$EconomicsFactorName	= $row_dis['EconomicsFactorName'];
								if(isset($_POST['economicsfactors_EconomicsFactorID']) and ($_POST['economicsfactors_EconomicsFactorID'] == $EconomicsFactorID))
								{
									echo "<option value=\"".$EconomicsFactorID."\" selected=\"selected\">".$EconomicsFactorName."</option>";
								}
								else
								{
									echo "<option value=\"".$EconomicsFactorID."\" >".$EconomicsFactorName."</option>";
								}
							}
						echo "</select>";
					echo "</td>
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
									if(isset($_POST['structuretypes_StructureTypeID']) and ($_POST['structuretypes_StructureTypeID'] == $StructureTypeID))
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
									if(isset($_POST['constructionmaterials_ConstructionMaterialID']) and ($_POST['constructionmaterials_ConstructionMaterialID'] == $ConstructionMaterialID))
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
									if(isset($_POST['YearOfConstructionStart']) and ($_POST['YearOfConstructionStart'] == $myi))
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

						echo "<select name=\"operationalstatuses_OperationalStatusID\" class=\"mytextbox3\">";
							echo "<option value=\"0\">Unspecified</option>";
							while($row_dis	= mysql_fetch_array($result_dis))
							{
								$OperationalStatusID	= $row_dis['OperationalStatusID'];
								$OperationalStatus	= $row_dis['OperationalStatus'];
								echo "<option value=\"".$OperationalStatusID."\"";
									if(isset($_POST['operationalstatuses_OperationalStatusID']) and ($_POST['operationalstatuses_OperationalStatusID'] == $OperationalStatusID))
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
						
						echo "<input type=\"text\" class=\"mytextbox3\" name=\"operationstdate\" id=\"operationstdate\" >";
						
					
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
									if(isset($_POST['district_DistrictID']) and ($_POST['district_DistrictID'] == $DistrictID))
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
									if(isset($_POST['district_DistrictID']) and ($_POST['district_DistrictID'] == $ProvinceID))
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
						echo "<input type=\"text\" class=\"mytextbox3\" name=\"EEDivision\" id=\"EEDivision\" >";
					echo "</td>";
					echo "			
				</tr>
				
				
				<tr>			
					<td class=\"mytd\" >Closest Town</td>
					";
						echo "<td  class=\"mytd\">";
						echo "<input type=\"text\" class=\"mytextbox3\" name=\"ClosestTown\" id=\"ClosestTown\" >";
					echo "</td>";
					echo "			
				</tr>
				
				
				
				
				<tr>			
					<td class=\"mytd\" >Start Chainage (Km)</td>
					";
						echo "<td  class=\"mytd\">";
						echo "<input type=\"text\" class=\"mytextbox3\" name=\"StartChainage\" id=\"StartChainage\" >";
					echo "</td>";
					echo "			
				</tr>
				
				
				<tr>			
					<td class=\"mytd\" >End Chainage (Km)</td>
					";
						echo "<td  class=\"mytd\">";
						echo "<input type=\"text\" class=\"mytextbox3\" name=\"EndChainage\" id=\"EndChainage\" >";
					echo "</td>";
					echo "			
				</tr>
				
				
				<tr>			
					<td class=\"mytd\" >Length of Bridge (m)</td>
					";
						echo "<td  class=\"mytd\">";
						echo "<input type=\"text\" class=\"mytextbox3\" name=\"GazettedLength\" id=\"GazettedLength\" >";
					echo "</td>";
					echo "			
				</tr>
				
				
				
				
				<tr>			
					<td class=\"mytd\" >GPS Coordinate (N)</td>
					";
						echo "<td  class=\"mytd\">";
						echo "<input type=\"text\" class=\"mytextbox3\" name=\"GPSCoordinateN\" id=\"GPSCoordinateN\" >";
					echo "</td>";
					echo "			
				</tr>
				
				
				<tr>			
					<td class=\"mytd\" >GPS Coordinate (E)</td>
					";
						echo "<td  class=\"mytd\">";
						echo "<input type=\"text\" class=\"mytextbox3\" name=\"GPSCoordinateE\" id=\"GPSCoordinateE\" >";
					echo "</td>";
					echo "			
				</tr>
				
				
				<tr>			
					<td class=\"mytd\" >GPS Coordinate (Z)</td>
					";
						echo "<td  class=\"mytd\">";
						echo "<input type=\"text\" class=\"mytextbox3\" name=\"GPSCoordinateZ\" id=\"GPSCoordinateZ\" >";
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
									if(isset($_POST['designstandards_DesignStandardID']) and ($_POST['designstandards_DesignStandardID'] == $DesignStandardID))
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
						echo "<input type=\"text\" class=\"mytextbox3\" name=\"StructureLength\" id=\"StructureLength\" >";
					echo "</td>";
					echo "			
				</tr>
				
				
				<tr>			
					<td class=\"mytd\" >Structure (Deck area) Width	(m)</td>
					";
						echo "<td  class=\"mytd\">";
						echo "<input type=\"text\" class=\"mytextbox3\" name=\"StructureWidth\" id=\"StructureWidth\" >";
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
								if(isset($_POST['NoOfSpans']) and ($_POST['NoOfSpans'] == $myj))
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
								if(isset($_POST['NoOfPiers']) and ($_POST['NoOfPiers'] == $myk))
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
							echo "<input type=\"text\" class=\"mytextbox3\" name=\"GrossLoadLimit\" id=\"GrossLoadLimit\" >";
					echo "</td>";
					echo "			
				</tr>
				
				
				
				<tr>			
					<td class=\"mytd\" >Posted Load Limit (Tons)</td>
					";
						echo "<td  class=\"mytd\">";
						echo "<input type=\"text\" class=\"mytextbox3\" name=\"PostedLoadLimit\" id=\"PostedLoadLimit\" >";
					echo "</td>";
					echo "			
				</tr>
				
				
				
				
				<tr>";
					echo "<td class=\"mytd\" width=\"285\">Loading Factor</td>";
						echo "<td  class=\"mytd\">";
						$query_dis	= "select * from bms_loadingfactors order by LoadingFactorID";
						$result_dis		= mysql_query($query_dis) or die (mysql_error());

						echo "<select name=\"loadingfactors_LoadingFactorID\" class=\"mytextbox3\">";
							while($row_dis	= mysql_fetch_array($result_dis))
							{
							
								$LoadingFactorID 	= $row_dis['LoadingFactorID'];
								$LoadingFactorName	= $row_dis['LoadingFactorName'];
								if(isset($_POST['loadingfactors_LoadingFactorID']) and ($_POST['loadingfactors_LoadingFactorID'] == $LoadingFactorID))
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
							<option value=\"1\">0-1000</option>
							<option value=\"2\">1000-5000</option>
							<option value=\"3\">5000-10000</option>
							<option value=\"4\">>10000</option>
						</select>";						
					echo "</td>";
					echo "			
				</tr>
				
				
				<tr>			
					<td class=\"mytd\" >Traffic Access Detour (Km)</td>
					";
						echo "<td  class=\"mytd\">";
						echo "<select name=\"Detours\" id=\"Detours\" class=\"myselect3\">
							<option value=\"1\">0-10</option>
							<option value=\"2\">10-20</option>
							<option value=\"3\">20-50</option>
							<option value=\"4\">50-100</option>
							<option value=\"5\">>100</option>
						</select>";
					echo "</td>";
					echo "			
				</tr>
				
				
				<tr>			
					<td class=\"mytd\" >Heavy Vehicle (HV)</td>
					";
						echo "<td  class=\"mytd\">";
						echo "<input type=\"text\" class=\"mytextbox3\" name=\"HeavyVehicle\" id=\"HeavyVehicle\" >";
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
							echo "<input type=\"text\" class=\"mytextbox3\" name=\"AttachmentsServices\" id=\"AttachmentsServices\" >";
					echo "</td>";
					echo "			
				</tr>
				
				
				
				<tr>			
					<td class=\"mytd\" >Details</td>
					";
						echo "<td  class=\"mytd\">";
						echo "<input type=\"text\" class=\"mytextbox3\" name=\"AttachmentsDetails\" id=\"AttachmentsDetails\" >";
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
									if(isset($_POST['attachmentslocations_AttachmentsLocationsID']) and ($_POST['attachmentslocations_AttachmentsLocationsID'] == $AttachmentsLocationsID))
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
							echo "<input type=\"text\" class=\"mytextbox3\" name=\"NumberOfLampPosts\" id=\"NumberOfLampPosts\" >";
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
								if(isset($_POST['NoOfSpans']) and ($_POST['NoOfSpans'] == $myj))
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
						echo "<input type=\"text\" class=\"mytextbox3\" name=\"LaneWidth\" id=\"LaneWidth\" >";
					echo "</td>";
					echo "			
				</tr>
				
				
				<tr>			
					<td class=\"mytd\" >Foot Path Width Left (m)</td>
					";
						echo "<td  class=\"mytd\">";
						echo "<input type=\"text\" class=\"mytextbox3\" value=\"0.00\" name=\"FootPathWidthLeft\" id=\"FootPathWidthLeft\" >";
					echo "</td>";
					echo "			
				</tr>
				
				<tr>			
					<td class=\"mytd\" >Foot Path Width Right (m)</td>
					";
						echo "<td  class=\"mytd\">";
						echo "<input type=\"text\" class=\"mytextbox3\" value=\"0.00\" name=\"FootPathWidthRight\" id=\"FootPathWidthRight\" >";
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
						echo "<input type=\"text\" class=\"mytextbox3\" name=\"MedianWidth\" id=\"MedianWidth\" >";
					echo "</td>";
					echo "			
				</tr>
				
				<tr>			
					<td class=\"mytd\" >Median Height (m)</td>
					";
						echo "<td  class=\"mytd\">";
						echo "<input type=\"text\" class=\"mytextbox3\" name=\"MedianHeight\" id=\"MedianHeight\" >";
					echo "</td>";
					echo "			
				</tr>
				
				
				
				
				<tr>			
					<td >&nbsp;</td><td >&nbsp;</td>
				</tr>
				
				<tr>			
					<td class=\"mytd\" >Road Approach Vertical Alignment (m)</td>
					";
						echo "<td  class=\"mytd\">";
						echo "<input type=\"text\" class=\"mytextbox3\" name=\"RoadApproachAlignmentVertical\" id=\"RoadApproachAlignmentVertical\" >";
					echo "</td>";
					echo "			
				</tr>
				
				<tr>			
					<td class=\"mytd\" >Road Approach Horizontal Alignment (m)</td>
					";
						echo "<td  class=\"mytd\">";
						echo "<input type=\"text\" class=\"mytextbox3\" name=\"RoadApproachAlignmentHorizontal\" id=\"RoadApproachAlignmentHorizontal\" >";
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

						echo "<select name=\"SpanType\" class=\"mytextbox3\">";
							echo "<option value=\"0\">Unspecified</option>";
							while($row_dis	= mysql_fetch_array($result_dis))
							{
								$SpanTypeID 	= $row_dis['SpanTypeID'];
								$SpanType	= $row_dis['SpanType'];
								echo "<option value=\"".$SpanTypeID."\"";
									if(isset($_POST['SpanType']) and ($_POST['SpanType'] == $SpanTypeID))
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
						echo "<input type=\"text\" class=\"mytextbox3\" name=\"SkewAngle\" id=\"SkewAngle\" >";
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
									if(isset($_POST['barriertypes_ASBarrierTypeID']) and ($_POST['barriertypes_ASBarrierTypeID'] == $BarrierTypeID))
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
									if(isset($_POST['barrierlocations_ASBarrierLocationsID']) and ($_POST['barrierlocations_ASBarrierLocationsID'] == $BarrierLocationsID))
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
						echo "<input type=\"text\" class=\"mytextbox3\" name=\"HeightInvertBridgeUnderside\" id=\"HeightInvertBridgeUnderside\" >";
					echo "</td>";
					echo "			
				</tr>
				
				<tr>			
					<td class=\"mytd\"  width=\"285\">Initial Signed Clearance (m)</td>
					";
						echo "<td  class=\"mytd\">";
						echo "<input type=\"text\" class=\"mytextbox3\" name=\"InitialSignedClearance\" id=\"InitialSignedClearance\" >";
					echo "</td>";
					echo "			
				</tr>
				
				
				<tr>			
					<td class=\"mytd\" >Height from OWL to bridge underside (m)</td>
					";
						echo "<td  class=\"mytd\">";
						echo "<input type=\"text\" class=\"mytextbox3\" name=\"HeightOWLBridgeUnderside\" id=\"HeightOWLBridgeUnderside\" >";
					echo "</td>";
					echo "			
				</tr>
				
				
				<tr>			
					<td class=\"mytd\" >Highest flood level wrt bridge underside (m)</td>
					";
						echo "<td  class=\"mytd\">";
						echo "<input type=\"text\" class=\"mytextbox3\" name=\"HighestFloodLevelBridgeUnderside\" id=\"HighestFloodLevelBridgeUnderside\" />";
						
					echo "</td>";
					echo "			
				</tr>
				
				<tr>			
					<td class=\"mytd\" >Highest flood level Date</td>
					";
						echo "<td  class=\"mytd\">";
						echo "<input type=\"text\" class=\"mytextbox3\" name=\"HighestFloodLevelDate\" id=\"HighestFloodLevelDate\" />";
						
					echo "</td>";
					echo "			
				</tr>
				
				<tr>			
					<td class=\"mytd\" >Normal flood level wrt bridge underside (m)</td>
					";
						echo "<td  class=\"mytd\">";
						echo "<input type=\"text\" class=\"mytextbox3\"  name=\"NormalFloodLevelBridgeUnderside\" id=\"NormalFloodLevelBridgeUnderside\" >";
					echo "</td>";
					echo "			
				</tr>
				
				<tr>			
					<td class=\"mytd\" >Head Room (m)</td>
					";
						echo "<td  class=\"mytd\">";
						echo "<input type=\"text\" class=\"mytextbox3\"  name=\"HeadRoom\" id=\"HeadRoom\" >";
					echo "</td>";
					echo "			
				</tr>
				
				<tr>			
					<td class=\"mytd\" >Navigable (m)</td>
					";
						echo "<td  class=\"mytd\">";
						echo "<input type=\"text\" class=\"mytextbox3\"  name=\"Navigable\" id=\"Navigable\" >";
					echo "</td>";
					echo "			
				</tr>
			<table>";
				
				
				
				
				
			
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
						<td class=\"myth\" width=\"115\">Material</td>
						<td class=\"myth\" width=\"115\">Type</td>
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
								$query_dis	= "select * from bms_spanmaterials";
								$result_dis		= mysql_query($query_dis) or die (mysql_error());
								echo "<select name=\"spanmaterials_SpanMaterialID_spgroup_".$i."\" class=\"mytextbox2\">";
									while($row_dis	= mysql_fetch_array($result_dis))
									{
									
										$SpanMaterialID 	= $row_dis['SpanMaterialID'];
										$SpanMaterial	= $row_dis['SpanMaterial'];
										if(isset($_POST['spanmaterials_SpanMaterialID_spgroup_'.$i]) and ($_POST['spanmaterials_SpanMaterialID_spgroup_'.$i] == $SpanMaterialID))
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
								<input type=\"text\" class=\"mytextbox1\" name=\"spantypes_SpanTypeID_spgroup_".$i."\" id=\"spantypes_SpanTypeID_spgroup_".$i."\" >
							</td>						
							
							<td class=\"mytd\" width=\"115\">";
								echo "<input type=\"text\" class=\"mytextbox1\" name=\"SpanLength_spgroup_".$i."\" id=\"SpanLength_spgroup_".$i."\" >				
							</td>
							
							
							<td class=\"mytd\" width=\"115\">";
								
								echo "<select name=\"YearOfConstruction_spgroup_".$i."\" class=\"mytextbox1\">";
									$thisyear = date(Y);
									for($myi=2000; $myi <=$thisyear; $myi++)
									{							
										if(isset($_POST['YearOfConstruction_spgroup_'.$i]) and ($_POST['YearOfConstruction_spgroup_'.$i] == $myi))
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
									echo "<option value=\"o\" selected=\"selected\">Original</option>";
									echo "<option value=\"w\" >Widened</option>";
								echo "</select>";							
							echo "</td>								
						</tr>";
					}				
			echo "</table>";
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			echo "<p class=\"bodytextbold\"><br /><u>Decks</u></p>";
			
				echo "<table class=\"bodytext\">
					<tr>			
						<td class=\"myth\" width=\"115\">Deck</td>					
						<td class=\"myth\" width=\"115\">Material</td>
						<td class=\"myth\" width=\"115\">Surface Type</td>
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
								$query_dis	= "select * from bms_deckmaterials";
								$result_dis		= mysql_query($query_dis) or die (mysql_error());
								echo "<select name=\"deckmaterials_DeckMaterialID_deck_".$i."\" class=\"mytextbox2\">";
									while($row_dis	= mysql_fetch_array($result_dis))
									{
									
										$DeckMaterialID 	= $row_dis['DeckMaterialID'];
										$DeckMaterial	= $row_dis['DeckMaterial'];
										if(isset($_POST['deckmaterials_DeckMaterialID_deck_'.$i]) and ($_POST['deckmaterials_DeckMaterialID_deck_'.$i] == $DeckMaterialID))
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
										if(isset($_POST['desksurfacetypes_DeskSurfaceTypeID_deck_'.$i]) and ($_POST['desksurfacetypes_DeskSurfaceTypeID_deck_'.$i] == $DeskSurfaceTypeID))
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
								echo "<input type=\"text\" class=\"mytextbox1\" name=\"DeckSurfaceThickness_deck_".$i."\" id=\"DeckSurfaceThickness_deck_".$i."\" >				
							</td>
							
							<td class=\"mytd\" width=\"115\">";
								
								echo "<select name=\"YearOfConstruction_deck_".$i."\" class=\"mytextbox1\">";
									$thisyear = date(Y);
									for($myi=2000; $myi <=$thisyear; $myi++)
									{							
										if(isset($_POST['YearOfConstruction_deck_'.$i]) and ($_POST['YearOfConstruction_deck_'.$i] == $myi))
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
									echo "<option value=\"o\" selected=\"selected\">Original</option>";
									echo "<option value=\"w\" >Widened</option>";
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
								if(isset($_POST['SuperStructure_barriertypes'.$i]) and ($_POST['SuperStructure_barriertypes'.$i] == $BarrierTypeID))
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
									if(isset($_POST['SuperStructure_BarrierNumber']) and ($_POST['SuperStructure_BarrierNumber'] == $myj))
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
						
						echo "<input type=\"text\" class=\"mytextbox3\" name=\"SuperStructure_barrierwidth\" id=\"ExpansionJointsType\" >";	
					echo "</td>";
					echo "			
				</tr>
				<tr>			
					<td class=\"mytd\" width=\"285\">Barrier Height (m)</td>";
					echo "<td  class=\"mytd\">";					
						
						echo "<input type=\"text\" class=\"mytextbox3\" name=\"SuperStructure_barrierheight\" id=\"ExpansionJointsType\" >";	
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
										if(isset($_POST['deckmaterials_DeckMaterialID_deck_'.$i]) and ($_POST['deckmaterials_DeckMaterialID_deck_'.$i] == $ParapetTypeID))
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
								echo "<input type=\"text\" class=\"mytextbox1\" name=\"parapet_left_lenth\"  >				
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
										if(isset($_POST['deckmaterials_DeckMaterialID_deck_'.$i]) and ($_POST['deckmaterials_DeckMaterialID_deck_'.$i] == $ParapetTypeID))
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
								echo "<input type=\"text\" class=\"mytextbox1\" name=\"parapet_right_lenth\"  >				
							</td>							
						</tr>";
						
									
			echo "</table>";
			
			
			
			
			echo "<p class=\"bodytextbold\"><br /><u>Expansion Joints</u></p>";		
		
			echo "<table class=\"bodytext\">
				<tr>			
					<td class=\"mytd\" width=\"285\">Type</td>";
					echo "<td  class=\"mytd\">";					
						
						echo "<input type=\"text\" class=\"mytextbox3\" name=\"ExpansionJointsType\" id=\"ExpansionJointsType\" >";	
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
								$query_dis	= "select * from bms_piermaterials";
								$result_dis		= mysql_query($query_dis) or die (mysql_error());
								echo "<select name=\"piermaterials_PierMaterialID_sub_pier_".$i."\" class=\"mytextbox3\">";
									while($row_dis	= mysql_fetch_array($result_dis))
									{
									
										$PierMaterialID 	= $row_dis['PierMaterialID'];
										$PierMaterial	= $row_dis['PierMaterial'];
										if(isset($_POST['piermaterials_PierMaterialID_sub_pier_'.$i]) and ($_POST['piermaterials_PierMaterialID_sub_pier_'.$i] == $PierMaterialID))
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
								$query_dis	= "select * from bms_piertypes";
								$result_dis		= mysql_query($query_dis) or die (mysql_error());
								echo "<select name=\"piertypes_PierTypeID_sub_pier_".$i."\" class=\"mytextbox3\">";
									while($row_dis	= mysql_fetch_array($result_dis))
									{
									
										$PierTypeID 	= $row_dis['PierTypeID'];
										$PierType 	= $row_dis['PierType'];
										if(isset($_POST['piertypes_PierTypeID_sub_pier_'.$i]) and ($_POST['piertypes_PierTypeID_sub_pier_'.$i] == $PierTypeID))
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
								echo "<input type=\"text\" class=\"mytextbox1\" name=\"ThicknessCappingLevel_".$i."\" id=\"ThicknessCappingLevel_".$i."\" >				
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
						<td class=\"myth\" width=\"115\">Length (m)</td>
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
										if(isset($_POST['wingmaterials_WingMaterialID_sub_ww_'.$i]) and ($_POST['wingmaterials_WingMaterialID_sub_ww_'.$i] == $WingMaterialID))
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
										if(isset($_POST['wingtypes_WingTypeID_sub_ww_'.$i]) and ($_POST['wingtypes_WingTypeID_sub_ww_'.$i] == $WingTypeID))
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
								echo "<input type=\"text\" class=\"mytextbox1\" name=\"WingWallLenth_".$i."\" id=\"WingWallLenth_".$i."\" >				
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
										if(isset($_POST['abutmentmaterials_AbutmentMaterialID_sub_abunt_'.$i]) and ($_POST['abutmentmaterials_AbutmentMaterialID_sub_abunt_'.$i] == $AbutmentMaterialID))
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
										if(isset($_POST['abutmenttypes_SpanTypeID_sub_abunt_'.$i]) and ($_POST['abutmenttypes_SpanTypeID_sub_abunt_'.$i] == $AbutmentTypeID))
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
								if(isset($_POST['bearingtypes_BearingTypeID']) and ($_POST['bearingtypes_BearingTypeID'] == $BearingTypeID))
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
								if(isset($_POST['bearingtypes_BearingMaterialID']) and ($_POST['bearingtypes_BearingMaterialID'] == $BearingMaterialID))
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
								$query_dis	= "select * from bms_pierfoundationmaterials order by PierFoundationMaterial";
								$result_dis		= mysql_query($query_dis) or die (mysql_error());
								echo "<select name=\"piermaterials_PierMaterialID_foun_pier_".$i."\" class=\"mytextbox3\">";
									while($row_dis	= mysql_fetch_array($result_dis))
									{
									
										$PierFoundationMaterialID 	= $row_dis['PierFoundationMaterialID'];
										$PierFoundationMaterial	= $row_dis['PierFoundationMaterial'];
										
										if(isset($_POST['piermaterials_PierMaterialID_foun_pier_'.$i]) and ($_POST['piermaterials_PierMaterialID_foun_pier_'.$i] == $PierFoundationMaterialID))
										{
											echo "<option value=\"".$PierFoundationMaterialID."\" selected=\"selected\">".$PierFoundationMaterial."</option>";
										}
										else
										{
											echo "<option value=\"".$PierFoundationMaterialID."\" >".$PierFoundationMaterial."</option>";
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
									
										$PierFoundationTypeID 	= $row_dis['PierFoundationTypeID'];
										$PierFoundationType 	= $row_dis['PierFoundationType'];
										if(isset($_POST['piertypes_PierTypeID_foun_pier_'.$i]) and ($_POST['piertypes_PierTypeID_foun_pier_'.$i] == $PierFoundationTypeID))
										{
											echo "<option value=\"".$PierFoundationTypeID."\" selected=\"selected\">".$PierFoundationType."</option>";
										}
										else
										{
											echo "<option value=\"".$PierFoundationTypeID."\" >".$PierFoundationType."</option>";
										}
									}
								echo "</select>";
							echo "</td>
							<td class=\"mytd\" width=\"115\">
								<input type=\"text\" class=\"mytextbox2\" name=\"pierComments_foun_pier_".$i."\" id=\"pierComments_foun_pier_".$i."\" />						
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
										if(isset($_POST['abutmentmaterials_AbutmentMaterialID_foun_abunt'.$i]) and ($_POST['abutmentmaterials_AbutmentMaterialID_foun_abunt'.$i] == $AbutmentFoundationMaterialID))
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
										if(isset($_POST['abutmenttypes_SpanTypeID_foun_abunt'.$i]) and ($_POST['abutmenttypes_SpanTypeID_foun_abunt'.$i] == $AbutmentTypeID))
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
								<input type=\"text\" class=\"mytextbox2\" name=\"abutmentComments_foun_abunt".$i."\" id=\"abutmentComments_foun_abunt".$i."\" />						
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
										if(isset($_POST['wingmaterials_WingMaterialID_foun_ww'.$i]) and ($_POST['wingmaterials_WingMaterialID_foun_ww'.$i] == $WingFoundationMaterialID))
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
										if(isset($_POST['wingtypes_WingTypeID_foun_ww'.$i]) and ($_POST['wingtypes_WingTypeID_foun_ww'.$i] == $WingFoundationTypeID))
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
								<input type=\"text\" class=\"mytextbox2\" name=\"wingComments_foun_ww".$i."\" id=\"wingComments_foun_ww".$i."\" />						
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
								if(isset($_POST['climatezones_ClimateZoneID']) and ($_POST['climatezones_ClimateZoneID'] == $ClimateZoneID))
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
								if(isset($_POST['exposureclasses_ExposureClassID']) and ($_POST['exposureclasses_ExposureClassID'] == $ExposureClassID))
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
						echo "<input type=\"text\" class=\"mytextbox3\" name=\"ProtectiveCoatings\" id=\"ProtectiveCoatings\" >";
					echo "</td>";
					echo "			
				</tr>
				
				
				<tr>			
					<td class=\"mytd\" >Contamination</td>
					";
						echo "<td  class=\"mytd\">";
						echo "<input type=\"text\" class=\"mytextbox3\" name=\"Contamination\" id=\"Contamination\" >";
					echo "</td>";
					echo "			
				</tr>
				
				
				<tr>			
					<td class=\"mytd\" >Comments</td>
					";
						echo "<td  class=\"mytd\">";
						echo "<textarea type=\"text\" class=\"mytextbox3\" name=\"Comments\" id=\"Comments\" rows=\"5\"></textarea>";
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
							echo "<input type=\"text\" class=\"mytextbox3\" name=\"CadDesign".$i."Dis\" id=\"CadDesign".$i."Dis\" >";
						echo "</td>";
						
						echo "<td  class=\"mytd\">";
							echo "<input type=\"file\" class=\"mytextbox3\" name=\"CadDesign".$i."Name\" id=\"CadDesign".$i."Name\" >";
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
							echo "<input type=\"text\" class=\"mytextbox3\" name=\"Drawing".$i."Dis\" id=\"Drawing".$i."Dis\" >";
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
							echo "<input type=\"text\" class=\"mytextbox3\" name=\"Image".$i."Dis\" id=\"Image".$i."Dis\" >";
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
						
						echo "<td  class=\"myth\">";
							echo "File (Others)";	
						echo "</td>";
				echo "</tr>";
				for($i=1; $i <= 5; $i++)
				{
					echo "<tr>			
						<td class=\"mytd\" width=\"185\">";
							echo "Other  - ". $i;
						echo "</td>";
						
						
						echo "<td  class=\"mytd\">";
							echo "<input type=\"text\" class=\"mytextbox3\" name=\"Other".$i."Dis\" id=\"Other".$i."Dis\" >";
						echo "</td>";
						
						echo "<td  class=\"mytd\">";
							echo "<input type=\"file\" class=\"mytextbox3\" name=\"Other".$i."Name\" id=\"Other".$i."Name\" >";
						echo "</td>";
					echo "</tr>";
				
				}
				echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
				////////////////////////////////////////////////////
				////////////////////////////////////////////////////
				
				
				echo "<tr id=\"mysubtr\"  name=\"mysubtr\"><td colspan=\"3\" align=\"center\">";
					echo "<input type=\"button\" name=\"go\" class=\"Submit_Button_Long_Long\" value=\"Add Bridge\" onclick=\"checkOnSubmit()\">";
				echo "</td></tr>";
				
				
				echo "<tr id=\"mysublasttr\"  name=\"mysublasttr\"><td colspan=\"3\" align=\"left\">";
					echo "<font class\"bodytextred\" color=\"red\"><b>Are you sure you want save the bridge ?</b></font>";
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