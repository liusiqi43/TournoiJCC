<?php
//Userclass.php
require_once 'db.class.php';  
require_once 'member.class.php';

class Organisateur extends Member{

	public $telephone;
	public $annee;

	//Constructor is called whenever a new object is created.
	//Takes an associative array with the DB row as an argument.
	function __construct($data) {
		parent::__construct($data);

		$this->telephone = (isset($data['telephone'])) ? $data['telephone'] : "";
		$this->annee = (isset($data['annee'])) ? $data['annee'] : "";
	}

	public function save($isNewUser = false) {
		$db = new DB();

		$db->exec_sql("BEGIN TRANSACTION;");
		$success = parent::save($isNewUser);

		
		//if the user is already registered and we're
		//just updating their info.
		if(!$isNewUser) {
			//set the data array
			$data = array(
				"telephone" => "'$this->telephone'",
				"annee" => "'$this->annee'"
			);
			
			//update the row in the database
			$sql = "UPDATE torganisateurs set annee = '$this->annee', telephone='$this->telephone' WHERE login = '$this->login' AND annee = '$this->annee';";
			// var_dump($sql);
			$success = $db->exec_sql($sql);
		} else {
		//if the user is being registered for the first time.
			$success = $db->exec_sql("INSERT INTO torganisateurs VALUES('$this->login','$this->annee','$this->telephone');");
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
		$r = $db->exec_sql("SELECT annee FROM torganisateurs torg WHERE torg.login = '$this->login';");
		while ($row = pg_fetch_assoc($r)) {
			array_push($result, $row["annee"]);
		}
		return $result;
	}

}

?>
