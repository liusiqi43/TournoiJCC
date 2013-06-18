<?php
//carte.class.php
require_once 'db.class.php';
require_once 'carte.class.php'; 

class CarteInvention extends carte {

	public $potentielattaque;
	public $potentieldefense;
	public $coutressource;

	//Constructor is called whenever a new object is created.
	//Takes an associative array with the DB row as an argument.
	function __construct($data) {
		parent::__construct($data);
		$this->potentielattaque = (isset($data['potentielattaque'])) ? $data['potentielattaque'] : "";
		$this->potentieldefense = (isset($data['potentieldefense'])) ? $data['potentieldefense'] : "";
		$this->coutressource = (isset($data['coutressource'])) ? $data['coutressource'] : "";
	}

	public function save($isNewCard = false) {

		$db = new DB();
		parent::save($isNewCard);
		
		if(!$isNewCard) {
			$db->exec_sql("UPDATE tcartesinvention SET potentielattaque=$this->potentielattaque, potentieldefense=$this->potentieldefense, coutressource=$this->coutressource where nom ='$this->nom';");
		} else {
		//if the user is being registered for the first time.
			$db->exec_sql("INSERT INTO tcartesinvention VALUES('$this->nom', $this->potentielattaque,$this->potentieldefense, $this->coutressource);");
		}
		return true;
	}
	
}

?>