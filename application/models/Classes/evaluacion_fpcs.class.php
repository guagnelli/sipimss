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

Class evaluacion_fpcs {

	private $TOTAL_PUNTOS; //int(11)
	private $MSG_INCONFORMIDAD; //varchar(200)
	private $EVA_CURSO_CVE; //int(11)
	private $EST_EVALUACION_CVE; //int(11)
	private $connection;

	public function evaluacion_fpcs(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_evaluacion_fpcs($TOTAL_PUNTOS,$MSG_INCONFORMIDAD,$EVA_CURSO_CVE,$EST_EVALUACION_CVE){
		$this->TOTAL_PUNTOS = $TOTAL_PUNTOS;
		$this->MSG_INCONFORMIDAD = $MSG_INCONFORMIDAD;
		$this->EVA_CURSO_CVE = $EVA_CURSO_CVE;
		$this->EST_EVALUACION_CVE = $EST_EVALUACION_CVE;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from evaluacion_fpcs where TOTAL_PUNTOS = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->TOTAL_PUNTOS = $row["TOTAL_PUNTOS"];
			$this->MSG_INCONFORMIDAD = $row["MSG_INCONFORMIDAD"];
			$this->EVA_CURSO_CVE = $row["EVA_CURSO_CVE"];
			$this->EST_EVALUACION_CVE = $row["EST_EVALUACION_CVE"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM evaluacion_fpcs WHERE TOTAL_PUNTOS = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE evaluacion_fpcs set TOTAL_PUNTOS = \"$this->TOTAL_PUNTOS\", MSG_INCONFORMIDAD = \"$this->MSG_INCONFORMIDAD\", EVA_CURSO_CVE = \"$this->EVA_CURSO_CVE\", EST_EVALUACION_CVE = \"$this->EST_EVALUACION_CVE\" where TOTAL_PUNTOS = \"$this->TOTAL_PUNTOS\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into evaluacion_fpcs (TOTAL_PUNTOS, MSG_INCONFORMIDAD, EVA_CURSO_CVE, EST_EVALUACION_CVE) values (\"$this->TOTAL_PUNTOS\", \"$this->MSG_INCONFORMIDAD\", \"$this->EVA_CURSO_CVE\", \"$this->EST_EVALUACION_CVE\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT TOTAL_PUNTOS from evaluacion_fpcs order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["TOTAL_PUNTOS"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return TOTAL_PUNTOS - int(11)
	 */
	public function getTOTAL_PUNTOS(){
		return $this->TOTAL_PUNTOS;
	}

	/**
	 * @return MSG_INCONFORMIDAD - varchar(200)
	 */
	public function getMSG_INCONFORMIDAD(){
		return $this->MSG_INCONFORMIDAD;
	}

	/**
	 * @return EVA_CURSO_CVE - int(11)
	 */
	public function getEVA_CURSO_CVE(){
		return $this->EVA_CURSO_CVE;
	}

	/**
	 * @return EST_EVALUACION_CVE - int(11)
	 */
	public function getEST_EVALUACION_CVE(){
		return $this->EST_EVALUACION_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setTOTAL_PUNTOS($TOTAL_PUNTOS){
		$this->TOTAL_PUNTOS = $TOTAL_PUNTOS;
	}

	/**
	 * @param Type: varchar(200)
	 */
	public function setMSG_INCONFORMIDAD($MSG_INCONFORMIDAD){
		$this->MSG_INCONFORMIDAD = $MSG_INCONFORMIDAD;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setEVA_CURSO_CVE($EVA_CURSO_CVE){
		$this->EVA_CURSO_CVE = $EVA_CURSO_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setEST_EVALUACION_CVE($EST_EVALUACION_CVE){
		$this->EST_EVALUACION_CVE = $EST_EVALUACION_CVE;
	}

    /**
     * Close mysql connection
     */
	public function endevaluacion_fpcs(){
		$this->connection->CloseMysql();
	}

}