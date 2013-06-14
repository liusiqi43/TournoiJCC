<?php
//User.class.php
require_once 'db.class.php';

class Participation {

	public $login;
	public $annee;
	public $surnom;
	public $nomDeck;

	//Constructor is called whenever a new object is created.
	//Takes an associative array with the DB row as an argument.
	function __construct($data) {
		$this->login = (isset($data['login'])) ? $data['login'] : "";
		$this->annee = (isset($data['annee'])) ? $data['annee'] : "";
		$this->surnom = (isset($data['surnom'])) ? $data['surnom'] : "";
		$this->nomDeck = (isset($data['nomDeck'])) ? $data['nomDeck'] : "";
	}

	public function save($isNewParticipation = false) {

		$db = new DB();
		
		//if the user is already registered and we're
		//just updating their info.
		if(!$isNewParticipation) {
			//set the data array
			$data = array(
				"login" => "'$this->login'",
				"annee" => "'$this->annee'",
				"surnom" => "'$this->surnom'",
				"nomDeck" => "'$this->nomDeck'"
				);
			
			//update the row in the database
			$db->exec_sql('UPDATE tparticipations set surnom='.$this->surnom.', nomDeck='.$this->nomDeck.
				' where login ='.$this->login.' AND annee ='.$this->annee.';');
		
		} else {
		//if the user is being registered for the first time.
			$db->exec_sql('INSERT INTO tparticipations VALUES('.$this->login.','.$this->annee.', '.$this->surnom.', '.$this->nomDeck.');');
		}
		return true;
	}
}

?>
