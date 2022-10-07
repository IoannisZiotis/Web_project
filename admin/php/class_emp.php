<?php

class employee{
	function __construct($fname,$lname,$afm,$amka,$iban){
		$this->fname = $fname;
		$this->lname = $lname;
		$this->amka = $amka;
		$this->afm = $afm;
		$this->iban = $iban;
		$this->salary = 0;
	}
	function calc_slr($x,$y){
		$this->salary = 800 + 0.2*$x;
	}
}



class manager extends employee{
	function __construct($fname,$lname,$afm,$amka,$iban,$store){
		parent::__construct($fname,$lname,$afm,$amka,$iban);
		$this->store = $store;
	}
	function calc_slr($x,$y){
		$this->salary = round(800 + 0.02*$x,2);
	}
}

class deliver extends employee{
	function __construct($fname,$lname,$afm,$amka,$iban){
		parent::__construct($fname,$lname,$afm,$amka,$iban);
		$this->hours=0;
		$this->km=0;
	}
	function calc_slr($x,$y){
		$this->salary = round(5*$x + 0.1*$y,2);
	}

}



?>