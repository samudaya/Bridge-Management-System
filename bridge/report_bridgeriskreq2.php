<?php
	include ("../global.php");
	include ("../top.php");

$BridgeProfileID	= 0;
if(isset($_POST['SearchString']) or $_POST['BridgeProfileIDX']>0)
{
	if(!isset($_POST['BridgeProfileIDX']))
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
				echo $$key = stripslashes( $val );
			}				
		}
	}
	else
	{
		$query_bsr_resource = "select * from bms_bridgeprofiles where BridgeProfileID=\"".$_POST['BridgeProfileIDX']."\"  and sections_SectionID=".$_SESSION['logined_sections_SectionID'];           
		$result_bsr_resource = mysql_query($query_bsr_resource) or die (mysql_error());
		while($row_bsr = mysql_fetch_array($result_bsr_resource))
		{			
			foreach($row_bsr AS $key => $val )
			{
				$$key = stripslashes( $val );

			}				
		}
	
	
	}
	
	
	if($_POST['BridgeProfileIDX'] > 0)
		$BridgeProfileID	= $_POST['BridgeProfileIDX'];
	
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
	$comment_spgroup[$i] 							= array();
	$comment_deck									= array();
	
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
		$comment_spgroup[$i]					= $row_bsr['Original'];

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
		$comment_deck[$i]							= $row_bsr['Original'];
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
	echo "<script src=\"../lib/jquery.autocomplete-1.1.3/jquery.autocomplete-min.js\"></script>";	
	
