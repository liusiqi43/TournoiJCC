<?php
//carte.class.php
require_once 'db.class.php';  

class Faculte {

	public $nom;
	public $description;

	//Constructor is called whenever a new object is created.
	//Takes an associative array with the DB row as an argument.
	function __construct($data) {
		$this->nom = (isset($data['nom'])) ? $data['nom'] : "";
		$this->description = (isset($data['description'])) ? $data['description'] : "";
	}

	public function save($isNewFaculte = false) {

		$db = new DB();
		
		//if the user is already registered and we're
		//just updating their info.
		if(!$isNewFaculte) {
			//set the data array
			$data = array(
				"nom" => "'$this->nom'",
				"description" => "'$this->description'"
			);
			
			//update the row in the database
			$db->exec_sql('UPDATE tfacultes set description='.$this->description.' where nom ='.$this->nom.';');
		} else {
		//if the user is being registered for the first time.
			$db->exec_sql('INSERT INTO tfacultes VALUES('.$this->nom.','.$this->description.');');
		}
		return true;
	}
	
}

?>
