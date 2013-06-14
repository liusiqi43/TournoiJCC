<?php 
$ROOT = '../../';
require_once $ROOT.'global.inc.php';
require_once $ROOT.'header.php';

require_once '../../model/match.class.php';

if(isset($_POST['update_match-submit'])) { 
	if($_POST['action'] == 'modify' OR $_POST['action'] == 'new'){
		$data = array(
		'key_column' => $_POST['key_column'], 
		'jour' => $_POST['jour'],
		'annee_tournoi' => $_POST['annee_tournoi'],
		'horaire' => $_POST['horaire'],
		'numerotable' => $_POST['numerotable'],
		'numerosalle' => $_POST['numerosalle'],
		'j1' => $_POST['j1'],
		'j2' => $_POST['j2'],
		'victoire' => $_POST['victoire']
		);
	// print_r($data);
	$newMatch = new Match($data);

		if ($_POST['action'] == "modify") {
			$newMatch->save();
		} else if ($_POST['action'] == "new"){
			$newMatch->save(true);
		}
	
	} 
	header("Location: index_show.php");
} else {
	header("HTTP/1.0 404 Not Found");
}

require_once $ROOT.'footer.php';
