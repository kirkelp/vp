<?php

	require("usesession.php");
	require("../../../config.php");
	require("fnc_common.php");

	$tolink = "\t" .'<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>' ."\n";
	$tolink .= "\t" .'<script>tinymce.init({selector:"textarea#newsinput", plugins: "link", menubar: "edit",});</script>' ."\n";

	   
	  $inputerror = "";
	  $notice = null;
	  $news=null; 
	  $newstitle = null;
	  //kui klikiti submit, siis ...
	  if(isset($_POST["newssubmit"])){
		  if(strlen($_POST["newstitleinput"]) == 0){
			  $inputerror = "Uudise pealkiri on puudu!";
		  }else{
			  $newstitle = test_input($_POST["newstitleinput"]);
		  }
		  if(strlen($_POST["newsinput"]) == 0){
			  $inputerror .= "Uudise sisu on puudu!";
		  }else{
			  $news = test_input($_POST["newsinput"]);
			  //htmlspecialchars teisendab html noolsulud, nende tagasisaamiseks htmlspecialchars_decode(uudis)
		  }
		  if(empty($inputerror)){
			  //uudis salvestada
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
		<label for="newstitleinput">Sisesta uudise pealkiri!</label>
		<input id="newstitleinput" name="newstitleinput" type="text" value="<?php echo $news;?>" required>
		<br>
		<label for="newsinput">Kirjuta uudis</label>
		<textarea id="newsinput" name="newsinput" placeholder ="Uudise sisu"><?php echo $news;?></textarea>

		<input type="submit" id="newssubmit" name="newssubmit" value="Lae uudis �les">
	  </form>
	  <p id="notice">
	  <?php
		echo $inputerror;
		echo $notice;
	  ?>
	  </p>
	  
	</body>
	</html>

	  
	</body>
	</html>