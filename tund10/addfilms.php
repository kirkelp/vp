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
	require("fnc_film.php");
	//kui klikiti nuppu, siis kontrollime ja salvestame
	$inputerror ="";
	if(isset($_POST["filmsubmit"])){
		//$title=$_POST[$titleinput];
		if(empty($_POST["titleinput"]) or empty($_POST["genreinput"]) or empty($_POST["studioinput"])or empty($_POST["directorinput"])){
			$inputerror .="Osa vajalikku infot on sisestamata!";
		}
		if($_POST["yearinput"] > date("Y") or $_POST["yearinput"] < 1895){
			$inputerror .="Ebareaalne valmimisaasta";
		}
	if(empty($inputerror)){
		writefilm($_POST["titleinput"], $_POST["yearinput"], $_POST["durationinput"], $_POST["genreinput"], $_POST["studioinput"], $_POST["directorinput"]);
	}
	}
//header
require("header.php");
?>
<h1><?php echo $_SESSION["userfirstname"] . " " .$_SESSION["userlastname"];?> programmeerib veebi</h1>
<h1>Filmide kohta info</h1>
<hr>
<p> <a href ="?logout=1">Logi v√§lja</a></p>
  <a href="home.php">Avaleht</a>
  <a href="listfilms.php">Filmide info</a>
  <hr>
  <form method="POST">
  <label for="titleinput">Filmi pealkiri: </label>
  <input type="text" name="titleinput" id="titleinput" placeholder="pealkiri">
  <br>
  <label for="yearinput">Filmi valmimisaasta: </label>
  <input type="number" name="yearinput" id="yearinput" value="<?php echo date("Y"); ?>">
  <br>
  <label for="durationinput">Filmi kestus minutites: </label>
  <input type="number" name="durationinput" id="durationinput" value="80">
  <br>
  <label for="genreinput">Filmi ≈æanr: </label>
  <input type="text" name="genreinput" id="genreinput" placeholder="≈æanr">
  <br>
  <label for="studioinput">Filmi tootja/stuudio: </label>
  <input type="text" name="studioinput" id="studioinput" placeholder="stuudio">
  <br>
  <label for="directorinput">Filmi lavastaja: </label>
  <input type="text" name="directorinput" id="directorinput" placeholder="lavastaja">
  <br>
  <input type="submit" name="filmsubmit" value="Salvesta info">
  </form>
  <p> <?php echo $inputerror; ?> </p>
</body>
</html>