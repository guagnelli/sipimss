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

Class comision_area {

	private $COM_AREA_CVE; //int(11)
	private $COM_ARE_NOMBRE; //varchar(20)
	private $connection;

	public function comision_area(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_comision_area($COM_ARE_NOMBRE){
		$this->COM_ARE_NOMBRE = $COM_ARE_NOMBRE;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from comision_area where COM_AREA_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->COM_AREA_CVE = $row["COM_AREA_CVE"];
			$this->COM_ARE_NOMBRE = $row["COM_ARE_NOMBRE"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM comision_area WHERE COM_AREA_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE comision_area set COM_ARE_NOMBRE = \"$this->COM_ARE_NOMBRE\" where COM_AREA_CVE = \"$this->COM_AREA_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into comision_area (COM_ARE_NOMBRE) values (\"$this->COM_ARE_NOMBRE\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT COM_AREA_CVE from comision_area order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["COM_AREA_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return COM_AREA_CVE - int(11)
	 */
	public function getCOM_AREA_CVE(){
		return $this->COM_AREA_CVE;
	}

	/**
	 * @return COM_ARE_NOMBRE - varchar(20)
	 */
	public function getCOM_ARE_NOMBRE(){
		return $this->COM_ARE_NOMBRE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setCOM_AREA_CVE($COM_AREA_CVE){
		$this->COM_AREA_CVE = $COM_AREA_CVE;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setCOM_ARE_NOMBRE($COM_ARE_NOMBRE){
		$this->COM_ARE_NOMBRE = $COM_ARE_NOMBRE;
	}

    /**
     * Close mysql connection
     */
	public function endcomision_area(){
		$this->connection->CloseMysql();
	}

}