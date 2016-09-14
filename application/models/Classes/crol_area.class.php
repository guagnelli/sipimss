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

Class crol_area {

	private $ROL_DESEMPENIA_CVE; //int(11)
	private $ROL_AREA_CVE; //int(11)
	private $ROL_AREA_DESC; //varchar(40)
	private $connection;

	public function crol_area(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_crol_area($ROL_DESEMPENIA_CVE,$ROL_AREA_DESC){
		$this->ROL_DESEMPENIA_CVE = $ROL_DESEMPENIA_CVE;
		$this->ROL_AREA_DESC = $ROL_AREA_DESC;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from crol_area where ROL_AREA_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->ROL_DESEMPENIA_CVE = $row["ROL_DESEMPENIA_CVE"];
			$this->ROL_AREA_CVE = $row["ROL_AREA_CVE"];
			$this->ROL_AREA_DESC = $row["ROL_AREA_DESC"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM crol_area WHERE ROL_AREA_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE crol_area set ROL_DESEMPENIA_CVE = \"$this->ROL_DESEMPENIA_CVE\", ROL_AREA_DESC = \"$this->ROL_AREA_DESC\" where ROL_AREA_CVE = \"$this->ROL_AREA_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into crol_area (ROL_DESEMPENIA_CVE, ROL_AREA_DESC) values (\"$this->ROL_DESEMPENIA_CVE\", \"$this->ROL_AREA_DESC\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT ROL_AREA_CVE from crol_area order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["ROL_AREA_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return ROL_DESEMPENIA_CVE - int(11)
	 */
	public function getROL_DESEMPENIA_CVE(){
		return $this->ROL_DESEMPENIA_CVE;
	}

	/**
	 * @return ROL_AREA_CVE - int(11)
	 */
	public function getROL_AREA_CVE(){
		return $this->ROL_AREA_CVE;
	}

	/**
	 * @return ROL_AREA_DESC - varchar(40)
	 */
	public function getROL_AREA_DESC(){
		return $this->ROL_AREA_DESC;
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
	public function setROL_AREA_CVE($ROL_AREA_CVE){
		$this->ROL_AREA_CVE = $ROL_AREA_CVE;
	}

	/**
	 * @param Type: varchar(40)
	 */
	public function setROL_AREA_DESC($ROL_AREA_DESC){
		$this->ROL_AREA_DESC = $ROL_AREA_DESC;
	}

    /**
     * Close mysql connection
     */
	public function endcrol_area(){
		$this->connection->CloseMysql();
	}

}