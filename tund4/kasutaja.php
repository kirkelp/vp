<?php
//loeme andmebaasi login info muutujad
	require("../../../config.php");
	require("fnc_film.php");
	//kui klikiti nuppu, siis kontrollime ja salves	  
	$inputerror = "";
	$firstnameerror = "";
	$lastnameerror = "";
	$gendererror = "";
	$emailerror = "";
	$passworderror = "";
	$passwordsecondaryerror = "";
	$passwordlengtherror = "";
	$passwordcompareerror = "";
	$firstname = "";
	$lastname = "";
	$gender = "";
	$email = "";
//kui klikit submit siis ...
if(isset($_POST["usersubmit"])){
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
<hr>
<ul>
<li><a href="home.php">Avaleht</a></li>
</ul>
<hr> 

<form method= "POST">
	<label for="firstnameinput"> Eesnimi</label>
	<input type="text" name="firstnameinput" id="firstnameinput" placeholder="Eesnimi" value="<?php echo $firstname; ?>"><span><?php echo $firstnameerror; ?></span>
	<br>
	<label for="lastnameinput"> Perekonnanimi</label>
	<input type="text" name="lastnameinput" id="lastnameinput" placeholder="Perekonnanimi" value="<?php echo $lastname; ?>" ><span><?php echo $lastnameerror; ?></span>
	<br>
	<p>Sugu:</p>
	<input type="radio" name="genderinput" id="gendermale" value="1"><label for="gendermale">Mees</label><?php if($gender == "1"){echo " checked";}?>
	<input type="radio" name="genderinput" id="genderfemale" value="2"><label for="genderfemale">Naine</label><?php if($gender == "2"){echo " checked";}?><span><?php echo $gendererror; ?></span>
	<br>
	<label for="emailinput"> Kasutajanimi meiliaadressina</label>
	<input type="text" name="emailinput" id="emailinput" placeholder="email@domain.com" value="<?php echo $email; ?>"><span><?php echo $emailerror; ?></span>
	<br>
	<label for="passwordinput">Sisesta parool</label>
	<input type="password" name="passwordinput" id="passwordinput" placeholder="Password"><span><?php echo $passworderror, $passwordcompareerror, $passwordlengtherror ; ?></span>
	<br>
	<label for="passwordsecondaryinput"> Korda parooli</label>
	<input type="password" name="passwordsecondaryinput" id="passwordsecondaryinput" placeholder="Password"><span><?php echo $passwordsecondaryerror ; ?></span>
	<br>
	
	
	<input type="submit" name="usersubmit" value="Salvesta kasutajakonto">

</form>
<br>
<?php

</body>
	</html>
	