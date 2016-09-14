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

Class ctipo_contacto {

	private $TIP_CON_CVE; //int(11)
	private $TIP_CON_DES; //varchar(20)
	private $connection;

	public function ctipo_contacto(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_ctipo_contacto($TIP_CON_DES){
		$this->TIP_CON_DES = $TIP_CON_DES;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from ctipo_contacto where TIP_CON_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->TIP_CON_CVE = $row["TIP_CON_CVE"];
			$this->TIP_CON_DES = $row["TIP_CON_DES"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM ctipo_contacto WHERE TIP_CON_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE ctipo_contacto set TIP_CON_DES = \"$this->TIP_CON_DES\" where TIP_CON_CVE = \"$this->TIP_CON_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into ctipo_contacto (TIP_CON_DES) values (\"$this->TIP_CON_DES\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT TIP_CON_CVE from ctipo_contacto order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["TIP_CON_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return TIP_CON_CVE - int(11)
	 */
	public function getTIP_CON_CVE(){
		return $this->TIP_CON_CVE;
	}

	/**
	 * @return TIP_CON_DES - varchar(20)
	 */
	public function getTIP_CON_DES(){
		return $this->TIP_CON_DES;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTIP_CON_CVE($TIP_CON_CVE){
		$this->TIP_CON_CVE = $TIP_CON_CVE;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setTIP_CON_DES($TIP_CON_DES){
		$this->TIP_CON_DES = $TIP_CON_DES;
	}

    /**
     * Close mysql connection
     */
	public function endctipo_contacto(){
		$this->connection->CloseMysql();
	}

}