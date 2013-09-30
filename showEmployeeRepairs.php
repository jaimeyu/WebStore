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

echo "Error, you are not allowed to see this page.";

}
else {//if ( $_SESSION['manager'] == 1  ) { //checks if you are the manager


//html code

echo "
<html>
<head>
<title>Repairs done by Employees</title>
</head>
<body>";


//the column names
echo "	<table border=1>
<tr>
	<td>Repair Number</td>
	<td>Repair Date</td>
	<td>Repair Notes</td>
	<td>Repaired by Employee # </td>
	<td>Employee's Name</td>
	<td>Repair Cost</td>
	<td>Employee's Commission Rate</td>
	<td>Employee's Commission on Repair</td>
	</tr>
	";

//mysql:
if ( ! isset($_GET['eid']) ){
	$query = "select repairs.repairNumber,
		repairs.repairdate,
		repairs.notes,
		repairedBy.eid,
		employee.name,
		repairs.price 
		from repairs,repairedBy
		where repairs.repairNumber=repairedBy.repairNumber ";
	
	echo "Missing Specific Employee info <br/>";
		 }
else {
	$geteid = $_GET['eid'];
	$query = "select repairs.repairNumber,
		repairs.repairdate,
		repairs.notes,
		repairedBy.eid,
		repairs.price,
		employee.name,
		employee.commission,
		employee.commission * repairs.price / 100 as earned
		from repairs,repairedBy, employee
		where repairs.repairNumber=repairedBy.repairNumber and 
		repairedBy.eid=$geteid and
		employee.eid = $geteid
		order by repairdate ASC" ; }
echo "The query used is : <br/>
	<i>\"$query \" <br/></i>";
$result = mysql_query($query);

//the tuples
if ($result != NULL){
while($row = mysql_fetch_array($result)) {

$number = $row['repairNumber'];
$eid = $row['eid'];
$price =  $row['price'] ;
$notes =$row['notes'] ;
$date = $row['repairdate'];
$commission = $row['commission'];
$earned = number_format($row['earned'],2);
$name = $row['name'];

echo "
<tr>
	<td>$number </td>
	<td>$date </td>
	<td>$notes </td>
	<td>$eid </td>
	<td>$name </td>
	<td>$$price </td>
	<td>$commission% </td>
	<td>$$earned</td>
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
