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

Class cestado_dictamen {

	private $ESTADO_DICTAMEN_CVE; //int(11)
	private $EST_DIC_NOMBRE; //varchar(20)
	private $connection;

	public function cestado_dictamen(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_cestado_dictamen($EST_DIC_NOMBRE){
		$this->EST_DIC_NOMBRE = $EST_DIC_NOMBRE;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from cestado_dictamen where ESTADO_DICTAMEN_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->ESTADO_DICTAMEN_CVE = $row["ESTADO_DICTAMEN_CVE"];
			$this->EST_DIC_NOMBRE = $row["EST_DIC_NOMBRE"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM cestado_dictamen WHERE ESTADO_DICTAMEN_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE cestado_dictamen set EST_DIC_NOMBRE = \"$this->EST_DIC_NOMBRE\" where ESTADO_DICTAMEN_CVE = \"$this->ESTADO_DICTAMEN_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into cestado_dictamen (EST_DIC_NOMBRE) values (\"$this->EST_DIC_NOMBRE\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT ESTADO_DICTAMEN_CVE from cestado_dictamen order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["ESTADO_DICTAMEN_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return ESTADO_DICTAMEN_CVE - int(11)
	 */
	public function getESTADO_DICTAMEN_CVE(){
		return $this->ESTADO_DICTAMEN_CVE;
	}

	/**
	 * @return EST_DIC_NOMBRE - varchar(20)
	 */
	public function getEST_DIC_NOMBRE(){
		return $this->EST_DIC_NOMBRE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setESTADO_DICTAMEN_CVE($ESTADO_DICTAMEN_CVE){
		$this->ESTADO_DICTAMEN_CVE = $ESTADO_DICTAMEN_CVE;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setEST_DIC_NOMBRE($EST_DIC_NOMBRE){
		$this->EST_DIC_NOMBRE = $EST_DIC_NOMBRE;
	}

    /**
     * Close mysql connection
     */
	public function endcestado_dictamen(){
		$this->connection->CloseMysql();
	}

}