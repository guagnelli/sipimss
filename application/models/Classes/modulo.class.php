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

Class modulo {

	private $MODULO_CVE; //int(11)
	private $MOD_NOMBRE; //varchar(50)
	private $MOD_RUTA; //varchar(255)
	private $MOD_EST_CVE; //int(11)
	private $MODULO_CVE_PADRE; //int(11)
	private $IS_CONTROLADOR; //tinyint(1)
	private $ORDEN_MODULO; //int(10)
	private $connection;

	public function modulo(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_modulo($MOD_NOMBRE,$MOD_RUTA,$MOD_EST_CVE,$MODULO_CVE_PADRE,$IS_CONTROLADOR,$ORDEN_MODULO){
		$this->MOD_NOMBRE = $MOD_NOMBRE;
		$this->MOD_RUTA = $MOD_RUTA;
		$this->MOD_EST_CVE = $MOD_EST_CVE;
		$this->MODULO_CVE_PADRE = $MODULO_CVE_PADRE;
		$this->IS_CONTROLADOR = $IS_CONTROLADOR;
		$this->ORDEN_MODULO = $ORDEN_MODULO;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from modulo where MODULO_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->MODULO_CVE = $row["MODULO_CVE"];
			$this->MOD_NOMBRE = $row["MOD_NOMBRE"];
			$this->MOD_RUTA = $row["MOD_RUTA"];
			$this->MOD_EST_CVE = $row["MOD_EST_CVE"];
			$this->MODULO_CVE_PADRE = $row["MODULO_CVE_PADRE"];
			$this->IS_CONTROLADOR = $row["IS_CONTROLADOR"];
			$this->ORDEN_MODULO = $row["ORDEN_MODULO"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM modulo WHERE MODULO_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE modulo set MOD_NOMBRE = \"$this->MOD_NOMBRE\", MOD_RUTA = \"$this->MOD_RUTA\", MOD_EST_CVE = \"$this->MOD_EST_CVE\", MODULO_CVE_PADRE = \"$this->MODULO_CVE_PADRE\", IS_CONTROLADOR = \"$this->IS_CONTROLADOR\", ORDEN_MODULO = \"$this->ORDEN_MODULO\" where MODULO_CVE = \"$this->MODULO_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into modulo (MOD_NOMBRE, MOD_RUTA, MOD_EST_CVE, MODULO_CVE_PADRE, IS_CONTROLADOR, ORDEN_MODULO) values (\"$this->MOD_NOMBRE\", \"$this->MOD_RUTA\", \"$this->MOD_EST_CVE\", \"$this->MODULO_CVE_PADRE\", \"$this->IS_CONTROLADOR\", \"$this->ORDEN_MODULO\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT MODULO_CVE from modulo order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["MODULO_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return MODULO_CVE - int(11)
	 */
	public function getMODULO_CVE(){
		return $this->MODULO_CVE;
	}

	/**
	 * @return MOD_NOMBRE - varchar(50)
	 */
	public function getMOD_NOMBRE(){
		return $this->MOD_NOMBRE;
	}

	/**
	 * @return MOD_RUTA - varchar(255)
	 */
	public function getMOD_RUTA(){
		return $this->MOD_RUTA;
	}

	/**
	 * @return MOD_EST_CVE - int(11)
	 */
	public function getMOD_EST_CVE(){
		return $this->MOD_EST_CVE;
	}

	/**
	 * @return MODULO_CVE_PADRE - int(11)
	 */
	public function getMODULO_CVE_PADRE(){
		return $this->MODULO_CVE_PADRE;
	}

	/**
	 * @return IS_CONTROLADOR - tinyint(1)
	 */
	public function getIS_CONTROLADOR(){
		return $this->IS_CONTROLADOR;
	}

	/**
	 * @return ORDEN_MODULO - int(10)
	 */
	public function getORDEN_MODULO(){
		return $this->ORDEN_MODULO;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setMODULO_CVE($MODULO_CVE){
		$this->MODULO_CVE = $MODULO_CVE;
	}

	/**
	 * @param Type: varchar(50)
	 */
	public function setMOD_NOMBRE($MOD_NOMBRE){
		$this->MOD_NOMBRE = $MOD_NOMBRE;
	}

	/**
	 * @param Type: varchar(255)
	 */
	public function setMOD_RUTA($MOD_RUTA){
		$this->MOD_RUTA = $MOD_RUTA;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setMOD_EST_CVE($MOD_EST_CVE){
		$this->MOD_EST_CVE = $MOD_EST_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setMODULO_CVE_PADRE($MODULO_CVE_PADRE){
		$this->MODULO_CVE_PADRE = $MODULO_CVE_PADRE;
	}

	/**
	 * @param Type: tinyint(1)
	 */
	public function setIS_CONTROLADOR($IS_CONTROLADOR){
		$this->IS_CONTROLADOR = $IS_CONTROLADOR;
	}

	/**
	 * @param Type: int(10)
	 */
	public function setORDEN_MODULO($ORDEN_MODULO){
		$this->ORDEN_MODULO = $ORDEN_MODULO;
	}

    /**
     * Close mysql connection
     */
	public function endmodulo(){
		$this->connection->CloseMysql();
	}

}