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

Class crol {

	private $ROL_CVE; //int(11)
	private $ROL_NOMBRE; //varchar(20)
	private $PROYECTO_CVE; //int(11)
	private $connection;

	public function crol(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_crol($ROL_NOMBRE,$PROYECTO_CVE){
		$this->ROL_NOMBRE = $ROL_NOMBRE;
		$this->PROYECTO_CVE = $PROYECTO_CVE;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from crol where ROL_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->ROL_CVE = $row["ROL_CVE"];
			$this->ROL_NOMBRE = $row["ROL_NOMBRE"];
			$this->PROYECTO_CVE = $row["PROYECTO_CVE"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM crol WHERE ROL_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE crol set ROL_NOMBRE = \"$this->ROL_NOMBRE\", PROYECTO_CVE = \"$this->PROYECTO_CVE\" where ROL_CVE = \"$this->ROL_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into crol (ROL_NOMBRE, PROYECTO_CVE) values (\"$this->ROL_NOMBRE\", \"$this->PROYECTO_CVE\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT ROL_CVE from crol order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["ROL_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return ROL_CVE - int(11)
	 */
	public function getROL_CVE(){
		return $this->ROL_CVE;
	}

	/**
	 * @return ROL_NOMBRE - varchar(20)
	 */
	public function getROL_NOMBRE(){
		return $this->ROL_NOMBRE;
	}

	/**
	 * @return PROYECTO_CVE - int(11)
	 */
	public function getPROYECTO_CVE(){
		return $this->PROYECTO_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setROL_CVE($ROL_CVE){
		$this->ROL_CVE = $ROL_CVE;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setROL_NOMBRE($ROL_NOMBRE){
		$this->ROL_NOMBRE = $ROL_NOMBRE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setPROYECTO_CVE($PROYECTO_CVE){
		$this->PROYECTO_CVE = $PROYECTO_CVE;
	}

    /**
     * Close mysql connection
     */
	public function endcrol(){
		$this->connection->CloseMysql();
	}

}