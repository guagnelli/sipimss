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

Class tabulador_ela_meterial {

	private $TEM_ELA_MATERIAL_CVE; //int(11)
	private $TEM_RANGO_1; //varchar(20)
	private $TEM_RANGO_2; //varchar(20)
	private $TEM_PUNTOS_RANGO_1; //int(11)
	private $TEM_PUNTOS_RANGO_2; //int(11)
	private $connection;

	public function tabulador_ela_meterial(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_tabulador_ela_meterial($TEM_RANGO_1,$TEM_RANGO_2,$TEM_PUNTOS_RANGO_1,$TEM_PUNTOS_RANGO_2){
		$this->TEM_RANGO_1 = $TEM_RANGO_1;
		$this->TEM_RANGO_2 = $TEM_RANGO_2;
		$this->TEM_PUNTOS_RANGO_1 = $TEM_PUNTOS_RANGO_1;
		$this->TEM_PUNTOS_RANGO_2 = $TEM_PUNTOS_RANGO_2;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from tabulador_ela_meterial where TEM_ELA_MATERIAL_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->TEM_ELA_MATERIAL_CVE = $row["TEM_ELA_MATERIAL_CVE"];
			$this->TEM_RANGO_1 = $row["TEM_RANGO_1"];
			$this->TEM_RANGO_2 = $row["TEM_RANGO_2"];
			$this->TEM_PUNTOS_RANGO_1 = $row["TEM_PUNTOS_RANGO_1"];
			$this->TEM_PUNTOS_RANGO_2 = $row["TEM_PUNTOS_RANGO_2"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM tabulador_ela_meterial WHERE TEM_ELA_MATERIAL_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE tabulador_ela_meterial set TEM_RANGO_1 = \"$this->TEM_RANGO_1\", TEM_RANGO_2 = \"$this->TEM_RANGO_2\", TEM_PUNTOS_RANGO_1 = \"$this->TEM_PUNTOS_RANGO_1\", TEM_PUNTOS_RANGO_2 = \"$this->TEM_PUNTOS_RANGO_2\" where TEM_ELA_MATERIAL_CVE = \"$this->TEM_ELA_MATERIAL_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into tabulador_ela_meterial (TEM_RANGO_1, TEM_RANGO_2, TEM_PUNTOS_RANGO_1, TEM_PUNTOS_RANGO_2) values (\"$this->TEM_RANGO_1\", \"$this->TEM_RANGO_2\", \"$this->TEM_PUNTOS_RANGO_1\", \"$this->TEM_PUNTOS_RANGO_2\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT TEM_ELA_MATERIAL_CVE from tabulador_ela_meterial order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["TEM_ELA_MATERIAL_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return TEM_ELA_MATERIAL_CVE - int(11)
	 */
	public function getTEM_ELA_MATERIAL_CVE(){
		return $this->TEM_ELA_MATERIAL_CVE;
	}

	/**
	 * @return TEM_RANGO_1 - varchar(20)
	 */
	public function getTEM_RANGO_1(){
		return $this->TEM_RANGO_1;
	}

	/**
	 * @return TEM_RANGO_2 - varchar(20)
	 */
	public function getTEM_RANGO_2(){
		return $this->TEM_RANGO_2;
	}

	/**
	 * @return TEM_PUNTOS_RANGO_1 - int(11)
	 */
	public function getTEM_PUNTOS_RANGO_1(){
		return $this->TEM_PUNTOS_RANGO_1;
	}

	/**
	 * @return TEM_PUNTOS_RANGO_2 - int(11)
	 */
	public function getTEM_PUNTOS_RANGO_2(){
		return $this->TEM_PUNTOS_RANGO_2;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTEM_ELA_MATERIAL_CVE($TEM_ELA_MATERIAL_CVE){
		$this->TEM_ELA_MATERIAL_CVE = $TEM_ELA_MATERIAL_CVE;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setTEM_RANGO_1($TEM_RANGO_1){
		$this->TEM_RANGO_1 = $TEM_RANGO_1;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setTEM_RANGO_2($TEM_RANGO_2){
		$this->TEM_RANGO_2 = $TEM_RANGO_2;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTEM_PUNTOS_RANGO_1($TEM_PUNTOS_RANGO_1){
		$this->TEM_PUNTOS_RANGO_1 = $TEM_PUNTOS_RANGO_1;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTEM_PUNTOS_RANGO_2($TEM_PUNTOS_RANGO_2){
		$this->TEM_PUNTOS_RANGO_2 = $TEM_PUNTOS_RANGO_2;
	}

    /**
     * Close mysql connection
     */
	public function endtabulador_ela_meterial(){
		$this->connection->CloseMysql();
	}

}