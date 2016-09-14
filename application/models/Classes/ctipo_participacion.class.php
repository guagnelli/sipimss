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

Class ctipo_participacion {

	private $TIP_PARTICIPACION_CVE; //int(11)
	private $TIP_PAR_NOMBRE; //varchar(20)
	private $connection;

	public function ctipo_participacion(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_ctipo_participacion($TIP_PAR_NOMBRE){
		$this->TIP_PAR_NOMBRE = $TIP_PAR_NOMBRE;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from ctipo_participacion where TIP_PARTICIPACION_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->TIP_PARTICIPACION_CVE = $row["TIP_PARTICIPACION_CVE"];
			$this->TIP_PAR_NOMBRE = $row["TIP_PAR_NOMBRE"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM ctipo_participacion WHERE TIP_PARTICIPACION_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE ctipo_participacion set TIP_PAR_NOMBRE = \"$this->TIP_PAR_NOMBRE\" where TIP_PARTICIPACION_CVE = \"$this->TIP_PARTICIPACION_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into ctipo_participacion (TIP_PAR_NOMBRE) values (\"$this->TIP_PAR_NOMBRE\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT TIP_PARTICIPACION_CVE from ctipo_participacion order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["TIP_PARTICIPACION_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return TIP_PARTICIPACION_CVE - int(11)
	 */
	public function getTIP_PARTICIPACION_CVE(){
		return $this->TIP_PARTICIPACION_CVE;
	}

	/**
	 * @return TIP_PAR_NOMBRE - varchar(20)
	 */
	public function getTIP_PAR_NOMBRE(){
		return $this->TIP_PAR_NOMBRE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTIP_PARTICIPACION_CVE($TIP_PARTICIPACION_CVE){
		$this->TIP_PARTICIPACION_CVE = $TIP_PARTICIPACION_CVE;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setTIP_PAR_NOMBRE($TIP_PAR_NOMBRE){
		$this->TIP_PAR_NOMBRE = $TIP_PAR_NOMBRE;
	}

    /**
     * Close mysql connection
     */
	public function endctipo_participacion(){
		$this->connection->CloseMysql();
	}

}