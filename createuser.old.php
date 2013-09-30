
<?php

//connect to our database
require('database.php'); //location of databse info class etc.
//we should be connected

if (!isConnected)
	echo 'We cannot connect to the database so the script is exiting gracefully. <br/>\n';
else
{
$result; // this holds the results of msql queries
$query; // this is the text you want to send to msql

$user = 'root';
$password = MD5('ironchef'); //root password

$query = 'insert into login (username, password) values(\' ' . $user . ' \', \' ' . $password . ' \')';

$result = mysql_query($query);

if ($result) 
	echo 'User ' . $user . 'was added successfully to the database with the password ' . $password . '<br />';
else 
	echo 'Epic fail <br/>';	

}
?>
