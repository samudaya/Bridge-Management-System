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
	
		
	echo "<p class=\"hx1\">View Structure Condition Inspection Report</p>";
	
	
	echo "<form autocomplete=\"off\"  name=\"myfirstformx\" id=\"myfirstformx\" method=\"POST\" action=\"#\"  >";
		
		$_SESSION['BridgeProfileID']=$BridgeProfileID;
		
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
							
							echo "<td class=\"myth\">";
								echo "<strong>Action</strong>";
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
							echo "<input type=\"hidden\" name=\"Inspection3HeaderDataID\" value=".$Inspection3HeaderDataID.">";
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
						<a  target=\"_blank\" href=\"./view_inspection3_main_01.php\"><input type=\"button\" name=\"print\" value=\"Print\" class=\"Submit_Button_Long\"></a>
					</td>
				</tr>
			</table>
			";
				
	}
	
	if(isset($_POST['more']))
	{
			$BridgeProfileID 			= $_POST['BridgeProfileID'];
			$Inspection3HeaderDataID 	= $_POST['Inspection3HeaderDataID'];
			
			echo "<form enctype=\"multipart/form-data\" autocomplete=\"off\"  name=\"myfirstformxx\" id=\"myfirstformxx\" method=\"POST\" action=\"#\"  >";
			
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
			?>
			
			
			<div id="tabs">
				<ul>
					<li><a href="#fragment-1"><span>Structure Condition</span></a></li>
					<li><a href="#fragment-2"><span>Defective Components</span></a></li>
					<li><a href="#fragment-3"><span>Photos and Sketches</span></a></li>
					<li><a href="#fragment-4"><span>Comments</span></a></li>
				</ul>
			
				<div id="fragment-1">
				<?php
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
				?>
				</div>
				
					
				<div id="fragment-2">
				<?php
					echo " <table>
											<tr>
											<td class=\"myth\" width=\"185\">Modification</td>
											<td class=\"myth\" width=\"185\">Group</td>
											<td class=\"myth\" width=\"185\">Component</td>
											<td class=\"myth\" width=\"185\">Standard Number</td>
											<td class=\"myth\" width=\"185\">Exposure Factor</td>
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
											else  if($Modification == "m3")
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
										if($ConditionState != 0)
										{
											echo $ConditionState;
										};
										echo "
									</td>
									<td class=\"mytd\" align=\"center\">";
											if($Monitor == "y")
											{
												echo "Yes";
											}
											else if($Monitor == "n")
											{
												echo "No";
											}else{
												echo "---";
											}
											echo "
									</td>
									<td class=\"mytd\" align=\"center\">";
											if($Level3Inspection == "y")
											{
												echo "Yes";
											}
											else if($Level3Inspection == "n")
											{
												echo "No";
											}else{
												echo "---";
											}
											echo "
									</td>
									<td class=\"mytd\" align=\"center\">";
											if($Other == "y")
											{
												echo "Yes";
											}
											else if($Other == "n")
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
				?>
				</div>
					

				<div id="fragment-3">
				<?php
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
							
						//For file attchement outside Document Root
							
						$_SESSION['filepathx'] = array();
						$_SESSION['fileidx'] = array();				
						$myfilepathi = 0;
				
				
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
									<td class=\"mytd\" align=\"center\">";
										echo $Description;
									echo "
									</td>
									<td class=\"mytd\" align=\"center\">";
										echo $SketchNo;
										echo "
									</td>
										<td  class=\"mytd\"  align=\"center\">";							
											$x1	= '';
											
											$myfilepathi++;
													
											$x1	= "Sketch".$i." - 1";
											$filepath1	= '';
											if($lcase_ext1	!= ""){
												
												$_SESSION['filepathx'][$myfilepathi]	= $datadir3;
												$_SESSION['fileidx'][$myfilepathi]		= $Inspection3HeaderDataID."-".$i."-1.".$lcase_ext1;
												echo "<a href=\"../download.php?id=".$myfilepathi."\" target=\"_blank\">".$x1."</a>";
													
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
											
											$myfilepathi++;
											
											$x2	= "Sketch".$i." - 2";
											$filepath2	= '';
											if($lcase_ext2	!= ""){
												$_SESSION['filepathx'][$myfilepathi]	= $datadir3;
												$_SESSION['fileidx'][$myfilepathi]		= $Inspection3HeaderDataID."-".$i."-2.".$lcase_ext2;
												echo "<a href=\"../download.php?id=".$myfilepathi."\" target=\"_blank\">".$x2."</a>";												
											}else{
												echo "--";
											}
											echo "
										</td>
										<td  class=\"mytd\"  align=\"center\">";							
											$x3	= '';
											
											$myfilepathi++;
											
											$x3	= "Sketch".$i." - 3";
											$filepath3	= '';
											if($lcase_ext3	!= ""){
												$_SESSION['filepathx'][$myfilepathi]	= $datadir3;
												$_SESSION['fileidx'][$myfilepathi]		= $Inspection3HeaderDataID."-".$i."-3.".$lcase_ext3;
												echo "<a href=\"../download.php?id=".$myfilepathi."\" target=\"_blank\">".$x3."</a>";												
											}else{
												echo "--";
											}
											echo "
										</td>
										<td  class=\"mytd\"  align=\"center\">";							
											$x4	= '';
											
											$myfilepathi++;
											
											$x4	= "Sketch".$i." - 4";
											$filepath4	= '';
											if($lcase_ext4	!= ""){
												$_SESSION['filepathx'][$myfilepathi]	= $datadir3;
												$_SESSION['fileidx'][$myfilepathi]		= $Inspection3HeaderDataID."-".$i."-4.".$lcase_ext4;
												echo "<a href=\"../download.php?id=".$myfilepathi."\" target=\"_blank\">".$x4."</a>";	
											}else{
												echo "--";
											}
											echo "
										</td>
										<td  class=\"mytd\"  align=\"center\">";							
											$x5	= '';
											
											$myfilepathi++;
											
											$x5	= "Sketch".$i." - 5";
											$filepath5	= '';
											if($lcase_ext5	!= ""){
												$_SESSION['filepathx'][$myfilepathi]	= $datadir3;
												$_SESSION['fileidx'][$myfilepathi]		= $Inspection3HeaderDataID."-".$i."-5.".$lcase_ext5;
												echo "<a href=\"../download.php?id=".$myfilepathi."\" target=\"_blank\">".$x5."</a>";
											}else{
												echo "--";
											}
											echo "
										</td>
									</tr>
									";
						}
					echo "</table>";
				?>
				</div>
					
					
				<div id="fragment-4">
				<?php		
					echo "<p class=\"bodytextbold\"><u>Comments</u></p>";
					
						echo "<table class=\"bodytext\">";
							echo "<tr>";
								echo "<td class=\"altmytd\">";
											echo $GeneralComment;
										echo "</td>";
								echo "</tr>";
								
						echo "</table>";	
				?>
				</div>
	
			</div>
		<?php
			$_SESSION['more'] = "more";
			$_SESSION['BridgeProfileID'] = $BridgeProfileID;
			$_SESSION['Inspection3HeaderDataID'] = $Inspection3HeaderDataID;
			echo "
			<br />
			<table align=\"right\">
				<tr>
					<td>
						<a  target=\"_blank\" href=\"./view_inspection3_main_01.php\"><input type=\"button\" name=\"print\" value=\"Print\" class=\"Submit_Button_Long\"></a>
					</td>
				</tr>
			</table>
			";
		?>
		</form>
<?php
	}
	echo "</body>";
	include '../bottom.php';

?>