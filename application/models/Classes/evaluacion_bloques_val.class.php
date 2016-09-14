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

Class evaluacion_bloques_val {

	private $ebv_cve; //int(11)
	private $sec_info_cve; //int(11)
	private $fch_insert; //datetime
	private $ehv_cve; //int(11)
	private $estado_validacion_cve; //int(11)
	private $txt_descripcion; //text
	private $connection;

	public function evaluacion_bloques_val(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_evaluacion_bloques_val($sec_info_cve,$fch_insert,$ehv_cve,$estado_validacion_cve,$txt_descripcion){
		$this->sec_info_cve = $sec_info_cve;
		$this->fch_insert = $fch_insert;
		$this->ehv_cve = $ehv_cve;
		$this->estado_validacion_cve = $estado_validacion_cve;
		$this->txt_descripcion = $txt_descripcion;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from evaluacion_bloques_val where ebv_cve = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->ebv_cve = $row["ebv_cve"];
			$this->sec_info_cve = $row["sec_info_cve"];
			$this->fch_insert = $row["fch_insert"];
			$this->ehv_cve = $row["ehv_cve"];
			$this->estado_validacion_cve = $row["estado_validacion_cve"];
			$this->txt_descripcion = $row["txt_descripcion"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM evaluacion_bloques_val WHERE ebv_cve = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE evaluacion_bloques_val set sec_info_cve = \"$this->sec_info_cve\", fch_insert = \"$this->fch_insert\", ehv_cve = \"$this->ehv_cve\", estado_validacion_cve = \"$this->estado_validacion_cve\", txt_descripcion = \"$this->txt_descripcion\" where ebv_cve = \"$this->ebv_cve\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into evaluacion_bloques_val (sec_info_cve, fch_insert, ehv_cve, estado_validacion_cve, txt_descripcion) values (\"$this->sec_info_cve\", \"$this->fch_insert\", \"$this->ehv_cve\", \"$this->estado_validacion_cve\", \"$this->txt_descripcion\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT ebv_cve from evaluacion_bloques_val order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["ebv_cve"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return ebv_cve - int(11)
	 */
	public function getebv_cve(){
		return $this->ebv_cve;
	}

	/**
	 * @return sec_info_cve - int(11)
	 */
	public function getsec_info_cve(){
		return $this->sec_info_cve;
	}

	/**
	 * @return fch_insert - datetime
	 */
	public function getfch_insert(){
		return $this->fch_insert;
	}

	/**
	 * @return ehv_cve - int(11)
	 */
	public function getehv_cve(){
		return $this->ehv_cve;
	}

	/**
	 * @return estado_validacion_cve - int(11)
	 */
	public function getestado_validacion_cve(){
		return $this->estado_validacion_cve;
	}

	/**
	 * @return txt_descripcion - text
	 */
	public function gettxt_descripcion(){
		return $this->txt_descripcion;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setebv_cve($ebv_cve){
		$this->ebv_cve = $ebv_cve;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setsec_info_cve($sec_info_cve){
		$this->sec_info_cve = $sec_info_cve;
	}

	/**
	 * @param Type: datetime
	 */
	public function setfch_insert($fch_insert){
		$this->fch_insert = $fch_insert;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setehv_cve($ehv_cve){
		$this->ehv_cve = $ehv_cve;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setestado_validacion_cve($estado_validacion_cve){
		$this->estado_validacion_cve = $estado_validacion_cve;
	}

	/**
	 * @param Type: text
	 */
	public function settxt_descripcion($txt_descripcion){
		$this->txt_descripcion = $txt_descripcion;
	}

    /**
     * Close mysql connection
     */
	public function endevaluacion_bloques_val(){
		$this->connection->CloseMysql();
	}

}