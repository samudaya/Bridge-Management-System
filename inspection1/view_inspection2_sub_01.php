<?php
	@session_start();
	include ("../global.php");
	
	echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"../common/common.css\" />";
	
	echo "<br /><br /><h2>Bridge Inspection Report 1 - B<br /><br />(Photos and Sketches)</h2><br /><br />";
	
	if(isset($_SESSION['more']) and $_SESSION['more']=="more"){
		$BridgeProfileID 			= $_SESSION['BridgeProfileID'];
		$Inspection2HeaderDataID 	= $_SESSION['Inspection2HeaderDataID'];
		
		$query_ea		= "select * from bms_bridgeprofiles where BridgeProfileID = ".$BridgeProfileID;		
			$result_fac		= mysql_query($query_ea) or die (mysql_error());
			while($row_fac	= mysql_fetch_array($result_fac))
			{
				$StructureID  	= $row_fac['StructureID'];
				$BridgeName		= $row_fac['BridgeName'];
			}

			$query_valm	= "select * from bms_inspection2headerdatas where Inspection2HeaderDataID =".$Inspection2HeaderDataID;
			$result_valm	= mysql_query($query_valm) or die (mysql_error());
			while($row_valm	= mysql_fetch_array($result_valm))
			{
				$InspectionDate  	= $row_valm['InspectionDate'];
				$NextInspectionDate	= $row_valm['NextInspectionDate'];
				$Level1Inspection	= $row_valm['Level1Inspection'];
			}
			
			echo "
			<table>
				<tr>			
					<td class=\"mytd\" >Structure ID of the Bridge</td>
					";
						echo "<td  class=\"mytd\">";					
						
						echo $StructureID;
											
					echo "</td>";
					echo "			
				</tr>	
				<tr>			
					<td class=\"mytd\" >Name of the Bridge</td>
					";
						echo "<td  class=\"mytd\">";					
						
						echo $BridgeName;
											
					echo "</td>";
					echo "			
				</tr>	
				<tr>			
					<td class=\"mytd\" >Date of Inspection</td>
					";
						echo "<td  class=\"mytd\">";					
						
						echo $InspectionDate;
											
					echo "</td>";
					echo "			
				</tr>						
				
				<tr>			
					<td class=\"mytd\" >Date of next Inspection</td>
					";
						echo "<td  class=\"mytd\">";					
						
						echo $NextInspectionDate;
						
					echo "</td>";
					echo "			
				</tr>

				<tr>			
					<td class=\"mytd\" >Level 1 Inspection</td>
					<td class=\"mytd\">";
					
						if($Level1Inspection == "e")
						{
							echo "Exceptional";
						}
						else
						{
							echo "Programmed";
						}
						echo "
					</td>			
				</tr>										
				
				<tr>
					<td>
					&nbsp
					</td>
				</tr>
				
			</table>";

					echo " <table>
											<tr>
											<td class=\"myth\" width=\"100\">Film/Exposure Number</td>
											<td class=\"myth\" width=\"100\">Sketch Number</td>
											<td class=\"myth\" width=\"100\">Modification</td>
											<td class=\"myth\" width=\"100\">Group</td>
											<td class=\"myth\" width=\"100\">Component</td>
											<td class=\"myth\" width=\"100\">Description</td>
											<td class=\"myth\" width=\"100\">Attachment</td>
											</tr>";
							echo "</br>";
						
					for($i=0; $i <= 20; $i++)
					{
						$query_valmi	= "select * from bms_inspection2datas where bms_inspection2headerdatas_Inspection2HeaderDataID =".$Inspection2HeaderDataID." and ival=".$i;
						$result_valmi	= mysql_query($query_valmi) or die (mysql_error());
						
						while($row_valmi	= mysql_fetch_array($result_valmi))
						{
							$Filmnumber  	= $row_valmi['Filmnumber'];
							$Sketchnumber	= $row_valmi['Sketchnumber'];
							$Modification	= $row_valmi['Modification'];
							$Group		 	= $row_valmi['Group'];
							$Component		= $row_valmi['Component'];
							$lcase_ext		= $row_valmi['Filext'];
							$Description 	= $row_valmi['Description'];
							
							if(($Filmnumber == '')  and ($Sketchnumber == '') and ($Modification == '') and ($Group == '') and ($Component == '') and ($Description == '') and ($lcase_ext == ''))
							{
							}
							else
							{
								echo "	
										<tr>
										<td class=\"mytd\">".$Filmnumber."</td>					
										<td class=\"mytd\">".$Sketchnumber."</td>
										<td class=\"mytd\">".$Modification."</td>
										<td class=\"mytd\">".$Group."</td>
										<td class=\"mytd\">".$Component."</td>
										<td class=\"mytd\">".$Description."</td>
										<td  class=\"mytd\"  align=\"center\">";							
											$x	= '';
											$x	= "Sketch".$i;
											$filepath	= '';
											if($lcase_ext != ""){
												$filepath	= $pathprefix."inspection1/fileattachment/".$Inspection2HeaderDataID."-".$i.".".$lcase_ext;
												echo "<a href=\"".$filepath."\">".$x."</a>";	
											}else{
												echo "--";
											}
												
										echo "</td>";
										
										echo "
										<span name=\"des\" id=\"des\"></span></td>
										</tr>
										";
							}
						}
					}
					echo "</table>";
	


					echo "<table>";			
				echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
				
				
				echo "</table>";
				
				
		
		
	}
	else{
	
	
			$BridgeProfileID = $_SESSION['BridgeProfileID'];
			
			
			$query_ea		= "select * from bms_inspection2headerdatas where bridgeprofile_BridgeProfileID = ".$BridgeProfileID;		
			$result_fac		= mysql_query($query_ea) or die (mysql_error());
			$CurrentDate	= date("Y-m-d");
			
				if(mysql_num_rows($result_fac) < 1)
				{
					echo "<p  class=\"bodytext\">";
						echo "<strong>No Inspection Reports were found for given details!</strong>";
					echo "</p>";
				}			
				else
				{
					echo "<table>";		
						echo "<tr bgcolor=\"#CFEBFA\" align=\"center\">";
					
							echo "<td class=\"myth\">";
								echo "<strong>Inspection Date</strong>";
							echo "</td>";
						
							echo "<td class=\"myth\"  height=\"36\"   width=\"250\">";
								echo "<strong>Next Inspection Date</strong>";
							echo "</td>";

							echo "<td class=\"myth\"  height=\"36\"   width=\"250\">";
								echo "<strong>Next Inspection Due</strong>";
							echo "</td>";
							
						echo "</tr>";
					
					$temp = 0;	
					while($row_fac = mysql_fetch_array($result_fac))
					{

						$Inspection2HeaderDataID= $row_fac['Inspection2HeaderDataID'];
						$InspectionDate			= $row_fac['InspectionDate'];
						$NextInspectionDate		= $row_fac['NextInspectionDate'];
						
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
							echo $InspectionDate;
						echo "</td>";
						
						if($temp%2 == 0)
						{
							echo "<td class=\"mytd\">";
						}
						else
						{
							echo "<td class=\"altmytd\">";				
						}
								echo $NextInspectionDate;
							echo "</td>";
						
						if($temp%2 == 0)
						{
							echo "<td class=\"mytd\">";
						}
						else
						{
							echo "<td class=\"altmytd\">";				
						}
								if($NextInspectionDate < $CurrentDate)
								{
									echo "<font color=\"#FF3030\">Inspection Report is Delayed</font>";
								}
								else
								{
									echo "Inspection Report is Due";
								}
								
						echo "</tr>";
					}
					echo "</table>";	
				}
	}
	
	echo "<br /><br /><br />";
?>