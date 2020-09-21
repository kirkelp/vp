<?php
//loeme andmebaasi login info muutujad
	require("../../../config.php");
	require("fnc_film.php");
	//kui klikiti nuppu, siis kontrollime ja salvestame
	$inputerror ="";
	if(isset($_POST["filmsubmit"])){
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
<h1>Filmide kohta info</h1>
<hr>
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
  <label for="genreinput">Filmi žanr: </label>
  <input type="text" name="genreinput" id="genreinput" placeholder="žanr">
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