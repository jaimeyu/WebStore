<?php
ob_start();
session_start();
// store session data
//$_SESSION['views']=2;

echo session_save_path() . " hello";

?>

<html>
<body>

<?php
//retrieve session data
echo "Pageviews=". $_SESSION['views'];
$_SESSION['views'] = $_SESSION['views'] + 1;

ob_end_flush();
?>

</body>
</html> 
