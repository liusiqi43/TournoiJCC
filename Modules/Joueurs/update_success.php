<?php 
$ROOT = '../../';
require_once $ROOT.'global.inc.php';
require_once $ROOT.'header.php';

require_once '../../model/participation.class.php';

if(isset($_POST['update_part-submit'])) { 
	if($_POST['action'] == 'modify' OR $_POST['action'] == 'new'){
		$data = array(
		'login' => $_POST['login'], 
		'pwd' => $_POST['pwd'],
		'annee' => $_POST['annee'],
		'nom' => $_POST['nom'],
		'prenom' => $_POST['prenom'],
		'surnom' => $_POST['surnom'],
		'datedenaissance' => $_POST['dateDeNaissance'],
		'adresse' => $_POST['address'],
		'elimine' => isset($_POST['elimine']) ? $_POST['elimine'] : 'false'
		);
	print_r($data);
	$newPart = new Participation($data);

		if ($_POST['action'] == "modify") {
			$newPart->save();
		} else if ($_POST['action'] == "new"){
			$newPart->save(true);
		}
	
	} else if ($_POST['action'] == "new_part"){
		$login = $_POST['login'];
		$annee = $_POST['annee'];
		$surnom = $_POST['surnom'];
		$db->exec_sql("INSERT INTO tjoueurs VALUES('$login');", true);
		$db->exec_sql("INSERT INTO tparticipations VALUES( '$login', '$annee', '$surnom');");
	}
	header("Location: index_show.php");
} else {
	header("HTTP/1.0 404 Not Found");
}

require_once $ROOT.'footer.php';
