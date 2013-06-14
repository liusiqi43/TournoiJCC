<?php
	$ROOT = '../../';
	require_once '../../model/tournoi.class.php';
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
		$result = $db->exec_sql('DELETE FROM torganisateurs where login=\''.$_GET["delete"].'\' AND annee='.$_GET["annee"].';');
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
		$result = $db->exec_sql('SELECT * FROM torganisateurs torg, tmembres tm WHERE torg.login = tm.login AND tm.login = \''.$_GET["modify"].'\' AND torg.annee = '.$annee.';');
		if (pg_num_rows($result)) {
			$org_to_modify = new Organisateur(pg_fetch_assoc($result));
		} else {
			$error = "Arrêtez de jouer avec la pauvre URL!! C'est un projet étudiant!";
		}
	}

	if (isset($_GET["new"])) {
		$action = "new";
		$newOrg = array('annee'=>$annee);
		$org_to_modify = new Organisateur($newOrg);

		$logins = Member::getAllLoginEligible($annee);
	}

	$result = $db->exec_sql("SELECT * FROM torganisateurs torg, tmembres tm WHERE torg.login = tm.login AND torg.annee = $annee ORDER BY tm.nom ASC");

	if (!pg_num_rows($result)) {
		$error = "Aucun organisateur est enreigistré pour cette année... ";
	}
	$orgs = array();
	while ($row = pg_fetch_assoc($result)) {
		$org = new Organisateur($row);
		array_push($orgs, $org);
	}

	$user = unserialize($_SESSION['member']);
	$annees = $user->getAnnees();

	if ($annee == date("Y") && in_array($annee, $annees)) {
		$admin = true;
	} else 
	$admin = false;

	$annees = Tournoi::getAnnees();