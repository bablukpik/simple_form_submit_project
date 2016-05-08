<?php
	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = '';
	$dbname = 'user';
	
	$link = mysql_connect($dbhost, $dbuser, $dbpass) or die('No connected');
	mysql_select_db($dbname,$link);
	if(!$link){
		echo 'Database Not Connected';
	}
?>
