<?php
	session_start();
	include ("../global.php");
	include ("../top.php");

if(!isset($_POST['more']))
	unset($_SESSION['more']);


$BridgeProfileID	= 0;
if(isset($_POST['SearchString']) )
{
	$elements               = array();
	$separator              = "(";
	$elements               = explode($separator, $_POST['SearchString']);

	if($elements['1'] == '' or !isset($elements['1']))
	{
		$searchUsername =  $elements['0'];		
	}
	else
	{
	
		$separator = "Structure ID : ";			
		$elements       = explode($separator, $elements['1']);			
		$searchUsername =  $elements['1'];
		
		
		
		$separator = ")";			
		$elements       = explode($separator, $searchUsername);			
		$searchUsername =  $elements['0'];
		
	}

	$query_bsr_resource = "select * from bms_bridgeprofiles where StructureID=\"".$searchUsername."\" and sections_SectionID=".$_SESSION['logined_sections_SectionID'];        
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
	
	
	$spanmaterials_SpanMaterialID_spgrou[$i] 		= array();
	$spantypes_SpanTypeID_spgroup					= array();	
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
	$abutmentmaterials_AbutmentMaterialID_foun_abunt= array();
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
		$spantypes_SpanTypeID_spgroup[$i]		= $row_bsr['spantypes_SpanTypeID'];
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
	}
	
	
	$i	= 0;
	$query_bsr_resource = "select * from bms_wingwallfoundations where bridgeprofile_BridgeProfileID=".$BridgeProfileID." order by WingWallPosition";        
	$result_bsr_resource = mysql_query($query_bsr_resource) or die (mysql_error());
	while($row_bsr = mysql_fetch_array($result_bsr_resource))
	{	
		$i++;
		$wingtypes_WingTypeID_foun_ww[$i]			= $row_bsr['wingfoundationtypes_WingFoundationTypeID'];
		$wingmaterials_WingMaterialID_foun_ww[$i]	= $row_bsr['wingfoundationmaterials_WingFoundationMaterialID'];
	}
}
	
	echo "<head>";

	echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"../common/common.css\" />";
	echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"../lib/jquery/cal/cal.css\" />";
		
	
