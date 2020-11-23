<?php
	require("usesession.php");
	require("../../../config.php");
	// kui kasutaja on vormis andmeid saatnud, siis salvestame andmebaasi
	$database = "if20_kirkelp_3";
//loen lehele k�ik olemasolevad m�tted
  $conn = new mysqli($serverhost, $serverusername, $serverpassword, $database);
  $stmt = $conn->prepare("SELECT idea FROM myideas");
  echo $conn->error;
  //seome tulemuse muutujaga
  $stmt->bind_result($ideafromdb);
  $stmt->execute();
  $ideahtml = "";
  while($stmt->fetch()){
	  $ideahtml .= "<p>" .$ideafromdb ."</p>";
  }
  $stmt->close();
  $conn->close();

  
  require("header.php");
?>
  <h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?></h1>
  <p>See veebileht on loodud �ppet�� kaigus ning ei sisalda mingit t�siseltv�etavat sisu!</p>
  <p>See konkreetne leht on loodud veebiprogrammeerimise kursusel aasta 2020 s�gissemestril <a href="https://www.tlu.ee">Tallinna �likooli</a> Digitehnoloogiate instituudis.</p>
  
  <ul>
    <li><a href="?logout=1">Logi v�lja</a>!</li>
    <li><a href="home.php">Avaleht</a></li>
  </ul>
  
  <hr>
  <?php echo $ideahtml; ?>
</body>
</html>
