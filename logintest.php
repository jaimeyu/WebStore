<?php
ob_start();
//session_save_path("tmp");
//connect to our database
require('database.php'); //location of databse info class etc.
//we should be connected

if ( !isset($_GET['eid']) and !isset($_GET['pasword']) ){
	echo 'Please login Again.<br/>';
	//header('login.php');
}
else
{
$result; // this holds the results of msql queries
$query; // this is the text you want to send to msql

$user =$_GET['eid'] ; //not sure whats going but you need a space before characters
$password =$_GET['password'] ;


//$query = 'select eid,name from employee where username=\'' . $user . '\' and password=\'' . $password .'\' '; 
$query = "select eid,seniority,name from employee where eid=$user and password='$password'";

$result = mysql_query($query);
echo $query . '<br/>';
if ( mysql_num_rows($result) > 0 ) 
	echo 'User exists <br />';
else 
	echo 'User not found <br/>';	

if ( mysql_num_rows($result) ) { //mysql_num_rows($result) > 0 ) {
	//session_register("user");
	//session_register("password");
	
	session_start();
	$_SESSION = array(); //free up session first
	$_SESSION['user'] = $user;
	//$_SESSION['password'] = $password;
	$_SESSION['eid'] = $user;
	$_SESSION['logged'] =1 ;
	
	$row = mysql_fetch_array($result);
	
	echo $row['seniority'];
	if( $row['seniority'] == 'Manager')
		$_SESSION['manager'] = 1;
	else
		$_SESSION['manager'] = 0;
	
	$_SESSION['ename'] = $row['name'];
	
	header("location:index.php");
	}
else{ 

	echo "fail";
	$_SESSION = array(); //kills session
	//session_destroy();
	header("location:logout.php");
	}
}
ob_end_flush();
?>
