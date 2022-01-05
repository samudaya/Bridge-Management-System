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
	echo"<br /> <br />";
	echo "<p class=\"hx1\">Risk Analysis</p>";
	

	//	Save data to data base.........
			
	$query_ea		= "select * from bms_inspection3headerdatas where bridgeprofile_BridgeProfileID = ".$BridgeProfileID;		
	$result_fac		= mysql_query($query_ea) or die (mysql_error());
	$CurrentDate	= date("Y-m-d");
	
		if(mysql_num_rows($result_fac) == 0)
		{
			echo "<p  class=\"bodytext\">";
				echo "<strong>No Inspection Reports were found for given details!</strong>";
			echo "</p>";
		}			
		else
		{
			echo "<table>";		
				echo "<tr bgcolor=\"#CFEBFA\" align=\"center\">";
			
					echo "<td class=\"myth\" align=\"center\">";
						echo "<strong>Inspection Date</strong>";
					echo "</td>";
				
					echo "<td class=\"myth\"  height=\"36\"   width=\"250\" align=\"center\">";
						echo "<strong>Next Inspection Date</strong>";
					echo "</td>";

					echo "<td class=\"myth\"  height=\"36\"   width=\"250\" align=\"center\">";
						echo "<strong>Next Inspection Due</strong>";
					echo "</td>";
					
				echo "</tr>";
			
			$temp = 0;	
			while($row_fac = mysql_fetch_array($result_fac))
			{

				$Inspection3HeaderDataID= $row_fac['Inspection3HeaderDataID'];
				$InspectionDate			= $row_fac['InspectionDate'];
				$NextInspectionDate		= $row_fac['NextInspectionDate'];
				
				echo "<tr>";
				$temp++;
				if($temp%2 == 0)
				{
					echo "<td class=\"mytd\" align=\"center\">";
				}
				else
				{
					echo "<td class=\"altmytd\" align=\"center\">";				
				}
					echo $InspectionDate;
				echo "</td>";
				
				if($temp%2 == 0)
				{
					echo "<td class=\"mytd\" align=\"center\">";
				}
				else
				{
					echo "<td class=\"altmytd\" align=\"center\">";				
				}
					echo $NextInspectionDate;
					echo "</td>";
				
				if($temp%2 == 0)
				{
					echo "<td class=\"mytd\" align=\"center\">";
				}
				else
				{
					echo "<td class=\"altmytd\" align=\"center\">";				
				}
					if($NextInspectionDate < $CurrentDate)
					{
						echo "<font color=\"#FF3030\">Inspection Report is Delayed</font>";
					}
					else
					{
						echo "Inspection Report is Due";
					}
		
					echo "</td>";	
				echo "</tr>";
			}
			echo "</table>";	
		}
	echo "</body>";

?>