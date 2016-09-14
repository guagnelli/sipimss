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

Class ctipo_unidad_adscripcion {

	private $TIPO_UNIDAD_ADSCRIPCION_CVE; //int(11)
	private $DESCRIPCION_TIPO_UNIDAD; //varchar(30)
	private $connection;

	public function ctipo_unidad_adscripcion(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_ctipo_unidad_adscripcion($DESCRIPCION_TIPO_UNIDAD){
		$this->DESCRIPCION_TIPO_UNIDAD = $DESCRIPCION_TIPO_UNIDAD;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from ctipo_unidad_adscripcion where TIPO_UNIDAD_ADSCRIPCION_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->TIPO_UNIDAD_ADSCRIPCION_CVE = $row["TIPO_UNIDAD_ADSCRIPCION_CVE"];
			$this->DESCRIPCION_TIPO_UNIDAD = $row["DESCRIPCION_TIPO_UNIDAD"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM ctipo_unidad_adscripcion WHERE TIPO_UNIDAD_ADSCRIPCION_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE ctipo_unidad_adscripcion set DESCRIPCION_TIPO_UNIDAD = \"$this->DESCRIPCION_TIPO_UNIDAD\" where TIPO_UNIDAD_ADSCRIPCION_CVE = \"$this->TIPO_UNIDAD_ADSCRIPCION_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into ctipo_unidad_adscripcion (DESCRIPCION_TIPO_UNIDAD) values (\"$this->DESCRIPCION_TIPO_UNIDAD\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT TIPO_UNIDAD_ADSCRIPCION_CVE from ctipo_unidad_adscripcion order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["TIPO_UNIDAD_ADSCRIPCION_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return TIPO_UNIDAD_ADSCRIPCION_CVE - int(11)
	 */
	public function getTIPO_UNIDAD_ADSCRIPCION_CVE(){
		return $this->TIPO_UNIDAD_ADSCRIPCION_CVE;
	}

	/**
	 * @return DESCRIPCION_TIPO_UNIDAD - varchar(30)
	 */
	public function getDESCRIPCION_TIPO_UNIDAD(){
		return $this->DESCRIPCION_TIPO_UNIDAD;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTIPO_UNIDAD_ADSCRIPCION_CVE($TIPO_UNIDAD_ADSCRIPCION_CVE){
		$this->TIPO_UNIDAD_ADSCRIPCION_CVE = $TIPO_UNIDAD_ADSCRIPCION_CVE;
	}

	/**
	 * @param Type: varchar(30)
	 */
	public function setDESCRIPCION_TIPO_UNIDAD($DESCRIPCION_TIPO_UNIDAD){
		$this->DESCRIPCION_TIPO_UNIDAD = $DESCRIPCION_TIPO_UNIDAD;
	}

    /**
     * Close mysql connection
     */
	public function endctipo_unidad_adscripcion(){
		$this->connection->CloseMysql();
	}

}