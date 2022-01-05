<?php
	@session_start();
	include ("../global.php");
	$BridgeProfileID = $_SESSION['BridgeProfileID'];
	
	echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"../common/common.css\" />";

	echo "<br /><br /><h2>Bridge Information Report</h2><br /><br />";

	$query_bsr_resource = "select * from bms_bridgeprofiles where BridgeProfileID= '".$BridgeProfileID."' ";        
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
	$c= array();
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
	
	

	
	if($_POST['BridgeProfileIDX'] > 0)
		$BridgeProfileID	= $_POST['BridgeProfileIDX'];

	?>
	

		<?php
			$FuncOfBridgeID = 0;
			echo "<hr>";
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
					if($owners_OwnerID != "0"){
						
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
					}else{
						echo "Unspecified";
					}

				echo "</td>";
				echo "
				
				</tr>

				
				
				<tr>
				
				<td class=\"mytd\">Road Name</td>
				";
					echo "<td  class=\"mytd\">";
					if($roadnames_RoadNameID != "0"){
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
						}else{
							echo "Unspecified";
						}
				echo "</td>";
				echo "
				
				</tr>
				
				<tr>
				
				<td class=\"mytd\">Road Number</td>
				";
					echo "<td  class=\"mytd\">";
					if($routenos_RouteNoID != "0"){
					
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
						}else{
							echo "Unspecified";
						}
					
				echo "</td>";
				echo "
				
				</tr>
				
				<tr>
				
				<td class=\"mytd\">Road Class</td>
				";
					echo "<td  class=\"mytd\">";
					if($roadclasses_RoadClassID != "0"){
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
						}else{
							echo "Unspecified";
						}
					
				echo "</td>";
				echo "
				
				</tr>
				
				<tr>			
				<td class=\"mytd\" width=\"285\">Function of the Bridge</td>
				";
					echo "<td  class=\"mytd\">";
					if($funcofbridges_FuncOfBridgeID != "0"){
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
						}else{
							echo "Unspecified";
						}
					
				echo "</td>";
				echo "			
				</tr>";
				
				
				
				if($funcofbridges_FuncOfBridgeID == 1){
					echo "
					<tr name=\"div_nriver\" id=\"div_nriver\">			
						<td class=\"mytd\" >Name of the River</td>
						<td  class=\"mytd\">
								".$RiverName."
						</td>
					</tr>";
				}
				if($funcofbridges_FuncOfBridgeID == 2){
					echo "
					<tr name=\"div_nr\" id=\"div_nuproad\">
						<td class=\"mytd\">Name of the Road - UnderPass</td>
						<td class=\"mytd\">".$UnderPassRoad."</td>
						<td><span id=\"oname_id\" class=\"bodytextred\"></span></td>
					</tr>";
				}
				
				if($funcofbridges_FuncOfBridgeID == 3){
					echo "
					<tr name=\"div_nr\" id=\"div_noproad\">
						<td class=\"mytd\">Name of the Road - OverPass</td>
						<td class=\"mytd\">".$OverPassRoad."</td>
						<td><span id=\"oname_id\" class=\"bodytextred\"></span></td>
					</tr>";	
				}

				if($funcofbridges_FuncOfBridgeID == 5){
					echo "
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
					</tr>";
				}
				echo "
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
						if($structuretypes_StructureTypeID != "0"){
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
							}else{
								echo "Unspecified";
							}
					
					echo "</td>";
					echo "			
				</tr>
				
				
				
				<tr>			
					<td class=\"mytd\" >Construction Material</td>
					";
						echo "<td  class=\"mytd\">";
						if($constructionmaterials_ConstructionMaterialID != "0"){
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
							}else{
								echo "Unspecified";
							}
						
					echo "</td>";
					echo "			
				</tr>
				
				
				
				
				
				
				
				<tr>			
					<td class=\"mytd\" >Construction Year</td>
					";
						echo "<td  class=\"mytd\">";
						if($YearOfConstructionStart != "0"){
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
							}else{
								echo "Unspecified";
							}
						
					echo "</td>";
					echo "			
				</tr>
				
				
				
				<tr>			
					<td class=\"mytd\" >Operational Status</td>
					";
						echo "<td  class=\"mytd\">";
						if($operationalstatuses_OperationalStatusID != "0"){
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
								}
							}else{
								echo "Unspecified";
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
						if($district_DistrictID != "0"){
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
							}else{
								echo "Unspecified";
							}
						
					echo "</td>";
					echo "			
				</tr>
				
				
				<tr>			
					<td class=\"mytd\" width=\"285\">Province</td>
					";
						echo "<td  width=\"400\" class=\"mytd\">";
						if($provinces_ProvinceID != "0"){
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
							}else{
								echo "Unspecified";
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
					<td class=\"mytd\" >Length of Bridge (m)</td>
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
			
			
		
		echo "<br /><br /><hr><br /><br />";
			
			
			echo "<p class=\"bodytextbold\"><u>Structure Information</u></p>";
			
		
			echo "<table class=\"bodytext\">
			
				<tr>			
					<td class=\"mytd\" width=\"285\">Design Standard</td>
					";
						echo "<td  class=\"mytd\" width=\"400\">";
						if($designstandards_DesignStandardID != "0"){
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
							}else{
								echo "Unspecified";
							}
						
					echo "</td>";
					echo "			
				</tr>";
				
				
				
				echo "	
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
							for($myj=0; $myj<=30; $myj++)
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
							for($myk=0; $myk<=30; $myk++)
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
					<td class=\"mytd\" width=\"285\">Loading Factor</td>
					";
						echo "<td  class=\"mytd\">";
						$query_dis	= "select * from bms_loadingfactors order by LoadingFactorID";
						$result_dis		= mysql_query($query_dis) or die (mysql_error());

							while($row_dis	= mysql_fetch_array($result_dis))
							{
							
								$LoadingFactorID 	= $row_dis['LoadingFactorID'];
								$LoadingFactorName	= $row_dis['LoadingFactorName'];
								if($loadingfactors_LoadingFactorID == $LoadingFactorID)
								{
									echo $LoadingFactorName;
								}
							}
					echo "</td>";
					echo "			
				</tr>
				
				
				<tr>			
					<td class=\"mytd\" >Human Factor (AADT)</td>
					";
						echo "<td  class=\"mytd\">";
						if($AADT == "1"){
							echo "0-1000";
						}else if($AADT == "2"){
							echo "1000-5000";
						}else if($AADT == "3"){
							echo "5000-10000";
						}else{
							echo ">10000";
						}
					echo "</td>";
					echo "			
				</tr>
				<tr>			
					<td class=\"mytd\" >Traffic Access Detour (Km)</td>
					";
						echo "<td  class=\"mytd\">";
						if($Detours == "1"){
							echo "0-10";
						}else if($Detours == "2"){
							echo "10-20";
						}else if($Detours == "3"){
							echo "20-50";
						}else if($Detours == "4"){
							echo "50-100";
						}elseif($Detours == "5"){
							echo ">100";
						}
					echo "</td>";
					echo "			
				</tr>
				
				
				<tr>			
					<td class=\"mytd\" >Heavy Vehicle (HV)</td>
					";
						echo "<td  class=\"mytd\">";
						echo $HeavyVehicle;
					echo "</td>";
					echo "			
				</tr>
										
			</table>";
			
			
		
		echo "<p class=\"bodytextbold\"><br /><u>Utilities</u></p>";
			
		
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
						if($attachmentslocations_AttachmentsLocationsID != "0"){
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
							}else{
								echo "Unspecified";
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
		
			echo "<br /><br /><hr><br /><br />";
			
			
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
					<td >&nbsp;</td><td >&nbsp;</td>
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
					<td >&nbsp;</td><td >&nbsp;</td>
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
				</tr>";
				
				
				
				echo "
				
				<tr>			
					<td >&nbsp;</td><td >&nbsp;</td>
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
					<td >&nbsp;</td><td >&nbsp;</td>
				</tr>
				
				<tr>			
					<td class=\"mytd\" >Span Type</td>
					";
						echo "<td  class=\"mytd\">";
						if($spantypes_SpanTypeID != "0"){
							$query_dis	= "select * from bms_spantypes order by SpanType";
							$result_dis		= mysql_query($query_dis) or die (mysql_error());

								while($row_dis	= mysql_fetch_array($result_dis))
								{
									$SpanTypeID 	= $row_dis['SpanTypeID'];
									$SpanType	= $row_dis['SpanType'];
									if($spantypes_SpanTypeID  == $SpanTypeID)
									{
										echo $SpanType;
									}
									else
									{
									}
								}
							}else{
								echo "Unspecified";
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
					<td >&nbsp;</td><td >&nbsp;</td>
				</tr>
				
				<tr>			
					<td class=\"mytd\" >Approach Safety Barrier Type</td>
					";
						echo "<td  class=\"mytd\">";
						if($structuretypes_StructureTypeID != "0"){
							$query_dis	= "select * from bms_barriertypes order by BarrierType";
							$result_dis		= mysql_query($query_dis) or die (mysql_error());
								while($row_dis	= mysql_fetch_array($result_dis))
								{
								
									$BarrierTypeID 	= $row_dis['BarrierTypeID'];
									$BarrierType	= $row_dis['BarrierType'];
									if($barriertypes_ASBarrierTypeID == $BarrierTypeID)
									{
										echo $BarrierType;
									}
									else
									{
									}
								}
							}else{
								echo "Unspecified";
							}
					echo "</td>";
					echo "			
				</tr>
				
				
				
				
				
				
				<tr>			
					<td class=\"mytd\" >Approach Safety Barrier Location</td>
					";
						echo "<td  class=\"mytd\">";
						if($barrierlocations_ASBarrierLocationsID != "0"){
							$query_dis	= "select * from bms_barrierlocations";
							$result_dis		= mysql_query($query_dis) or die (mysql_error());
								while($row_dis	= mysql_fetch_array($result_dis))
								{
								
									$BarrierLocationsID 	= $row_dis['BarrierLocationsID'];
									$BarrierLocations	= $row_dis['BarrierLocations'];
									if($barrierlocations_ASBarrierLocationsID == $BarrierLocationsID)
									{
										echo $BarrierLocations;
									}
									else
									{
										
									}
								}
							}else{
								echo "Unspecified";
							}
					echo "</td>";
					echo "			
				</tr>	
				
				
					
				
			</table>";	
			
		
			echo "<br /><br /><hr><br /><br />";
			
			
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
					<td class=\"mytd\"  width=\"285\">Initial Signed Clearance (m)</td>
					";
						echo "<td  class=\"mytd\" width=\"400\">";
						echo $InitialSignedClearance;
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
					<td class=\"mytd\" >Highest flood level Date</td>
					";
						echo "<td  class=\"mytd\">";
						echo $HighestFloodLevelDate;
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
						<td class=\"mytd\"  width=\"285\">Height from invert to bridge underside (m)</td>
						";
							echo "<td  class=\"mytd\" width=\"400\">";
							echo $HeightInvertBridgeUnderside;
						echo "</td>";
						echo "			
					</tr>
					
					<tr>			
						<td class=\"mytd\"  width=\"285\">Initial Signed Clearance (m)</td>
						";
							echo "<td  class=\"mytd\" width=\"400\">";
							echo $InitialSignedClearance;
						echo "</td>";
						echo "			
					</tr>
					
				</table>";
				
				
				
				
				
				
				
			
		
			echo "<br /><br /><hr><br /><br />";

			
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
					
					
					
					for($i=1; $i<=sizeof($spanmaterials_SpanMaterialID_spgrou); $i++)
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
								
								echo $spantypes_SpanTypeID_spgroup[$i];
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



							<td class=\"mytd\" width=\"115\" align=\"left\">";
								if($comment_spgroup[$i] == "o")
									echo "Original";
								else
									echo "Widened";
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
					
					
					
					for($i=1; $i<=sizeof($deckmaterials_DeckMaterialID_deck); $i++)
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
						
						
						<td class=\"mytd\" width=\"115\" align=\"left\">";
							
								if($comment_deck[$i] == "o")
									echo "Original";
								else
									echo "Widened";								
							echo "</td>
							
						</tr>
						";
						
						
					}				
			echo "</table>";
			
					
			
			
			echo "<p class=\"bodytextbold\"><br /><u>Barrier</u></p>";		
		
			echo "<table class=\"bodytext\">
				<tr>			
					<td class=\"mytd\" width=\"285\">Type</td>";
					echo "<td  class=\"mytd\" width=\"400\">";					
						$query_disx		= "select * from bms_barriertypes order by BarrierType";
						$result_disx	= mysql_query($query_disx) or die (mysql_error());
						while($row_disx	= mysql_fetch_array($result_disx))
						{
						
							$xBarrierTypeID 	= $row_disx['BarrierTypeID'];
							$xBarrierType 	= $row_disx['BarrierType'];
							if($xBarrierTypeID == $SuperStructure_barriertypes)
							{
								echo $xBarrierType;
							}
						}
					echo "</td>";
					echo "			
				</tr>
				
				
				<tr>			
					<td class=\"mytd\" >Number</td>
					";
						echo "<td  class=\"mytd\">";
							echo $SuperStructure_BarrierNumber;
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
									while($row_dis	= mysql_fetch_array($result_dis))
									{
									
										$ParapetTypeID 	= $row_dis['ParapetTypeID'];
										$ParapetType	= $row_dis['ParapetType'];
										if($ParapetLeftParapetTypeID == $ParapetTypeID)
										{
											echo $ParapetType;
										}
										else
										{
										}
									}
								echo "</select>";
							echo "</td>
							
							
							
							<td class=\"mytd\" width=\"115\">";
								echo $ParapetLeftLenth; 
							echo "
							</td>							
						</tr>";
						
						
						
						
						echo "<tr>			
							<td class=\"mytd\" width=\"115\">
								Right						
							</td>
							
							
							
							<td class=\"mytd\" width=\"115\">";
								$query_dis	= "select * from bms_parapettypes";
								$result_dis		= mysql_query($query_dis) or die (mysql_error());
									while($row_dis	= mysql_fetch_array($result_dis))
									{
									
										$ParapetTypeID 	= $row_dis['ParapetTypeID'];
										$ParapetType	= $row_dis['ParapetType'];
										if($ParapetRIghtParapetTypeID == $ParapetTypeID)
										{
											echo $ParapetType;
										}
										else
										{
										}
									}
								echo "</select>";
							echo "</td>
							
							
							
							<td class=\"mytd\" width=\"115\">";
								echo $ParapetRIghtLenth;
							echo "
							</td>							
						</tr>";
						
									
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
				
				
			
			
			echo "<br /><br /><hr><br /><br />";

			
			echo "<p class=\"bodytextbold\"><u>Piers</u></p>";
			
				echo "<table class=\"bodytext\">
					<tr>			
						<td class=\"myth\" width=\"115\">Pier</td>					
						<td class=\"myth\" width=\"200\">Material</td>
						<td class=\"myth\" width=\"200\">Type</td>
						<td class=\"myth\" width=\"200\">Thickness at Capping Level (m)</td>
					</tr>";
					
					
					
					for($i=1; $i<=sizeof($piermaterials_PierMaterialID_sub_pier); $i++)
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
				<tr>			
					<td class=\"mytd\" width=\"115\">Material</td>
					";
						echo "<td  class=\"mytd\">";
						$query_dis	= "select * from bms_bearingmaterials order by BearingMaterial";
						$result_dis		= mysql_query($query_dis) or die (mysql_error());
							while($row_dis	= mysql_fetch_array($result_dis))
							{
							
								$BearingMaterialID 	= $row_dis['BearingMaterialID'];
								$BearingMaterial	= $row_dis['BearingMaterial'];
								if($bearingtypes_BearingMaterialID == $BearingMaterialID)
								{
									echo $BearingMaterial;
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
						<td class=\"myth\" width=\"200\">Comments</td>
					</tr>";
					
					
					
					
					
					
					for($i=1; $i<=sizeof($piermaterials_PierMaterialID_foun_pier); $i++)
					{
						echo "<tr name=\"foun_pier_".$i."\" id=\"foun_pier_".$i."\">			
							<td class=\"mytd\" width=\"115\">
								Pier - ".$i."						
							</td>
							
							
							
							<td class=\"mytd\" width=\"115\">";
								$query_dis	= "select * from bms_pierfoundationmaterials order by PierFoundationMaterial ";
								$result_dis		= mysql_query($query_dis) or die (mysql_error());
									while($row_dis	= mysql_fetch_array($result_dis))
									{
									
										$PierMaterialID 	= $row_dis['PierFoundationMaterialID'];
										$PierMaterial	= $row_dis['PierFoundationMaterial'];
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
								$query_dis	= "select * from bms_pierfoundationtypes order by PierFoundationType";
								$result_dis		= mysql_query($query_dis) or die (mysql_error());
									while($row_dis	= mysql_fetch_array($result_dis))
									{
									
										$PierTypeID 	= $row_dis['PierFoundationTypeID'];
										$PierType 	= $row_dis['PierFoundationType'];
										if($piertypes_PierTypeID_foun_pier[$i] == $PierTypeID)
										{
											echo $PierType;
										}
										else
										{
										}
									}
								
							echo "</td>	
							<td class=\"mytd\" width=\"115\">
								".$pierComments_foun_pier[$i]."						
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
									while($row_dis	= mysql_fetch_array($result_dis))
									{
									
										$AbutmentFoundationMaterialID 	= $row_dis['AbutmentFoundationMaterialID'];
										$AbutmentFoundationMaterial	= $row_dis['AbutmentFoundationMaterial'];
										if($abutmentmaterials_AbutmentMaterialID_foun_abunt[$i] == $AbutmentFoundationMaterialID)
										{
											echo $AbutmentFoundationMaterial;
										}
										else
										{
										}
									}
								
							echo "</td>
							
							
							<td class=\"mytd\" width=\"115\">";
								$query_dis	= "select * from bms_abutmentfoundationtypes order by AbutmentFoundationType";
								$result_dis		= mysql_query($query_dis) or die (mysql_error());
									while($row_dis	= mysql_fetch_array($result_dis))
									{
									
										$AbutmentFoundationTypeID 	= $row_dis['AbutmentFoundationTypeID'];
										$AbutmentType 	= $row_dis['AbutmentFoundationType'];
										if($abutmenttypes_SpanTypeID_foun_abunt[$i] == $AbutmentFoundationTypeID)
										{
											echo $AbutmentType;
										}
										else
										{
										}
									}
								
							echo "</td>	
							<td class=\"mytd\" width=\"115\">
								".$abutmentComments_foun_abunt[$i]."						
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
							<td class=\"mytd\" width=\"115\">
								".$wingComments_foun_ww[$i]."						
							</td>
											
						</tr>";
					}				
			echo "</table>";	
		
			echo "<br /><br /><hr><br /><br />";
			
			
			echo "<p class=\"bodytextbold\"><u>Structure Environment</u></p>";
			
				echo "<table class=\"bodytext\" >
			
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
				
				";
			
				echo "	
				
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
			
			
			echo "<br /><br /><hr><br /><br />";
			
			
			echo "<p class=\"bodytextbold\"><u>File Attachments</u></p>";
			
				echo "<table class=\"bodytext\">";
				
				$query_check = "select CadDesign1Name from bms_bridgeprofileattachments where bridgeprofile_BridgeProfileID = '".$BridgeProfileID."' ";
				$result_check =  mysql_query($query_check) or die (mysql_error());
				while($row_check	= mysql_fetch_array($result_check)){
					if($row_check['CadDesign1Name'] != ""){
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
						
						//For file attchement outside Document Root
						$_SESSION['filepathx'] = array();
						$_SESSION['fileidx'] = array();				
						$myfilepathi = 0;
						
						for($i=1; $i <= 5; $i++)
						{
						
							$myfilepathi++;
							$query_check = "select CadDesign".$i."Name  from bms_bridgeprofileattachments where bridgeprofile_BridgeProfileID = '".$BridgeProfileID."' ";
							$result_check =  mysql_query($query_check) or die (mysql_error());
							while($row_check	= mysql_fetch_array($result_check)){
								$name = $row_check['CadDesign'.$i.'Name'];
							}
							
							if($name == ""){
								continue;
							}
									
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
							
									
									$_SESSION['filepathx'][$myfilepathi]	= $datadir."dwg/";
									$_SESSION['fileidx'][$myfilepathi]	= $BridgeProfileID."-".$i.".dwg";
									
									
									if($name == ""){
										echo "--";
									}else{
									
										echo "<a href=\"../download.php?id=".$myfilepathi."\" target=\"_blank\">".$$x."</a>";
									}

								echo "</td>";
							echo "</tr>";
						
						}
					}
				}
				
				echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
				////////////////////////////////////////////////////
				////////////////////////////////////////////////////
				
				$query_check = "select Drawing1Name from bms_bridgeprofileattachments where bridgeprofile_BridgeProfileID = '".$BridgeProfileID."' ";
				$result_check =  mysql_query($query_check) or die (mysql_error());
				while($row_check	= mysql_fetch_array($result_check)){
					if($row_check['Drawing1Name'] != ""){
				
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
							$myfilepathi++;
							$query_check = "select Drawing".$i."Name  from bms_bridgeprofileattachments where bridgeprofile_BridgeProfileID = '".$BridgeProfileID."' ";
							$result_check =  mysql_query($query_check) or die (mysql_error());
							while($row_check	= mysql_fetch_array($result_check)){
								$name = $row_check['Drawing'.$i.'Name'];
							}
							if($name == ""){
								continue;
							}
							
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
									//$filepath	= '';
									
									
									
									$_SESSION['filepathx'][$myfilepathi]	= $datadir."pdf/";
									$_SESSION['fileidx'][$myfilepathi]	= $BridgeProfileID."-".$i.".pdf";
									if($name == ""){
										echo "--";
									}else{
										echo "<a href=\"../download.php?id=".$myfilepathi."\" target=\"_blank\">".$$x."</a>";
									}
									
								echo "</td>";
							echo "</tr>";
						
						}
					}
				}
				
				echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
				////////////////////////////////////////////////////
				////////////////////////////////////////////////////
				
				
				
				////////////////////////////////////////////////////
				////////////////////////////////////////////////////
				
				$query_check = "select Image1Name from bms_bridgeprofileattachments where bridgeprofile_BridgeProfileID = '".$BridgeProfileID."' ";
				$result_check =  mysql_query($query_check) or die (mysql_error());
				while($row_check	= mysql_fetch_array($result_check)){
					if($row_check['Image1Name'] != ""){
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
							$myfilepathi++;
							$query_check = "select Image".$i."Name  from bms_bridgeprofileattachments where bridgeprofile_BridgeProfileID = '".$BridgeProfileID."' ";
							$result_check =  mysql_query($query_check) or die (mysql_error());
							while($row_check	= mysql_fetch_array($result_check)){
								$name = $row_check['Image'.$i.'Name'];
							}
							if($name == ""){
								continue;
							}
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
									//$filepath	= '';
									
									
									
									$_SESSION['filepathx'][$myfilepathi]	= $datadir."jpg/";
									$_SESSION['fileidx'][$myfilepathi]	= $BridgeProfileID."-".$i.".jpg";
									
									if($name == ""){
										echo "--";
									}else{
										echo "<a href=\"../download.php?id=".$myfilepathi."\" target=\"_blank\">".$$x."</a>";
									}
									
								echo "</td>";
							echo "</tr>";
						
						}
					}
				}
				////////////////////////////////////////////////////
				////////////////////////////////////////////////////
				
				echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
				
				////////////////////////////////////////////////////
				////////////////////////////////////////////////////
				$query_check = "select Other1Name from bms_bridgeprofileattachments where bridgeprofile_BridgeProfileID = '".$BridgeProfileID."' ";
				$result_check =  mysql_query($query_check) or die (mysql_error());
				while($row_check	= mysql_fetch_array($result_check)){
					if($row_check['Other1Name'] != ""){
					
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
							$myfilepathi++;
							$query_check = "select Other".$i."Name  from bms_bridgeprofileattachments where bridgeprofile_BridgeProfileID = '".$BridgeProfileID."' ";
							$result_check =  mysql_query($query_check) or die (mysql_error());
							while($row_check	= mysql_fetch_array($result_check)){
								$name = $row_check['Other'.$i.'Name'];
								$ext = substr($name, strrpos($name, '.') + 1);
								$lcase_ext = strtolower($ext);
							}
							if ($name==""){
								continue;
							}
							echo "<tr>			
								<td class=\"mytd\" width=\"185\">";
									echo "Other  - ". $i;
								echo "</td>";
								
								
								echo "<td  class=\"mytd\">";
									$x	= '';
									$x	= "Other".$i."Dis";
									echo $$x;
								echo "</td>";
								
								echo "<td  class=\"mytd\" align=\"center\">";
									$x	= '';
									$x	= "Other".$i."Name";
					
									
									
									$_SESSION['filepathx'][$myfilepathi]	= $datadir."other/";
									$_SESSION['fileidx'][$myfilepathi]	= $BridgeProfileID."-".$i.".".$lcase_ext;
									
									if($name == ""){
										echo "--";
									}else{
										echo "<a href=\"../download.php?id=".$myfilepathi."\"   target=\"_blank\">".$$x."</a>";
									}
									
									
								echo "</td>";
							echo "</tr>";
						
						}
					}
				}
				////////////////////////////////////////////////////
				////////////////////////////////////////////////////
			
			echo "</table>";
			
	
		echo "<br /><br /><br /><br />";
?>

