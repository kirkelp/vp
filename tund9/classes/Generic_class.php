<?php
	class Generic{
		//muutujad ehk properties (omadused)
		private $secretnumber;
		public $availablenumber;
		
		//konstruktor 
		function __construct(){
			$this->secretnumber = mt_rand(0,100);
			$this->availablenumber = mt_rand(0,100);
			echo "Korrutis on " .($this->secretnumber * $this->availablenumber);
			$this->tellSecret();
		}
		function __destruct(){
			echo "Klassiga on nüüd kõik";
		}
		//funktsioonid ehk methods (meetodid)
		private function tellSecret(){
			echo "Näidis klass on mõttetu!";
		}
		public function showValues(){
			echo "salajane number on " .$this->secretnumber;

		}
		
	}//klass lõppeb