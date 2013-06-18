<?php
//carte.class.php
require_once 'db.class.php';
require_once 'carte.class.php';  

class CarteEffet extends carte {

	public $coutressource;

	//Constructor is called whenever a new object is created.
	//Takes an associative array with the DB row as an argument.
	function __construct($data) {
		parent::__construct($data);
		$this->coutressource = (isset($data['coutressource'])) ? $data['coutressource'] : "";
	}

	public function save($isNewCard = false) {

		$db = new DB();
		parent::save($isNewCard);
		
		//if the user is already registered and we're
		//just updating their info.
		if(!$isNewCard) {
			//set the data array
			$data = array(
				"coutressource" => "'$this->coutressource'"
			);
			
			//update the row in the database
			$db->exec_sql("UPDATE tcarteffet set coutressource=$this->coutressource where nom ='$this->nom';");
		} else {
		//if the user is being registered for the first time.
			$db->exec_sql("INSERT INTO tcarteseffet VALUES('$this->nom', $this->coutressource);");
		}
		return true;
	}
	
}

?>