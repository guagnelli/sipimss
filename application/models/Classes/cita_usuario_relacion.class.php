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

Class cita_usuario_relacion {

	private $CITA_USUARIO_CVE; //int(11)
	private $CITA_CVE; //int(11)
	private $connection;

	public function cita_usuario_relacion(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_cita_usuario_relacion(){
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from cita_usuario_relacion where CITA_USUARIO_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->CITA_USUARIO_CVE = $row["CITA_USUARIO_CVE"];
			$this->CITA_CVE = $row["CITA_CVE"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM cita_usuario_relacion WHERE CITA_USUARIO_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE cita_usuario_relacion set  where CITA_USUARIO_CVE = \"$this->CITA_USUARIO_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into cita_usuario_relacion () values ()");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT CITA_USUARIO_CVE from cita_usuario_relacion order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["CITA_USUARIO_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return CITA_USUARIO_CVE - int(11)
	 */
	public function getCITA_USUARIO_CVE(){
		return $this->CITA_USUARIO_CVE;
	}

	/**
	 * @return CITA_CVE - int(11)
	 */
	public function getCITA_CVE(){
		return $this->CITA_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setCITA_USUARIO_CVE($CITA_USUARIO_CVE){
		$this->CITA_USUARIO_CVE = $CITA_USUARIO_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setCITA_CVE($CITA_CVE){
		$this->CITA_CVE = $CITA_CVE;
	}

    /**
     * Close mysql connection
     */
	public function endcita_usuario_relacion(){
		$this->connection->CloseMysql();
	}

}