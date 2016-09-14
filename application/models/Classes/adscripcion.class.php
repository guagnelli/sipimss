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

Class adscripcion {

	private $ADSCRIPCION_CVE; //varchar(20)
	private $ADS_NOM_AREA; //varchar(20)
	private $ADS_NOM_UNIDAD; //varchar(25)
	private $connection;

	public function adscripcion(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_adscripcion($ADS_NOM_AREA,$ADS_NOM_UNIDAD){
		$this->ADS_NOM_AREA = $ADS_NOM_AREA;
		$this->ADS_NOM_UNIDAD = $ADS_NOM_UNIDAD;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from adscripcion where ADSCRIPCION_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->ADSCRIPCION_CVE = $row["ADSCRIPCION_CVE"];
			$this->ADS_NOM_AREA = $row["ADS_NOM_AREA"];
			$this->ADS_NOM_UNIDAD = $row["ADS_NOM_UNIDAD"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM adscripcion WHERE ADSCRIPCION_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE adscripcion set ADS_NOM_AREA = \"$this->ADS_NOM_AREA\", ADS_NOM_UNIDAD = \"$this->ADS_NOM_UNIDAD\" where ADSCRIPCION_CVE = \"$this->ADSCRIPCION_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into adscripcion (ADS_NOM_AREA, ADS_NOM_UNIDAD) values (\"$this->ADS_NOM_AREA\", \"$this->ADS_NOM_UNIDAD\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT ADSCRIPCION_CVE from adscripcion order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["ADSCRIPCION_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return ADSCRIPCION_CVE - varchar(20)
	 */
	public function getADSCRIPCION_CVE(){
		return $this->ADSCRIPCION_CVE;
	}

	/**
	 * @return ADS_NOM_AREA - varchar(20)
	 */
	public function getADS_NOM_AREA(){
		return $this->ADS_NOM_AREA;
	}

	/**
	 * @return ADS_NOM_UNIDAD - varchar(25)
	 */
	public function getADS_NOM_UNIDAD(){
		return $this->ADS_NOM_UNIDAD;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setADSCRIPCION_CVE($ADSCRIPCION_CVE){
		$this->ADSCRIPCION_CVE = $ADSCRIPCION_CVE;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setADS_NOM_AREA($ADS_NOM_AREA){
		$this->ADS_NOM_AREA = $ADS_NOM_AREA;
	}

	/**
	 * @param Type: varchar(25)
	 */
	public function setADS_NOM_UNIDAD($ADS_NOM_UNIDAD){
		$this->ADS_NOM_UNIDAD = $ADS_NOM_UNIDAD;
	}

    /**
     * Close mysql connection
     */
	public function endadscripcion(){
		$this->connection->CloseMysql();
	}

}