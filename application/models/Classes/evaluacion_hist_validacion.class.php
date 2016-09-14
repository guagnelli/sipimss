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

Class evaluacion_hist_validacion {

	private $hist_validacion_cve; //int(11)
	private $msg_correcciones; //text
	private $est_validacion_cve; //int(11)
	private $solicitud_cve; //int(11)
	private $validador_cve; //int(11)
	private $fch_registro_historia; //datetime
	private $is_actual; //decimal(1,0)
	private $seleccion_dictamen; //varchar(18)
	private $convocatoria_cve; //int(11)
	private $connection;

	public function evaluacion_hist_validacion(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_evaluacion_hist_validacion($msg_correcciones,$est_validacion_cve,$solicitud_cve,$validador_cve,$fch_registro_historia,$is_actual,$seleccion_dictamen,$convocatoria_cve){
		$this->msg_correcciones = $msg_correcciones;
		$this->est_validacion_cve = $est_validacion_cve;
		$this->solicitud_cve = $solicitud_cve;
		$this->validador_cve = $validador_cve;
		$this->fch_registro_historia = $fch_registro_historia;
		$this->is_actual = $is_actual;
		$this->seleccion_dictamen = $seleccion_dictamen;
		$this->convocatoria_cve = $convocatoria_cve;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from evaluacion_hist_validacion where hist_validacion_cve = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->hist_validacion_cve = $row["hist_validacion_cve"];
			$this->msg_correcciones = $row["msg_correcciones"];
			$this->est_validacion_cve = $row["est_validacion_cve"];
			$this->solicitud_cve = $row["solicitud_cve"];
			$this->validador_cve = $row["validador_cve"];
			$this->fch_registro_historia = $row["fch_registro_historia"];
			$this->is_actual = $row["is_actual"];
			$this->seleccion_dictamen = $row["seleccion_dictamen"];
			$this->convocatoria_cve = $row["convocatoria_cve"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM evaluacion_hist_validacion WHERE hist_validacion_cve = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE evaluacion_hist_validacion set msg_correcciones = \"$this->msg_correcciones\", est_validacion_cve = \"$this->est_validacion_cve\", solicitud_cve = \"$this->solicitud_cve\", validador_cve = \"$this->validador_cve\", fch_registro_historia = \"$this->fch_registro_historia\", is_actual = \"$this->is_actual\", seleccion_dictamen = \"$this->seleccion_dictamen\", convocatoria_cve = \"$this->convocatoria_cve\" where hist_validacion_cve = \"$this->hist_validacion_cve\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into evaluacion_hist_validacion (msg_correcciones, est_validacion_cve, solicitud_cve, validador_cve, fch_registro_historia, is_actual, seleccion_dictamen, convocatoria_cve) values (\"$this->msg_correcciones\", \"$this->est_validacion_cve\", \"$this->solicitud_cve\", \"$this->validador_cve\", \"$this->fch_registro_historia\", \"$this->is_actual\", \"$this->seleccion_dictamen\", \"$this->convocatoria_cve\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT hist_validacion_cve from evaluacion_hist_validacion order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["hist_validacion_cve"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return hist_validacion_cve - int(11)
	 */
	public function gethist_validacion_cve(){
		return $this->hist_validacion_cve;
	}

	/**
	 * @return msg_correcciones - text
	 */
	public function getmsg_correcciones(){
		return $this->msg_correcciones;
	}

	/**
	 * @return est_validacion_cve - int(11)
	 */
	public function getest_validacion_cve(){
		return $this->est_validacion_cve;
	}

	/**
	 * @return solicitud_cve - int(11)
	 */
	public function getsolicitud_cve(){
		return $this->solicitud_cve;
	}

	/**
	 * @return validador_cve - int(11)
	 */
	public function getvalidador_cve(){
		return $this->validador_cve;
	}

	/**
	 * @return fch_registro_historia - datetime
	 */
	public function getfch_registro_historia(){
		return $this->fch_registro_historia;
	}

	/**
	 * @return is_actual - decimal(1,0)
	 */
	public function getis_actual(){
		return $this->is_actual;
	}

	/**
	 * @return seleccion_dictamen - varchar(18)
	 */
	public function getseleccion_dictamen(){
		return $this->seleccion_dictamen;
	}

	/**
	 * @return convocatoria_cve - int(11)
	 */
	public function getconvocatoria_cve(){
		return $this->convocatoria_cve;
	}

	/**
	 * @param Type: int(11)
	 */
	public function sethist_validacion_cve($hist_validacion_cve){
		$this->hist_validacion_cve = $hist_validacion_cve;
	}

	/**
	 * @param Type: text
	 */
	public function setmsg_correcciones($msg_correcciones){
		$this->msg_correcciones = $msg_correcciones;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setest_validacion_cve($est_validacion_cve){
		$this->est_validacion_cve = $est_validacion_cve;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setsolicitud_cve($solicitud_cve){
		$this->solicitud_cve = $solicitud_cve;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setvalidador_cve($validador_cve){
		$this->validador_cve = $validador_cve;
	}

	/**
	 * @param Type: datetime
	 */
	public function setfch_registro_historia($fch_registro_historia){
		$this->fch_registro_historia = $fch_registro_historia;
	}

	/**
	 * @param Type: decimal(1,0)
	 */
	public function setis_actual($is_actual){
		$this->is_actual = $is_actual;
	}

	/**
	 * @param Type: varchar(18)
	 */
	public function setseleccion_dictamen($seleccion_dictamen){
		$this->seleccion_dictamen = $seleccion_dictamen;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setconvocatoria_cve($convocatoria_cve){
		$this->convocatoria_cve = $convocatoria_cve;
	}

    /**
     * Close mysql connection
     */
	public function endevaluacion_hist_validacion(){
		$this->connection->CloseMysql();
	}

}