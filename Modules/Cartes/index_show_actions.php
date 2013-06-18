<?php
	require_once '../../model/carteinvention.class.php';
	require_once '../../model/carteeffet.class.php';
	require_once '../../model/carteressource.class.php';

	// cette variable la est visible dans la vue index_show_action.php
	// On fait appel aux fonctions dans model.php depuis ici. 
	// Et on utiliser les variables recuperes dans les vues. 

	//-------------------------------------------------------
	//Sert à déterminer quel bouton date est sélectionné :
	date_default_timezone_set("Europe/Paris");
	$annee =  date("Y");
	$today = date("Y-m-d");
	if (isset($_GET["annee"])) {
		$annee = $_GET["annee"];
	}

//////////////////////////////////////////////////////////
///JOUEUR : AJOUT D'UNE CARTE A SON DECK	
//////////////////////////////////////////////////////////

	if (isset($_GET["add"])) {
		$action = "add";

		if($_GET["add"]=="invention"){
			$cartes_invention_non_bannies = $db->exec_sql("SELECT * FROM tcartes tc, tcartesinvention tci WHERE tc.nom = tci.nom AND tc.dateinterdite is null ORDER BY tc.nom ASC;");
			$cartes_affichage = pg_fetch_all($cartes_invention_non_bannies);
		}
		if($_GET["add"]=="effet"){
			$cartes_effet_non_bannies = $db->exec_sql("SELECT * FROM tcartes tc, tcarteseffet tce WHERE tc.nom = tce.nom AND tc.dateinterdite is null ORDER BY tc.nom ASC;");
			$cartes_affichage = pg_fetch_all($cartes_effet_non_bannies);
		}
		if($_GET["add"]=="ressource"){
			$cartes_ressource_non_bannies = $db->exec_sql("SELECT * FROM tcartes tc, tcartesressource tcr WHERE tc.nom = tcr.nom AND tc.dateinterdite is null ORDER BY tc.nom ASC;");
			$cartes_affichage = pg_fetch_all($cartes_ressource_non_bannies);
		}
	}

//////////////////////////////////////////////////////////
///JOUEUR : SUPPRIMER UNE CARTE DE SON DECK
//////////////////////////////////////////////////////////

	if (isset($_GET["delete"]) && $_SESSION['droit'] == 1) {
		$action = "delete";
		//Le joueur supprime une carte de son deck
		$variable = $_GET['delete'];
		$result = $db->exec_sql("DELETE FROM tdecks where login ='$member->login' AND annee =$annee AND nom =$variable;");
		if (!$result) {
			$error = "Carte non existante !";
		}
	}

//////////////////////////////////////////////////////////
///ORGANISATEUR : ADD UNE CARTE A LA BDD
//////////////////////////////////////////////////////////

	if (isset($_GET["new"]) && $_SESSION['droit'] == 2) {
		$action = "new";
	}

//////////////////////////////////////////////////////////
///ORGANISATEUR : MODIFIER UNE CARTE
//////////////////////////////////////////////////////////
// Variables crées :
//		--> $carte : contient touts les attributs de la carte en question sauf sa faculté.
//		--> $faculte : contient la descritpion de la faculté de la carte si elle en a une.
//			sinon, on crée la variable $newFaculte pour indiquer qu'on va devoir en créer une nouvelle
//					si besoin.
//

	if (isset($_GET["modify"]) && $_SESSION['droit'] == 2)
	{
		$action = "modify";
		$variable = $_GET["modify"];
		$result = $db->exec_sql("SELECT description FROM tfacultes WHERE nom = $variable;");	
		if(pg_num_rows($result)){
			$faculte_to_modify=pg_fetch_row($result);
		}
		else {
			$newFaculte = true;
		}


		if ($result) {
			if($_GET["type"]=='invention'){
				$result = $db->exec_sql("SELECT * FROM tcartes tc, tcartesinvention tc2 WHERE tc.nom = tc2.nom AND tc.nom = $variable;");
				$card_to_modify = new CarteInvention(pg_fetch_assoc($result));
			}
			if($_GET["type"]=='effet'){
				$result = $db->exec_sql("SELECT * FROM tcartes tc, tcarteseffet tc2 WHERE tc.nom = tc2.nom AND tc.nom = $variable;");
				$card_to_modify = new CarteEffet(pg_fetch_assoc($result));
			}
			if($_GET["type"]=='ressource'){
				$result = $db->exec_sql("SELECT * FROM tcartes tc, tcartesressource tc2 WHERE tc.nom = tc2.nom AND tc.nom = $variable;");
				$card_to_modify = new CarteRessource(pg_fetch_assoc($result));
			}
		} else {
			$error = "Carte inexistante !";
		}
	}

//////////////////////////////////////////////////////////
///ORGANISATEUR : SUPPRIMER UNE CARTE DE LA BDD
//////////////////////////////////////////////////////////

	if (isset($_GET["delete"]) && $_SESSION['droit'] == 2) {
		$action = "delete";
		//L'organisateur supprime une carte définitivement
		$variable = $_GET['delete'];
		if($_GET["type"] == 'invention'){
			$result = $db->exec_sql("BEGIN;DELETE FROM tfacultes WHERE nom=$variable;DELETE FROM tdecks WHERE nom=$variable;DELETE FROM tcartes where nom=$variable;DELETE FROM tcartesinvention WHERE nom=$variable;COMMIT;");
			if (!$result) {
				$error = "Carte invention non existante !";
				}
			}
		elseif($_GET["type"] == 'effet'){
			$result = $db->exec_sql("BEGIN;DELETE FROM tfacultes WHERE nom=$variable;DELETE FROM tdecks WHERE nom=$variable;DELETE FROM tcartes where nom=$variable;DELETE FROM tcartesinvention WHERE nom=$variable;COMMIT;");
			if (!$result) {
				$error = "Carte effet non existante !";
				}
			}
		else{
			$result = $db->exec_sql("BEGIN;DELETE FROM tfacultes WHERE nom=$variable;DELETE FROM tdecks WHERE nom=$variable;DELETE FROM tcartes where nom=$variable;DELETE FROM tcartesinvention WHERE nom=$variable;COMMIT;");
				if (!$result) {
					$error = "Carte ressource non existante !";
				}
			}
	}

