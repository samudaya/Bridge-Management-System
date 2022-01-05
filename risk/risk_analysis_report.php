<?php
	session_start();
	include ("../global.php");
	include ("../top.php");

	
	
	
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
	
	echo "<p class=\"hx1\">Risk Analysis Report</p>";
	

	//	Save data to data base.........
			
	$CurrentDate	= date("Y-m-d");
	
	
	$StructureIDArray 		= array();
	$BridgeNameArray 		= array();
	$HumanFactorArray 		= array();
	$TrafficDetourArray 	= array();
	$EconomicsFactorArray 	= array();
	$LoadingFactorArray 	= array();
	$RoadClassArray 		= array();
	
	$Inspection3HeaderDataIDArray	= array();
	$InspectionDateArray			= array();
	$NextInspectionDateArray		= array();
	
	$ExporsureClassArray			= array();
	$ResistanceClassArray			= array();
	$ConditionFactorArray			= array();
	
	$ProbabilityOfConcequenceArray	= array();
	$RiskNumberArray				= array();
	$i = 0;
	
	$query_bridge = "select * from bms_bridgeprofiles";
	$result_bridge	= mysql_query($query_bridge) or die (mysql_error());
	while($row_bridge = mysql_fetch_array($result_bridge)){
		
		$ProbabilityOfConcequence = 0;
		$ProbabilityOfFaliure = 0;
		$BridgeProfileID   	= $row_bridge['BridgeProfileID'];
		$StructureID  		= $row_bridge['StructureID'];
		$BridgeName			= $row_bridge['BridgeName'];
		
		$HumanFactor		= $row_bridge['AADT'];
		$TrafficDetour		= $row_bridge['Detours'];
		$EconomicsFactor	= $row_bridge['economicsfactors_EconomicsFactorID'];
		$LoadingFactor		= $row_bridge['loadingfactors_LoadingFactorID'];
		$RoadClass			= $row_bridge['roadclasses_RoadClassID'];
		
	
		///////////////// ************************ ////////////////////////////////
		
		$ProbabilityOfConcequence = ($HumanFactor * $TrafficDetour * $EconomicsFactor * $RoadClass) / $ProbalilityOfConsequencesFactor;
		
		///////////////// ************************ ////////////////////////////////
		
		
		
		$query_ea		= "select * from bms_inspection3headerdatas where bridgeprofile_BridgeProfileID = ".$BridgeProfileID;		
		$result_fac		= mysql_query($query_ea) or die (mysql_error());
		$reportCount = mysql_num_rows($result_fac);
		while($row_fac = mysql_fetch_array($result_fac)){
			$Inspection3HeaderDataIDArray[$i]	= $row_fac['Inspection3HeaderDataID'];
			$InspectionDateArray[$i]			= $row_fac['InspectionDate'];
			$NextInspectionDateArray[$i]		= $row_fac['NextInspectionDate'];
			
			
			$StructureIDArray[$i]  		= $StructureID;
			$BridgeNameArray[$i]		= $BridgeName;
			
			
			$Count = 0;
			$query_select_com = "select * from bms_inspection3stconinsdatas where bms_inspection3headerdatas_Inspection3HeaderDataID = \"".$Inspection3HeaderDataIDArray[$i]."\" ";
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
			
			///////////////// ************************ ////////////////////////////////
			
			$ProbabilityOfFaliure = ($LoadingFactor * $IntemediatTotal_1 * $IntemediatTotal_2) / $ProbalilityOfFailureFactor; 
			
			///////////////// ************************ ////////////////////////////////
			
			$RiskNumber = $ProbabilityOfFaliure * $ProbabilityOfConcequence;
			$RiskNumberArray[$i] = $RiskNumber;
			///////////////// ************************ ////////////////////////////////
			
			$i++;
		} 
	}	
	
	
	echo "<table>";		
		echo "<tr bgcolor=\"#CFEBFA\" align=\"center\">";
	
			echo "<td class=\"myth\" align=\"center\">";
				echo "<strong>Structure ID</strong>";
			echo "</td>";
			
			echo "<td class=\"myth\" align=\"center\">";
				echo "<strong>Bridge Name</strong>";
			echo "</td>";
			
			echo "<td class=\"myth\" align=\"center\">";
				echo "<strong>Inspection Date</strong>";
			echo "</td>";
		
			echo "<td class=\"myth\"  height=\"36\"   width=\"250\" align=\"center\">";
				echo "<strong>Next Inspection Date</strong>";
			echo "</td>";

			echo "<td class=\"myth\"  height=\"36\"   width=\"250\" align=\"center\">";
				echo "<strong>Next Inspection Due</strong>";
			echo "</td>";
			
			echo "<td class=\"myth\" align=\"center\">";
				echo "<strong>Probability of Risk </strong>";
			echo "</td>";
			
			echo "<td class=\"myth\" align=\"center\">";
				echo "<strong>Risk Percentage</strong>";
			echo "</td>";
		echo "</tr>";
	
		arsort($RiskNumberArray);
		
		$temp = 0;	
		
		foreach($RiskNumberArray as $key => $value){
			
			echo "<tr>";
			$temp++;
			if($temp%2 == 0){
				$Class = "mytd";
			}else{
				$Class = "altmytd";				
			}
			echo "<td class=\"".$Class."\" align=\"center\">
				".$StructureIDArray[$key]."
			</td>
			<td class=\"".$Class."\" align=\"left\">
				".$BridgeNameArray[$key]."
			</td>
			<td class=\"".$Class."\" align=\"center\">
				".$InspectionDateArray[$key]."
			</td>
			<td class=\"".$Class."\" align=\"center\">
				".$NextInspectionDateArray[$key]."
			</td>
			<td class=\"".$Class."\" align=\"center\">";
				if($NextInspectionDateArray[$key] < $CurrentDate){
					echo "<font color=\"#FF3030\">Inspection Report is Delayed</font>";
				}else{
					echo "Inspection Report is Due";
				}					
			echo "<td class=\"".$Class."\" align=\"center\">
				".number_format($RiskNumberArray[$key],10)."
			</td>";
			echo "<td class=\"".$Class."\" align=\"center\">";
				$Percentage = $RiskNumberArray[$key] * 100;
				echo number_format($Percentage,8)."%";
				echo "
			</td>";
			echo "</tr>";
			
		}
		
	echo "</table>";	
	echo "
	<br />
	<table align=\"right\">
		<tr>
			<td>
				<a  target=\"_blank\" href=\"./risk_analysis_report_main_01.php\"><input type=\"button\" name=\"print\" value=\"Print\" class=\"Submit_Button_Long\"></a>
			</td>
		</tr>
	</table>";
	
	echo "</body>";
	include '../bottom.php';

?>