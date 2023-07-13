<?php
	@session_start();
	include ("global.php");
	include ("top.php");	
?>

<script type = "text/javascript">
	function checkOnSubmit()
	{
		var username	= "<?php echo $_SESSION['logined_UserName']; ?>";
		var pw1 		= document.myform.new_pwd.value;
		var pw2 		= document.myform.re_new_pwd.value;
		var valid 		= false;

		if(pw1 == pw2)
		{
			var passed = validatePassword(pw1);
			
			if(passed == false)
			{
				document.myform.new_pwd.value 			= "";
				document.myform.re_new_pwd.value 	= "";
				alert("Password does not comply with the password policy !");
			}
			else
			{
				myform.submit();
			}			
		}
		else
		{
			document.myform.new_pwd.value 			= "";
			document.myform.re_new_pwd.value 	= "";
			alert("Passwords do not match !");
		}
	}

	
	function validatePassword (pw) 
	{
		var username    = "<?php echo $_SESSION['logined_UserName']; ?>";
		var o = {
			lower:    1,
			upper:    1,
			alpha:    0, /* lower + upper */
			numeric:  1,
			special:  1,
			length:   [8, Infinity],
			custom:   [ /* regexes and/or functions */ ],
			badWords: [username],
			badSequenceLength: 0,
			noQwertySequences: false,
			noSequential:      false
		};

	/*	for (var property in options)
			o[property] = options[property];*/

		var	re = {
				lower:   /[a-z]/g,
				upper:   /[A-Z]/g,
				alpha:   /[A-Z]/gi,
				numeric: /[0-9]/g,
				special: /[\W_]/g
			},
			rule, i;

		// enforce min/max length
		if (pw.length < o.length[0] || pw.length > o.length[1])
			return false;

		// enforce lower/upper/alpha/numeric/special rules
		for (rule in re) 
		{
			if ((pw.match(re[rule]) || []).length < o[rule])
				return false;
		}

		// enforce word ban (case insensitive)
		for (i = 0; i < o.badWords.length; i++) 
		{
			if (pw.toLowerCase().indexOf(o.badWords[i].toLowerCase()) > -1)
				return false;
		}

		// enforce the no sequential, identical characters rule
		if (o.noSequential && /([\S\s])\1/.test(pw))
			return false;

		// enforce alphanumeric/qwerty sequence ban rules
		if (o.badSequenceLength) 
		{
			var	lower   = "abcdefghijklmnopqrstuvwxyz",
				upper   = lower.toUpperCase(),
				numbers = "0123456789",
				qwerty  = "qwertyuiopasdfghjklzxcvbnm",
				start   = o.badSequenceLength - 1,
				seq     = "_" + pw.slice(0, start);
			for (i = start; i < pw.length; i++) 
			{
				seq = seq.slice(1) + pw.charAt(i);
				if 
				(
					lower.indexOf(seq)   > -1 ||
					upper.indexOf(seq)   > -1 ||
					numbers.indexOf(seq) > -1 ||
					(o.noQwertySequences && qwerty.indexOf(seq) > -1)
				) {
					return false;
				}
			}
		}

		// enforce custom regex/function rules
		for (i = 0; i < o.custom.length; i++) 
		{
			rule = o.custom[i];
			if (rule instanceof RegExp) 
			{
				if (!rule.test(pw))
					return false;
			} 
			else if (rule instanceof Function) 
			{
				if (!rule(pw))
					return false;
			}
		}
		// great success!
		return true;
	}
</script>

	<link rel="stylesheet" type="text/css" href="common/common.css" />

</head>	
<body>
<?php
	echo "<p class=\"hx1\">Change My Password</p>";	
	echo "<br />";
