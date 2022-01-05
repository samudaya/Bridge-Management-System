<?php
@session_start();
include("global.php");
if(isset($_SESSION['log_UserID']))
{
	require_once 'global.php';
	$newpage3 = $pathprefix . "welcome.php";
	header("Location: $newpage3");
	exit();
}
else
{
	if($_SERVER["HTTPS"] != "on") 
	{
		$newpage = "https://". $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
		header("Location: $newpage");
		exit();
	}
	@session_start();
	if($_SESSION['log_user_ip_set'] != 1)
	{
		require_once 'global.php';
		$newpage3 = $pathprefix . "index.php";
		header("Location: $newpage3");
		exit();
	}
	else
	{
	?>
	<html>
	<head>
	<title>...:: BMS 1.0 ::...</title>
	<style type="text/css">
	<!--
	.style1 {
		font-size: 24px;
		font-weight: bold;
	}
	.style5 {font-size: 14px; font-weight: bold; }
	.style7 {font-size: 11px}
	.style8 {font-size: 36px}
	.style9 {font-size: 12px}
	.style10 {font-size: 10px}
	-->
	</style>

	<link href="common/common.css" rel="stylesheet" type="text/css">

	<script type="text/javascript">
	function setFocus()
	{
		document.theForm.BIMSUsername.focus();
	}
	</script>

	</head>

	<body onload="setFocus()" >
	<div id="Layer2" style="position:absolute; width:800px; height:487px; z-index:9; left: 98px; top: 5px;" align="center">

	<table  width="100%"  border="0" align="left">
	  <tr>
		  <td width="800"  ><img src="images/topbanner.jpg"  width="800" align="left"></td>
	  </tr>

	  
	  <tr>
		  <td height="180"> 
			<table width="100%" border="0">
				<tr align="left" valign="middle"> 
				<td colspan="3">
				</td>
				</tr>

			  </table>
		</td>
	  </tr>
		<tr>  
			<form action="login.php" method="post" name="theForm" id="theForm">
				<td>
					<div id="Layer6" style="position:absolute; width:804px; height:25px; z-index:5; left: 2px; top: 540px;">
					 <table  border="0" align="center">
						<tr class="bill-heading">
							<td colspan="7" width="800"><hr /></td>
						<tr/>
						
					  </table>
					</div>
			
			
			
			
					
					<div id="Layer2" style="position:absolute; width:563px; height:103px; z-index:2; left: 250px; top: 250px;" >
						<table  bordercolor="#FFFFFF" bgcolor="#3E82E0" class="bodytext">
							<tr>
								<td width="109" bordercolor="#3332CB" class="style5"><span class="style9"><font color="#FFFFFF">Username</font></span></td>
								<td width="122"><input  type="text" name="BIMSUsername" class="inputText" size="28" /></td>
							</tr>
							<tr>
								<td class="style5"><span class="style9"><font color="#FFFFFF">Password</font></span> </td>
								<td><input  type="password" name="BIMSPassword" class="inputText" size="28" /></td>
							</tr>
							<tr>
								<td></td>
								<td height="2"></td>
							</tr>
							<tr>
								<td colspan="2" align="right" >             
								<input  type="submit" name="BIMSLogin" value="Login" tabindex="1" />
								</td>
							</tr>
						</table>
						<table>
						<tr>
								<td colspan="2" class="bodytextred"><font size="2"><?php if(isset($BIMSLoginError)){ echo "$BIMSLoginError"; } ?></font></td>
							</tr>
						</table>
					</div>	
						
					
					
		
					<div id="Layer7" style="position:absolute; width:800px; height:12px; z-index:6; left: 0px; top: 555px;">
					<DIV class="bodytextbold" align="right">
					<EM><?php echo date('Y'); ?> Bridge Management System</EM>
					</DIV>
					</div>
					
					
					
				</td>
			</form>
		</tr>
	</table>
	</div>

	<div id="Layer9" style="position:absolute; width:640px; height:91px; z-index:8; left: 103px; top: 515px;">
		<div align="justify"> 
			<table width="800" class="bodytext" cellpadding="0" cellspacing="0">
				<tr> 
					<td align="center" class="errortext">
						<font size="2">
							Welcome to the Bridge Management System ...<br /><br />							
						</font>
					</td>
				</tr>
			</table>
		</div>
	</div>

		
		
	</body>
	</html>
	<?php
	}
}
?>
