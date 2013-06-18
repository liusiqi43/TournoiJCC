<?php
//User.class.php
require_once 'db.class.php';  
require_once 'member.class.php';

class Joueur extends Member{

	public $login;

	//Constructor is called whenever a new object is created.
	//Takes an associative array with the DB row as an argument.
	function __construct($data) {
		parent::__construct($data);

		$this->login = (isset($data['login'])) ? $data['login'] : "";
	}

	public function save($isNewUser = false) {
		$db = new DB();
		parent::save($IsNewMember);

		$db->exec_sql("BEGIN TRANSACTION;");
		$success = parent::save($isNewUser);

		//if the user is already registered and we're
		//just updating their info.
		//if the user is already registered and we're
		//just updating their info.
		if(!$isNewUser) {
			//set the data array
			//update the row in the database
			$sql = "UPDATE tJoueurs set login = '$this->login' WHERE login = '$this->login';";
			// var_dump($sql);
			$success = $db->exec_sql($sql);
		} else {
		//if the user is being registered for the first time.		    
			if (pg_num_rows($db->exec_sql("SELECT login FROM tJoueurs where login = '$this->login';"))==0) {
				$success = $db->exec_sql("INSERT INTO tJoueurs VALUES('$this->login');");
		    }
		}
		if ($success) {
			$db->exec_sql("COMMIT;");
			return true;
		} else {
			$db->exec_sql("ROLLBACK;");
			return false;
		}
	}

		public function getAnnees(){
		$db = new DB();
		$result = array();
		$r = $db->exec_sql("SELECT annee FROM tparticipations tp WHERE tp.login = '$this->login';");
		while ($row = pg_fetch_assoc($r)) {
			array_push($result, $row["annee"]);
		}
		return $result;
	}
	
}



?>
