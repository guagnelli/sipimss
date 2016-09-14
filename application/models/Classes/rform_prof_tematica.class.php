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

Class rform_prof_tematica {

	private $RFORM_PROF_TEMATICA_CVE; //int(11)
	private $TEMATICA_CVE; //int(11)
	private $EMP_FORMACION_PROFESIONAL_CVE; //int(10)
	private $connection;

	public function rform_prof_tematica(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_rform_prof_tematica($TEMATICA_CVE,$EMP_FORMACION_PROFESIONAL_CVE){
		$this->TEMATICA_CVE = $TEMATICA_CVE;
		$this->EMP_FORMACION_PROFESIONAL_CVE = $EMP_FORMACION_PROFESIONAL_CVE;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from rform_prof_tematica where RFORM_PROF_TEMATICA_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->RFORM_PROF_TEMATICA_CVE = $row["RFORM_PROF_TEMATICA_CVE"];
			$this->TEMATICA_CVE = $row["TEMATICA_CVE"];
			$this->EMP_FORMACION_PROFESIONAL_CVE = $row["EMP_FORMACION_PROFESIONAL_CVE"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM rform_prof_tematica WHERE RFORM_PROF_TEMATICA_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE rform_prof_tematica set TEMATICA_CVE = \"$this->TEMATICA_CVE\", EMP_FORMACION_PROFESIONAL_CVE = \"$this->EMP_FORMACION_PROFESIONAL_CVE\" where RFORM_PROF_TEMATICA_CVE = \"$this->RFORM_PROF_TEMATICA_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into rform_prof_tematica (TEMATICA_CVE, EMP_FORMACION_PROFESIONAL_CVE) values (\"$this->TEMATICA_CVE\", \"$this->EMP_FORMACION_PROFESIONAL_CVE\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT RFORM_PROF_TEMATICA_CVE from rform_prof_tematica order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["RFORM_PROF_TEMATICA_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return RFORM_PROF_TEMATICA_CVE - int(11)
	 */
	public function getRFORM_PROF_TEMATICA_CVE(){
		return $this->RFORM_PROF_TEMATICA_CVE;
	}

	/**
	 * @return TEMATICA_CVE - int(11)
	 */
	public function getTEMATICA_CVE(){
		return $this->TEMATICA_CVE;
	}

	/**
	 * @return EMP_FORMACION_PROFESIONAL_CVE - int(10)
	 */
	public function getEMP_FORMACION_PROFESIONAL_CVE(){
		return $this->EMP_FORMACION_PROFESIONAL_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setRFORM_PROF_TEMATICA_CVE($RFORM_PROF_TEMATICA_CVE){
		$this->RFORM_PROF_TEMATICA_CVE = $RFORM_PROF_TEMATICA_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTEMATICA_CVE($TEMATICA_CVE){
		$this->TEMATICA_CVE = $TEMATICA_CVE;
	}

	/**
	 * @param Type: int(10)
	 */
	public function setEMP_FORMACION_PROFESIONAL_CVE($EMP_FORMACION_PROFESIONAL_CVE){
		$this->EMP_FORMACION_PROFESIONAL_CVE = $EMP_FORMACION_PROFESIONAL_CVE;
	}

    /**
     * Close mysql connection
     */
	public function endrform_prof_tematica(){
		$this->connection->CloseMysql();
	}

}