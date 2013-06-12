<?php
//User.class.php
require_once 'db.class.php';  

class Member {

	public $login;
	public $password;
	public $nom;
	public $prenom;
	public $dateDeNaissance;
	public $adresse;
	public $admin;


	//Constructor is called whenever a new object is created.
	//Takes an associative array with the DB row as an argument.
	function __construct($data) {
		$this->login = (isset($data['login'])) ? $data['login'] : "";
		$this->password = (isset($data['password'])) ? $data['password'] : "";
		$this->nom = (isset($data['nom'])) ? $data['nom'] : "";
		$this->prenom = (isset($data['prenom'])) ? $data['prenom'] : "";
		$this->dateDeNaissance = (isset($data['dateDeNaissance'])) ? $data['dateDeNaissance'] : "";
		$this->adresse = (isset($data['adresse'])) ? $data['adresse'] : "";
		$this->admin = (isset($data['admin'])) ? $data['admin'] : "";
	}

	public function save($isNewUser = false) {

		$db = new DB();
		
		//if the user is already registered and we're
		//just updating their info.
		if(!$isNewUser) {
			//set the data array
			$data = array(
				"login" => "'$this->login'",
				"password" => "'$this->hashedPassword'",
				"nom" => "'$this->nom'",
				"prenom" => "'$this->prenom'",
				"dateDeNaissance" => "'$this->dateDeNaissance'",
				"adresse" => "'$this->adresse'",
				"admin" => "'$this->admin'"
			);
			
			//update the row in the database
			$db->exec_sql('UPDATE tmembres set admin = '.$this->admin.', pwd = '.$this->password.', nom='.$this->nom.', prenom='.$this->prenom.', datedenaissance='.$this->dateDeNaissance.', adresse='.$this->adresse.' where login ='.$this->login.';');
		} else {
		//if the user is being registered for the first time.
			$db->exec_sql('INSERT INTO tmembres VALUES('.$this->login.','.$this->admin.','.$this->password.', '.$this->nom.', '.$this->prenom.', '.$this->dateDeNaissance.', '.$this->adresse.');');
		}
		return true;
	}
	
}

?>
