<?php
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
<?php echo $nonsensehtml; ?>
  <a href="home.php">Avaleht</a>
  <a href="sisesta.php">Mõtte lisamine</a>
</body>
</html>