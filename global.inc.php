<?php
if (!isset($_SESSION)) {
	session_start();
}
require_once $ROOT.'model/member.class.php';
require_once $ROOT.'model/logintools.class.php';
require_once $ROOT.'model/db.class.php';

//connect to the database
$db = new DB();
$db->connect();

//initialize UserTools object
$loginTools = new LoginTools();

//refresh session variables if logged in
if(isset($_SESSION['logged_in'])) {
	$member = unserialize($_SESSION['member']);
	// print_r($member->login);
	$result = $loginTools->getMember($member->login);
	// print_r($result);
	$_SESSION['member'] = serialize($result);
}
?>
