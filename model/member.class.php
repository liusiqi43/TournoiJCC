<?php
//User.class.php
require_once 'db.class.php';  

class Member {

	public $login;
	public $password;
	public $nom;
	public $prenom;
	public $datedenaissance;
	public $adresse;


	//Constructor is called whenever a new object is created.
	//Takes an associative array with the DB row as an argument.
	function __construct($data) {
		$this->login = (isset($data['login'])) ? $data['login'] : "";
		$this->password = (isset($data['pwd'])) ? $data['pwd'] : "";
		$this->nom = (isset($data['nom'])) ? $data['nom'] : "";
		$this->prenom = (isset($data['prenom'])) ? $data['prenom'] : "";
		$this->datedenaissance = (isset($data['datedenaissance'])) ? $data['datedenaissance'] : "";
		$this->adresse = (isset($data['adresse'])) ? $data['adresse'] : "";
	}

	public function save($isNewUser = false) {

		$db = new DB();
		
		//if the user is already registered and we're
		//just updating their info.
		if(!$isNewUser) {
			//update the row in the database
			$sql ="UPDATE tmembres set pwd = '$this->password', nom='$this->nom', prenom='$this->prenom', datedenaissance='$this->datedenaissance', adresse='$this->adresse' WHERE login ='$this->login';";
			// print_r($sql);
			return $db->exec_sql($sql);
		} else {
		//if the user is being registered for the first time.
			return $db->exec_sql("INSERT INTO tmembres VALUES('$this->login','$this->password', '$this->nom', '$this->prenom', '$this->datedenaissance', '$this->adresse');");
		}
	}

	public static function getAllLoginEligible($annee){
		$db = new DB();

		$sql ="select login from tmembres except ((select login from tparticipations where annee = '$annee') union (select login from torganisateurs where annee='$annee')) ORDER BY login;";
		$result = $db->exec_sql($sql);

		$logins = pg_fetch_all($result);
		return $logins;
	}
}

?>
