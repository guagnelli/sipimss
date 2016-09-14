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
require_once 'DataBaseMysql.class.php';

Class cseccion {

	private $SECCION_CVE; //int(11)
	private $SECCION_DES; //varchar(20)
	private $connection;

	public function cseccion(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_cseccion($SECCION_DES){
		$this->SECCION_DES = $SECCION_DES;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from cseccion where SECCION_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->SECCION_CVE = $row["SECCION_CVE"];
			$this->SECCION_DES = $row["SECCION_DES"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM cseccion WHERE SECCION_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE cseccion set SECCION_DES = \"$this->SECCION_DES\" where SECCION_CVE = \"$this->SECCION_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into cseccion (SECCION_DES) values (\"$this->SECCION_DES\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT SECCION_CVE from cseccion order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["SECCION_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return SECCION_CVE - int(11)
	 */
	public function getSECCION_CVE(){
		return $this->SECCION_CVE;
	}

	/**
	 * @return SECCION_DES - varchar(20)
	 */
	public function getSECCION_DES(){
		return $this->SECCION_DES;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setSECCION_CVE($SECCION_CVE){
		$this->SECCION_CVE = $SECCION_CVE;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setSECCION_DES($SECCION_DES){
		$this->SECCION_DES = $SECCION_DES;
	}

    /**
     * Close mysql connection
     */
	public function endcseccion(){
		$this->connection->CloseMysql();
	}

}