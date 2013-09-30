<?php
ob_start();
session_start();

//if(!session_is_registered(myusername)){
if ( !isset($_SESSION['eid'])  ){
	//header("location:login.php");
	echo "fail";
	
}

	echo "user EID: " . $_SESSION['eid'] . "<br/>";
	echo "is Manager? (0=false/1=true):" . $_SESSION['manager'] ."<br/>";

ob_end_flush();
?>

<html>
<body>
Login Successful
</body>
</html>
