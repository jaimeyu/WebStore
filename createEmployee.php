<?php
ob_start();
session_start();

require("database.php"); //db connector

if ( $_SESSION['manager'] ==1){

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

echo "<html>
<head>
<title>
Create Employee
</title>
</head>
<body>

<form name=\"createmployee\" action=\"createEmployee.php\" method=\"get\">
Employee's Name: <input type=\"text\" name=\"name\"> <br/>
Employee's Seniority:  <select name='seniority'>
			<option value='Salesman'>Salesman</option>
			<option value='Manager'>Manager</option>
			<option value='Technician'>Technician</option>
			</select><br/>

<!--<input type=\"text\" name=\"seniority\"> <br/>-->
Employee's Commission Rate:  <input type=\"text\" name=\"commission\" value='50.0'> <br/>
Employee's Start Date:  <input type=\"text\" name=\"startdate\" value=\"2002-01-01\"> <br/>
Employee's End Date (default is 2010-01-01):  <input type=\"text\" name=\"enddate\" value=\"2010-01-01\"> <br/>
Employee's Weekly Salary:  <input type=\"text\" name=\"weekly\"> <br/>
Employee's Password:  <input type=\"text\" name=\"password\"> <br/>
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
	$query = "insert into employee(name, seniority,commission,startdate,enddate,weeklysalary,password) values ('" 
	. $_GET['name'] . "','" 
	. $_GET['seniority'] . "'," 
	. $_GET['commission'] . ",'" 
	. $_GET['startdate'] . "','" 
	. $_GET['enddate'] . "',"
	. $_GET['weekly'] . ",'"
	. $_GET['password'] . "' )";

	echo "User is being added to database. <br/>";
	echo "Query used is <br/><i>$query</i><br/>";
	
	//insert user
	$result = mysql_query($query);	

	if( !$result)
		echo "User not added";
	
	else
		require("showEmployees.php");
		//header("showEmployees.php");
	

	}
}



echo "</body></html>";

}
else {
	echo "Please log in as a manager";
}
ob_end_flush();
?>
