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

Class crol_desempenia {

	private $ROL_DESEMPENIA; //varchar(35)
	private $ROL_DESEMPENIA_CVE; //int(11)
	private $ROL_MDL_CVE; //int(11)
	private $connection;

	public function crol_desempenia(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_crol_desempenia($ROL_DESEMPENIA,$ROL_MDL_CVE){
		$this->ROL_DESEMPENIA = $ROL_DESEMPENIA;
		$this->ROL_MDL_CVE = $ROL_MDL_CVE;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from crol_desempenia where ROL_DESEMPENIA_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->ROL_DESEMPENIA = $row["ROL_DESEMPENIA"];
			$this->ROL_DESEMPENIA_CVE = $row["ROL_DESEMPENIA_CVE"];
			$this->ROL_MDL_CVE = $row["ROL_MDL_CVE"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM crol_desempenia WHERE ROL_DESEMPENIA_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE crol_desempenia set ROL_DESEMPENIA = \"$this->ROL_DESEMPENIA\", ROL_MDL_CVE = \"$this->ROL_MDL_CVE\" where ROL_DESEMPENIA_CVE = \"$this->ROL_DESEMPENIA_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into crol_desempenia (ROL_DESEMPENIA, ROL_MDL_CVE) values (\"$this->ROL_DESEMPENIA\", \"$this->ROL_MDL_CVE\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT ROL_DESEMPENIA_CVE from crol_desempenia order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["ROL_DESEMPENIA_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return ROL_DESEMPENIA - varchar(35)
	 */
	public function getROL_DESEMPENIA(){
		return $this->ROL_DESEMPENIA;
	}

	/**
	 * @return ROL_DESEMPENIA_CVE - int(11)
	 */
	public function getROL_DESEMPENIA_CVE(){
		return $this->ROL_DESEMPENIA_CVE;
	}

	/**
	 * @return ROL_MDL_CVE - int(11)
	 */
	public function getROL_MDL_CVE(){
		return $this->ROL_MDL_CVE;
	}

	/**
	 * @param Type: varchar(35)
	 */
	public function setROL_DESEMPENIA($ROL_DESEMPENIA){
		$this->ROL_DESEMPENIA = $ROL_DESEMPENIA;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setROL_DESEMPENIA_CVE($ROL_DESEMPENIA_CVE){
		$this->ROL_DESEMPENIA_CVE = $ROL_DESEMPENIA_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setROL_MDL_CVE($ROL_MDL_CVE){
		$this->ROL_MDL_CVE = $ROL_MDL_CVE;
	}

    /**
     * Close mysql connection
     */
	public function endcrol_desempenia(){
		$this->connection->CloseMysql();
	}

}