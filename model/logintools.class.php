<?php
//UserTools.class.php

require_once 'member.class.php';
require_once 'db.class.php';

class LoginTools {

	//Log the user in. First checks to see if the 
	//username and password match a row in the database.
	//If it is successful, set the session variables
	//and store the user object within.
	
	public function login($login, $pwd){
		$db = new DB();
		$result = $db->exec_sql("SELECT * FROM tmembres WHERE login = '$login' AND pwd = '$pwd' AND admin = true;");

		if(pg_num_rows($result) == 1){
			$_SESSION["member"] = serialize(new Member(pg_fetch_assoc($result)));  
            $_SESSION["login_time"] = time();  
            $_SESSION["logged_in"] = 1; 
            return true;
		} else {
			return false;
		}
	}

	public function logout() {  
        unset($_SESSION['member']);  
        unset($_SESSION['login_time']);  
        unset($_SESSION['logged_in']);  
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
	public function getMember($login)
	{
		$db = new DB();
		$result = $db->exec_sql("SELECT * FROM tmembres WHERE login = '$login';");
		return new Member(pg_fetch_assoc($result));
	}
	
}

?>

