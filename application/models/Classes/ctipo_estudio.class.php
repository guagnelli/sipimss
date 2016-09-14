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

Class ctipo_estudio {

	private $TIP_ESTUDIO_CVE; //int(11)
	private $TIP_EST_NOMBRE; //varchar(40)
	private $connection;

	public function ctipo_estudio(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_ctipo_estudio($TIP_EST_NOMBRE){
		$this->TIP_EST_NOMBRE = $TIP_EST_NOMBRE;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from ctipo_estudio where TIP_ESTUDIO_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->TIP_ESTUDIO_CVE = $row["TIP_ESTUDIO_CVE"];
			$this->TIP_EST_NOMBRE = $row["TIP_EST_NOMBRE"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM ctipo_estudio WHERE TIP_ESTUDIO_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE ctipo_estudio set TIP_EST_NOMBRE = \"$this->TIP_EST_NOMBRE\" where TIP_ESTUDIO_CVE = \"$this->TIP_ESTUDIO_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into ctipo_estudio (TIP_EST_NOMBRE) values (\"$this->TIP_EST_NOMBRE\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT TIP_ESTUDIO_CVE from ctipo_estudio order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["TIP_ESTUDIO_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return TIP_ESTUDIO_CVE - int(11)
	 */
	public function getTIP_ESTUDIO_CVE(){
		return $this->TIP_ESTUDIO_CVE;
	}

	/**
	 * @return TIP_EST_NOMBRE - varchar(40)
	 */
	public function getTIP_EST_NOMBRE(){
		return $this->TIP_EST_NOMBRE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTIP_ESTUDIO_CVE($TIP_ESTUDIO_CVE){
		$this->TIP_ESTUDIO_CVE = $TIP_ESTUDIO_CVE;
	}

	/**
	 * @param Type: varchar(40)
	 */
	public function setTIP_EST_NOMBRE($TIP_EST_NOMBRE){
		$this->TIP_EST_NOMBRE = $TIP_EST_NOMBRE;
	}

    /**
     * Close mysql connection
     */
	public function endctipo_estudio(){
		$this->connection->CloseMysql();
	}

}