<?php
	@session_start();
	include("../sys_setting/statics_ua.php");
	
	if($_SESSION['log_ok'] != 1)
	{
		
		include("../sys_setting/statics_ua.php");
		header('Location: ../index.php');
	}
	else
	{
	?>
		<html>
			<head>
				<style type="text/css">
					<!--
					.style1 {
						color: #FF0000;
						font-weight: bold;
					}
					-->
				</style>	
			</head>
			
			<body>
			<span class="style1">Access denied</span>
			</body>
		</html>
	<?php
	}
	?>


