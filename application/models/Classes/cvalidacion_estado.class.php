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

Class cvalidacion_estado {

	private $VAL_ESTADO_CVE; //int(11)
	private $VAL_EST_NOMBRE; //char(50)
	private $connection;

	public function cvalidacion_estado(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_cvalidacion_estado($VAL_EST_NOMBRE){
		$this->VAL_EST_NOMBRE = $VAL_EST_NOMBRE;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from cvalidacion_estado where VAL_ESTADO_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->VAL_ESTADO_CVE = $row["VAL_ESTADO_CVE"];
			$this->VAL_EST_NOMBRE = $row["VAL_EST_NOMBRE"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM cvalidacion_estado WHERE VAL_ESTADO_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE cvalidacion_estado set VAL_EST_NOMBRE = \"$this->VAL_EST_NOMBRE\" where VAL_ESTADO_CVE = \"$this->VAL_ESTADO_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into cvalidacion_estado (VAL_EST_NOMBRE) values (\"$this->VAL_EST_NOMBRE\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT VAL_ESTADO_CVE from cvalidacion_estado order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["VAL_ESTADO_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return VAL_ESTADO_CVE - int(11)
	 */
	public function getVAL_ESTADO_CVE(){
		return $this->VAL_ESTADO_CVE;
	}

	/**
	 * @return VAL_EST_NOMBRE - char(50)
	 */
	public function getVAL_EST_NOMBRE(){
		return $this->VAL_EST_NOMBRE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setVAL_ESTADO_CVE($VAL_ESTADO_CVE){
		$this->VAL_ESTADO_CVE = $VAL_ESTADO_CVE;
	}

	/**
	 * @param Type: char(50)
	 */
	public function setVAL_EST_NOMBRE($VAL_EST_NOMBRE){
		$this->VAL_EST_NOMBRE = $VAL_EST_NOMBRE;
	}

    /**
     * Close mysql connection
     */
	public function endcvalidacion_estado(){
		$this->connection->CloseMysql();
	}

}