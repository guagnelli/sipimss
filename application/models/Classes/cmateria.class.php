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

Class cmateria {

	private $MATERIA_CVE; //int(11)
	private $MATERIA_NOMBRE; //varchar(20)
	private $connection;

	public function cmateria(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_cmateria($MATERIA_NOMBRE){
		$this->MATERIA_NOMBRE = $MATERIA_NOMBRE;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from cmateria where MATERIA_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->MATERIA_CVE = $row["MATERIA_CVE"];
			$this->MATERIA_NOMBRE = $row["MATERIA_NOMBRE"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM cmateria WHERE MATERIA_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE cmateria set MATERIA_NOMBRE = \"$this->MATERIA_NOMBRE\" where MATERIA_CVE = \"$this->MATERIA_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into cmateria (MATERIA_NOMBRE) values (\"$this->MATERIA_NOMBRE\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT MATERIA_CVE from cmateria order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["MATERIA_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return MATERIA_CVE - int(11)
	 */
	public function getMATERIA_CVE(){
		return $this->MATERIA_CVE;
	}

	/**
	 * @return MATERIA_NOMBRE - varchar(20)
	 */
	public function getMATERIA_NOMBRE(){
		return $this->MATERIA_NOMBRE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setMATERIA_CVE($MATERIA_CVE){
		$this->MATERIA_CVE = $MATERIA_CVE;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setMATERIA_NOMBRE($MATERIA_NOMBRE){
		$this->MATERIA_NOMBRE = $MATERIA_NOMBRE;
	}

    /**
     * Close mysql connection
     */
	public function endcmateria(){
		$this->connection->CloseMysql();
	}

}