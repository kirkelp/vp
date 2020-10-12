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
	

  require("header.php");
?>

  <img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse bänner">
  <h1><?php echo $_SESSION["userfirstname"] . " " .$_SESSION["userlastname"];?> programmeerib veebi</h1>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>Leht on loodud veebiprogrammeerimise kursusel <a href="http://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</p>
  <p> <a href ="?logout=1">Logi välja</a></p>
  <ul>
    <li><a href="idee.php">Mõtete näitamine</a></li>
	<li><a href="sisesta.php">Mõtete lisamine</a></li>
	<li><a href="listfilms.php">Filmiinfo näitamine</a></li>
	<li><a href="addfilms.php">Filmiinfo lisamine</a></li>
	<li><a href="userprofile.php">Oma profiili haldamine</a></li>
	<li><a href="listfilmpersons.php">Filmitegelased</a></li>
	<li><a href="seosed.php">Seoste lisamine</a></li>
	<li><a href="addfilmrelations.php">Seoste lisamine2</a></li>
  </ul>
  
</body>
</html>