?>

		
		<link href="../lib/jquery/development-bundle/themes/base/jquery.ui.all.css" rel="stylesheet" type="text/css"/>
	<script src="../lib/jquery/js/jquery-1.5.1.min.js"></script>
	<script src="../lib/jquery/js/jquery-ui-1.8.12.custom.min.js"></script>
	<script type="text/javascript" src="../lib/jquery/cal/cal.js"></script> 

	<script>
		
		$(document).ready(function() {
			$("#tabs").tabs();	
			
			
			
			
			
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
	

		
	echo "<p class=\"hx1\">View Bridge Report - III</p>";

	//	Save data to data base.........
	

	
	echo "<form autocomplete=\"off\"  name=\"myfirstformx\" id=\"myfirstformx\" method=\"POST\" action=\"#\"  >";
		echo "<table>";					
			echo "<tr>";
				echo "<td colspan=\"3\">";
					echo "&nbsp";
				echo "</td>";
			echo "</tr>";
			
			echo "<tr>";
				echo "<td class=\"mytd\"  width=\"185\">";
					echo "<b>Maintainance Required</b>";
				echo "</td>";
				echo "<td class=\"mytd\">";
					echo "<select name=\"MainReq\" class=\"myselect1\">";
						echo "<option>All </option>
							<option value=\"y\" ";
							if(isset($_POST['MainReq']) and $_POST['MainReq'] == "y"){
								echo "selected = 'selected' ";
							}
							echo ">Yes</option>
							<option value=\"n\" ";
							if(isset($_POST['MainReq']) and $_POST['MainReq'] == "n"){
								echo "selected = 'selected' ";
							}
							echo ">No</option>";
					echo "</select>";								
					echo "</td>";
				echo "</tr>";
				
				echo "<tr>";
				echo "<td class=\"altmytd\">";
					echo "<b>Condition State</b>";
				echo "</td>";
				echo "<td class=\"altmytd\">";
					echo "<select name=\"ConState\" class=\"myselect1\">";
						echo "<option>All </option>
							<option value=\"1\" ";
							if(isset($_POST['ConState']) and $_POST['ConState'] == "1"){
								echo "selected = 'selected' ";
							}
							echo ">1</option>
							<option value=\"2\" ";
							if(isset($_POST['ConState']) and $_POST['ConState'] == "2"){
								echo "selected = 'selected' ";
							}
							echo ">2</option>
							<option value=\"3\" ";
							if(isset($_POST['ConState']) and $_POST['ConState'] == "3"){
								echo "selected = 'selected' ";
							}
							echo ">3</option>
							<option value=\"4\" ";
							if(isset($_POST['ConState']) and $_POST['ConState'] == "4"){
								echo "selected = 'selected' ";
							}
							echo ">4</option>";
					echo "</select>";						
					echo "</td>";
				echo "</tr>";
				
				echo "<tr>";
				echo "<td class=\"mytd\">";
					echo "<b>Level 3 Inspection Required</b>";
				echo "</td>";
				echo "<td class=\"mytd\">";
					echo "<select name=\"InReq\" class=\"myselect1\">";
						echo "<option>All </option>
							<option value=\"y\" ";
							if(isset($_POST['InReq']) and $_POST['InReq'] == "y"){
								echo "selected = 'selected' ";
							}
							echo ">Yes</option>
							<option value=\"n\" ";
							if(isset($_POST['InReq']) and $_POST['InReq'] == "n"){
								echo "selected = 'selected' ";
							}
							echo ">No</option>";
					echo "</select>";								
					echo "</td>";
				echo "</tr>";
				
				echo "<tr>";
				echo "<td class=\"altmytd\">";
					echo "<b>Monitoring Required</b>";
				echo "</td>";
				echo "<td class=\"altmytd\">";
					echo "<select name=\"MonReq\" class=\"myselect1\">";
						echo "<option>All </option>
							<option value=\"y\" ";
							if(isset($_POST['MonReq']) and $_POST['MonReq'] == "y"){
								echo "selected = 'selected' ";
							}
							echo ">Yes</option>
							<option value=\"n\" ";
							if(isset($_POST['MonReq']) and $_POST['MonReq'] == "n"){
								echo "selected = 'selected' ";
							}
							echo ">No</option>";
					echo "</select>";						
					echo "</td>";
				echo "</tr>";
				
			echo "<tr>";
				echo "<td>";
					echo "&nbsp";
				echo "</td>";
				echo "<td>";
					echo "<input type=\"submit\" name=\"select\" value=\"Select\"  class=\"Submit_Button_long\" />";	
				echo "</td>";
			echo "</tr>";	
		echo "</table>";				
	echo "</form>";
	
	

	
	if (isset ($_POST['select']))
	{		
		$MainReq        = $_POST['MainReq'];
		$ConState	    = $_POST['ConState'];
		$InReq     	    = $_POST['InReq'];
		$MonReq    	    = $_POST['MonReq'];
		

		
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


					echo "<td class=\"myth\">";
						echo "<strong>Action</strong>";
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
						$StructureIDx			= $row_fac['StructureID'];
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
							echo $StructureIDx;
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
							echo "<input type=\"hidden\" name=\"BridgeProfileIDX\" value=".$BridgeProfileID.">";	
							echo "<input type=\"hidden\" name=\"select\" value=\"select\">";	
							
							echo "<input type=\"hidden\" name=\"StructureIDxx\" value=".$StructureIDx.">";
							echo "<input type=\"hidden\" name=\"BridgeNamexx\" value='".$BridgeNameX."'>";
							
							echo "<input type=\"hidden\" name=\"StructureTypeName\" value=".$_POST['StructureTypeName'].">";	
							echo "<input type=\"hidden\" name=\"ConstructionMaterial\" value=".$_POST['ConstructionMaterial'].">";	
							echo "<input type=\"hidden\" name=\"ClimateZone\" value=".$_POST['ClimateZone'].">";	
							echo "<input type=\"hidden\" name=\"YearOfConstructionStartx\" value=".$_POST['YearOfConstructionStartx'].">";	
							
							
							
							echo "<input type=\"hidden\" name=\"MainReq\" value=".$_POST['MainReq'].">";	
							echo "<input type=\"hidden\" name=\"ConState\" value=".$_POST['ConState'].">";	
							echo "<input type=\"hidden\" name=\"InReq\" value=".$_POST['InReq'].">";	
							echo "<input type=\"hidden\" name=\"MonReq\" value=".$_POST['MonReq'].">";	
							
							
				
							echo "</td>";
						echo "</form>";
								
						echo "</tr>";
					}
				}
			}
		}				
		echo "</table>";	
		
		if(!isset($_POST['StructureIDxx']))
		{
			$_SESSION['BridgeProfileID'] 	= $BridgeProfileID;
			$_SESSION['MainReq'] 			= $MainReq;
			$_SESSION['ConState'] 			= $ConState;
			$_SESSION['InReq'] 				= $InReq;
			$_SESSION['MonReq'] 			= $MonReq;
			
				echo "
				<br />
				<table align=\"right\">
					<tr>
						<td>
							<a  target=\"_blank\" href=\"./report_bridgeriskreq2_main_01.php\"><input type=\"button\" name=\"print\" value=\"Print\" class=\"Submit_Button_Long\"></a>
						</td>
					</tr>
				</table>
				";
		}
	}
	
	
	
	
	if(isset($_POST['StructureIDxx']))
	{
		echo "<br />";
		echo "<br />";
		echo "<br />";
			echo "<span class=\"body\" ><b>";
			echo $_POST['StructureIDxx'];
			echo "&nbsp;&nbsp;&nbsp;";
			echo "-";
			echo "&nbsp;&nbsp;&nbsp;";
			echo $_POST['BridgeNamexx'];
		echo "<br />";
		echo "<br />";
		echo "</b></span>";
	}
	
	
	include ("view_bridge_more.php");	

	echo "</body>";
	include '../bottom.php';

?>