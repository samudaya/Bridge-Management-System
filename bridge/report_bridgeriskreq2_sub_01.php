<?php
	@session_start();
	include ("../global.php");
		$BridgeProfileID	= $_SESSION['BridgeProfileID'];
		$MainReq			= $_SESSION['MainReq'];
		$ConState			= $_SESSION['ConState'];
		$InReq				= $_SESSION['InReq'];
		$MonReq				= $_SESSION['MonReq'];
	
	echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"../common/common.css\" />";

	echo "<br /><br /><h2>Bridge Risk Report</h2><br /><br />";

	$MainReqarray 	= array();
		$ConStatearray 	= array(); 
		$InReqarray 	= array();
		$MonReqarray 	= array(); 
		
		$MainReqarraylength 	= 0;
		$ConStatearraylength 	= 0;
		$InReqarraylength 		= 0;
		$MonReqarraylength 		= 0;		
		
		if($MainReq != "All")
		{
			if($MainReq == "y")
			{ 
				$QueryMainReq ="SELECT DISTINCT bms_inspection3headerdatas_Inspection3HeaderDataID FROM bms_inspection3stconinsdatas where MaintainRequired = 'y'";
				$result_MainReq	= mysql_query($QueryMainReq) or die (mysql_error());
				while($row_MainReq = mysql_fetch_array($result_MainReq))
				{
					$Inspection3HeaderDataID = $row_MainReq['bms_inspection3headerdatas_Inspection3HeaderDataID'];
					$MainReqarray[$MainReqarraylength] = $Inspection3HeaderDataID;
					$MainReqarraylength++;
				}				
				
			}
			else if($MainReq == "n")
			{ 
				$QueryMainReq ="SELECT DISTINCT bms_inspection3headerdatas_Inspection3HeaderDataID FROM bms_inspection3stconinsdatas where MaintainRequired = 'n'";
				$result_MainReq	= mysql_query($QueryMainReq) or die (mysql_error());
				$num_rows_MainReq = mysql_num_rows($result_MainReq);
				while($row_MainReq = mysql_fetch_array($result_MainReq))
				{
					
					$Inspection3HeaderDataID = $row_MainReq['bms_inspection3headerdatas_Inspection3HeaderDataID'];
					$MainReqarray[$MainReqarraylength] = $Inspection3HeaderDataID;
					$MainReqarraylength++;
				}
			
			}
		
		}
		else
		{
				$QueryMainReq ="SELECT DISTINCT bms_inspection3headerdatas_Inspection3HeaderDataID FROM bms_inspection3stconinsdatas";
				$result_MainReq	= mysql_query($QueryMainReq) or die (mysql_error());
				$num_rows_MainReq = mysql_num_rows($result_MainReq);
				while($row_MainReq = mysql_fetch_array($result_MainReq))
				{
					
					$Inspection3HeaderDataID = $row_MainReq['bms_inspection3headerdatas_Inspection3HeaderDataID'];
					$MainReqarray [$MainReqarraylength] = $Inspection3HeaderDataID;
					$MainReqarraylength++;
				}
		
		}
		
		////////////////////////////////////////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////
		
		if($ConState != "All")
		{
			if($ConState == "1")
			{
				$QueryConState ="SELECT DISTINCT bms_inspection3headerdatas_Inspection3HeaderDataID FROM bms_inspection3stconinsdatas where QuantityConState_1 = '1'";
				$result_ConState  = mysql_query($QueryConState) or die (mysql_error());
				while($row_ConState = mysql_fetch_array($result_ConState))
				{
					$Inspection3HeaderDataID = $row_ConState['bms_inspection3headerdatas_Inspection3HeaderDataID'];
					$ConStatearray [$ConStatearraylength] = $Inspection3HeaderDataID;
					$ConStatearraylength++;
				}				
				
			}
			else if($ConState == "2")
			{
				$QueryConState ="SELECT DISTINCT bms_inspection3headerdatas_Inspection3HeaderDataID FROM bms_inspection3stconinsdatas where QuantityConState_2 = '1'";
				$result_ConState  = mysql_query($QueryConState) or die (mysql_error());
				while($row_ConState = mysql_fetch_array($result_ConState))
				{
					$Inspection3HeaderDataID = $row_ConState['bms_inspection3headerdatas_Inspection3HeaderDataID'];
					$ConStatearray [$ConStatearraylength] = $Inspection3HeaderDataID;
					$ConStatearraylength++;
				}
			
			}
			else if($ConState == "3")
			{
				$QueryConState ="SELECT DISTINCT bms_inspection3headerdatas_Inspection3HeaderDataID FROM bms_inspection3stconinsdatas where QuantityConState_3 = '1'";
				$result_ConState  = mysql_query($QueryConState) or die (mysql_error());
				while($row_ConState = mysql_fetch_array($result_ConState))
				{
					$Inspection3HeaderDataID = $row_ConState['bms_inspection3headerdatas_Inspection3HeaderDataID'];
					$ConStatearray [$ConStatearraylength] = $Inspection3HeaderDataID;
					$ConStatearraylength++;
				}
			}
			else if($ConState == "4")
			{
				$QueryConState ="SELECT DISTINCT bms_inspection3headerdatas_Inspection3HeaderDataID FROM bms_inspection3stconinsdatas where QuantityConState_4 = '1'";
				$result_ConState  = mysql_query($QueryConState) or die (mysql_error());
				while($row_ConState = mysql_fetch_array($result_ConState))
				{
					$Inspection3HeaderDataID = $row_ConState['bms_inspection3headerdatas_Inspection3HeaderDataID'];
					$ConStatearray [$ConStatearraylength] = $Inspection3HeaderDataID;
					$ConStatearraylength++;
				}
			}
		
		}
		else
		{
			$QueryConState ="SELECT DISTINCT bms_inspection3headerdatas_Inspection3HeaderDataID FROM bms_inspection3stconinsdatas";
			$result_ConState  = mysql_query($QueryConState) or die (mysql_error());
			while($row_ConState = mysql_fetch_array($result_ConState))
			{
				$Inspection3HeaderDataID = $row_ConState['bms_inspection3headerdatas_Inspection3HeaderDataID'];
				$ConStatearray [$ConStatearraylength] = $Inspection3HeaderDataID;
				$ConStatearraylength++;
			}
		
		}
		
		////////////////////////////////////////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////
		
		if($InReq != "All")
		{
			if($InReq == "y")
			{
				$QueryInReq ="SELECT DISTINCT bms_inspection3headerdatas_Inspection3HeaderDataID FROM bms_inspection3defcomdatas where Level3Inspection = 'y'";
				$result_InReq	= mysql_query($QueryInReq) or die (mysql_error());
				while($row_InReq = mysql_fetch_array($result_InReq))
				{
					$Inspection3HeaderDataID = $row_InReq['bms_inspection3headerdatas_Inspection3HeaderDataID'];
					$InReqarray [$InReqarraylength] = $Inspection3HeaderDataID;
					$InReqarraylength++;
				}				
				
			}
			else
			{
				$QueryInReq ="SELECT DISTINCT bms_inspection3headerdatas_Inspection3HeaderDataID FROM bms_inspection3defcomdatas where Level3Inspection = 'n'";
				$result_InReq	= mysql_query($QueryInReq) or die (mysql_error());
				while($row_InReq = mysql_fetch_array($result_InReq))
				{
					$Inspection3HeaderDataID = $row_InReq['bms_inspection3headerdatas_Inspection3HeaderDataID'];
					$InReqarray [$InReqarraylength] = $Inspection3HeaderDataID;
					$InReqarraylength++;
				}
			}
		}
		else
		{
			$QueryInReq ="SELECT DISTINCT bms_inspection3headerdatas_Inspection3HeaderDataID FROM bms_inspection3defcomdatas";
			$result_InReq	= mysql_query($QueryInReq) or die (mysql_error());
			while($row_InReq = mysql_fetch_array($result_InReq))
			{
				$Inspection3HeaderDataID = $row_InReq['bms_inspection3headerdatas_Inspection3HeaderDataID'];
				$InReqarray [$InReqarraylength] = $Inspection3HeaderDataID;
				$InReqarraylength++;
			}
		
		}
		
		////////////////////////////////////////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////
		
		if($MonReq != "All")
		{
			if($MonReq == "y")
			{
				$QueryMonReq ="SELECT DISTINCT bms_inspection3headerdatas_Inspection3HeaderDataID FROM bms_inspection3defcomdatas where Monitor = 'y'";
				$result_MonReq	= mysql_query($QueryMonReq) or die (mysql_error());
				while($row_MonReq = mysql_fetch_array($result_MonReq))
				{
					$Inspection3HeaderDataID = $row_MonReq['bms_inspection3headerdatas_Inspection3HeaderDataID'];
					$MonReqarray [$MonReqarraylength] = $Inspection3HeaderDataID;
					$MonReqarraylength++;
				}				
				
			}
			else
			{
				$MonReqarray =array(); 
				$QueryMonReq ="SELECT DISTINCT bms_inspection3headerdatas_Inspection3HeaderDataID FROM bms_inspection3defcomdatas where Monitor = 'n'";
				$result_MonReq	= mysql_query($QueryMonReq) or die (mysql_error());
				while($row_MonReq = mysql_fetch_array($result_MonReq))
				{
					$Inspection3HeaderDataID = $row_MonReq['bms_inspection3headerdatas_Inspection3HeaderDataID'];
					$MonReqarray [$MonReqarraylength] = $Inspection3HeaderDataID;
					$MonReqarraylength++;
				}
			
			}
		
		}
		else
		{
			$QueryMonReq ="SELECT DISTINCT bms_inspection3headerdatas_Inspection3HeaderDataID FROM bms_inspection3defcomdatas";
			$result_MonReq	= mysql_query($QueryMonReq) or die (mysql_error());
			while($row_MonReq = mysql_fetch_array($result_MonReq))
			{
				$Inspection3HeaderDataID = $row_MonReq['bms_inspection3headerdatas_Inspection3HeaderDataID'];
				$MonReqarray [$MonReqarraylength] = $Inspection3HeaderDataID;
				$MonReqarraylength++;
			}
		
		}
		
		$MainReqarrayN 	= array_unique($MainReqarray);
		$ConStatearrayN	= array_unique($ConStatearray);
		$InReqarrayN 	= array_unique($InReqarray);
		$MonReqarrayN 	= array_unique($MonReqarray);
		
		$result 	= array_intersect($MainReqarray, $ConStatearray, $InReqarray, $MonReqarray);
		
		$resultunique = array_unique($result);
		
		$QueryOnearray =array(); 
		$QueryOnearraylength = 0;
		foreach ($resultunique as $values)
		{
			$resultuniqueitem = $values;
			if($resultuniqueitem != ""){
				$QueryOne ="SELECT bridgeprofile_BridgeProfileID FROM bms_inspection3headerdatas where Inspection3HeaderDataID ='".$resultuniqueitem."' ";
				$resultQueryOne	= mysql_query($QueryOne) or die (mysql_error());
				$num_rowsQueryOne = mysql_num_rows($resultQueryOne);
				while($rowQueryOne = mysql_fetch_array($resultQueryOne))
				{
					$BridgeProfileIDQ = $rowQueryOne['bridgeprofile_BridgeProfileID'];
					$QueryOnearray [$QueryOnearraylength] = $BridgeProfileIDQ;
					$QueryOnearraylength++;	
				}
			}
		}
		
		$QueryOnearrayuniquerow = array_unique($QueryOnearray);
		$resultlengthonerow = sizeof($QueryOnearrayuniquerow);
		
		$QueryOnearrayunique = array();
		$i = 0;
		foreach($QueryOnearrayuniquerow as $value)
		{
			if($value != ""){
				$QueryOnearrayunique[$i] = $value;
				$i++;
			}
		}
		
		$resultlengthone = sizeof($QueryOnearrayunique);
		echo "<br />";
		if($resultlengthone == 0)
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

				echo "</tr>";
				
			for ($loopone = 0; $loopone < $resultlengthone; $loopone++)
			{
				if($QueryOnearrayunique[$loopone] != "")
				{
					$resultuniqueitemone = $QueryOnearrayunique[$loopone];
					$QueryOneface ="SELECT * FROM bms_bridgeprofiles where BridgeProfileID =".$resultuniqueitemone;
					$result_fac	= mysql_query($QueryOneface) or die (mysql_error());
			
					$temp = 0;	
					while($row_fac = mysql_fetch_array($result_fac))
					{
						$BridgeProfileID		= $row_fac['BridgeProfileID'];
						$StructureID			= $row_fac['StructureID'];
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
								
						echo "</tr>";
					}
				}
			}
		}				
		echo "</table>";
	
?>

