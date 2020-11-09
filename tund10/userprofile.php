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
	
//loeme andmebaasi login info muutujad
	require("../../../config.php");
	require("fnc_user.php");
	//kui klikiti nuppu, siis kontrollime ja salvestame
	$inputerror ="";
	$notice="";
	$description="";
	//$_SESSION["txtcolor"] = "#000000";
	//$_SESSION["bgcolor"] = "#FFFFFF";
	
	
	if(isset($_POST["profilesubmit"])){
		$notice= storeuserprofile($_POST["descriptioninput"], $_POST["bgcolorinput"], $_POST["txtcolorinput"]);
		$description=$_POST["descriptioninput"];
		$_SESSION["txtcolor"] = $_POST["txtcolorinput"];
	$_SESSION["bgcolor"] = $_POST["bgcolorinput"];
	}
//header
require("header.php");
?>
<h1><?php echo $_SESSION["userfirstname"] . " " .$_SESSION["userlastname"];?> kasutajaprofiil</h1>
<ul>
	<li><a href ="?logout=1">Logi v√§lja</a></li>
	<li> <a href="home.php">Avaleht</a></li>
</ul>
  
  <hr>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <label for="descriptioninput">Minu l√ºhitutvustus: </label>
  <textarea rows="10" cols="80" name="descriptioninput" id="descriptioninput" placeholder="Minu tutvustus ..."><?php echo $description; ?></textarea>
  <br>
  <label for="bgcolorinput">Minu valitud taustav√§rv: </label>
  <input type="color" name="bgcolorinput" id="bgcolorinput" value="<?php echo $_SESSION["bgcolor"]; ?>">
  <br>
  <label for="txtcolorinput">Minu valitud tekstiv√§rv: </label>
  <input type="color" name="txtcolorinput" id="txtcolorinput" value="<?php echo $_SESSION["txtcolor"]; ?>">
  <br>
  <input type="submit" name="profilesubmit" value="Salvesta profiil">
  </form>
  <p> <?php echo $inputerror; ?> </p>
</body>
</html>