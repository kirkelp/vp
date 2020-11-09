<?php
  
//session_start();
  
  //SESSIOON
  require("classes/Session.class.php");
  //sessioon, mis katkeb, kui brauser suletakse ja on k‰ttesaadav ainult meie domeenis, meie lehele
  SessionManager::sessionStart("vp", 0, "/~kirkpau/", "greeny.cs.tlu.ee");
  
  //kui pole sisseloginud
  if(!isset($_SESSION["userid"])){
	  //jıugu sisselogimise lehele
	  header("Location: page.php");
  }
  //v‰ljalogimine
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

  <a href ="?logout=1">Logi v√§lja</a>
  <a href="home.php">Avaleht</a>
  <a href="sisesta.php">M√µtte lisamine</a>
</body>
</html>

