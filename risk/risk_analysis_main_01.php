<html>
<head>
<title>BMS</title>
 <?
	@session_start();
	include ("../global.php");
	$BridgeProfileID = $_SESSION['BridgeProfileID'];
 ?>
</head>
<frameset rows="15,*" frameborder=0 border="0">
<frame SRC="print_01.php" name="FrameA"  MARGINWIDTH="0" MARGINHEIGHT="0" BORDER=0 SCROLLING=no>
<frame SRC="risk_analysis_sub_01.php" name="FrameB"  MARGINWIDTH="0" MARGINHEIGHT="0" BORDER=0 >

<noframes>
<body>
</body>
</noframes>
</frameset>
</html>