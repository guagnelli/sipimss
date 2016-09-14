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

Class validacion_convocatoria_delegacion {

	private $VAL_CON_CVE; //int(11)
	private $VAL_CON_DEL_CVE; //char(2)
	private $connection;

	public function validacion_convocatoria_delegacion(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_validacion_convocatoria_delegacion(){
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from validacion_convocatoria_delegacion where VAL_CON_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->VAL_CON_CVE = $row["VAL_CON_CVE"];
			$this->VAL_CON_DEL_CVE = $row["VAL_CON_DEL_CVE"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM validacion_convocatoria_delegacion WHERE VAL_CON_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE validacion_convocatoria_delegacion set  where VAL_CON_CVE = \"$this->VAL_CON_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into validacion_convocatoria_delegacion () values ()");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT VAL_CON_CVE from validacion_convocatoria_delegacion order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["VAL_CON_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return VAL_CON_CVE - int(11)
	 */
	public function getVAL_CON_CVE(){
		return $this->VAL_CON_CVE;
	}

	/**
	 * @return VAL_CON_DEL_CVE - char(2)
	 */
	public function getVAL_CON_DEL_CVE(){
		return $this->VAL_CON_DEL_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setVAL_CON_CVE($VAL_CON_CVE){
		$this->VAL_CON_CVE = $VAL_CON_CVE;
	}

	/**
	 * @param Type: char(2)
	 */
	public function setVAL_CON_DEL_CVE($VAL_CON_DEL_CVE){
		$this->VAL_CON_DEL_CVE = $VAL_CON_DEL_CVE;
	}

    /**
     * Close mysql connection
     */
	public function endvalidacion_convocatoria_delegacion(){
		$this->connection->CloseMysql();
	}

}