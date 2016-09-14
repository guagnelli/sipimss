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

Class ccurso {

	private $CURSO_CVE; //int(11)
	private $CUR_NOMBRE; //varchar(100)
	private $TIP_CURSO_CVE; //int(11)
	private $CVE_CURSO_FUENTE; //bigint(20)
	private $connection;

	public function ccurso(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_ccurso($CUR_NOMBRE,$TIP_CURSO_CVE,$CVE_CURSO_FUENTE){
		$this->CUR_NOMBRE = $CUR_NOMBRE;
		$this->TIP_CURSO_CVE = $TIP_CURSO_CVE;
		$this->CVE_CURSO_FUENTE = $CVE_CURSO_FUENTE;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from ccurso where CURSO_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->CURSO_CVE = $row["CURSO_CVE"];
			$this->CUR_NOMBRE = $row["CUR_NOMBRE"];
			$this->TIP_CURSO_CVE = $row["TIP_CURSO_CVE"];
			$this->CVE_CURSO_FUENTE = $row["CVE_CURSO_FUENTE"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM ccurso WHERE CURSO_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE ccurso set CUR_NOMBRE = \"$this->CUR_NOMBRE\", TIP_CURSO_CVE = \"$this->TIP_CURSO_CVE\", CVE_CURSO_FUENTE = \"$this->CVE_CURSO_FUENTE\" where CURSO_CVE = \"$this->CURSO_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into ccurso (CUR_NOMBRE, TIP_CURSO_CVE, CVE_CURSO_FUENTE) values (\"$this->CUR_NOMBRE\", \"$this->TIP_CURSO_CVE\", \"$this->CVE_CURSO_FUENTE\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT CURSO_CVE from ccurso order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["CURSO_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return CURSO_CVE - int(11)
	 */
	public function getCURSO_CVE(){
		return $this->CURSO_CVE;
	}

	/**
	 * @return CUR_NOMBRE - varchar(100)
	 */
	public function getCUR_NOMBRE(){
		return $this->CUR_NOMBRE;
	}

	/**
	 * @return TIP_CURSO_CVE - int(11)
	 */
	public function getTIP_CURSO_CVE(){
		return $this->TIP_CURSO_CVE;
	}

	/**
	 * @return CVE_CURSO_FUENTE - bigint(20)
	 */
	public function getCVE_CURSO_FUENTE(){
		return $this->CVE_CURSO_FUENTE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setCURSO_CVE($CURSO_CVE){
		$this->CURSO_CVE = $CURSO_CVE;
	}

	/**
	 * @param Type: varchar(100)
	 */
	public function setCUR_NOMBRE($CUR_NOMBRE){
		$this->CUR_NOMBRE = $CUR_NOMBRE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTIP_CURSO_CVE($TIP_CURSO_CVE){
		$this->TIP_CURSO_CVE = $TIP_CURSO_CVE;
	}

	/**
	 * @param Type: bigint(20)
	 */
	public function setCVE_CURSO_FUENTE($CVE_CURSO_FUENTE){
		$this->CVE_CURSO_FUENTE = $CVE_CURSO_FUENTE;
	}

    /**
     * Close mysql connection
     */
	public function endccurso(){
		$this->connection->CloseMysql();
	}

}