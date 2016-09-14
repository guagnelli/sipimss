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

Class cinstitucion_avala {

	private $INS_AVALA_CVE; //int(11)
	private $IA_NOMBRE; //varchar(70)
	private $IA_TIPO; //varchar(20)
	private $connection;

	public function cinstitucion_avala(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_cinstitucion_avala($IA_NOMBRE,$IA_TIPO){
		$this->IA_NOMBRE = $IA_NOMBRE;
		$this->IA_TIPO = $IA_TIPO;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from cinstitucion_avala where INS_AVALA_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->INS_AVALA_CVE = $row["INS_AVALA_CVE"];
			$this->IA_NOMBRE = $row["IA_NOMBRE"];
			$this->IA_TIPO = $row["IA_TIPO"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM cinstitucion_avala WHERE INS_AVALA_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE cinstitucion_avala set IA_NOMBRE = \"$this->IA_NOMBRE\", IA_TIPO = \"$this->IA_TIPO\" where INS_AVALA_CVE = \"$this->INS_AVALA_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into cinstitucion_avala (IA_NOMBRE, IA_TIPO) values (\"$this->IA_NOMBRE\", \"$this->IA_TIPO\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT INS_AVALA_CVE from cinstitucion_avala order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["INS_AVALA_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return INS_AVALA_CVE - int(11)
	 */
	public function getINS_AVALA_CVE(){
		return $this->INS_AVALA_CVE;
	}

	/**
	 * @return IA_NOMBRE - varchar(70)
	 */
	public function getIA_NOMBRE(){
		return $this->IA_NOMBRE;
	}

	/**
	 * @return IA_TIPO - varchar(20)
	 */
	public function getIA_TIPO(){
		return $this->IA_TIPO;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setINS_AVALA_CVE($INS_AVALA_CVE){
		$this->INS_AVALA_CVE = $INS_AVALA_CVE;
	}

	/**
	 * @param Type: varchar(70)
	 */
	public function setIA_NOMBRE($IA_NOMBRE){
		$this->IA_NOMBRE = $IA_NOMBRE;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setIA_TIPO($IA_TIPO){
		$this->IA_TIPO = $IA_TIPO;
	}

    /**
     * Close mysql connection
     */
	public function endcinstitucion_avala(){
		$this->connection->CloseMysql();
	}

}