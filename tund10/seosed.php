<?php
//session_start();
  
  //SESSIOON
  require("classes/Session.class.php");
  //sessioon, mis katkeb, kui brauser suletakse ja on k�ttesaadav ainult meie domeenis, meie lehele
  SessionManager::sessionStart("vp", 0, "/~kirkpau/", "greeny.cs.tlu.ee");
  
  //kui pole sisseloginud
  if(!isset($_SESSION["userid"])){
	  //j�ugu sisselogimise lehele
	  header("Location: page.php");
  }
  //v�ljalogimine
  if(isset($_GET["logout"])){
	  session_destroy();
	   header("Location: page.php");
	   exit();
  }
require("header.php");
require("../../../config.php");
$database="if20_kirkelp_3";

$movieli= null;
$genreli=null;
$notice= null;

	$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	//valmistame ette sql käsu
	$stmt = $conn->prepare("SELECT movie_id, title FROM movie");
	echo $conn->error;
	$stmt->bind_result($movieidfromdb,$movietitlefromdb);
	if($stmt->execute()) {
		while($stmt->fetch()) {
		$movieli.= "\n \t \t" .'<option value="' .$movieidfromdb .'">' .$movietitlefromdb .'</option>';
		}
	} else {
		$notice = $stmt->error();
	}
	$stmt->close();

	
	$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	//valmistame ette sql käsu
	$stmt = $conn->prepare("SELECT genre_id, genre_name FROM genre");
	echo $conn->error;
	$stmt->bind_result($genreidfromdb,$genrefromdb);
	if($stmt->execute()) {
		while($stmt->fetch()) {
		$genreli.= "\n \t \t" .'<option value="' .$genreidfromdb .'">' .$genrefromdb .'</option>';
		}
	} else {
		$notice = $stmt->error();
	}
	$stmt->close();


	if(isset($_POST["moviegenresubmit"])) {
		if(isset($_POST["movieinput"]) and isset($_POST["genreinput"])) {
			$stmt = $conn->prepare("INSERT INTO movie_genre (movie_genre_id, movie_id, genre_id) VALUES (NULL, ?, ?)");
			echo $conn->error;
		$stmt->bind_param("ii", $_POST["movieinput"],  $_POST["genreinput"]);
			if($stmt->execute()) {
				$notice = "Salvestatud!";
			} else {
				$notice = $stmt->error();
			}
			$stmt->close();
		} else {
			$notice = "1 valikutest on puudu!";
		}
	}

	
?>
<html>
 
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
	<li><a href="seosed.php">Seoste lisamine</a></li>
  </ul>
  
  
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label for="movieinput">Film: </label>
	<br>
	<select name="movieinput" id="movieinput">
		<option value="" selected disabled>Vali film</option>
		<?php echo $movieli; ?>
	</select>
	<br>
	<label for="genreinput">Žanr: </label>
	<br>
	<select name="genreinput" id="genreinput">
		<option value="" selected disabled>Vali žanr</option>
		<?php echo $genreli; ?>
	</select>
	<br>
	<input type="submit" name="moviegenresubmit" value="Sisesta seos">
	<?php echo $notice; ?>
  </form>
  
</body>
</html>
	
