<?php
	session_start();
	include ("../global.php");
	
	
	echo "<head>";

	echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"../common/common.css\" />";
	echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"../lib/jquery/cal/cal.css\" />";
		
	
?>

		
	<link href="../lib/jquery/development-bundle/themes/base/jquery.ui.all.css" rel="stylesheet" type="text/css"/>
	<script src="../lib/jquery/js/jquery-1.5.1.min.js"></script>
	<script src="../lib/jquery/js/jquery-ui-1.8.12.custom.min.js"></script>
	<script type="text/javascript" src="../lib/jquery/cal/cal.js"></script> 

</head>


<?php	

	echo "<body autocomplete=\"off\" >";
	echo "<br /><br />";
	echo "<p class=\"hx1\">Risk Analysis</p>";
	

	//	Save data to data base.........
			
			$BridgeProfileID 			= $_SESSION['BridgeProfileID'];
			$Inspection3HeaderDataID 	= $_SESSION['Inspection3HeaderDataID'];
			
			////////////////////////////////////////////////////////////////////////////
			///////////////// Risk Calculation /////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////////

			$ProbabilityOfConcequence = 0;
			$ProbabilityOfFaliure	= 0;
			$query_ea		= "select * from bms_bridgeprofiles where BridgeProfileID = ".$BridgeProfileID;		
			$result_fac		= mysql_query($query_ea) or die (mysql_error());
			while($row_fac	= mysql_fetch_array($result_fac))
			{
				$StructureID  	= $row_fac['StructureID'];
				$BridgeName		= $row_fac['BridgeName'];
				
				$HumanFactor		= $row_fac['AADT'];
				$TrafficDetour		= $row_fac['Detours'];
				$EconomicsFactor	= $row_fac['economicsfactors_EconomicsFactorID'];
				$LoadingFactor		= $row_fac['loadingfactors_LoadingFactorID'];
				$RoadClass			= $row_fac['roadclasses_RoadClassID'];
			}

			///////////////// ************************ ////////////////////////////////
			
			$ProbabilityOfConcequence = ($HumanFactor * $TrafficDetour * $EconomicsFactor * $RoadClass) / $ProbalilityOfConsequencesFactor;
			
			///////////////// ************************ ////////////////////////////////
			
			$query_select_com = "select * from bms_inspection3stconinsdatas where bms_inspection3headerdatas_Inspection3HeaderDataID = \"".$Inspection3HeaderDataID."\" ";
			$result_select_com = mysql_query($query_select_com) or die (mysql_error());
			$IntemediatTotal_1 = 0;
			$IntemediatTotal_2 = 0;
			$Count = mysql_num_rows($result_select_com);
			while($row_select_com	= mysql_fetch_array($result_select_com)){
				$ExporsureClass = $row_select_com['ExporsureClass'];
				$ResistanceClass = $row_select_com['ImportanceFactor'];
				$Inspection3StcompMatrixID_CM = $row_select_com['bms_inspection3stcompmatrix_Inspection3StcompMatrixID_CM'];
				
				if($row_select_com['QuantityConState_4'] == "1"){
					$ConditionFactor = 4;
				}else if($row_select_com['QuantityConState_3'] == "1"){
					$ConditionFactor = 3;
				}else if($row_select_com['QuantityConState_2'] == "1"){
					$ConditionFactor = 2;
				}else{
					$ConditionFactor = 1;
				}
				
				$SignificanceRating = 0;
				$query_cea		= "select * from bms_inspection3stcompmatrix where Inspection3StcompMatrixID =".$Inspection3StcompMatrixID_CM;		
				$result_cea		= mysql_query($query_cea) or die (mysql_error());
				while($row_cea	= mysql_fetch_array($result_cea))
				{
					if($row_cea['SignificanceRating'] > 0){
						$SignificanceRating			= $row_cea['SignificanceRating'];
					}
				}
				
				$IntemediatProduct_1 = ($ResistanceClass * $ExporsureClass * $SignificanceRating) / $Count;
				$IntemediatTotal_1 = $IntemediatTotal_1 + $IntemediatProduct_1;
				
				$IntemediatProduct_2 = ($ResistanceClass * $ConditionFactor * $SignificanceRating) / $Count;
				$IntemediatTotal_2 = $IntemediatTotal_2 + $IntemediatProduct_2;

				
			}
			
			///////////////// ************************////////////////////////////////
			
			$ProbabilityOfFaliure = ($LoadingFactor * $IntemediatTotal_1 * $IntemediatTotal_2) / $ProbalilityOfFailureFactor; 
			
			///////////////// ************************////////////////////////////////
			
			$RiskNumber = $ProbabilityOfFaliure * $ProbabilityOfConcequence;
			
			///////////////// ************************////////////////////////////////
			
			$query_valm	= "select * from bms_inspection3headerdatas where Inspection3HeaderDataID =".$Inspection3HeaderDataID;
			$result_valm	= mysql_query($query_valm) or die (mysql_error());
			while($row_valm	= mysql_fetch_array($result_valm))
			{
				$InspectionDate  	= $row_valm['InspectionDate'];
				$NextInspectionDate	= $row_valm['NextInspectionDate'];
				$Level2Inspection	= $row_valm['Level2Inspection'];
				$GeneralComment		= $row_valm['GeneralComment'];
			}
			
			
			
			
			
			////////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////////
			echo "
			<table>
				<tr>			
					<td class=\"mytd\" width=\"250\"><b>Structure ID of the Bridge</b></td>
					";
						echo "<td  class=\"mytd\" width=\"350\">";					
						
						echo $StructureID;
											
					echo "</td>";
					echo "			
				</tr>	
				<tr>			
					<td class=\"mytd\" ><b>Name of the Bridge</b></td>
					";
						echo "<td  class=\"mytd\">";					
						
						echo $BridgeName;
											
					echo "</td>";
					echo "			
				</tr>	
				<tr>			
					<td class=\"mytd\" ><b>Date of Inspection</b></td>
					";
						echo "<td  class=\"mytd\">";					
						
						echo $InspectionDate;
											
					echo "</td>";
					echo "			
				</tr>						
				
				<tr>			
					<td class=\"mytd\" ><b>Date of next Inspection</b></td>
					";
						echo "<td  class=\"mytd\">";					
						
						echo $NextInspectionDate;
						
					echo "</td>";
					echo "			
				</tr>

				<tr>			
					<td class=\"mytd\" ><b>Level 2 Inspection</b></td>
					<td class=\"mytd\">";
					
						if($Level2Inspection == "e")
						{
							echo "Exceptional";
						}
						else if($Level2Inspection == "p")
						{
							echo "Programmed";
						}
						else
						{
							echo "Underwater";
						}
						echo "
					</td>			
				</tr>	
				<tr>
					<td class=\"myth\" colspan=\"2\">&nbsp</td>
				</tr>
				<tr>			
					<td class=\"mytd\" ><b>Probability of Risk</b></td>
					<td  class=\"mytd\">";
						echo number_format($RiskNumber,10);
						echo "
					</td>	
				</tr>	
				<tr>			
					<td class=\"mytd\" ><b>Risk Percentage </b></td>
					<td  class=\"mytd\">";
						$Percentage = $RiskNumber * 100;
						echo number_format($Percentage,8)."%";
						echo "
					</td>	
				</tr>
				<tr>
					<td>
					&nbsp
					</td>
				</tr>
				
			</table>";
		
	echo "</table>";
	echo "</body>";

?>