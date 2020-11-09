<?php
	class Photoupload{
		
		private $uploadedphoto;
		private $photofiletype;
		private $mytempimage;
		private $mynewimage;
		
		function __construct($photoinput, $filetype){
			$this->uploadedphoto = $photoinput;
			$this->photofiletype = $filetype;
			//var_dump($this->uploadedphoto);
			
			// Teeme piksliobjekti
			$this->createImageFromFile();
			
		} // Konstruktor lõppeb
		
		function __destruct(){
			imagedestroy($this->mytempimage);
		}
		
		private function createImageFromFile(){
			if($this->photofiletype == "jpg"){
				$this->mytempimage = imagecreatefromjpeg($this->uploadedphoto["tmp_name"]);
			}	
			if($this->photofiletype == "png"){
				$this->mytempimage = imagecreatefrompng($this->uploadedphoto["tmp_name"]);
			}	
			if($this->photofiletype == "gif"){
				$this->mytempimage = imagecreatefromgif($this->uploadedphoto["tmp_name"]);
			}	
		}
		
		public function resizePhoto($w, $h, $keeporigproportion = true){
		$imagew = imagesx($this->mytempimage);
		$imageh = imagesy($this->mytempimage);
		$neww = $w;
		$newh = $h;
		$cutx = 0;
		$cuty = 0;
		$cutsizew = $imagew;
		$cutsizeh = $imageh;
		
		if($w == $h){
			if($imagew > $imageh){
				$cutsizew = $imageh;
				$cutx = round(($imagew - $cutsizew) / 2);
			} else {
				$cutsizeh = $imagew;
				$cuty = round(($imageh - $cutsizeh) / 2);
			}	
		} elseif($keeporigproportion){//kui tuleb originaaproportsioone säilitada
			if($imagew / $w > $imageh / $h){
				$newh = round($imageh / ($imagew / $w));
			} else {
				$neww = round($imagew / ($imageh / $h));
			}
		} else { //kui on vaja kindlasti etteantud suurust, ehk pisut ka kärpida
			if($imagew / $w < $imageh / $h){
				$cutsizeh = round($imagew / $w * $h);
				$cuty = round(($imageh - $cutsizeh) / 2);
			} else {
				$cutsizew = round($imageh / $h * $w);
				$cutx = round(($imagew - $cutsizew) / 2);
			}
		}
		
		//loome uue ajutise pildiobjekti
		$this->mynewimage = imagecreatetruecolor($neww, $newh);
		//kui on läbipaistvusega png pildid, siis on vaja säilitada läbipaistvusega
		imagesavealpha($this->mynewimage, true);
		$transcolor = imagecolorallocatealpha($this->mynewimage, 0, 0, 0, 127);
		imagefill($this->mynewimage, 0, 0, $transcolor);
		imagecopyresampled($this->mynewimage, $this->mytempimage, 0, 0, $cutx, $cuty, $neww, $newh, $cutsizew, $cutsizeh);
		}
		
		public function savePhotoFile($target){
		$notice = null;
		if($this->photofiletype == "jpg"){
			if(imagejpeg($this->mynewimage, $target, 90)){
				$notice = 1;
			} else {
				$notice = 0;
			}
		}
		if($this->photofiletype == "png"){
			if(imagepng($this->mynewimage, $target, 6)){
				$notice = 1;
			} else {
				$notice = 0;
			}
		}
		if($this->photofiletype == "gif"){
			if(imagegif($this->mynewimage, $target)){
				$notice = 1;
			} else {
				$notice = 0;
			}
		}
		imagedestroy($this->mynewimage);
		return $notice;
	}
	public function addWatermark($watermarkfile){
		if(isset($this->mynewimage)){
			$watermark = imagecreatefrompng($watermarkfile);
			$wmw = imagesx($watermark);
			$wmh = imagesy($watermark);
			$wmx = imagesx($this->mynewimage) - $wmw - 10;
			$wmy = imagesy($this->mynewimage) - $wmh - 10;
			//kopeerin vesimärgi vähendatud pildile
			imagecopy($this->mynewimage,$watermark, $wmx,$wmy,0,0,$wmw,$wmh);
			imagedestroy($watermark);
		}
	}
	public function isPhoto($photofiletypes) {
			$check = getimagesize($this->photoinput["tmp_name"]);
			if(in_array($check["mime"], $photoFileTypes)) {
				$this->photofiletype = substr($check["mime"], 6);
				echo $this->photofiletype;
				$this->createImageFromFile();
				return 1;
			} else {
				$this->photofiletype = null;
			}
		}
		
		public function isAllowedSize($filesizelimit) {
			if($this->photoinput["size"] > $filesizelimit) {
				return 1;
			} else {
				return null;
			}
		}
		
		public function createFileName($filenameprefix, $filenamesuffix) {
			$timestamp = microtime(1) * 10000;
			if(!empty($filenamesuffix)) {
				$notice = $this->filename = $filenameprefix .$timestamp ."_" .$filenamesuffix ."." .$this->photofiletype;
			} else {
				$notice = $this->filename = $filenameprefix .$timestamp ."." .$this->photofiletype;
			}
			$this->createImageFromFile();
			return $notice;
		}
	}

	
		
} // Klass lõppeb
