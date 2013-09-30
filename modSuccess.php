<?php
ob_start();
session_start();

require("database.php"); //db connector

if ($_SESSION['manager'] ==1){

//check for manager bit

/* the employee table and its types
+--------------+---------------+------+-----+---------+-------+
| Field        | Type          | Null | Key | Default | Extra |
+--------------+---------------+------+-----+---------+-------+
| eID          | int(100)      | YES  |     | NULL    |       | 
| seniority    | varchar(255)  | YES  |     | NULL    |       | 
| commission   | int(3)        | YES  |     | NULL    |       | 
| startdate    | date          | YES  |     | NULL    |       | 
| enddate      | date          | YES  |     | NULL    |       | 
| weeklySalary | decimal(10,0) | YES  |     | NULL    |       | 
| password     | char(33)      | YES  |     | NULL    |       | 
+--------------+---------------+------+-----+---------+-------+
7 rows in set (0.00 sec)
*/

$eid = $_GET['eid'];


//variables


$name =  $_GET['name'] ;
$seniority =$_GET['seniority'] ;
$commission=$_GET['commission'];
$startdate=$_GET['startdate'] ;
$enddate= $_GET['enddate']  ;
$weekly= $_GET['weekly'];
$password = $_GET['password'];





//begin html form

echo "<html>
<head>
<title>
Modify Employee $eid
</title>
</head>
<body>
";

//if someone submitted everything filled in

if ( isset($_GET['name']) && 
isset($_GET['seniority']) && 
isset($_GET['commission']) && 
isset($_GET['startdate']) && 
isset($_GET['enddate']) && 
isset($_GET['weekly']) && 
isset($_GET['password']) )
{

	if ( !is_numeric($_GET['commission']) || !is_numeric($_GET['weekly'])) {
		
		echo "Data was not entered correctly.<br/>";
		}

	else {
	$query = "update employee 
		set name = '$name', 
		seniority='$seniority',
		commission=$commission,
		startdate = '$startdate',
		enddate = '$enddate',
		weeklysalary = $weekly,
		password = '$password'
	where eid = $eid";


	echo "User is being added to database. <br/>";
	echo $query;
	
	//insert user
	$result = mysql_query($query);	

	if( !$result)
		echo "User not added";
	
	else
		require("showEmployees.php");
	

	}
}


echo "</body></html>";


}
else
	echo "Please log in as Manager.";
ob_end_flush();
?>
