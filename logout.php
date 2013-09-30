<?php
ob_start();
session_start();
$_SESSION = array(); // this should wipe out the session with nulls
header("location:index.php"); //logs the user out.
ob_end_flush();
?>
