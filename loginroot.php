<?php
ob_start();
//session_save_path("tmp");
//connect to our database
require('database.php'); //location of databse info class etc.
//we should be connected

if (!isConnected)
	echo 'We cannot connect to the database so the script is exiting gracefully. <br/>\n';
else
{
$result; // this holds the results of msql queries
$query; // this is the text you want to send to msql

$user = ' root'; //not sure whats going but you need a space before characters
$password = ' ' . MD5('ironchef');


$query = 'select username from login where username=\'' . $user . '\' and password=\'' . $password .'\' '; 
$result = mysql_query($query);
echo $query . '<br/>';

if ( mysql_num_rows($result) > 0 ) 
	echo 'User exists <br />';
else 
	echo 'User not found <br/>';	

if ( mysql_num_rows($result) > 0 ) {
	//session_register("user");
	//session_register("password");
	
	session_start();
	$_SESSION['user'] = $user;
	$_SESSION['password'] = $password;
	$_SESSION['eid'] = 51;
	header("location:loginsuccess.php");
	}
else 
	header("location:login.php");
}
ob_end_flush();
?>
