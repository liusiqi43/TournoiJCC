<?php
//UserTools.class.php

require_once 'member.class.php';
require_once 'organisateur.class.php';
require_once 'joueur.class.php';
require_once 'db.class.php';

class LoginTools {

	//Log the user in. First checks to see if the 
	//username and password match a row in the database.
	//If it is successful, set the session variables
	//and store the user object within.
	
	public function login($login, $pwd){
		$db = new DB();
		$result_o = $db->exec_sql("SELECT * FROM tmembres tm, torganisateurs torg WHERE tm.login = '$login' AND tm.pwd = '$pwd' AND tm.login = torg.login;");
		$result_j = $db->exec_sql("SELECT * FROM tmembres tm, tjoueurs tj WHERE tm.login = '$login' AND tm.pwd = '$pwd' AND tm.login = tj.login;");

		if(pg_num_rows($result_o)){
			$row = pg_fetch_assoc($result_o);
			$_SESSION["member"] = serialize(new Organisateur($row));  
            $_SESSION["login_time"] = time();  
            $_SESSION["logged_in"] = 1; 
            $_SESSION["droit"] = 2;
            return true;
		} else if (pg_num_rows($result_j)){
			$row = pg_fetch_assoc($result_j);
			$_SESSION["member"] = serialize(new Joueur($row));  
            $_SESSION["login_time"] = time();  
            $_SESSION["logged_in"] = 1; 
            $_SESSION["droit"] = 1;
            return true;
		} 
		else
			return false;
	}

	public function logout() {  
        unset($_SESSION['member']);  
        unset($_SESSION['login_time']);  
        unset($_SESSION['logged_in']);  
        unset($_SESSION['droit']);
        session_destroy();  
    }  

	//Check to see if a username exists.
	//This is called during registration to make sure all user names are unique.
	public function checkLoginExists($login) {
		$db = new DB();
		$result = $db->exec_sql("select login from tmembres where login='$login';");
    	if(pg_num_rows($result) == 0)
    	{
			return false;
	   	}else{
	   		return true;
		}
	}

	//get a user
	//returns a User object. Takes the users id as an input
	public function getOrganisateur($login)
	{
		$db = new DB();
		$result = $db->exec_sql("SELECT * FROM tmembres tm, torganisateurs torg WHERE tm.login = '$login' AND tm.login = torg.login;");
		if(pg_num_rows($result) == 0)
			return null;
		return new Organisateur(pg_fetch_assoc($result));
	}

	public function getJoueur($login)
	{
		$db = new DB();
		$result = $db->exec_sql("SELECT * FROM tmembres tm, tjoueurs tjour WHERE tm.login = '$login' AND tm.login = tjour.login;");
		if(pg_num_rows($result) == 0)
			return null;
		return new Joueur(pg_fetch_assoc($result));
	}

}

?>

