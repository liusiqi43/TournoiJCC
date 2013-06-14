<?php
	require_once '../../model/tournoi.class.php';
	require_once '../../model/match.class.php';
	// cette variable la est visible dans la vue index_show_action.php
	// On fait appel aux fonctions dans model.php depuis ici. 
	// Et on utiliser les variables recuperes dans les vues. 
	date_default_timezone_set("Europe/Paris");
	$annee =  date("Y");
	if (isset($_GET["annee"])) {
		$annee = $_GET["annee"];
	}

	if (isset($_GET["j"]) && isset($_GET["v"])) {
		$result = $db->exec_sql('UPDATE tmatchs SET victoire = '.$_GET["v"].' where key_column='.$_GET["j"].';');
		if (!$result) {
			$error = "Erreur lors de la validation...";
		}
	}

	if (isset($_GET["delete"])) {
		$action = "delete";
		$result = $db->exec_sql('DELETE FROM tmatchs where key_column='.$_GET["delete"].';');
		if (!$result) {
			$error = "Arrêtez de jouer avec la pauvre URL!! C'est un projet étudiant!";
		}
	}

	if (isset($_GET["modify"])) {
		$action = "modify";
		$result = $db->exec_sql('SELECT * FROM tmatchs tm WHERE tm.key_column = '.$_GET["modify"].';');
		if (pg_num_rows($result)) {
			$match_to_modify = new Match(pg_fetch_assoc($result));
			print_r($match_to_modify);
		} else {
			$error = "Arrêtez de jouer avec la pauvre URL!! C'est un projet étudiant!";
		}
	}

	if (isset($_GET["new"])) {
		$action = "new";
		$newMatch = array('annee_tournoi'=>$annee);
		$match_to_modify = new Match($newMatch);
	}

	$result = $db->exec_sql("SELECT annee_tournoi, horaire, jour, numeroTable, numeroSalle, victoire, j1, nickname_lookup('$annee', j1) as j1_n, j2, nickname_lookup('$annee', j2) as j2_n, key_column FROM tmatchs tm WHERE tm.annee_tournoi = $annee AND (jour < now()::date OR (jour = now()::date AND horaire < now()::time) ) AND victoire!=0 ORDER BY tm.annee_tournoi DESC, tm.jour DESC, tm.horaire DESC;");

	if (!pg_num_rows($result)) {
		$error_p = "Aucun match passé et enreigistré n'est enreigistré pour cette année... ";
	}
	if ($result) {
		$matchs_past = pg_fetch_all($result);
	}

	$result = $db->exec_sql("SELECT annee_tournoi, horaire, jour, numeroTable, numeroSalle, victoire, j1, nickname_lookup('$annee', j1) as j1_n, j2, nickname_lookup('$annee', j2) as j2_n, key_column FROM tmatchs tm WHERE tm.annee_tournoi = $annee AND (jour < now()::date OR (jour = now()::date AND horaire < now()::time) ) AND victoire=0 ORDER BY tm.annee_tournoi DESC, tm.jour DESC, tm.horaire DESC;");
	if (!pg_num_rows($result)) {
		$error_pe = "Aucun match passé et non enreigistré n'est enreigistré pour cette année... ";
	}
	if ($result)
		$matchs_past_non_valide = pg_fetch_all($result);

	$result = $db->exec_sql("SELECT annee_tournoi, horaire, jour, numeroTable, numeroSalle, victoire, j1, nickname_lookup('$annee', j1) as j1_n, j2, nickname_lookup('$annee', j2) as j2_n, key_column FROM tmatchs tm WHERE tm.annee_tournoi = $annee AND (jour > now()::date OR (jour = now()::date AND horaire > now()::time) ) ORDER BY tm.annee_tournoi DESC, tm.jour DESC, tm.horaire DESC;");
	if (!pg_num_rows($result)) {
		$error_f = "Aucun match futurs n'est enreigistré pour cette année... ";
	}
	if ($result)
		$matchs_futur = pg_fetch_all($result);


	$user = unserialize($_SESSION['member']);
	$annees = $user->getAnnees();

	if ($annee == date("Y") && in_array($annee, $annees)) {
		$admin = true;
	} else 
	$admin = false;

	$result = $db->exec_sql("SELECT login, surnom FROM tparticipations tp WHERE tp.annee = $annee ORDER BY tp.surnom ASC;");

	if (!pg_num_rows($result)) {
		$error = "Vous devez ajouter d'abord des joueurs!";
	}
	$joueurs = pg_fetch_all($result);

	$annees = Tournoi::getAnnees();