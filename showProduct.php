<?
ob_start();
session_start();
/* the employee table and its types


*/

require("database.php"); //contains the method to access the db

if (  !isset($_SESSION['eid']) ){ //checks if you are logged in

echo "Error, you are not allowed to see this page. Log in as Manager";

}
else {//if ( $_SESSION['manager'] == 1  ) { //checks if you are the manager

$query = "select * from inventory order by pid asc";
$result = mysql_query($query);
//$row = mysql_fetch_array($result);

//html code

echo "
<html>
<head>
<title>Inventory informtion</title>
</head>
<body>";


//the column names
echo "<table border=1>
<tr>
	<td>PID#</td>
	<td>Name </td>
	<td>Price </td>
	<td>Description </td>
	<td>Purchase Date </td>
</tr>";

//the tuples
while($row = mysql_fetch_array($result)) {

$pid = $row['pid'];
$name = $row['name'];
$price = number_format($row['price'],2);
$description = $row['description'];
$purchasedate = $row['purchasedDate'];

echo "
<tr>
	<td> $pid </td>
	<td> $name </td>
	<td>$ $price </td>
	<td> $description </td>
	<td> $purchasedate </td>
</tr>";
	

}
	
//finish the columns

echo "</table>";

//end html

echo "</body></html>";
	
}

?>
