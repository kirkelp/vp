<?php
//loeme andmebaasi login info muutujad
	require("../../../config.php");
	require("fnc_film.php");	
//header
require("header.php");
?>
<h1>Filmide kohta info</h1>
<hr>
<?php echo readfilms(); ?>
  <a href="home.php">Avaleht</a>
  <a href="sisesta.php">Mõtte lisamine</a>
</body>
</html>