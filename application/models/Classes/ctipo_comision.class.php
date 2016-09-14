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

Class ctipo_comision {

	private $TIP_COMISION_CVE; //int(11)
	private $TIP_COM_NOMBRE; //varchar(50)
	private $IS_COMISION_ACADEMICA; //int(10)
	private $connection;

	public function ctipo_comision(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_ctipo_comision($TIP_COM_NOMBRE,$IS_COMISION_ACADEMICA){
		$this->TIP_COM_NOMBRE = $TIP_COM_NOMBRE;
		$this->IS_COMISION_ACADEMICA = $IS_COMISION_ACADEMICA;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from ctipo_comision where TIP_COMISION_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->TIP_COMISION_CVE = $row["TIP_COMISION_CVE"];
			$this->TIP_COM_NOMBRE = $row["TIP_COM_NOMBRE"];
			$this->IS_COMISION_ACADEMICA = $row["IS_COMISION_ACADEMICA"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM ctipo_comision WHERE TIP_COMISION_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE ctipo_comision set TIP_COM_NOMBRE = \"$this->TIP_COM_NOMBRE\", IS_COMISION_ACADEMICA = \"$this->IS_COMISION_ACADEMICA\" where TIP_COMISION_CVE = \"$this->TIP_COMISION_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into ctipo_comision (TIP_COM_NOMBRE, IS_COMISION_ACADEMICA) values (\"$this->TIP_COM_NOMBRE\", \"$this->IS_COMISION_ACADEMICA\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT TIP_COMISION_CVE from ctipo_comision order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["TIP_COMISION_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return TIP_COMISION_CVE - int(11)
	 */
	public function getTIP_COMISION_CVE(){
		return $this->TIP_COMISION_CVE;
	}

	/**
	 * @return TIP_COM_NOMBRE - varchar(50)
	 */
	public function getTIP_COM_NOMBRE(){
		return $this->TIP_COM_NOMBRE;
	}

	/**
	 * @return IS_COMISION_ACADEMICA - int(10)
	 */
	public function getIS_COMISION_ACADEMICA(){
		return $this->IS_COMISION_ACADEMICA;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTIP_COMISION_CVE($TIP_COMISION_CVE){
		$this->TIP_COMISION_CVE = $TIP_COMISION_CVE;
	}

	/**
	 * @param Type: varchar(50)
	 */
	public function setTIP_COM_NOMBRE($TIP_COM_NOMBRE){
		$this->TIP_COM_NOMBRE = $TIP_COM_NOMBRE;
	}

	/**
	 * @param Type: int(10)
	 */
	public function setIS_COMISION_ACADEMICA($IS_COMISION_ACADEMICA){
		$this->IS_COMISION_ACADEMICA = $IS_COMISION_ACADEMICA;
	}

    /**
     * Close mysql connection
     */
	public function endctipo_comision(){
		$this->connection->CloseMysql();
	}

}