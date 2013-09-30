<?php 
//this contains the db location and password
$dbLocation = "";
$dbUser = "";
$dbPassword = "";
$dbName = ""; //database name

$isConnected = mysql_connect( $dbLocation, $dbUser, $dbPassword);
      if (!$isConnected) //if database is not connected
        {
            die('Could not connect to Database:' . mysql_error() );
        }

        else
        {
            mysql_select_db($dbName,$isConnected);
	  }
?>
