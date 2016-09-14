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

Class proyecto {

	private $PROYECTO_CVE; //int(11)
	private $PRO_NOMBRE; //varchar(40)
	private $connection;

	public function proyecto(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_proyecto($PRO_NOMBRE){
		$this->PRO_NOMBRE = $PRO_NOMBRE;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from proyecto where PROYECTO_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->PROYECTO_CVE = $row["PROYECTO_CVE"];
			$this->PRO_NOMBRE = $row["PRO_NOMBRE"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM proyecto WHERE PROYECTO_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE proyecto set PRO_NOMBRE = \"$this->PRO_NOMBRE\" where PROYECTO_CVE = \"$this->PROYECTO_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into proyecto (PRO_NOMBRE) values (\"$this->PRO_NOMBRE\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT PROYECTO_CVE from proyecto order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["PROYECTO_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return PROYECTO_CVE - int(11)
	 */
	public function getPROYECTO_CVE(){
		return $this->PROYECTO_CVE;
	}

	/**
	 * @return PRO_NOMBRE - varchar(40)
	 */
	public function getPRO_NOMBRE(){
		return $this->PRO_NOMBRE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setPROYECTO_CVE($PROYECTO_CVE){
		$this->PROYECTO_CVE = $PROYECTO_CVE;
	}

	/**
	 * @param Type: varchar(40)
	 */
	public function setPRO_NOMBRE($PRO_NOMBRE){
		$this->PRO_NOMBRE = $PRO_NOMBRE;
	}

    /**
     * Close mysql connection
     */
	public function endproyecto(){
		$this->connection->CloseMysql();
	}

}