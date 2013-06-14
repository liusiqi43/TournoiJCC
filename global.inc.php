<?php
if (!isset($_SESSION)) {
	session_start();
}
require_once $ROOT.'model/member.class.php';
require_once $ROOT.'model/logintools.class.php';
require_once $ROOT.'model/db.class.php';
require_once $ROOT.'model/tournoi.class.php';

//connect to the database
$db = new DB();
$db->connect();

//initialize UserTools object
$loginTools = new LoginTools();

//refresh session variables if logged in
if(isset($_SESSION['logged_in'])) {
	$member = unserialize($_SESSION['member']);
	// print_r($member->login);
	if ($_SESSION['droit'] == 2) {
		$result = $loginTools->getOrganisateur($member->login);
	} else if ($_SESSION['droit'] == 1) {
		$result = $loginTools->getJoueur($member->login);
	}
	if ($result) {
		$_SESSION['member'] = serialize($result);
	} else {
		$loginTools->logout();
	}
}
?>
