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

Class csubtipo_formacion_salud {

	private $SUBTIP_NOMBRE; //varchar(100)
	private $TIP_FORM_SALUD_CVE; //int(11)
	private $CSUBTIP_FORM_SALUD_CVE; //int(11)
	private $connection;

	public function csubtipo_formacion_salud(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_csubtipo_formacion_salud($SUBTIP_NOMBRE,$TIP_FORM_SALUD_CVE,){
		$this->SUBTIP_NOMBRE = $SUBTIP_NOMBRE;
		$this->TIP_FORM_SALUD_CVE = $TIP_FORM_SALUD_CVE;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from csubtipo_formacion_salud where CSUBTIP_FORM_SALUD_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->SUBTIP_NOMBRE = $row["SUBTIP_NOMBRE"];
			$this->TIP_FORM_SALUD_CVE = $row["TIP_FORM_SALUD_CVE"];
			$this->CSUBTIP_FORM_SALUD_CVE = $row["CSUBTIP_FORM_SALUD_CVE"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM csubtipo_formacion_salud WHERE CSUBTIP_FORM_SALUD_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE csubtipo_formacion_salud set SUBTIP_NOMBRE = \"$this->SUBTIP_NOMBRE\", TIP_FORM_SALUD_CVE = \"$this->TIP_FORM_SALUD_CVE\",  where CSUBTIP_FORM_SALUD_CVE = \"$this->CSUBTIP_FORM_SALUD_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into csubtipo_formacion_salud (SUBTIP_NOMBRE, TIP_FORM_SALUD_CVE, ) values (\"$this->SUBTIP_NOMBRE\", \"$this->TIP_FORM_SALUD_CVE\", )");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT CSUBTIP_FORM_SALUD_CVE from csubtipo_formacion_salud order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["CSUBTIP_FORM_SALUD_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return SUBTIP_NOMBRE - varchar(100)
	 */
	public function getSUBTIP_NOMBRE(){
		return $this->SUBTIP_NOMBRE;
	}

	/**
	 * @return TIP_FORM_SALUD_CVE - int(11)
	 */
	public function getTIP_FORM_SALUD_CVE(){
		return $this->TIP_FORM_SALUD_CVE;
	}

	/**
	 * @return CSUBTIP_FORM_SALUD_CVE - int(11)
	 */
	public function getCSUBTIP_FORM_SALUD_CVE(){
		return $this->CSUBTIP_FORM_SALUD_CVE;
	}

	/**
	 * @param Type: varchar(100)
	 */
	public function setSUBTIP_NOMBRE($SUBTIP_NOMBRE){
		$this->SUBTIP_NOMBRE = $SUBTIP_NOMBRE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTIP_FORM_SALUD_CVE($TIP_FORM_SALUD_CVE){
		$this->TIP_FORM_SALUD_CVE = $TIP_FORM_SALUD_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setCSUBTIP_FORM_SALUD_CVE($CSUBTIP_FORM_SALUD_CVE){
		$this->CSUBTIP_FORM_SALUD_CVE = $CSUBTIP_FORM_SALUD_CVE;
	}

    /**
     * Close mysql connection
     */
	public function endcsubtipo_formacion_salud(){
		$this->connection->CloseMysql();
	}

}