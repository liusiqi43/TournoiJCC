<?php
//tournoi.class.php
require_once 'db.class.php';  

class Tournoi {

	public $annee;
	public $tDate;

	//Constructor is called whenever a new object is created.
	//Takes an associative array with the DB row as an argument.
	function __construct($data) {
		$this->annee = (isset($data['annee'])) ? $data['annee'] : "";
		$this->tDate = (isset($data['tDate'])) ? $data['tDate'] : "";
	}

	static public function getAnnees(){
		if(!isset($db))
			$db = new DB();
		$result = $db->exec_sql("SELECT annee FROM ttournois;");
		$annees = array();
		while ($row = pg_fetch_assoc($result)) {
			array_push($annees, $row['annee']);
		}
		return $annees;
	}

	public function save($isNewTournoi = false) {

		$db = new DB();
		
		//if the user is already registered and we're
		//just updating their info.
		if(!$isNewTournoi) {
			//set the data array
			$data = array(
				"annee" => "'$this->annee'",
				"tDate" => "'$this->tDate'"
			);
			
			//update the row in the database
			$db->exec_sql('UPDATE ttournois set tDate='.$this->tDate.' where annee ='.$this->annee.';');
		} else {
		//if the user is being registered for the first time.
			$db->exec_sql('INSERT INTO ttournois VALUES('.$this->annee.','.$this->tDate.');');
		}
		return true;
	}
	
}

?>
