<?php
  session_start();
  
  //kui pole sisseloginud
  if(!isset($_SESSION["userid"])){
	  //jõugu sisselogimise lehele
	  header("Location: page.php");
  }
  //väljalogimine
  if(isset($_GET["logout"])){
	  session_destroy();
	   header("Location: page.php");
	   exit();
  }
  //loeme andmebaasi login ifo muutujad
  require("../../../config.php");
  
  require("fnc_filmoutput.php");
  $sortby =0;
  $sortorder=0;

  require("header.php");
?>

  <h1><?php echo $_SESSION["userfirstname"] . " " .$_SESSION["userlastname"];?> programmeerib veebi</h1>
<h1>Filmide kohta info</h1>
<hr>
<?php 
if(isset($_GET["sortby"]) and isset($_GET["sortorder"])){
	if($_GET["sortby"] >= 1 and $_GET["sortby"] <= 4){
		$sortby =$_GET["sortby"];
		}
	if($_GET["sortorder"] == 1 or $_GET["sortorder"] == 2){
		$sortorder = $_GET["sortorder"];
		}
}
echo readpersonsinfilm($sortby, $sortorder); 
?>

  <a href ="?logout=1">Logi välja</a>
  <a href="home.php">Avaleht</a>
  <a href="sisesta.php">Mõtte lisamine</a>
</body>
</html>

