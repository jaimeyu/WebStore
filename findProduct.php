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

//$query = "select * from inventory order by pid asc";
//$result = mysql_query($query);
//$row = mysql_fetch_array($result);

//html code

echo "
<html>
<head>
<title>Find a product</title>
</head>
<body>";

//the form
echo "<form name = 'find' action='findProduct.php' type='get'>
	Type in the PID or Name of the product: 
	<input type='text' name=q> 
	<input type='submit'> <br/>";

if ( isset($_GET['q']))
{
$q = $_GET['q'];
$query = "select * from inventory where name='$q' or pid='$q'";
//echo "$query";

echo "Query is <i><br/>" . $query . "</i><br/>";

$result = mysql_query($query);

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
$price = $row['price'];
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
}
//end html

echo "</body></html>";
	
}

?>
