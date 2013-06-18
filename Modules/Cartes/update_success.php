<?php 
$ROOT = '../../';
require_once $ROOT.'global.inc.php';
require_once $ROOT.'header.php';
require_once $ROOT.'model/carteinvention.class.php';
require_once $ROOT.'model/carteeffet.class.php';
require_once $ROOT.'model/carteressource.class.php';

date_default_timezone_set("Europe/Paris");
$annee =  date("Y");

//print_r($annee);
//////////////////////////////////////////////////
/// JOUEUR : ADD UNE CARTE A SON DECK
//////////////////////////////////////////////////


if(isset($_POST['add_card_submit'])) { 
		$nom = $_POST['nom'];
		$db->exec_sql("INSERT INTO tdecks VALUES ('$member->login',$annee,'$nom');");

	header("Location: index_show.php");
} 

//////////////////////////////////////////////////
/// ORGANISATEUR : ADD UNE CARTE A LA BDD
//////////////////////////////////////////////////

elseif (isset($_POST['add_new_card_submit'])) {
	if($_POST["type"]=='invention'){
		$data = array(
		'nom' => $_POST['nom'], 
		'extensionsts' => $_POST['extensionsts'],
		'potentielattaque' => $_POST['attaque'],
		'potentieldefense' => $_POST['defense'],
		'coutressource' => $_POST['coutressource']
		);
		$carte = new CarteInvention($data);
		if($_POST['faculte'] != ""){
			$faculte = $_POST['faculte'];
			$carte->save(true);
			$db->exec_sql("INSERT INTO tfacultes VALUES ('$carte->nom','$faculte');");
		}else{
			$carte->save(true);
		}
	}

	if($_POST["type"]=='effet'){
		$data = array(
		'nom' => $_POST['nom'], 
		'extensionsts' => $_POST['extensionsts'],
		'coutressource' => $_POST['coutressource']
		);
		$carte = new CarteEffet($data);
		if($_POST['faculte'] != ""){
			$faculte = $_POST['faculte'];
			$carte->save(true);
			$db->exec_sql("INSERT INTO tfacultes VALUES ('$carte->nom','$faculte');");
		}else{
			$carte->save(true);
		}
	}

	if($_POST["type"]=='ressource'){
		$data = array(
		'nom' => $_POST['nom'], 
		'extensionsts' => $_POST['extensionsts'],
		'nbpoints' => $_POST['nbpoints'],
		);
		$carte = new CarteRessource($data);
		if($_POST['faculte'] != ""){
			$faculte = $_POST['faculte'];
			$carte->save(true);
			$db->exec_sql("INSERT INTO tfacultes VALUES ('$carte->nom','$faculte');");
		}else{
			$carte->save(true);
		}
		
	}
	header("Location: index_show.php");
}


//////////////////////////////////////////////////
/// ORGANISATEUR : MODIFIER UNE CARTE DE LA BDD
//////////////////////////////////////////////////

elseif (isset($_POST['update_card_submit'])) {

	if($_POST["type"]=='invention'){
		$data = array(
		'nom' => $_POST['nom'], 
		'extensionsts' => $_POST['extensionsts'],
		'potentielattaque' => $_POST['attaque'],
		'potentieldefense' => $_POST['defense'],
		'coutressource' => $_POST['coutressource']
		);
		$carte = new CarteInvention($data);
		$carte->save();
		if($_POST['own_faculte']=='old'){
				if($_POST['faculte']){
					$faculte = $_POST['faculte'];
					$db->exec_sql("UPDATE tfacultes SET description='$faculte' WHERE  nom='$carte->nom';");
				}else{
					$db->exec_sql("DELETE FROM tfacultes WHERE  nom='$carte->nom';");
				}
		}
		if($_POST['own_faculte']=='new'){
				if($_POST['faculte']){
					$faculte = $_POST['faculte'];
					$db->exec_sql("INSERT INTO tfacultes VALUES ('$carte->nom','$faculte');");
				}
		}
		
	}

	elseif($_POST["type"]=='effet'){
		$data = array(
		'nom' => $_POST['nom'], 
		'extensionsts' => $_POST['extensionsts'],
		'coutressource' => $_POST['coutressource']
		);
		$carte = new CarteEffet($data);
		$carte->save();
		if($_POST['own_faculte']=='old'){
				if($_POST['faculte']){
					$faculte = $_POST['faculte'];
					$db->exec_sql("UPDATE tfacultes SET description='$faculte' WHERE  nom='$carte->nom';");
				}else{
					$db->exec_sql("DELETE FROM tfacultes WHERE  nom='$carte->nom';");
				}
		}
		if($_POST['own_faculte']=='new'){
				if($_POST['faculte']){
					$faculte = $_POST['faculte'];
					$db->exec_sql("INSERT INTO tfacultes VALUES ('$carte->nom','$faculte');");
				}
		}
	}

	elseif($_POST["type"]=='ressource'){
		$data = array(
		'nom' => $_POST['nom'], 
		'extensionsts' => $_POST['extensionsts'],
		'nbpoints' => $_POST['nbpoints'],
		);
		$carte = new CarteRessource($data);
		$carte->save();
		if($_POST['own_faculte']=='old'){
				if($_POST['faculte']){
					$faculte = $_POST['faculte'];
					$db->exec_sql("UPDATE tfacultes SET description='$faculte' WHERE  nom='$carte->nom';");
				}else{
					$db->exec_sql("DELETE FROM tfacultes WHERE  nom='$carte->nom';");
				}
		}
		if($_POST['own_faculte']=='new'){
				if($_POST['faculte']){
					$faculte = $_POST['faculte'];
					$db->exec_sql("INSERT INTO tfacultes VALUES ('$carte->nom','$faculte');");
				}
		}
	}
	header("Location: index_show.php");
}


else {
	header("HTTP/1.0 404 Not Found");
}

require_once $ROOT.'footer.php';
