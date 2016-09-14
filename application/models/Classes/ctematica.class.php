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

Class ctematica {

	private $TEMATICA_CVE; //int(11)
	private $TEM_NOMBRE; //varchar(30)
	private $connection;

	public function ctematica(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_ctematica($TEM_NOMBRE){
		$this->TEM_NOMBRE = $TEM_NOMBRE;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from ctematica where TEMATICA_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->TEMATICA_CVE = $row["TEMATICA_CVE"];
			$this->TEM_NOMBRE = $row["TEM_NOMBRE"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM ctematica WHERE TEMATICA_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE ctematica set TEM_NOMBRE = \"$this->TEM_NOMBRE\" where TEMATICA_CVE = \"$this->TEMATICA_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into ctematica (TEM_NOMBRE) values (\"$this->TEM_NOMBRE\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT TEMATICA_CVE from ctematica order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["TEMATICA_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return TEMATICA_CVE - int(11)
	 */
	public function getTEMATICA_CVE(){
		return $this->TEMATICA_CVE;
	}

	/**
	 * @return TEM_NOMBRE - varchar(30)
	 */
	public function getTEM_NOMBRE(){
		return $this->TEM_NOMBRE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTEMATICA_CVE($TEMATICA_CVE){
		$this->TEMATICA_CVE = $TEMATICA_CVE;
	}

	/**
	 * @param Type: varchar(30)
	 */
	public function setTEM_NOMBRE($TEM_NOMBRE){
		$this->TEM_NOMBRE = $TEM_NOMBRE;
	}

    /**
     * Close mysql connection
     */
	public function endctematica(){
		$this->connection->CloseMysql();
	}

}