?>
	
	
	<?php
	if(isset($_POST['curr_pwd'])){
		$currPwd 	= md5($_POST['curr_pwd']);
		$newPwd 	= md5($_POST['new_pwd']);
		$reNewPwd 	= md5($_POST['re_new_pwd']);
		
		$query_user_curr_pwd = "select Password from bms_users where UserID=\"".$_SESSION['log_UserID']."\"";
		$result_user_curr_pwd = mysql_query($query_user_curr_pwd) or die (mysql_error());
		while($row_user_curr_pwd = mysql_fetch_array($result_user_curr_pwd)){
			$user_curr_pwd = $row_user_curr_pwd['Password'] ;
		}
		if($currPwd==$user_curr_pwd){
		
			if($newPwd == $reNewPwd){
				$query_change_pd = "update bms_users set Password = \"".$newPwd."\" where UserID = \"".$_SESSION['log_UserID']."\"";
				$result_change_pd = mysql_query($query_change_pd) or die (mysql_error());
				
				
				$users_UserID	= $_SESSION['log_UserID'];
				$TableName		= "bms_users";
				$SQLQuery		= "update bms_users set Password = \"".$newPwd."\" where UserID = \"".$_SESSION['log_UserID']."\"";
				$Action			= "UPDATE";
				$query_log = "insert into bms_logs(users_UserID, TableName,	SQLQuery, 	Action) values ('".$users_UserID."','".$TableName."','". $SQLQuery."','". $Action."')";
				$result_log = mysql_query($query_log) or die (mysql_error());
				
				
				
				
				
				
				echo "<p class=\"bodytextsus\">Password changed succesfully.</p>";
			}else{
				echo "<p class=\"bodytextred\">Error:<br />New password & Re-type new password does not Matched</p>";
			}
		}else{
				echo "<p class=\"bodytextred\">Error:<br />Your entered wrong \"current password\"</p>";
		}
	}
	if(!isset($_POST['formHidden']))
	{
		echo "<form name =\"myform\" id=\"myform\" method=\"post\"  >";
		echo "<table>
			<tr>
				<td class=\"mytd\">User Name</td>
				<td class=\"mytd\">".$_SESSION['log_Username']."</td>
			</tr>
			<tr>
				<td class=\"mytd\">Current Password</td>
				<td class=\"mytd\"><input class=\"mytextbox2\" type=\"password\" name=\"curr_pwd\" id=\"curr_pwd\" onkeyup=\"chk_empty_value0()\"/></td>
				<td><span id=\"cur_pwd_id\" class=\"bodytextred\"></span></td>
			</tr>
			<tr>
				<td class=\"mytd\">New Password</td>
				<td class=\"mytd\"><input class=\"mytextbox2\" type=\"password\" name=\"new_pwd\" id=\"new_pwd\" onkeyup=\"chk_empty_value1()\"/></td>
				<td><span id=\"new_pwd_id\" class=\"bodytextred\"></span></td>
			
			</tr>
			<tr>
				<td class=\"mytd\">Re-type New Password</td>
				<td class=\"mytd\"><input class=\"mytextbox2\" type=\"password\" name=\"re_new_pwd\" id=\"re_new_pwd\" onkeyup=\"chk_empty_value2()\"/></td>
				<td><span id=\"re_new_pwd_id\" class=\"bodytextred\"></span></td>
			</tr>
			<tr>
				<td colspan=\"2\" align=\"center\" class=\"mytd\">";				
					echo "<input type=\"button\" name=\"go\" class=\"Submit_Button_Long_Long\" value=\"Change Password\"  onclick=\"checkOnSubmit()\"/>";
				echo "</td>
			</tr>
		</table>
		<input type=\"hidden\" name=\"formHidden\"/>";		
		echo "</form>";
	
		echo "<br/>";
		echo "<br/>";
		
			
		
		
		?>
		<br /><br /><br />
		
		<table align="left" width="500" class="bodytext" bgcolor="#A9D0F5" >
			<tr>
				<td colspan="2" align="left">
						
					<br />
					<strong>&nbsp;&nbsp;&nbsp;It is recomended to use password with ;</strong>
					<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- you need to include (for security reasons)
					<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* at-least one number and 
					<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* at-least one lower-case letter and
					<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* at-least one upper-case letter and 
					<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* at-least one symbol (like @,$,!,#,%,^,&amp;)
					<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- more than eight characters 
					
					<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- do not include username
					<br />&nbsp;
				</td>
			</tr>
		</table>
		
		<?php 
	}
include 'bottom.php';
?>
