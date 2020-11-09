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

//testin klassi
//require("classes/Generic_class.php");
//loome uue instantsi
//$myfirstinstance = new Generic();
//echo "salajane number on  " .$myfirstinstance->secretnumber;	
//echo "avalik number on  " .$myfirstinstance->availablenumber;	
//$myfirstinstance->showValues();
//unset($myfirstinstance);


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
	<li><a href="addandmed.php">Filmi andmete lisamine</a></li>
	<li><a href="addfilmrelations.php">Seoste lisamine2</a></li>
	<li><a href="movieinfo.php">Filmide info</a></li>
	<li><a href="photoupload.php">Fotode üleslaadimine</a></li>
  </ul>
  
</body>
</html>