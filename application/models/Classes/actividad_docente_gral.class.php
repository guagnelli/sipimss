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

Class actividad_docente_gral {

	private $ACT_DOC_GRAL_CVE; //int(11)
	private $ANIOS_DEDICADOS; //int(11)
	private $CURSO_MAS_DEDICADO; //varchar(20)
	private $CURSO_PRINC_IMPARTE; //varchar(20)
	private $EJER_PREDOMI_CVE; //int(11)
	private $EMPLEADO_CVE; //int(11)
	private $TIP_ACT_DOC_PRINCIPAL_CVE; //int(10)
	private $FECHA_INSERSION; //timestamp
	private $connection;

	public function actividad_docente_gral(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don´t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_actividad_docente_gral($ANIOS_DEDICADOS,$CURSO_MAS_DEDICADO,$CURSO_PRINC_IMPARTE,$EJER_PREDOMI_CVE,$EMPLEADO_CVE,$TIP_ACT_DOC_PRINCIPAL_CVE,$FECHA_INSERSION){
		$this->ANIOS_DEDICADOS = $ANIOS_DEDICADOS;
		$this->CURSO_MAS_DEDICADO = $CURSO_MAS_DEDICADO;
		$this->CURSO_PRINC_IMPARTE = $CURSO_PRINC_IMPARTE;
		$this->EJER_PREDOMI_CVE = $EJER_PREDOMI_CVE;
		$this->EMPLEADO_CVE = $EMPLEADO_CVE;
		$this->TIP_ACT_DOC_PRINCIPAL_CVE = $TIP_ACT_DOC_PRINCIPAL_CVE;
		$this->FECHA_INSERSION = $FECHA_INSERSION;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from actividad_docente_gral where ACT_DOC_GRAL_CVE = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->ACT_DOC_GRAL_CVE = $row["ACT_DOC_GRAL_CVE"];
			$this->ANIOS_DEDICADOS = $row["ANIOS_DEDICADOS"];
			$this->CURSO_MAS_DEDICADO = $row["CURSO_MAS_DEDICADO"];
			$this->CURSO_PRINC_IMPARTE = $row["CURSO_PRINC_IMPARTE"];
			$this->EJER_PREDOMI_CVE = $row["EJER_PREDOMI_CVE"];
			$this->EMPLEADO_CVE = $row["EMPLEADO_CVE"];
			$this->TIP_ACT_DOC_PRINCIPAL_CVE = $row["TIP_ACT_DOC_PRINCIPAL_CVE"];
			$this->FECHA_INSERSION = $row["FECHA_INSERSION"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM actividad_docente_gral WHERE ACT_DOC_GRAL_CVE = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE actividad_docente_gral set ANIOS_DEDICADOS = \"$this->ANIOS_DEDICADOS\", CURSO_MAS_DEDICADO = \"$this->CURSO_MAS_DEDICADO\", CURSO_PRINC_IMPARTE = \"$this->CURSO_PRINC_IMPARTE\", EJER_PREDOMI_CVE = \"$this->EJER_PREDOMI_CVE\", EMPLEADO_CVE = \"$this->EMPLEADO_CVE\", TIP_ACT_DOC_PRINCIPAL_CVE = \"$this->TIP_ACT_DOC_PRINCIPAL_CVE\", FECHA_INSERSION = \"$this->FECHA_INSERSION\" where ACT_DOC_GRAL_CVE = \"$this->ACT_DOC_GRAL_CVE\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into actividad_docente_gral (ANIOS_DEDICADOS, CURSO_MAS_DEDICADO, CURSO_PRINC_IMPARTE, EJER_PREDOMI_CVE, EMPLEADO_CVE, TIP_ACT_DOC_PRINCIPAL_CVE, FECHA_INSERSION) values (\"$this->ANIOS_DEDICADOS\", \"$this->CURSO_MAS_DEDICADO\", \"$this->CURSO_PRINC_IMPARTE\", \"$this->EJER_PREDOMI_CVE\", \"$this->EMPLEADO_CVE\", \"$this->TIP_ACT_DOC_PRINCIPAL_CVE\", \"$this->FECHA_INSERSION\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT ACT_DOC_GRAL_CVE from actividad_docente_gral order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["ACT_DOC_GRAL_CVE"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return ACT_DOC_GRAL_CVE - int(11)
	 */
	public function getACT_DOC_GRAL_CVE(){
		return $this->ACT_DOC_GRAL_CVE;
	}

	/**
	 * @return ANIOS_DEDICADOS - int(11)
	 */
	public function getANIOS_DEDICADOS(){
		return $this->ANIOS_DEDICADOS;
	}

	/**
	 * @return CURSO_MAS_DEDICADO - varchar(20)
	 */
	public function getCURSO_MAS_DEDICADO(){
		return $this->CURSO_MAS_DEDICADO;
	}

	/**
	 * @return CURSO_PRINC_IMPARTE - varchar(20)
	 */
	public function getCURSO_PRINC_IMPARTE(){
		return $this->CURSO_PRINC_IMPARTE;
	}

	/**
	 * @return EJER_PREDOMI_CVE - int(11)
	 */
	public function getEJER_PREDOMI_CVE(){
		return $this->EJER_PREDOMI_CVE;
	}

	/**
	 * @return EMPLEADO_CVE - int(11)
	 */
	public function getEMPLEADO_CVE(){
		return $this->EMPLEADO_CVE;
	}

	/**
	 * @return TIP_ACT_DOC_PRINCIPAL_CVE - int(10)
	 */
	public function getTIP_ACT_DOC_PRINCIPAL_CVE(){
		return $this->TIP_ACT_DOC_PRINCIPAL_CVE;
	}

	/**
	 * @return FECHA_INSERSION - timestamp
	 */
	public function getFECHA_INSERSION(){
		return $this->FECHA_INSERSION;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setACT_DOC_GRAL_CVE($ACT_DOC_GRAL_CVE){
		$this->ACT_DOC_GRAL_CVE = $ACT_DOC_GRAL_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setANIOS_DEDICADOS($ANIOS_DEDICADOS){
		$this->ANIOS_DEDICADOS = $ANIOS_DEDICADOS;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setCURSO_MAS_DEDICADO($CURSO_MAS_DEDICADO){
		$this->CURSO_MAS_DEDICADO = $CURSO_MAS_DEDICADO;
	}

	/**
	 * @param Type: varchar(20)
	 */
	public function setCURSO_PRINC_IMPARTE($CURSO_PRINC_IMPARTE){
		$this->CURSO_PRINC_IMPARTE = $CURSO_PRINC_IMPARTE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setEJER_PREDOMI_CVE($EJER_PREDOMI_CVE){
		$this->EJER_PREDOMI_CVE = $EJER_PREDOMI_CVE;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setEMPLEADO_CVE($EMPLEADO_CVE){
		$this->EMPLEADO_CVE = $EMPLEADO_CVE;
	}

	/**
	 * @param Type: int(10)
	 */
	public function setTIP_ACT_DOC_PRINCIPAL_CVE($TIP_ACT_DOC_PRINCIPAL_CVE){
		$this->TIP_ACT_DOC_PRINCIPAL_CVE = $TIP_ACT_DOC_PRINCIPAL_CVE;
	}

	/**
	 * @param Type: timestamp
	 */
	public function setFECHA_INSERSION($FECHA_INSERSION){
		$this->FECHA_INSERSION = $FECHA_INSERSION;
	}

    /**
     * Close mysql connection
     */
	public function endactividad_docente_gral(){
		$this->connection->CloseMysql();
	}

}