<html>
<head>
<script>
function framePrint(whichFrame){
parent[whichFrame].focus();
parent[whichFrame].print();
}
</script>
<title></title>
<base target="_self">
</head>
<body link="#FF0000" vlink="#FF0000" alink="#FF0000">
<a href="javascript:framePrint('FrameB');"><font size="2" face="Verdana,Arial">PRINT</font></a>  
</body>

</html>