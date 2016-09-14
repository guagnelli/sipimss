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

Class cparametros {

	private $PERAM_PERIODO_INCONFORMIDAD; //int(11)
	private $PARAM_VIGENCIA; //int(11)
	private $PARAM_RE_EVALUACION; //int(11)
	private $connection;

	public function cparametros(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_cparametros($PERAM_PERIODO_INCONFORMIDAD,$PARAM_VIGENCIA,$PARAM_RE_EVALUACION){
		$this->PERAM_PERIODO_INCONFORMIDAD = $PERAM_PERIODO_INCONFORMIDAD;
		$this->PARAM_VIGENCIA = $PARAM_VIGENCIA;
		$this->PARAM_RE_EVALUACION = $PARAM_RE_EVALUACION;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from cparametros where PERAM_PERIODO_INCONFORMIDAD = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->PERAM_PERIODO_INCONFORMIDAD = $row["PERAM_PERIODO_INCONFORMIDAD"];
			$this->PARAM_VIGENCIA = $row["PARAM_VIGENCIA"];
			$this->PARAM_RE_EVALUACION = $row["PARAM_RE_EVALUACION"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM cparametros WHERE PERAM_PERIODO_INCONFORMIDAD = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE cparametros set PERAM_PERIODO_INCONFORMIDAD = \"$this->PERAM_PERIODO_INCONFORMIDAD\", PARAM_VIGENCIA = \"$this->PARAM_VIGENCIA\", PARAM_RE_EVALUACION = \"$this->PARAM_RE_EVALUACION\" where PERAM_PERIODO_INCONFORMIDAD = \"$this->PERAM_PERIODO_INCONFORMIDAD\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into cparametros (PERAM_PERIODO_INCONFORMIDAD, PARAM_VIGENCIA, PARAM_RE_EVALUACION) values (\"$this->PERAM_PERIODO_INCONFORMIDAD\", \"$this->PARAM_VIGENCIA\", \"$this->PARAM_RE_EVALUACION\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT PERAM_PERIODO_INCONFORMIDAD from cparametros order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["PERAM_PERIODO_INCONFORMIDAD"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return PERAM_PERIODO_INCONFORMIDAD - int(11)
	 */
	public function getPERAM_PERIODO_INCONFORMIDAD(){
		return $this->PERAM_PERIODO_INCONFORMIDAD;
	}

	/**
	 * @return PARAM_VIGENCIA - int(11)
	 */
	public function getPARAM_VIGENCIA(){
		return $this->PARAM_VIGENCIA;
	}

	/**
	 * @return PARAM_RE_EVALUACION - int(11)
	 */
	public function getPARAM_RE_EVALUACION(){
		return $this->PARAM_RE_EVALUACION;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setPERAM_PERIODO_INCONFORMIDAD($PERAM_PERIODO_INCONFORMIDAD){
		$this->PERAM_PERIODO_INCONFORMIDAD = $PERAM_PERIODO_INCONFORMIDAD;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setPARAM_VIGENCIA($PARAM_VIGENCIA){
		$this->PARAM_VIGENCIA = $PARAM_VIGENCIA;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setPARAM_RE_EVALUACION($PARAM_RE_EVALUACION){
		$this->PARAM_RE_EVALUACION = $PARAM_RE_EVALUACION;
	}

    /**
     * Close mysql connection
     */
	public function endcparametros(){
		$this->connection->CloseMysql();
	}

}