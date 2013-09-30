<?
ob_start();
session_start();
/* 
algorithm
first check if date  is asked (employee/tech)
give back services for a certain date
if eid is asked
give back services for certain employee eid
note that this list must be sorted by date and be after a certain user defined date.

*/

require("database.php"); //contains the method to access the db

if (  !isset($_SESSION['eid']) ){ //checks if you are logged in

echo "Error, you are not allowed to see this page. Log in as Manager";

}
else {//if ( $_SESSION['manager'] == 1  ) { //checks if you are the manager


//html code

echo "
<html>
<head>
<title>Repairs</title>
</head>
<body>";


//the column names
echo "<table border=1>
<tr>
	<td>Repair Number</td>
	<td>Repair Date</td>
	<td>Repair Notes</td>
	<td>Repaired by Employee # </td>
	<td>Employee's Name</td>
	<td>Repair Cost</td>
	<td>PC Serial # </td>
	</tr>";

//mysql:
if ( ! isset($_GET['eid']) && !isset($_GET['date']) && !isset($_GET['default']) ){
	$query = "select repairs.repairNumber,
		repairs.repairdate,
		repairs.notes,
		repairedBy.eid,
		repairs.price,
		employee.name,
		repairs.serial
		from repairs,repairedBy, employee
		where repairs.repairNumber=repairedBy.repairNumber and employee.eid=repairedBy.eid and repairs.repairdate >'2008-12-31'"; }
else if(isset($_GET['date'] ) ){
	$getdate=$_GET['date'];
	$query = "select repairs.repairNumber,
		repairs.repairdate,
		repairs.notes,
		repairedBy.eid,
		repairs.price ,
		employee.name,
		repairs.serial
		from repairs,repairedBy, employee
		where repairs.repairNumber=repairedBy.repairNumber and 
		repairs.repairdate='$getdate' and 
		repairedBy.eid=employee.eid
		order by repairs.repairdate ASC"; 

}

else if(isset($_GET['default'])) {

$query = "select repairs.repairNumber,
                repairs.repairdate,
                repairs.notes,
                repairedBy.eid,
                repairs.price,
                employee.name,
		repairs.serial
                from repairs,repairedBy, employee
                where repairs.repairNumber=repairedBy.repairNumber and employee.eid=repairedBy.eid"; 

}


else {
	$geteid = $_GET['eid'];
	$query = "select repairs.repairNumber,
		repairs.repairdate,
		repairs.notes,
		repairedBy.eid,
		repairs.price,
		employee.name,
		repairs.serial
		from repairs,repairedBy, employee
		where repairs.repairNumber=repairedBy.repairNumber and 
		repairedBy.eid=$geteid and employee.eid=repairedBy.eid
		order by repairdate ASC"; }
echo "The query used is <br/><i>$query</i><br/>";
$result = mysql_query($query);

//the tuples
if ($result != NULL){
while($row = mysql_fetch_array($result)) {

$number = $row['repairNumber'];
$eid = $row['eid'];
$price =  $row['price'] ;
$notes =$row['notes'] ;
$date = $row['repairdate'];
$name = $row['name'];
$serial = $row['serial'];
echo "
<tr>
	<td>$number </td>
	<td><form name=\"modify\" action=\"showRepairs.php\" method=\"get\"> 
	<input type=\"submit\" name=date value=$date>
	</form> </td>
	<td>$notes </td>
	<td><form name=\"modify\" action=\"showEmployeeRepairs.php\" method=\"get\"> 
	<input type=\"submit\" name=eid value=$eid>
	</form></td>
	<td>$name </td>
	<td>$$price </td>
	<td><a href='showHistory.php?pcid=$serial'>$serial</a> </td>
	</tr>";
	

}
/*
	<td> <form name=\"modify\" action=\"modEmployee.php\" method=\"get\"> 
	<input type=\"hidden\" name=\"update\" value=1>
	<input type=\"submit\" name=eid value=$eid>
	</form></td>
*/
//finish the columns

echo "</table>";
}
//end html

echo "</body></html>";
	
}

?>
