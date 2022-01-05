<?php
	include ("../global.php");
	include ("../top.php");

	echo "<head>";

	echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"../common/common.css\" />

	<link rel=\"stylesheet\" href=\"../lib/ajax/mSuggest.css\" type=\"text/css\" />
	<script src=\"../lib/ajax/mTools.js\"></script>
	<script src=\"../lib/ajax/mSuggest.js\"></script>	";
?>
	
<script language="javascript" type="text/javascript" >
<!-- hide
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

                xmlHttp.open("GET","user_add_check_user_name_availability_ajax.php?username="+document.myform.username.value,true);
                xmlHttp.send(null);
        }

	function checkOnSubmitSearch()
	{
		var searchflag=true;
		var SearchString1	= document.searchform.SearchString.value;
		if(SearchString1==''){
			al_SearchString1=document.getElementById("SearchString_id");
			al_SearchString1.innerHTML="Please enter username";
			searchflag=false;
		}
		if(searchflag==true)
		{
			searchform.submit();
		}
	
	}
	function chk_empty_search()
	{
		al_SearchString=document.getElementById("SearchString_id");
		al_SearchString.innerHTML="";
		
	}
	
	function checkOnSubmit()
	{
		var flag=true;
		
		var title1		= document.myform.title.value;
		var firstname1	= document.myform.first_name.value;
		var lastname1 	= document.myform.last_name.value;
		var initialsname1	= document.myform.initials_name.value;
		
		var telephone1	= document.myform.telephone.value;
		var tele1num	= IsNumeric(telephone1);
		function IsNumeric(sText){
			var ValidChars = "0123456789+()-.exEX ";
			var IsNumber=true;
			var Char;
			for (i = 0; i < sText.length && IsNumber == true; i++) 
			{ 
				Char = sText.charAt(i); 
				if (ValidChars.indexOf(Char) == -1) 
				{
				IsNumber = false;
				}
			}
				return IsNumber;
   
		}
				
		var email1	= document.myform.email.value;
		var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
		
		if(title1 == '')
		{
			al_title1=document.getElementById("title_id");
			al_title1.innerHTML="Please select title";
			flag=false;
		}
		

		if(firstname1 == '')
		{
			al_firstname1=document.getElementById("fname_id");
			al_firstname1.innerHTML="Please enter first name";
			flag=false;
		}
		if(lastname1 == '')
		{
			al_lastname1=document.getElementById("lname_id");
			al_lastname1.innerHTML="Please enter last name";
			flag=false;
		}
		if(initialsname1 == '')
		{
			al_initialsname1=document.getElementById("iname_id");
			al_initialsname1.innerHTML="Please enter name with initials";
			flag=false;
		}
		if(telephone1 == '')
		{
			al_telephone1=document.getElementById("tele_id");
			al_telephone1.innerHTML="Please enter phone number";
			flag=false;
		}
		else if(telephone1.length < 10 || telephone1.length > 25 ){
			al_telephone1_len=document.getElementById("tele_id");
			al_telephone1_len.innerHTML="Length should be 10 to 25. (Number Format:(+94) 000-000000)";
			document.myform.telephone.value="";
			flag=false;
		}else if(tele1num==false){
			al_telephone1_char=document.getElementById("tele_id");
			al_telephone1_char.innerHTML="This is not a telephone number. (Number Format:(+94) 000-000000)";
			document.myform.telephone.value="";
			flag=false;
		}
		if(email1 == '')
		{
			al_email1=document.getElementById("email_id");
			al_email1.innerHTML="Please enter an E-mail";
			flag=false;
		}else if(!emailPattern.test(email1)){
			al_email1_len=document.getElementById("email_id");
			al_email1_len.innerHTML="Not a valid e-mail address";
			document.myform.email.value="";
			flag=false;
		}
		
		if(flag==true)
		{
			myform.submit();
		}
	}	
		
	function chk_empty_value0()
	{
		al_title=document.getElementById("title_id");
		al_title.innerHTML="";
		
	}
	function chk_empty_value1()
	{
		al_uname=document.getElementById("uname_id");
		al_uname.innerHTML="";
		
	}

	
	function chk_empty_value3()
	{
		al_firstname=document.getElementById("fname_id");
		al_firstname.innerHTML="";
		
	}
	
	function chk_empty_value4()
	{
		al_lastname=document.getElementById("lname_id");
		al_lastname.innerHTML="";
		
	}
	function chk_empty_value5()
	{
		al_initialname=document.getElementById("iname_id");
		al_initialname.innerHTML="";
		
	}
	
	function chk_empty_value6()
	{
		al_tele=document.getElementById("tele_id");
		al_tele.innerHTML="";
		
	}
	
	function chk_empty_value7()
	{
		al_email=document.getElementById("email_id");
		al_email.innerHTML="";
		
	}	
