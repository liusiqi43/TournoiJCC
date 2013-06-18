<?php
//carte.class.php
require_once 'db.class.php';  

class Carte {

	public $nom;
	public $extensionsts;
	public $dateinterdite;

	//Constructor is called whenever a new object is created.
	//Takes an associative array with the DB row as an argument.
	function __construct($data) {
		$this->nom = (isset($data['nom'])) ? $data['nom'] : "";
		$this->extensionsts = (isset($data['extensionsts'])) ? $data['extensionsts'] : "";
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
				"extensionsts" => "'$this->extensionsts'",
				"dateinterdite" => "'$this->dateinterdite'"
			);
			
			//update the row in the database
			$db->exec_sql("UPDATE tcartes SET extensionsts='$this->extensionsts' where nom ='$this->nom';");
		}
		else {
		//if the user is being registered for the first time.
			if($this->dateinterdite!=""){
				$db->exec_sql("INSERT INTO tcartes VALUES('$this->nom','$this->extensionsts',$this->dateinterdite);");
			}else{
				$db->exec_sql("INSERT INTO tcartes VALUES('$this->nom','$this->extensionsts');");
			}
		}
		return true;
	}
	
}

?>
