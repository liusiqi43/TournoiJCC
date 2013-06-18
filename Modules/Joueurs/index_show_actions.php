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



	if (isset($_GET["elimine"])) {
		$action = "elimine";
		$l = $_GET["elimine"];
		if(!$db->exec_sql("UPDATE tparticipations set elimine = true where annee = $annee AND login = '$l'")){
			$error = "Echec d'eliminer ce Joueur...";
		}
	}

	$result = $db->exec_sql("SELECT * FROM tparticipations tp, tmembres tm WHERE tp.login = tm.login AND tp.annee = $annee AND tp.elimine = FALSE ORDER BY tm.nom ASC");

 	if (pg_num_rows($result) < 8) {
 		if (isset($_GET["new"])) 
 		{
			$action = "new";
			$newOrg = array('annee'=>$annee);
			$participation_to_modify = new Participation($newOrg);

			$logins = Member::getAllLoginEligible($annee);
		}
		if (isset($_GET["qualifie"])) {
			$action = "qualifie";
			$l = $_GET["qualifie"];
			if(!$db->exec_sql("UPDATE tparticipations set elimine = false where annee = $annee AND login = '$l'")){
				$error = "Echec de qualifier ce Joueur...";
			}
		}
 	} else {
 		$error = "Le nombre de joueurs non eliminé ne doit pas dépasser 8! Eliminer certains joueurs si vous comptez ajouter des nouveaux joueurs";
 	}
	


	if (!pg_num_rows($result)) {
		$error = "Aucun joueur est enreigistré pour cette année... ";
	}
	$participations = array();
	while ($row = pg_fetch_assoc($result)) {
		$p = new Participation($row);
		array_push($participations, $p);
	}

	$result = $db->exec_sql("SELECT * FROM tparticipations tp, tmembres tm WHERE tp.login = tm.login AND tp.annee = $annee AND tp.elimine = TRUE ORDER BY tm.nom ASC");

	if (!pg_num_rows($result)) {
		$error_e = "Aucun joueur n'est eliminé pour le moment... ";
	}

	$participation_elimine = array();
	while ($row = pg_fetch_assoc($result)) {
		$p = new Participation($row);
		array_push($participation_elimine, $p);
	}

	$user = unserialize($_SESSION['member']);
	$annees = $user->getAnnees();

	if ($annee == date("Y") && in_array($annee, $annees)) {
		$admin = true;
	} else 
	$admin = false;

	if ($_SESSION['droit'] == 3) {
		$admin = true;
	}

	$annees = Tournoi::getAnnees();