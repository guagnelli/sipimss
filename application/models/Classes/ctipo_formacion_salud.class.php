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

Class ctipo_formacion_salud {

	private $TIP_FORM_SALUD_NOMBRE; //varchar(50)
	private $TIP_FORM_SALUD_CVE; //int(11)
	private $connection;

	public function ctipo_formacion_salud(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_ctipo_formacion_salud($TIP_FORM_SALUD_NOMBRE,){
		$this->TIP_FORM_SALUD_NOMBRE = $TIP_FORM_SALUD_NOMBRE;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from ctipo_formacion_salud where TIP_FORM_SALUD_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->TIP_FORM_SALUD_NOMBRE = $row["TIP_FORM_SALUD_NOMBRE"];
			$this->TIP_FORM_SALUD_CVE = $row["TIP_FORM_SALUD_CVE"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM ctipo_formacion_salud WHERE TIP_FORM_SALUD_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE ctipo_formacion_salud set TIP_FORM_SALUD_NOMBRE = \"$this->TIP_FORM_SALUD_NOMBRE\",  where TIP_FORM_SALUD_CVE = \"$this->TIP_FORM_SALUD_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into ctipo_formacion_salud (TIP_FORM_SALUD_NOMBRE, ) values (\"$this->TIP_FORM_SALUD_NOMBRE\", )");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT TIP_FORM_SALUD_CVE from ctipo_formacion_salud order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["TIP_FORM_SALUD_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return TIP_FORM_SALUD_NOMBRE - varchar(50)
	 */
	public function getTIP_FORM_SALUD_NOMBRE(){
		return $this->TIP_FORM_SALUD_NOMBRE;
	}

	/**
	 * @return TIP_FORM_SALUD_CVE - int(11)
	 */
	public function getTIP_FORM_SALUD_CVE(){
		return $this->TIP_FORM_SALUD_CVE;
	}

	/**
	 * @param Type: varchar(50)
	 */
	public function setTIP_FORM_SALUD_NOMBRE($TIP_FORM_SALUD_NOMBRE){
		$this->TIP_FORM_SALUD_NOMBRE = $TIP_FORM_SALUD_NOMBRE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTIP_FORM_SALUD_CVE($TIP_FORM_SALUD_CVE){
		$this->TIP_FORM_SALUD_CVE = $TIP_FORM_SALUD_CVE;
	}

    /**
     * Close mysql connection
     */
	public function endctipo_formacion_salud(){
		$this->connection->CloseMysql();
	}

}