<?php

/*
 * Author: Rafael Rocha - www.rafaelrocha.net - info@rafaelrocha.net
 * 
 * Create Date: 13-09-2016
 * 
 * Version of MYSQL_to_PHP: 1.1
 * 
 * License: LGPL 
 * 
 */
		
Class DataBaseMysql {

	public $conn;

	public function DataBaseMysql(){
		$this->conn = new mysqli("localhost", "root", "mysql", "sipimss_20160908");
		if($this->conn->connect_error){
			echo "Error connect to mysql";die;
		}
	}
	
	public function RunQuery($query_tag){
		$result = $this->conn->query($query_tag) or die("Erro SQL query-> $query_tag  ". mysql_error());
		return $result;
	}

	public function TotalOfRows($table_name){
		$result = $this->RunQuery("Select * from $table_name");
		return $result->num_rows;
	}

	public function CloseMysql(){
		$this->conn->close();
	}

}

?>