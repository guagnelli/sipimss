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

Class cestado_civil {

	private $CESTADO_CIVIL_CVE; //int(11)
	private $EDO_CIV_NOMBRE; //varchar(20)
	private $connection;

	public function cestado_civil(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_cestado_civil($EDO_CIV_NOMBRE){
		$this->EDO_CIV_NOMBRE = $EDO_CIV_NOMBRE;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from cestado_civil where CESTADO_CIVIL_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->CESTADO_CIVIL_CVE = $row["CESTADO_CIVIL_CVE"];
			$this->EDO_CIV_NOMBRE = $row["EDO_CIV_NOMBRE"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM cestado_civil WHERE CESTADO_CIVIL_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE cestado_civil set EDO_CIV_NOMBRE = \"$this->EDO_CIV_NOMBRE\" where CESTADO_CIVIL_CVE = \"$this->CESTADO_CIVIL_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into cestado_civil (EDO_CIV_NOMBRE) values (\"$this->EDO_CIV_NOMBRE\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT CESTADO_CIVIL_CVE from cestado_civil order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["CESTADO_CIVIL_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return CESTADO_CIVIL_CVE - int(11)
	 */
	public function getCESTADO_CIVIL_CVE(){
		return $this->CESTADO_CIVIL_CVE;
	}

	/**
	 * @return EDO_CIV_NOMBRE - varchar(20)
	 */
	public function getEDO_CIV_NOMBRE(){
		return $this->EDO_CIV_NOMBRE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setCESTADO_CIVIL_CVE($CESTADO_CIVIL_CVE){
		$this->CESTADO_CIVIL_CVE = $CESTADO_CIVIL_CVE;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setEDO_CIV_NOMBRE($EDO_CIV_NOMBRE){
		$this->EDO_CIV_NOMBRE = $EDO_CIV_NOMBRE;
	}

    /**
     * Close mysql connection
     */
	public function endcestado_civil(){
		$this->connection->CloseMysql();
	}

}