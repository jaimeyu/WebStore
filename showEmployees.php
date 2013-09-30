<?
ob_start();
session_start();
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

require("database.php"); //contains the method to access the db
            mysql_select_db($dbName);

/*
if (  !isset($_SESSION['eid']) ){ //checks if you are logged in

echo "Error, you are not allowed to see this page. Log in as Manager";

}
else {//if ( $_SESSION['manager'] == 1  ) { //checks if you are the manager
*/if (true){
$query = "select eid, name, seniority, commission, startdate,enddate,weeklysalary,password from employee order by eid ASC";// order by eid DESC";

echo "<br/>
	Query used was: <i><br/>
	$query</i><br/>
";

$result = mysql_query($query) or die(mysql_error());
//$row = mysql_fetch_array($result);

//html code

echo "
<html>
<head>
<title>Employee information</title>
</head>
<body>";


//the column names
echo "<table border=1>
<tr>
<!--	<td>Modify Employee #</td>-->
	<td>Employee ID </td>
	<td>Name </td>
	<td>Seniority </td>
	<td>Commision </td>
	<td>Starting Date </td>
	<td>Ending Date </td>
	<td>Weekly Salary </td>
	<td>Monthly Salary </td>
	<td>Annual Salary </td>
</tr>";

//the tuples
while($row = mysql_fetch_array($result)) {

$weekly = $row['weeklysalary'];
$monthly = 4 * $weekly;
$annual = 52 * $monthly;
$eid = $row['eid'];
$name =  $row['name'] ;
$seniority =$row['seniority'] ;
$commission=$row['commission'];
$startdate=$row['startdate'] ;
$enddate= $row['enddate']  ;


echo "
<tr>
	<!--<td><form name=\"modify\" action=\"modEmployee.php\" method=\"get\"> 
	<input type=\"hidden\" name=\"update\" value=1>
	<input type=\"submit\" name=eid value=$eid>
	</form>	
	<a href='modEmployee.php?$eid'>Modify Employee's info.</a>
	</td>-->
	<td>  " . $row['eid']  ."
	 </td>
	<td><b>" . $row['name'] . "</b><br/> 
<i>
	<a href='modEmployee.php?eid=$eid&update=1'>Modify Employee's info.</a>
	<br/>
	<a href='showEmployeeRepairs.php?eid=$eid'>Show Employee's Repairs.</a>
</i>
	 </td> 
	
	<td>" . $row['seniority'] ." </td>
	<td>" . $row['commission']  ."% </td>
	<td>" . $row['startdate']  ." </td>
	<td>" . $row['enddate']  ." </td>
	<td>$" . $row['weeklysalary']  ." </td>
	<td>$" . $monthly ." </td>
	<td>$" . $annual  ." </td>
	</tr>";
	

}
	
//finish the columns

echo "</table>";

//end html

echo "</body></html>";
	
}

?>
