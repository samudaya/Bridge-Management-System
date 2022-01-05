<?php
	@session_start();
	include ("global.php");
	include ("top.php");

	echo "<head>";		
		echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"common/common.css\" />";
		echo "<link rel=\"stylesheet\" href=\"../lib/ajax/mSuggest.css\" type=\"text/css\" />";
		echo "<script src=\"../lib/ajax/mTools.js\"></script>";
		echo "<script src=\"../lib/ajax/mSuggest.js\"></script>	";
?>
	<script type = "text/javascript">
	<!--
	
	function checkOnSubmit()
	{
		var flag=true;
		var title1	= document.myform.title.value;
		var fname1	= document.myform.fname.value;
		var lname1 	= document.myform.lname.value;
		
		var tele1	= document.myform.tele.value;
		var tele1num = IsNumeric(tele1);
		

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
		if(fname1 == '')
		{
			al_fname1=document.getElementById("fname_id");
			al_fname1.innerHTML="Please enter a first name";
			flag=false;
		}
		if(lname1 == '')
		{
			al_lname1=document.getElementById("lname_id");
			al_lname1.innerHTML="Please enter a last name";
			flag=false;
		}
		if(tele1 == '')
		{
			al_tele1=document.getElementById("tele_id");
			al_tele1.innerHTML="Please enter a phone number";
			flag=false;
		}
		else if(tele1.length < 10 || tele1.length > 25 ){
			al_tele1_len=document.getElementById("tele_id");
			al_tele1_len.innerHTML="Length should be 10 to 25.(Number Format:(+94) 000-000000)";
			document.myform.tele.value="";
			flag=false;
		}else if(tele1num==false){
			al_tele1_char=document.getElementById("tele_id");
			al_tele1_char.innerHTML="This is not a telephone number. (Number Format:(+94) 000-000000)";
			document.myform.tele.value="";
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
	
	function chk_empty_value()
	{
		al_title=document.getElementById("title_id");
		al_title.innerHTML="";
		
	}
	function chk_empty_value0()
	{
		al_fname=document.getElementById("fname_id");
		al_fname.innerHTML="";
		
	}
	function chk_empty_value1()
	{
		al_lname=document.getElementById("lname_id");
		al_lname.innerHTML="";
		
	}
	
	function chk_empty_value2()
	{
		al_tele=document.getElementById("tele_id");
		al_tele.innerHTML="";
		
	}
	
	function chk_empty_value3()
	{
		al_email=document.getElementById("email_id");
		al_email.innerHTML="";
		
	}
	-->
	</script>
	
	
	<style type="text/css">
		.error{
			font-family : cambria;
			font-size : 10pt;
			color : red;
		}
	</style>
<?php	
	echo "</head>";

	echo "<p class=\"hx1\">Edit My Profile</p>";
	echo "<br />";
		

	if(isset($_POST['first_name'])){
		$userID				= $_POST['user_id'];
		$firstName 			= $_POST['first_name'];
		$lastName			= $_POST['last_name'];
		$telephone			= $_POST['telephone'];
		$email				= $_POST['email'];
		$title				= $_POST['title'];
		$Address			= $_POST['Address'];
			$Address = str_replace("'", "\\'", $Address);
			$Address = str_replace('"', '\\"', $Address);
		
		$modifiedBy			= $_SESSION['log_UserID'];
		$modifiedDate		= date("Y-m-d H:i:s");
		$query_resource = "update bms_users set FirstName = '".$firstName."', 
														LastName = '".$lastName."', 
														Title = '".$title."', 
														TeleNum = '".$telephone."', 
														eMail = '".$email."', 
														Address = '".$Address."', 
														ModifiedBy = '".$modifiedBy."',
														ModifiedDate = '".$modifiedDate."'														
									where UserID = '".$userID."'";
								
		$result_resource = mysql_query($query_resource) or die (mysql_error());
		echo "<p class=\"bodytextsus\">Succesfully updated.</p>";	
		
		$users_UserID	= $_SESSION['log_UserID'];
		$TableName		= "bms_users";
		$SQLQuery		= "update bms_users set FirstName = \'".$firstName."\', LastName = \'".$lastName."\', Title = \'".$title."\', TeleNum = \'".$telephone."\', eMail = \'".$email."\', Address = \'".$Address."\', ModifiedBy = \'".$modifiedBy."\', ModifiedDate = \'".$modifiedDate."\' ";
		$Action			= "UPDATE";
		$query_log = "insert into bms_logs(users_UserID, TableName,	SQLQuery, 	Action) values ('".$users_UserID."','".$TableName."','". $SQLQuery."','". $Action."')";
		$result_log = mysql_query($query_log) or die (mysql_error());
			
		
	}
	
		/* User data Query...........................................................................
		*
		*
		*/	
		
		$query_bsr_resource = "select * from bms_users where UserID=\"".$_SESSION['log_UserID']."\"";        
		$result_bsr_resource = mysql_query($query_bsr_resource) or die (mysql_error());
		while($row_bsr = mysql_fetch_array($result_bsr_resource))
		{			
			$userID			= $row_bsr['UserID'];
			$firstName 		= $row_bsr['FirstName'];
			$lastName		= $row_bsr['LastName'];
			$userName		= $row_bsr['Username'];
			$companyID		= $row_bsr['web_users_CompanyID'];
			$telephone		= $row_bsr['TeleNum'];
			$email			= $row_bsr['eMail'];
			$status			= $row_bsr['Active'];
			$title			= $row_bsr['Title'];
			$Address		= $row_bsr['Address'];
			$nameWithInitials	= $row_bsr['NameWithInitials'];		
			

	if(!isset($_POST['formHidden']))
	{
	echo "
		<form name=\"myform\" id=\"myform\" method=\"post\" >
		<table class=\"bodytext\">
			<tr>
				<td class=\"mytd\">Username</td>
				<td class=\"mytd\">".$userName. "</td>
			</tr>
			<tr>
				<td class=\"mytd\">Title</td>
				<td class=\"mytd\">
					<select name=\"title\" class=\"myselect2\" id=\"title\" onChange=\"chk_empty_value()\">
						<Option value=\"\"></option>
						<Option value=\"Mr.\""; if($title=="Mr."){echo "selected = 'selected'";} echo ">Mr.</option>
						<Option value=\"Mrs.\""; if($title=="Mrs."){echo "selected = 'selected'";} echo ">Mrs.</option>
						<Option value=\"Miss.\""; if($title=="Miss."){echo "selected = 'selected'";} echo ">Miss.</option>
						<Option value=\"Eng.\""; if($title=="Eng."){echo "selected = 'selected'";} echo ">Eng.</option>
						<Option value=\"Dr.\""; if($title=="Dr."){echo "selected = 'selected'";} echo ">Dr.</option>
						<Option value=\"Prof.\""; if($title=="Prof."){echo "selected = 'selected'";} echo ">Prof.</option>
						<Option value=\"Rev.\""; if($title=="Rev."){echo "selected = 'selected'";} echo ">Rev.</option>
						<Option value=\"Other.\""; if($title=="Other."){echo "selected = 'selected'";} echo ">Other.</option>
					</select>
					<input type=\"hidden\" name=\"user_id\" value=\"".$userID."\">
				</td>
				<td><span id=\"title_id\" class=\"bodytextred\"></span></td>
			</tr>
			<tr>
				<td class=\"mytd\">First Name</td>
				<td class=\"mytd\"><input type=\"text\" class=\"mytextbox3\" name=\"first_name\" id=\"fname\" onkeyup=\"chk_empty_value0()\" value=\"".$firstName."\"> </td>
				<td><span id=\"fname_id\" class=\"bodytextred\"></span></td>
			</tr>
			<tr>
				<td class=\"mytd\">Last Name</td>
				<td class=\"mytd\"><input type=\"text\" class=\"mytextbox3\" name=\"last_name\" id=\"lname\" onkeyup=\"chk_empty_value1()\" value=\"".$lastName."\"> </td>
				<td><span id=\"lname_id\" class=\"bodytextred\"></span></td>
			</tr>
			<tr>
				<td class=\"mytd\">Telephone Number</td>
				<td class=\"mytd\"><input type=\"text\" class=\"mytextbox3\" name=\"telephone\" id=\"tele\" onkeyup=\"chk_empty_value2()\" value=\"".$telephone."\"> </td>
				<td><span id=\"tele_id\" class=\"bodytextred\"></span></td>
			</tr>
			<tr>
				<td class=\"mytd\">Email</td>
				<td class=\"mytd\"><input type=\"text\" class=\"mytextbox3\" name=\"email\" id=\"email\" onkeyup=\"chk_empty_value3()\" value=\"".$email."\"> </td>
				<td><span id=\"email_id\" class=\"bodytextred\"></span></td>
			</tr>
			
			
			<tr>
				<td class=\"mytd\">Address</td>
				<td class=\"mytd\"><textarea rows=\"4\"  type=\"text\" class=\"mytextbox3\" name=\"Address\" id=\"Address\" >".htmlentities($Address)."</textarea></td>
				<td><span id=\"email_id\" class=\"bodytextred\"></span></td>
			</tr>
			
			
			
			
			
			
			
			
			
			
			<tr>
				<td class=\"mytd\">Name With Initials</td>
				<td class=\"mytd\">".$nameWithInitials."</td>
			</tr>				
			
			<tr>
				<td class=\"mytd\">Status</td>";
				if($status=="1"){echo "	<td class=\"mytd\">Active</td>";}
				if($status=="0"){echo "	<td class=\"mytd\">Deactive</td>";}
			echo "</tr>	
		<tr>
				<td colspan=\"2\" align=\"center\" class=\"mytd\">";				
					echo "<input type=\"button\" name=\"go\" class=\"Submit_Button_Long_Long\" value=\"Save Changes\"  onclick=\"checkOnSubmit()\"/>";
				echo "</td>
			</tr>
		</table>
			<input type=\"hidden\" name=\"formHidden\"/>
		</form>
	";
	}		
include 'bottom.php';
?>