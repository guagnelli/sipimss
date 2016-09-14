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

Class tabulador_act_inv_edu {

	private $TABU_ACT_INV_EDU_CVE; //int(11)
	private $TAIE_TIPO_ACTIVIDAD; //varchar(20)
	private $TAIE_RANGO_1; //char(18)
	private $connection;

	public function tabulador_act_inv_edu(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_tabulador_act_inv_edu($TAIE_TIPO_ACTIVIDAD,$TAIE_RANGO_1){
		$this->TAIE_TIPO_ACTIVIDAD = $TAIE_TIPO_ACTIVIDAD;
		$this->TAIE_RANGO_1 = $TAIE_RANGO_1;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from tabulador_act_inv_edu where TABU_ACT_INV_EDU_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->TABU_ACT_INV_EDU_CVE = $row["TABU_ACT_INV_EDU_CVE"];
			$this->TAIE_TIPO_ACTIVIDAD = $row["TAIE_TIPO_ACTIVIDAD"];
			$this->TAIE_RANGO_1 = $row["TAIE_RANGO_1"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM tabulador_act_inv_edu WHERE TABU_ACT_INV_EDU_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE tabulador_act_inv_edu set TAIE_TIPO_ACTIVIDAD = \"$this->TAIE_TIPO_ACTIVIDAD\", TAIE_RANGO_1 = \"$this->TAIE_RANGO_1\" where TABU_ACT_INV_EDU_CVE = \"$this->TABU_ACT_INV_EDU_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into tabulador_act_inv_edu (TAIE_TIPO_ACTIVIDAD, TAIE_RANGO_1) values (\"$this->TAIE_TIPO_ACTIVIDAD\", \"$this->TAIE_RANGO_1\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT TABU_ACT_INV_EDU_CVE from tabulador_act_inv_edu order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["TABU_ACT_INV_EDU_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return TABU_ACT_INV_EDU_CVE - int(11)
	 */
	public function getTABU_ACT_INV_EDU_CVE(){
		return $this->TABU_ACT_INV_EDU_CVE;
	}

	/**
	 * @return TAIE_TIPO_ACTIVIDAD - varchar(20)
	 */
	public function getTAIE_TIPO_ACTIVIDAD(){
		return $this->TAIE_TIPO_ACTIVIDAD;
	}

	/**
	 * @return TAIE_RANGO_1 - char(18)
	 */
	public function getTAIE_RANGO_1(){
		return $this->TAIE_RANGO_1;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTABU_ACT_INV_EDU_CVE($TABU_ACT_INV_EDU_CVE){
		$this->TABU_ACT_INV_EDU_CVE = $TABU_ACT_INV_EDU_CVE;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setTAIE_TIPO_ACTIVIDAD($TAIE_TIPO_ACTIVIDAD){
		$this->TAIE_TIPO_ACTIVIDAD = $TAIE_TIPO_ACTIVIDAD;
	}

	/**
	 * @param Type: char(18)
	 */
	public function setTAIE_RANGO_1($TAIE_RANGO_1){
		$this->TAIE_RANGO_1 = $TAIE_RANGO_1;
	}

    /**
     * Close mysql connection
     */
	public function endtabulador_act_inv_edu(){
		$this->connection->CloseMysql();
	}

}