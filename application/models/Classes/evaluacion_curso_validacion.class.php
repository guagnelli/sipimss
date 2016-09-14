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

Class evaluacion_curso_validacion {

	private $ecv_cve; //int(11)
	private $es_cve; //int(11)
	private $csi_cve; //int(11)
	private $seccion_cve; //int(11)
	private $is_valido; //decimal(1,0)
	private $connection;

	public function evaluacion_curso_validacion(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_evaluacion_curso_validacion($es_cve,$csi_cve,$seccion_cve,$is_valido){
		$this->es_cve = $es_cve;
		$this->csi_cve = $csi_cve;
		$this->seccion_cve = $seccion_cve;
		$this->is_valido = $is_valido;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from evaluacion_curso_validacion where ecv_cve = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->ecv_cve = $row["ecv_cve"];
			$this->es_cve = $row["es_cve"];
			$this->csi_cve = $row["csi_cve"];
			$this->seccion_cve = $row["seccion_cve"];
			$this->is_valido = $row["is_valido"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM evaluacion_curso_validacion WHERE ecv_cve = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE evaluacion_curso_validacion set es_cve = \"$this->es_cve\", csi_cve = \"$this->csi_cve\", seccion_cve = \"$this->seccion_cve\", is_valido = \"$this->is_valido\" where ecv_cve = \"$this->ecv_cve\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into evaluacion_curso_validacion (es_cve, csi_cve, seccion_cve, is_valido) values (\"$this->es_cve\", \"$this->csi_cve\", \"$this->seccion_cve\", \"$this->is_valido\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT ecv_cve from evaluacion_curso_validacion order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["ecv_cve"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return ecv_cve - int(11)
	 */
	public function getecv_cve(){
		return $this->ecv_cve;
	}

	/**
	 * @return es_cve - int(11)
	 */
	public function getes_cve(){
		return $this->es_cve;
	}

	/**
	 * @return csi_cve - int(11)
	 */
	public function getcsi_cve(){
		return $this->csi_cve;
	}

	/**
	 * @return seccion_cve - int(11)
	 */
	public function getseccion_cve(){
		return $this->seccion_cve;
	}

	/**
	 * @return is_valido - decimal(1,0)
	 */
	public function getis_valido(){
		return $this->is_valido;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setecv_cve($ecv_cve){
		$this->ecv_cve = $ecv_cve;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setes_cve($es_cve){
		$this->es_cve = $es_cve;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setcsi_cve($csi_cve){
		$this->csi_cve = $csi_cve;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setseccion_cve($seccion_cve){
		$this->seccion_cve = $seccion_cve;
	}

	/**
	 * @param Type: decimal(1,0)
	 */
	public function setis_valido($is_valido){
		$this->is_valido = $is_valido;
	}

    /**
     * Close mysql connection
     */
	public function endevaluacion_curso_validacion(){
		$this->connection->CloseMysql();
	}

}