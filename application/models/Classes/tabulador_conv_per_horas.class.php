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

Class tabulador_conv_per_horas {

	private $TAB_CON_PER_HORAS_CVE; //int(11)
	private $TCPH_RANGO_1; //varchar(20)
	private $TCPH_RANGO_2; //varchar(20)
	private $TCPH_RANGO_1_HORAS; //int(11)
	private $TCPH_RANGO_2_HORAS; //int(11)
	private $connection;

	public function tabulador_conv_per_horas(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_tabulador_conv_per_horas($TCPH_RANGO_1,$TCPH_RANGO_2,$TCPH_RANGO_1_HORAS,$TCPH_RANGO_2_HORAS){
		$this->TCPH_RANGO_1 = $TCPH_RANGO_1;
		$this->TCPH_RANGO_2 = $TCPH_RANGO_2;
		$this->TCPH_RANGO_1_HORAS = $TCPH_RANGO_1_HORAS;
		$this->TCPH_RANGO_2_HORAS = $TCPH_RANGO_2_HORAS;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from tabulador_conv_per_horas where TAB_CON_PER_HORAS_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->TAB_CON_PER_HORAS_CVE = $row["TAB_CON_PER_HORAS_CVE"];
			$this->TCPH_RANGO_1 = $row["TCPH_RANGO_1"];
			$this->TCPH_RANGO_2 = $row["TCPH_RANGO_2"];
			$this->TCPH_RANGO_1_HORAS = $row["TCPH_RANGO_1_HORAS"];
			$this->TCPH_RANGO_2_HORAS = $row["TCPH_RANGO_2_HORAS"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM tabulador_conv_per_horas WHERE TAB_CON_PER_HORAS_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE tabulador_conv_per_horas set TCPH_RANGO_1 = \"$this->TCPH_RANGO_1\", TCPH_RANGO_2 = \"$this->TCPH_RANGO_2\", TCPH_RANGO_1_HORAS = \"$this->TCPH_RANGO_1_HORAS\", TCPH_RANGO_2_HORAS = \"$this->TCPH_RANGO_2_HORAS\" where TAB_CON_PER_HORAS_CVE = \"$this->TAB_CON_PER_HORAS_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into tabulador_conv_per_horas (TCPH_RANGO_1, TCPH_RANGO_2, TCPH_RANGO_1_HORAS, TCPH_RANGO_2_HORAS) values (\"$this->TCPH_RANGO_1\", \"$this->TCPH_RANGO_2\", \"$this->TCPH_RANGO_1_HORAS\", \"$this->TCPH_RANGO_2_HORAS\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT TAB_CON_PER_HORAS_CVE from tabulador_conv_per_horas order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["TAB_CON_PER_HORAS_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return TAB_CON_PER_HORAS_CVE - int(11)
	 */
	public function getTAB_CON_PER_HORAS_CVE(){
		return $this->TAB_CON_PER_HORAS_CVE;
	}

	/**
	 * @return TCPH_RANGO_1 - varchar(20)
	 */
	public function getTCPH_RANGO_1(){
		return $this->TCPH_RANGO_1;
	}

	/**
	 * @return TCPH_RANGO_2 - varchar(20)
	 */
	public function getTCPH_RANGO_2(){
		return $this->TCPH_RANGO_2;
	}

	/**
	 * @return TCPH_RANGO_1_HORAS - int(11)
	 */
	public function getTCPH_RANGO_1_HORAS(){
		return $this->TCPH_RANGO_1_HORAS;
	}

	/**
	 * @return TCPH_RANGO_2_HORAS - int(11)
	 */
	public function getTCPH_RANGO_2_HORAS(){
		return $this->TCPH_RANGO_2_HORAS;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTAB_CON_PER_HORAS_CVE($TAB_CON_PER_HORAS_CVE){
		$this->TAB_CON_PER_HORAS_CVE = $TAB_CON_PER_HORAS_CVE;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setTCPH_RANGO_1($TCPH_RANGO_1){
		$this->TCPH_RANGO_1 = $TCPH_RANGO_1;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setTCPH_RANGO_2($TCPH_RANGO_2){
		$this->TCPH_RANGO_2 = $TCPH_RANGO_2;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTCPH_RANGO_1_HORAS($TCPH_RANGO_1_HORAS){
		$this->TCPH_RANGO_1_HORAS = $TCPH_RANGO_1_HORAS;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTCPH_RANGO_2_HORAS($TCPH_RANGO_2_HORAS){
		$this->TCPH_RANGO_2_HORAS = $TCPH_RANGO_2_HORAS;
	}

    /**
     * Close mysql connection
     */
	public function endtabulador_conv_per_horas(){
		$this->connection->CloseMysql();
	}

}