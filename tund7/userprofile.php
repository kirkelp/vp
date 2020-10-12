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
	<li><a href ="?logout=1">Logi välja</a></li>
	<li> <a href="home.php">Avaleht</a></li>
</ul>
  
  <hr>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <label for="descriptioninput">Minu lühitutvustus: </label>
  <textarea rows="10" cols="80" name="descriptioninput" id="descriptioninput" placeholder="Minu tutvustus ..."><?php echo $description; ?></textarea>
  <br>
  <label for="bgcolorinput">Minu valitud taustavärv: </label>
  <input type="color" name="bgcolorinput" id="bgcolorinput" value="<?php echo $_SESSION["bgcolor"]; ?>">
  <br>
  <label for="txtcolorinput">Minu valitud tekstivärv: </label>
  <input type="color" name="txtcolorinput" id="txtcolorinput" value="<?php echo $_SESSION["txtcolor"]; ?>">
  <br>
  <input type="submit" name="profilesubmit" value="Salvesta profiil">
  </form>
  <p> <?php echo $inputerror; ?> </p>
</body>
</html>