<?php
	require_once '../../model/tournoi.class.php';
	require_once '../../model/participation.class.php';
	// cette variable la est visible dans la vue index_show_action.php
	// On fait appel aux fonctions dans model.php depuis ici. 
	// Et on utiliser les variables recuperes dans les vues. 
	date_default_timezone_set("Europe/Paris");
	$annee =  date("Y");
	if (isset($_GET["annee"])) {
		$annee = $_GET["annee"];
	}

	if (isset($_GET["delete"])) {
		$action = "delete";
		$result = $db->exec_sql('DELETE FROM tparticipations where login=\''.$_GET["delete"].'\' AND annee='.$_GET["annee"].';');
		if (!$result) {
			$error = "Arrêtez de jouer avec la pauvre URL!! C'est un projet étudiant!";
		}
		$user = unserialize($_SESSION['member']);
		if ($_GET["delete"]==$user->login && $result) {
			$loginTools->logout();
		}
	}

	if (isset($_GET["modify"])) {
		$action = "modify";
		$result = $db->exec_sql('SELECT * FROM tparticipations tp, tmembres tm WHERE tp.login = tm.login AND tm.login = \''.$_GET["modify"].'\' AND tp.annee = '.$annee.';');
		if (pg_num_rows($result)) {
			$participation_to_modify = new Participation(pg_fetch_assoc($result));
		} else {
			$error = "Arrêtez de jouer avec la pauvre URL!! C'est un projet étudiant!";
		}
	}

	if (isset($_GET["new"])) {
		$action = "new";
		$newOrg = array('annee'=>$annee);
		$participation_to_modify = new Participation($newOrg);

		$logins = Member::getAllLoginEligible($annee);
	}

	$result = $db->exec_sql("SELECT * FROM tparticipations tp, tmembres tm WHERE tp.login = tm.login AND tp.annee = $annee ORDER BY tm.nom ASC");

	if (!pg_num_rows($result)) {
		$error = "Aucun joueur est enreigistré pour cette année... ";
	}
	$participations = array();
	while ($row = pg_fetch_assoc($result)) {
		$p = new Participation($row);
		array_push($participations, $p);
	}

	$user = unserialize($_SESSION['member']);
	$annees = $user->getAnnees();

	if ($annee == date("Y") && in_array($annee, $annees)) {
		$admin = true;
	} else 
	$admin = false;

	$annees = Tournoi::getAnnees();