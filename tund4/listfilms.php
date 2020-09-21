<?php
//loeme andmebaasi login info muutujad
	require("../../../config.php");
	// kui kasutaja on vormis andmeid saatnud, siis salvestame andmebaasi
	$database = "if20_kirkelp_3";
	//loeme andmebaasist
	$conn = new mysqli($serverhost, $serverusername, $serverpassword, $database);
	//valmistame ette sql käsu
	$stmt = $conn->prepare("SELECT * FROM film");
	echo $conn->error;
	//seome tulemuse mingi muutujaga
	$stmt->bind_result($titlefromdb, $yearfromdb, $durationfromdb, $genrefromdb, $studiofromdb, $directorfromdb);
	$stmt->execute();
	$filmshtml = "\t <ol> \n";
	//võtan kuni on
	while($stmt->fetch()){
		//<p>filmid</p>
		$filmshtml .= "\t \t <li>" . $titlefromdb ."\n";
		$filmshtml .= "\t \t \t <ul> \n";
		$filmshtml .= "\t \t \t \t <li>Valmimisaasta: ". 
		$yearfromdb ."</li> \n";
		$filmshtml .= "\t \t \t \t <li>Kestus: ". 
		$durationfromdb ." minutit</li> \n";
		$filmshtml .= "\t \t \t \t <li>Žanr: ". 
		$genrefromdb ."</li> \n";
		$filmshtml .= "\t \t \t \t <li>Stuudio: ". 
		$studiofromdb ."</li> \n";
		$filmshtml .= "\t \t \t \t <li>Lavastaja: ". 
		$directorfromdb ."</li> \n";
		$filmshtml .= "\t \t \t </ul> \n";
		$filmshtml .= "\t \t </li> \n";
	}
	$filmshtml .="\t </ol> \n";
	$stmt->close();
	$conn->close();
	//ongi andmebaasist loetud
	
//header
require("header.php");
?>
<h1>Filmide kohta info</h1>
<hr>
<?php echo $filmshtml; ?>
  <a href="home.php">Avaleht</a>
  <a href="sisesta.php">Mõtte lisamine</a>
</body>
</html>