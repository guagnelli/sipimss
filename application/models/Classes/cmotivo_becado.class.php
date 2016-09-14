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

Class cmotivo_becado {

	private $MOTIVO_BECADO_CVE; //int(11)
	private $MOT_BEC_NOMBRE; //varchar(30)
	private $connection;

	public function cmotivo_becado(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_cmotivo_becado($MOT_BEC_NOMBRE){
		$this->MOT_BEC_NOMBRE = $MOT_BEC_NOMBRE;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from cmotivo_becado where MOTIVO_BECADO_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->MOTIVO_BECADO_CVE = $row["MOTIVO_BECADO_CVE"];
			$this->MOT_BEC_NOMBRE = $row["MOT_BEC_NOMBRE"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM cmotivo_becado WHERE MOTIVO_BECADO_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE cmotivo_becado set MOT_BEC_NOMBRE = \"$this->MOT_BEC_NOMBRE\" where MOTIVO_BECADO_CVE = \"$this->MOTIVO_BECADO_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into cmotivo_becado (MOT_BEC_NOMBRE) values (\"$this->MOT_BEC_NOMBRE\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT MOTIVO_BECADO_CVE from cmotivo_becado order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["MOTIVO_BECADO_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return MOTIVO_BECADO_CVE - int(11)
	 */
	public function getMOTIVO_BECADO_CVE(){
		return $this->MOTIVO_BECADO_CVE;
	}

	/**
	 * @return MOT_BEC_NOMBRE - varchar(30)
	 */
	public function getMOT_BEC_NOMBRE(){
		return $this->MOT_BEC_NOMBRE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setMOTIVO_BECADO_CVE($MOTIVO_BECADO_CVE){
		$this->MOTIVO_BECADO_CVE = $MOTIVO_BECADO_CVE;
	}

	/**
	 * @param Type: varchar(30)
	 */
	public function setMOT_BEC_NOMBRE($MOT_BEC_NOMBRE){
		$this->MOT_BEC_NOMBRE = $MOT_BEC_NOMBRE;
	}

    /**
     * Close mysql connection
     */
	public function endcmotivo_becado(){
		$this->connection->CloseMysql();
	}

}