//////////////////////////////////////////////////////////
///ORGANISATEUR : BANNIR UNE CARTE	
//////////////////////////////////////////////////////////

	if (isset($_GET["ban"])) {
		//$action = "ban";
		$variable = $_GET["ban"];
		$db->exec_sql("UPDATE tcartes SET dateinterdite = '$today' WHERE nom = $variable;");
		header("Location: index_show.php");
	}

//////////////////////////////////////////////////////////
///ORGANISATEUR : AUTORISER UNE CARTE	
//////////////////////////////////////////////////////////

	if (isset($_GET["allow"])) {
		//$action = "ban";
		$variable = $_GET["allow"];
		$db->exec_sql("UPDATE tcartes SET dateinterdite = NULL WHERE nom = $variable;");
		header("Location: index_show.php");
	}
	

//////////////////////////////////////////////////////////
///TABLEAUX : CARTES INVENTION
//////////////////////////////////////////////////////////

	if($_SESSION["droit"] >= 2){ //ORGANISATEUR : les cartes inventions
		$result = $db->exec_sql("SELECT * FROM tcartes tc, tcartesinvention tci WHERE tc.nom = tci.nom ORDER BY tc.nom ASC, dateinterdite ASC;");
	}

	if($_SESSION["droit"] == 1){ //JOUEUR : ses cartes invention
		$result = $db->exec_sql("SELECT td.nom, dateinterdite, ci.extensionsts, potentielattaque, potentieldefense, coutressource FROM tdecks td, (select tci.nom, tc.extensionsts, tc.dateinterdite, tci.potentielattaque, tci.potentieldefense, tci.coutressource from tcartesinvention tci inner join tcartes tc on tci.nom=tc.nom) AS ci WHERE td.login = '$member->login' and td.annee=$annee and td.nom = ci.nom;");
	}
	if (!pg_num_rows($result)) {
		$error = "Aucune carte invention n'est enregistrée !";
	}
	
	$cartes_invention = array();
	while ($row = pg_fetch_assoc($result)) {
		$card = new CarteInvention($row);
		array_push($cartes_invention, $card);
	}

//////////////////////////////////////////////////////////
///TABLEAUX : CARTES EFFET
//////////////////////////////////////////////////////////

	if($_SESSION["droit"] >= 2){ //ORGANISATEUR : les cartes effet
		$result = $db->exec_sql("SELECT * FROM tcartes tc, tcarteseffet tce WHERE tc.nom = tce.nom ORDER BY tc.nom ASC, tc.dateinterdite ASC;");
	}
if($_SESSION["droit"] == 1){ //JOUEUR : ses cartes effet
		$result = $db->exec_sql("select ce.extensionsts, td.nom, dateinterdite, coutressource from tdecks td, (select tce.nom, tc.extensionsts, tc.dateinterdite, tce.coutressource from tcarteseffet tce inner join tcartes tc on tce.nom=tc.nom) as ce where td.login = '$member->login' and td.annee=$annee and td.nom = ce.nom;");
	}
	if (!pg_num_rows($result)) {
		$error = "Aucune carte effet n'est enregistrée !";
	}
	$cartes_effet = array();
	while ($row = pg_fetch_assoc($result)) {
		$card = new CarteEffet($row);
		array_push($cartes_effet, $card);
	}

//////////////////////////////////////////////////////////
///TABLEAUX : CARTES RESSOURCE
//////////////////////////////////////////////////////////

	if($_SESSION["droit"] >= 2){ //ORGANISATEUR : les cartes ressources
		$result = $db->exec_sql("SELECT * FROM tcartes tc, tcartesressource tcr WHERE tc.nom = tcr.nom ORDER BY tc.nom ASC, tc.dateinterdite ASC;");
	}
	if($_SESSION["droit"] == 1){ //JOUEUR : ses cartes ressources
		$result = $db->exec_sql("select cr.extensionsts, td.nom, dateinterdite, nbPoints from tdecks td, (select tcr.nom, tc.extensionsts, tc.dateinterdite, tcr.nbPoints from tcartesressource tcr inner join tcartes tc on tcr.nom=tc.nom) as cr where td.login = '$member->login' and td.annee=$annee and td.nom = cr.nom;");
	}
	if (!pg_num_rows($result)) {
		$error = "Aucune carte ressource n'est enregistrée !";
	}
	$cartes_ressource = array();
	while ($row = pg_fetch_assoc($result)) {
		$card = new CarteRessource($row);
		array_push($cartes_ressource, $card);
	}

//-------------------------------------------------

	$user = unserialize($_SESSION['member']);
	$droit = $_SESSION['droit']; // 1 : joueur, 2 : orga
	$annees = $user->getAnnees(); //annees de tous les tournois

	if ($annee == date("Y") && in_array($annee, $annees)) {
		$admin = true;
	} else {
		$admin = false;
	}
	if ($_SESSION['droit']==3) {
		$admin = true;
	}
	$annees = Tournoi::getAnnees();

	?>