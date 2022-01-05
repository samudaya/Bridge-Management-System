<?php
        @session_start();
		$UserName       = $_GET['username'];

        $logged_user_ID = $_SESSION['log_UserID'];
        require_once '../global.php';
        $mis_user       = 0;
        $query_item = "select UserID from bms_users where Username=\"".$UserName."\"";
        $result_item = mysql_query($query_item) or die (mysql_error());
        while($row_item = mysql_fetch_array($result_item))
        {
                $mis_user               = 1;
        }
   
        if($mis_user == 0)
        {
                echo "<font color=\"#4CC417\">Available</font>";
        }
        else
        {
                echo "<font color=\"#FF0000\">Not available</font>";
        }
?>