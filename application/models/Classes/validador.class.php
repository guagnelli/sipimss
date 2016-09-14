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

Class validador {

	private $VALIDADOR_CVE; //int(11)
	private $EMPLEADO_CVE; //int(11)
	private $ROL_CVE; //int(11)
	private $DELEGACION_CVE; //char(2)
	private $DEPARTAMENTO_CVE; //char(10)
	private $VAL_ESTADO; //decimal(1,0)
	private $fch_insert; //datetime
	private $connection;

	public function validador(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_validador($EMPLEADO_CVE,$ROL_CVE,$DELEGACION_CVE,$DEPARTAMENTO_CVE,$VAL_ESTADO,$fch_insert){
		$this->EMPLEADO_CVE = $EMPLEADO_CVE;
		$this->ROL_CVE = $ROL_CVE;
		$this->DELEGACION_CVE = $DELEGACION_CVE;
		$this->DEPARTAMENTO_CVE = $DEPARTAMENTO_CVE;
		$this->VAL_ESTADO = $VAL_ESTADO;
		$this->fch_insert = $fch_insert;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from validador where VALIDADOR_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->VALIDADOR_CVE = $row["VALIDADOR_CVE"];
			$this->EMPLEADO_CVE = $row["EMPLEADO_CVE"];
			$this->ROL_CVE = $row["ROL_CVE"];
			$this->DELEGACION_CVE = $row["DELEGACION_CVE"];
			$this->DEPARTAMENTO_CVE = $row["DEPARTAMENTO_CVE"];
			$this->VAL_ESTADO = $row["VAL_ESTADO"];
			$this->fch_insert = $row["fch_insert"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM validador WHERE VALIDADOR_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE validador set EMPLEADO_CVE = \"$this->EMPLEADO_CVE\", ROL_CVE = \"$this->ROL_CVE\", DELEGACION_CVE = \"$this->DELEGACION_CVE\", DEPARTAMENTO_CVE = \"$this->DEPARTAMENTO_CVE\", VAL_ESTADO = \"$this->VAL_ESTADO\", fch_insert = \"$this->fch_insert\" where VALIDADOR_CVE = \"$this->VALIDADOR_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into validador (EMPLEADO_CVE, ROL_CVE, DELEGACION_CVE, DEPARTAMENTO_CVE, VAL_ESTADO, fch_insert) values (\"$this->EMPLEADO_CVE\", \"$this->ROL_CVE\", \"$this->DELEGACION_CVE\", \"$this->DEPARTAMENTO_CVE\", \"$this->VAL_ESTADO\", \"$this->fch_insert\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT VALIDADOR_CVE from validador order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["VALIDADOR_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return VALIDADOR_CVE - int(11)
	 */
	public function getVALIDADOR_CVE(){
		return $this->VALIDADOR_CVE;
	}

	/**
	 * @return EMPLEADO_CVE - int(11)
	 */
	public function getEMPLEADO_CVE(){
		return $this->EMPLEADO_CVE;
	}

	/**
	 * @return ROL_CVE - int(11)
	 */
	public function getROL_CVE(){
		return $this->ROL_CVE;
	}

	/**
	 * @return DELEGACION_CVE - char(2)
	 */
	public function getDELEGACION_CVE(){
		return $this->DELEGACION_CVE;
	}

	/**
	 * @return DEPARTAMENTO_CVE - char(10)
	 */
	public function getDEPARTAMENTO_CVE(){
		return $this->DEPARTAMENTO_CVE;
	}

	/**
	 * @return VAL_ESTADO - decimal(1,0)
	 */
	public function getVAL_ESTADO(){
		return $this->VAL_ESTADO;
	}

	/**
	 * @return fch_insert - datetime
	 */
	public function getfch_insert(){
		return $this->fch_insert;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setVALIDADOR_CVE($VALIDADOR_CVE){
		$this->VALIDADOR_CVE = $VALIDADOR_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setEMPLEADO_CVE($EMPLEADO_CVE){
		$this->EMPLEADO_CVE = $EMPLEADO_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setROL_CVE($ROL_CVE){
		$this->ROL_CVE = $ROL_CVE;
	}

	/**
	 * @param Type: char(2)
	 */
	public function setDELEGACION_CVE($DELEGACION_CVE){
		$this->DELEGACION_CVE = $DELEGACION_CVE;
	}

	/**
	 * @param Type: char(10)
	 */
	public function setDEPARTAMENTO_CVE($DEPARTAMENTO_CVE){
		$this->DEPARTAMENTO_CVE = $DEPARTAMENTO_CVE;
	}

	/**
	 * @param Type: decimal(1,0)
	 */
	public function setVAL_ESTADO($VAL_ESTADO){
		$this->VAL_ESTADO = $VAL_ESTADO;
	}

	/**
	 * @param Type: datetime
	 */
	public function setfch_insert($fch_insert){
		$this->fch_insert = $fch_insert;
	}

    /**
     * Close mysql connection
     */
	public function endvalidador(){
		$this->connection->CloseMysql();
	}

}