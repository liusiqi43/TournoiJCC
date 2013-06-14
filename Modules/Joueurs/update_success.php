<?php 
$ROOT = '../../';
require_once $ROOT.'global.inc.php';
require_once $ROOT.'header.php';

require_once '../../model/organisateur.class.php';

if(isset($_POST['update_org-submit'])) { 
	if($_POST['action'] == 'modify' OR $_POST['action'] == 'new'){
		$data = array(
		'login' => $_POST['login'], 
		'pwd' => $_POST['pwd'],
		'annee' => $_POST['annee'],
		'nom' => $_POST['nom'],
		'prenom' => $_POST['prenom'],
		'telephone' => $_POST['telephone'],
		'datedenaissance' => $_POST['dateDeNaissance'],
		'adresse' => $_POST['address']
		);
	$newOrg = new Organisateur($data);
	
		if ($_POST['action'] == "modify") {
			$newOrg->save();
		} else if ($_POST['action'] == "new"){
			$newOrg->save(true);
		}
	
	} else if ($_POST['action'] == "new_org"){
		$data = array(
		'login' => $_POST['login'], 
		'annee' => $_POST['annee'],
		'telephone' => $_POST['telephone']
		);
		$db->exec_sql('INSERT INTO torganisateurs VALUES (\''.$data['login'].'\', \''.$data['annee'].'\', \''.$data['telephone'].'\');');
	}
	header("Location: index_show.php");
} else {
	header("HTTP/1.0 404 Not Found");
}

require_once $ROOT.'footer.php';
