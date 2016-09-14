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

Class evaluacion_curso_mat_edu {

	private $EVA_CURSO_CVE; //int(11)
	private $EVA_CUR_VALIDO; //char(1)
	private $EVA_CUR_PUNTOS_CURSO; //int(11)
	private $ROL_EVALUADOR_CVE; //int(11)
	private $EVA_CUR_CATEGORIA; //varchar(20)
	private $EVA_CUR_MSG_RE_EVALUACION; //mediumtext
	private $EVA_CUR_PUNTOS_CURSO_ORIGINAL; //int(11)
	private $MATERIA_EDUCATIVO_CVE; //int(11)
	private $TEM_ELA_MATERIAL_CVE; //int(11)
	private $FCH_EVALUACION_CURSO_GAECUD; //date
	private $connection;

	public function evaluacion_curso_mat_edu(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_evaluacion_curso_mat_edu($EVA_CUR_VALIDO,$EVA_CUR_PUNTOS_CURSO,$ROL_EVALUADOR_CVE,$EVA_CUR_CATEGORIA,$EVA_CUR_MSG_RE_EVALUACION,$EVA_CUR_PUNTOS_CURSO_ORIGINAL,$MATERIA_EDUCATIVO_CVE,$TEM_ELA_MATERIAL_CVE,$FCH_EVALUACION_CURSO_GAECUD){
		$this->EVA_CUR_VALIDO = $EVA_CUR_VALIDO;
		$this->EVA_CUR_PUNTOS_CURSO = $EVA_CUR_PUNTOS_CURSO;
		$this->ROL_EVALUADOR_CVE = $ROL_EVALUADOR_CVE;
		$this->EVA_CUR_CATEGORIA = $EVA_CUR_CATEGORIA;
		$this->EVA_CUR_MSG_RE_EVALUACION = $EVA_CUR_MSG_RE_EVALUACION;
		$this->EVA_CUR_PUNTOS_CURSO_ORIGINAL = $EVA_CUR_PUNTOS_CURSO_ORIGINAL;
		$this->MATERIA_EDUCATIVO_CVE = $MATERIA_EDUCATIVO_CVE;
		$this->TEM_ELA_MATERIAL_CVE = $TEM_ELA_MATERIAL_CVE;
		$this->FCH_EVALUACION_CURSO_GAECUD = $FCH_EVALUACION_CURSO_GAECUD;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from evaluacion_curso_mat_edu where EVA_CURSO_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->EVA_CURSO_CVE = $row["EVA_CURSO_CVE"];
			$this->EVA_CUR_VALIDO = $row["EVA_CUR_VALIDO"];
			$this->EVA_CUR_PUNTOS_CURSO = $row["EVA_CUR_PUNTOS_CURSO"];
			$this->ROL_EVALUADOR_CVE = $row["ROL_EVALUADOR_CVE"];
			$this->EVA_CUR_CATEGORIA = $row["EVA_CUR_CATEGORIA"];
			$this->EVA_CUR_MSG_RE_EVALUACION = $row["EVA_CUR_MSG_RE_EVALUACION"];
			$this->EVA_CUR_PUNTOS_CURSO_ORIGINAL = $row["EVA_CUR_PUNTOS_CURSO_ORIGINAL"];
			$this->MATERIA_EDUCATIVO_CVE = $row["MATERIA_EDUCATIVO_CVE"];
			$this->TEM_ELA_MATERIAL_CVE = $row["TEM_ELA_MATERIAL_CVE"];
			$this->FCH_EVALUACION_CURSO_GAECUD = $row["FCH_EVALUACION_CURSO_GAECUD"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM evaluacion_curso_mat_edu WHERE EVA_CURSO_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE evaluacion_curso_mat_edu set EVA_CUR_VALIDO = \"$this->EVA_CUR_VALIDO\", EVA_CUR_PUNTOS_CURSO = \"$this->EVA_CUR_PUNTOS_CURSO\", ROL_EVALUADOR_CVE = \"$this->ROL_EVALUADOR_CVE\", EVA_CUR_CATEGORIA = \"$this->EVA_CUR_CATEGORIA\", EVA_CUR_MSG_RE_EVALUACION = \"$this->EVA_CUR_MSG_RE_EVALUACION\", EVA_CUR_PUNTOS_CURSO_ORIGINAL = \"$this->EVA_CUR_PUNTOS_CURSO_ORIGINAL\", MATERIA_EDUCATIVO_CVE = \"$this->MATERIA_EDUCATIVO_CVE\", TEM_ELA_MATERIAL_CVE = \"$this->TEM_ELA_MATERIAL_CVE\", FCH_EVALUACION_CURSO_GAECUD = \"$this->FCH_EVALUACION_CURSO_GAECUD\" where EVA_CURSO_CVE = \"$this->EVA_CURSO_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into evaluacion_curso_mat_edu (EVA_CUR_VALIDO, EVA_CUR_PUNTOS_CURSO, ROL_EVALUADOR_CVE, EVA_CUR_CATEGORIA, EVA_CUR_MSG_RE_EVALUACION, EVA_CUR_PUNTOS_CURSO_ORIGINAL, MATERIA_EDUCATIVO_CVE, TEM_ELA_MATERIAL_CVE, FCH_EVALUACION_CURSO_GAECUD) values (\"$this->EVA_CUR_VALIDO\", \"$this->EVA_CUR_PUNTOS_CURSO\", \"$this->ROL_EVALUADOR_CVE\", \"$this->EVA_CUR_CATEGORIA\", \"$this->EVA_CUR_MSG_RE_EVALUACION\", \"$this->EVA_CUR_PUNTOS_CURSO_ORIGINAL\", \"$this->MATERIA_EDUCATIVO_CVE\", \"$this->TEM_ELA_MATERIAL_CVE\", \"$this->FCH_EVALUACION_CURSO_GAECUD\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT EVA_CURSO_CVE from evaluacion_curso_mat_edu order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["EVA_CURSO_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return EVA_CURSO_CVE - int(11)
	 */
	public function getEVA_CURSO_CVE(){
		return $this->EVA_CURSO_CVE;
	}

	/**
	 * @return EVA_CUR_VALIDO - char(1)
	 */
	public function getEVA_CUR_VALIDO(){
		return $this->EVA_CUR_VALIDO;
	}

	/**
	 * @return EVA_CUR_PUNTOS_CURSO - int(11)
	 */
	public function getEVA_CUR_PUNTOS_CURSO(){
		return $this->EVA_CUR_PUNTOS_CURSO;
	}

	/**
	 * @return ROL_EVALUADOR_CVE - int(11)
	 */
	public function getROL_EVALUADOR_CVE(){
		return $this->ROL_EVALUADOR_CVE;
	}

	/**
	 * @return EVA_CUR_CATEGORIA - varchar(20)
	 */
	public function getEVA_CUR_CATEGORIA(){
		return $this->EVA_CUR_CATEGORIA;
	}

	/**
	 * @return EVA_CUR_MSG_RE_EVALUACION - mediumtext
	 */
	public function getEVA_CUR_MSG_RE_EVALUACION(){
		return $this->EVA_CUR_MSG_RE_EVALUACION;
	}

	/**
	 * @return EVA_CUR_PUNTOS_CURSO_ORIGINAL - int(11)
	 */
	public function getEVA_CUR_PUNTOS_CURSO_ORIGINAL(){
		return $this->EVA_CUR_PUNTOS_CURSO_ORIGINAL;
	}

	/**
	 * @return MATERIA_EDUCATIVO_CVE - int(11)
	 */
	public function getMATERIA_EDUCATIVO_CVE(){
		return $this->MATERIA_EDUCATIVO_CVE;
	}

	/**
	 * @return TEM_ELA_MATERIAL_CVE - int(11)
	 */
	public function getTEM_ELA_MATERIAL_CVE(){
		return $this->TEM_ELA_MATERIAL_CVE;
	}

	/**
	 * @return FCH_EVALUACION_CURSO_GAECUD - date
	 */
	public function getFCH_EVALUACION_CURSO_GAECUD(){
		return $this->FCH_EVALUACION_CURSO_GAECUD;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setEVA_CURSO_CVE($EVA_CURSO_CVE){
		$this->EVA_CURSO_CVE = $EVA_CURSO_CVE;
	}

	/**
	 * @param Type: char(1)
	 */
	public function setEVA_CUR_VALIDO($EVA_CUR_VALIDO){
		$this->EVA_CUR_VALIDO = $EVA_CUR_VALIDO;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setEVA_CUR_PUNTOS_CURSO($EVA_CUR_PUNTOS_CURSO){
		$this->EVA_CUR_PUNTOS_CURSO = $EVA_CUR_PUNTOS_CURSO;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setROL_EVALUADOR_CVE($ROL_EVALUADOR_CVE){
		$this->ROL_EVALUADOR_CVE = $ROL_EVALUADOR_CVE;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setEVA_CUR_CATEGORIA($EVA_CUR_CATEGORIA){
		$this->EVA_CUR_CATEGORIA = $EVA_CUR_CATEGORIA;
	}

	/**
	 * @param Type: mediumtext
	 */
	public function setEVA_CUR_MSG_RE_EVALUACION($EVA_CUR_MSG_RE_EVALUACION){
		$this->EVA_CUR_MSG_RE_EVALUACION = $EVA_CUR_MSG_RE_EVALUACION;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setEVA_CUR_PUNTOS_CURSO_ORIGINAL($EVA_CUR_PUNTOS_CURSO_ORIGINAL){
		$this->EVA_CUR_PUNTOS_CURSO_ORIGINAL = $EVA_CUR_PUNTOS_CURSO_ORIGINAL;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setMATERIA_EDUCATIVO_CVE($MATERIA_EDUCATIVO_CVE){
		$this->MATERIA_EDUCATIVO_CVE = $MATERIA_EDUCATIVO_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTEM_ELA_MATERIAL_CVE($TEM_ELA_MATERIAL_CVE){
		$this->TEM_ELA_MATERIAL_CVE = $TEM_ELA_MATERIAL_CVE;
	}

	/**
	 * @param Type: date
	 */
	public function setFCH_EVALUACION_CURSO_GAECUD($FCH_EVALUACION_CURSO_GAECUD){
		$this->FCH_EVALUACION_CURSO_GAECUD = $FCH_EVALUACION_CURSO_GAECUD;
	}

    /**
     * Close mysql connection
     */
	public function endevaluacion_curso_mat_edu(){
		$this->connection->CloseMysql();
	}

}