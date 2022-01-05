<?php
	include ("../global.php");
	include ("../top.php");

	echo "<head>";

	echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"../common/common.css\" />";
?>
<script language="javascript" type="text/javascript" >
<!-- hide

        function jumpto()
        {
                f = document.callingform
                f.submit();
        }

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
                                div.innerHTML = " " + xmlHttp.responseText;
                        }
                }

                xmlHttp.open("GET","user_add_check_user_name_availability_ajax.php?username="+document.myform.username.value,true);
                xmlHttp.send(null);
        }
		

function checkOnSubmit()
	{
		var flag=true;
		
		var title1		= document.myform.title.value;
		var username1	= document.myform.username.value;
		var password1	= document.myform.password.value;
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
		if(username1 == '')
		{
			al_username1=document.getElementById("uname_id");
			al_username1.innerHTML="Please enter username";
			flag=false;
		}
		if(password1 == '')
		{
			al_password1=document.getElementById("password_id");
			al_password1.innerHTML="Please enter password";
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
	function chk_empty_value2()
	{
		al_password=document.getElementById("password_id");
		al_password.innerHTML="";
		
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
	echo "<body autocomplete=\"off\" >";
	echo "<p class=\"hx1\">Add New User</p>";
	

	if(isset($_POST['first_name'])){
		$firstName 			= $_POST['first_name'];
		$lastName			= $_POST['last_name'];
		$userName			= $_POST['username'];
		$password			= md5($_POST['password']);
		$userTypeID			= $_POST['user_type'];
		$telephone			= $_POST['telephone'];
		$email				= $_POST['email'];
		$NameWithInitials	= $_POST['initials_name'];
		$Active				= $_POST['status'];
		$title				= $_POST['title'];
		$Address			= $_POST['Address'];
			$Address = str_replace("'", "\\'", $Address);
			$Address = str_replace('"', '\\"', $Address);
		$addedBy			= $_SESSION['log_UserID'];
		$addedDate			= date("Y-m-d H:i:s");
		
		$sections_SectionID	= 1;
		$query_resource = "insert into bms_users(Username,	
														Password, 
														sections_SectionID, 
														NameWithInitials,
														FirstName, 
														LastName, 
														Title, 
														TeleNum, 
														eMail, 
														Address,
														Active,
														AddedBy,
														AddedDate) 
								values ('".$userName."',
										'".$password."',
										'".$sections_SectionID."',
										'".$NameWithInitials."',
										'".$firstName."',
										'".$lastName."',
										'".$title."',
										'".$telephone."',
										'".$email."',
										'".$Address."',
										'".$Active."',
										'".$addedBy."',
										'".$addedDate."')";
		$result_resource = mysql_query($query_resource) or die (mysql_error());
		
		
		$users_UserID	= $_SESSION['log_UserID'];
		$TableName		= "bms_users";
		$SQLQuery		= "insert into bms_users(Username,	
														Password, 
														sections_SectionID, 
														NameWithInitials,
														FirstName, 
														LastName, 
														Title, 
														TeleNum, 
														eMail, 
														Address,
														Active,
														AddedBy,
														AddedDate) 
								values (\'".$userName."\',
										\'".$password."\',
										\'".$sections_SectionID."\',
										\'".$NameWithInitials."\',
										\'".$firstName."\',
										\'".$lastName."\',
										\'".$title."\',
										\'".$telephone."\',
										\'".$email."\',
										\'".$Address."\',
										\'".$Active."\',
										\'".$addedBy."\',
										\'".$addedDate."\')";
		$Action			= "INSERT";
		$query_log = "insert into bms_logs(users_UserID, TableName,	SQLQuery, 	Action) values ('".$users_UserID."','".$TableName."','". $SQLQuery."','". $Action."')";
		$result_log = mysql_query($query_log) or die (mysql_error());
		echo "<p class=\"bodytextsus\">succesfully added.</p>";		
		
	}
	
	
	
	
	/* Data View Form........................................................................................
	*
	*
	*/
	if(!isset($_POST['formHidden'])){
	echo "
		<form autocomplete=\"off\"  name=\"myform\" id=\"myform\" method=\"POST\" action=\"#\"  >
		  <table class=\"bodytext\">
		  	<tr>
				<td class=\"mytd\">Title</td>
				<td class=\"mytd\">
					<select name=\"title\" class=\"myselect2\" id=\"title\" onChange=\"chk_empty_value0()\">
						<option value=\"\"></option>
						<option value=\"Mr.\">Mr.</option>
						<option value=\"Mrs.\">Mrs.</option>
						<option value=\"Miss.\">Miss.</option>
						<option value=\"Eng.\">Eng.</option>
						<option value=\"Dr.\">Dr.</option>
						<option value=\"Prof.\">Prof.</option>
						<option value=\"Rev.\">Rev.</option>
						<option value=\"Other.\">Other.</option>
					</select>
				</td>
				<td><span id=\"title_id\" class=\"bodytextred\"></span></td>
			</tr>
			
		  <tr>
				<td class=\"mytd\">Username</td>
				<td class=\"mytd\"><div>
				<input type=\"text\" oninput=\"ajaxFunction();\"  class=\"mytextbox2\" name=\"username\" id=\"username\" onkeyup=\"chk_empty_value1()\"><span id=\"des\" ></span></div>
				</td>
				<td><span id=\"uname_id\" class=\"bodytextred\"></span></td>
			</tr>
			<tr>
				<td class=\"mytd\">Password</td>
				<td class=\"mytd\"> <input type=\"password\" class=\"mytextbox3\" name=\"password\" id=\"password\" onkeyup=\"chk_empty_value2()\"> </td>
				<td><span id=\"password_id\" class=\"bodytextred\"></span></td>
			</tr>
			
		
			<tr>
				<td class=\"mytd\">First Name</td>
				<td class=\"mytd\"> <input type=\"text\" class=\"mytextbox3\" name=\"first_name\" id=\"first_name\" onkeyup=\"chk_empty_value3()\"> </td>
				<td><span id=\"fname_id\" class=\"bodytextred\"></span></td>
			</tr>
			<tr>
				<td class=\"mytd\">Last Name</td>
				<td class=\"mytd\"> <input type=\"text\" class=\"mytextbox3\" name=\"last_name\" id=\"last_name\" onkeyup=\"chk_empty_value4()\"> </td>
				<td><span id=\"lname_id\" class=\"bodytextred\"></span></td>
			</tr>	
			
			<tr>
				<td class=\"mytd\">Name With Initials</td>
				<td class=\"mytd\"> <input type=\"text\" class=\"mytextbox3\" name=\"initials_name\" id=\"initials_name\" onkeyup=\"chk_empty_value5()\"> </td>
				<td><span id=\"iname_id\" class=\"bodytextred\"></span></td>
			</tr>	
			
			<tr>
				<td class=\"mytd\">Telephone Number</td>
				<td class=\"mytd\"> <input type=\"text\" class=\"mytextbox3\" name=\"telephone\" id=\"telephone\" onkeyup=\"chk_empty_value6()\">  </td>
				<td><span id=\"tele_id\" class=\"bodytextred\"></span></td>
			</tr>
			<tr>
				<td class=\"mytd\">Email</td>
				<td class=\"mytd\"> <input type=\"text\" class=\"mytextbox3\" name=\"email\" id=\"email\" onkeyup=\"chk_empty_value7()\"> </td>
				<td><span id=\"email_id\" class=\"bodytextred\"></span></td>
			</tr>
			
			<tr>
				<td class=\"mytd\">Address</td>
				<td class=\"mytd\"><textarea rows=\"4\" type=\"text\" class=\"mytextbox3\" name=\"Address\" id=\"Address\" >".$Address."</textarea></td>
				
			</tr>
			
			
			
			<tr>
				<td class=\"mytd\">Status</td>
				<td class=\"mytd\">
					<select name=\"status\"  class=\"myselect2\">
						<Option selected=\"selected\" value=\"1\">Active</option>
						<Option value=\"0\">Deactive</option>
					</select>
				</td>
			</tr>	
			<tr>
				<td colspan=\"2\" align=\"center\"  class=\"mytd\">
					<input type=\"button\" name=\"go\" class=\"Submit_Button_Long_Long\" value=\"Add User\" onclick=\"checkOnSubmit()\">				
				</td>
			</tr>
		</table>
		<input type=\"hidden\" name=\"formHidden\"/>	
		</form>
	";
	}
	echo "</body>";
	include '../bottom.php';

?>