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

Class cmedio_divulgacion {

	private $MED_DIVULGACION_CVE; //int(11)
	private $MED_DIV_NOMBRE; //varchar(35)
	private $connection;

	public function cmedio_divulgacion(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_cmedio_divulgacion($MED_DIV_NOMBRE){
		$this->MED_DIV_NOMBRE = $MED_DIV_NOMBRE;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from cmedio_divulgacion where MED_DIVULGACION_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->MED_DIVULGACION_CVE = $row["MED_DIVULGACION_CVE"];
			$this->MED_DIV_NOMBRE = $row["MED_DIV_NOMBRE"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM cmedio_divulgacion WHERE MED_DIVULGACION_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE cmedio_divulgacion set MED_DIV_NOMBRE = \"$this->MED_DIV_NOMBRE\" where MED_DIVULGACION_CVE = \"$this->MED_DIVULGACION_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into cmedio_divulgacion (MED_DIV_NOMBRE) values (\"$this->MED_DIV_NOMBRE\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT MED_DIVULGACION_CVE from cmedio_divulgacion order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["MED_DIVULGACION_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return MED_DIVULGACION_CVE - int(11)
	 */
	public function getMED_DIVULGACION_CVE(){
		return $this->MED_DIVULGACION_CVE;
	}

	/**
	 * @return MED_DIV_NOMBRE - varchar(35)
	 */
	public function getMED_DIV_NOMBRE(){
		return $this->MED_DIV_NOMBRE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setMED_DIVULGACION_CVE($MED_DIVULGACION_CVE){
		$this->MED_DIVULGACION_CVE = $MED_DIVULGACION_CVE;
	}

	/**
	 * @param Type: varchar(35)
	 */
	public function setMED_DIV_NOMBRE($MED_DIV_NOMBRE){
		$this->MED_DIV_NOMBRE = $MED_DIV_NOMBRE;
	}

    /**
     * Close mysql connection
     */
	public function endcmedio_divulgacion(){
		$this->connection->CloseMysql();
	}

}