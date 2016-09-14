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

Class cestado_solicitud_evauacion {

	private $CESE_CVE; //int(11)
	private $CESE_NOMBRE; //varchar(50)
	private $connection;

	public function cestado_solicitud_evauacion(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_cestado_solicitud_evauacion($CESE_NOMBRE){
		$this->CESE_NOMBRE = $CESE_NOMBRE;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from cestado_solicitud_evauacion where CESE_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->CESE_CVE = $row["CESE_CVE"];
			$this->CESE_NOMBRE = $row["CESE_NOMBRE"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM cestado_solicitud_evauacion WHERE CESE_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE cestado_solicitud_evauacion set CESE_NOMBRE = \"$this->CESE_NOMBRE\" where CESE_CVE = \"$this->CESE_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into cestado_solicitud_evauacion (CESE_NOMBRE) values (\"$this->CESE_NOMBRE\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT CESE_CVE from cestado_solicitud_evauacion order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["CESE_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return CESE_CVE - int(11)
	 */
	public function getCESE_CVE(){
		return $this->CESE_CVE;
	}

	/**
	 * @return CESE_NOMBRE - varchar(50)
	 */
	public function getCESE_NOMBRE(){
		return $this->CESE_NOMBRE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setCESE_CVE($CESE_CVE){
		$this->CESE_CVE = $CESE_CVE;
	}

	/**
	 * @param Type: varchar(50)
	 */
	public function setCESE_NOMBRE($CESE_NOMBRE){
		$this->CESE_NOMBRE = $CESE_NOMBRE;
	}

    /**
     * Close mysql connection
     */
	public function endcestado_solicitud_evauacion(){
		$this->connection->CloseMysql();
	}

}