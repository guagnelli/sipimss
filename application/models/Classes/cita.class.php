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

Class cita {

	private $CIT_TIPO_FUENTE; //varchar(20)
	private $CITA_CVE; //int(11)
	private $CIT_TITULO; //varchar(18)
	private $CIT_ANIO; //int(11)
	private $connection;

	public function cita(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_cita($CIT_TIPO_FUENTE,$CIT_TITULO,$CIT_ANIO){
		$this->CIT_TIPO_FUENTE = $CIT_TIPO_FUENTE;
		$this->CIT_TITULO = $CIT_TITULO;
		$this->CIT_ANIO = $CIT_ANIO;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from cita where CITA_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->CIT_TIPO_FUENTE = $row["CIT_TIPO_FUENTE"];
			$this->CITA_CVE = $row["CITA_CVE"];
			$this->CIT_TITULO = $row["CIT_TITULO"];
			$this->CIT_ANIO = $row["CIT_ANIO"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM cita WHERE CITA_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE cita set CIT_TIPO_FUENTE = \"$this->CIT_TIPO_FUENTE\", CIT_TITULO = \"$this->CIT_TITULO\", CIT_ANIO = \"$this->CIT_ANIO\" where CITA_CVE = \"$this->CITA_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into cita (CIT_TIPO_FUENTE, CIT_TITULO, CIT_ANIO) values (\"$this->CIT_TIPO_FUENTE\", \"$this->CIT_TITULO\", \"$this->CIT_ANIO\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT CITA_CVE from cita order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["CITA_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return CIT_TIPO_FUENTE - varchar(20)
	 */
	public function getCIT_TIPO_FUENTE(){
		return $this->CIT_TIPO_FUENTE;
	}

	/**
	 * @return CITA_CVE - int(11)
	 */
	public function getCITA_CVE(){
		return $this->CITA_CVE;
	}

	/**
	 * @return CIT_TITULO - varchar(18)
	 */
	public function getCIT_TITULO(){
		return $this->CIT_TITULO;
	}

	/**
	 * @return CIT_ANIO - int(11)
	 */
	public function getCIT_ANIO(){
		return $this->CIT_ANIO;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setCIT_TIPO_FUENTE($CIT_TIPO_FUENTE){
		$this->CIT_TIPO_FUENTE = $CIT_TIPO_FUENTE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setCITA_CVE($CITA_CVE){
		$this->CITA_CVE = $CITA_CVE;
	}

	/**
	 * @param Type: varchar(18)
	 */
	public function setCIT_TITULO($CIT_TITULO){
		$this->CIT_TITULO = $CIT_TITULO;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setCIT_ANIO($CIT_ANIO){
		$this->CIT_ANIO = $CIT_ANIO;
	}

    /**
     * Close mysql connection
     */
	public function endcita(){
		$this->connection->CloseMysql();
	}

}