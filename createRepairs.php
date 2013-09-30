<?php
ob_start();
session_start();

if ($_SESSION['manager'] == 1 )
{

require("database.php"); //db connector

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

//begin html form
$today = date('y-m-d');

echo "<html>
<head>
<title>
Create Repairs
</title>
</head>
<body>

<form name=\"createmployee\" action=\"createRepairs.php\" method=\"get\">
Repair Date: <input type=\"text\" name=\"date\" value='$today'> <br/>
Repaired by (employee #):  <input type=\"text\" name=\"eid\"> <br/>
Repair Cost:  $<input type=\"text\" name=\"price\"> <br/>
Computer Serial #: <input type='text' name='serial' value='00000'><br/>
Repair Notes: <br/><textarea wrap='virtual' name=\"notes\" cols='30' rows='5'>Repair notes </textarea><br/>
<input type=\"hidden\" value=1 name='default'>
<input type=\"submit\">
</form>"; 

//if someone submitted everything filled in

if ( isset($_GET['date']) && 
isset($_GET['eid']) && 
isset($_GET['price']) && 
isset($_GET['notes']) )
{

$date = $_GET['date'];
$price = $_GET['price'];
$eid = $_GET['eid'];
$notes = $_GET['notes'];
$serial = $_GET['serial'];
	if ( !is_numeric($_GET['price']) ) {
		
		echo "Data was not entered correctly.<br/>";
		}

	else {
	/*
	$query = "insert into employee(name, seniority,commission,startdate,enddate,weeklysalary,password) values ('" 
	. $_GET['name'] . "','" 
	. $_GET['seniority'] . "'," 
	. $_GET['commission'] . ",'" 
	. $_GET['startdate'] . "','" 
	. $_GET['enddate'] . "',"
	. $_GET['weekly'] . ",'"
	. $_GET['password'] . "' )";
	*/

	
	$query = "insert into repairs(repairdate,price,notes,serial) values ('$date', $price, '$notes','$serial')";
	
	echo "Repair is being added to database. <br/>";
	echo "Query is <i><br/>" . $query . "</i><br/>";
	mysql_query($query);

	$query = "insert into repairedBy values($eid, (select max(repairNumber) from repairs) )";

	
	echo $query . "<br/>";
	mysql_query($query);
	echo "Showing all repair history <br/>";
		/*
	//insert user
	$result = mysql_query($query);	

	if( !$result)
		echo "User not added";
	
	else
		require("showEmployees.php");
	*/

	}
include('showRepairs.php');
//header('showRepairs.php?default=1');

}



echo "</body></html>";
}
else {
	echo "Please log in as a manager.";
}
ob_end_flush();
?>
