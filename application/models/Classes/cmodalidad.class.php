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

Class cmodalidad {

	private $MODALIDAD_CVE; //int(11)
	private $MOD_NOMBRE; //varchar(30)
	private $connection;

	public function cmodalidad(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_cmodalidad($MOD_NOMBRE){
		$this->MOD_NOMBRE = $MOD_NOMBRE;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from cmodalidad where MODALIDAD_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->MODALIDAD_CVE = $row["MODALIDAD_CVE"];
			$this->MOD_NOMBRE = $row["MOD_NOMBRE"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM cmodalidad WHERE MODALIDAD_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE cmodalidad set MOD_NOMBRE = \"$this->MOD_NOMBRE\" where MODALIDAD_CVE = \"$this->MODALIDAD_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into cmodalidad (MOD_NOMBRE) values (\"$this->MOD_NOMBRE\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT MODALIDAD_CVE from cmodalidad order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["MODALIDAD_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return MODALIDAD_CVE - int(11)
	 */
	public function getMODALIDAD_CVE(){
		return $this->MODALIDAD_CVE;
	}

	/**
	 * @return MOD_NOMBRE - varchar(30)
	 */
	public function getMOD_NOMBRE(){
		return $this->MOD_NOMBRE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setMODALIDAD_CVE($MODALIDAD_CVE){
		$this->MODALIDAD_CVE = $MODALIDAD_CVE;
	}

	/**
	 * @param Type: varchar(30)
	 */
	public function setMOD_NOMBRE($MOD_NOMBRE){
		$this->MOD_NOMBRE = $MOD_NOMBRE;
	}

    /**
     * Close mysql connection
     */
	public function endcmodalidad(){
		$this->connection->CloseMysql();
	}

}