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

Class ctipo_curso {

	private $TIP_CURSO_CVE; //int(11)
	private $TIP_CUR_NOMBRE; //varchar(40)
	private $connection;

	public function ctipo_curso(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_ctipo_curso($TIP_CUR_NOMBRE){
		$this->TIP_CUR_NOMBRE = $TIP_CUR_NOMBRE;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from ctipo_curso where TIP_CURSO_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->TIP_CURSO_CVE = $row["TIP_CURSO_CVE"];
			$this->TIP_CUR_NOMBRE = $row["TIP_CUR_NOMBRE"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM ctipo_curso WHERE TIP_CURSO_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE ctipo_curso set TIP_CUR_NOMBRE = \"$this->TIP_CUR_NOMBRE\" where TIP_CURSO_CVE = \"$this->TIP_CURSO_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into ctipo_curso (TIP_CUR_NOMBRE) values (\"$this->TIP_CUR_NOMBRE\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT TIP_CURSO_CVE from ctipo_curso order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["TIP_CURSO_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return TIP_CURSO_CVE - int(11)
	 */
	public function getTIP_CURSO_CVE(){
		return $this->TIP_CURSO_CVE;
	}

	/**
	 * @return TIP_CUR_NOMBRE - varchar(40)
	 */
	public function getTIP_CUR_NOMBRE(){
		return $this->TIP_CUR_NOMBRE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTIP_CURSO_CVE($TIP_CURSO_CVE){
		$this->TIP_CURSO_CVE = $TIP_CURSO_CVE;
	}

	/**
	 * @param Type: varchar(40)
	 */
	public function setTIP_CUR_NOMBRE($TIP_CUR_NOMBRE){
		$this->TIP_CUR_NOMBRE = $TIP_CUR_NOMBRE;
	}

    /**
     * Close mysql connection
     */
	public function endctipo_curso(){
		$this->connection->CloseMysql();
	}

}