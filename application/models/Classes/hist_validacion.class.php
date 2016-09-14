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

Class hist_validacion {

	private $VALIDACION_CVE; //int(11)
	private $VAL_ESTADO_CVE; //int(11)
	private $VALIDADOR_CVE; //int(11)
	private $VAL_FCH; //datetime
	private $VAL_COMENTARIO; //varchar(2000)
	private $VALIDACION_GRAL_CVE; //int(11)
	private $IS_ACTUAL; //tinyint(1)
	private $connection;

	public function hist_validacion(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_hist_validacion($VAL_ESTADO_CVE,$VALIDADOR_CVE,$VAL_FCH,$VAL_COMENTARIO,$VALIDACION_GRAL_CVE,$IS_ACTUAL){
		$this->VAL_ESTADO_CVE = $VAL_ESTADO_CVE;
		$this->VALIDADOR_CVE = $VALIDADOR_CVE;
		$this->VAL_FCH = $VAL_FCH;
		$this->VAL_COMENTARIO = $VAL_COMENTARIO;
		$this->VALIDACION_GRAL_CVE = $VALIDACION_GRAL_CVE;
		$this->IS_ACTUAL = $IS_ACTUAL;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from hist_validacion where VALIDACION_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->VALIDACION_CVE = $row["VALIDACION_CVE"];
			$this->VAL_ESTADO_CVE = $row["VAL_ESTADO_CVE"];
			$this->VALIDADOR_CVE = $row["VALIDADOR_CVE"];
			$this->VAL_FCH = $row["VAL_FCH"];
			$this->VAL_COMENTARIO = $row["VAL_COMENTARIO"];
			$this->VALIDACION_GRAL_CVE = $row["VALIDACION_GRAL_CVE"];
			$this->IS_ACTUAL = $row["IS_ACTUAL"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM hist_validacion WHERE VALIDACION_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE hist_validacion set VAL_ESTADO_CVE = \"$this->VAL_ESTADO_CVE\", VALIDADOR_CVE = \"$this->VALIDADOR_CVE\", VAL_FCH = \"$this->VAL_FCH\", VAL_COMENTARIO = \"$this->VAL_COMENTARIO\", VALIDACION_GRAL_CVE = \"$this->VALIDACION_GRAL_CVE\", IS_ACTUAL = \"$this->IS_ACTUAL\" where VALIDACION_CVE = \"$this->VALIDACION_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into hist_validacion (VAL_ESTADO_CVE, VALIDADOR_CVE, VAL_FCH, VAL_COMENTARIO, VALIDACION_GRAL_CVE, IS_ACTUAL) values (\"$this->VAL_ESTADO_CVE\", \"$this->VALIDADOR_CVE\", \"$this->VAL_FCH\", \"$this->VAL_COMENTARIO\", \"$this->VALIDACION_GRAL_CVE\", \"$this->IS_ACTUAL\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT VALIDACION_CVE from hist_validacion order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["VALIDACION_CVE"];
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
	 * @return VAL_ESTADO_CVE - int(11)
	 */
	public function getVAL_ESTADO_CVE(){
		return $this->VAL_ESTADO_CVE;
	}

	/**
	 * @return VALIDADOR_CVE - int(11)
	 */
	public function getVALIDADOR_CVE(){
		return $this->VALIDADOR_CVE;
	}

	/**
	 * @return VAL_FCH - datetime
	 */
	public function getVAL_FCH(){
		return $this->VAL_FCH;
	}

	/**
	 * @return VAL_COMENTARIO - varchar(2000)
	 */
	public function getVAL_COMENTARIO(){
		return $this->VAL_COMENTARIO;
	}

	/**
	 * @return VALIDACION_GRAL_CVE - int(11)
	 */
	public function getVALIDACION_GRAL_CVE(){
		return $this->VALIDACION_GRAL_CVE;
	}

	/**
	 * @return IS_ACTUAL - tinyint(1)
	 */
	public function getIS_ACTUAL(){
		return $this->IS_ACTUAL;
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
	public function setVAL_ESTADO_CVE($VAL_ESTADO_CVE){
		$this->VAL_ESTADO_CVE = $VAL_ESTADO_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setVALIDADOR_CVE($VALIDADOR_CVE){
		$this->VALIDADOR_CVE = $VALIDADOR_CVE;
	}

	/**
	 * @param Type: datetime
	 */
	public function setVAL_FCH($VAL_FCH){
		$this->VAL_FCH = $VAL_FCH;
	}

	/**
	 * @param Type: varchar(2000)
	 */
	public function setVAL_COMENTARIO($VAL_COMENTARIO){
		$this->VAL_COMENTARIO = $VAL_COMENTARIO;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setVALIDACION_GRAL_CVE($VALIDACION_GRAL_CVE){
		$this->VALIDACION_GRAL_CVE = $VALIDACION_GRAL_CVE;
	}

	/**
	 * @param Type: tinyint(1)
	 */
	public function setIS_ACTUAL($IS_ACTUAL){
		$this->IS_ACTUAL = $IS_ACTUAL;
	}

    /**
     * Close mysql connection
     */
	public function endhist_validacion(){
		$this->connection->CloseMysql();
	}

}