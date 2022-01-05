<?php
	session_start();
	include ("../global.php");
	include ("../top.php");


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
			valid = true;
			if ( document.myfirstformxx.dateofinspection.value == "" )
				{
						uname_div=document.getElementById("dateofinspectio");
						uname_div.innerHTML = "Please Enter Inspection Date";
						valid = false;
				}
				
			if ( document.myfirstformxx.dateofninspection.value == "" )
				{
						passwd_div=document.getElementById("dateofninspectio");
						passwd_div.innerHTML = "Please Enter Next Inspection Date";
						valid = false;
				}
		
			if (valid == true)
			{
				$('#mysublasttr').show();	
				$('#mysubtr').hide();
			}
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


<script language="javascript" type="text/javascript">
	function SignificanceCheck(id,i){
		
		var significanceID = new Array();
		var significanceRate = new Array();
		<?php
			$i=0;
			$significance_query = "select * from bms_inspection3stcompmatrix";
			$significance_result = mysql_query($significance_query) or die (mysql_error());
			while($significance_row = mysql_fetch_array($significance_result)){
				echo "significanceID[".$i."] = ".$significance_row['Inspection3StcompMatrixID']."; ";
				echo "significanceRate[".$i."] = ".$significance_row['SignificanceRating']."; ";
				$i++;
			}
			
		?>
		
		var sigID = document.getElementById(id).value;
		var j=0;
		for(j=0; j<significanceID.length; j++){
			if(sigID == significanceID[j]){
				document.getElementById('significance_rate' + i).innerHTML = significanceRate[j];
				break;
			}else{
				document.getElementById('significance_rate' + i).innerHTML = " --- ";
			}
		}
	}
</script>


</head>


