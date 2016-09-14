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

Class csubtipo_formacion_profesional {

	private $SUB_FOR_PRO_CVE; //int(11)
	private $SUB_FOR_PRO_NOMBRE; //varchar(50)
	private $TIP_FOR_PROF_CVE; //int(11)
	private $connection;

	public function csubtipo_formacion_profesional(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_csubtipo_formacion_profesional($SUB_FOR_PRO_NOMBRE,$TIP_FOR_PROF_CVE){
		$this->SUB_FOR_PRO_NOMBRE = $SUB_FOR_PRO_NOMBRE;
		$this->TIP_FOR_PROF_CVE = $TIP_FOR_PROF_CVE;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from csubtipo_formacion_profesional where SUB_FOR_PRO_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->SUB_FOR_PRO_CVE = $row["SUB_FOR_PRO_CVE"];
			$this->SUB_FOR_PRO_NOMBRE = $row["SUB_FOR_PRO_NOMBRE"];
			$this->TIP_FOR_PROF_CVE = $row["TIP_FOR_PROF_CVE"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM csubtipo_formacion_profesional WHERE SUB_FOR_PRO_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE csubtipo_formacion_profesional set SUB_FOR_PRO_NOMBRE = \"$this->SUB_FOR_PRO_NOMBRE\", TIP_FOR_PROF_CVE = \"$this->TIP_FOR_PROF_CVE\" where SUB_FOR_PRO_CVE = \"$this->SUB_FOR_PRO_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into csubtipo_formacion_profesional (SUB_FOR_PRO_NOMBRE, TIP_FOR_PROF_CVE) values (\"$this->SUB_FOR_PRO_NOMBRE\", \"$this->TIP_FOR_PROF_CVE\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT SUB_FOR_PRO_CVE from csubtipo_formacion_profesional order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["SUB_FOR_PRO_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return SUB_FOR_PRO_CVE - int(11)
	 */
	public function getSUB_FOR_PRO_CVE(){
		return $this->SUB_FOR_PRO_CVE;
	}

	/**
	 * @return SUB_FOR_PRO_NOMBRE - varchar(50)
	 */
	public function getSUB_FOR_PRO_NOMBRE(){
		return $this->SUB_FOR_PRO_NOMBRE;
	}

	/**
	 * @return TIP_FOR_PROF_CVE - int(11)
	 */
	public function getTIP_FOR_PROF_CVE(){
		return $this->TIP_FOR_PROF_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setSUB_FOR_PRO_CVE($SUB_FOR_PRO_CVE){
		$this->SUB_FOR_PRO_CVE = $SUB_FOR_PRO_CVE;
	}

	/**
	 * @param Type: varchar(50)
	 */
	public function setSUB_FOR_PRO_NOMBRE($SUB_FOR_PRO_NOMBRE){
		$this->SUB_FOR_PRO_NOMBRE = $SUB_FOR_PRO_NOMBRE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTIP_FOR_PROF_CVE($TIP_FOR_PROF_CVE){
		$this->TIP_FOR_PROF_CVE = $TIP_FOR_PROF_CVE;
	}

    /**
     * Close mysql connection
     */
	public function endcsubtipo_formacion_profesional(){
		$this->connection->CloseMysql();
	}

}