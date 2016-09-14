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

Class evaluacion_convocatoria {

	private $FCH_FIN_REG_DOCENTE; //date
	private $FCH_FIN_VALIDACION_1; //date
	private $FCH_FIN_VALIDACION_2; //date
	private $ADMIN_VALIDADOR_CVE; //int(11)
	private $is_actual; //decimal(1,0)
	private $connection;

	public function evaluacion_convocatoria(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_evaluacion_convocatoria($FCH_FIN_REG_DOCENTE,$FCH_FIN_VALIDACION_1,$FCH_FIN_VALIDACION_2,$is_actual){
		$this->FCH_FIN_REG_DOCENTE = $FCH_FIN_REG_DOCENTE;
		$this->FCH_FIN_VALIDACION_1 = $FCH_FIN_VALIDACION_1;
		$this->FCH_FIN_VALIDACION_2 = $FCH_FIN_VALIDACION_2;
		$this->is_actual = $is_actual;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from evaluacion_convocatoria where ADMIN_VALIDADOR_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->FCH_FIN_REG_DOCENTE = $row["FCH_FIN_REG_DOCENTE"];
			$this->FCH_FIN_VALIDACION_1 = $row["FCH_FIN_VALIDACION_1"];
			$this->FCH_FIN_VALIDACION_2 = $row["FCH_FIN_VALIDACION_2"];
			$this->ADMIN_VALIDADOR_CVE = $row["ADMIN_VALIDADOR_CVE"];
			$this->is_actual = $row["is_actual"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM evaluacion_convocatoria WHERE ADMIN_VALIDADOR_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE evaluacion_convocatoria set FCH_FIN_REG_DOCENTE = \"$this->FCH_FIN_REG_DOCENTE\", FCH_FIN_VALIDACION_1 = \"$this->FCH_FIN_VALIDACION_1\", FCH_FIN_VALIDACION_2 = \"$this->FCH_FIN_VALIDACION_2\", is_actual = \"$this->is_actual\" where ADMIN_VALIDADOR_CVE = \"$this->ADMIN_VALIDADOR_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into evaluacion_convocatoria (FCH_FIN_REG_DOCENTE, FCH_FIN_VALIDACION_1, FCH_FIN_VALIDACION_2, is_actual) values (\"$this->FCH_FIN_REG_DOCENTE\", \"$this->FCH_FIN_VALIDACION_1\", \"$this->FCH_FIN_VALIDACION_2\", \"$this->is_actual\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT ADMIN_VALIDADOR_CVE from evaluacion_convocatoria order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["ADMIN_VALIDADOR_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return FCH_FIN_REG_DOCENTE - date
	 */
	public function getFCH_FIN_REG_DOCENTE(){
		return $this->FCH_FIN_REG_DOCENTE;
	}

	/**
	 * @return FCH_FIN_VALIDACION_1 - date
	 */
	public function getFCH_FIN_VALIDACION_1(){
		return $this->FCH_FIN_VALIDACION_1;
	}

	/**
	 * @return FCH_FIN_VALIDACION_2 - date
	 */
	public function getFCH_FIN_VALIDACION_2(){
		return $this->FCH_FIN_VALIDACION_2;
	}

	/**
	 * @return ADMIN_VALIDADOR_CVE - int(11)
	 */
	public function getADMIN_VALIDADOR_CVE(){
		return $this->ADMIN_VALIDADOR_CVE;
	}

	/**
	 * @return is_actual - decimal(1,0)
	 */
	public function getis_actual(){
		return $this->is_actual;
	}

	/**
	 * @param Type: date
	 */
	public function setFCH_FIN_REG_DOCENTE($FCH_FIN_REG_DOCENTE){
		$this->FCH_FIN_REG_DOCENTE = $FCH_FIN_REG_DOCENTE;
	}

	/**
	 * @param Type: date
	 */
	public function setFCH_FIN_VALIDACION_1($FCH_FIN_VALIDACION_1){
		$this->FCH_FIN_VALIDACION_1 = $FCH_FIN_VALIDACION_1;
	}

	/**
	 * @param Type: date
	 */
	public function setFCH_FIN_VALIDACION_2($FCH_FIN_VALIDACION_2){
		$this->FCH_FIN_VALIDACION_2 = $FCH_FIN_VALIDACION_2;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setADMIN_VALIDADOR_CVE($ADMIN_VALIDADOR_CVE){
		$this->ADMIN_VALIDADOR_CVE = $ADMIN_VALIDADOR_CVE;
	}

	/**
	 * @param Type: decimal(1,0)
	 */
	public function setis_actual($is_actual){
		$this->is_actual = $is_actual;
	}

    /**
     * Close mysql connection
     */
	public function endevaluacion_convocatoria(){
		$this->connection->CloseMysql();
	}

}