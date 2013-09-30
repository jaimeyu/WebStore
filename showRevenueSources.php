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
<title>Show Revenue Sources</title>
</head>
<body>";

echo "The following compares online sales to in-store sales. <br/>";

//the column names
echo "<table border=1>
<tr>
	<td>Online Sales Revenue</td>
	<td>Number of Online Sales</td>
	<td>In Store Revenue</td>
	<td>Number of In Store Sales and Repairs</td>
	<!--<td>Functions </td>-->
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

$query = "select sum(orderDetails.quantity*inventory.price) as online, count(place) as osales
		from inventory natural join orderDetails natural join transaction
		 where place='online'
         ";

echo "The first Query used: <br/> <i>\"$query \"</i> <br/>";
$result = mysql_query($query);


$query = "select sum(orderDetails.quantity*inventory.price)+rep.rp as store, count(place)+rep.rn as isales	
		from inventory natural join orderDetails natural join transaction,
		     (select count(repairNumber) as rn ,sum(price) as rp from repairs) as rep
		 where place='store'
         ";

echo "The second Query used: <br/> <i>\"$query \"</i> <br/>";

echo "Two queries were used because both queries are too long and complex to combin into one (for mere mortals).<br/>";


$result2 = mysql_query($query);
$row2 = mysql_fetch_array($result2);



while($row = mysql_fetch_array($result)) {

$online = number_format($row['online'],2);
$store = number_format($row2['store'],2);
$osales = $row['osales'];
$isales =$row2['isales'];

echo "
<tr>
	<td>$$online </td>
	<td>$osales</td>
	<td>$$store </td>
	<td>$isales</td>
	<td> </td>
</tr>";
	

}
	
//finish the columns

echo "</table>";

//end html

echo "</body></html>";
	
}

?>
