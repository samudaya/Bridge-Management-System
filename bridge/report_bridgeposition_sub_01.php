<?php

    session_start();
    include ("../global.php");
    
 
    echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"../common/common.css\" />";

    echo "<br /><br /><h2>Bridge Position Information Report </h2><br /><br />";
	
    
	if(isset($_SESSION['more']))
	{
		$BridgeProfileID 	= $_SESSION['BridgeProfileID'];
	}
	else
	{

		
		 $OperationalStatus	= $_SESSION['OperationalStatus'];
		 $District			= $_SESSION['District'];
		 $OwnerName			= $_SESSION['OwnerName'];
		 $FuncOfBridge		= $_SESSION['FuncOfBridge'];
		 $RoadClass			= $_SESSION['RoadClass'];
	
	
						
					
					
		$QueryOne ="SELECT * FROM bms_bridgeprofiles";
		$searcharray =array() ; 
		$arr_lenth = 0;
		
		if($District != "All")
		{
			$DistrictQ = "district_DistrictID = '".$District."' ";
			$searcharray [$arr_lenth] = $DistrictQ ;
			$arr_lenth++;
		}
		if($OwnerName != "All")
		{
			$OwnerNameQ = "owners_OwnerID = '".$OwnerName."' ";
			$searcharray [$arr_lenth] = $OwnerNameQ ;
			$arr_lenth++;
		}
		if($FuncOfBridge != "All")
		{
			$FuncOfBridgeQ = "funcofbridges_FuncOfBridgeID = '".$FuncOfBridge."' ";
			$searcharray [$arr_lenth] = $FuncOfBridgeQ ;
			$arr_lenth++;
		}
		if($RoadClass != "All")
		{
			$RoadClassQ = "roadclasses_RoadClassID = '".$RoadClass."' ";
			$searcharray [$arr_lenth] = $RoadClassQ ;
			$arr_lenth++;
		}
		
		
		if ($arr_lenth == 0)
		{
			$result_fac		= mysql_query($QueryOne) or die (mysql_error());
		}
		else
		{
			$a = 0;
			$add_part;
			while ($a < $arr_lenth)
			{
				if ($a == 0){
					$add_part = " WHERE ".$searcharray [$a]." ";
				}
				else {
					$add_part = $add_part."AND ".$searcharray [$a]." ";
				}
				$a++;
			}
			$arr_lenth = 0;
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
				echo "</tr>";
			
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
								$DistrictName	= $row_ea['District'];
							}
							
						echo $DistrictName;
					echo "</td>";
						
				echo "</tr>";
			}
			echo "</table>";
	
		}

    }        
?>
