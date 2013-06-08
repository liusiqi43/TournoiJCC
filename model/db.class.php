<?php
//DB.class.php

class DB {

	protected $db_name = 'dbnf17p046';
	protected $db_user = 'nf17p046';
	protected $db_pass = 'ZdzH0FLh';
	protected $db_host = 'tuxa.sme.utc';
	protected $v_conn;

	//open a connection to the database. Make sure this is called
	//on every page that needs to use the database.
	public function connect() {
		$this->v_conn = pg_connect("host=$this->db_host dbname=$this->db_name user=$this->db_user password=$this->db_pass");
	}

	public function exec_sql($sql){
		if(!isset($this->v_conn)){
			$this->connect();
		} 
		$result = pg_query($this->v_conn, $sql);
		return $result;
	}
}

?>