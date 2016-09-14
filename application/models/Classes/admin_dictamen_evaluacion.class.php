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

Class admin_dictamen_evaluacion {

	private $FCH_INICIO_EVALUACION; //date
	private $FCH_FIN_EVALUACION; //date
	private $FCH_FIN_INCONFORMIDAD; //date
	private $ADMIN_DICTAMEN_EVA_CVE; //int(11)
	private $ADMIN_VALIDADOR_CVE; //int(11)
	private $connection;

	public function admin_dictamen_evaluacion(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_admin_dictamen_evaluacion($FCH_INICIO_EVALUACION,$FCH_FIN_EVALUACION,$FCH_FIN_INCONFORMIDAD,$ADMIN_VALIDADOR_CVE){
		$this->FCH_INICIO_EVALUACION = $FCH_INICIO_EVALUACION;
		$this->FCH_FIN_EVALUACION = $FCH_FIN_EVALUACION;
		$this->FCH_FIN_INCONFORMIDAD = $FCH_FIN_INCONFORMIDAD;
		$this->ADMIN_VALIDADOR_CVE = $ADMIN_VALIDADOR_CVE;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from admin_dictamen_evaluacion where ADMIN_DICTAMEN_EVA_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->FCH_INICIO_EVALUACION = $row["FCH_INICIO_EVALUACION"];
			$this->FCH_FIN_EVALUACION = $row["FCH_FIN_EVALUACION"];
			$this->FCH_FIN_INCONFORMIDAD = $row["FCH_FIN_INCONFORMIDAD"];
			$this->ADMIN_DICTAMEN_EVA_CVE = $row["ADMIN_DICTAMEN_EVA_CVE"];
			$this->ADMIN_VALIDADOR_CVE = $row["ADMIN_VALIDADOR_CVE"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM admin_dictamen_evaluacion WHERE ADMIN_DICTAMEN_EVA_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE admin_dictamen_evaluacion set FCH_INICIO_EVALUACION = \"$this->FCH_INICIO_EVALUACION\", FCH_FIN_EVALUACION = \"$this->FCH_FIN_EVALUACION\", FCH_FIN_INCONFORMIDAD = \"$this->FCH_FIN_INCONFORMIDAD\", ADMIN_VALIDADOR_CVE = \"$this->ADMIN_VALIDADOR_CVE\" where ADMIN_DICTAMEN_EVA_CVE = \"$this->ADMIN_DICTAMEN_EVA_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into admin_dictamen_evaluacion (FCH_INICIO_EVALUACION, FCH_FIN_EVALUACION, FCH_FIN_INCONFORMIDAD, ADMIN_VALIDADOR_CVE) values (\"$this->FCH_INICIO_EVALUACION\", \"$this->FCH_FIN_EVALUACION\", \"$this->FCH_FIN_INCONFORMIDAD\", \"$this->ADMIN_VALIDADOR_CVE\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT ADMIN_DICTAMEN_EVA_CVE from admin_dictamen_evaluacion order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["ADMIN_DICTAMEN_EVA_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return FCH_INICIO_EVALUACION - date
	 */
	public function getFCH_INICIO_EVALUACION(){
		return $this->FCH_INICIO_EVALUACION;
	}

	/**
	 * @return FCH_FIN_EVALUACION - date
	 */
	public function getFCH_FIN_EVALUACION(){
		return $this->FCH_FIN_EVALUACION;
	}

	/**
	 * @return FCH_FIN_INCONFORMIDAD - date
	 */
	public function getFCH_FIN_INCONFORMIDAD(){
		return $this->FCH_FIN_INCONFORMIDAD;
	}

	/**
	 * @return ADMIN_DICTAMEN_EVA_CVE - int(11)
	 */
	public function getADMIN_DICTAMEN_EVA_CVE(){
		return $this->ADMIN_DICTAMEN_EVA_CVE;
	}

	/**
	 * @return ADMIN_VALIDADOR_CVE - int(11)
	 */
	public function getADMIN_VALIDADOR_CVE(){
		return $this->ADMIN_VALIDADOR_CVE;
	}

	/**
	 * @param Type: date
	 */
	public function setFCH_INICIO_EVALUACION($FCH_INICIO_EVALUACION){
		$this->FCH_INICIO_EVALUACION = $FCH_INICIO_EVALUACION;
	}

	/**
	 * @param Type: date
	 */
	public function setFCH_FIN_EVALUACION($FCH_FIN_EVALUACION){
		$this->FCH_FIN_EVALUACION = $FCH_FIN_EVALUACION;
	}

	/**
	 * @param Type: date
	 */
	public function setFCH_FIN_INCONFORMIDAD($FCH_FIN_INCONFORMIDAD){
		$this->FCH_FIN_INCONFORMIDAD = $FCH_FIN_INCONFORMIDAD;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setADMIN_DICTAMEN_EVA_CVE($ADMIN_DICTAMEN_EVA_CVE){
		$this->ADMIN_DICTAMEN_EVA_CVE = $ADMIN_DICTAMEN_EVA_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setADMIN_VALIDADOR_CVE($ADMIN_VALIDADOR_CVE){
		$this->ADMIN_VALIDADOR_CVE = $ADMIN_VALIDADOR_CVE;
	}

    /**
     * Close mysql connection
     */
	public function endadmin_dictamen_evaluacion(){
		$this->connection->CloseMysql();
	}

}