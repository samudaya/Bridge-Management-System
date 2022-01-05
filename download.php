<?php
@session_start();

define('ALLOWED_REFERRER', '');
if(isset($_GET['id']))
{
	$myid	= $_GET['id'];
	$mybased	= $_SESSION['filepathx'][$myid];
	$fname	= $_SESSION['fileidx'][$myid];
	
}

define('LOG_DOWNLOADS',true);
define('LOG_FILE','/var/www/bms-attachments/downloads.log');


if (ALLOWED_REFERRER !== ''
&& (!isset($_SERVER['HTTP_REFERER']) || strpos(strtoupper($_SERVER['HTTP_REFERER']),strtoupper(ALLOWED_REFERRER)) === false)
) 
{
	die("Internal server error. Please contact system administrator.");
}

set_time_limit(0);

function find_file ($dirname, $fname, &$file_path) 
{
	$dir = opendir($dirname);

	while ($file = readdir($dir)) 
	{
		if (empty($file_path) && $file != '.' && $file != '..') 
		{
			if (is_dir($dirname.'/'.$file)) 
			{
				find_file($dirname.'/'.$file, $fname, $file_path);
			}
			else 
			{
				if (file_exists($dirname.'/'.$fname)) 
				{
					$file_path = $dirname.'/'.$fname;
					return;
				}
			}
		}
	}

}

$file_path	= $mybased.$fname;
$fsize = filesize($file_path); 

$fext = strtolower(substr(strrchr($fname,"."),1));
$mtype = $allowed_ext[$fext];

$asfname = $fname;
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: public");
header("Content-Description: File Transfer");
header("Content-Type: $mtype");
header("Content-Disposition: attachment; filename=\"$asfname\"");
header("Content-Transfer-Encoding: binary");
header("Content-Length: " . $fsize);

$file = @fopen($file_path,"rb");
if ($file) 
{
	while(!feof($file)) 
	{
		print(fread($file, 1024*8));
		flush();
		if (connection_status()!=0) 
		{
			@fclose($file);
			die();
		}
	}
	@fclose($file);
}

if (!LOG_DOWNLOADS) die();

$f = @fopen(LOG_FILE, 'a+');
if ($f) 
{
	@fputs($f, date("m.d.Y g:ia")."  ".$_SERVER['REMOTE_ADDR']."  ".$fname."\n");
	@fclose($f);
}
?>
