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

Class cclase_beca {

	private $CLA_BECA_CVE; //int(11)
	private $CLA_BEC_NOMBRE; //varchar(30)
	private $connection;

	public function cclase_beca(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_cclase_beca($CLA_BEC_NOMBRE){
		$this->CLA_BEC_NOMBRE = $CLA_BEC_NOMBRE;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from cclase_beca where CLA_BECA_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->CLA_BECA_CVE = $row["CLA_BECA_CVE"];
			$this->CLA_BEC_NOMBRE = $row["CLA_BEC_NOMBRE"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM cclase_beca WHERE CLA_BECA_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE cclase_beca set CLA_BEC_NOMBRE = \"$this->CLA_BEC_NOMBRE\" where CLA_BECA_CVE = \"$this->CLA_BECA_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into cclase_beca (CLA_BEC_NOMBRE) values (\"$this->CLA_BEC_NOMBRE\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT CLA_BECA_CVE from cclase_beca order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["CLA_BECA_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return CLA_BECA_CVE - int(11)
	 */
	public function getCLA_BECA_CVE(){
		return $this->CLA_BECA_CVE;
	}

	/**
	 * @return CLA_BEC_NOMBRE - varchar(30)
	 */
	public function getCLA_BEC_NOMBRE(){
		return $this->CLA_BEC_NOMBRE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setCLA_BECA_CVE($CLA_BECA_CVE){
		$this->CLA_BECA_CVE = $CLA_BECA_CVE;
	}

	/**
	 * @param Type: varchar(30)
	 */
	public function setCLA_BEC_NOMBRE($CLA_BEC_NOMBRE){
		$this->CLA_BEC_NOMBRE = $CLA_BEC_NOMBRE;
	}

    /**
     * Close mysql connection
     */
	public function endcclase_beca(){
		$this->connection->CloseMysql();
	}

}