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

Class ctipo_especialidad {

	private $TIP_ESP_MEDICA_CVE; //int(11)
	private $TIP_ESP_MED_NOMBRE; //varchar(70)
	private $connection;

	public function ctipo_especialidad(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_ctipo_especialidad($TIP_ESP_MED_NOMBRE){
		$this->TIP_ESP_MED_NOMBRE = $TIP_ESP_MED_NOMBRE;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from ctipo_especialidad where TIP_ESP_MEDICA_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->TIP_ESP_MEDICA_CVE = $row["TIP_ESP_MEDICA_CVE"];
			$this->TIP_ESP_MED_NOMBRE = $row["TIP_ESP_MED_NOMBRE"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM ctipo_especialidad WHERE TIP_ESP_MEDICA_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE ctipo_especialidad set TIP_ESP_MED_NOMBRE = \"$this->TIP_ESP_MED_NOMBRE\" where TIP_ESP_MEDICA_CVE = \"$this->TIP_ESP_MEDICA_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into ctipo_especialidad (TIP_ESP_MED_NOMBRE) values (\"$this->TIP_ESP_MED_NOMBRE\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT TIP_ESP_MEDICA_CVE from ctipo_especialidad order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["TIP_ESP_MEDICA_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return TIP_ESP_MEDICA_CVE - int(11)
	 */
	public function getTIP_ESP_MEDICA_CVE(){
		return $this->TIP_ESP_MEDICA_CVE;
	}

	/**
	 * @return TIP_ESP_MED_NOMBRE - varchar(70)
	 */
	public function getTIP_ESP_MED_NOMBRE(){
		return $this->TIP_ESP_MED_NOMBRE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTIP_ESP_MEDICA_CVE($TIP_ESP_MEDICA_CVE){
		$this->TIP_ESP_MEDICA_CVE = $TIP_ESP_MEDICA_CVE;
	}

	/**
	 * @param Type: varchar(70)
	 */
	public function setTIP_ESP_MED_NOMBRE($TIP_ESP_MED_NOMBRE){
		$this->TIP_ESP_MED_NOMBRE = $TIP_ESP_MED_NOMBRE;
	}

    /**
     * Close mysql connection
     */
	public function endctipo_especialidad(){
		$this->connection->CloseMysql();
	}

}