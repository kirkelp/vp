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
	
	
	
	$username = "Kirke Liis";
	$fulltimenow = date("d.m.Y H:i:s");
	$hournow = date("H");
	$partofday = "lihtsalt aeg";
	
	//vaatame mida formist serverile saadetakse
	var_dump($_POST);
	
	$weekdaynameset = ["esmaspäev", "teisipäev", "kolmapäev", "neljapäev", "reede", "laupäev", "pühapäev"];
	$monthnameset = ["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni", "juuli", "august", "september", "oktoober", "november", "detsember"];
	
	//küsime nädalapäevi
	$weekdaynow= date("N");
	//echo $weekdaynow;
	
	
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
  $semesterstart = new DateTime("2020-8-31");
  $semesterend = new DateTime("2020-12-13");
  $semesterduration = $semesterstart->diff($semesterend);
  $semesterdurationdays = $semesterduration->format("%r%a");
  $today = new DateTime("now");
  $fromsemesterstart = $semesterstart->diff($today);
  //saime aja erinevuse objektina, seda niisama näidata ei saa
  $fromsemesterstartdays = $fromsemesterstart->format("%r%a");
  $semesterpercentage = 0;
  
  
  
  $semesterinfo = "Semester kulgeb vastavalt akadeemilisele kalendrile.";
  if($semesterstart > $today){
	  $semesterinfo = "Semester pole veel peale hakanud!";
  }
  if($fromsemesterstartdays === 0){
	  $semesterinfo = "Semester algab täna!";
  }
  if($fromsemesterstartdays > 0 and $fromsemesterstartdays < $semesterdurationdays){
	  $semesterpercentage = ($fromsemesterstartdays / $semesterdurationdays) * 100;
	  $semesterinfo = "Semester on täies hoos, kestab juba " .$fromsemesterstartdays ." päeva, läbitud on " .$semesterpercentage ."%.";
  }
  if($fromsemesterstartdays == $semesterdurationdays){
	  $semesterinfo = "Semester lõppeb täna!";
  }
  if($fromsemesterstartdays > $semesterdurationdays){
	  $semesterinfo = "Semester on läbi saanud!";
  }
//loen kataloogist piltide nimekirja
//$allfiles = scandir("../vp_pics/");
$allfiles = array_slice(scandir("../vp_pics/"), 2);
//echo $allfiles; // massiivi nii näidata ei saa
//var_dump($allfiles);
//$allpicfiles = array_slice($allfiles, 2);
//var_dump($allpicfiles);
$allpicfiles = [];
$picfiletypes = ["image/jpeg", "image/png"];
//käi kogu massiivi läbi ja kontrollin iga üksikut elementi, kas on sobiv fail ehk pilt
foreach($allfiles as $file) {
	$fileinfo = getImagesize ("../vp_pics/" .$file);
	if(in_array($fileinfo["mime"], $picfiletypes) == true){
		array_push($allpicfiles, $file);
	}
}
//paneme kõik pildid järjest ekraanile
//uurime, mitu pilti on ehk mitu faili on nimekirjas - massiivis
$piccount = count($allpicfiles);
//$i = $i +1; 
//$i++;
//$i += nr; 
$imghtml = "";
for($i = 0; $i < $piccount; $i ++){
	//<img src="../img/vp_banner.png" alt="alt tekst">
	$imghtml .= '<img src = "../vp_pics/' .$allpicfiles[$i] .'" ';
	$imghtml .= 'alt = "Tallinna Ülikool">';
}
//header
require("header.php");
?>

<img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse bänner">
  <h1><?php echo $username; ?> programmeerib veebi</h1>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>Leht on loodud veebiprogrammeerimise kursusel <a href="https://www.tlu.ee/"> Tallinna Ülikooli </a> Digitehnoloogiate instituudis</p>
  <h1>Pealkiri2</h1>
  <h2>Alapealkiri</h2>
  <p>See on lause on loodud enda arvutiga väljaspool kooli sisevõrku</p>
  <p>Lehe avamise aeg: <?php echo $weekdaynameset[$weekdaynow - 1] .", " .$fulltimenow .", semestri algusest on möödunud " .$fromsemesterstartdays ." päeva"; ?></p>
  <p>Parajasti on <?php echo $partofday ." ." ; ?> </p>
  <p><?php echo $semesterinfo; ?></p>
  <hr>
  <?php echo $imghtml; ?>
  
  <hr>
  <form method="POST">
  <label>Sisesta oma tänane mõttetu mõte</label>
  <input type= "text" name="nonsense" placeholder="mõttekoht">
  <input type="submit" value="Saada ära!" name="submitnonsense">
  </form>
  <hr>
  <?php echo $nonsensehtml; ?>
</body>
</html>