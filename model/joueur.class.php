<?php
//User.class.php
require_once 'db.class.php';  
require_once 'member.class.php';

class Joueur extends Member{


	//Constructor is called whenever a new object is created.
	//Takes an associative array with the DB row as an argument.
	function __construct($data) {
		parent::__construct($data);
	}

	public function save($isNewUser = false) {

		parent::save($isNewUser);

		return true;
	}
	
}

?>
