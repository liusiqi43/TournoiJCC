<?php 
require_once $ROOT."connection.php";

// Ces fonctions sont visible dans index_show_actions.php
// 1 fichier model pour tous les controleurs dans le meme module.
// n controleurs pour n vues.
// 1 vue = 1 page.
// $ROOT est defini ici. Tous les fichiers dans ce modules ont donc tous acces a cette variable. 
// $ROOT signifie la distance entre ce dossier et la dossier ou se trouve l'index, header et footer


function getJoueurs(){
	$sql = "SELECT >>>>>";
	$res = psql().exec($sql);
	return $res;
}

function foo(){
	$sql = "SELECT >>>>>";
	$res = psql().exec($sql);
	return $res;
}

function bar(){
	$sql = "SELECT >>>>>";
	$res = psql().exec($sql);
	return $res;
}
