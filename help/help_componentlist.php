<?php
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

	<script>
		
		$(document).ready(function() {
			$("#tabs").tabs();	

			$("#operationstdate").datepicker({
                altField: '#realdate', 
                dateFormat:'yy-mm-dd'
			});   
			
			$("#HighestFloodLevelDate").datepicker({
                altField: '#realdate', 
                dateFormat:'yy-mm-dd'
			});

			
			$('#div_nriver').show();	
			$('#div_nuproad').hide();
			$('#div_noproad').hide();
			$('#div_norail').hide();
			
						
			
			$('#clearance_wt_pwc').show();
			$('#clearance_wt_twc').show();
			$('#clearance_wt_ph').show();
			$('#clearance_wt_pss').show();				
			
			$('#clearance_nonwt_p').hide();
			$('#clearance_nonwt_tb').hide();
			
			
			for(var i=1; i<=15; i++)
			{
				$('#spgroup'+i).hide();	
				$('#deck'+i).hide();	
				$('#sub_pier_'+i).hide();	
				$('#foun_pier_'+i).hide();
			}			
			
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
	
	echo "
	<p class=\"hx1\">Help - Component List</p>";
	
	$query_compList = "select * from bms_inspection3stcompmatrix";
	$result_compList = mysql_query($query_compList) or die(mysql_error());
	$count = 1; 
	echo"
		<table>
			<tr>
				<td class=\"myth\" width=\"50\">
					&nbsp
				</td>
				<td class=\"myth\"width=\"150\">
					Matrix Code
				</td>
				<td class=\"myth\" width=\"350\">
					Description
				</td>
			</tr>
	";
	while($row_compList = mysql_fetch_array($result_compList)){
		if($count%2 == 1){
			$class = "mytd";
		}else{
			$class = "altmytd";
		}
		$matrixCode = $row_compList['StcompMatrixCode'];
		$matrixDesc = $row_compList['StcompMatrixDesc'];
		if($row_compList['Inspection3StcompMatrixID'] == 0){
			continue;
		}
		echo "
			<tr>
				<td class=\"".$class."\" align=\"center\">";
					if($count < 10){
						echo "0".$count;
					}else{
						echo $count;
					}
					echo "
				</td>
				<td class=\"".$class."\">
					".$matrixCode." 
				</td>
				<td class=\"".$class."\">
					".$matrixDesc."
				</td>
			</tr>
		";
		$count++;
	}
	echo "</table>";
	
	
	
	
	echo "</body>";
	include '../bottom.php';

?>