<?php	
	

	echo "<body autocomplete=\"off\" >";
	
	
	echo "<p class=\"hx1\">Edit Structure Condition Inspection Report</p>";
	

	//	Save data to data base.........
	

	if(isset($_POST['yes_submit']))
	{
		

		$BridgeProfileID 			= $_POST['BridgeProfileID'];
		$Inspection3HeaderDataID	= $_POST['Inspection3HeaderDataID'];
		
		$dateofinspection 			= $_POST['dateofinspection'];
		$dateofninspection 			= $_POST['dateofninspection'];
		$level2ins					= $_POST['level2ins'];
		$comment					= $_POST['comment'];		

		
		$ModifiedBy			= $_SESSION['log_UserID'];
		$ModifiedDate		= date("Y-m-d H:i:s");
		
		////////////////////////////////////////////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////////
		$query_resource = "update bms_inspection3headerdatas set InspectionDate = '$dateofinspection', NextInspectionDate = '$dateofninspection', Level2Inspection = '$level2ins', GeneralComment= '$comment', ModifiedBy = '$ModifiedBy', ModifiedDate = '$ModifiedDate' where Inspection3HeaderDataID = '$Inspection3HeaderDataID'";
		
		$result_resource = mysql_query($query_resource) or die (mysql_error());
				
		$users_UserID	= $ModifiedBy;
		$TableName		= "bms_inspection3headerdatas";		
		$SQLQuery 		= str_replace("'", "\'", $query_resource);
		$Action			= "UPDATE";		
		$query_log 		= "insert into bms_logs(users_UserID, TableName,	SQLQuery, 	Action) values ('".$users_UserID."','".$TableName."','". $SQLQuery."','". $Action."')";
		$result_log		= mysql_query($query_log) or die (mysql_error());
		////////////////////////////////////////////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////////

		for ($i = 1; $i <= 1000; $i++)
		{
			$ivalp	= $i;
			
			$modfiCIRP 		= "modfiCIR".$i;
			$groupCIRP		= "groupCIR".$i;
			$groupNoCIRP 	= "groupNoCIR".$i;
			$componentCIRP  = "componentCIR".$i;
			$componentNoCIRP= "componentNoCIR".$i;
			$standardNoCIRP = "standardNoCIR".$i;
			$expoClassCIRP  = "expoClassCIR".$i;
			$resisClassCIRP = "resisClassCIR".$i;
			$quantityCIRP   = "quantityCIR".$i."name";
			$quantityPCIRP  = "quantityPCIR".$i."name";
			$mainReqCIRP 	= "mainReqCIR".$i;
			$phTakenCIR 	= "phTakenCIR".$i;
			$commentCIRP 	= "commentCIR".$i."name";
					
			$modfiCIR 		= $_POST[$modfiCIRP];
			$groupCIR		= $_POST[$groupCIRP];
			$groupNoCIR		= $_POST[$groupNoCIRP];
			$componentCIR	= $_POST[$componentCIRP];		
			$componentNoCIR	= $_POST[$componentNoCIRP];
			$standardNoCIR	= $_POST[$standardNoCIRP];
			$expoClassCIR 	= $_POST[$expoClassCIRP];
			$resisClassCIR 	= $_POST[$resisClassCIRP];
			$quantityCIR	= $_POST[$quantityCIRP];
			$quantityPCIR	= $_POST[$quantityPCIRP];
			$mainReqCIR		= $_POST[$mainReqCIRP];
			$phTakenCIR		= $_POST[$phTakenCIR];
			$commentCIR		= $_POST[$commentCIRP];
			
			$ModifiedBy			= $_SESSION['log_UserID'];
			$ModifiedDate		= date("Y-m-d H:i:s");
			
			if(isset($_POST[$modfiCIRP]))
			{
			
						////////////////////////////////////////////////////////////////////////////////////
						////////////////////////////////////////////////////////////////////////////////////
						
					$query_resourceCIR = "update bms_inspection3stconinsdatas set `Modification` = '$modfiCIR', `bms_inspection3stcompmatrix_Inspection3StcompMatrixGroupID` = '$groupCIR', `Inspection3StcompMatrixGroupVal` = '$groupNoCIR', `bms_inspection3stcompmatrix_Inspection3StcompMatrixID_CM` = '$componentCIR', `Inspection3StcompMatrixVal_CM` = '$componentNoCIR', `bms_inspection3stcompschedule_Inspection3StcompScheduleID` = '$standardNoCIR', `ExporsureClass` = '$expoClassCIR', `ImportanceFactor` = '$resisClassCIR', `Quantity` = '$quantityCIR', `QuantityConState_1` = '$quantityPCIR', `MaintainRequired` = '$mainReqCIR', `PhotosTaken` = '$phTakenCIR', `Comments` = '$commentCIR' where `bms_inspection3headerdatas_Inspection3HeaderDataID` = '$Inspection3HeaderDataID' and `ival` = '$ivalp'"; 

						$result_resourceCIR = mysql_query($query_resourceCIR) or die (mysql_error());
								
						$users_UserID	= $ModifiedBy;
						$TableName		= "bms_inspection3stconinsdatas";		
						$SQLQuery 		= str_replace("'", "\'", $query_resourceCIR);
						$Action			= "UPDATE";		
						$query_log 		= "insert into bms_logs(users_UserID, TableName,	SQLQuery, 	Action) values ('".$users_UserID."','".$TableName."','". $SQLQuery."','". $Action."')";
						$result_log 	= mysql_query($query_log) or die (mysql_error());
			
			}
			
		}

		////////////////////////////////////////////////////////
		for ($i = 1; $i <= 20; $i++)
		{
			$ivalp	= $i;
			
			
			$modfiDCRP 		 = "modfiDCR".$i;
			$groupDCRP		 = "groupDCR".$i;
			$groupNoDCRP 	 = "groupNoDCR".$i;
			$componentDCRP   = "componentDCR".$i;
			$componentNoDCRP = "componentNoDCR".$i;
			$standardNoDCRP  = "standardNoDCR".$i;
			$expoClassDCRP   = "expoClassDCR".$i;
			$conStateDCRP    = "conStateDCR".$i;
			$descripDCRP     = "descripDCR".$i."name";
			$monitorDCRP     = "monitorDCR".$i;
			$level3DCRP      = "level3DCR".$i;
			$otherDCRP       = "otherDCR".$i;
					
			$modfiDCR 		= $_POST[$modfiDCRP];
			$groupDCR		= $_POST[$groupDCRP];
			$groupNoDCR		= $_POST[$groupNoDCRP];
			$componentDCR	= $_POST[$componentDCRP];		
			$componentNoDCR	= $_POST[$componentNoDCRP];
			$standardNoDCR	= $_POST[$standardNoDCRP];
			$expoClassDCR 	= $_POST[$expoClassDCRP];
			$conStateDCR	= $_POST[$conStateDCRP];
			$descripDCR		= $_POST[$descripDCRP];
			$monitorDCR		= $_POST[$monitorDCRP];		
			$level3DCR		= $_POST[$level3DCRP];
			$otherDCR		= $_POST[$otherDCRP];
			
			$ModifiedBy			= $_SESSION['log_UserID'];
			$ModifiedDate		= date("Y-m-d H:i:s");
			
			if(isset($_POST[$modfiDCRP]))
			{
			
						////////////////////////////////////////////////////////////////////////////////////
						////////////////////////////////////////////////////////////////////////////////////
						
					$query_resourceCIR = "update bms_inspection3defcomdatas set `Modification` = '$modfiDCR', `bms_inspection3stcompmatrix_Inspection3StcompMatrixGroupID` = '$groupDCR', `Inspection3StcompMatrixGroupVal` = '$groupNoDCR', `bms_inspection3stcompmatrix_Inspection3StcompMatrixID_CM` = '$componentDCR', `Inspection3StcompMatrixVal_CM` = '$componentNoDCR', `bms_inspection3stcompschedule_Inspection3StcompScheduleID` = '$standardNoDCR', `ExporsureClass` = '$expoClassDCR', `ConditionState` = '$conStateDCR', `Monitor` = '$monitorDCR', `Level3Inspection` = '$level3DCR', `Other` = '$otherDCR', `Comments` = '$descripDCR' where `bms_inspection3headerdatas_Inspection3HeaderDataID` = '$Inspection3HeaderDataID' and `ival` = '$ivalp'";
											
						$result_resourceCIR = mysql_query($query_resourceCIR) or die (mysql_error());
								
						$users_UserID	= $ModifiedBy;
						$TableName		= "bms_inspection3defcomdatas";		
						$SQLQuery 		= str_replace("'", "\'", $query_resourceCIR);
						$Action			= "UPDATE";		
						$query_log 		= "insert into bms_logs(users_UserID, TableName,	SQLQuery, 	Action) values ('".$users_UserID."','".$TableName."','". $SQLQuery."','". $Action."')";
						$result_log 	= mysql_query($query_log) or die (mysql_error());
			
			}
			
		}

		////////////////////////////////////////////////////////
		for ($i = 1; $i <= 20; $i++)
		{
			$ivalp	= $i;

			$modfisketchP 	 = "modfisketch".$i;
			$groupsketchP	 = "groupsketch".$i;
			$groupNosketchP  = "groupNosketch".$i;
			$componsketchP   = "componsketch".$i;
			$componNosketchP = "componNosketch".$i;
			$dessketchP      = "dessketch".$i."name";
			$sketchnoP       = "sketchno".$i."name";

					
			$modfisketch 	= $_POST[$modfisketchP];
			$groupsketch	= $_POST[$groupsketchP];
			$groupNosketch	= $_POST[$groupNosketchP];
			$componsketch	= $_POST[$componsketchP];		
			$componNosketch	= $_POST[$componNosketchP];
			$dessketch		= $_POST[$dessketchP];
			$sketchno 		= $_POST[$sketchnoP];
			
			$ModifiedBy			= $_SESSION['log_UserID'];
			$ModifiedDate		= date("Y-m-d H:i:s");
			
			if(isset($_POST[$modfisketchP]))
			{
			
						////////////////////////////////////////////////////////////////////////////////////
						////////////////////////////////////////////////////////////////////////////////////
						////////////////////////////////////////////////////////////////////////////////////
					$filename1	= '';
					$filename2	= '';
					$filename3	= '';
					$filename4	= '';
					$filename5	= '';
					$filename1 	= basename($_FILES['sketch'.$i.'name1']['name']);
					$filename2 	= basename($_FILES['sketch'.$i.'name2']['name']);
					$filename3 	= basename($_FILES['sketch'.$i.'name3']['name']);
					$filename4 	= basename($_FILES['sketch'.$i.'name4']['name']);
					$filename5 	= basename($_FILES['sketch'.$i.'name5']['name']);
					/////////////////
					$theFileSize = $HTTP_POST_FILES['ufile']['size'];
					
					/////////////////////////////////
					$ext1 = substr($filename1, strrpos($filename1, '.') + 1);
					$lcase_ext1 = strtolower($ext1);
					$ext2 = substr($filename2, strrpos($filename2, '.') + 1);
					$lcase_ext2 = strtolower($ext2);
					$ext3 = substr($filename3, strrpos($filename3, '.') + 1);
					$lcase_ext3 = strtolower($ext3);
					$ext4 = substr($filename4, strrpos($filename4, '.') + 1);
					$lcase_ext4 = strtolower($ext4);
					$ext5 = substr($filename5, strrpos($filename5, '.') + 1);
					$lcase_ext5 = strtolower($ext5);

					$target = $datadir3; 
					$target1 = $target . $Inspection3HeaderDataID."-".$i."-1.".$lcase_ext1;
					$target2 = $target . $Inspection3HeaderDataID."-".$i."-2.".$lcase_ext2;
					$target3 = $target . $Inspection3HeaderDataID."-".$i."-3.".$lcase_ext3;
					$target4 = $target . $Inspection3HeaderDataID."-".$i."-4.".$lcase_ext4;
					$target5 = $target . $Inspection3HeaderDataID."-".$i."-5.".$lcase_ext5;
					move_uploaded_file($_FILES['sketch'.$i.'name1']['tmp_name'],$target1);
					move_uploaded_file($_FILES['sketch'.$i.'name2']['tmp_name'],$target2);
					move_uploaded_file($_FILES['sketch'.$i.'name3']['tmp_name'],$target3);
					move_uploaded_file($_FILES['sketch'.$i.'name4']['tmp_name'],$target4);
					move_uploaded_file($_FILES['sketch'.$i.'name5']['tmp_name'],$target5);
						
						
					//////////////////////////////////////////////////////////////////////////////////////
					//////////////////////////////////////////////////////////////////////////////////////
					//////////////////////////////////////////////////////////////////////////////////////
						
					$query_resourceCIR = "update bms_inspection3photosketchdatas set `Modification` = '$modfisketch', `bms_inspection3stcompmatrix_Inspection3StcompMatrixGroupID` = '$groupsketch', `Inspection3StcompMatrixGroupVal` = '$groupNosketch', `bms_inspection3stcompmatrix_Inspection3StcompMatrixID_CM` = '$componsketch', `Inspection3StcompMatrixVal_CM` = '$componNosketch', ";
					if($lcase_ext1 != ""){
						$query_resourceCIR = $query_resourceCIR. "`Filext1` = '$lcase_ext1', ";
					}
					if($lcase_ext1 != ""){
						$query_resourceCIR = $query_resourceCIR. "`Filext2` = '$lcase_ext2', ";
					}
					if($lcase_ext1 != ""){
						$query_resourceCIR = $query_resourceCIR. "`Filext3` = '$lcase_ext3', ";
					}
					if($lcase_ext1 != ""){
						$query_resourceCIR = $query_resourceCIR. "`Filext4` = '$lcase_ext4', ";
					}
					if($lcase_ext1 != ""){
						$query_resourceCIR = $query_resourceCIR. "`Filext5` = '$lcase_ext5', ";
					}
					$query_resourceCIR = $query_resourceCIR. "`Description` = '$dessketch', `SketchNo` = '$sketchno' where `bms_inspection3headerdatas_Inspection3HeaderDataID` = '$Inspection3HeaderDataID' and `ival` = '$ivalp'";
											

						$result_resourceCIR = mysql_query($query_resourceCIR) or die (mysql_error());
								
						$users_UserID	= $ModifiedBy;
						$TableName		= "bms_inspection3photosketchdatas";		
						$SQLQuery 		= str_replace("'", "\'", $query_resourceCIR);
						$Action			= "UPDATE";		
						$query_log 		= "insert into bms_logs(users_UserID, TableName,	SQLQuery, 	Action) values ('".$users_UserID."','".$TableName."','". $SQLQuery."','". $Action."')";
						$result_log 	= mysql_query($query_log) or die (mysql_error());
			
			}
			
					$filename	= '';
					$filename 	= basename($_FILES['sketch'.$i.'name']['name']);
					
					$ext 		= substr($filename, strrpos($filename, '.') + 1);
					$lcase_ext 	= strtolower($ext);

					$target 	= $datadir3; 
					$target 	= $target . $Inspection3HeaderDataID."-".$i.".".$lcase_ext;
					move_uploaded_file($_FILES['sketch'.$i.'name']['tmp_name'],$target);		
		}

		echo "<p class=\"bodytextsus\"><BR />Successfully Edited ....<BR /></p>";		
	}
	else
	{
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
						
						echo "<input type=\"text\" class=\"mytextbox3\" name=\"dateofinspection\" id=\"dateofinspection\" value=\"$InspectionDate\"  onclick=\"return validate_dateofinspection( );\" >";
						echo "<div id=\"dateofinspectio\" class=\"bodytextred\"></div>";
					
					echo "</td>";
					echo "			
				</tr>							
				
				<tr>			
					<td class=\"mytd\" >Date of next Inspection</td>
					";
						echo "<td  class=\"mytd\">";					
						
						echo "<input type=\"text\" class=\"mytextbox3\" name=\"dateofninspection\" id=\"dateofninspection\" value=\"$NextInspectionDate\" onclick=\"return validate_dateofninspection ( );\">";
						echo "<div id=\"dateofninspectio\" class=\"bodytextred\"></div>";
					
					echo "</td>";
					echo "			
				</tr>								
				
				<tr>			
					<td class=\"mytd\" >Level 2 Inspection</td>
					
					<td class=\"mytd\">
						<select name=\"level2ins\">";
						if($Level2Inspection == "e")
						{
						echo "	
								<option value=\"e\">Exceptional</option>
								<option value=\"p\">Programmed</option>
								<option value=\"u\">Underwater</option>
								";
						}
						else if($Level2Inspection == "p")
						{
						echo "	
								<option value=\"p\">Programmed</option>
								<option value=\"e\">Exceptional</option>
								<option value=\"u\">Underwater</option>
								";
						}
						else
						{
						echo "	
								<option value=\"u\">Underwater</option>
								<option value=\"p\">Programmed</option>
								<option value=\"e\">Exceptional</option>
								";
						}
						echo "	
						</select>
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
											<td class=\"myth\" width=\"100\">Modification</td>
											<td class=\"myth\" width=\"100\">Group</td>
											<td class=\"myth\" width=\"100\">Component</td>
											<td class=\"myth\" width=\"100\">Weighted Factor</td>
											<td class=\"myth\" width=\"100\">Standard Number</td>
											<td class=\"myth\" width=\"100\">Exposure Factor</td>
											<td class=\"myth\" width=\"100\">Importance Factor</td>
											";
										
											echo"
											<td class=\"myth\" width=\"185\">Condition State 1</td>
											<td class=\"myth\" width=\"185\">Condition State 2</td>
											<td class=\"myth\" width=\"185\">Condition State 3</td>
											<td class=\"myth\" width=\"185\">Condition State 4</td>
											<td class=\"myth\" width=\"100\">Maintenance Required</td>
											<td class=\"myth\" width=\"100\">Photos Taken</td>
											<td class=\"myth\" width=\"100\">Comments</td>
											</tr>";
							echo "</br>";
						for($i=1; $i <= 1000; $i++)
						{
						
							$query_cea		= "select * from bms_inspection3stconinsdatas where bms_inspection3headerdatas_Inspection3HeaderDataID =".$Inspection3HeaderDataID." AND ival =".$i;		
							$result_cea		= mysql_query($query_cea) or die (mysql_error());
							while($row_cea	= mysql_fetch_array($result_cea))
							{
								
								$Modification  					= $row_cea['Modification'];
								$Inspection3StcompMatrixID_GR	= $row_cea['bms_inspection3stcompmatrix_Inspection3StcompMatrixGroupID'];
								$Inspection3StcompMatrixVal_GR  = $row_cea['Inspection3StcompMatrixGroupVal'];
								$Inspection3StcompMatrixID_CM	= $row_cea['bms_inspection3stcompmatrix_Inspection3StcompMatrixID_CM'];
								$Inspection3StcompMatrixVal_CM  = $row_cea['Inspection3StcompMatrixVal_CM'];
								$Inspection3StcompScheduleID	= $row_cea['bms_inspection3stcompschedule_Inspection3StcompScheduleID'];
								$ExporsureClass  				= $row_cea['ExporsureClass'];
								$ImportanceFactor				= $row_cea['ImportanceFactor'];
								$Quantity						= $row_cea['Quantity'];
								$QuantityConState_1  			= $row_cea['QuantityConState_1'];
								$QuantityConState_2				= $row_cea['QuantityConState_2'];
								$QuantityConState_3  			= $row_cea['QuantityConState_3'];
								$QuantityConState_4				= $row_cea['QuantityConState_4'];
								$MaintainRequired  				= $row_cea['MaintainRequired'];
								$PhotosTaken  					= $row_cea['PhotosTaken'];
								$Comments						= $row_cea['Comments'];
							};
							
							
							echo "	
									<tr>
										<td class=\"mytd\" align=\"center\">
											<select name=\"modfiCIR".$i."\" class=\"myselect00\">";
											if($Modification == "o")
											{
											echo "	
													<option value=\"-\">---</option>
													<option value=\"o\" selected='selected'>O</option>
													<option value=\"m1\">M1</option>
													<option value=\"m2\">M2</option>
													<option value=\"m3\">M3</option>
													";
											}
											else if($Modification == "m1")
											{
											echo "	
													<option value=\"-\">---</option>
													<option value=\"o\">O</option>
													<option value=\"m1\" selected='selected'>M1</option>
													<option value=\"m2\">M2</option>
													<option value=\"m3\">M3</option>
													";
											}
											else if($Modification == "m2")
											{
											echo "	
													<option value=\"-\">---</option>
													<option value=\"o\">O</option>
													<option value=\"m1\">M1</option>
													<option value=\"m2\" selected='selected'>M2</option>
													<option value=\"m3\">M3</option>
													";
											}
											else if($Modification == "m3")
											{
											echo "	
													<option value=\"-\">---</option>
													<option value=\"o\">O</option>
													<option value=\"m1\">M1</option>
													<option value=\"m2\">M2</option>
													<option value=\"m3\" selected='selected'>M3</option>
													";
											}
											else {
											echo "	
													<option value=\"-\">---</option>
													<option value=\"o\">O</option>
													<option value=\"m1\">M1</option>
													<option value=\"m2\">M2</option>
													<option value=\"m3\">M3</option>
													";
											}
											echo "	
											</select>
										</td>
										<td class=\"mytd\" align=\"center\">";
											$query_cea		= "select Inspection3StcompMatrixGroupID, StcompMatrixGroupCode from bms_inspection3stcompmatrixgroup order by Inspection3StcompMatrixGroupID";	
											$result_cea		= mysql_query($query_cea) or die (mysql_error());
											echo "<table class=\"bodytext\"><tr><td>";
												echo "<select name=\"groupCIR".$i."\" id=\"groupCIR".$i."\" class=\"myselect00\">";
													while($row_cea	= mysql_fetch_array($result_cea)){
														$temp++;
														$Inspection3StcompMatrixID  = $row_cea['Inspection3StcompMatrixGroupID'];
														$StcompMatrixCode			= $row_cea['StcompMatrixGroupCode'];
														echo "<option value = ".$Inspection3StcompMatrixID." ";
														if($Inspection3StcompMatrixID == $Inspection3StcompMatrixID_GR)
														{
															echo " selected ";
														}
														echo " >".$StcompMatrixCode."</option>";
													};
												echo "
												</select>
												</td>
												<td>
												<select name= \"groupNoCIR".$i."\" id=\"groupNoCIR".$i."\" class=\"myselect00\">";
												$x = 1;
												while($x < 20){
													echo "<option value = ".$x." ";
													if($x == $Inspection3StcompMatrixVal_GR)
													{
														echo " selected ";
													}
													echo " >".$x."</option>";
													$x++;
												}
												echo "</select>
												</td></tr>
											</table>";
										echo "
									</td>
									<td class=\"mytd\" align=\"center\">";
											$SignificanceRating = "---";
											$query_cea		= "select * from bms_inspection3stcompmatrix order by Inspection3StcompMatrixID";		
											$result_cea		= mysql_query($query_cea) or die (mysql_error());
										echo "<table class=\"bodytext\"><tr><td>";	
											echo "<select name=\"componentCIR".$i."\" id=\"componentCIR".$i."\" class=\"myselect00\" onchange=\"SignificanceCheck(this.id,".$i.");\">";
												while($row_cea	= mysql_fetch_array($result_cea)){
													$temp++;
													$Inspection3StcompMatrixID  = $row_cea['Inspection3StcompMatrixID'];
													$StcompMatrixCode			= $row_cea['StcompMatrixCode'];
													echo "<option value = ".$Inspection3StcompMatrixID." ";
													if($Inspection3StcompMatrixID == $Inspection3StcompMatrixID_CM)
													{
														echo " selected ";
														if($row_cea['SignificanceRating'] > 0){
															$SignificanceRating	= $row_cea['SignificanceRating'];
														}
													}
													echo " >".$StcompMatrixCode."</option>";
												};
											echo "
										</select>
										</td><td>
										<select name= \"componentNoCIR".$i."\" id=\"componentNoCIR".$i."\" class=\"myselect00\">";
										$x = 1;
										while($x < 20){
											echo "<option value = ".$x." ";
											if($x == $Inspection3StcompMatrixVal_CM)
											{
												echo " selected ";
											}
											echo " >".$x."</option>";
											$x++;
										}
										echo "</select>";
										echo "
										</td></tr>
										</table>
									</td>
									<td class=\"mytd\" align=\"center\">
										<span name=\"significance_rate".$i."\" id=\"significance_rate".$i."\"> ".$SignificanceRating." </span>
									</td>
									<td class=\"mytd\" align=\"center\">";
											$query_cea		= "select Inspection3StcompScheduleID, Inspection3StcompScheduleNo from bms_inspection3stcompschedule order by Inspection3StcompScheduleID";	
											$result_cea		= mysql_query($query_cea) or die (mysql_error());
										
											echo "<select name=\"standardNoCIR".$i."\" id=\"standardNoCIR".$i."\" class=\"myselect00\">";
												while($row_cea	= mysql_fetch_array($result_cea)){
													$temp++;
													$Inspection3StncompScheduleID  = $row_cea['Inspection3StcompScheduleID'];
													$Inspection3StncompScheduleNo  = $row_cea['Inspection3StcompScheduleNo'];
													echo "<option value = ".$Inspection3StncompScheduleID." ";
													if($Inspection3StncompScheduleID == $Inspection3StcompScheduleID)
													{
														echo " selected ";
													}
													echo " >".$Inspection3StncompScheduleNo."</option>";
												};
											echo "
										</select>
									</td>	
									<td class=\"mytd\" align=\"center\">";
									echo "
										<select name= \"expoClassCIR".$i."\" id=\"expoClassCIR".$i."\" class=\"myselect00\">";
										$x = 1;
										while($x < 5){
											echo "<option value = ".$x." ";
											if($x == $ExporsureClass)
											{
												echo " selected ";
											}
											echo " >".$x."</option>";
											$x++;
										}
										echo "</select>";
											echo "
									</td>
									<td class=\"mytd\"  align=\"center\">";
										echo "
										<select name= \"resisClassCIR".$i."\" id=\"resisClassCIR".$i."\" class=\"myselect00\">";
										$x = 1.00;
										while($x > 0.04){
											echo "<option value=\"".$x."\"  ";
											if($x == $ImportanceFactor)
											{
												echo " selected ";
											}
											echo " >".number_format($x,2)."</option>";
											$x = $x - 0.05;
										}
										echo "</select>";
										echo "
									</td>	
									<td class=\"mytd\" width=\"100\"  align=\"center\"> <input type=\"radio\" class=\"\" name=\"quantityPCIR".$i."name\"  id=\"quantityPCIR".$i."name\" value=\"1\" ";
										if($QuantityConState_1 == "1"){
											echo "checked = 'checked'";
										}
										echo " />
									</td>
									<td class=\"mytd\" width=\"100\" align=\"center\"> <input type=\"radio\" class=\"\" name=\"quantityPCIR".$i."name\"  id=\"quantityPCIR".$i."name\" value=\"2\" ";
										if($QuantityConState_1 == "2"){
											echo "checked = 'checked'";
										}
										echo " />
									</td>
									<td class=\"mytd\" width=\"100\" align=\"center\"> <input type=\"radio\" class=\"\" name=\"quantityPCIR".$i."name\"  id=\"quantityPCIR".$i."name\" value=\"3\" ";
										if($QuantityConState_1 == "3"){
											echo "checked = 'checked'";
										}
										echo " />
									</td>
									<td class=\"mytd\" width=\"100\" align=\"center\"> <input type=\"radio\" class=\"\" name=\"quantityPCIR".$i."name\"  id=\"quantityPCIR".$i."name\"  value=\"4\" ";
										if($QuantityConState_1 == "4"){
											echo "checked = 'checked'";
										}
										echo " />
									</td>
									<td class=\"mytd\" align=\"center\" >
										<select name=\"mainReqCIR".$i."\" class=\"myselect00\">";
										if($MaintainRequired == 'y')
										{
										echo "
												<option value=\"-\">---</option>
												<option value=\"y\" selected='selected'>Yes</option>
												<option value=\"n\">No</option>";
										}
										else if($MaintainRequired == 'n')
										{
										echo "
												<option value=\"-\">---</option>
												<option value=\"y\">Yes</option>
												<option value=\"n\" selected='selected'>No</option>";								
										}
										else
										{
										echo "
												<option value=\"-\">---</option>
												<option value=\"n\">No</option>
												<option value=\"y\">Yes</option>";								
										}
										echo "
										</select>
									</td>
									<td class=\"mytd\" align=\"center\" >
										<select name=\"phTakenCIR".$i."\" class=\"myselect00\">";
										if($PhotosTaken == 'y')
										{
										echo "
												<option value=\"-\">---</option>
												<option value=\"y\">Yes</option>
												<option value=\"n\">No</option>";
										}
										else
										{
										echo "
												<option value=\"-\">---</option>
												<option value=\"n\">No</option>
												<option value=\"y\">Yes</option>";								
										}
										echo "
										</select>
									</td>
									<td class=\"mytd\" width=\"100\" align=\"center\"> <input type=\"text\" class=\"mytextbox2\" name=\"commentCIR".$i."name\"  oninput=\"ajaxFunction();\"  id=\"commentCIR".$i."name\" value=\"$Comments\">
									</td>";
									echo "
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
											<td class=\"myth\" width=\"100\">Modification</td>
											<td class=\"myth\" width=\"100\">Group</td>
											<td class=\"myth\" width=\"100\">Component</td>
											<td class=\"myth\" width=\"100\">Standard Number</td>
											<td class=\"myth\" width=\"100\">Exposure Factor</td>
											<td class=\"myth\" width=\"100\">Condition State</td>
											<td class=\"myth\" width=\"100\">Description of Defect</td>
											<td class=\"myth\" width=\"100\">Monitor</td>
											<td class=\"myth\" width=\"100\">Level 3 Inspection Required</td>
											<td class=\"myth\" width=\"100\">Other</td>
											</tr>";
							echo "</br>";
						for($i=1; $i <= 20; $i++)
						{
							$query_cea		= "select * from bms_inspection3defcomdatas where bms_inspection3headerdatas_Inspection3HeaderDataID =".$Inspection3HeaderDataID." AND ival =".$i;		
							$result_cea		= mysql_query($query_cea) or die (mysql_error());
							while($row_cea	= mysql_fetch_array($result_cea))
							{
								$Modificationd 					= $row_cea['Modification'];
								$Inspection3StcompMatrixdID_GR	= $row_cea['bms_inspection3stcompmatrix_Inspection3StcompMatrixGroupID'];
								$Inspection3StcompMatrixdVal_GR = $row_cea['Inspection3StcompMatrixGroupVal'];
								$Inspection3StcompMatrixdID_CM	= $row_cea['bms_inspection3stcompmatrix_Inspection3StcompMatrixID_CM'];
								$Inspection3StcompMatrixdVal_CM = $row_cea['Inspection3StcompMatrixVal_CM'];
								$Inspection3StcompScheduledID	= $row_cea['bms_inspection3stcompschedule_Inspection3StcompScheduleID'];
								$ExporsureClassd  				= $row_cea['ExporsureClass'];
								$ConditionStated				= $row_cea['ConditionState'];
								$Monitord  						= $row_cea['Monitor'];
								$Level3Inspectiond				= $row_cea['Level3Inspection'];
								$Otherd				  			= $row_cea['Other'];
								$Commentsd						= $row_cea['Comments'];
							};
							
							echo "	
									<tr>
										<td class=\"mytd\" align=\"center\">
											<select name=\"modfiDCR".$i."\" class=\"myselect00\">";
											if($Modificationd == "o")
											{
											echo "	
													<option value=\"-\">---</option>
													<option value=\"o\">O</option>
													<option value=\"m1\">M1</option>
													<option value=\"m2\">M2</option>
													<option value=\"m3\">M3</option>
													";
											}
											else if($Modificationd == "m1")
											{
											echo "	
													<option value=\"-\">---</option>
													<option value=\"m1\">M1</option>
													<option value=\"o\">O</option>
													<option value=\"m2\">M2</option>
													<option value=\"m3\">M3</option>
													";
											}
											else if($Modificationd == "m2")
											{
											echo "	
													<option value=\"-\">---</option>
													<option value=\"m2\">M2</option>
													<option value=\"o\">O</option>
													<option value=\"m1\">M1</option>
													<option value=\"m3\">M3</option>
													";
											}
											else
											{
											echo "	
													<option value=\"-\">---</option>
													<option value=\"m3\">M3</option>
													<option value=\"o\">O</option>
													<option value=\"m1\">M1</option>
													<option value=\"m2\">M2</option>
													";
											}
											echo "	
											</select>
										</td>
									<td class=\"mytd\" align=\"center\">";
											$query_cea		= "select Inspection3StcompMatrixGroupID, StcompMatrixGroupCode from bms_inspection3stcompmatrixgroup order by Inspection3StcompMatrixGroupID";	
											$result_cea		= mysql_query($query_cea) or die (mysql_error());
											echo "<table class=\"bodytext\"><tr><td>";
											echo "<select name=\"groupDCR".$i."\" id=\"groupDCR".$i."\" class=\"myselect00\">";
												while($row_cea	= mysql_fetch_array($result_cea)){
													$temp++;
													$Inspection3StcompMatrixID  = $row_cea['Inspection3StcompMatrixGroupID'];
													$StcompMatrixCode  			= $row_cea['StcompMatrixGroupCode'];
													echo "<option value = ".$Inspection3StcompMatrixID." ";
													if($Inspection3StcompMatrixID == $Inspection3StcompMatrixdID_GR)
													{
														echo " selected ";
													}
													echo " >".$StcompMatrixCode."</option>";
												};
											echo "
										</select>
										</td><td>
										<select name= \"groupNoDCR".$i."\" id=\"groupNoDCR".$i."\" class=\"myselect00\">";
										$x = 1;
										while($x < 10){
											echo "<option value = ".$x." ";
											if($x == $Inspection3StcompMatrixdVal_GR)
											{
												echo " selected ";
											}
											echo " >".$x."</option>";
											$x++;
										}
										echo "</select>";
										echo "
										</td></tr></table>
									</td>
									<td class=\"mytd\" align=\"center\">";
											$query_cea		= "select Inspection3StcompMatrixID, StcompMatrixCode from bms_inspection3stcompmatrix order by Inspection3StcompMatrixID";		
											$result_cea		= mysql_query($query_cea) or die (mysql_error());
											echo "<table class=\"bodytext\"><tr><td>";
											echo "<select name=\"componentDCR".$i."\" id=\"componentDCR".$i."\" class=\"myselect00\">";
												while($row_cea	= mysql_fetch_array($result_cea)){
													$temp++;
													$Inspection3StcompMatrixID  = $row_cea['Inspection3StcompMatrixID'];
													$StcompMatrixCode			= $row_cea['StcompMatrixCode'];
													echo "<option value = ".$Inspection3StcompMatrixID." ";
													if($Inspection3StcompMatrixID == $Inspection3StcompMatrixdID_CM)
													{
														echo " selected ";
													}
													echo " >".$StcompMatrixCode."</option>";
												};
											echo "
										</select>
										</td><td>
										<select name= \"componentNoDCR".$i."\" id=\"componentNoDCR".$i."\" class=\"myselect00\">";
										$x = 1;
										while($x < 10){
											echo "<option value = ".$x." ";
												if($x == $Inspection3StcompMatrixdVal_CM)
												{
													echo " selected ";
												}
												echo " >".$x."</option>";
											$x++;
										}
										echo "</select>";
										echo "
										</td></tr></table>
									</td>
									<td class=\"mytd\" align=\"center\">";
											$query_cea		= "select Inspection3StcompScheduleID, Inspection3StcompScheduleNo from bms_inspection3stcompschedule order by Inspection3StcompScheduleID";		
											$result_cea		= mysql_query($query_cea) or die (mysql_error());
										
											echo "<select name=\"standardNoDCR".$i."\" id=\"standardNoDCR".$i."\" class=\"myselect00\">";
												while($row_cea	= mysql_fetch_array($result_cea)){
													$temp++;
													$Inspection3StcompScheduleID  = $row_cea['Inspection3StcompScheduleID'];
													$Inspection3StcompScheduleNo  = $row_cea['Inspection3StcompScheduleNo'];
													echo "<option value = ".$Inspection3StcompScheduleID." ";
													if($Inspection3StcompScheduleID == $Inspection3StcompScheduledID)
													{
														echo " selected ";
													}
													echo " >".$Inspection3StcompScheduleNo."</option>";
												};
											echo "
										</select>
									</td>	
									<td class=\"mytd\" align=\"center\">";
									echo "
										<select name= \"expoClassDCR".$i."\" id=\"expoClassDCR".$i."\" class=\"myselect00\">";
										$x = 1;
										while($x < 5){
												echo "<option value = ".$x." ";
												if($x == $ExporsureClassd)
												{
													echo " selected ";
												}
												echo " >".$x."</option>";
											$x++;
										}
										echo "</select>";
										echo "
									</td>
									<td class=\"mytd\" align=\"center\">";
									echo "
										<select name= \"conStateDCR".$i."\" id=\"conStateDCR".$i."\" class=\"myselect00\">";
										$x = 1;
										while($x < 5){
												echo "<option value = ".$x." ";
												if($x == $ConditionStated)
												{
													echo " selected ";
												}
												echo " >".$x."</option>";
											$x++;
										}
										echo "</select>";
										echo "
									</td>
									<td class=\"mytd\" width=\"100\" align=\"center\"> <input type=\"text\" class=\"mytextbox2\" name=\"descripDCR".$i."name\" value=\"$Commentsd\" oninput=\"ajaxFunction();\"  id=\"descripCIR".$i."name\" >
									</td>									
									<td class=\"mytd\" align=\"center\">
										<select name=\"monitorDCR".$i."\">";
											if($Monitord == 'y')
											{
											echo "
													<option value=\"-\">---</option>
													<option value=\"y\">Yes</option>
													<option value=\"n\">No</option>";
											}
											else
											{
											echo "
													<option value=\"-\">---</option>
													<option value=\"n\">No</option>
													<option value=\"y\">Yes</option>";								
											}
											echo "
										</select>
									</td>
									<td class=\"mytd\" align=\"center\">
										<select name=\"level3DCR".$i."\">";
											if($Level3Inspectiond == 'y')
											{
											echo "
													<option value=\"-\">---</option>
													<option value=\"y\">Yes</option>
													<option value=\"n\">No</option>";
											}
											else
											{
											echo "
													<option value=\"-\">---</option>
													<option value=\"n\">No</option>
													<option value=\"y\">Yes</option>";								
											}
											echo "
										</select>
									</td>
									<td class=\"mytd\" align=\"center\">
										<select name=\"otherDCR".$i."\">";
											if($Otherd == 'y')
											{
											echo "
													<option value=\"-\">---</option>
													<option value=\"y\">Yes</option>
													<option value=\"n\">No</option>";
											}
											else
											{
											echo "
													<option value=\"-\">---</option>
													<option value=\"n\">No</option>
													<option value=\"y\">Yes</option>";								
											}
											echo "
										</select>
									</td>";
									echo "
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
											<td class=\"myth\" width=\"100\">Modification</td>
											<td class=\"myth\" width=\"100\">Group</td>
											<td class=\"myth\" width=\"100\">Component</td>
											<td class=\"myth\" width=\"100\">Description</td>
											<td class=\"myth\" width=\"100\">Sketch Number</td>
											<td class=\"myth\" width=\"100\">Sketch Upload - 1</td>
											<td class=\"myth\" width=\"100\">Sketch Upload - 2</td>
											<td class=\"myth\" width=\"100\">Sketch Upload - 3</td>
											<td class=\"myth\" width=\"100\">Sketch Upload - 4</td>
											<td class=\"myth\" width=\"100\">Sketch Upload - 5</td>
											</tr>";
							echo "</br>";
							
						
						
						$_SESSION['filepathx'] = array();
						$_SESSION['fileidx'] = array();				
						$myfilepathi = 0;
						
						
						
						for($i=1; $i <= 20; $i++)
						{
						
							$query_cea		= "select * from bms_inspection3photosketchdatas where bms_inspection3headerdatas_Inspection3HeaderDataID =".$Inspection3HeaderDataID." AND ival =".$i;		
							$result_cea		= mysql_query($query_cea) or die (mysql_error());
							while($row_cea	= mysql_fetch_array($result_cea))
							{
								$Modificationsk  					= $row_cea['Modification'];
								$Inspection3StcompMatrixskID_GR		= $row_cea['bms_inspection3stcompmatrix_Inspection3StcompMatrixGroupID'];
								$Inspection3StcompMatrixskVal_GR    = $row_cea['Inspection3StcompMatrixGroupVal'];
								$Inspection3StcompMatrixskID_CM	    = $row_cea['bms_inspection3stcompmatrix_Inspection3StcompMatrixID_CM'];
								$Inspection3StcompMatrixskVal_CM    = $row_cea['Inspection3StcompMatrixVal_CM'];
								$Descriptionsk					    = $row_cea['Description'];
								$SketchNosk		  				    = $row_cea['SketchNo'];
								$lcase_ext1						= $row_cea['Filext1'];
								$lcase_ext2						= $row_cea['Filext2'];
								$lcase_ext3						= $row_cea['Filext3'];
								$lcase_ext4						= $row_cea['Filext4'];
								$lcase_ext5						= $row_cea['Filext5'];
							};
							
							echo "	
									<tr>
									<td class=\"mytd\" align=\"center\">
										<select name=\"modfisketch".$i."\" class=\"myselect00\">";
											if($Modificationsk == "o")
											{
											echo "	
													<option value=\"-\">---</option>
													<option value=\"o\">O</option>
													<option value=\"m1\">M1</option>
													<option value=\"m2\">M2</option>
													<option value=\"m3\">M3</option>
													";
											}
											else if($Modificationsk == "m1")
											{
											echo "	
													<option value=\"-\">---</option>
													<option value=\"m1\">M1</option>
													<option value=\"o\">O</option>
													<option value=\"m2\">M2</option>
													<option value=\"m3\">M3</option>
													";
											}
											else if($Modificationsk == "m2")
											{
											echo "	
													<option value=\"-\">---</option>
													<option value=\"m2\">M2</option>
													<option value=\"o\">O</option>
													<option value=\"m1\">M1</option>
													<option value=\"m3\">M3</option>
													";
											}
											else
											{
											echo "	
													<option value=\"-\">---</option>
													<option value=\"m3\">M3</option>
													<option value=\"o\">O</option>
													<option value=\"m1\">M1</option>
													<option value=\"m2\">M2</option>
													";
											}
											echo "	
											</select>
									</td>
									<td class=\"mytd\" align=\"center\">";
											$query_cea		= "select Inspection3StcompMatrixGroupID, StcompMatrixGroupCode from bms_inspection3stcompmatrixgroup order by Inspection3StcompMatrixGroupID";		
											$result_cea		= mysql_query($query_cea) or die (mysql_error());
											echo "<table class=\"bodytext\"><tr><td>";
											echo "<select name=\"groupsketch".$i."\" id=\"groupsketch".$i."\" class=\"myselect00\">";
												while($row_cea	= mysql_fetch_array($result_cea)){
													$temp++;
													$Inspection3StcompMatrixID  = $row_cea['Inspection3StcompMatrixGroupID'];
													$StcompMatrixCode			= $row_cea['StcompMatrixGroupCode'];
													echo "<option value = ".$Inspection3StcompMatrixID." ";
													if($Inspection3StcompMatrixID == $Inspection3StcompMatrixskID_GR)
													{
														echo " selected ";
													}
													echo " >".$StcompMatrixCode."</option>";
												};
											echo "
										</select>
										</td><td>
										<select name= \"groupNosketch".$i."\" id=\"groupNosketch".$i."\" class=\"myselect00\">";
										$x = 1;
										while($x < 10){
												echo "<option value = ".$x." ";
												if($x == $Inspection3StcompMatrixskVal_GR)
												{
													echo " selected ";
												}
												echo " >".$x."</option>";
											$x++;
										}
										echo "</select>";
										echo "
										</td></tr></table>
									</td>
									<td class=\"mytd\" align=\"center\">";
											$query_cea		= "select Inspection3StcompMatrixID, StcompMatrixCode from bms_inspection3stcompmatrix order by Inspection3StcompMatrixID";		
											$result_cea		= mysql_query($query_cea) or die (mysql_error());
											echo "<table class=\"bodytext\"><tr><td>";
											echo "<select name=\"componsketch".$i."\" id=\"componsketch".$i."\" class=\"myselect00\">";
												while($row_cea	= mysql_fetch_array($result_cea)){
													$temp++;
													$Inspection3StcompMatrixID  = $row_cea['Inspection3StcompMatrixID'];
													$StcompMatrixCode			= $row_cea['StcompMatrixCode'];
													echo "<option value = ".$Inspection3StcompMatrixID." ";
													if($Inspection3StcompMatrixID == $Inspection3StcompMatrixskID_CM)
													{
														echo " selected ";
													}
													echo " >".$StcompMatrixCode."</option>";
												};
											echo "
										</select>
										</td><td>
										<select name= \"componNosketch".$i."\" id=\"componNosketch".$i."\" class=\"myselect00\">";
										$x = 1;
										while($x < 10){
												echo "<option value = ".$x." ";
												if($x == $Inspection3StcompMatrixskVal_CM)
												{
													echo " selected ";
												}
												echo " >".$x."</option>";
											$x++;
										}
										echo "</select>
										</td></tr></table>
									</td>	
									<td class=\"mytd\" width=\"100\" align=\"center\"> <input type=\"text\" class=\"mytextbox1\" name=\"dessketch".$i."name\"  value=\"$Descriptionsk\" oninput=\"ajaxFunction();\"  id=\"dessketch".$i."name\" >
									</td>									
									<td class=\"mytd\" width=\"100\" align=\"center\"> <input type=\"text\" class=\"mytextbox1\" name=\"sketchno".$i."name\" value=\"$SketchNosk\" oninput=\"ajaxFunction();\"  id=\"sketchno".$i."name\" >";
									////////////////////////////////////////////////////////////////////////////
									////////////////////// File Upload /////////////////////////////////////////
									////////////////////////////////////////////////////////////////////////////
									echo "
									
									
									<td  class=\"mytd\" align=\"center\">";
										echo "<table><tr><td class=\"mytd0\" width=\"100\" >";										
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
												
										echo "</td><td class=\"mytd0\" >";										
											echo "<input type=\"file\" class=\"mytextbox1\" name=\"sketch".$i."name1\" id=\"sketch".$i."name1\" >";
										echo "</td></tr></table>
									</td>
									
									
									<td  class=\"mytd\" align=\"center\">";
										echo "<table><tr><td class=\"mytd0\"  width=\"100\" >";										
												$x2	= '';
												
												$myfilepathi++;
														
												$x2	= "Sketch".$i." - 2";
												$filepath1	= '';
												if($lcase_ext2	!= ""){
													
													$_SESSION['filepathx'][$myfilepathi]	= $datadir3;
													$_SESSION['fileidx'][$myfilepathi]		= $Inspection3HeaderDataID."-".$i."-2.".$lcase_ext2;
													echo "<a href=\"../download.php?id=".$myfilepathi."\" target=\"_blank\">".$x2."</a>";
										
												}else{
													echo "--";
												}
												
										echo "</td><td class=\"mytd0\" >";										
											echo "<input type=\"file\" class=\"mytextbox1\" name=\"sketch".$i."name2\" id=\"sketch".$i."name2\" >";
										echo "</td></tr></table>
									</td>
									
									
									
									
									<td  class=\"mytd\" align=\"center\">";
										echo "<table><tr><td class=\"mytd0\"  width=\"100\" >";										
												$x3	= '';
													
												$myfilepathi++;
														
												$x3	= "Sketch".$i." - 3";
												$filepath1	= '';
												if($lcase_ext3	!= ""){
													
													$_SESSION['filepathx'][$myfilepathi]	= $datadir3;
													$_SESSION['fileidx'][$myfilepathi]		= $Inspection3HeaderDataID."-".$i."-3.".$lcase_ext3;
													echo "<a href=\"../download.php?id=".$myfilepathi."\" target=\"_blank\">".$x3."</a>";
												
												}else{
													echo "--";
												}
												
										echo "</td><td class=\"mytd0\" >";										
											echo "<input type=\"file\" class=\"mytextbox1\" name=\"sketch".$i."name3\" id=\"sketch".$i."name3\" >";
										echo "</td></tr></table>
									</td>
									
									
									
									<td  class=\"mytd\" align=\"center\">";
										echo "<table><tr><td class=\"mytd0\"  width=\"100\" >";										
												$x4	= '';
												
												$myfilepathi++;
														
												$x4	= "Sketch".$i." - 4";
												$filepath1	= '';
												if($lcase_ext4	!= ""){
													
													$_SESSION['filepathx'][$myfilepathi]	= $datadir3;
													$_SESSION['fileidx'][$myfilepathi]		= $Inspection3HeaderDataID."-".$i."-4.".$lcase_ext4;
													echo "<a href=\"../download.php?id=".$myfilepathi."\" target=\"_blank\">".$x4."</a>";
													
												}else{
													echo "--";
												}
												
										echo "</td><td class=\"mytd0\" >";										
											echo "<input type=\"file\" class=\"mytextbox1\" name=\"sketch".$i."name4\" id=\"sketch".$i."name4\" >";
										echo "</td></tr></table>
									</td>
									
									
									<td  class=\"mytd\" align=\"center\">";
										echo "<table><tr><td class=\"mytd0\"  width=\"100\" >";										
												$x5	= '';
													
												$myfilepathi++;
														
												$x5	= "Sketch".$i." - 5";
												$filepath1	= '';
												if($lcase_ext5	!= ""){
													
													$_SESSION['filepathx'][$myfilepathi]	= $datadir3;
													$_SESSION['fileidx'][$myfilepathi]		= $Inspection3HeaderDataID."-".$i."-5.".$lcase_ext5;
													echo "<a href=\"../download.php?id=".$myfilepathi."\" target=\"_blank\">".$x5."</a>";
										
												}else{
													echo "--";
												}
												
										echo "</td><td class=\"mytd0\" >";										
											echo "<input type=\"file\" class=\"mytextbox1\" name=\"sketch".$i."name5\" id=\"sketch".$i."name5\" >";
										echo "</td></tr></table>
									</td>";
									
									//////////////////////////////////////////////////////////////////////////////////
									
									echo "
									<span name=\"des\" id=\"des\"></span></td>
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
								echo "<td class=\"altmytd\" >";
											echo "<textarea name=\"comment\" cols=\"140\" rows=\"12\">$GeneralComment</textarea>";
											
										echo "</td>";
								echo "</tr>";
								
				echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
				echo "<input type=\"hidden\" name=\"BridgeProfileID\" value=\"$BridgeProfileID\">";
				echo "<input type=\"hidden\" name=\"Inspection3HeaderDataID\" value=\"$Inspection3HeaderDataID\">";					
			
				echo "<tr id=\"mysubtr\"  name=\"mysubtr\"><td colspan=\"3\" align=\"center\">";
					echo "<input type=\"button\" name=\"go\" class=\"Submit_Button_Long_Long\" value=\"Edit Report\" onclick=\"checkOnSubmit()\">";
				echo "</td></tr>";
				
				
				echo "<tr id=\"mysublasttr\"  name=\"mysublasttr\"><td colspan=\"3\" align=\"left\">";
					echo "<font class\"bodytextred\" color=\"red\"><b>Are you sure you want edit the inspection report ?</b></font>";
					echo "&nbsp;&nbsp;&nbsp;";
					echo "<input type=\"submit\" name=\"yes_submit\" class=\"Submit_Button\" value=\"Yes\" />";
					echo "&nbsp;&nbsp;&nbsp;";
					echo "<input type=\"button\" name=\"no_submit\" class=\"Submit_Button\" value=\"No\"  onclick=\"checkOnSubmitNo()\" />";
				echo "</td></tr>";
						echo "</table>";	
				?>
				</div>
				
			</div>

		</form>
<?php
	}
}
	echo "</body>";
	include '../bottom.php';

?>