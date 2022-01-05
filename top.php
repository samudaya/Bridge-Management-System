<?php
	@session_start();
	
	include 'global.php';
	if(!isset($_SESSION['log_UserID']))
	{		
		header("Location: $pathprefix");
		exit();
	}
	
	$FullURL 	= "https://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	$page_path 	= str_replace($pathprefix, '', $FullURL);
	$page_path 	= explode(".php", $page_path);
	$page_path 	= $page_path[0];
	$page_path 	= $page_path.".php";
	
	
	////////////////////////////////////////////////
	////////////////////////////////////////////////
	////////////////////////////////////////////////
	//Admin Users
	$access_allowed	= 0;
	$my_date		= date("Y-m-d");
	$query_ut 		= "select * from bms_users_usertypes where users_UserID=".$_SESSION['log_UserID'];
	$result_ut 		= mysql_query($query_ut);
	while($row_ut 	= mysql_fetch_array($result_ut))
	{

		$UserTypeID		= $row_ut['usertypes_UserTypeID'];		
		$query_pr 		= "select * from bms_privileges where ActionMapping=\"".$page_path."\"";
		$result_pr 		= mysql_query($query_pr);
		while($row_pr 	= mysql_fetch_array($result_pr))
		{
			$PrivilegeID		= $row_pr['PrivilegeID'];
			
			$query_ut_p 	= "select privileges_PrivilegeID from bms_usertypes_privileges where usertypes_UserTypeID=".$UserTypeID." and privileges_PrivilegeID=".$PrivilegeID;
			$result_ut_p 	= mysql_query($query_ut_p);
			if(mysql_num_rows($result_ut_p) > 0)
			{	
				$access_allowed	= 1;
			}
		}
	}
	
	
	
	

	if(($page_path =="index.php") or ($page_path =="login.php") or ($page_path =="login_index.php") or ($page_path =="welcome.php") or ($page_path =="edit.php") or ($page_path =="my_cpass.php") or ($page_path ==''))
	{
	}
	else
	{
		if($access_allowed	== 0)
		{
			session_destroy(); 
			header("Location: $pathprefix?logout=yes");
			exit();
		}
	}
	$_SESSION['BIMSSesDate']	= date("Y-m-d H:i:s");
?>


<html>
	<head>
		<title>BMS 1.0</title>
		<link href="<?php echo $pathprefix; ?>common/common.css" rel="stylesheet" type="text/css">
	</head>

	<body marginheight="0" marginwidth="0" topmargin="0" leftmargin="0">
		
			<div id="Layer6" style="position:absolute; width:1024px; height:12px; z-index:6; left: 0px; top: 81px;">
				<DIV class="bodytextbold" align="right">
					<?php echo "<strong>Welcome : ".$_SESSION['logined_UserName']."</strong> &nbsp;&nbsp;
								<a href=\"".$pathprefix."index.php?logout=yes\" >Logout</a>&nbsp;&nbsp;";
					?>
				</DIV>
			</div>
					
			
			
			<div  id="Layer7" style="position:absolute; width:1024; height:100; z-index:-1; left: 0px; top: 0px;">
				<img src="<?php echo $pathprefix; ?>images/top2.jpg" height="100" width="1024" />
			</div>
			
			
			<?php
			echo "<br />";
			echo "<br />";
			echo "<br />";
			echo "<br />";
			echo "<br />";
			echo "<br />";
			
			echo "<table  border=\"0\" width=\"100%\" >"; 
			echo "<tr>"; 
					echo "<td valign=\"top\">"; 
					
						echo "<table border=\"0\"  width=\"100%\" >"; 
							echo "<tr valign=\"top\">"; 
								echo "<td width=\"2\" valign=\"top\" >";								
								////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
								/////////////////////////////////////		Left menu area	  //////////////////////////////////////////////////////
								////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
									echo "<table   align=\"left\" width=\"190\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"link-list\" >"; 

										
										echo "<tr>";											
											echo "<td width=\"190\" height=\"52\"><a href=\"".$pathprefix."edit.php\">";
												if($page_path == "edit.php")
												{
													echo "<img width=\"190\" src=\"".$pathprefix."images/ico/1.jpg\"  >";
												}
												else
												{
													echo "<img width=\"190\" src=\"".$pathprefix."images/ico/1a.jpg\"  >";
												}													
												echo "</a>";
											echo "</td>"; 
										echo "</tr>";
															
										
										
										echo "<tr>";											
											echo "<td width=\"190\" height=\"52\"><a href=\"".$pathprefix."my_cpass.php\">";
												if($page_path == "my_cpass.php")
												{
													echo "<img src=\"".$pathprefix."images/ico/2.jpg\"  width=\"190\"  >";
												}
												else
												{
													echo "<img src=\"".$pathprefix."images/ico/2a.jpg\"  width=\"190\"  >";
												}													
												echo "</a>";
											echo "</td>"; 
										echo "</tr>";
										
										
										
										
										$query_ut 		= "select * from bms_users_usertypes where users_UserID=".$_SESSION['log_UserID']." order by UserUserTypeID";
										$result_ut 		= mysql_query($query_ut);
										while($row_ut 	= mysql_fetch_array($result_ut))
										{
											$array_subid	= array();
											$my_val			= 0;
											$UserTypeID		= $row_ut['usertypes_UserTypeID'];
											$query_utd 		= "select UserType from bms_usertypes where UserTypeID=".$UserTypeID;
											$result_utd 	= mysql_query($query_utd);
											while($row_utd 	= mysql_fetch_array($result_utd))
											{
												$UserTypeDescrption	= $row_utd['UserType'];
											}

											echo "<tr>"; 
												echo "<td colspan=\"3\" height=\"25\">&nbsp;</td>"; 
											echo "</tr>";
									
											$query_pr 		= "select *  from bms_privileges, bms_usertypes_privileges where PrivilegeID=privileges_PrivilegeID	and usertypes_UserTypeID=".$UserTypeID;
											

											$result_pr 		= mysql_query($query_pr);
											while($row_pr 	= mysql_fetch_array($result_pr))
											{
												$PriviledgeID		= $row_pr['PrivilegeID'];
												$menusubcategoryID	= $row_pr['menusubcategory_menusubcategoryID'];
												$ActionMapping		= $row_pr['ActionMapping'];
												
												
												
												echo "<tr>";											
													echo "<td width=\"190\" height=\"52\"><a href=\"".$pathprefix.$ActionMapping."\">";
														if($page_path == $ActionMapping)
														{
															echo "<img src=\"".$pathprefix."images/ico/".$PriviledgeID.".jpg\"  width=\"190\"  >";
														}
														else
														{
															echo "<img src=\"".$pathprefix."images/ico/".$PriviledgeID."a.jpg\"  width=\"190\" >";
														}													
														echo "</a>";
													echo "</td>"; 
												echo "</tr>";													
												
											}
										}
										
										
										
									echo "</table>";
								echo "</td>"; 
								
								
								echo "<td width=\"5\" background=\"".$pathprefix."images/left_menu_dot_bg2.gif\" valign=\"top\"></td>"; 
								
								echo "<td width=\"15\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>"; 
								
								echo "<td valign=\"top\" height=\"450\">";
								////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
								/////////////////////////// This is main body area. Rest of the table stucture in bottom.php////////////////////////
								//////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>