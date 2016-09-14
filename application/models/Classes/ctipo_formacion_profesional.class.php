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

Class ctipo_formacion_profesional {

	private $TIP_FOR_PROF_CVE; //int(11)
	private $TIP_FOR_PRO_NOMBRE; //varchar(30)
	private $connection;

	public function ctipo_formacion_profesional(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_ctipo_formacion_profesional($TIP_FOR_PRO_NOMBRE){
		$this->TIP_FOR_PRO_NOMBRE = $TIP_FOR_PRO_NOMBRE;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from ctipo_formacion_profesional where TIP_FOR_PROF_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->TIP_FOR_PROF_CVE = $row["TIP_FOR_PROF_CVE"];
			$this->TIP_FOR_PRO_NOMBRE = $row["TIP_FOR_PRO_NOMBRE"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM ctipo_formacion_profesional WHERE TIP_FOR_PROF_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE ctipo_formacion_profesional set TIP_FOR_PRO_NOMBRE = \"$this->TIP_FOR_PRO_NOMBRE\" where TIP_FOR_PROF_CVE = \"$this->TIP_FOR_PROF_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into ctipo_formacion_profesional (TIP_FOR_PRO_NOMBRE) values (\"$this->TIP_FOR_PRO_NOMBRE\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT TIP_FOR_PROF_CVE from ctipo_formacion_profesional order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["TIP_FOR_PROF_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return TIP_FOR_PROF_CVE - int(11)
	 */
	public function getTIP_FOR_PROF_CVE(){
		return $this->TIP_FOR_PROF_CVE;
	}

	/**
	 * @return TIP_FOR_PRO_NOMBRE - varchar(30)
	 */
	public function getTIP_FOR_PRO_NOMBRE(){
		return $this->TIP_FOR_PRO_NOMBRE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTIP_FOR_PROF_CVE($TIP_FOR_PROF_CVE){
		$this->TIP_FOR_PROF_CVE = $TIP_FOR_PROF_CVE;
	}

	/**
	 * @param Type: varchar(30)
	 */
	public function setTIP_FOR_PRO_NOMBRE($TIP_FOR_PRO_NOMBRE){
		$this->TIP_FOR_PRO_NOMBRE = $TIP_FOR_PRO_NOMBRE;
	}

    /**
     * Close mysql connection
     */
	public function endctipo_formacion_profesional(){
		$this->connection->CloseMysql();
	}

}