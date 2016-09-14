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

Class cmaterial {

	private $TIP_MATERIAL_CVE; //int(11)
	private $TIP_MAT_NOMBRE; //varchar(30)
	private $connection;

	public function cmaterial(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_cmaterial($TIP_MAT_NOMBRE){
		$this->TIP_MAT_NOMBRE = $TIP_MAT_NOMBRE;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from cmaterial where TIP_MATERIAL_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->TIP_MATERIAL_CVE = $row["TIP_MATERIAL_CVE"];
			$this->TIP_MAT_NOMBRE = $row["TIP_MAT_NOMBRE"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM cmaterial WHERE TIP_MATERIAL_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE cmaterial set TIP_MAT_NOMBRE = \"$this->TIP_MAT_NOMBRE\" where TIP_MATERIAL_CVE = \"$this->TIP_MATERIAL_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into cmaterial (TIP_MAT_NOMBRE) values (\"$this->TIP_MAT_NOMBRE\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT TIP_MATERIAL_CVE from cmaterial order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["TIP_MATERIAL_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return TIP_MATERIAL_CVE - int(11)
	 */
	public function getTIP_MATERIAL_CVE(){
		return $this->TIP_MATERIAL_CVE;
	}

	/**
	 * @return TIP_MAT_NOMBRE - varchar(30)
	 */
	public function getTIP_MAT_NOMBRE(){
		return $this->TIP_MAT_NOMBRE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTIP_MATERIAL_CVE($TIP_MATERIAL_CVE){
		$this->TIP_MATERIAL_CVE = $TIP_MATERIAL_CVE;
	}

	/**
	 * @param Type: varchar(30)
	 */
	public function setTIP_MAT_NOMBRE($TIP_MAT_NOMBRE){
		$this->TIP_MAT_NOMBRE = $TIP_MAT_NOMBRE;
	}

    /**
     * Close mysql connection
     */
	public function endcmaterial(){
		$this->connection->CloseMysql();
	}

}