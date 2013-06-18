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

	$n = 1;
	if (isset($_GET["consult_n_premier"])) {
		$n = $_GET["n_premier"];
	}
	$result = $db->exec_sql("SELECT * from get_hall_of_fame('$n');");

	if (!pg_num_rows($result)) {
		$error = "Aucun résultat pour le moment... ";
	}
	$consult_joueurs = pg_fetch_all($result);


	$result = $db->exec_sql("select login from tparticipations where elimine = true except select login from tparticipations where elimine = false ORDER BY login ASC;");

	if (!pg_num_rows($result)) {
		$error_e = "Aucun joueur jamais qualifié dans l'historique... ";
	}
	$joueurs_elimine = pg_fetch_all($result);

	if (!in_array($annee, $annees))
    	$error = "Arretez de jouer avec le URL!!";

	$result = $db->exec_sql("SELECT avg(count), type FROM (SELECT * from get_hall_of_fame($n)) as joueurs GROUP BY type");
	if (!$result) {
		$error = "Pas assez de donnee pour l'instant";
	} else{
		$repart = pg_fetch_all($result);
	    $nb_repartition = array();
	    $sum = 0;
	if(is_array($repart)) {
	    foreach ($repart as $rep) {
	    	$sum = $sum + $rep['avg'];
	    }
	    foreach ($repart as $rep) {
	    	$nb_repartition[] = array($rep["type"], (float)number_format(100*$rep["avg"]/$sum, 2));
	    }
	}
		// print_r(json_encode($nb_repartition));
	}