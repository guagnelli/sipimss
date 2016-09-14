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

Class cestado_validacion {

	private $EST_VALIDACION_CVE; //int(11)
	private $EST_VALIDA_DESC; //varchar(50)
	private $connection;

	public function cestado_validacion(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_cestado_validacion($EST_VALIDA_DESC){
		$this->EST_VALIDA_DESC = $EST_VALIDA_DESC;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from cestado_validacion where EST_VALIDACION_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->EST_VALIDACION_CVE = $row["EST_VALIDACION_CVE"];
			$this->EST_VALIDA_DESC = $row["EST_VALIDA_DESC"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM cestado_validacion WHERE EST_VALIDACION_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE cestado_validacion set EST_VALIDA_DESC = \"$this->EST_VALIDA_DESC\" where EST_VALIDACION_CVE = \"$this->EST_VALIDACION_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into cestado_validacion (EST_VALIDA_DESC) values (\"$this->EST_VALIDA_DESC\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT EST_VALIDACION_CVE from cestado_validacion order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["EST_VALIDACION_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return EST_VALIDACION_CVE - int(11)
	 */
	public function getEST_VALIDACION_CVE(){
		return $this->EST_VALIDACION_CVE;
	}

	/**
	 * @return EST_VALIDA_DESC - varchar(50)
	 */
	public function getEST_VALIDA_DESC(){
		return $this->EST_VALIDA_DESC;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setEST_VALIDACION_CVE($EST_VALIDACION_CVE){
		$this->EST_VALIDACION_CVE = $EST_VALIDACION_CVE;
	}

	/**
	 * @param Type: varchar(50)
	 */
	public function setEST_VALIDA_DESC($EST_VALIDA_DESC){
		$this->EST_VALIDA_DESC = $EST_VALIDA_DESC;
	}

    /**
     * Close mysql connection
     */
	public function endcestado_validacion(){
		$this->connection->CloseMysql();
	}

}