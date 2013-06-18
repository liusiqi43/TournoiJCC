<?php
//User.class.php
require_once 'db.class.php';

class Deck {

	public $login;
	public $annee;
	public $nom;

	//Constructor is called whenever a new object is created.
	//Takes an associative array with the DB row as an argument.
	function __construct($data) {
		$this->login = (isset($data['login'])) ? $data['login'] : "";
		$this->annee = (isset($data['annee'])) ? $data['annee'] : "";
		$this->nom = (isset($data['nom'])) ? $data['nom'] : "";
	}

	public function save($isNewDeck = false) {
		$db = new DB();
		$db->exec_sql("INSERT INTO tdecks VALUES('$this->login',$this->annee,'$this->nom');");
		return true;
	}

	public function delete($login, $annee, $nom) {
		$db = new DB();
		$db->exec_sql("DELETE FROM tdecks WHERE login = '$login.' AND annee =$annee AND '.$nom.');");
		return true;
	}
}

?>
