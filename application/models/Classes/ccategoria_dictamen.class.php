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

Class ccategoria_dictamen {

	private $CATEGORIA_CVE; //int(11)
	private $CAT_NOMBRE; //varchar(20)
	private $connection;

	public function ccategoria_dictamen(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_ccategoria_dictamen($CAT_NOMBRE){
		$this->CAT_NOMBRE = $CAT_NOMBRE;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from ccategoria_dictamen where CATEGORIA_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->CATEGORIA_CVE = $row["CATEGORIA_CVE"];
			$this->CAT_NOMBRE = $row["CAT_NOMBRE"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM ccategoria_dictamen WHERE CATEGORIA_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE ccategoria_dictamen set CAT_NOMBRE = \"$this->CAT_NOMBRE\" where CATEGORIA_CVE = \"$this->CATEGORIA_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into ccategoria_dictamen (CAT_NOMBRE) values (\"$this->CAT_NOMBRE\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT CATEGORIA_CVE from ccategoria_dictamen order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["CATEGORIA_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return CATEGORIA_CVE - int(11)
	 */
	public function getCATEGORIA_CVE(){
		return $this->CATEGORIA_CVE;
	}

	/**
	 * @return CAT_NOMBRE - varchar(20)
	 */
	public function getCAT_NOMBRE(){
		return $this->CAT_NOMBRE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setCATEGORIA_CVE($CATEGORIA_CVE){
		$this->CATEGORIA_CVE = $CATEGORIA_CVE;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setCAT_NOMBRE($CAT_NOMBRE){
		$this->CAT_NOMBRE = $CAT_NOMBRE;
	}

    /**
     * Close mysql connection
     */
	public function endccategoria_dictamen(){
		$this->connection->CloseMysql();
	}

}