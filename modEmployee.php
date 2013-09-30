<?php
ob_start();
session_start();

require("database.php"); //db connector

if ($_SESSION['maanger']==1) {

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
if ($_GET['update'] ==1)
{
//variables
$query = "select eid, name, seniority, commission, startdate,enddate,weeklysalary,password 
		from employee
		where eid = $eid";// order by eid DESC";
$result = mysql_query($query);
$row = mysql_fetch_array($result);



$name =  $row['name'] ;
$seniority =$row['seniority'] ;
$commission=$row['commission'];
$startdate=$row['startdate'] ;
$enddate= $row['enddate']  ;
$weekly= $row['weeklysalary'];
$password = $row['password'];
}




//begin html form

echo "<html>
<head>
<title>
Modify Employee $eid
</title>
</head>
<body>

<form name=\"createmployee\" action=\"modSuccess.php\" method=\"get\">
<input type=\"hidden\" name=\"eid\" value=$eid>
Employee's Name: <input type=\"text\" name=\"name\" value='$name'> <br/>
Employee's Seniority:  <input type=\"text\" name=\"seniority\" value='$seniority'> <br/>
Employee's Commission Rate:  <input type=\"text\" name=\"commission\" value='$commission'> <br/>
Employee's Start Date:  <input type=\"text\" name=\"startdate\" value='$startdate'> <br/>
Employee's End Date (default is 2010-01-01):  <input type=\"text\" name=\"enddate\" value='$enddate'> <br/>
Employee's Weekly Salary:  <input type=\"text\" name=\"weekly\" value=$weekly> <br/>
Employee's Password:  <input type=\"text\" name=\"password\" value='$password'> <br/>
<input type=\"submit\" >
</form>"; 

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
	echo "Please Log in as Manager.";
ob_end_flush();
?>
