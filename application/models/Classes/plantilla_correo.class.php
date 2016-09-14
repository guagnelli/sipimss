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

Class plantilla_correo {

	private $PLAN_CORREO_CVE; //int(11)
	private $PLA_COR_DESCRIPCION; //varchar(200)
	private $PLA_COR_VARIABLES; //varchar(200)
	private $PLA_COR_ASUNTO; //varchar(200)
	private $PLA_COR_MENSAJE; //mediumtext
	private $ROL_CVE_REMITENTE; //int(11)
	private $ROL_CVE; //int(11)
	private $MODULO_CVE; //int(11)
	private $connection;

	public function plantilla_correo(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_plantilla_correo($PLA_COR_DESCRIPCION,$PLA_COR_VARIABLES,$PLA_COR_ASUNTO,$PLA_COR_MENSAJE,$ROL_CVE_REMITENTE,$ROL_CVE,$MODULO_CVE){
		$this->PLA_COR_DESCRIPCION = $PLA_COR_DESCRIPCION;
		$this->PLA_COR_VARIABLES = $PLA_COR_VARIABLES;
		$this->PLA_COR_ASUNTO = $PLA_COR_ASUNTO;
		$this->PLA_COR_MENSAJE = $PLA_COR_MENSAJE;
		$this->ROL_CVE_REMITENTE = $ROL_CVE_REMITENTE;
		$this->ROL_CVE = $ROL_CVE;
		$this->MODULO_CVE = $MODULO_CVE;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from plantilla_correo where PLAN_CORREO_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->PLAN_CORREO_CVE = $row["PLAN_CORREO_CVE"];
			$this->PLA_COR_DESCRIPCION = $row["PLA_COR_DESCRIPCION"];
			$this->PLA_COR_VARIABLES = $row["PLA_COR_VARIABLES"];
			$this->PLA_COR_ASUNTO = $row["PLA_COR_ASUNTO"];
			$this->PLA_COR_MENSAJE = $row["PLA_COR_MENSAJE"];
			$this->ROL_CVE_REMITENTE = $row["ROL_CVE_REMITENTE"];
			$this->ROL_CVE = $row["ROL_CVE"];
			$this->MODULO_CVE = $row["MODULO_CVE"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM plantilla_correo WHERE PLAN_CORREO_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE plantilla_correo set PLA_COR_DESCRIPCION = \"$this->PLA_COR_DESCRIPCION\", PLA_COR_VARIABLES = \"$this->PLA_COR_VARIABLES\", PLA_COR_ASUNTO = \"$this->PLA_COR_ASUNTO\", PLA_COR_MENSAJE = \"$this->PLA_COR_MENSAJE\", ROL_CVE_REMITENTE = \"$this->ROL_CVE_REMITENTE\", ROL_CVE = \"$this->ROL_CVE\", MODULO_CVE = \"$this->MODULO_CVE\" where PLAN_CORREO_CVE = \"$this->PLAN_CORREO_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into plantilla_correo (PLA_COR_DESCRIPCION, PLA_COR_VARIABLES, PLA_COR_ASUNTO, PLA_COR_MENSAJE, ROL_CVE_REMITENTE, ROL_CVE, MODULO_CVE) values (\"$this->PLA_COR_DESCRIPCION\", \"$this->PLA_COR_VARIABLES\", \"$this->PLA_COR_ASUNTO\", \"$this->PLA_COR_MENSAJE\", \"$this->ROL_CVE_REMITENTE\", \"$this->ROL_CVE\", \"$this->MODULO_CVE\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT PLAN_CORREO_CVE from plantilla_correo order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["PLAN_CORREO_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return PLAN_CORREO_CVE - int(11)
	 */
	public function getPLAN_CORREO_CVE(){
		return $this->PLAN_CORREO_CVE;
	}

	/**
	 * @return PLA_COR_DESCRIPCION - varchar(200)
	 */
	public function getPLA_COR_DESCRIPCION(){
		return $this->PLA_COR_DESCRIPCION;
	}

	/**
	 * @return PLA_COR_VARIABLES - varchar(200)
	 */
	public function getPLA_COR_VARIABLES(){
		return $this->PLA_COR_VARIABLES;
	}

	/**
	 * @return PLA_COR_ASUNTO - varchar(200)
	 */
	public function getPLA_COR_ASUNTO(){
		return $this->PLA_COR_ASUNTO;
	}

	/**
	 * @return PLA_COR_MENSAJE - mediumtext
	 */
	public function getPLA_COR_MENSAJE(){
		return $this->PLA_COR_MENSAJE;
	}

	/**
	 * @return ROL_CVE_REMITENTE - int(11)
	 */
	public function getROL_CVE_REMITENTE(){
		return $this->ROL_CVE_REMITENTE;
	}

	/**
	 * @return ROL_CVE - int(11)
	 */
	public function getROL_CVE(){
		return $this->ROL_CVE;
	}

	/**
	 * @return MODULO_CVE - int(11)
	 */
	public function getMODULO_CVE(){
		return $this->MODULO_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setPLAN_CORREO_CVE($PLAN_CORREO_CVE){
		$this->PLAN_CORREO_CVE = $PLAN_CORREO_CVE;
	}

	/**
	 * @param Type: varchar(200)
	 */
	public function setPLA_COR_DESCRIPCION($PLA_COR_DESCRIPCION){
		$this->PLA_COR_DESCRIPCION = $PLA_COR_DESCRIPCION;
	}

	/**
	 * @param Type: varchar(200)
	 */
	public function setPLA_COR_VARIABLES($PLA_COR_VARIABLES){
		$this->PLA_COR_VARIABLES = $PLA_COR_VARIABLES;
	}

	/**
	 * @param Type: varchar(200)
	 */
	public function setPLA_COR_ASUNTO($PLA_COR_ASUNTO){
		$this->PLA_COR_ASUNTO = $PLA_COR_ASUNTO;
	}

	/**
	 * @param Type: mediumtext
	 */
	public function setPLA_COR_MENSAJE($PLA_COR_MENSAJE){
		$this->PLA_COR_MENSAJE = $PLA_COR_MENSAJE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setROL_CVE_REMITENTE($ROL_CVE_REMITENTE){
		$this->ROL_CVE_REMITENTE = $ROL_CVE_REMITENTE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setROL_CVE($ROL_CVE){
		$this->ROL_CVE = $ROL_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setMODULO_CVE($MODULO_CVE){
		$this->MODULO_CVE = $MODULO_CVE;
	}

    /**
     * Close mysql connection
     */
	public function endplantilla_correo(){
		$this->connection->CloseMysql();
	}

}