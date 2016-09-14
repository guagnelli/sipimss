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

Class evaluacion_solicitud {

	private $VALIDACION_COMPLETA; //blob
	private $VALIDACION_CVE; //int(11)
	private $EMPLEADO_CVE; //int(11)
	private $fch_evaluacion_update; //timestamp
	private $FCH_REGISTRO_VALIDADOR; //datetime
	private $CESE_CVE; //int(11)
	private $connection;

	public function evaluacion_solicitud(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_evaluacion_solicitud($VALIDACION_COMPLETA,$EMPLEADO_CVE,$fch_evaluacion_update,$FCH_REGISTRO_VALIDADOR,$CESE_CVE){
		$this->VALIDACION_COMPLETA = $VALIDACION_COMPLETA;
		$this->EMPLEADO_CVE = $EMPLEADO_CVE;
		$this->fch_evaluacion_update = $fch_evaluacion_update;
		$this->FCH_REGISTRO_VALIDADOR = $FCH_REGISTRO_VALIDADOR;
		$this->CESE_CVE = $CESE_CVE;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from evaluacion_solicitud where VALIDACION_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->VALIDACION_COMPLETA = $row["VALIDACION_COMPLETA"];
			$this->VALIDACION_CVE = $row["VALIDACION_CVE"];
			$this->EMPLEADO_CVE = $row["EMPLEADO_CVE"];
			$this->fch_evaluacion_update = $row["fch_evaluacion_update"];
			$this->FCH_REGISTRO_VALIDADOR = $row["FCH_REGISTRO_VALIDADOR"];
			$this->CESE_CVE = $row["CESE_CVE"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM evaluacion_solicitud WHERE VALIDACION_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE evaluacion_solicitud set VALIDACION_COMPLETA = \"$this->VALIDACION_COMPLETA\", EMPLEADO_CVE = \"$this->EMPLEADO_CVE\", fch_evaluacion_update = \"$this->fch_evaluacion_update\", FCH_REGISTRO_VALIDADOR = \"$this->FCH_REGISTRO_VALIDADOR\", CESE_CVE = \"$this->CESE_CVE\" where VALIDACION_CVE = \"$this->VALIDACION_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into evaluacion_solicitud (VALIDACION_COMPLETA, EMPLEADO_CVE, fch_evaluacion_update, FCH_REGISTRO_VALIDADOR, CESE_CVE) values (\"$this->VALIDACION_COMPLETA\", \"$this->EMPLEADO_CVE\", \"$this->fch_evaluacion_update\", \"$this->FCH_REGISTRO_VALIDADOR\", \"$this->CESE_CVE\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT VALIDACION_CVE from evaluacion_solicitud order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["VALIDACION_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return VALIDACION_COMPLETA - blob
	 */
	public function getVALIDACION_COMPLETA(){
		return $this->VALIDACION_COMPLETA;
	}

	/**
	 * @return VALIDACION_CVE - int(11)
	 */
	public function getVALIDACION_CVE(){
		return $this->VALIDACION_CVE;
	}

	/**
	 * @return EMPLEADO_CVE - int(11)
	 */
	public function getEMPLEADO_CVE(){
		return $this->EMPLEADO_CVE;
	}

	/**
	 * @return fch_evaluacion_update - timestamp
	 */
	public function getfch_evaluacion_update(){
		return $this->fch_evaluacion_update;
	}

	/**
	 * @return FCH_REGISTRO_VALIDADOR - datetime
	 */
	public function getFCH_REGISTRO_VALIDADOR(){
		return $this->FCH_REGISTRO_VALIDADOR;
	}

	/**
	 * @return CESE_CVE - int(11)
	 */
	public function getCESE_CVE(){
		return $this->CESE_CVE;
	}

	/**
	 * @param Type: blob
	 */
	public function setVALIDACION_COMPLETA($VALIDACION_COMPLETA){
		$this->VALIDACION_COMPLETA = $VALIDACION_COMPLETA;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setVALIDACION_CVE($VALIDACION_CVE){
		$this->VALIDACION_CVE = $VALIDACION_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setEMPLEADO_CVE($EMPLEADO_CVE){
		$this->EMPLEADO_CVE = $EMPLEADO_CVE;
	}

	/**
	 * @param Type: timestamp
	 */
	public function setfch_evaluacion_update($fch_evaluacion_update){
		$this->fch_evaluacion_update = $fch_evaluacion_update;
	}

	/**
	 * @param Type: datetime
	 */
	public function setFCH_REGISTRO_VALIDADOR($FCH_REGISTRO_VALIDADOR){
		$this->FCH_REGISTRO_VALIDADOR = $FCH_REGISTRO_VALIDADOR;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setCESE_CVE($CESE_CVE){
		$this->CESE_CVE = $CESE_CVE;
	}

    /**
     * Close mysql connection
     */
	public function endevaluacion_solicitud(){
		$this->connection->CloseMysql();
	}

}