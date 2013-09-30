<?php
ob_start();
session_start();

if ($_SESSION['logged'] == 1)
	$loggedin = true;
else 
	$loggined = false;

if (isset($_GET['www']))
	$www = $_GET['www'];
else
	$www = "showEmployees.php";
	
$eid = $_SESSION['eid'];
$manager = $_SESSION['manager'];
$ename = $_SESSION['ename'];


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>COMP353 COMPUTER STORE</title>
<link href="styles.css" rel="stylesheet" type="text/css" />
<link rel="icon" href="images/icon.ico" /> 
<script type="text/javascript" src="iepngfix_tilebg.js"></script> 
<script type="text/javascript" src="iepngfix.js"></script> 
</head>

<body>
<div id="mainWrap">
<div id="mainPanel">
 <div id="menu">
  <ul>
   <li><a href="index.php"><span>Home</span></a></li>
   <li><div class="blank"></div></li>
   <li><a href="index.php?www=showEmployees.php"><span>Show Employees</span></a></li>
   <li><div class="blank"></div></li>
   <li><a href="index.php?www=createEmployee.php"><span>Create Employees</span></a></li>
   <li><div class="blank"></div></li>
   <li><a href="index.php?www=showProduct.php"><span>Show Products</span></a></li>
   <li><div class="blank"></div></li>
   <li><a href="index.php?www=createProduct.php"><span>Create Products</span></a></li>
   <li><div class="blank"></div></li>
   <li><a href="index.php?www=showTransactions.php"><span>Show Transactions</span></a></li>
    <li><div class="blank"></div></li>
   <li><a href="index.php?www=createTransaction.php"><span>Create Transactions</span></a></li>
    <li><div class="blank"></div></li>
   <li><a href="index.php?www=showRepairs.php"><span>Show Repairs for 2009</span></a></li>
    <li><div class="blank"></div></li>
   <li><a href="index.php?www=showRepairs.php?default=1"><span>Show All Repairs</span></a></li>
    <li><div class="blank"></div></li>
   <li><a href="index.php?www=createRepairs.php"><span>Create Repairs</span></a></li>
    <li><div class="blank"></div></li>
   <li><a href="index.php?www=showRevenueSources.php"><span>Show Revenue Sources</span></a></li>
    <li><div class="blank"></div></li>
   <li><a href="index.php?www=showFreq.php"><span>Show Part Usage Frequency</span></a></li>
    <li><div class="blank"></div></li>
   <li><a href="index.php?www=findProduct.php"><span>Find a Product</span></a></li>
 



   
   <li><div class="blank"></div></li>
   <li><a href="logout.php"><span>Log Out</span></a></li>
  </ul>
 </div>
  <div id="logoWrap" ><h1>COMP 353</h1></div> 
 
 <?php /*
ob_start();
session_start();

if ($_SESSION['loggedin'] == 1)
	$loggedin = true;
else 
	$loggined = false;

if (isset($_GET['www']))
	$www = $_GET['www'];
else
	$www = "showEmployees.php";
	
$eid = $_SESSION['eid'];
$manager = $_SESSION['manager'];
$ename = $_SESSION['ename'];

*/


 
 if ( $loggedin == false) {
	 echo "
  <div id=\"loginPanel\">
  <h2>Employee Login</h2>
  <form action='logintest.php' method='get' name=login>
  <input name=\"eid\" type=\"text\" value=\"EID\" />
   <div class=\"blank\"></div>
  <input name=\"password\" type=\"password\" value='0' />
  <!--<p>Not yet a Member? <a href=\"#\">Register Now</a></p>-->
  <!--<a href=\"#\" class=\"login\">Login</a>
   onfocus=\"if(this.value=='Password')this.value=''\" onblur=\"if(this.value=='')this.value='Password'\"
  onfocus=\"if(this.value=='User Name')this.value=''\" onblur=\"if(this.value=='')this.value='Employee EID'\"
  -->
  <input type='submit' value='Login'>
  </form>
 
 </div>";
 }
else {
	echo "<div id=\"loginPanel\"> ";
	echo "<div class=\"blank\"><span><p>Welcome back $ename!</p></span> </div><br/>";
	echo " <form action='logout.php'><input type='submit' value='Log Out'</form>";
	echo "</div>";
       
	}

 ?>
 
 
 <div id="quots"><p>"Welcome to the COMP353 internal website. "</p></div>
 <div id="leftPanel">

<?php
/*$file = fopen($www, "r") or exit("Unable to open file!");
//Output a line of the file until the end is reached
while(!feof($file))
  {
  echo fgets($file);
  };
fclose($file);*/
 echo "<iframe src=\"http://www.travvik.com/databaseproject/$www\" 
			scrolling=\"auto\" name=\"database\" width=\"1020\" height=\"1000\"
			frameborder=0>
		</iframe>  ";

  ?>
  
 </div>
 <!--
 <div id="rightPanel">
  <h2>Photo Stock</h2>
  <div class="pic1"></div>
  <a href="#" class="view">view large</a>
   <div class="pic2"></div>
  <a href="#" class="view">view large</a>
   <div class="pic3"></div>
  <a href="#" class="view">view large</a>
  <div class="contacts">
   <h2>Quick Contact</h2>
   <p>Name</p><input name="name" type="text" value="- enter your name -" onfocus="if(this.value=='- enter your name -')this.value=''" onblur="if(this.value=='')this.value='- enter your name -'"/>
   <p>Email</p><input name="name" type="text" value="- enter your email -" onfocus="if(this.value=='- enter your email -')this.value=''" onblur="if(this.value=='')this.value='- enter your email -'"/>
   <div class="blank2"></div><a href="#">Need a Quote?</a><div class="blank"></div><a href="#">Submit</a>
  </div>
 
  <div class="project">
   <h2>Projects Link</h2>
   <ul>
    <li><a href="#">Lorem ipsum dolor sit amet eros consequat </a></li>
    <li><a href="#">Consectetuer adipiscing elit</a></li>
    <li><a href="#">Etiam quis est ut diam viverra rhoncus</a></li>
    <li><a href="#">Fusce eros consequat </a></li>
    <li><a href="#">Cras eros massa blandit </a></li>
    <li><a href="#" class="bottom">Aoreet utdiam viverra</a></li>
   </ul>
  </div>
 </div>
 -->
 
 <div id="footPanel">
  <div class="nav">
   <ul>
    <li><a href="index.php">Home</a></li>
    <li><div class="blank">|</div></li>
    <li><a href="logout.php">Log Out</a></li>
<!--    <li><div class="blank">|</div></li>
    <li><a href="#">Suppor</a></li>
    <li><div class="blank">|</div></li>
    <li><a href="#">Forum</a></li>
    <li><div class="blank">|</div></li>
    <li><a href="#">Development</a></li>
    <li><div class="blank">|</div></li>
    <li><a href="#">Conact Us</a></li>-->
   </ul>
  </div>
  <div class="copyright">© Copyrigh 2009 Jaime Yu. All Rights Reserved.</div>
  <p class="designInfo">Design by <a href="http://www.templateworld.com/">TemplateWorld</a> and brought to you by <a href="http://www.smashingmagazine.com/">SmashingMagazine</a></p>
  <div class="validation">
    <ul>
     <li><a href="http://validator.w3.org/check?uri=referer">xhtml</a></li>
     <li><div class="blank"></div></li>
     <li><a href="http://jigsaw.w3.org/css-validator/check/referer">css</a></li>
    </ul>  
  </div>
 </div>
</div>
</div>
</body>
</html>
