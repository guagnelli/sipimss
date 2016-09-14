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

Class cestado_evaluacion {

	private $EST_EVALUACION_CVE; //int(11)
	private $EST_EVA_NOMBRE; //varchar(50)
	private $connection;

	public function cestado_evaluacion(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_cestado_evaluacion($EST_EVA_NOMBRE){
		$this->EST_EVA_NOMBRE = $EST_EVA_NOMBRE;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from cestado_evaluacion where EST_EVALUACION_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->EST_EVALUACION_CVE = $row["EST_EVALUACION_CVE"];
			$this->EST_EVA_NOMBRE = $row["EST_EVA_NOMBRE"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM cestado_evaluacion WHERE EST_EVALUACION_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE cestado_evaluacion set EST_EVA_NOMBRE = \"$this->EST_EVA_NOMBRE\" where EST_EVALUACION_CVE = \"$this->EST_EVALUACION_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into cestado_evaluacion (EST_EVA_NOMBRE) values (\"$this->EST_EVA_NOMBRE\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT EST_EVALUACION_CVE from cestado_evaluacion order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["EST_EVALUACION_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return EST_EVALUACION_CVE - int(11)
	 */
	public function getEST_EVALUACION_CVE(){
		return $this->EST_EVALUACION_CVE;
	}

	/**
	 * @return EST_EVA_NOMBRE - varchar(50)
	 */
	public function getEST_EVA_NOMBRE(){
		return $this->EST_EVA_NOMBRE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setEST_EVALUACION_CVE($EST_EVALUACION_CVE){
		$this->EST_EVALUACION_CVE = $EST_EVALUACION_CVE;
	}

	/**
	 * @param Type: varchar(50)
	 */
	public function setEST_EVA_NOMBRE($EST_EVA_NOMBRE){
		$this->EST_EVA_NOMBRE = $EST_EVA_NOMBRE;
	}

    /**
     * Close mysql connection
     */
	public function endcestado_evaluacion(){
		$this->connection->CloseMysql();
	}

}