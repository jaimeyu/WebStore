<?php
ob_start();
session_start();

require("database.php"); //db connector

if ($_SESSION['manager']==1) {

$today = date('y-m-d');

//begin html form

echo "<html>
<head>
<title>
Create Transaction
</title>
</head>
<body>

<form name=\"createmployee\" action=\"createTransaction.php\" method=\"get\">
Employee #:  <input type=\"text\" name=\"eid\"> <br/>
Product's PID #: <input type=\"text\" name=\"pid\"> <br/>
Date of Purchase:  <input type=\"text\" name=\"date\" value=$today> <br/>
Quantity Purchased:  <input type=\"text\" name=\"quantity\"> <br/>
Place (online/store): 
	<select name='place'>
		<option  value =\"store\">In store sale</option>
		<option  value=\"online\">Online sale</option>
	</select>
 	<br/>	
<!--	<input type=\"text\" name=\"place\" value=\"store\"> <br/> -->
Notes:  <input type=\"text\" name=\"notes\" value='none'> <br/>

<br/>
<i>Optional. Online Sales must have this.</i>
<br/>
Customer First Name <input type='text' name='custfname' value='Leia'><br/>
Customer Last Name <input type='text' name='custlname' value='Organa'><br/>
Customer phone <input type='text' name='custphone' value='514-123-4567'><br/>
Customer email <input type='text' name='custemail' value='admin@concordia.ca'><br/>
Customer civic <input type='text' name='custcivic' value='1'><br/>
Customer street <input type='text' name='custstreet' value='de la Maisonevue'><br/>
Customer city <input type='text' name='custcity' value='Montreal'><br/>
Customer province<input type='text' name='custprov' value='Quebec'><br/>
Customer country <input type='text' name='custcountry' value ='Canada'><br/>
Customer postal code <input type='text' name='custpostal' value='h0h0h0'><br/>

<input type=\"submit\" >
</form>"; 

//if someone submitted everything filled in

if ( isset($_GET['eid']) && 
isset($_GET['pid']) && 
isset($_GET['date']) && 
isset($_GET['quantity']) && 
isset($_GET['place']) && 
isset($_GET['notes']) 
)
{


$eid = $_GET['eid'];
$pid = $_GET['pid'];    
$date = $_GET['date'];     
$quantity = $_GET['quantity']; 
$place = $_GET['place'];  
$notes = $_GET['notes']; 

$cname = $_GET['custfname'];
$lname = $_GET['custlname'];
$cphone = $_GET['custphone'];
$cemail = $_GET['custemail'];
$ccivic = $_GET['custcivic'];
$cstreet = $_GET['custstreet'];
$ccity = $_GET['custcity'];
$cprov = $_GET['custprov'];
$ccountry = $_GET['custcountry'];
$cpostal = $_GET['custpostal'];

	if ( !is_numeric($_GET['quantity']) || !is_numeric($_GET['pid']) || !is_numeric($_GET['eid'] )) {
		
		echo "Data was not entered correctly.<br/>";
		}

	else { /*
	$query = "insert into employee(name, seniority,commission,startdate,enddate,weeklysalary,password) values ('" 
	. $_GET['name'] . "','" 
	. $_GET['seniority'] . "'," 
	. $_GET['commission'] . ",'" 
	. $_GET['startdate'] . "','" 
	. $_GET['enddate'] . "',"
	. $_GET['weekly'] . ",'"
	. $_GET['password'] . "' )";
	*/

	$query ="insert into transaction(date,place,notes) values ('$date','$place','$notes')";
	mysql_query($query);
//	echo $query;

	echo $query . "<br/>";
	
	$query = "insert into soldBy values ($eid, (select max(orderNumber) from transaction))";
	mysql_query($query);
	//echo $query;
	
	echo $query . "<br/>";
	
	$query ="insert into orderDetails values ($quantity, $pid, (select max(orderNumber) from transaction))";
	mysql_query($query);
	//echo $query;
	echo "Query is <i><br/>" . $query . "</i><br/>";

if ($place='online') {
	
	$query = "insert into customer (firstName,lastName, phone,email,civic,street,city,province,country,postal)
	       values ('$cname','$lname','$cphone','$cemail','$ccivic',
			       '$cstreet','$ccity','$cprov','$ccountry','$cpostal'  )";
	mysql_query($query);
	        //echo $query;
	echo "Query is <i><br/>" . $query . "</i><br/>";
	
	$query ="insert into orderedBy values ((select max(orderNumber) from transaction), (select max(custNumber) from customer)  )";

	mysql_query($query);
	       // echo $query;
	echo "Query is <i><br/>" . $query . "</i><br/>";

	}

	
	echo "Transaction is being added to database. <br/>";
/*	
	//insert user
	$result = mysql_query($query);	

	if( !$result)
		echo "User not added";
	
	else*/
		require("showTransactions.php");
	

	}
}



echo "</body></html>";

}
else
	echo "Please log in as a manager.";
ob_end_flush();
?>
