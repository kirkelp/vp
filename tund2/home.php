<?php
	$username = "Kirke Liis";
	$fulltimenow = date("d.m.Y H:i:s");
	$hournow = date("H");
	$partofday = "lihtsalt aeg";
	if($hournow < 6){
		$partofday = "uneaeg";
	}
	if($hournow >=6 and  $hournow <8){
		$partofday = "hommikuste portseduuride aeg";
		
	}
	if($hournow >=8 and  $hournow <18){
		$partofday = "õppimise aeg";
		
	}
	if($hournow >=19 and  $hournow <20){
		$partofday = "trenni aeg";
		
	}
	if($hournow >=21 and  $hournow <22){
		$partofday = "õhtuste portseduuride aeg";
		
	}
	
//jälgime semestri kulgu
$semesterstart = new DateTime("2020-08-31");
$semesterend = new DateTime("2020-12-13");
$semesterduration = $semesterstart->diff($semesterend);
$today = new DateTime("now");
$fromsemesterstart = $semesterstart->diff($today);
//saime aka erinevuse objektina, seda niisama näidata ei saa
$fromsemesterstartdays = $fromsemesterstart->format("%r%a");
$semester = $semesterduration->format("%r%a");
$tehtud = ($semester/100)*$fromsemesterstartdays;

?>




<!DOCTYPE html>
<html lang="et">
<head>
  <meta charset="utf-8">
  <title>Veebileht</title>

</head>
<body>
<img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse bänner">
  <h1><?php echo $username; ?> programmeerib veebi</h1>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>Leht on loodud veebiprogrammeerimise kursusel <a href="https://www.tlu.ee/"> Tallinna Ülikooli </a> Digitehnoloogiate instituudis</p>
  <h1>Pealkiri2</h1>
  <h2>Alapealkiri</h2>
  <p>See on lause on loodud enda arvutiga väljaspool kooli sisevõrku</p>
  <p>Lehe avamise aeg: <?php echo $fulltimenow .", semestri algusest on möödunud " .$fromsemesterstartdays ." päeva"; ?></p>
  <p>Parajasti on <?php echo $partofday ." ." ; ?> </p>
  <p>kogu semsestri päevade arv:<?php echo $semester; ?></p>
  <p>Semestri õppetööst on tehtud:<?php echo $tehtud; ?> %</p>
</body>
</html>