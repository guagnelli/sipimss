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

Class tabulador_coordinador {

	private $TC_RANGO_1; //varchar(20)
	private $TC_RANGO_2; //varchar(20)
	private $TC_RANGO_3; //varchar(20)
	private $TC_RANGO_1_PUNTOS; //int(11)
	private $TC_RANGO_2_PUNTOS; //int(11)
	private $TC_RANGO_3_PUNTOS; //int(11)
	private $TABULADOR_COOR_CVE; //int(11)
	private $connection;

	public function tabulador_coordinador(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_tabulador_coordinador($TC_RANGO_1,$TC_RANGO_2,$TC_RANGO_3,$TC_RANGO_1_PUNTOS,$TC_RANGO_2_PUNTOS,$TC_RANGO_3_PUNTOS,){
		$this->TC_RANGO_1 = $TC_RANGO_1;
		$this->TC_RANGO_2 = $TC_RANGO_2;
		$this->TC_RANGO_3 = $TC_RANGO_3;
		$this->TC_RANGO_1_PUNTOS = $TC_RANGO_1_PUNTOS;
		$this->TC_RANGO_2_PUNTOS = $TC_RANGO_2_PUNTOS;
		$this->TC_RANGO_3_PUNTOS = $TC_RANGO_3_PUNTOS;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from tabulador_coordinador where TABULADOR_COOR_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->TC_RANGO_1 = $row["TC_RANGO_1"];
			$this->TC_RANGO_2 = $row["TC_RANGO_2"];
			$this->TC_RANGO_3 = $row["TC_RANGO_3"];
			$this->TC_RANGO_1_PUNTOS = $row["TC_RANGO_1_PUNTOS"];
			$this->TC_RANGO_2_PUNTOS = $row["TC_RANGO_2_PUNTOS"];
			$this->TC_RANGO_3_PUNTOS = $row["TC_RANGO_3_PUNTOS"];
			$this->TABULADOR_COOR_CVE = $row["TABULADOR_COOR_CVE"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM tabulador_coordinador WHERE TABULADOR_COOR_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE tabulador_coordinador set TC_RANGO_1 = \"$this->TC_RANGO_1\", TC_RANGO_2 = \"$this->TC_RANGO_2\", TC_RANGO_3 = \"$this->TC_RANGO_3\", TC_RANGO_1_PUNTOS = \"$this->TC_RANGO_1_PUNTOS\", TC_RANGO_2_PUNTOS = \"$this->TC_RANGO_2_PUNTOS\", TC_RANGO_3_PUNTOS = \"$this->TC_RANGO_3_PUNTOS\",  where TABULADOR_COOR_CVE = \"$this->TABULADOR_COOR_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into tabulador_coordinador (TC_RANGO_1, TC_RANGO_2, TC_RANGO_3, TC_RANGO_1_PUNTOS, TC_RANGO_2_PUNTOS, TC_RANGO_3_PUNTOS, ) values (\"$this->TC_RANGO_1\", \"$this->TC_RANGO_2\", \"$this->TC_RANGO_3\", \"$this->TC_RANGO_1_PUNTOS\", \"$this->TC_RANGO_2_PUNTOS\", \"$this->TC_RANGO_3_PUNTOS\", )");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT TABULADOR_COOR_CVE from tabulador_coordinador order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["TABULADOR_COOR_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return TC_RANGO_1 - varchar(20)
	 */
	public function getTC_RANGO_1(){
		return $this->TC_RANGO_1;
	}

	/**
	 * @return TC_RANGO_2 - varchar(20)
	 */
	public function getTC_RANGO_2(){
		return $this->TC_RANGO_2;
	}

	/**
	 * @return TC_RANGO_3 - varchar(20)
	 */
	public function getTC_RANGO_3(){
		return $this->TC_RANGO_3;
	}

	/**
	 * @return TC_RANGO_1_PUNTOS - int(11)
	 */
	public function getTC_RANGO_1_PUNTOS(){
		return $this->TC_RANGO_1_PUNTOS;
	}

	/**
	 * @return TC_RANGO_2_PUNTOS - int(11)
	 */
	public function getTC_RANGO_2_PUNTOS(){
		return $this->TC_RANGO_2_PUNTOS;
	}

	/**
	 * @return TC_RANGO_3_PUNTOS - int(11)
	 */
	public function getTC_RANGO_3_PUNTOS(){
		return $this->TC_RANGO_3_PUNTOS;
	}

	/**
	 * @return TABULADOR_COOR_CVE - int(11)
	 */
	public function getTABULADOR_COOR_CVE(){
		return $this->TABULADOR_COOR_CVE;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setTC_RANGO_1($TC_RANGO_1){
		$this->TC_RANGO_1 = $TC_RANGO_1;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setTC_RANGO_2($TC_RANGO_2){
		$this->TC_RANGO_2 = $TC_RANGO_2;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setTC_RANGO_3($TC_RANGO_3){
		$this->TC_RANGO_3 = $TC_RANGO_3;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTC_RANGO_1_PUNTOS($TC_RANGO_1_PUNTOS){
		$this->TC_RANGO_1_PUNTOS = $TC_RANGO_1_PUNTOS;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTC_RANGO_2_PUNTOS($TC_RANGO_2_PUNTOS){
		$this->TC_RANGO_2_PUNTOS = $TC_RANGO_2_PUNTOS;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTC_RANGO_3_PUNTOS($TC_RANGO_3_PUNTOS){
		$this->TC_RANGO_3_PUNTOS = $TC_RANGO_3_PUNTOS;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTABULADOR_COOR_CVE($TABULADOR_COOR_CVE){
		$this->TABULADOR_COOR_CVE = $TABULADOR_COOR_CVE;
	}

    /**
     * Close mysql connection
     */
	public function endtabulador_coordinador(){
		$this->connection->CloseMysql();
	}

}