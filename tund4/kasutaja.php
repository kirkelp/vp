<?php
//loeme andmebaasi login info muutujad
	require("../../../config.php");
	//kui klikiti nuppu, siis kontrollime ja salves	  
	$firstname = "";
	$lastname = "";
	$gender = "";
	$email = "";
	
	$firstnameerror = "";
	$lastnameerror = "";
	$gendererror = "";
	$emailerror = "";
	
	$passworderror = "";
	$passwordsecondaryerror = "";
	$passwordlengtherror = "";
	$passwordcompareerror = "";

//kui klikit submit siis ...
if(isset($_POST["kasutajasubmit"])){
	if(empty($_POST["firstnameinput"])){
		$firstnameerror .= "Sisesta eesnimi ";
	}	
	else {
		$firstname = $_POST["firstnameinput"];
	}
	if(empty($_POST["lastnameinput"])){
		$lastnameerror .= "Sisesta perekonnanimi";
	}
	else {
		$lastname = $_POST["lastnameinput"];
	}
	if(empty($_POST["genderinput"])){
		$gendererror .= "  Kasutaja sugu on sisestamata ";
	}
	else {
		$gender = intval($_POST["genderinput"]);
	}
	if(empty($_POST["emailinput"])){
		$emailerror .= "Sisesta email ";
	}
	else {
		$email = $_POST["emailinput"];
	}
	if(empty($_POST["passwordinput"])){
		$passworderror .= "Parool on sisestamata! ";
	}	
	if(empty($_POST["passwordsecondaryinput"])){
		$passwordsecondaryerror .= "Parool on teist korda sisestamata! ";	
	}
	if(strlen($_POST["passwordinput"]) < 8 and isset($_POST["passwordinput"])){
		$passwordlengtherror .= "Parool on liiga lühike min 8 kohta ";
	}
	
	if ($_POST["passwordinput"] !== $_POST["passwordsecondaryinput"]){
		$passwordcompareerror .= "Sisestatud paroolid ei ühti.";
	}
	if(empty($firstnameerror) and empty($lastnameerror) and empty($gendererror) and empty($emailerror) and empty($passworderror) and empty($passwordsecondaryerror) and empty($passwordcompareerror)){
		saveuser($_POST["firstnameinput"], $_POST["lastnameinput"], $_POST["genderinput"], $_POST["emailinput"]);
	}	
		
}

require("header.php");
 ?>
<html> 
<img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse bänner">
<hr>
<a href="home.php">Avaleht</a>


<form method= "POST">
	<label for="firstnameinput">Eesnimi:</label>
	<input type="text" name="firstnameinput" id="firstnameinput" placeholder="Eesnimi" value="<?php echo $firstname; ?>"><span><?php echo $firstnameerror; ?></span>
	<br>
	<label for="lastnameinput">Perekonnanimi:</label>
	<input type="text" name="lastnameinput" id="lastnameinput" placeholder="Perekonnanimi" value="<?php echo $lastname; ?>" ><span><?php echo $lastnameerror; ?></span>
	<br>
	<label>Sugu:</label>
	<input type="radio" name="genderinput" id="gendermale" value="1"><label for="gendermale">Mees</label><?php if($gender == "1"){echo "valitud";}?>
	<input type="radio" name="genderinput" id="genderfemale" value="2"><label for="genderfemale">Naine</label><?php if($gender == "2"){echo " checked";}?><span><?php echo $gendererror; ?></span>
	<br>
	<label for="emailinput">Email:</label>
	<input type="text" name="emailinput" id="emailinput" placeholder="email@tlu.ee" value="<?php echo $email; ?>"><span><?php echo $emailerror; ?></span>
	<br>
	<label for="passwordinput">Sisesta parool</label>
	<input type="password" name="passwordinput" id="passwordinput" placeholder="Parool"><span><?php echo $passworderror, $passwordcompareerror, $passwordlengtherror ; ?></span>
	<br>
	<label for="passwordsecondaryinput">Korda parooli</label>
	<input type="password" name="passwordsecondaryinput" id="passwordsecondaryinput" placeholder="Parool"><span><?php echo $passwordsecondaryerror ; ?></span>
	<br>
	<input type="submit" name="kasutajasubmit" value="Salvesta">

</form>
<br>
</body>
	</html>
	