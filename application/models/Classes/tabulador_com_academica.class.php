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

Class tabulador_com_academica {

	private $TAB_COM_ACADEMICA_CVE; //int(11)
	private $TCA_RANGO_1; //varchar(20)
	private $TCA_RANGO_1_PUNTOS; //int(11)
	private $connection;

	public function tabulador_com_academica(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_tabulador_com_academica($TCA_RANGO_1,$TCA_RANGO_1_PUNTOS){
		$this->TCA_RANGO_1 = $TCA_RANGO_1;
		$this->TCA_RANGO_1_PUNTOS = $TCA_RANGO_1_PUNTOS;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from tabulador_com_academica where TAB_COM_ACADEMICA_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->TAB_COM_ACADEMICA_CVE = $row["TAB_COM_ACADEMICA_CVE"];
			$this->TCA_RANGO_1 = $row["TCA_RANGO_1"];
			$this->TCA_RANGO_1_PUNTOS = $row["TCA_RANGO_1_PUNTOS"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM tabulador_com_academica WHERE TAB_COM_ACADEMICA_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE tabulador_com_academica set TCA_RANGO_1 = \"$this->TCA_RANGO_1\", TCA_RANGO_1_PUNTOS = \"$this->TCA_RANGO_1_PUNTOS\" where TAB_COM_ACADEMICA_CVE = \"$this->TAB_COM_ACADEMICA_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into tabulador_com_academica (TCA_RANGO_1, TCA_RANGO_1_PUNTOS) values (\"$this->TCA_RANGO_1\", \"$this->TCA_RANGO_1_PUNTOS\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT TAB_COM_ACADEMICA_CVE from tabulador_com_academica order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["TAB_COM_ACADEMICA_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return TAB_COM_ACADEMICA_CVE - int(11)
	 */
	public function getTAB_COM_ACADEMICA_CVE(){
		return $this->TAB_COM_ACADEMICA_CVE;
	}

	/**
	 * @return TCA_RANGO_1 - varchar(20)
	 */
	public function getTCA_RANGO_1(){
		return $this->TCA_RANGO_1;
	}

	/**
	 * @return TCA_RANGO_1_PUNTOS - int(11)
	 */
	public function getTCA_RANGO_1_PUNTOS(){
		return $this->TCA_RANGO_1_PUNTOS;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTAB_COM_ACADEMICA_CVE($TAB_COM_ACADEMICA_CVE){
		$this->TAB_COM_ACADEMICA_CVE = $TAB_COM_ACADEMICA_CVE;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setTCA_RANGO_1($TCA_RANGO_1){
		$this->TCA_RANGO_1 = $TCA_RANGO_1;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTCA_RANGO_1_PUNTOS($TCA_RANGO_1_PUNTOS){
		$this->TCA_RANGO_1_PUNTOS = $TCA_RANGO_1_PUNTOS;
	}

    /**
     * Close mysql connection
     */
	public function endtabulador_com_academica(){
		$this->connection->CloseMysql();
	}

}