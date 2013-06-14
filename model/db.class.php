<?php
//DB.class.php

class DB {

	protected $db_name = 'dbnf17p046';
	protected $db_user = 'nf17p046';
	protected $db_pass = 'ZdzH0FLh';
	protected $db_host = 'tuxa.sme.utc';
	protected $v_conn = NULL;

	//open a connection to the database. Make sure this is called
	//on every page that needs to use the database.
	public function connect() {
		$this->v_conn = pg_connect("host=$this->db_host dbname=$this->db_name user=$this->db_user password=$this->db_pass");
	}

	public function exec_sql($sql){
		if(!isset($this->v_conn)){
			$this->connect();
		} 
		// print_r($sql);
		$result = pg_query($this->v_conn, $sql);
		if(!$result){
			$_SESSION['last_error_msg'] = pg_last_error($this->v_conn);
		}
		return $result;
	}

	public function last_error_msg(){
		if (isset($_SESSION['last_error_msg'])) {
			$msg = $_SESSION['last_error_msg'];
			unset($_SESSION['last_error_msg']);
			return $msg;
		} else {
			return 0;
		}
	}
}

?>