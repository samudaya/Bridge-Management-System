<?php
	@session_start();
	include ("../global.php");
	
	echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"../common/common.css\" />";
	
	echo "<br /><br /><h2>Bridge Inspection Report 2<br /><br />(Structure Condition)</h2><br /><br />";
	
	if(isset($_SESSION['more']) and $_SESSION['more']=="more"){
	
	
		$BridgeProfileID 			= $_SESSION['BridgeProfileID'];
		$Inspection3HeaderDataID 	= $_SESSION['Inspection3HeaderDataID'];
		
		$query_ea		= "select * from bms_bridgeprofiles where BridgeProfileID = ".$BridgeProfileID;		
			$result_fac		= mysql_query($query_ea) or die (mysql_error());
			while($row_fac	= mysql_fetch_array($result_fac))
			{
				$StructureID  	= $row_fac['StructureID'];
				$BridgeName		= $row_fac['BridgeName'];
			}

			$query_valm	= "select * from bms_inspection3headerdatas where Inspection3HeaderDataID =".$Inspection3HeaderDataID;
			$result_valm	= mysql_query($query_valm) or die (mysql_error());
			while($row_valm	= mysql_fetch_array($result_valm))
			{
				$InspectionDate  	= $row_valm['InspectionDate'];
				$NextInspectionDate	= $row_valm['NextInspectionDate'];
				$Level2Inspection	= $row_valm['Level2Inspection'];
				$GeneralComment		= $row_valm['GeneralComment'];
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
					<td class=\"mytd\" >Level 2 Inspection</td>
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
					<td>
					&nbsp
					</td>
				</tr>
				
			</table>";
			
				
				
				echo "<br /><br /><hr><br /><br />";
				
				
				
					echo "<p class=\"bodytextbold\"><u>Structure Condition</u></p> <br />";
					echo " <table>
											<tr>
											<td class=\"myth\" width=\"185\">Modification</td>
											<td class=\"myth\" width=\"185\">Group</td>
											<td class=\"myth\" width=\"185\">Component</td>
											<td class=\"myth\" width=\"185\">Weighted Factor</td>
											<td class=\"myth\" width=\"185\">Standard Number</td>
											<td class=\"myth\" width=\"185\">Exposure Factor</td>
											<td class=\"myth\" width=\"100\">Importance Factor</td>
											";
											echo"
											<td class=\"myth\" width=\"185\">Unit</td>
											<td class=\"myth\" width=\"185\">Condition State 1</td>
											<td class=\"myth\" width=\"185\">Condition State 2</td>
											<td class=\"myth\" width=\"185\">Condition State 3</td>
											<td class=\"myth\" width=\"185\">Condition State 4</td>
											<td class=\"myth\" width=\"185\">Maintenance Required</td>
											<td class=\"myth\" width=\"100\">Photos Taken</td>
											<td class=\"myth\" width=\"185\">Comments</td>
											</tr>";
							echo "</br>";
						for($i=1; $i <= 1000; $i++)
						{
							
							$query_cea		= "select * from bms_inspection3stconinsdatas where bms_inspection3headerdatas_Inspection3HeaderDataID =".$Inspection3HeaderDataID." AND ival =".$i;
							$result_cea		= mysql_query($query_cea) or die (mysql_error());
							if(mysql_num_rows($result_cea) < 1){
								continue;
							}
							while($row_cea	= mysql_fetch_array($result_cea))
							{
								
								$Modification  					= $row_cea['Modification'];
								$Inspection3StcompMatrixID_GR	= $row_cea['bms_inspection3stcompmatrix_Inspection3StcompMatrixGroupID'];
								$Inspection3StcompMatrixVal_GR  = $row_cea['Inspection3StcompMatrixGroupVal'];
								$Inspection3StcompMatrixID_CM	= $row_cea['bms_inspection3stcompmatrix_Inspection3StcompMatrixID_CM'];
								$Inspection3StcompMatrixVal_CM  = $row_cea['Inspection3StcompMatrixVal_CM'];
								$Inspection3StcompScheduleID	= $row_cea['bms_inspection3stcompschedule_Inspection3StcompScheduleID'];
								$ExporsureClass  				= $row_cea['ExporsureClass'];
								$ResistanceClass  				= $row_cea['ImportanceFactor'];
								$Quantity						= $row_cea['Quantity'];
								$QuantityConState_1  			= $row_cea['QuantityConState_1'];
								$QuantityConState_2				= $row_cea['QuantityConState_2'];
								$QuantityConState_3  			= $row_cea['QuantityConState_3'];
								$QuantityConState_4				= $row_cea['QuantityConState_4'];
								$MaintainRequired  				= $row_cea['MaintainRequired'];
								$PhotosTaken	  				= $row_cea['PhotosTaken'];
								$Comments						= $row_cea['Comments'];
							};
							
							if($Modification == "-" or $Modification == ""){
								continue;
							}
								
							echo "
									<tr>
										<td class=\"mytd\" align=\"center\">";
											if($Modification == "o")
											{
												echo "O";
											}
											else if($Modification == "m1")
											{
												echo "M1";
											}
											else if($Modification == "m2")
											{
												echo "M2";
											}
											else if($Modification == "m3")
											{
												echo "M3";
											}else{
												echo "---";
											}
											echo "
									</td>
									<td class=\"mytd\" align=\"center\">";
											$query_cea		= "select Inspection3StcompMatrixGroupID, StcompMatrixGroupCode from bms_inspection3stcompmatrixgroup where Inspection3StcompMatrixGroupID =".$Inspection3StcompMatrixID_GR;
											$result_cea		= mysql_query($query_cea) or die (mysql_error());
												while($row_cea	= mysql_fetch_array($result_cea))
												{
													$Inspection3StcompMatrixID  = $row_cea['Inspection3StcompMatrixGroupID'];
													$StcompMatrixCode			= $row_cea['StcompMatrixGroupCode'];
												}
												echo $StcompMatrixCode;
												if($Inspection3StcompMatrixVal_GR != 0)
												{
													echo $Inspection3StcompMatrixVal_GR;
												};
										echo "
									</td>
									<td class=\"mytd\" align=\"center\">";
											$SignificanceRating = "---";
											$query_cea		= "select * from bms_inspection3stcompmatrix where Inspection3StcompMatrixID =".$Inspection3StcompMatrixID_CM;		
											$result_cea		= mysql_query($query_cea) or die (mysql_error());
												while($row_cea	= mysql_fetch_array($result_cea))
												{
													$Inspection3StcompMatrixID  = $row_cea['Inspection3StcompMatrixID'];
													$StcompMatrixCode			= $row_cea['StcompMatrixCode'];
													if($row_cea['SignificanceRating'] > 0){
														$SignificanceRating			= $row_cea['SignificanceRating'];
													}
												}
												echo $StcompMatrixCode;
												if($Inspection3StcompMatrixVal_CM != 0)
												{
													echo $Inspection3StcompMatrixVal_CM;
												};
										echo "
									</td>
									<td class=\"mytd\" align=\"center\">
										".$SignificanceRating."
									</td>
									<td class=\"mytd\" align=\"center\">";
											$query_cea		= "select Inspection3StcompScheduleID, Inspection3StcompScheduleNo, Inspection3StcompScheduleUnit from bms_inspection3stcompschedule where Inspection3StcompScheduleID =".$Inspection3StcompScheduleID;		
											$result_cea		= mysql_query($query_cea) or die (mysql_error());
												while($row_cea	= mysql_fetch_array($result_cea))
												{
													$Inspection3StcompScheduleID  = $row_cea['Inspection3StcompScheduleID'];
													$Inspection3StcompScheduleNo  = $row_cea['Inspection3StcompScheduleNo'];
													$Inspection3StcompScheduleUnit= $row_cea['Inspection3StcompScheduleUnit'];
												};
												echo $Inspection3StcompScheduleNo;
											echo "
										</select>
									</td>	
									<td class=\"mytd\" align=\"center\">";
										if($ExporsureClass != 0)
										{
											echo $ExporsureClass;
										};
										
									echo "
									</td>
									<td class=\"mytd\" align=\"center\">";
										if($ResistanceClass != 0)
										{
											echo $ResistanceClass;
										};
										
									echo "
									</td>
									<td class=\"mytd\" align=\"center\">";
										echo $Inspection3StcompScheduleUnit;
									echo "
									</td>
									<td class=\"mytd\" align=\"center\">";
										echo "<input type=\"radio\" name=\"1".$i."\" disabled='disabled' ";
											if($QuantityConState_1 == "1"){
												echo "checked = 'checked'";
											}
										echo " />";
									echo "
									</td>	
									<td class=\"mytd\" align=\"center\">";
										echo "<input type=\"radio\" name=\"2".$i."\" disabled='disabled' ";
											if($QuantityConState_1 == "2"){
												echo "checked = 'checked'";
											}
										echo " />";
									echo "
									</td>	
									<td class=\"mytd\" align=\"center\">";
										echo "<input type=\"radio\" name=\"3".$i."\" disabled='disabled' ";
											if($QuantityConState_1 == "3"){
												echo "checked = 'checked'";
											}
										echo " />";
									echo "
									</td>	
									<td class=\"mytd\" align=\"center\">";
										echo "<input type=\"radio\" name=\"4".$i."\" disabled='disabled' ";
											if($QuantityConState_1 == "4"){
												echo "checked = 'checked'";
											}
										echo " />";
									echo "
									</td>	
									<td class=\"mytd\" align=\"center\">";
											if($MaintainRequired == "y")
											{
												echo "Yes";
											}
											else  if($MaintainRequired == "n")
											{
												echo "No";
											}else{
												echo "---";
											}
											echo "
									</td>
									<td class=\"mytd\" align=\"center\">";
											if($PhotosTaken == "y")
											{
												echo "Yes";
											}
											else if($PhotosTaken == "n")
											{
												echo "No";
											}else{
												echo "---";
											}
											echo "
									</td>
									<td class=\"mytd\" align=\"center\">";
										echo $Comments;
									echo "
									</td>	
									<span name=\"des\" id=\"des\"></span></td>
									</tr>
									";
						}
					echo "</table>";
					
					
					
				echo "<br /><br /><hr><br /><br />";
				
				
				
					echo "<p class=\"bodytextbold\"><u>Defective Components</u></p>";
					echo " <table>
											<tr>
											<td class=\"myth\" width=\"185\">Modification</td>
											<td class=\"myth\" width=\"185\">Group</td>
											<td class=\"myth\" width=\"185\">Component</td>
											<td class=\"myth\" width=\"185\">Standard Number</td>
											<td class=\"myth\" width=\"185\">Exposure Class</td>
											<td class=\"myth\" width=\"185\">Condition State</td>
											<td class=\"myth\" width=\"185\">Description of Defect</td>
											<td class=\"myth\" width=\"185\">Monitor</td>
											<td class=\"myth\" width=\"185\">Level 3 Inspection Required</td>
											<td class=\"myth\" width=\"185\">Other</td>
											</tr>";
							echo "</br>";
						for($i=1; $i <= 20; $i++)
						{
						
							$query_cea		= "select * from bms_inspection3defcomdatas where bms_inspection3headerdatas_Inspection3HeaderDataID =".$Inspection3HeaderDataID." AND ival =".$i;		
							$result_cea		= mysql_query($query_cea) or die (mysql_error());
							if(mysql_num_rows($result_cea) < 1){
								continue;
							}
							while($row_cea	= mysql_fetch_array($result_cea))
							{
								$Modification  					= $row_cea['Modification'];
								$Inspection3StcompMatrixID_GR	= $row_cea['bms_inspection3stcompmatrix_Inspection3StcompMatrixGroupID'];
								$Inspection3StcompMatrixVal_GR  = $row_cea['Inspection3StcompMatrixGroupVal'];
								$Inspection3StcompMatrixID_CM	= $row_cea['bms_inspection3stcompmatrix_Inspection3StcompMatrixID_CM'];
								$Inspection3StcompMatrixVal_CM  = $row_cea['Inspection3StcompMatrixVal_CM'];
								$Inspection3StcompScheduleID	= $row_cea['bms_inspection3stcompschedule_Inspection3StcompScheduleID'];
								$ExporsureClass  				= $row_cea['ExporsureClass'];
								$ConditionState					= $row_cea['ConditionState'];
								$Monitor  						= $row_cea['Monitor'];
								$Level3Inspection				= $row_cea['Level3Inspection'];
								$Other				  			= $row_cea['Other'];
								$Comments						= $row_cea['Comments'];
							};
							
							if($Modification == "-" or $Modification == ""){
								continue;
							}
							echo "	
									<tr>
										<td class=\"mytd\">";
											if($Modification == "o")
											{
												echo "O";
											}
											else if($Modification == "m1")
											{
												echo "M1";
											}
											else if($Modification == "m2")
											{
												echo "M2";
											}
											else
											{
												echo "M3";
											}
											echo "
									</td>
									<td class=\"mytd\" >";
											$query_cea		= "select Inspection3StcompMatrixGroupID, StcompMatrixGroupCode from bms_inspection3stcompmatrixgroup where Inspection3StcompMatrixGroupID =".$Inspection3StcompMatrixID_GR;						
											$result_cea		= mysql_query($query_cea) or die (mysql_error());
												while($row_cea	= mysql_fetch_array($result_cea))
												{
													$Inspection3StcompMatrixID  = $row_cea['Inspection3StcompMatrixGroupID'];
													$StcompMatrixCode			= $row_cea['StcompMatrixGroupCode'];
												}
												echo $StcompMatrixCode;
												if($Inspection3StcompMatrixVal_GR != 0)
												{
													echo $Inspection3StcompMatrixVal_GR;
												};
										echo "
									</td>
									<td class=\"mytd\" >";
											$query_cea		= "select Inspection3StcompMatrixID, StcompMatrixCode from bms_inspection3stcompmatrix where Inspection3StcompMatrixID =".$Inspection3StcompMatrixID_CM;		
											$result_cea		= mysql_query($query_cea) or die (mysql_error());
												while($row_cea	= mysql_fetch_array($result_cea))
												{
													$Inspection3StcompMatrixID  = $row_cea['Inspection3StcompMatrixID'];
													$StcompMatrixCode			= $row_cea['StcompMatrixCode'];
												}
												echo $StcompMatrixCode;
												if($Inspection3StcompMatrixVal_CM != 0)
												{
													echo $Inspection3StcompMatrixVal_CM;
												};
										echo "
									</td>
									<td class=\"mytd\" >";
											$query_cea		= "select Inspection3StcompScheduleID, Inspection3StcompScheduleNo, Inspection3StcompScheduleUnit from bms_inspection3stcompschedule where Inspection3StcompScheduleID =".$Inspection3StcompScheduleID;		
											$result_cea		= mysql_query($query_cea) or die (mysql_error());
												while($row_cea	= mysql_fetch_array($result_cea))
												{
													$Inspection3StcompScheduleID  = $row_cea['Inspection3StcompScheduleID'];
													$Inspection3StcompScheduleNo  = $row_cea['Inspection3StcompScheduleNo'];
													$Inspection3StcompScheduleUnit= $row_cea['Inspection3StcompScheduleUnit'];
												};
												echo $Inspection3StcompScheduleNo;
											echo "
										</select>
									</td>	
									<td class=\"mytd\" >";
										if($ExporsureClass != 0)
										{
											echo $ExporsureClass;
										};
										echo "
									</td>
									<td class=\"mytd\" >";
										if($ConditionState != 0)
										{
											echo $ConditionState;
										};
										echo "
									</td>
									<td class=\"mytd\">";
											if($Monitor == "y")
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
											if($Level3Inspection == "y")
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
											if($Other == "y")
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
										echo $Comments;
									echo "
									</td>
									<span name=\"des\" id=\"des\"></span></td>
									</tr>
									";
						}
					echo "</table>";
					
					
				echo "<br /><br /><hr><br /><br />";
				
				
				
					echo "<p class=\"bodytextbold\"><u>Photos and Sketches</u></p>";
					echo " <table>
											<tr>
											<td class=\"myth\" width=\"185\">Modification</td>
											<td class=\"myth\" width=\"185\">Group</td>
											<td class=\"myth\" width=\"185\">Component</td>
											<td class=\"myth\" width=\"185\">Description</td>
											<td class=\"myth\" width=\"185\">Sketch Number</td>
											<td class=\"myth\" width=\"185\">Sketch Upload - 1</td>
											<td class=\"myth\" width=\"185\">Sketch Upload - 2</td>
											<td class=\"myth\" width=\"185\">Sketch Upload - 3</td>
											<td class=\"myth\" width=\"185\">Sketch Upload - 4</td>
											<td class=\"myth\" width=\"185\">Sketch Upload - 5</td>
											</tr>";
							echo "</br>";
						for($i=1; $i <= 20; $i++)
						{
						
							$query_cea		= "select * from bms_inspection3photosketchdatas where bms_inspection3headerdatas_Inspection3HeaderDataID =".$Inspection3HeaderDataID." AND ival =".$i;		
							$result_cea		= mysql_query($query_cea) or die (mysql_error());
							if(mysql_num_rows($result_cea) < 1){
								continue;
							}
							while($row_cea	= mysql_fetch_array($result_cea))
							{
								$Modification  					= $row_cea['Modification'];
								$Inspection3StcompMatrixID_GR	= $row_cea['bms_inspection3stcompmatrix_Inspection3StcompMatrixGroupID'];
								$Inspection3StcompMatrixVal_GR  = $row_cea['Inspection3StcompMatrixGroupVal'];
								$Inspection3StcompMatrixID_CM	= $row_cea['bms_inspection3stcompmatrix_Inspection3StcompMatrixID_CM'];
								$Inspection3StcompMatrixVal_CM  = $row_cea['Inspection3StcompMatrixVal_CM'];
								$Description					= $row_cea['Description'];
								$SketchNo		  				= $row_cea['SketchNo'];
								$lcase_ext1						= $row_cea['Filext1'];
								$lcase_ext2						= $row_cea['Filext2'];
								$lcase_ext3						= $row_cea['Filext3'];
								$lcase_ext4						= $row_cea['Filext4'];
								$lcase_ext5						= $row_cea['Filext5'];
							};
							
							if($Modification == "-" or $Modification == ""){
								continue;
							}
							echo "	
									<tr>
										<td class=\"mytd\">";
											if($Modification == "o")
											{
												echo "O";
											}
											else if($Modification == "m1")
											{
												echo "M1";
											}
											else if($Modification == "m2")
											{
												echo "M2";
											}
											else
											{
												echo "M3";
											}
											echo "
									</td>
									<td class=\"mytd\" >";
											$query_cea		= "select Inspection3StcompMatrixGroupID, StcompMatrixGroupCode from bms_inspection3stcompmatrixgroup where Inspection3StcompMatrixGroupID =".$Inspection3StcompMatrixID_GR;		
											$result_cea		= mysql_query($query_cea) or die (mysql_error());
												while($row_cea	= mysql_fetch_array($result_cea))
												{
													$Inspection3StcompMatrixID  = $row_cea['Inspection3StcompMatrixGroupID'];
													$StcompMatrixCode			= $row_cea['StcompMatrixGroupCode'];
												}
												echo $StcompMatrixCode;
												if($Inspection3StcompMatrixVal_GR != 0)
												{
													echo $Inspection3StcompMatrixVal_GR;
												};
										echo "
									</td>
									<td class=\"mytd\" >";
											$query_cea		= "select Inspection3StcompMatrixID, StcompMatrixCode from bms_inspection3stcompmatrix where Inspection3StcompMatrixID =".$Inspection3StcompMatrixID_CM;		
											$result_cea		= mysql_query($query_cea) or die (mysql_error());
												while($row_cea	= mysql_fetch_array($result_cea))
												{
													$Inspection3StcompMatrixID  = $row_cea['Inspection3StcompMatrixID'];
													$StcompMatrixCode			= $row_cea['StcompMatrixCode'];
												}
												echo $StcompMatrixCode;
												if($Inspection3StcompMatrixVal_CM != 0)
												{
													echo $Inspection3StcompMatrixVal_CM;
												};
										echo "
									</td>
									<td class=\"mytd\">";
										echo $Description;
									echo "
									</td>
									<td class=\"mytd\">";
										echo $SketchNo;
										echo "
									</td>
										<td  class=\"mytd\"  align=\"center\">";							
											$x1	= '';
											$x1	= "Sketch".$i." - 1";
											$filepath1	= '';
											if($lcase_ext1	!= ""){
												$filepath1	= $pathprefix."inspection2/fileattachment/".$Inspection3HeaderDataID."-".$i.".".$lcase_ext1;
												echo "<a href=\"".$filepath1."\">".$x1."</a>";	
											}else{
												echo "--";
											}
											echo "
										</td>";
											echo "
											<span name=\"des\" id=\"des\"></span></td>";
											//////////////////////////////////////////////////////
											
											echo "
										<td  class=\"mytd\"  align=\"center\">";							
											$x2	= '';
											$x2	= "Sketch".$i." - 1";
											$filepath2	= '';
											if($lcase_ext2	!= ""){
												$filepath2	= $pathprefix."inspection2/fileattachment/".$Inspection3HeaderDataID."-".$i.".".$lcase_ext2;
												echo "<a href=\"".$filepath2."\">".$x2."</a>";	
											}else{
												echo "--";
											}
											echo "
										</td>
										<td  class=\"mytd\"  align=\"center\">";							
											$x3	= '';
											$x3	= "Sketch".$i." - 1";
											$filepath3	= '';
											if($lcase_ext3	!= ""){
												$filepath3	= $pathprefix."inspection2/fileattachment/".$Inspection3HeaderDataID."-".$i.".".$lcase_ext3;
												echo "<a href=\"".$filepath3."\">".$x3."</a>";	
											}else{
												echo "--";
											}
											echo "
										</td>
										<td  class=\"mytd\"  align=\"center\">";							
											$x4	= '';
											$x4	= "Sketch".$i." - 1";
											$filepath4	= '';
											if($lcase_ext4	!= ""){
												$filepath4	= $pathprefix."inspection2/fileattachment/".$Inspection3HeaderDataID."-".$i.".".$lcase_ext4;
												echo "<a href=\"".$filepath4."\">".$x4."</a>";	
											}else{
												echo "--";
											}
											echo "
										</td>
										<td  class=\"mytd\"  align=\"center\">";							
											$x5	= '';
											$x5	= "Sketch".$i." - 1";
											$filepath5	= '';
											if($lcase_ext5	!= ""){
												$filepath5	= $pathprefix."inspection2/fileattachment/".$Inspection3HeaderDataID."-".$i.".".$lcase_ext5;
												echo "<a href=\"".$filepath5."\">".$x5."</a>";	
											}else{
												echo "--";
											}
											echo "
										</td>
									</tr>
									";
						}
					echo "</table>";
					
					
					
				echo "<br /><br /><hr><br /><br />";
				
				
				
					echo "<p class=\"bodytextbold\"><u>Comments</u></p>";
					
						echo "<table class=\"bodytext\">";
							echo "<tr>";
								echo "<td class=\"altmytd\">";
											echo $GeneralComment;
										echo "</td>";
								echo "</tr>";
								
						echo "</table>";
				
				
		
		
	}
	else{
	
	
			$BridgeProfileID = $_SESSION['BridgeProfileID'];
			
			
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

						$Inspection3HeaderDataID= $row_fac['Inspection3HeaderDataID'];
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