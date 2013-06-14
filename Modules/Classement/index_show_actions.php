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


	$result = $db->exec_sql("SELECT * from get_matches_infos_for_all('$annee') ORDER BY (win/total) DESC;");

	if (!pg_num_rows($result)) {
		$error = "Aucun résultat pour le moment... ";
	}
	$joueurs = array();
	while ($row = pg_fetch_assoc($result)) {
		array_push($joueurs, $row);
	}

	if (!in_array($annee, $annees))
    	$error = "Arretez de jouer avec le URL!!";
	