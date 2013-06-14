<?php
//carte.class.php
require_once 'db.class.php';  

class Carte {

	public $nom;
	public $extentionsts;
	public $dateinterdite;

	//Constructor is called whenever a new object is created.
	//Takes an associative array with the DB row as an argument.
	function __construct($data) {
		$this->nom = (isset($data['nom'])) ? $data['nom'] : "";
		$this->extentionsts = (isset($data['extentionsts'])) ? $data['extentionsts'] : "";
		$this->dateinterdite = (isset($data['dateinterdite'])) ? $data['dateinterdite'] : "";
	}

	public function save($isNewCard = false) {

		$db = new DB();
		
		//if the user is already registered and we're
		//just updating their info.
		if(!$isNewCard) {
			//set the data array
			$data = array(
				"nom" => "'$this->nom'",
				"extentionsts" => "'$this->extentionsts'",
				"dateinterdite" => "'$this->dateinterdite'"
			);
			
			//update the row in the database
			$db->exec_sql('UPDATE tcartes set extentionsts='.$this->extentionsts.', dateinterdite='.$this->dateinterdite.' where nom ='.$this->nom.';');
		}
		else {
		//if the user is being registered for the first time.
			$db->exec_sql('INSERT INTO tcartes VALUES('.$this->nom.','.$this->extentionsts.', '.$this->dateinterdite.');');
		}
		return true;
	}
	
}

?>
