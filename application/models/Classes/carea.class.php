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

Class carea {

	private $AREA_CVE; //int(11)
	private $AREA_NOMBRE; //varchar(20)
	private $connection;

	public function carea(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_carea($AREA_NOMBRE){
		$this->AREA_NOMBRE = $AREA_NOMBRE;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from carea where AREA_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->AREA_CVE = $row["AREA_CVE"];
			$this->AREA_NOMBRE = $row["AREA_NOMBRE"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM carea WHERE AREA_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE carea set AREA_NOMBRE = \"$this->AREA_NOMBRE\" where AREA_CVE = \"$this->AREA_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into carea (AREA_NOMBRE) values (\"$this->AREA_NOMBRE\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT AREA_CVE from carea order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["AREA_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return AREA_CVE - int(11)
	 */
	public function getAREA_CVE(){
		return $this->AREA_CVE;
	}

	/**
	 * @return AREA_NOMBRE - varchar(20)
	 */
	public function getAREA_NOMBRE(){
		return $this->AREA_NOMBRE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setAREA_CVE($AREA_CVE){
		$this->AREA_CVE = $AREA_CVE;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setAREA_NOMBRE($AREA_NOMBRE){
		$this->AREA_NOMBRE = $AREA_NOMBRE;
	}

    /**
     * Close mysql connection
     */
	public function endcarea(){
		$this->connection->CloseMysql();
	}

}