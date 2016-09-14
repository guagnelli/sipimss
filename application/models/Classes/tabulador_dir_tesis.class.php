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

Class tabulador_dir_tesis {

	private $TABU_DIR_TESIS_CVE; //int(11)
	private $TDT_NIVEL_ESTUDIOS; //varchar(20)
	private $TDT_RANGO_1; //int(11)
	private $connection;

	public function tabulador_dir_tesis(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_tabulador_dir_tesis($TDT_NIVEL_ESTUDIOS,$TDT_RANGO_1){
		$this->TDT_NIVEL_ESTUDIOS = $TDT_NIVEL_ESTUDIOS;
		$this->TDT_RANGO_1 = $TDT_RANGO_1;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from tabulador_dir_tesis where TABU_DIR_TESIS_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->TABU_DIR_TESIS_CVE = $row["TABU_DIR_TESIS_CVE"];
			$this->TDT_NIVEL_ESTUDIOS = $row["TDT_NIVEL_ESTUDIOS"];
			$this->TDT_RANGO_1 = $row["TDT_RANGO_1"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM tabulador_dir_tesis WHERE TABU_DIR_TESIS_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE tabulador_dir_tesis set TDT_NIVEL_ESTUDIOS = \"$this->TDT_NIVEL_ESTUDIOS\", TDT_RANGO_1 = \"$this->TDT_RANGO_1\" where TABU_DIR_TESIS_CVE = \"$this->TABU_DIR_TESIS_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into tabulador_dir_tesis (TDT_NIVEL_ESTUDIOS, TDT_RANGO_1) values (\"$this->TDT_NIVEL_ESTUDIOS\", \"$this->TDT_RANGO_1\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT TABU_DIR_TESIS_CVE from tabulador_dir_tesis order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["TABU_DIR_TESIS_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return TABU_DIR_TESIS_CVE - int(11)
	 */
	public function getTABU_DIR_TESIS_CVE(){
		return $this->TABU_DIR_TESIS_CVE;
	}

	/**
	 * @return TDT_NIVEL_ESTUDIOS - varchar(20)
	 */
	public function getTDT_NIVEL_ESTUDIOS(){
		return $this->TDT_NIVEL_ESTUDIOS;
	}

	/**
	 * @return TDT_RANGO_1 - int(11)
	 */
	public function getTDT_RANGO_1(){
		return $this->TDT_RANGO_1;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTABU_DIR_TESIS_CVE($TABU_DIR_TESIS_CVE){
		$this->TABU_DIR_TESIS_CVE = $TABU_DIR_TESIS_CVE;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setTDT_NIVEL_ESTUDIOS($TDT_NIVEL_ESTUDIOS){
		$this->TDT_NIVEL_ESTUDIOS = $TDT_NIVEL_ESTUDIOS;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTDT_RANGO_1($TDT_RANGO_1){
		$this->TDT_RANGO_1 = $TDT_RANGO_1;
	}

    /**
     * Close mysql connection
     */
	public function endtabulador_dir_tesis(){
		$this->connection->CloseMysql();
	}

}