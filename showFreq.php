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
<title>Show Part Usage Frequency</title>
</head>
<body>";

echo "The following compares online sales to in-store sales. <br/>";

//the column names
echo "<table border=1>
<tr>
	<td>PID</td>
	<td>Product Name </td>
	<td>Frequency Usage</td>
</tr>";

//the tuples

/*$query = "select sum(orderDetails.price) as Online,
	sum(t.pid) as Store from 
		(select price from transaction,
			orderDetails 
			where transaction.orderNumber=orderDetails.orderNumber and 
			transaction.place='store'  )as t, 
		transaction,orderDetails 
		where transaction.orderNumber=orderDetails.orderNumber 
		and transaction.place='online'";
*/


/*$query = "select inventory.pid,inventory.name, count(pid) as Frequency,
		from orderDetails, transaction, inventory
			where transaction.orderNumber = orderDetails.orderNumber 
			and orderDetails.pid = inventory.pid
			";
*/

/*$query = "select sum(t.quantity*t.price) as Online, sum(z.quantity*z.price) as Store
		 from transaction natural join inventory natural join orderDetails as z, 
		(select quantity,price 
		from  transaction natural join inventory natural join orderDetails )
		";*/

//$query = "select inventory.pid, count(transaction.orderNumber) from inventory, orderDetails, transaction where  transaction.orderNumber = orderDetails.orderNumber and inventory.pid = orderDetails.pid group by orderDetails.pid";

$query =" select inventory.pid,inventory.name, sum(orderDetails.quantity) as Frequency,
		inventory.price, inventory.price*sum(orderDetails.quantity) as totalsales
	from inventory, orderDetails, transaction 
	where  transaction.orderNumber = orderDetails.orderNumber and 
	inventory.pid = orderDetails.pid 
	group by orderDetails.pid
	order by Frequency DESC";

echo "Query used is : <br/><i>$query</i> <br/>";

$result = mysql_query($query);

while($row = mysql_fetch_array($result)) {

$pid = $row['pid'];
$name = $row['name'];
$freq = $row['Frequency'];

echo "
<tr>
	<td>$pid </td>
	<td>$name</td>
	<td>$freq </td>
	<td> </td>
</tr>";
	

}
	
//finish the columns

echo "</table>";

//end html

echo "</body></html>";
	
}

?>