?>

		
	<link href="../lib/jquery/development-bundle/themes/base/jquery.ui.all.css" rel="stylesheet" type="text/css"/>
	<script src="../lib/jquery/js/jquery-1.5.1.min.js"></script>
	<script src="../lib/jquery/js/jquery-ui-1.8.12.custom.min.js"></script>
	<script type="text/javascript" src="../lib/jquery/cal/cal.js"></script> 


	<script>
		
		$(document).ready(function() {
			$("#tabs").tabs();	
			
			$("#dateofinspection").datepicker({
                altField: '#realdate', 
                dateFormat:'yy-mm-dd'
			}); 

			$("input#SearchString").autocomplete({
				source: [<?php 
							$sections_SectionID	= $_SESSION['logined_sections_SectionID'];
							$bsr = array();
							$counterA=0;
							$query_bsr = "select * from bms_bridgeprofiles where sections_SectionID=".$sections_SectionID." order by StructureID";        
							$result_bsr = mysql_query($query_bsr) or die (mysql_error());
							while($row_user = mysql_fetch_array($result_bsr))
							{
								echo "\"".$row_user['StructureID']."\",";
							}
		
				
		
		
							$query_bsr = "select * from bms_bridgeprofiles where sections_SectionID=".$sections_SectionID." order by BridgeName";        
							$result_bsr = mysql_query($query_bsr) or die (mysql_error());
							while($row_user = mysql_fetch_array($result_bsr))
							{
								echo "\"".$row_user['BridgeName']." (Structure ID : ".$row_user['StructureID'].")\",";
								
							}?>]
			});
			
	

			$("#operationstdate").datepicker({
                altField: '#realdate', 
                dateFormat:'yy-mm-dd'
			});   
			
			
			$("#dateofninspection").datepicker({
                altField: '#realdate', 
                dateFormat:'yy-mm-dd'
			}); 

			
			
			<?php 
				if($funcofbridges_FuncOfBridgeID == 1)
				{
				?>
					$('#div_nriver').show();	
					$('#div_nuproad').hide();
					$('#div_noproad').hide();
					$('#div_norail').hide();
				<?php
				}
				else if($funcofbridges_FuncOfBridgeID == 2)
				{
				?>
					$('#div_nriver').hide();	
					$('#div_nuproad').show();
					$('#div_noproad').hide();
					$('#div_norail').hide();
				<?php
				}
				else if($funcofbridges_FuncOfBridgeID == 3)
				{
				?>
					$('#div_nriver').hide();	
					$('#div_nuproad').hide();
					$('#div_noproad').show();
					$('#div_norail').hide();
				<?php
				}
				else if($funcofbridges_FuncOfBridgeID == 5)
				{
				?>
					$('#div_nriver').hide();	
					$('#div_nuproad').hide();
					$('#div_noproad').hide();
					$('#div_norail').show();
				<?php
				}
				else
				{				
				?>
					$('#div_nriver').hide();	
					$('#div_nuproad').hide();
					$('#div_noproad').hide();
					$('#div_norail').hide();
				<?php
				}
				
				
				
				if($funcofbridges_FuncOfBridgeID == 1)
				{
				?>
					$('#clearance_wt_pwc').show();
					$('#clearance_wt_twc').show();
					$('#clearance_wt_ph').show();
					$('#clearance_wt_pss').show();				
					
					$('#clearance_nonwt_p').hide();
					$('#clearance_nonwt_tb').hide();
				<?php
				}
				else
				{
				?>
					$('#clearance_wt_pwc').hide();
					$('#clearance_wt_twc').hide();
					$('#clearance_wt_ph').hide();
					$('#clearance_wt_pss').hide();				
					
					$('#clearance_nonwt_p').show();
					$('#clearance_nonwt_tb').show();
				<?php
				}
				
				
				for($i=1; $i<=15; $i++)
				{
					if($i<=$NoOfSpans)
					{
					?>
						$('#spgroup<?php echo $i; ?>').show();	
						$('#deck<?php echo $i; ?>').show();
					<?php
					}
					else
					{
					?>
						$('#spgroup<?php echo $i; ?>').hide();	
						$('#deck<?php echo $i; ?>').hide();
						
					<?php						
					}
					
					
					if($i<=$NoOfPiers)
					{
					?>
						$('#sub_pier_<?php echo $i; ?>').show();	
						$('#foun_pier_<?php echo $i; ?>').show();
											
					<?php
					}
					else
					{
					?>
						$('#sub_pier_<?php echo $i; ?>').hide();	
						$('#foun_pier_<?php echo $i; ?>').hide();				
					<?php
					}
					
				}	
				
				
			?>
			
			$('#mysublasttr').hide();	
			
			
		});
		
		
		function selfunnumspan(selectobj){
			var val;
			val	= selectobj.value;
			for(var i=1; i<=15; i++)
			{
				if(i<=val)
					$('#spgroup'+i).show();	
				else
					$('#spgroup'+i).hide();	
			}

			for(var i=1; i<=15; i++)
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
			for(var i=1; i<=15; i++)
			{
				if(i<=val)
					$('#sub_pier_'+i).show();	
				else
					$('#sub_pier_'+i).hide();	
			}

			for(var i=1; i<=15; i++)
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

                if (window.XMLHttpRequest)
                {
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
	

		
		
	echo "<p class=\"hx1\">View Routine Maintenance Inspection Report</p>";
	
	
	echo "<form autocomplete=\"off\"  name=\"myfirstformx\" id=\"myfirstformx\" method=\"POST\" action=\"#\"  >";
		
		
		echo "
		<table class=\"bodytext\">
		<tr>
			<td width =\"160\" class=\"mytd\">
				Search Bridge Profile
			</td>
			<td class=\"mytd\">
				<input type=\"text\"  name=\"SearchString\" size=\"40\" id=\"SearchString\" class=\"inputText\" size=\"55\" />
			</td>
			<td class=\"mytd\">
				<input name=\"go\"  type=\"submit\"  class=\"Submit_Button_Long\" id=\"bms_Search\" value=\"Select\"  />
			</td>
			<td><span id=\"SearchString_id\" class=\"bodytextred\"></span></td>	
		</tr>	
		</table>
		</form>";
	
	if(isset($_POST['SearchString']) and $BridgeProfileID>0 )
	{
		
			echo "<form autocomplete=\"off\"  name=\"myfirstformxx\" id=\"myfirstformxx\" method=\"POST\" action=\"#\"  >";
				
			
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
							
							echo "<td class=\"myth\">";
								echo "<strong>Action</strong>";
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
								
													
						echo "<form name=\"selectuser\" id=\"selectuser\" method=\"POST\" autocomplete=\"off\" action=\"#\">";
						if($temp%2 == 0)
						{
							echo "<td class=\"mytd\">";
						}
						else
						{
							echo "<td class=\"altmytd\">";				
						}						
							echo "<input type=\"submit\" name=\"more\" value=\"More Info\"  class=\"Submit_Button_long\" />";	
							echo "<input type=\"hidden\" name=\"Inspection1HeaderDataID\" value=".$Inspection1HeaderDataID.">";
							echo "<input type=\"hidden\" name=\"BridgeProfileID\" value=".$BridgeProfileID.">";								
							echo "<input type=\"hidden\" name=\"select\" value=\"select\">";	
			
							echo "</td>";
						echo "</form>";
								
						echo "</tr>";
					}
					echo "</table>";	
				}
				
			$_SESSION['BridgeProfileID'] = $BridgeProfileID;
			
			echo "
			<br />
			<table align=\"right\">
				<tr>
					<td>
						<a  target=\"_blank\" href=\"./view_inspection1_main_01.php\"><input type=\"button\" name=\"print\" value=\"Print\" class=\"Submit_Button_Long\"></a>
					</td>
				</tr>
			</table>
			";
	}
	
	
	
	if(isset($_POST['more']))
	{
			$BridgeProfileID 			= $_POST['BridgeProfileID'];
			$Inspection1HeaderDataID 	= $_POST['Inspection1HeaderDataID'];
			
			echo "<form autocomplete=\"off\"  name=\"myfirstformyy\" id=\"myfirstformyy\" method=\"POST\" action=\"#\"  >";
			
			
			$query_ea		= "select * from bms_bridgeprofiles where BridgeProfileID = ".$BridgeProfileID;		
			$result_fac		= mysql_query($query_ea) or die (mysql_error());
			while($row_fac	= mysql_fetch_array($result_fac))
			{
				$StructureID  	= $row_fac['StructureID'];
				$BridgeName		= $row_fac['BridgeName'];
			}

			$query_valm	= "select * from bms_inspection1headerdatas where Inspection1HeaderDataID =".$Inspection1HeaderDataID;
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
		?>
		

		<div id="tabs">
			<ul>
				<li><a href="#fragment-1"><span>Approaches</span></a></li>
				<li><a href="#fragment-2"><span>Bridge Surface</span></a></li>
				<li><a href="#fragment-3"><span>Waterway</span></a></li>
				<li><a href="#fragment-4"><span>SubStructure</span></a></li>
				<li><a href="#fragment-5"><span>Superstructure</span></a></li>
				<li><a href="#fragment-6"><span>Miscellaneous</span></a></li>
				<li><a href="#fragment-7"><span>Culverts</span></a></li>
				<li><a href="#fragment-8"><span>Comments</span></a></li>
			</ul>
		
			<div id="fragment-1">
			<?php
			
					
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
				}			
			
			?>
			</div>
			
				
			<div id="fragment-2">
			<?php
				
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
			
			?>
			</div>
				

			<div id="fragment-3">
			<?php
				
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
					
				}
				
			
			?>
			</div>
				
				
			<div id="fragment-4">
			<?php
				
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
			
			?>
			</div>
			
				
			<div id="fragment-5">
			<?php		
			
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
				
			?>
			</div>
					
			
			<div id="fragment-6">
			<?php	
			
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
					
				}
			
			?>
			</div>
			
				
			<div id="fragment-7">
			<?php		
			
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
			?>
			</div>

			
			<div id="fragment-8">
			<?php		
				echo "<p class=\"bodytextbold\"><u>Comments</u></p>";
				
					echo "<table class=\"bodytext\">";
						echo "<tr>";
							echo "<td class=\"mytd\" widht=\"100\" word-wrap=\"yes\" height=\"250\">";
										echo $GeneralComment;
									echo "</td>";
							echo "</tr>";
							
							echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";

					echo "</table>";	
			?>
			</div>
			
			</div>

		</form>
<?php
			$_SESSION['more'] = "more";
			$_SESSION['BridgeProfileID'] = $BridgeProfileID;
			$_SESSION['Inspection1HeaderDataID'] = $Inspection1HeaderDataID;
			echo "
			<br />
			<table align=\"right\">
				<tr>
					<td>
						<a  target=\"_blank\" href=\"./view_inspection1_main_01.php\"><input type=\"button\" name=\"print\" value=\"Print\" class=\"Submit_Button_Long\"></a>
					</td>
				</tr>
			</table>
			";
	}

	echo "</body>";
	include '../bottom.php';

?>