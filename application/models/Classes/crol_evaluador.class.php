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

Class crol_evaluador {

	private $ROL_EVALUADOR_CVE; //int(11)
	private $CROL_EVALUADOR_NOMBRE; //varchar(20)
	private $ROL_EVA_FIRMA_RUTA; //varchar(300)
	private $connection;

	public function crol_evaluador(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_crol_evaluador($CROL_EVALUADOR_NOMBRE,$ROL_EVA_FIRMA_RUTA){
		$this->CROL_EVALUADOR_NOMBRE = $CROL_EVALUADOR_NOMBRE;
		$this->ROL_EVA_FIRMA_RUTA = $ROL_EVA_FIRMA_RUTA;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from crol_evaluador where ROL_EVALUADOR_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->ROL_EVALUADOR_CVE = $row["ROL_EVALUADOR_CVE"];
			$this->CROL_EVALUADOR_NOMBRE = $row["CROL_EVALUADOR_NOMBRE"];
			$this->ROL_EVA_FIRMA_RUTA = $row["ROL_EVA_FIRMA_RUTA"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM crol_evaluador WHERE ROL_EVALUADOR_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE crol_evaluador set CROL_EVALUADOR_NOMBRE = \"$this->CROL_EVALUADOR_NOMBRE\", ROL_EVA_FIRMA_RUTA = \"$this->ROL_EVA_FIRMA_RUTA\" where ROL_EVALUADOR_CVE = \"$this->ROL_EVALUADOR_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into crol_evaluador (CROL_EVALUADOR_NOMBRE, ROL_EVA_FIRMA_RUTA) values (\"$this->CROL_EVALUADOR_NOMBRE\", \"$this->ROL_EVA_FIRMA_RUTA\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT ROL_EVALUADOR_CVE from crol_evaluador order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["ROL_EVALUADOR_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return ROL_EVALUADOR_CVE - int(11)
	 */
	public function getROL_EVALUADOR_CVE(){
		return $this->ROL_EVALUADOR_CVE;
	}

	/**
	 * @return CROL_EVALUADOR_NOMBRE - varchar(20)
	 */
	public function getCROL_EVALUADOR_NOMBRE(){
		return $this->CROL_EVALUADOR_NOMBRE;
	}

	/**
	 * @return ROL_EVA_FIRMA_RUTA - varchar(300)
	 */
	public function getROL_EVA_FIRMA_RUTA(){
		return $this->ROL_EVA_FIRMA_RUTA;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setROL_EVALUADOR_CVE($ROL_EVALUADOR_CVE){
		$this->ROL_EVALUADOR_CVE = $ROL_EVALUADOR_CVE;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setCROL_EVALUADOR_NOMBRE($CROL_EVALUADOR_NOMBRE){
		$this->CROL_EVALUADOR_NOMBRE = $CROL_EVALUADOR_NOMBRE;
	}

	/**
	 * @param Type: varchar(300)
	 */
	public function setROL_EVA_FIRMA_RUTA($ROL_EVA_FIRMA_RUTA){
		$this->ROL_EVA_FIRMA_RUTA = $ROL_EVA_FIRMA_RUTA;
	}

    /**
     * Close mysql connection
     */
	public function endcrol_evaluador(){
		$this->connection->CloseMysql();
	}

}