-->		
</script>
<?php	
	echo "</head>";
	
	echo "<p class=\"hx1\">Edit Users</p>";
	

	if(isset($_POST['first_name'])){
		$userID				= $_POST['user_id'];
		$firstName 			= $_POST['first_name'];
		$lastName			= $_POST['last_name'];
		
		$telephone			= $_POST['telephone'];
		$email				= $_POST['email'];
		$status				= $_POST['status'];
		$Address			= $_POST['Address'];
			$Address = str_replace("'", "\\'", $Address);
			$Address = str_replace('"', '\\"', $Address);
		$title				= $_POST['title'];
		$sections_SectionID	= 1;		
		$modifiedBy			= $_SESSION['log_UserID'];
		$modifiedDate		= date("Y-m-d H:i:s");
		$nameWithInitials	= $_POST['initials_name'];
		
		$query_resource = "update bms_users set sections_SectionID = '".$sections_SectionID."', 
														NameWithInitials = '".$nameWithInitials."',
														FirstName = '".$firstName."', 
														LastName = '".$lastName."', 
														Title = '".$title."', 
														TeleNum = '".$telephone."', 
														eMail = '".$email."',
														Address = '".$Address."',
														Active = '".$status."',
														ModifiedBy = '".$modifiedBy."',
														ModifiedDate = '".$modifiedDate."'														
									where UserID = '".$userID."'";
								
		$result_resource = mysql_query($query_resource) or die (mysql_error());
		
		
		$users_UserID	= $_SESSION['log_UserID'];
		$TableName		= "bms_users";
		$SQLQuery		= "update bms_users set sections_SectionID = \'".$sections_SectionID."\', 
														NameWithInitials = \'".$nameWithInitials."\',
														FirstName = \'".$firstName."\', 
														LastName = \'".$lastName."\', 
														Title = \'".$title."\', 
														TeleNum = \'".$telephone."\', 
														eMail = \'".$email."\', 														
														Address = \'".$Address."\',
														Active = \'".$status."\',
														ModifiedBy = \'".$modifiedBy."\',
														ModifiedDate = \'".$modifiedDate."\' ";
		$Action			= "UPDATE";
		$query_log = "insert into bms_logs(users_UserID, TableName,	SQLQuery, 	Action) values ('".$users_UserID."','".$TableName."','". $SQLQuery."','". $Action."')";
		$result_log = mysql_query($query_log) or die (mysql_error());
		echo "<p class=\"bodytextsus\">succesfully updated.</p>";			
		
	}
	
	
	
	
	
	
	if(isset($_POST['rpw'])){
		$userID				= $_POST['user_id'];
		$modifiedBy			= $_SESSION['log_UserID'];
		$modifiedDate		= date("Y-m-d H:i:s");
		$Password			= md5('@bims');
		
		$query_resource = "update bms_users set Password = '".$Password."', ModifiedBy = '".$modifiedBy."', ModifiedDate = '".$modifiedDate."'														
									where UserID = '".$userID."'";
								
		$result_resource = mysql_query($query_resource) or die (mysql_error());
		
		
		$users_UserID	= $_SESSION['log_UserID'];
		$TableName		= "bms_users";
		$SQLQuery		= "update bms_users set Password = \'".$Password."\',
														ModifiedBy = \'".$modifiedBy."\',
														ModifiedDate = \'".$modifiedDate."\',
														where UserID = \'".$userID."\'";
		$Action			= "UPDATE";
		$query_log = "insert into bms_logs(users_UserID, TableName,	SQLQuery, 	Action) values ('".$users_UserID."','".$TableName."','". $SQLQuery."','". $Action."')";
		$result_log = mysql_query($query_log) or die (mysql_error());
		echo "<p class=\"bodytextsus\">succesfully updated.</p>";			
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

	if(!isset($_POST['formHidden'])){
	echo "<form name=\"searchform\" id=\"searchform\" action=\"#\" method=\"post\">";
				
		$bsr = array();
		$counterA=0;
		$query_bsr = "select * from bms_users";        
		$result_bsr = mysql_query($query_bsr) or die (mysql_error());
		while($row_user = mysql_fetch_array($result_bsr))
		{
			$bsr[$counterA++]    = $row_user['Username'];
		}
		
				
		
		
		$query_bsr = "select * from bms_users";        
		$result_bsr = mysql_query($query_bsr) or die (mysql_error());
		while($row_user = mysql_fetch_array($result_bsr))
		{
			$bsr[$counterA++]    = $row_user['FirstName']." (Username : ".$row_user['Username'].")";
		}
		
		
		$query_bsr = "select * from bms_users";        
		$result_bsr = mysql_query($query_bsr) or die (mysql_error());
		while($row_user = mysql_fetch_array($result_bsr))
		{
			$bsr[$counterA++]    = $row_user['LastName']." (Username : ".$row_user['Username'].")";
		}
		
		$query_bsr = "select * from bms_users";        
		$result_bsr = mysql_query($query_bsr) or die (mysql_error());
		while($row_user = mysql_fetch_array($result_bsr))
		{
			$bsr[$counterA++]    = $row_user['NameWithInitials']." (Username : ".$row_user['Username'].")";
		}
	echo "
		<table class=\"bodytext\">
		<tr>
			<td class=\"mytd\">
				Search Users
			</td>
			<td class=\"mytd\">
				<input type=\"text\"  name=\"SearchString\" size=\"40\" id=\"SearchString\" class=\"inputText\" rel=\"Suggest\" size=\"35\" autocomplete=\"off\" data=\""; for($i=0;$i<count($bsr);$i++){ echo $bsr[$i].",";} echo "\" onkeyup=\"chk_empty_search()\"/>
			</td>
			<td class=\"mytd\">
				<input name=\"go\"  type=\"button\"  class=\"Submit_Button_Long\" id=\"bms_Search\" value=\"Select\" onclick=\"checkOnSubmitSearch()\" />
			</td>
			<td><span id=\"SearchString_id\" class=\"bodytextred\"></span></td>	
		</tr>	
		</table>
		</form>";	
		
		if (isset($_POST['SearchString']) ){
	
	
		
		$elements               = array();
		$separator              = "(";
		$elements               = explode($separator, $_POST['SearchString']);

		if($elements['1'] == '' or !isset($elements['1']))
		{
			$searchUsername =  $elements['0'];		
		}
		else
		{
		
			$separator = "Username : ";			
			$elements       = explode($separator, $elements['1']);			
			$searchUsername =  $elements['1'];
			
			
			
			$separator = ")";			
			$elements       = explode($separator, $searchUsername);			
			$searchUsername =  $elements['0'];
			
		}

		$query_bsr_resource = "select * from bms_users where Username=\"".$searchUsername."\"";        
		$result_bsr_resource = mysql_query($query_bsr_resource) or die (mysql_error());
		$result_bsr_resource_rows = mysql_num_rows ( $result_bsr_resource );
		
			while($row_bsr = mysql_fetch_array($result_bsr_resource))
			{			
				$userID			= $row_bsr['UserID'];
				$firstName 		= $row_bsr['FirstName'];
				$lastName		= $row_bsr['LastName'];
				$userName		= $row_bsr['Username'];
				$Address		= $row_bsr['Address'];
				
				$telephone		= $row_bsr['TeleNum'];
				$email			= $row_bsr['eMail'];
				$status			= $row_bsr['Active'];
				$title			= $row_bsr['Title'];	
				$nameWithInitials	= $row_bsr['NameWithInitials'];						
			}	
	
	
			if ($result_bsr_resource_rows>0){
				echo "
					<form name=\"myform\" id=\"myform\" method=\"POST\" action=\"#\">
					  <table class=\"bodytext\">
					  
					  <tr>
							<td class=\"mytd\">Username</td>
							<td class=\"mytd\">".$userName."</td>
						</tr>
						
						<tr>
							<td class=\"mytd\">Title</td>
							<td class=\"mytd\">
								<select name=\"title\" class=\"myselect2\" id=\"title\" onChange=\"chk_empty_value0()\">
									<Option value=\"\"></option>
									<Option value=\"Mr.\""; if($title=="Mr."){echo "selected = 'selected'";} echo ">Mr.</option>
									<Option value=\"Mrs.\""; if($title=="Mrs."){echo "selected = 'selected'";} echo ">Mrs.</option>
									<Option value=\"Miss.\""; if($title=="Miss."){echo "selected = 'selected'";} echo ">Miss.</option>
									<option value=\"Eng.\""; if($title=="Eng."){echo "selected = 'selected'";} echo ">Eng.</option>
									<option value=\"Dr.\""; if($title=="Dr."){echo "selected = 'selected'";} echo ">Dr.</option>
									<option value=\"Prof.\""; if($title=="Prof."){echo "selected = 'selected'";} echo ">Prof.</option>
									<option value=\"Rev.\""; if($title=="Rev."){echo "selected = 'selected'";} echo ">Rev.</option>
									<Option value=\"Other.\""; if($title=="Other."){echo "selected = 'selected'";} echo ">Other.</option>
								</select>
								<input type=\"hidden\" name=\"user_id\" value=\"".$userID."\">
							</td>
							<td><span id=\"title_id\" class=\"bodytextred\"></span></td>
						</tr>
						
						<tr>
							<td class=\"mytd\">First Name</td>
							<td class=\"mytd\"><input type=\"text\" class=\"mytextbox3\" name=\"first_name\" value=\"".$firstName."\" id=\"first_name\" onkeyup=\"chk_empty_value3()\"> </td>
							<td><span id=\"fname_id\" class=\"bodytextred\"></span></td>
						</tr>
						<tr>
							<td class=\"mytd\">Last Name</td>
							<td class=\"mytd\"><input type=\"text\" class=\"mytextbox3\" name=\"last_name\" value=\"".$lastName."\" id=\"last_name\" onkeyup=\"chk_empty_value4()\"> </td>
							<td><span id=\"lname_id\" class=\"bodytextred\"></span></td>
						</tr>
						<tr>
							<td class=\"mytd\">Name With Initials</td>
							<td class=\"mytd\"><input type=\"text\" class=\"mytextbox3\" name=\"initials_name\" value=\"".$nameWithInitials."\" id=\"initials_name\" onkeyup=\"chk_empty_value5()\"> </td>
							<td><span id=\"iname_id\" class=\"bodytextred\"></span></td>
						</tr>	
						<tr>
							<td class=\"mytd\">Telephone Number</td>
							<td class=\"mytd\"><input type=\"text\" class=\"mytextbox3\" name=\"telephone\" value=\"".$telephone."\" id=\"telephone\" onkeyup=\"chk_empty_value6()\"> </td>
							<td><span id=\"tele_id\" class=\"bodytextred\"></span></td>
						</tr>
						<tr>
							<td class=\"mytd\">Email</td>
							<td class=\"mytd\"><input type=\"text\" class=\"mytextbox3\" name=\"email\" value=\"".$email."\" id=\"email\" onkeyup=\"chk_empty_value7()\"> </td>
							<td><span id=\"email_id\" class=\"bodytextred\"></span></td>
						</tr>

						<tr>
							<td class=\"mytd\">Address</td>
							<td class=\"mytd\"><textarea rows=\"4\"  type=\"text\" class=\"mytextbox3\" name=\"Address\" id=\"Address\" >".htmlentities($Address)."</textarea></td>
							<td><span id=\"email_id\" class=\"bodytextred\"></span></td>
						</tr>
			
			
						<tr>
							<td class=\"mytd\">Status</td>
							<td class=\"mytd\">
								<select name=\"status\"  class=\"myselect2\">
									<Option value=\"\"></option>
									<Option value=\"1\""; if($status=="1"){echo "selected = 'selected'";} echo ">Active</option>
									<Option value=\"0\""; if($status=="0"){echo "selected = 'selected'";} echo ">Deactive</option>
								</select>
							</td>
						</tr>	
						<tr>
							<td class=\"mytd\">&nbsp;</td>
							<td align=\"left\"  class=\"mytd\">
								<input type=\"button\" name=\"go1\" class=\"Submit_Button_Long_Long\" value=\"Save Changes\" onclick=\"checkOnSubmit()\">				
							</td>
						</tr>
						<input type=\"hidden\" name=\"formHidden\"/>	
						</form>
						
						
						<form name=\"passwwdchag\" method=\"post\">
						<tr>
							<td colspan=\"2\" class=\"mytd\">&nbsp;</td>
							
						</tr>
						
						<tr>
							<td class=\"mytd\">Password</td>
							<td class=\"mytd\">
								<input type=\"submit\" name=\"rpw\" class=\"Submit_Button_Long_Long\" value=\"Reset\" > Password : @bims			
								<input type=\"hidden\" name=\"user_id\" value=\"".$userID."\">
							</td>
						</tr>
						</form>
					</table>
							
				";
			}else{
					
					echo "<p class=\"bodytextsus\">Error.... No such a user.</p>";
			}
		}
	}
	include '../bottom.php';
	
?>