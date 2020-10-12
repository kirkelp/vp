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
	// kui kasutaja on vormis andmeid saatnud, siis salvestame andmebaasi
	$database = "if20_kirkelp_3";
//loeme andmebaasist
	$nonsensehtml="";
	$conn = new mysqli($serverhost, $serverusername, $serverpassword, $database);
			//valmistame ette sql käsu
	$stmt = $conn->prepare("SELECT nonsenseidea FROM nonsense");
	echo $conn->error;
	//seome tulemuse mingi muutujaga
	$stmt->bind_result($nonsensefromdb);
	$stmt->execute();
	//võtan kuni on
	while($stmt->fetch()){
		//<p>suvaline mõte </p>
		$nonsensehtml .= "<p>" . $nonsensefromdb ."</p>";
	}
	$stmt->close();
	$conn->close();
	//ongi andmebaasist loetud
//header
require("header.php");
?>
<img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse bänner">
  <h1><?php echo $_SESSION["userfirstname"] . " " .$_SESSION["userlastname"];?> programmeerib veebi</h1>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>Leht on loodud veebiprogrammeerimise kursusel <a href="http://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</p>
  <p> <a href ="?logout=1">Logi välja</a></p>

<?php echo $nonsensehtml; ?>
  <a href="home.php">Avaleht</a>
  <a href="sisesta.php">Mõtte lisamine</a>
</body>
</html>