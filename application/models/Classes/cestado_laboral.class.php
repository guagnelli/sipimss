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

Class cestado_laboral {

	private $EDO_LABORAL_CVE; //int(11)
	private $EDO_LAB_NOMBRE; //varchar(25)
	private $connection;

	public function cestado_laboral(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_cestado_laboral($EDO_LAB_NOMBRE){
		$this->EDO_LAB_NOMBRE = $EDO_LAB_NOMBRE;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from cestado_laboral where EDO_LABORAL_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->EDO_LABORAL_CVE = $row["EDO_LABORAL_CVE"];
			$this->EDO_LAB_NOMBRE = $row["EDO_LAB_NOMBRE"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM cestado_laboral WHERE EDO_LABORAL_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE cestado_laboral set EDO_LAB_NOMBRE = \"$this->EDO_LAB_NOMBRE\" where EDO_LABORAL_CVE = \"$this->EDO_LABORAL_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into cestado_laboral (EDO_LAB_NOMBRE) values (\"$this->EDO_LAB_NOMBRE\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT EDO_LABORAL_CVE from cestado_laboral order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["EDO_LABORAL_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return EDO_LABORAL_CVE - int(11)
	 */
	public function getEDO_LABORAL_CVE(){
		return $this->EDO_LABORAL_CVE;
	}

	/**
	 * @return EDO_LAB_NOMBRE - varchar(25)
	 */
	public function getEDO_LAB_NOMBRE(){
		return $this->EDO_LAB_NOMBRE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setEDO_LABORAL_CVE($EDO_LABORAL_CVE){
		$this->EDO_LABORAL_CVE = $EDO_LABORAL_CVE;
	}

	/**
	 * @param Type: varchar(25)
	 */
	public function setEDO_LAB_NOMBRE($EDO_LAB_NOMBRE){
		$this->EDO_LAB_NOMBRE = $EDO_LAB_NOMBRE;
	}

    /**
     * Close mysql connection
     */
	public function endcestado_laboral(){
		$this->connection->CloseMysql();
	}

}