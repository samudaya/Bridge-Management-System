<?php
	@session_start();
	
	include ("../global.php");
	echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"../common/common.css\" />";

	echo "<br /><br /><h2>Bridge Inspection Report 1 - A</h2><br /><br />";
	
	if(isset($_SESSION['more']))
	{
			$BridgeProfileID 			= $_SESSION['BridgeProfileID'];
			$Inspection1HeaderDataID 	= $_SESSION['Inspection1HeaderDataID'];
			
			
			$query_ea		= "select * from bms_bridgeprofiles where BridgeProfileID = '".$BridgeProfileID."'";		
			$result_fac		= mysql_query($query_ea) or die (mysql_error());
			while($row_fac	= mysql_fetch_array($result_fac))
			{
				$StructureID  	= $row_fac['StructureID'];
				$BridgeName		= $row_fac['BridgeName'];
			}

			$query_valm	= "select * from bms_inspection1headerdatas where Inspection1HeaderDataID ='".$Inspection1HeaderDataID."'";
			$result_valm	= mysql_query($query_valm) or die (mysql_error());
			while($row_valm	= mysql_fetch_array($result_valm))
			{
				$InspectionDate  	= $row_valm['InspectionDate'];
				$NextInspectionDate	= $row_valm['NextInspectionDate'];
				$Level1Inspection	= $row_valm['Level1Inspection'];
				$GeneralComment	 	= $row_valm['GeneralComment'];
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
					<td class=\"mytd\" width=\"200\">Date of next Inspection</td>
					";
						echo "<td  class=\"mytd\" width=\"280\">";					
						
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
			
			
			
			echo "<br /><br /><hr><br /><br />";
			
					
			$i = 1;
			
				$query_master	= "select Inspection1MasterInfoID, Inspection1MasterInfo from bms_inspection1masterinfos";
				$result_master	= mysql_query($query_master) or die (mysql_error());
				
				$j = 0;
				
				while($row_master	= mysql_fetch_array($result_master))
				{	
					$j ++;
					$Inspection1MasterInfoID = $row_master['Inspection1MasterInfoID'];
					$Inspection1MasterInfo	 = $row_master['Inspection1MasterInfo'];
					
					if($Inspection1MasterInfoID <= 4)
					{
						echo "<p class=\"bodytextbold\"><u>$Inspection1MasterInfo</u></p>";
						echo "<table class=\"bodytext\">";
						echo "	<tr>
										<td class=\"myth\"  width=\"270\">Inspection Element</td>
										<td class=\"myth\">Problem</td>
										<td class=\"myth\">Location and Comments</td>
										<td class=\"myth\">Rectified</td>
										<td class=\"myth\">Maintenance Required</td>
										<td class=\"myth\">Inspection Required</td>
										</tr>";
						echo "</br>";
					
							$query_sec	= "select Inspection1SecondaryInfoID, Inspection1SecondaryInfo from bms_inspection1secondaryinfos where inspection1masterinfos_Inspection1MasterInfoID =".$Inspection1MasterInfoID;
							$result_sec	= mysql_query($query_sec) or die (mysql_error());
							
							$k = 0;
							
							while($row_sec	= mysql_fetch_array($result_sec))
							{
								$k ++;
								$Inspection1SecondaryInfoID  = $row_sec['Inspection1SecondaryInfoID'];
								$Inspection1SecondaryInfo	 = $row_sec['Inspection1SecondaryInfo'];
								
								$ijkval = $i.$j.$k;
								$query_val	= "select * from bms_inspection1datas where ijkval =".$ijkval." and bms_inspection1headerdatas_Inspection1HeaderDataID =".$Inspection1HeaderDataID;
								$result_val	= mysql_query($query_val) or die (mysql_error());
								while($row_val	= mysql_fetch_array($result_val))
								{
									$ijkval    = $row_val['ijkval'];
									$Problem   = $row_val['Problem'];
									$Comment   = $row_val['Comment'];
									$Rectified = $row_val['Rectified'];
									$MaintainaceRequired= $row_val['MaintainaceRequired'];
									$InspectionRequired = $row_val['InspectionRequired'];
								}
								
								
								echo "	
										<tr>
										<td class=\"mytd\">$Inspection1SecondaryInfo</td>
										<input type=\"hidden\" name=\"Inspection1SecondaryInfo$i$j$k\" value=\"$Inspection1SecondaryInfoID\">
										
										<td class=\"mytd\" align=\"center\">";
										if($Problem == "y" )
										{
											echo "Yes";
										}
										else
										{
											echo "No";
										}
										echo "
										</td>
										<td class=\"mytd\">";
										if($Comment !='')
										{
											echo $Comment;
										}
										else
										{
											echo "---";
										}
										echo "
										</td>
										<td class=\"mytd\"  align=\"center\">";
										if($Rectified == "y")
										{
											echo "Yes";
										}
										else
										{
											echo "No";
										}
										echo "
										</td>
										<td class=\"mytd\"  align=\"center\">";
										if($MaintainaceRequired == "y")
										{
											echo "Yes";
										}
										else
										{
											echo "No";
										}
										echo "
										</td>
										<td class=\"mytd\" align=\"center\">";
										if($InspectionRequired == "y")
										{
											echo "Yes";
										}
										else
										{
											echo "No";
										}
										echo "
										</td>
										<span name=\"des\" id=\"des\"></span></td>
										</tr>
										";
										
							}	
						echo "</table>";
					}
					//echo "</table>";	
				}			
			
				echo "<br /><br /><hr><br /><br />";
				
				$i = 2;
				$query_master	= "select Inspection1MasterInfoID, Inspection1MasterInfo from bms_inspection1masterinfos";
				$result_master	= mysql_query($query_master) or die (mysql_error());
				
				$j = 0;					
				while($row_master	= mysql_fetch_array($result_master))
				{	
				
					$Inspection1MasterInfoID = $row_master['Inspection1MasterInfoID'];
					$Inspection1MasterInfo	 = $row_master['Inspection1MasterInfo'];
					
					if(($Inspection1MasterInfoID <= 8) && ($Inspection1MasterInfoID > 4))
					{
					$j ++;
						echo "<p class=\"bodytextbold\"><u>$Inspection1MasterInfo</u></p>";
						echo "<table class=\"bodytext\">";
						echo "	<tr>
										<td class=\"myth\"  width=\"270\">Inspection Element</td>
										<td class=\"myth\">Problem</td>
										<td class=\"myth\">Location and Comments</td>
										<td class=\"myth\">Rectified</td>
										<td class=\"myth\">Maintenance Required</td>
										<td class=\"myth\">Inspection Required</td>
										</tr>";
						echo "</br>";
					
							$query_sec	= "select Inspection1SecondaryInfoID, Inspection1SecondaryInfo from bms_inspection1secondaryinfos where inspection1masterinfos_Inspection1MasterInfoID =".$Inspection1MasterInfoID;
							$result_sec	= mysql_query($query_sec) or die (mysql_error());
									
							$k = 0;
							
							while($row_sec	= mysql_fetch_array($result_sec))
							{
								$k ++;				
								$Inspection1SecondaryInfoID  = $row_sec['Inspection1SecondaryInfoID'];
								$Inspection1SecondaryInfo	 = $row_sec['Inspection1SecondaryInfo'];
								
								$ijkval = $i.$j.$k;
								$query_val	= "select * from bms_inspection1datas where ijkval =".$ijkval." and bms_inspection1headerdatas_Inspection1HeaderDataID =".$Inspection1HeaderDataID;
								$result_val	= mysql_query($query_val) or die (mysql_error());
								while($row_val	= mysql_fetch_array($result_val))
								{
									$ijkval    = $row_val['ijkval'];
									$Problem   = $row_val['Problem'];
									$Comment   = $row_val['Comment'];
									$Rectified = $row_val['Rectified'];
									$MaintainaceRequired= $row_val['MaintainaceRequired'];
									$InspectionRequired = $row_val['InspectionRequired'];
								}
								
								
								echo "	
										<tr>
										<td class=\"mytd\">$Inspection1SecondaryInfo</td>
										<input type=\"hidden\" name=\"Inspection1SecondaryInfo$i$j$k\" value=\"$Inspection1SecondaryInfoID\">
										
										<td class=\"mytd\" align=\"center\">";
										if($Problem == "y")
										{
											echo "Yes";
										}
										else
										{
											echo "No";
										}
										echo "
										</td>
										<td class=\"mytd\">"; 
										if($Comment !='')
										{
											echo $Comment;
										}
										else
										{
											echo "---";
										}
										echo "
										</td>
										<td class=\"mytd\" align=\"center\">";
										if($Rectified == "y")
										{
											echo "Yes";
										}
										else
										{
											echo "No";
										}
										echo "
										</td>
										<td class=\"mytd\" align=\"center\">";
										if($MaintainaceRequired == "y")
										{
											echo "Yes";
										}
										else
										{
											echo "No";
										}
										echo "
										</td>
										<td class=\"mytd\" align=\"center\">";
										if($InspectionRequired == "y")
										{
											echo "Yes";
										}
										else
										{
											echo "No";
										}
										echo "
										</td>
										<span name=\"des\" id=\"des\"></span></td>
										</tr>
										";
							}	
						echo "</table>";
					}
					
				}
			
				echo "<br /><br /><hr><br /><br />";
				
				$i = 3;
				$query_master	= "select Inspection1MasterInfoID, Inspection1MasterInfo from bms_inspection1masterinfos";
				$result_master	= mysql_query($query_master) or die (mysql_error());
				
				$j = 0;
				while($row_master	= mysql_fetch_array($result_master))
				{
				
					$Inspection1MasterInfoID = $row_master['Inspection1MasterInfoID'];
					$Inspection1MasterInfo	 = $row_master['Inspection1MasterInfo'];
					
					if(($Inspection1MasterInfoID <= 9) && ($Inspection1MasterInfoID > 8))
					{
					$j ++;
						echo "<p class=\"bodytextbold\"><u>$Inspection1MasterInfo</u></p>";
						echo "<table class=\"bodytext\">";
						echo "	<tr>
										<td class=\"myth\"  width=\"270\">Inspection Element</td>
										<td class=\"myth\">Problem</td>
										<td class=\"myth\">Location and Comments</td>
										<td class=\"myth\">Rectified</td>
										<td class=\"myth\">Maintenance Required</td>
										<td class=\"myth\">Inspection Required</td>
										</tr>";
						echo "</br>";
					
							$query_sec	= "select Inspection1SecondaryInfoID, Inspection1SecondaryInfo from bms_inspection1secondaryinfos where inspection1masterinfos_Inspection1MasterInfoID =".$Inspection1MasterInfoID;
							$result_sec	= mysql_query($query_sec) or die (mysql_error());
									
							$k = 0;
							
							while($row_sec	= mysql_fetch_array($result_sec))
							{
								$k ++;			
								$Inspection1SecondaryInfoID  = $row_sec['Inspection1SecondaryInfoID'];
								$Inspection1SecondaryInfo	 = $row_sec['Inspection1SecondaryInfo'];
								
								$ijkval = $i.$j.$k;
								$query_val	= "select * from bms_inspection1datas where ijkval =".$ijkval." and bms_inspection1headerdatas_Inspection1HeaderDataID =".$Inspection1HeaderDataID;
								$result_val	= mysql_query($query_val) or die (mysql_error());
								while($row_val	= mysql_fetch_array($result_val))
								{
									$ijkval    = $row_val['ijkval'];
									$Problem   = $row_val['Problem'];
									$Comment   = $row_val['Comment'];
									$Rectified = $row_val['Rectified'];
									$MaintainaceRequired= $row_val['MaintainaceRequired'];
									$InspectionRequired = $row_val['InspectionRequired'];
								}
								
								
								echo "	
										<tr>
										<td class=\"mytd\">$Inspection1SecondaryInfo</td>
										<input type=\"hidden\" name=\"Inspection1SecondaryInfo$i$j$k\" value=\"$Inspection1SecondaryInfoID\">
										
										<td class=\"mytd\" align=\"center\">";
										if($Problem == "y")
										{
											echo "Yes";
										}
										else
										{
											echo "No";
										}
										echo "
										</td>
										<td class=\"mytd\">"; 
										if($Comment !='')
										{
											echo $Comment;
										}
										else
										{
											echo "---";
										}
										echo "
										</td>
										<td class=\"mytd\" align=\"center\">";
										if($Rectified == "y")
										{
											echo "Yes";
										}
										else
										{
											echo "No";
										}
										echo "
										</td>
										<td class=\"mytd\" align=\"center\">";
										if($MaintainaceRequired == "y")
										{
											echo "Yes";
										}
										else
										{
											echo "No";
										}
										echo "
										</td>
										<td class=\"mytd\" align=\"center\">";
										if($InspectionRequired == "y")
										{
											echo "Yes";
										}
										else
										{
											echo "No";
										}
										echo "
										</td>
										<span name=\"des\" id=\"des\"></span></td>
										</tr>
										";
							}	
						echo "</table>";
					}
					//echo "</table>";
					
				}
				
			
				echo "<br /><br /><hr><br /><br />";
				
				$i = 4;
				$query_master	= "select Inspection1MasterInfoID, Inspection1MasterInfo from bms_inspection1masterinfos";
				$result_master	= mysql_query($query_master) or die (mysql_error());
				
				$j = 0;
				while($row_master	= mysql_fetch_array($result_master))
				{
				
					$Inspection1MasterInfoID = $row_master['Inspection1MasterInfoID'];
					$Inspection1MasterInfo	 = $row_master['Inspection1MasterInfo'];
					
					if(($Inspection1MasterInfoID <= 12) && ($Inspection1MasterInfoID > 9))
					{
					$j ++;
						echo "<p class=\"bodytextbold\"><u>$Inspection1MasterInfo</u></p>";
						echo "<table class=\"bodytext\">";
						echo "	<tr>
										<td class=\"myth\"  width=\"270\">Inspection Element</td>
										<td class=\"myth\">Problem</td>
										<td class=\"myth\">Location and Comments</td>
										<td class=\"myth\">Rectified</td>
										<td class=\"myth\">Maintenance Required</td>
										<td class=\"myth\">Inspection Required</td>
										</tr>";
						echo "</br>";
					
							$query_sec	= "select Inspection1SecondaryInfoID, Inspection1SecondaryInfo from bms_inspection1secondaryinfos where inspection1masterinfos_Inspection1MasterInfoID =".$Inspection1MasterInfoID;
							$result_sec	= mysql_query($query_sec) or die (mysql_error());
									
							$k = 0;
							
							while($row_sec	= mysql_fetch_array($result_sec))
							{
								$k ++;				
								$Inspection1SecondaryInfoID  = $row_sec['Inspection1SecondaryInfoID'];
								$Inspection1SecondaryInfo	 = $row_sec['Inspection1SecondaryInfo'];
								
								$ijkval = $i.$j.$k;
								$query_val	= "select * from bms_inspection1datas where ijkval =".$ijkval." and bms_inspection1headerdatas_Inspection1HeaderDataID =".$Inspection1HeaderDataID;
								$result_val	= mysql_query($query_val) or die (mysql_error());
								while($row_val	= mysql_fetch_array($result_val))
								{
									$ijkval    = $row_val['ijkval'];
									$Problem   = $row_val['Problem'];
									$Comment   = $row_val['Comment'];
									$Rectified = $row_val['Rectified'];
									$MaintainaceRequired= $row_val['MaintainaceRequired'];
									$InspectionRequired = $row_val['InspectionRequired'];
								}
								
								
								echo "	
										<tr>
										<td class=\"mytd\">$Inspection1SecondaryInfo</td>
										<input type=\"hidden\" name=\"Inspection1SecondaryInfo$i$j$k\" value=\"$Inspection1SecondaryInfoID\">
										
										<td class=\"mytd\" align=\"center\">";
										if($Problem == "y")
										{
											echo "Yes";
										}
										else
										{
											echo "No";
										}
										echo "
										</td>
										<td class=\"mytd\">"; 
										if($Comment !='')
										{
											echo $Comment;
										}
										else
										{
											echo "---";
										}
										echo "
										</td>
										<td class=\"mytd\" align=\"center\">";
										if($Rectified == "y")
										{
											echo "Yes";
										}
										else
										{
											echo "No";
										}
										echo "
										</td>
										<td class=\"mytd\" align=\"center\">";
										if($MaintainaceRequired == "y")
										{
											echo "Yes";
										}
										else
										{
											echo "No";
										}
										echo "
										</td>
										<td class=\"mytd\" align=\"center\">";
										if($InspectionRequired == "y")
										{
											echo "Yes";
										}
										else
										{
											echo "No";
										}
										echo "
										</td>
										<span name=\"des\" id=\"des\"></span></td>
										</tr>
										";
							}	
						echo "</table>";
					}
					
				}
			
				echo "<br /><br /><hr><br /><br />";	
			
				$i = 5;
				$query_master	= "select Inspection1MasterInfoID, Inspection1MasterInfo from bms_inspection1masterinfos";
				$result_master	= mysql_query($query_master) or die (mysql_error());
				
				$j = 0;
				while($row_master	= mysql_fetch_array($result_master))
				{
				
					$Inspection1MasterInfoID = $row_master['Inspection1MasterInfoID'];
					$Inspection1MasterInfo	 = $row_master['Inspection1MasterInfo'];
					
					if(($Inspection1MasterInfoID <= 14) && ($Inspection1MasterInfoID > 12))
					{
					$j ++;
						echo "<p class=\"bodytextbold\"><u>$Inspection1MasterInfo</u></p>";
						echo "<table class=\"bodytext\">";
						echo "	<tr>
										<td class=\"myth\"  width=\"270\">Inspection Element</td>
										<td class=\"myth\">Problem</td>
										<td class=\"myth\">Location and Comments</td>
										<td class=\"myth\">Rectified</td>
										<td class=\"myth\">Maintenance Required</td>
										<td class=\"myth\">Inspection Required</td>
										</tr>";
						echo "</br>";
					
							$query_sec	= "select Inspection1SecondaryInfoID, Inspection1SecondaryInfo from bms_inspection1secondaryinfos where inspection1masterinfos_Inspection1MasterInfoID =".$Inspection1MasterInfoID;
							$result_sec	= mysql_query($query_sec) or die (mysql_error());
									
							$k = 0;
							
							while($row_sec	= mysql_fetch_array($result_sec))
							{
								$k ++;				
								$Inspection1SecondaryInfoID  = $row_sec['Inspection1SecondaryInfoID'];
								$Inspection1SecondaryInfo	 = $row_sec['Inspection1SecondaryInfo'];
								
								$ijkval = $i.$j.$k;
								$query_val	= "select * from bms_inspection1datas where ijkval =".$ijkval." and bms_inspection1headerdatas_Inspection1HeaderDataID =".$Inspection1HeaderDataID;
								$result_val	= mysql_query($query_val) or die (mysql_error());
								while($row_val	= mysql_fetch_array($result_val))
								{
									$ijkval    = $row_val['ijkval'];
									$Problem   = $row_val['Problem'];
									$Comment   = $row_val['Comment'];
									$Rectified = $row_val['Rectified'];
									$MaintainaceRequired= $row_val['MaintainaceRequired'];
									$InspectionRequired = $row_val['InspectionRequired'];
								}
								
								
								echo "	
										<tr>
										<td class=\"mytd\">$Inspection1SecondaryInfo</td>
										<input type=\"hidden\" name=\"Inspection1SecondaryInfo$i$j$k\" value=\"$Inspection1SecondaryInfoID\">
										
										<td class=\"mytd\" align=\"center\">";
										if($Problem == "y")
										{
											echo "Yes";
										}
										else
										{
											echo "No";
										}
										echo "
										</td>
										<td class=\"mytd\">"; 
										if($Comment !='')
										{
											echo $Comment;
										}
										else
										{
											echo "---";
										}
										echo "
										</td>
										<td class=\"mytd\" align=\"center\">";
										if($Rectified == "y")
										{
											echo "Yes";
										}
										else
										{
											echo "No";
										}
										echo "
										</td>
										<td class=\"mytd\" align=\"center\">";
										if($MaintainaceRequired == "y")
										{
											echo "Yes";
										}
										else
										{
											echo "No";
										}
										echo "
										</td>
										<td class=\"mytd\" align=\"center\">";
										if($InspectionRequired == "y")
										{
											echo "Yes";
										}
										else
										{
											echo "No";
										}
										echo "
										</td>
										<span name=\"des\" id=\"des\"></span></td>
										</tr>
										";
							}	
						echo "</table>";
					}
					
				}
				
				echo "<br /><br /><hr><br /><br />";	
			
				$i = 6;
				$query_master	= "select Inspection1MasterInfoID, Inspection1MasterInfo from bms_inspection1masterinfos";
				$result_master	= mysql_query($query_master) or die (mysql_error());
				
				$j = 0;
				while($row_master	= mysql_fetch_array($result_master))
				{
				
					$Inspection1MasterInfoID = $row_master['Inspection1MasterInfoID'];
					$Inspection1MasterInfo	 = $row_master['Inspection1MasterInfo'];
					
					if(($Inspection1MasterInfoID <= 16) && ($Inspection1MasterInfoID > 14))
					{
					$j ++; 
						echo "<p class=\"bodytextbold\"><u>$Inspection1MasterInfo</u></p>";
						echo "<table class=\"bodytext\">";
						echo "	<tr>
										<td class=\"myth\"  width=\"270\">Inspection Element</td>
										<td class=\"myth\">Problem</td>
										<td class=\"myth\">Location and Comments</td>
										<td class=\"myth\">Rectified</td>
										<td class=\"myth\">Maintenance Required</td>
										<td class=\"myth\">Inspection Required</td>
										</tr>";
						echo "</br>";
					
							$query_sec	= "select Inspection1SecondaryInfoID, Inspection1SecondaryInfo from bms_inspection1secondaryinfos where inspection1masterinfos_Inspection1MasterInfoID =".$Inspection1MasterInfoID;
							$result_sec	= mysql_query($query_sec) or die (mysql_error());
									
							$k = 0;
							
							while($row_sec	= mysql_fetch_array($result_sec))
							{
								$k ++;				
								$Inspection1SecondaryInfoID  = $row_sec['Inspection1SecondaryInfoID'];
								$Inspection1SecondaryInfo	 = $row_sec['Inspection1SecondaryInfo'];
								
								$ijkval = $i.$j.$k;
								$query_val	= "select * from bms_inspection1datas where ijkval =".$ijkval." and bms_inspection1headerdatas_Inspection1HeaderDataID =".$Inspection1HeaderDataID;
								$result_val	= mysql_query($query_val) or die (mysql_error());
								while($row_val	= mysql_fetch_array($result_val))
								{
									$ijkval    = $row_val['ijkval'];
									$Problem   = $row_val['Problem'];
									$Comment   = $row_val['Comment'];
									$Rectified = $row_val['Rectified'];
									$MaintainaceRequired= $row_val['MaintainaceRequired'];
									$InspectionRequired = $row_val['InspectionRequired'];
								}
								
								
								echo "	
										<tr>
										<td class=\"mytd\">$Inspection1SecondaryInfo</td>
										<input type=\"hidden\" name=\"Inspection1SecondaryInfo$i$j$k\" value=\"$Inspection1SecondaryInfoID\">
										
										<td class=\"mytd\" align=\"center\">";
										if($Problem == "y")
										{
											echo "Yes";
										}
										else
										{
											echo "No";
										}
										echo "
										</td>
										<td class=\"mytd\">"; 
										if($Comment !='')
										{
											echo $Comment;
										}
										else
										{
											echo "---";
										}
										echo "
										</td>
										<td class=\"mytd\" align=\"center\">";
										if($Rectified == "y")
										{
											echo "Yes";
										}
										else
										{
											echo "No";
										}
										echo "
										</td>
										<td class=\"mytd\" align=\"center\">";
										if($MaintainaceRequired == "y")
										{
											echo "Yes";
										}
										else
										{
											echo "No";
										}
										echo "
										</td>
										<td class=\"mytd\" align=\"center\">";
										if($InspectionRequired == "y")
										{
											echo "Yes";
										}
										else
										{
											echo "No";
										}
										echo "
										</td>
										<span name=\"des\" id=\"des\"></span></td>
										</tr>
										";
							}	
						echo "</table>";
					}
					//echo "</table>";
					
				}
			
				echo "<br /><br /><hr><br /><br />";		
			
				$i = 7;
				$query_master	= "select Inspection1MasterInfoID, Inspection1MasterInfo from bms_inspection1masterinfos";
				$result_master	= mysql_query($query_master) or die (mysql_error());
				
				$j = 0;
				while($row_master	= mysql_fetch_array($result_master))
				{
				
					$Inspection1MasterInfoID = $row_master['Inspection1MasterInfoID'];
					$Inspection1MasterInfo	 = $row_master['Inspection1MasterInfo'];
					
					if(($Inspection1MasterInfoID <= 17) && ($Inspection1MasterInfoID > 16))
					{
					$j ++;
						echo "<p class=\"bodytextbold\"><u>$Inspection1MasterInfo</u></p>";
						echo "<table class=\"bodytext\">";
						echo "	<tr>
										<td class=\"myth\"  width=\"270\">Inspection Element</td>
										<td class=\"myth\">Problem</td>
										<td class=\"myth\">Location and Comments</td>
										<td class=\"myth\">Rectified</td>
										<td class=\"myth\">Maintenance Required</td>
										<td class=\"myth\">Inspection Required</td>
										</tr>";
						echo "</br>";
					
							$query_sec	= "select Inspection1SecondaryInfoID, Inspection1SecondaryInfo from bms_inspection1secondaryinfos where inspection1masterinfos_Inspection1MasterInfoID =".$Inspection1MasterInfoID;
							$result_sec	= mysql_query($query_sec) or die (mysql_error());
									
							$k = 0;
							
							while($row_sec	= mysql_fetch_array($result_sec))
							{
								$k ++;				
								$Inspection1SecondaryInfoID  = $row_sec['Inspection1SecondaryInfoID'];
								$Inspection1SecondaryInfo	 = $row_sec['Inspection1SecondaryInfo'];
								
								$ijkval = $i.$j.$k;
								$query_val	= "select * from bms_inspection1datas where ijkval =".$ijkval." and bms_inspection1headerdatas_Inspection1HeaderDataID =".$Inspection1HeaderDataID;
								$result_val	= mysql_query($query_val) or die (mysql_error());
								while($row_val	= mysql_fetch_array($result_val))
								{
									$ijkval    = $row_val['ijkval'];
									$Problem   = $row_val['Problem'];
									$Comment   = $row_val['Comment'];
									$Rectified = $row_val['Rectified'];
									$MaintainaceRequired= $row_val['MaintainaceRequired'];
									$InspectionRequired = $row_val['InspectionRequired'];
								}
								
								
								echo "	
										<tr>
										<td class=\"mytd\">$Inspection1SecondaryInfo</td>
										<input type=\"hidden\" name=\"Inspection1SecondaryInfo$i$j$k\" value=\"$Inspection1SecondaryInfoID\">
										
										<td class=\"mytd\" align=\"center\">";
										if($Problem == "y")
										{
											echo "Yes";
										}
										else
										{
											echo "No";
										}
										echo "
										</td>
										<td class=\"mytd\">"; 
										if($Comment !='')
										{
											echo $Comment;
										}
										else
										{
											echo "---";
										}
										echo "
										</td>
										<td class=\"mytd\"  align=\"center\">";
										if($Rectified == "y")
										{
											echo "Yes";
										}
										else
										{
											echo "No";
										}
										echo "
										</td>
										<td class=\"mytd\" align=\"center\">";
										if($MaintainaceRequired == "y")
										{
											echo "Yes";
										}
										else
										{
											echo "No";
										}
										echo "
										</td>
										<td class=\"mytd\" align=\"center\">";
										if($InspectionRequired == "y")
										{
											echo "Yes";
										}
										else
										{
											echo "No";
										}
										echo "
										</td>
										<span name=\"des\" id=\"des\"></span></td>
										</tr>
										";
							}				
						echo "</table>";
					}
					
				}
				echo "<br /><br /><hr><br /><br />";

				
				echo "<p class=\"bodytextbold\"><u>Comments</u></p>";
				
					echo "<table class=\"bodytext\">";
						echo "<tr>";
							echo "<td class=\"mytd\" widht=\"100\" word-wrap=\"yes\" height=\"250\">";
										echo $GeneralComment;
									echo "</td>";
							echo "</tr>";
							
							echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";

					echo "</table>";
	
	
	}else{

	
	
			$BridgeProfileID 			= $_SESSION['BridgeProfileID'];
			
			$query_ea		= "select * from bms_inspection1headerdatas where bridgeprofile_BridgeProfileID = ".$BridgeProfileID;		
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
					
							echo "<td class=\"myth\">";
								echo "<strong>Inspection Date</strong>";
							echo "</td>";
						
							echo "<td class=\"myth\"  height=\"36\"   width=\"270\">";
								echo "<strong>Next Inspection Date</strong>";
							echo "</td>";

							echo "<td class=\"myth\"  height=\"36\"   width=\"270\">";
								echo "<strong>Next Inspection Due</strong>";
							echo "</td>";
							
						echo "</tr>";
					
					$temp = 0;	
					while($row_fac = mysql_fetch_array($result_fac))
					{

						$Inspection1HeaderDataID= $row_fac['Inspection1HeaderDataID'];
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