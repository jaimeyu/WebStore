<?php
ob_start();
session_start();

require("database.php"); //db connector

if ($_SESSION['manager'] ==1){

//check for manager bit

/*
+---------------+---------------+------+-----+---------+----------------+
| Field         | Type          | Null | Key | Default | Extra          |
+---------------+---------------+------+-----+---------+----------------+
| pid           | int(100)      | NO   | PRI | NULL    | auto_increment | 
| price         | decimal(10,0) | YES  |     | NULL    |                | 
| purchasedDate | date          | YES  |     | NULL    |                | 
| description   | longtext      | YES  |     | NULL    |                | 
+---------------+---------------+------+-----+---------+----------------+
4 rows in set (0.00 sec)
*/

//begin html form
$today =date('y-m-d');
echo "<html>
<head>
<title>
Create Product
</title>
</head>
<body>

<form name=\"createProduct\" action=\"createProduct.php\" method=\"get\">
Product's Name: <input type=\"text\" name=\"name\"> <br/>
Product's Price:  <input type=\"text\" name=\"price\"> <br/>
Product's Purchase date (yy-mm-dd):  <input type=\"text\" name=\"purchasedate\" value='$today'> <br/>
Product's Description:  <input type=\"text\" name=\"description\"> <br/>
<input type=\"submit\" >
</form>"; 

//if someone submitted everything filled in

if ( isset($_GET['name']) && 
isset($_GET['price']) && 
isset($_GET['purchasedate']) && 
isset($_GET['description']) )
{
$name = $_GET['name'];
$price = $_GET['price'];
$purchasedate = $_GET['purchasedate'];
$description = $_GET['description'];



	if ( !is_numeric($_GET['price']) ) {
		
		echo "Data was not entered correctly.<br/>";
		}

	else {
		$query = "insert into inventory
			(name, price, purchaseddate,description) 
		values( '$name', $price, '$purchasedate', '$description')";

	/*$query = "insert into employee(name, seniority,commission,startdate,enddate,weeklysalary,password) values ('" 
	. $_GET['name'] . "','" 
	. $_GET['seniority'] . "'," 
	. $_GET['commission'] . ",'" 
	. $_GET['startdate'] . "','" 
	. $_GET['enddate'] . "',"
	. $_GET['weekly'] . ",'"
	. $_GET['password'] . "' )";
*/
	echo "Product is being added to database. <br/>";
	echo "Query used is <br/><i>$query</i><br/>";
	
	//insert user
	$result = mysql_query($query);	

	if( !$result)
		echo "User not added";
	
	else
		require("showProduct.php");
	

	}
}



echo "</body></html>";
}
else
	echo "Please log in as a manager.";

ob_end_flush();
?>
