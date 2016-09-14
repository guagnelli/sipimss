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

Class cmodulo_estado {

	private $MOD_EST_CVE; //int(11)
	private $MOD_EST_NOMBRE; //varchar(30)
	private $connection;

	public function cmodulo_estado(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_cmodulo_estado($MOD_EST_NOMBRE){
		$this->MOD_EST_NOMBRE = $MOD_EST_NOMBRE;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from cmodulo_estado where MOD_EST_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->MOD_EST_CVE = $row["MOD_EST_CVE"];
			$this->MOD_EST_NOMBRE = $row["MOD_EST_NOMBRE"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM cmodulo_estado WHERE MOD_EST_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE cmodulo_estado set MOD_EST_NOMBRE = \"$this->MOD_EST_NOMBRE\" where MOD_EST_CVE = \"$this->MOD_EST_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into cmodulo_estado (MOD_EST_NOMBRE) values (\"$this->MOD_EST_NOMBRE\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT MOD_EST_CVE from cmodulo_estado order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["MOD_EST_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return MOD_EST_CVE - int(11)
	 */
	public function getMOD_EST_CVE(){
		return $this->MOD_EST_CVE;
	}

	/**
	 * @return MOD_EST_NOMBRE - varchar(30)
	 */
	public function getMOD_EST_NOMBRE(){
		return $this->MOD_EST_NOMBRE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setMOD_EST_CVE($MOD_EST_CVE){
		$this->MOD_EST_CVE = $MOD_EST_CVE;
	}

	/**
	 * @param Type: varchar(30)
	 */
	public function setMOD_EST_NOMBRE($MOD_EST_NOMBRE){
		$this->MOD_EST_NOMBRE = $MOD_EST_NOMBRE;
	}

    /**
     * Close mysql connection
     */
	public function endcmodulo_estado(){
		$this->connection->CloseMysql();
	}

}