<?php
//carte.class.php
require_once 'db.class.php';
require_once 'carte.class.php'; 

class CarteRessource extends carte {

	public $nbPoints;

	//Constructor is called whenever a new object is created.
	//Takes an associative array with the DB row as an argument.
	function __construct($data) {
		parent::__construct($data);
		$this->nbPoints = (isset($data['nbPoints'])) ? $data['nbPoints'] : "";
	}

	public function save($isNewCard = false) {

		$db = new DB();
		
		//if the user is already registered and we're
		//just updating their info.
		if(!$isNewCard) {
			//set the data array
			$data = array(
				"nbPoints" => "'$this->nbPoints'"
			);
			
			//update the row in the database
			$db->exec_sql('UPDATE tcartesressource set nbPoints='.$this->nbPoints.' where nom ='.$this->nom.';');
		} else {
		//if the user is being registered for the first time.
			$db->exec_sql('INSERT INTO tcartesressource VALUES('.$this->nom.','.$this->nbPoints.');');
		}
		return true;
	}
	
}

?>