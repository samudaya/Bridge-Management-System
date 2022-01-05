<?php
        @session_start();
		$birdeid       = $_GET['birdeid'];
        $logged_user_ID = $_SESSION['log_UserID'];
        require_once '../global.php';
        $mis_bridge       = 0;
        $query_item = "select * from bms_bridgeprofiles where StructureID=\"".$birdeid."\"";
        $result_item = mysql_query($query_item) or die (mysql_error());
        while($row_item = mysql_fetch_array($result_item))
        {
                $mis_bridge               = 1;
        }
   
        if($mis_bridge == 0)
        {
                echo "<font color=\"#4CC417\">Available</font>";
        }
        else
        {
                echo "<font color=\"#FF0000\">Not available</font>";
        }
?>