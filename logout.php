<?php
//logout.php
require_once $ROOT.'global.inc.php';

$loginTools = new LoginTools();
$loginTools->logout();

header('Location: '.$ROOT.'index.php');

?>