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

Class validacion_gral {

	private $VALIDACION_GRAL_CVE; //int(11)
	private $VAL_CONV_CVE; //int(11)
	private $EMPLEADO_CVE; //int(10)
	private $connection;

	public function validacion_gral(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_validacion_gral($VAL_CONV_CVE,$EMPLEADO_CVE){
		$this->VAL_CONV_CVE = $VAL_CONV_CVE;
		$this->EMPLEADO_CVE = $EMPLEADO_CVE;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from validacion_gral where VALIDACION_GRAL_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->VALIDACION_GRAL_CVE = $row["VALIDACION_GRAL_CVE"];
			$this->VAL_CONV_CVE = $row["VAL_CONV_CVE"];
			$this->EMPLEADO_CVE = $row["EMPLEADO_CVE"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM validacion_gral WHERE VALIDACION_GRAL_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE validacion_gral set VAL_CONV_CVE = \"$this->VAL_CONV_CVE\", EMPLEADO_CVE = \"$this->EMPLEADO_CVE\" where VALIDACION_GRAL_CVE = \"$this->VALIDACION_GRAL_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into validacion_gral (VAL_CONV_CVE, EMPLEADO_CVE) values (\"$this->VAL_CONV_CVE\", \"$this->EMPLEADO_CVE\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT VALIDACION_GRAL_CVE from validacion_gral order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["VALIDACION_GRAL_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return VALIDACION_GRAL_CVE - int(11)
	 */
	public function getVALIDACION_GRAL_CVE(){
		return $this->VALIDACION_GRAL_CVE;
	}

	/**
	 * @return VAL_CONV_CVE - int(11)
	 */
	public function getVAL_CONV_CVE(){
		return $this->VAL_CONV_CVE;
	}

	/**
	 * @return EMPLEADO_CVE - int(10)
	 */
	public function getEMPLEADO_CVE(){
		return $this->EMPLEADO_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setVALIDACION_GRAL_CVE($VALIDACION_GRAL_CVE){
		$this->VALIDACION_GRAL_CVE = $VALIDACION_GRAL_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setVAL_CONV_CVE($VAL_CONV_CVE){
		$this->VAL_CONV_CVE = $VAL_CONV_CVE;
	}

	/**
	 * @param Type: int(10)
	 */
	public function setEMPLEADO_CVE($EMPLEADO_CVE){
		$this->EMPLEADO_CVE = $EMPLEADO_CVE;
	}

    /**
     * Close mysql connection
     */
	public function endvalidacion_gral(){
		$this->connection->CloseMysql();
	}

}