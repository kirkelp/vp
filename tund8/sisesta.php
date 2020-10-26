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
<h1><?php echo $_SESSION["userfirstname"] . " " .$_SESSION["userlastname"];?> programmeerib veebi</h1>
 <p> <a href ="?logout=1">Logi välja</a></p>
<ul>
<li><a href="home.php">Avaleht</a></li>
<li><a href="idee.php">Mõtte kuvamine</a>
<li><a href="listfilms.php">Filmiinfo näitamine</a>
</ul>


<hr>
  <form method="POST">
  <label>Sisesta oma tänane mõttetu mõte</label>
  <input type= "text" name="nonsense" placeholder="mõttekoht">
  <input type="submit" value="Saada ära!" name="submitnonsense">
  </form>
  <hr>
 
</body>
</html>