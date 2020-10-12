<?php
session_start();
//kui pole sisselogitud
if(!isset($_SESSION["userid"])){
	//jõuga
	header("Location: page.php");
}
//väljalogimine
if(isset($_GET["logout"])){
	session_destroy();
	header("Location: page.php");
	exit();
}
	
//loeme andmebaasi login info muutujad
	require("../../../config.php");
	require("fnc_film.php");	
//header
require("header.php");
?>
  <h1><?php echo $_SESSION["userfirstname"] . " " .$_SESSION["userlastname"];?> programmeerib veebi</h1>
<h1>Filmide kohta info</h1>
<hr>
<?php echo readfilms(); ?>
<p> <a href ="?logout=1">Logi välja</a></p>
  <a href="home.php">Avaleht</a>
  <a href="sisesta.php">Mõtte lisamine</a>
</body>
</html>