<?
ob_start();
session_start();
/* the employee table and its types
7 rows in set (0.00 sec)
*/

require("database.php"); //contains the method to access the db

//if (  $_SESSION['manager']  ==0 ){ //checks if you are logged in
if ( !isset($_SESSION['eid'])) {
echo "Error, you are not allowed to see this page. Log in as Manager";

}
else {//if ( $_SESSION['manager'] == 1  ) { //checks if you are the manager

//$query = "select eid, name, seniority, commission, startdate,enddate,weeklysalary,password from employee";// order by eid DESC";

//html code

echo "
<html>
<head>
<title>All Transactions Details</title>
</head>
<body>";


//the column names
echo "<table border=1>
<tr>
	<td>Order Number</td>
	<td>Date Purchased</td>
	<td>Quantity </td>
	<td>Product ID</td>
	<td>Product Name </td>
	<td>Price </td>
	<td>Total Price</td>
	<td>Solde Employee Number </td>
	<td>Employee Name </td>
	<td>Place of purchase </td>
	<td>Customer info</td>
	<td>Notes</td>
</tr>";


//$query =  "select orderNumber,quantity,pid,eid,place,notes from orderDetails natural join soldBy natural join transaction";

$query =  "select orderNumber,quantity,inventory.pid,employee.eid,place,notes,
		inventory.name as prodName, employee.name as empName, price,date			
	from 
		orderDetails natural join 
		soldBy natural join 
		transaction as joined,
		employee, 
		inventory
		where soldBy.eid= employee.eid and orderDetails.pid=inventory.pid
		order by orderNumber
	";


echo "The query used is <br/><i>$query </i> <br/>";
$result = mysql_query($query);




//the tuples
while($row = mysql_fetch_array($result)) {

$orderNumber = $row['orderNumber'];
$eid = $row['eid'];
$pid = $row['pid'];
$quantity =  number_format($row['quantity'],2) ;
$place =$row['place'] ;
$notes =$row['notes'];
$empName =$row['empName'] ;
$prodName = $row['prodName']  ;
$price = number_format($row['price'],2);
$total = number_format($price*$quantity,2);
$datep = $row['date'];

if ($place == 'online') {
$query = "select * from customer natural join orderedBy
	where orderNumber =$orderNumber
";
echo "$query";

$address = mysql_query($query);
$address = mysql_fetch_array($address);

$address = $address['firstName'] .' '. $address['lastName']
	 .' '. $address['phone'] 
	 .' '. $address['email']
	 .' '. $address['civic'] 
         .' '. $address['street'] 
           .' '. $address['city'] 
           .' '. $address['province'] 
         .' '. $address['country'] 
         .' '. $address['postal']
	 ;
}

else 
	$address ='';


echo "
<tr>
	<td>$orderNumber </td>
	<td>$datep </td>
	<td>$quantity </td>
	<td>$pid </td>
	<td>$prodName </td>
	<td>$$price </td>
	<td>$$total</td>
	<td>$eid </td>
	<td>$empName </td>
	<td>$place </td>
	<td>$address </td>
	<td>$notes </td>
</tr>";
	

}
	
//finish the columns

echo "</table>";

//end html

echo "</body></html>";
	
}

?>
