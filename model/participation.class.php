<?php
//User.class.php
require_once 'db.class.php';
require_once 'joueur.class.php';
require_once 'member.class.php';

class Participation {

	public $login;
	public $annee;
	public $surnom;
	public $elimine;
	var $joueur;

	//Constructor is called whenever a new object is created.
	//Takes an associative array with the DB row as an argument.
	function __construct($data) {
		$this->joueur = new Joueur($data);
		$this->login = (isset($data['login'])) ? $data['login'] : "";
		$this->annee = (isset($data['annee'])) ? $data['annee'] : "";
		$this->surnom = (isset($data['surnom'])) ? $data['surnom'] : "";
		$this->elimine = (isset($data['elimine'])) ? $data['elimine'] : "False";
	}

	public function password(){
		return $this->joueur->password;
	}

	public function nom(){
		return $this->joueur->nom;
	}

	public function prenom(){
		return $this->joueur->prenom;
	}

	public function adresse(){
		return $this->joueur->adresse;
	}

	public function datedenaissance(){
		return $this->joueur->datedenaissance;
	}

	public function save($isNewParticipation = false) {
		$db = new DB();

		$db->exec_sql("BEGIN TRANSACTION;");
		$success = $this->joueur->save($isNewParticipation);

		//if the user is already registered and we're
		//just updating their info.
		//if the user is already registered and we're
		//just updating their info.
		if(!$isNewParticipation) {
			//set the data array
			//update the row in the database
			$sql = "UPDATE tparticipations set login = '$this->login', annee='$this->annee', surnom='$this->surnom', elimine='$this->elimine' WHERE login = '$this->login' AND annee = '$this->annee';";
			// var_dump($sql);
			$success = $db->exec_sql($sql);
		} else {
		//if the user is being registered for the first time.
			$success = $db->exec_sql("INSERT INTO tparticipations VALUES('$this->login','$this->annee', '$this->surnom', '$this->elimine');");
		}
		if ($success) {
			$db->exec_sql("COMMIT;");
			return true;
		} else {
			$db->exec_sql("ROLLBACK;");
			return false;
		}
	}
}

?>
