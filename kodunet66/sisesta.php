<?php
//loeme andmebaasi login info muutujad
	require("../../../config.php");
	// kui kasutaja on vormis andmeid saatnud, siis salvestame andmebaasi
	$database = "if20_kirkelp_3";
	if(isset ($_POST["submitnonsense"])){
		if(!empty($_POST["nonsense"])){
			//andmebaasi lisamine
			//loome andmebaasi ühenduse
			$conn = new mysqli($serverhost, $serverusername, $serverpassword, $database);
			//valmistame ette sql käsu
			$stmt = $conn->prepare("INSERT INTO nonsense (nonsenseidea) VALUES(?)");
			echo $conn->error;
			$stmt->bind_param("s", $_POST["nonsense"]);
			$stmt->execute();
			//käsk ja ühendus sulgeda
			$stmt->close();
			$conn->close();
			
			
		}
		
	}
//header
require("header.php");

?>
<hr>
  <form method="POST">
  <label>Sisesta oma tänane mõttetu mõte</label>
  <input type= "text" name="nonsense" placeholder="mõttekoht">
  <input type="submit" value="Saada ära!" name="submitnonsense">
  </form>
  <hr>

  <a href="home.php">Avaleht</a>
  <a href="idee.php">Mõtte kuvamine</a>
</body>
</html>