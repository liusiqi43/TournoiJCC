<?php
	require_once '../../model/tournoi.class.php';
	// cette variable la est visible dans la vue index_show_action.php
	// On fait appel aux fonctions dans model.php depuis ici. 
	// Et on utiliser les variables recuperes dans les vues. 
	$annees = Tournoi::getAnnees();

	date_default_timezone_set("Europe/Paris");
	$annee =  date("Y");
	if (isset($_GET["annee"])) {
		$annee = $_GET["annee"];
	}


	$result = $db->exec_sql("SELECT * from get_matches_infos_for_all('$annee') WHERE total!=0 AND elimine = false ORDER BY win DESC, total asc;");

	if (!pg_num_rows($result)) {
		$error = "Aucun joueur non elimie ont joue un match pour le moment... ";
	}
	$joueurs = pg_fetch_all($result);


	$result = $db->exec_sql("SELECT * from get_matches_infos_for_all('$annee') WHERE total!=0 AND elimine = true ORDER BY win DESC, total asc;");

	if (!pg_num_rows($result)) {
		$error_e = "Aucun joueur elimine ayant joue au moins un match pour le moment... ";
	}
	$joueurs_elimine = pg_fetch_all($result);

	if (!in_array($annee, $annees))
    	$error = "Arretez de jouer avec le URL!!";
	