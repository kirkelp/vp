<?php

  require("../../../config.php");
  require("fnc_common.php");
  require("fnc_user.php");
  $database = "if20_kirkelp_3";
  //sisselogimine
	 $email = "";
	 $notice = "";
	 $emailerror = "";
	 $passworderror = "";
  
  if(isset($_POST["login"])){
	if (!empty($_POST["emailinput"])){
			$email = filter_var(test_input($_POST["emailinput"]), FILTER_VALIDATE_EMAIL);

		} else {
			$emailerror = "Palun sisesta e-postiaadress!";
				
		}  
		if (empty($_POST["passwordinput"])){
			$passworderror = "Palun sisesta salasõna!";
		} else {
			if(strlen($_POST["passwordinput"]) < 8){
				$passworderror = "Liiga lühike salasõna (sisestasite ainult " .strlen($_POST["passwordinput"]) ." märki).";
			}
		}
	 if(empty($emailerror) and empty($passworderror)){
		$result = sisene($email, $_POST["passwordinput"]);
		if($result == "Ok"){
			$email = "";
			}	
		} else {
			$notice = "Kahjuks tekkis tehniline tõrge: " .$result;
		}
	}
	
	$fulltimenow = date("d.m.Y H:i:s");
	$hournow = date("H");
	$kellaeg = date ("H:i:s");
	$day= date("d");
	$year=date ("Y");
	$partofday = "lihtsalt aeg";
	
	//vaatame mida formist serverile saadetakse
	var_dump($_POST);
	
	$weekdaynameset = ["esmaspäev", "teisipäev", "kolmapäev", "neljapäev", "reede", "laupäev", "pühapäev"];
	$monthnameset = ["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni", "juuli", "august", "september", "oktoober", "november", "detsember"];
	$monthnow=date("m");
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
//$imghtml = "";
//for($i = 0; $i < $piccount; $i ++){
	//<img src="../img/vp_banner.png" alt="alt tekst">
	//$imghtml .= '<img src = "../vp_pics/' .$allpicfiles[$i] .'" ';
	//$imghtml .= 'alt = "Tallinna Ülikool">';
{
	$picnum = mt_rand(0, ($piccount - 1));
	$imghtml = '<img src = "../vp_pics/' .$allpicfiles[$picnum] .'" alt = "Tallinna Ülikool">';
}
	
//header
	require("header.php");
?>

<img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse bänner">
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>Leht on loodud veebiprogrammeerimise kursusel <a href="https://www.tlu.ee/"> Tallinna Ülikooli </a> Digitehnoloogiate instituudis</p>
  <h1>Pealkiri2</h1>
  <h2>Alapealkiri</h2>
  <p>See on lause on loodud enda arvutiga väljaspool kooli sisevõrku</p>
  <p>Lehe avamise aeg: <?php echo  $weekdaynameset[$weekdaynow - 1]. ", " .$day."." .$monthnameset[$monthnow - 1]." ".$year. ", " .$kellaeg . ", semestri algusest on möödunud " .$fromsemesterstartdays ." päeva"; ?></p>
  <p>Parajasti on <?php echo $partofday ." ." ; ?> </p>
  <p><?php echo $semesterinfo; ?></p>
  <hr>
  <?php echo $imghtml; ?>
  <hr>
   <li><a href="adduser.php">Loo kasutaja</a></li>
  <hr>
  <h2>Sisselogimine</h2>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
     <label for="emailinput">E-mail (kasutajatunnus):</label><br>
	  <input type="email" name="emailinput" id="emailinput" value="<?php echo $email; ?>"><span><?php echo $emailerror; ?></span>
	  <br>
	  <br>
	  <label for="passwordinput">Salasõna (min 8 tähemärki):</label>
	  <br>
		<input type="password" name="passwordinput" id="passwordinput" placeholder="Password"><span><?php echo $passworderror; ?></span>
		<br>
		<br>
		<input type="submit" name="login" value="Logi sisse"><span><?php echo "&nbsp; &nbsp; &nbsp;" .$notice; ?></span>
  </form>
</body>
</html>