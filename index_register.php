<?php
require_once 'model/db.class.php';


$db = new DB();
$db->connect();

if(isset($_POST['registering_asked'])){

$login = pg_escape_string($_POST['login']);
$psw = pg_escape_string($_POST['psw']);
$nom = pg_escape_string($_POST['nom']);
$prenom = pg_escape_string($_POST['prenom']);
$date = $_POST['date'];
$adr = pg_escape_string($_POST['adr']);

$db->exec_sql("INSERT INTO tmembres VALUES ('$login','$psw','$nom','$prenom','$date','$adr');");

}

header("Location: index.php");