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

Class hist_edis_validacion_curso {

	private $VALIDACION_CVE; //int(11)
	private $VAL_CUR_EST_CVE; //int(11)
	private $HIST_VAL_CURSO_CVE; //int(11)
	private $VAL_CUR_COMENTARIO; //varchar(2000)
	private $VAL_CUR_FCH; //timestamp
	private $EDIS_CVE; //int(11)
	private $connection;

	public function hist_edis_validacion_curso(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_hist_edis_validacion_curso($VALIDACION_CVE,$VAL_CUR_EST_CVE,$VAL_CUR_COMENTARIO,$VAL_CUR_FCH,$EDIS_CVE){
		$this->VALIDACION_CVE = $VALIDACION_CVE;
		$this->VAL_CUR_EST_CVE = $VAL_CUR_EST_CVE;
		$this->VAL_CUR_COMENTARIO = $VAL_CUR_COMENTARIO;
		$this->VAL_CUR_FCH = $VAL_CUR_FCH;
		$this->EDIS_CVE = $EDIS_CVE;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from hist_edis_validacion_curso where HIST_VAL_CURSO_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->VALIDACION_CVE = $row["VALIDACION_CVE"];
			$this->VAL_CUR_EST_CVE = $row["VAL_CUR_EST_CVE"];
			$this->HIST_VAL_CURSO_CVE = $row["HIST_VAL_CURSO_CVE"];
			$this->VAL_CUR_COMENTARIO = $row["VAL_CUR_COMENTARIO"];
			$this->VAL_CUR_FCH = $row["VAL_CUR_FCH"];
			$this->EDIS_CVE = $row["EDIS_CVE"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM hist_edis_validacion_curso WHERE HIST_VAL_CURSO_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE hist_edis_validacion_curso set VALIDACION_CVE = \"$this->VALIDACION_CVE\", VAL_CUR_EST_CVE = \"$this->VAL_CUR_EST_CVE\", VAL_CUR_COMENTARIO = \"$this->VAL_CUR_COMENTARIO\", VAL_CUR_FCH = \"$this->VAL_CUR_FCH\", EDIS_CVE = \"$this->EDIS_CVE\" where HIST_VAL_CURSO_CVE = \"$this->HIST_VAL_CURSO_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into hist_edis_validacion_curso (VALIDACION_CVE, VAL_CUR_EST_CVE, VAL_CUR_COMENTARIO, VAL_CUR_FCH, EDIS_CVE) values (\"$this->VALIDACION_CVE\", \"$this->VAL_CUR_EST_CVE\", \"$this->VAL_CUR_COMENTARIO\", \"$this->VAL_CUR_FCH\", \"$this->EDIS_CVE\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT HIST_VAL_CURSO_CVE from hist_edis_validacion_curso order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["HIST_VAL_CURSO_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return VALIDACION_CVE - int(11)
	 */
	public function getVALIDACION_CVE(){
		return $this->VALIDACION_CVE;
	}

	/**
	 * @return VAL_CUR_EST_CVE - int(11)
	 */
	public function getVAL_CUR_EST_CVE(){
		return $this->VAL_CUR_EST_CVE;
	}

	/**
	 * @return HIST_VAL_CURSO_CVE - int(11)
	 */
	public function getHIST_VAL_CURSO_CVE(){
		return $this->HIST_VAL_CURSO_CVE;
	}

	/**
	 * @return VAL_CUR_COMENTARIO - varchar(2000)
	 */
	public function getVAL_CUR_COMENTARIO(){
		return $this->VAL_CUR_COMENTARIO;
	}

	/**
	 * @return VAL_CUR_FCH - timestamp
	 */
	public function getVAL_CUR_FCH(){
		return $this->VAL_CUR_FCH;
	}

	/**
	 * @return EDIS_CVE - int(11)
	 */
	public function getEDIS_CVE(){
		return $this->EDIS_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setVALIDACION_CVE($VALIDACION_CVE){
		$this->VALIDACION_CVE = $VALIDACION_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setVAL_CUR_EST_CVE($VAL_CUR_EST_CVE){
		$this->VAL_CUR_EST_CVE = $VAL_CUR_EST_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setHIST_VAL_CURSO_CVE($HIST_VAL_CURSO_CVE){
		$this->HIST_VAL_CURSO_CVE = $HIST_VAL_CURSO_CVE;
	}

	/**
	 * @param Type: varchar(2000)
	 */
	public function setVAL_CUR_COMENTARIO($VAL_CUR_COMENTARIO){
		$this->VAL_CUR_COMENTARIO = $VAL_CUR_COMENTARIO;
	}

	/**
	 * @param Type: timestamp
	 */
	public function setVAL_CUR_FCH($VAL_CUR_FCH){
		$this->VAL_CUR_FCH = $VAL_CUR_FCH;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setEDIS_CVE($EDIS_CVE){
		$this->EDIS_CVE = $EDIS_CVE;
	}

    /**
     * Close mysql connection
     */
	public function endhist_edis_validacion_curso(){
		$this->connection->CloseMysql();
	}

}