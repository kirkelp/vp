<?php
	require("usesession.php");
	
	require("../../../config.php");
	require("fnc_photo.php");
	require("fnc_common.php");
	require("classes/Photoupload_class.php");

	$tolink = '<script src="javascript/checkfilesize.js" defer></script>' ."\n";
		
	  $inputerror = "";
	  $notice = null;
	  $filetype = null;
	  $filesizelimit = 2097152;//1048576;
	  $watermark = "../img/vp_logo_w100_overlay.png";
	  $filenameprefix = "vp_";
	  $filename = null;
	  $photomaxwidth = 600;
	  $photomaxheight = 400;
	  $thumbsize = 100;
	  $privacy = 1;
	  $alttext = null;
		
	  //kui klikiti submit, siis ...
	  if(isset($_POST["photosubmit"])){
		$privacy = intval($_POST["privinput"]);
		$alttext = test_input($_POST["altinput"]);
		//var_dump($_POST);
		//var_dump($_FILES);
		//kas on pilt ja mis t��pi
		$check = getimagesize($_FILES["photoinput"]["tmp_name"]);
		if($check !== false){
			//var_dump($check);
			if($check["mime"] == "image/jpeg"){
				$filetype = "jpg";
			}
			if($check["mime"] == "image/png"){
				$filetype = "png";
			}
			if($check["mime"] == "image/gif"){
				$filetype = "gif";
			}
		} else {
			$inputerror = "Valitud fail ei ole pilt! ";
		}
		
		//kas on sobiva failisuurusega
		if(empty($inputerror) and $_FILES["photoinput"]["size"] > $filesizelimit){
			$inputerror = "Liiga suur fail!";
		}
		
		//loome uue failinime
		$timestamp = microtime(1) * 10000;
		$filename = $filenameprefix .$timestamp ."." .$filetype;
		
		//ega fail �kki olemas pole
		if(file_exists($photouploaddir_orig .$filename)){
			$inputerror = "Selle nimega fail on juba olemas!";
		}
		
		//kui vigu pole ...
		if(empty($inputerror)){
			
			//v�tame kasutusele klassi
			$myphoto = new Photoupload($_FILES["photoinput"], $filetype);
			//teeme pildi v�iksemaks
			$myphoto->resizePhoto($photomaxwidth, $photomaxheight, true);
			//lisame vesim�rgi
			$myphoto->addWatermark($watermark);
			//salvestame v�hendatud pildi
			$result = $myphoto->saveimage($photouploaddir_normal .$filename);
			if($result == 1){
				$notice .= " V�hendatud pildi salvestamine �nnestus!";
			} else {
				$inputerror .= " V�hendatud pildi salvestamisel tekkis t�rge!";
			}
			
			//teeme pisipildi
			$myphoto->resizePhoto($thumbsize, $thumbsize);
			$result = $myphoto->saveimage($photouploaddir_thumb .$filename);
			if($result == 1){
				$notice .= " Pisipildi salvestamine �nnestus!";
			} else {
				$inputerror .= "Pisipildi salvestamisel tekkis t�rge!";
			}
			//eemaldan klassi
			unset($myphoto);
			
			//salvestame originaalpildi
			if(empty($inputerror)){
				if(move_uploaded_file($_FILES["photoinput"]["tmp_name"], $photouploaddir_orig .$filename)){
					$notice .= " Originaalfaili �leslaadimine �nnestus!";
				} else {
					$inputerror .= " Originaalfaili �leslaadimisel tekkis t�rge!";
				}
			}
			
			if(empty($inputerror)){
				$result = storePhotoData($filename, $alttext, $privacy);
				if($result == 1){
					$notice .= " Pildi info lisati andmebaasi!";
					$privacy = 1;
					$alttext = null;
				} else {
					$inputerror .= "Pildi info andmebaasi salvestamisel tekkis t�rge!";
				}
			} else {
				$inputerror .= " Tekkinud vigade t�ttu pildi andmeid ei salvestatud!";
			}
			
		}
	  }
	  

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
	  
	  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
		<label for="photoinput">Vali pildifail!</label>
		<input id="photoinput" name="photoinput" type="file" required>
		<br>
		<label for="altinput">Lisa pildi l�hikirjeldus (alternatiivtekst)</label>
		<input id="altinput" name="altinput" type="text" value="<?php echo $alttext; ?>">
		<br>
		<label>Privaatsustase</label>
		<br>
		<input id="privinput1" name="privinput" type="radio" value="1" <?php if($privacy == 1){echo " checked";} ?>>
		<label for="privinput1">Privaatne (ainult ise n�en)</label>
		<input id="privinput2" name="privinput" type="radio" value="2" <?php if($privacy == 2){echo " checked";} ?>>
		<label for="privinput2">Klubi liikmetele (sisseloginud kasutajad n�evad)</label>
		<input id="privinput3" name="privinput" type="radio" value="3" <?php if($privacy == 3){echo " checked";} ?>>
		<label for="privinput3">Avalik (k�ik n�evad)</label>
		<br>	
		<input type="submit" id="photosubmit" name="photosubmit" value="Lae foto �les">
	  </form>
	  <p id="notice">
	  <?php
		echo $inputerror;
		echo $notice;
	  ?>
	  </p>
	  
	</body>
	</html>	