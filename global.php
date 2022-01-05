<?php
	$pathprefix="https://localhost/bms/";
	$datadir = '/var/www/bms-attachments/bridge/';
	$datadir2 = '/var/www/bms-attachments/inspection1/';
	$datadir3 = '/var/www/bms-attachments/inspection2/';
	
	///////////////////////////////////////////////////////////////////////////////////////////
	////////////// "Probability of Failure Factor" and "Probability of Consequences Factor" ///
	////////////// Used in Risk Calculation ///////////////////////////////////////////////////
		$ProbalilityOfFailureFactor = 1280; // (5 * (4*4) * (4*4))
		$ProbalilityOfConsequencesFactor = 700; // (4 * 5 * 5 * 7)
	//////////////////////////////////////////////////////////////////////////////////////////
	
	$mis_db_connect = mysql_connect("localhost", "root", "rootPW") or die(mysql_error());
	mysql_select_db('bms', $mis_db_connect) or die(mysql_error());

?>