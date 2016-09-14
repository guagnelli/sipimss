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

Class cmodulo {

	private $MODULO_CVE; //int(11)
	private $MODULO_NOMBRE; //varchar(30)
	private $connection;

	public function cmodulo(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_cmodulo($MODULO_NOMBRE){
		$this->MODULO_NOMBRE = $MODULO_NOMBRE;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from cmodulo where MODULO_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->MODULO_CVE = $row["MODULO_CVE"];
			$this->MODULO_NOMBRE = $row["MODULO_NOMBRE"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM cmodulo WHERE MODULO_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE cmodulo set MODULO_NOMBRE = \"$this->MODULO_NOMBRE\" where MODULO_CVE = \"$this->MODULO_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into cmodulo (MODULO_NOMBRE) values (\"$this->MODULO_NOMBRE\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT MODULO_CVE from cmodulo order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["MODULO_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return MODULO_CVE - int(11)
	 */
	public function getMODULO_CVE(){
		return $this->MODULO_CVE;
	}

	/**
	 * @return MODULO_NOMBRE - varchar(30)
	 */
	public function getMODULO_NOMBRE(){
		return $this->MODULO_NOMBRE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setMODULO_CVE($MODULO_CVE){
		$this->MODULO_CVE = $MODULO_CVE;
	}

	/**
	 * @param Type: varchar(30)
	 */
	public function setMODULO_NOMBRE($MODULO_NOMBRE){
		$this->MODULO_NOMBRE = $MODULO_NOMBRE;
	}

    /**
     * Close mysql connection
     */
	public function endcmodulo(){
		$this->connection->CloseMysql();
	}

}