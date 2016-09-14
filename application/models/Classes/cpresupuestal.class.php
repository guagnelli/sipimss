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

Class cpresupuestal {

	private $PRESUPUESTAL_CVE; //int(11)
	private $PRE_NOMBRE; //varchar(20)
	private $connection;

	public function cpresupuestal(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_cpresupuestal($PRE_NOMBRE){
		$this->PRE_NOMBRE = $PRE_NOMBRE;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from cpresupuestal where PRESUPUESTAL_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->PRESUPUESTAL_CVE = $row["PRESUPUESTAL_CVE"];
			$this->PRE_NOMBRE = $row["PRE_NOMBRE"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM cpresupuestal WHERE PRESUPUESTAL_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE cpresupuestal set PRE_NOMBRE = \"$this->PRE_NOMBRE\" where PRESUPUESTAL_CVE = \"$this->PRESUPUESTAL_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into cpresupuestal (PRE_NOMBRE) values (\"$this->PRE_NOMBRE\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT PRESUPUESTAL_CVE from cpresupuestal order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["PRESUPUESTAL_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return PRESUPUESTAL_CVE - int(11)
	 */
	public function getPRESUPUESTAL_CVE(){
		return $this->PRESUPUESTAL_CVE;
	}

	/**
	 * @return PRE_NOMBRE - varchar(20)
	 */
	public function getPRE_NOMBRE(){
		return $this->PRE_NOMBRE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setPRESUPUESTAL_CVE($PRESUPUESTAL_CVE){
		$this->PRESUPUESTAL_CVE = $PRESUPUESTAL_CVE;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setPRE_NOMBRE($PRE_NOMBRE){
		$this->PRE_NOMBRE = $PRE_NOMBRE;
	}

    /**
     * Close mysql connection
     */
	public function endcpresupuestal(){
		$this->connection->CloseMysql();
	}

}